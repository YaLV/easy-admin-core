<?php

namespace App\Components;


class centeredText
{
    public $componentName = "Centered Text";

    public function form()
    {
        return [
            [
                'Label'     => "Display",
                'languages' => languages()->pluck('name', 'code'),
                'data'      => [
                    'centeredText' => ['type' => 'textarea', 'label' => 'Text', 'meta' => true],
                ],
            ],
        ];
    }

    public function template()
    {
        return "frontend.components.centeredText";
    }
}