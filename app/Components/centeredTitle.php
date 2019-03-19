<?php

namespace App\Components;


class centeredTitle
{
    public $componentName = "Centered Title";

    public function form()
    {
        return [
            [
                'Label'     => "Display",
                'languages' => languages()->pluck('name', 'code'),
                'data'      => [
                    'title' => ['type' => 'text', 'label' => 'Title', 'meta' => true],
                ],
            ],
        ];
    }

    public function template()
    {
        return "frontend.components.centeredTitle";
    }
}