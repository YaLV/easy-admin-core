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
                    'priceOpt1'     => ['type' => 'text', 'label' => 'Option 1 Price', 'meta' => true],
                    'priceOpt1desc' => ['type' => 'textarea', 'label' => 'Option 1 Description', 'meta' => true],
                    'priceOpt2'     => ['type' => 'text', 'label' => 'Option 2 Price', 'meta' => true],
                    'priceOpt2desc' => ['type' => 'textarea', 'label' => 'Option 2 Description', 'meta' => true],
                    'priceOpt3'     => ['type' => 'text', 'label' => 'Option 3 Price', 'meta' => true],
                    'priceOpt3desc' => ['type' => 'textarea', 'label' => 'Option 3 Description', 'meta' => true],
                ],
            ],
        ];
    }

    public function template()
    {
        return "frontend.components.deliveryOption";
    }
}