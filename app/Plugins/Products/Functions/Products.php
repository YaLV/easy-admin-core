<?php

namespace App\Plugins\Products;


use App\Plugins\Attributes\Model\Attribute;
use App\Plugins\Attributes\Model\AttributeValue;
use App\Plugins\MarketDays\Model\MarketDay;
use App\Plugins\Products\Model\Product;
use App\Plugins\Products\Model\ProductVariation;
use App\Plugins\Suppliers\Model\Supplier;
use App\Plugins\Units\Model\Unit;
use App\Plugins\Vat\Model\Vat;

trait Products
{
    public function form()
    {

        $categories = \App\Plugins\Categories\Model\Category::all();
        $suppliers = Supplier::all();
        $languages = languages()->pluck('name', 'code');

        return [
            [
                'Label'     => 'Display',
                'languages' => $languages,
                'data'      => [
                    'name'        => ['type' => 'text', 'class' => 'slugify', 'label' => 'Product Name', 'meta' => true],
                    'slug'        => ['type' => 'text', 'class' => '', 'label' => 'Product Slug', 'readonly' => 'readonly', 'meta' => true],
                    'description' => ['type' => 'textarea', 'class' => '', 'label' => 'Description', 'meta' => true],
                    'ingredients' => ['type' => 'textarea', 'class' => '', 'label' => 'Ingredients', 'meta' => true],
                    'expire_date' => ['type' => 'text', 'class' => '', 'label' => 'Expire Info', 'meta' => true],
                ],
            ],
            [
                'Label'     => 'Google SEO',
                'languages' => $languages,
                'data'      => [
                    'google_keywords'    => ['type' => 'text', 'class' => '', 'label' => 'Keywords', 'meta' => true],
                    'google_description' => ['type' => 'textarea', 'class' => '', 'label' => 'Google Description', 'meta' => true],
                ],
            ],

            [
                'Label' => 'Parameters',
                'data'  => [
                    'sku'              => ['type' => 'text', 'class' => '', 'label' => 'Product Code'],
                    'state'            => ['type' => 'switch', 'class' => '', 'label' => 'State'],
                    'is_bio'           => ['type' => 'switch', 'class' => '', 'label' => 'Bio'],
                    'is_lv'            => ['type' => 'switch', 'class' => '', 'label' => 'Latvian'],
                    'is_suggested'     => ['type' => 'switch', 'class' => '', 'label' => 'Suggested'],
                    'is_highlighted'   => ['type' => 'switch', 'class' => '', 'label' => 'Highlighted'],
                    'main_category'    => ['type' => 'select', 'label' => 'Main Category', 'options' => $categories],
                    'extra_categories' => ['type' => 'chosen', 'label' => 'Extra Categories', 'options' => $categories],
                    'market_days'      => ['type' => 'chosen', 'label' => 'Market Day(-s)', 'options' => MarketDay::all()],
                    'supplier_id'      => ['type' => 'select', 'label' => 'Supplier', 'options' => $suppliers],
                    'product_image'    => ['type' => 'image', 'label' => 'Product Image', 'preview' => true],
                ],
            ],
            [
                'Label' => 'Prices',
                'data' => [
                    'cost'             => ['type' => 'text', 'class' => '', 'label' => 'Cost'],
                    'mark_up'          => ['type' => 'text', 'class' => '', 'label' => 'Mark Up'],
                    'vat_id'           => ['type' => 'select', 'class' => '', 'label' => 'Vat', 'options' => Vat::all()],
                    'unit_id'          => ['type' => 'select', 'class' => 'set_unit_id', 'label' => 'Measurement Unit', 'options' => Unit::all()],
                ]
            ],
            [
                'Label' => 'Attributes',
                'data'  => [
                    'filters' => ['type' => 'view', 'class' => 'Products::attributes'],
                ],
            ],
            [
                'Label' => 'Prices/Variations',
                'data'  => [
                    'price' => ['type' => 'view', 'class' => 'Products::specifications'],
                ],
            ],
        ];
    }

    public function getList()
    {
        return [
            ['field' => 'sku', 'label' => 'Product Code'],
            ['field' => 'name', 'label' => 'Product Name', 'translate' => 'product.name', 'key' => 'id'],
            ['field' => 'slug', 'label' => 'Product Slug', 'translate' => 'product.slug', 'key' => 'id'],
            ['field' => 'supplier_id', 'label' => 'Supplier', 'translate' => 'supplier.name', 'key' => 'supplier_id'],
            ['field' => 'buttons', 'buttons' => ['edit', 'state', 'delete'], 'label' => '',],
        ];
    }

    public function setVariations(Product $collection)
    {
        $variations = request('variation');

        foreach (ProductVariation::findMany($variations) as $variation) {
            $variation->product_id = $collection->id;
            $variation->save();
        }
    }

    public function addCategories(Product $collection)
    {
        $categories = array_unique(array_merge([request('main_category')], (request('extra_categories') ?? [])));
        $collection->extra_categories()->sync($categories);
    }

    public function addMarketDays(Product $collection)
    {
        $marketdays = request('market_days');
        $collection->market_days()->sync($marketdays);
    }


    public function withoutID(array $variation)
    {
        unset($variation['id']);

        return $this->makeDisplayName($variation);
    }

    public function makeDisplayName(array $variation)
    {
        if (!($variation['display_name'] ?? false)) {
            $unit = Unit::findOrFail(request('unit_id')) ?? "";

            if($unit->subUnit()->count()) {
                $unit = $unit->subUnit;
                $displayName = (request('amount')*$unit->parent_amount).$unit->unit;
            }
            $variation['display_name'] = $displayName??request('amount').$unit->unit;
        }

        return $variation;
    }

    public function getAttributes()
    {
        $options = [];
        $attribute = Attribute::findOrFail(request('attribute'));

        $allValues = $attribute->values;
        $selectedValues = $attribute->values()->whereHas('product', function ($q) {
            $q->where('product_id', request('product'));
        })->get()->pluck('id')->toArray();

        foreach ($allValues as $attributeValue) {
            $options[] = [
                'name'     => __("attributevalues.name.{$attributeValue->id}"),
                "id"       => $attributeValue->id,
                'selected' => in_array($attributeValue->id, $selectedValues),
            ];
        }

        return ['status' => true, 'noMessage' => true, 'options' => $options, "attribute" => $attribute->id];
    }

    public function formatAttributes()
    {
        $attribute = Attribute::findOrFail(request('attributeSel'));

        $attributeValues = AttributeValue::findMany(request('attributeValuesSel'));

        if ($attributeValues->count() == 0) {
            return ['status' => true, 'remove' => true, 'attributeId' => $attribute->id];
        }

        return [
            'status'      => true,
            'attributeId' => $attribute->id,
            'data'        => view('Products::attribute',
                [
                    'attribute'          => $attribute,
                    'selectedAttributes' => $attributeValues,
                ])->render(),
            'message'     => 'Changes to Attribute have been made',
        ];

    }
}