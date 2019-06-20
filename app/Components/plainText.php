<?php

namespace App\Components;


class plainText
{
    public $componentName = "Plain Text";

    public function form()
    {


        return [
            [
                'Label'     => "Plain Text",
                'languages' => languages()->pluck('name', 'code'),
                'data'      => [
                    'content' => ['type' => 'textarea', 'label' => 'Page Content', 'meta' => true],
                ],
            ],
        ];
    }

    public function template()
    {
        return "frontend.components.plainText";
    }
}