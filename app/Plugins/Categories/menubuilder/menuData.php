<?php

namespace App\Plugins\Categories\menubuilder;


use App\Plugins\Categories\Model\Category;

class menuData
{

    public static function getMenuItems()
    {
        $menuData = [
            'header' => [
                'name' => "Categories",
                'slug' => 'category',
            ],
        ];

        foreach(Category::all() as $category) {
            $menuData['items'][] = $category->id;
        }

        return $menuData;
    }
}