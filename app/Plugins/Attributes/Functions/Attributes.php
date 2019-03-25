<?php

namespace App\Plugins\Attributes\Functions;


use App\Plugins\Attributes\Model\Attribute;
use App\Plugins\Attributes\Model\AttributeValue;

/**
 * Trait Attributes
 *
 * @package App\Plugins\Attributes\Functions
 */
trait Attributes
{
    /**
     * @return array
     */
    public function getList()
    {
        return [
            ['field' => 'name', 'translate' => 'attributes.name', 'key' => 'id', 'label' => 'Attribute Name'],
            ['field' => 'buttons', 'buttons' => ['edit', 'delete'], 'label' => '',],
        ];
    }

    /**
     * @return array
     */
    public function form()
    {
        return [
            [
                'Label'     => 'Display',
                'languages' => languages()->pluck('name', 'code'),
                'data'      => [
                    'name' => ['type' => 'text', 'class' => 'slugify', 'label' => 'Attribute Name', 'meta' => true],
                    'slug' => ['type' => 'text', 'class' => 'slug', 'label' => 'Attribute Slug', 'readonly' => 'readonly', 'meta' => true],
                ],
            ],
            [
                'Label' => 'Values',
                'data'  => [
                    ['type' => 'view', 'class' => "Attributes::attributevalues"],
                ],
            ],
        ];
    }

    /**
     * @param $collection
     */
    public function attributeValues(Attribute $collection) {

        $currentValues = $collection->values()->pluck('id')->toArray();

        $removableValues = array_diff($currentValues,request('attributeValue'));

        AttributeValue::whereIn('id', $removableValues)->delete();

        /** @var AttributeValue $attributeValues */
        $attributeValues = AttributeValue::whereIn('id', request('attributeValue'));
        $attributeValues->update(['attribute_id' => $collection->id]);
    }
}