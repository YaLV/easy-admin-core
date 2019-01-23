<?php

namespace App\Plugins\Products;


use App\Plugins\MarketDays\Model\MarketDay;
use App\Plugins\Products\Model\Product;
use App\Plugins\Products\Model\ProductVariation;
use App\Plugins\Units\Model\Unit;

trait Products
{
    public function form()
    {

        $categories = \App\Plugins\Categories\Model\Category::all();
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
                'Label'     => 'Facebook OpenGraph',
                'languages' => $languages,
                'data'      => [
                    'og_title'       => ['type' => 'text', 'class' => '', 'label' => 'OpenGraph Title', 'meta' => true],
                    'og_description' => ['type' => 'textarea', 'class' => '', 'label' => 'OpenGraph Description', 'meta' => true],
                ],
            ],
            [
                'Label'     => 'Twitter Opengraph',
                'languages' => $languages,
                'data'      => [
                    'twiter_title'        => ['type' => 'text', 'class' => '', 'label' => 'Twitter Title', 'meta' => true],
                    'twitter_description' => ['type' => 'textarea', 'class' => '', 'label' => 'Twitter Description', 'meta' => true],
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
                    'supplier'         => ['type' => 'select', 'label' => 'Supplier', 'options' => $categories],
                    'product_image'    => ['type' => 'image', 'label' => 'Product Image', 'preview' => true],
                ],
            ],
            [
                'Label' => 'Filters',
                'data'  => [
                    'filters' => ['type' => 'view', 'class' => 'Products::filters'],
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
            //['field' => 'deleted_at', 'label' => 'state', 'fn' => 'nullOrDate', 'results' => ['Active','Draft']],
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
            $unit = Unit::findOrFail($variation['unit_id'])->unit ?? "";
            $parts = [implode("", [$variation['amount'], $unit]), $this->calculatePrice()['result'] . "€"];
            $variation['display_name'] = implode(" / ", $parts);
        }

        return $variation;
    }

}