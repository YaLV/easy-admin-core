<?php

namespace App\Plugins\Categories\Functions;


use App\Languages;
use App\Plugins\Admin\Model\File;

trait Category
{
    public function getList()
    {
        return [
            ['field' => 'name', 'label' => 'Category Name', 'translate' => 'category.name', 'key' => 'id'],
            ['field' => 'slug', 'label' => 'Category Slug', 'translate' => 'category.slug', 'key' => 'id', 'meta' => true],
            ['field' => 'name', 'label' => 'Parent Category', 'translate' => 'category.name', 'key' => 'parent_id', 'meta' => true],
            ['field' => 'buttons', 'buttons' => ['edit', 'delete'], 'label' => ''],
        ];
    }

    public function form()
    {

        $categories = \App\Plugins\Categories\Model\Category::all();
        return [
            [
                'Label'     => 'Display',
                'languages' => Languages::all()->pluck('name', 'code'),
                'data'      => [
                    'name'        => ['type' => 'text', 'class' => 'slugify', 'label' => 'Category Name', 'meta' => true],
                    'slug'        => ['type' => 'text', 'class' => '', 'label' => 'Category Slug', 'readonly' => 'readonly', 'meta' => true],
                    'description' => ['type' => 'textarea', 'class' => '', 'label' => 'Description', 'meta' => true],
                ],
            ],
            [
                'Label'     => 'Google SEO',
                'languages' => Languages::all()->pluck('name', 'code'),
                'data'      => [
                    'google_keywords'    => ['type' => 'text', 'class' => '', 'label' => 'Keywords', 'meta' => true],
                    'google_description' => ['type' => 'textarea', 'class' => '', 'label' => 'Google Description', 'meta' => true],
                ],
            ],
            [
                'Label'     => 'Facebook OpenGraph',
                'languages' => Languages::all()->pluck('name', 'code'),
                'data'      => [
                    'og_title'       => ['type' => 'text', 'class' => '', 'label' => 'OpenGraph Title', 'meta' => true],
                    'og_description' => ['type' => 'textarea', 'class' => '', 'label' => 'OpenGraph Description', 'meta' => true],
                ],
            ],
            [
                'Label'     => 'Twitter Opengraph',
                'languages' => Languages::all()->pluck('name', 'code'),
                'data'      => [
                    'twiter_title'        => ['type' => 'text', 'class' => '', 'label' => 'Twitter Title', 'meta' => true],
                    'twitter_description' => ['type' => 'textarea', 'class' => '', 'label' => 'Twitter Description', 'meta' => true],
                ],
            ],
            [
                'Label' => 'Parameters',
                'data'  => [
                    'parent_id'      => ['type' => 'select', 'class' => 'show-tick',
                                         'options' => $categories,
                                         'label' => 'Parent Category', 'dataAttr' => ['live-search' => "true", 'size' => '5']],
                    'category_image' => ['type' => 'image', 'label' => 'Category Header Image', 'preview' => true],
//                    'filters'        => ['type' => 'chosen', 'label' => 'Filtri', 'options' => $categories],
                ],
            ],
        ];
    }

}