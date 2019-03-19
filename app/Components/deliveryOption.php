<?php

namespace App\Components;


class deliveryOption
{
    public $componentName = "Delivery Option";

    public function form()
    {
        return [
            [
                'Label'     => "Display",
                'languages' => languages()->pluck('name', 'code'),
                'data'      => [
                    'title'         => ['type' => 'textarea', 'label' => 'Title', 'meta' => true],
                    'text'          => ['type' => 'textarea', 'label' => 'Text', 'meta' => true],
                    'cities'        => ['type' => 'textarea', 'label' => 'Cities (seperated by comma)', 'meta' => true],
                    'priceOpt1'     => ['type' => 'text', 'label' => 'Price Option 1', 'meta' => true],
                    'priceOpt1desc' => ['type' => 'textarea', 'label' => 'Price Option 1', 'meta' => true],
                    'priceOpt2'     => ['type' => 'text', 'label' => 'Price Option 2', 'meta' => true],
                    'priceOpt2desc' => ['type' => 'textarea', 'label' => 'Price Option 1', 'meta' => true],
                    'priceOpt3'     => ['type' => 'text', 'label' => 'Price Option 3', 'meta' => true],
                    'priceOpt3desc' => ['type' => 'textarea', 'label' => 'Price Option 1', 'meta' => true],
                ],
            ],
        ];
    }

    public function template()
    {
        return "frontend.components.deliveryOption";
    }
}