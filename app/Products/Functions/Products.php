<?php

namespace App\Plugins\Products\Functions;


use App\Plugins\Products\Model\AttributeSets;

trait Products
{
    public function form($attributeSet = false): array
    {
        $default = [
            [
                'Label' => 'Basic Information',
                'data'  => [
                    'sku'           => ['type' => 'text', 'class' => 'checkSku', 'label' => 'SKU'],
                    'attribute_set' => ['type' => 'select', 'class' => '', 'label' => 'Attribute Set', 'options' => $this->attributeSets()],
                ],
            ],
            [
                'Label'     => 'Descriptions (Multilanguage Content)',
                'languages' => ['lv' => 'Latviešu', 'ru' => 'Krievu', 'en' => 'Angļu'],
                'data'      => [
                    'name'        => ['type' => 'text', 'class' => '', 'label' => 'Name'],
                    'excerpt'     => ['type' => 'textarea', 'class' => '', 'label' => 'Excerpt', 'dataAttr' => ['id' => 10]],
                    'Description' => ['type' => 'textarea', 'class' => '', 'label' => 'Description'],
                ],

            ],
            [
                'Label' => 'Prices',
                'data'  => [
                    'price'      => ['type' => 'text', 'class' => '', 'label' => 'Price', 'dataAttr' => ['id' => 10]],
                    'isSale'     => ['type' => 'switch', 'class' => '', 'label' => 'Sale', 'value' => '1'],
                    'sale_price' => ['type' => 'text', 'class' => '', 'label' => 'Sale Price', 'depends' => 'isSale:1'],
                    'sale_from'  => ['type' => 'text', 'class' => '', 'label' => 'Sale From', 'depends' => 'isSale:1'],
                    'sale_to'    => ['type' => 'text', 'class' => '', 'label' => 'Sale To', 'depends' => 'isSale:1'],
                    'test'       => [
                        'type' => 'radio', 'class' => '', 'label' => 'TEST', 'options' => [
                            ['value' => '1', 'label' => 'one', 'data' => ['id' => 1]],
                            ['value' => '2', 'label' => 'two', 'data' => ['id' => 2]],
                            ['value' => '3', 'label' => 'three', 'data' => ['id' => 3]],
                            ['value' => '4', 'label' => 'four', 'data' => ['id' => 4]],
                        ],
                    ],
                ],
            ],
        ];


        $attributes = $this->attributes($attributeSet);

        return array_merge($default, $attributes);
    }

    public function getList()
    {
        return [
            ['field' => 'id', 'label' => 'ID'],
            ['field' => 'sku', 'label' => 'SKU'],
            ['type' => 'translate', 'label' => 'Nosaukums', 'field' => 'id', 'use' => 'product.productName.'],
            ['field' => 'buttons', 'buttons' => ['edit', 'delete', 'statistics'], 'label' => ''],
        ];
    }

    public function attributeSets()
    {
        return AttributeSets::all()->pluck('name', 'id');
    }

    public function attributes($attributeSet): array
    {
        if (!$attributeSet)
            return [];

        $attributesInSet = AttributeSets::find($attributeSet)->attributes();
        if (!$attributesInSet)
            return [];

        return $this->makeAttributes($attributesInSet);
    }

    public function makeAttributes($attributes): array
    {
        $attributeFields = [];
        foreach ($attributes as $attribute) {
            $attributeFields[] = [
                'type'  => $attribute->type,
                'class' => $attribute->class,
                'label' => $attribute->name,
            ];
        }

        return $attributeFields;
    }


}