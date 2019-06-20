<?php

namespace App\Components;


class pickupMap
{
    public $componentName = "Centered Text";

    public function form()
    {
        return [
            [
                'Label'     => "Marker Data",
                'languages' => languages()->pluck('name', 'code'),
                'data'      => [
                    'coordinates' => ['type' => 'text', 'label' => 'Text', 'meta' => true],
                ],
            ],
        ];
    }

    public function template()
    {
        return "frontend.components.pickupMap";
    }
}