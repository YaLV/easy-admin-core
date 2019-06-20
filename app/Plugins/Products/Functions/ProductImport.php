<?php

namespace App\Plugins\Products\Functions;


use App\Functions\General;
use App\Http\Controllers\CacheController;
use App\Plugins\Attributes\Model\Attribute;
use App\Plugins\Products\Model\Product;
use App\Plugins\Products\Model\ProductVariation;
use App\Plugins\Units\Model\Unit;
use App\Plugins\Vat\Model\Vat;
use App\Schedules;
use Illuminate\Database\Eloquent\Builder;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProductImport
{

    use General;

    public $attributes = [];
    public $attribute_values = [];
    public $suppliers = [];
    public $units = [];
    public $vat = [];
    public $categories = [];
    public $required = [
        'sku',
        'supplier_id',
        'marketdays',
        'categories',
        'unit_id',
        'price',
        'mark_up',
        'vat_id',
    ];
    public $metas = [
        'name',
        'description',
        'ingredients',
        'expire_date',
        'google_keywords',
        'google_description',
    ];

    public static function runImport($scheduled) {
        return (new self)->readImportData($scheduled);
    }

    public function __construct()
    {
        $this->attributes = __('attributes.slug');
        $this->attribute_values = __('attributevalues.slug');
        $this->vat = Vat::all()->pluck('amount', 'id')->toArray();
        $this->units = Unit::all()->pluck('unit', 'id')->toArray();
        $this->suppliers = __('supplier.slug');
        $this->categories = __('category.slug');

    }

    public function readImportData($schedule)
    {
        if (!ini_get("auto_detect_line_endings")) {
            ini_set("auto_detect_line_endings", '1');
        }

        $filename = storage_path("app/imports/products/" . $schedule['filename']);
        if(!\Storage::exists("imports/products/" . $schedule['filename'])) {
            return ['status' => false, 'message' => 'Import File not present'];
        }
        $csv = Reader::createFromPath($filename, 'r');
        $csv->setHeaderOffset(0);

        if(!empty(array_diff($csv->getHeader(), $this->importFieldData())) || !empty(array_diff($this->importFieldData(),$csv->getHeader()))) {
            return ['status' => false, 'message' => 'Missing fields in import (or import has renamed headers)'];
        }

        Schedules::find($schedule['id'])->update(['total_lines' => $csv->count()]);

        $linereader = (new Statement())->offset($schedule['stopped_at']);

        $previousProduct = false;
        foreach ($linereader->process($csv) as $l => $importLine) {

            $sku = $this->getLineData($importLine, 'search');

            if($previousProduct==$sku['sku']) {
                $product['metas'] = array_merge($product, $this->getLineData($importLine, 'metaData', $product['metas']));
                if ($productCollection ?? false) {
                    $this->handleMetas($productCollection, array_merge($this->metas, ['slug']), 'name-id', $product['metas']);
                    Schedules::find($schedule['id'])->increment('stopped_at', 1);
                }
                continue;
            } else {
                unset($product, $productCollection);
            }

            $product['search'] = $sku;

            $product['update'] = $this->getLineData($importLine, 'product');

            $product['metas'] = $this->getLineData($importLine, 'metaData');

            $product = array_merge($product, $this->getLineData($importLine, 'marketDays'));
            $product = array_merge($product, $this->getLineData($importLine, 'variations'));
            $product = array_merge($product, $this->getLineData($importLine, 'attributes'));
            $product = array_merge($product, $this->getLineData($importLine, 'categories'));

            $productCollection = $this->saveProduct($product);
            $this->handleMetas($productCollection, array_merge($this->metas, ['slug']), 'name-id', $product['metas']);
            Schedules::find($schedule['id'])->increment('stopped_at', 1);
            $previousProduct = $sku['sku'];

            $productCollection->forgetMeta(['slug', 'name']);
            (new CacheController)->createProductCache($productCollection->id, true);

        }

        $csv = null;
        return ['status' => true, 'message' => 'Import Successful'];
    }

    public function saveProduct($product)
    {

        /** @var Product $productCardData */
        $productCardData = Product::updateOrCreate($product['search'], $product['update']);

        $productId = $productCardData->id;

        $productCardData->attributeValues()->sync($product['attributeValues']);
        $productCardData->attributes()->sync($product['attributes']);

        $importedVariations = [];
        foreach ($product['variations']??[1 => ''] as $size => $comment) {
            $pv = ProductVariation::updateOrCreate(['amount' => (float)$size, 'product_id'   => $productId], [
                'for_supplier' => $comment,
                'display_name' => $this->makeDisplayName((float)$size, $productCardData),
            ]);

            $importedVariations[] = $pv->id;
        }

        $productCardData->variations()->whereNotIn('id', $importedVariations)->delete();

        $productCardData->market_days()->sync($product['marketdays']);

        return $productCardData;

    }


    public function makeDisplayName($amount, $product)
    {
        /** @var Unit $unit */
        $unit = $product->unit;
        if ($unit->subUnit()->count() && $amount < 1) {
            $unit = $unit->subUnit;
            $displayName = ($amount * $unit->parent_amount);
        }

        return ($displayName ?? $amount) . $unit->unit;
    }

    public function getLineData($line, $dataType, $response = [])
    {

        $fields = $this->importFieldData();

        switch ($dataType) {
            case "search":
                $response = [
                    'sku' => trim($line[$fields['sku']]),
                ];
                break;

            case "product":
                $response = [
                    'supplier_id'    => array_search($line[$fields['supplier_id']], $this->suppliers),
                    'deleted_at'     => !$line[$fields['deleted_at']] ? now() : null,
                    'is_bio'         => $line[$fields['is_bio']],
                    'is_lv'          => $line[$fields['is_lv']],
                    'is_suggested'   => $line[$fields['is_suggested']],
                    'is_highlighted' => $line[$fields['is_highlighted']],
                    'unit_id'        => array_search($line[$fields['unit_id']], $this->units),
                    'price'          => $line[$fields['price']],
                    'mark_up'        => $line[$fields['mark_up']],
                    'vat_id'         => array_search($line[$fields['vat_id']], $this->vat),
                    'sequence'       => $line[$fields['sequence']],
                    'main_category'  => array_search(current(explode("|", $line[$fields['categories']])), $this->categories),
                ];
                break;

            case "metaData":
                $metas = $this->metas;

                $language = $line[$fields['language']];
                foreach ($metas as $field) {
                    $response[$field][$language] = trim($line[$fields[$field]]);
                }
                break;

            case "marketDays":
                $response['marketdays'] = explode('|', trim($line[$fields['marketdays']]));
                break;

            case "variations":
                $variations = explode("|", trim($line[$fields['variations']]));
                foreach ($variations as $variation) {
                    list($size, $comment) = array_pad(explode(":", $variation),2, "");
                    if(!$size) { break; }
                    $response['variations'][$size] = $comment ?? "";
                }

                break;

            case "attributes":
                $attributes = explode("|", trim($line[$fields['attributes']]));
                foreach ($attributes as $attribute) {
                    if($attribute) {
                        list($attributeSlug, $values) = array_pad(explode(":", $attribute),2, "");
                        if(empty($values)) { break; }
                        $response['attributes'][] = array_search($attributeSlug, $this->attributes);
                        $response['attributeValues'] = array_map(function ($attributeValue) { return array_search($attributeValue, $this->attribute_values); }, explode(",", $values));
                    }
                }
                break;

            case "categories":
                $categories = explode("|", trim($line[$fields['categories']]));
                $response['categories'] = array_map(function ($category) { return array_search($category, $this->categories); }, $categories);
                break;
        }

        return $this->checkRequired($response);
    }

    public function checkRequired($fields)
    {
        foreach ($this->required as $fieldName) {
            if (($fields[$fieldName] ?? "unset") == "") {
                return null;
            }
        }

        return $fields;
    }

    /**
     * Define Product import fields
     *
     * @return array
     */
    public function importFieldData()
    {
        return [
            'sku'                => "SKU",
            'supplier_id'        => "Farmer",
            'deleted_at'         => "Active",
            'marketdays'         => "Market Days",
            'name'               => "Product Name",
            'categories'         => "Categories",
            'is_bio'             => "BIO",
            'is_lv'              => "LV",
            'is_suggested'       => "Suggested",
            'is_highlighted'     => "Highlighted",
            'description'        => "Description",
            'ingredients'        => "Ingridients",
            'expire_date'        => "Expiration Date",
            'unit_id'            => "Measurement Unit",
            'variations'         => "Variations",
            'price'              => "Price",
            'mark_up'            => "Mark Up",
            'vat_id'             => "Vat",
            'language'           => "Language",
            'sequence'           => "Sequence",
            'attributes'         => "Attributes",
            'google_keywords'    => "SEO Keywords",
            'google_description' => "SEO Description",
        ];
    }

    public function exportData()
    {
        $csv = Writer::createFromString();

        $fieldOrder = $this->importFieldData();

        $csv->insertOne($fieldOrder);

        $products = Product::withTrashed()->get();

        /** @var Product $product */
        foreach ($products as $product) {
            foreach (languages() as $language) {
                if (language() == $language->code) {
                    $insertData = [
                        'language'           => $language->code,
                        'name'               => $product->meta['name'][$language->code] ?? " ",
                        'description'        => $product->meta['description'][$language->code] ?? " ",
                        'ingredients'        => $product->meta['ingredients'][$language->code] ?? " ",
                        'expire_date'        => $product->meta['expire_date'][$language->code] ?? " ",
                        'google_keywords'    => $product->meta['google_keywords'][language()] ?? " ",
                        'google_description' => $product->meta['google_description'][language()] ?? " ",
                        'sequence'           => $product->sequence ?? 0,
                        'sku'                => $product->sku ?? " ",
                        'price'              => number_format($product->cost, 2),
                        'mark_up'            => $product->mark_up ?? 0,
                        'vat_id'             => $product->vat->amount ?? 0,
                        'supplier_id'        => $this->suppliers[$product->supplier_id],
                        'deleted_at'         => ($product->deleted_at ? 0 : 1),
                        'categories'         => implode("|", $this->getCategorySlugs($product->extra_categories->pluck('id')->toArray())),
                        'is_bio'             => $product->is_bio,
                        'is_lv'              => $product->is_lv,
                        'is_suggested'       => $product->is_suggested,
                        'is_highlighted'     => $product->is_highlighted,
                        'unit_id'            => $product->unit->unit,
                        'variations'         => implode("|", $this->getVariations($product->variations->toArray())),
                        'marketdays'         => implode("|", $product->market_days->pluck('id')->toArray()),
                        'attributes'         => implode("|", $this->getAttributes($product->attributes()->get(), $product)),
                    ];
                } else {
                    $insertData = [
                        'sku'                => $product->sku,
                        'language'           => $language->code,
                        'name'               => $product->meta['name'][$language->code] ?? "",
                        'description'        => $product->meta['description'][$language->code] ?? "",
                        'ingredients'        => $product->meta['ingredients'][$language->code] ?? "",
                        'google_keywords'    => $product->meta['google_keywords'][language()] ?? "",
                        'google_description' => $product->meta['google_description'][language()] ?? "",
                    ];
                }

                $insertDataLine = [];
                foreach ($fieldOrder as $orderID => $unused) {
                    $insertDataLine[] = $insertData[$orderID] ?? " ";
                }
                $csv->insertOne($insertDataLine);
            }
        }

        $csvOutput = function () use ($csv) {
            echo $csv->getContent();
        };

        $fileName = 'product_export_' . now()->format('dmyHis') . '.csv';

        $response = new StreamedResponse();
        $response->headers->set('Content-Encoding', 'none');
        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');

        $disposition = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $fileName
        );
        $response->headers->set('Content-Disposition', $disposition);
        $response->headers->set('Content-Description', 'File Transfer');
        $response->setCallback($csvOutput);
        $response->send();
    }

    public function getCategorySlugs($categories)
    {
        return array_map(function ($item) { return $this->categories[$item]; }, $categories);
    }

    public function getVariations($variations)
    {
        return array_map(function ($item) { return $item['amount'] . ":" . $item['for_supplier']; }, $variations);
    }

    public function getAttributes($attributes, $product)
    {
        $attributeList = [];
        /** @var Attribute $attribute */
        foreach ($attributes as $attribute) {
            $attributeValues = $attribute->values()->whereHas('product', function (Builder $q) use ($product) { $q->where('product_id', $product->id); })->get()->pluck('id')->toArray();
            $attributeList[] = implode(":", [$this->getAttributeSlug($attribute->id), implode(",", $this->getAttributeValues($attributeValues))]);
        }

        return $attributeList;
    }

    public function getAttributeSlug($attribute)
    {
        return $this->attributes[$attribute] ?? "";
    }

    public function getAttributeValues($values)
    {
        return array_map(function ($value) { return $this->attribute_values[$value]; }, $values) ?? [];
    }
}