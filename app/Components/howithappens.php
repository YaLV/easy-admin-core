<?php

namespace App\Components;


class howithappens
{
    public $componentName = "How It Happens";

    public function form()
    {
        return [
            [
                'Label'     => "Display",
                'languages' => languages()->pluck('name', 'code'),
                'data'      => [
                    'howheader'           => ['type' => 'text', 'label' => 'Section Header', 'meta' => true],
                    'howdescription'      => ['type' => 'textarea', 'label' => 'Section Description', 'meta' => true],
                    'howstep1title'       => ['type' => 'text', 'label' => 'Step 1 Header', 'meta' => true],
                    'howstep1description' => ['type' => 'textarea', 'label' => 'Step 1 Description', 'meta' => true],
                    'howstep2title'       => ['type' => 'text', 'label' => 'Step 2 Header', 'meta' => true],
                    'howstep2description' => ['type' => 'textarea', 'label' => 'Step 2 Description', 'meta' => true],
                    'howstep3title'       => ['type' => 'text', 'label' => 'Step 3 Header', 'meta' => true],
                    'howstep3description' => ['type' => 'textarea', 'label' => 'Step 3 Description', 'meta' => true],
                ],
            ],
            [
                'Label' => "Background",
                'data'  => [
                    'pageimage' => ['type' => 'image', 'preview' => 'true', 'label' => 'Background Image'],
                ],
            ],
        ];
    }

    public function template()
    {
        return "frontend.components.howithappens";
    }
}