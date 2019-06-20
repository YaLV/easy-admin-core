<?php

namespace App\Plugins\Banners\Functions;

use App\Plugins\Banners\BannerController;
use App\Plugins\Categories\Model\Category;

/**
 * Trait Banners
 *
 * @used-by BannerController
 * @package App\Plugins\Banners\Functions
 */
trait Banners
{
    public function getList()
    {
        return [
            ['field' => 'title', 'label' => 'Title'],
            ['field' => 'dates', 'label' => 'Date Range'],
            ['field' => 'type', 'label' => 'Tips'],
            ['field' => 'cat_list', 'label' => 'Category(-ies)'],
            ['field' => 'buttons', 'buttons' => ['edit', 'delete'], 'label' => ''],
        ];
    }

    public function form()
    {
        /** @var BannerController $this */
        $languages = languages()->pluck('name', 'code');
        if ($this->type == 'popup') {
            return [
                [
                    'Label' => 'Parameters',
                    'data'  => [
                        'type'       => ['type' => 'hidden'],
                        'title'      => ['type' => 'text', 'label' => 'Title'],
                        'dates'      => ['type' => 'text', 'class' => 'daterangepicker', 'label' => 'Date Range'],
                        'categories' => ['type' => 'select', 'multiple' => 'multiple', 'options' => Category::all(), 'dataAttr' => ['live-search' => 'true', 'width' => 'fit', "selected-text-format" => "count>5"], 'label' => 'Category(-ies)'],
                        'frequency'  => [
                            'type' => 'select', 'label' => 'Frequency', 'options' => [
                                (object)['id' => 'once_per_session', 'name' => 'Each Session'],
                                (object)['id' => 'once_a_week', 'name' => 'Once a Week'],
                            ],
                        ],
                    ],
                ],
                [
                    'Label'     => 'Content',
                    'languages' => $languages,
                    'data'      => [
                        'banner_image' => ['type' => 'image', 'preview' => true, 'label' => 'Picture', 'meta' => true],
                        'url'          => ['type' => 'text', 'label' => 'Url', 'meta' => true],
                        'target'       => [
                            'type' => 'select', 'label' => 'Url Target', 'options' => [
                                (object)['id' => '_self', 'name' => 'Same Window'],
                                (object)['id' => '_blank', 'name' => 'New Window'],
                            ],
                            'meta' => true,
                        ],
                    ],
                ],
            ];
        }

        return [
            [
                'Label' => 'Parameters',
                'data'  => [
                    'type'             => ['type' => 'hidden'],
                    'title'            => ['type' => 'text', 'label' => 'Title'],
                    'color_text'       => ['type' => 'colorpicker', 'label' => 'Text Color', 'id' => 'textColorSelector', 'default' => '000000'],
                    'color_url'        => ['type' => 'colorpicker', 'label' => 'Url Color', 'id' => 'urlColorSelector', 'default' => '1f9363'],
                    'color_background' => ['type' => 'colorpicker', 'label' => 'Background Color', 'id' => 'bgColorSelector', 'default' => 'f8ddc4'],
                    'color_preview'    => ['type' => 'colorpreview', 'label' => 'Preview', 'id' => 'colorPreview'],
                    'dates'            => ['type' => 'text', 'class' => 'daterangepicker', 'label' => 'Date Range'],
                    'categories'       => ['type' => 'select', 'multiple' => 'multiple', 'options' => Category::all(), 'dataAttr' => ['live-search' => 'true', 'width' => 'fit', "selected-text-format" => "count>5"], 'label' => 'Category(-ies)'],
                    'frequency'        => [
                        'type' => 'select', 'label' => 'Frequency', 'options' => [
                            (object)['id' => 'always', 'name' => 'Always'],
                            (object)['id' => 'once_per_session', 'name' => 'Each Session'],
                            (object)['id' => 'once_a_week', 'name' => 'Once a Week'],
                        ],
                    ],
                ],
            ],
            [
                'Label'     => 'Content',
                'languages' => $languages,
                'data'      => [
                    'message' => ['type' => 'textarea', 'label' => 'Message', 'meta' => true],
                ],
            ],
        ];
    }


}