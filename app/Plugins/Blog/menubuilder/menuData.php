<?php

namespace App\Plugins\Blog\menubuilder;


use App\Plugins\Blog\Model\Blog;

class menuData
{

    public static function getMenuItems()
    {
        $menuData = [
            'header' => [
                'name' => "Blog",
                'slug' => 'translations',
            ],
        ];

        $menuData['items'][] = 'blog';

        /**
         * This is to catch blog slug and name in translations - for multilanguage purposes
         */
        // __('translations.slug.blog')
        // __('translations.name.blog')

        return $menuData;
    }
}