<?php

namespace App\Components;


class doubleBanner
{

    public $componentName = "Double Banner";

    public function form()
    {
        return [
            [
                'Label'     => "Display",
                'languages' => languages()->pluck('name', 'code'),
                'data'      => [
                    'leftBannerTitle'  => ['type' => 'text', 'label' => 'Left Banner Text', 'meta' => true],
                    'leftBannerUrl'    => ['type' => 'text', 'label' => 'Left Banner Url', 'meta' => true],
                    'rightBannerTitle' => ['type' => 'text', 'label' => 'Right Banner Text', 'meta' => true],
                    'rightBannerUrl'   => ['type' => 'text', 'label' => 'Right Banner Url', 'meta' => true],
                ],

            ], [
                'Label' => 'Images',
                'data'  => [
                    'pageimage1'  => ['type' => 'image', 'preview' => 'true', 'label' => 'Left Banner'],
                    'pageimage2' => ['type' => 'image', 'preview' => 'true', 'label' => 'Right Banner'],
                ],
            ],
        ];
    }

    public function template() {
        return "frontend.components.doubleBanner";
    }
}