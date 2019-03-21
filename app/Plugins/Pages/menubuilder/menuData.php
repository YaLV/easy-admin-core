<?php

namespace App\Plugins\Pages\menubuilder;


use App\Plugins\Pages\Model\Page;

class menuData
{

    public static function getMenuItems()
    {
        $menuData = [
            'header' => [
                'name' => "Pages",
                'slug' => 'pages',
            ],
        ];

        foreach(Page::all() as $page) {
            $menuData['items'][] = $page->id;
        }

        return $menuData;
    }
}