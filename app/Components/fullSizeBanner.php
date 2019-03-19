<?php

namespace App\Components;


class fullSizeBanner
{

    public $componentName = "Full Width Banner";

    public function form()
    {
        return [
            [
                'Label'     => "Display",
                'languages' => languages()->pluck('name', 'code'),
                'data'      => [
                    'bannerHeader' => ['type' => 'text', 'label' => 'Banner Header', 'meta' => true],
                    'bannerText' => ['type' => 'text', 'label' => 'Banner Sub Text', 'meta' => true],
                ],
            ], [
                'Label' => 'Background Image',
                'data'  => [
                    'pageimage' => ['type' => 'image', 'preview' => 'true', 'label' => 'Banner'],
                ],
            ],
        ];
    }

    public function template() {
        return "frontend.components.fullSizeBanner";
    }

}