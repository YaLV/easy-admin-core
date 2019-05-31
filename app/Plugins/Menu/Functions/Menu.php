<?php

namespace App\Plugins\Menu\Functions;

use App\Plugins\Menu\Model\FrontendMenu;
use App\Plugins\Menu\Model\FrontendMenuItem;
use \Illuminate\Support\Facades\Route;

trait Menu
{

    public function form()
    {
        $defaults = [
            'data' => [
                'name'  => ['type' => 'text', 'label' => 'Menu Name', 'class' => 'slugify'],
                'slug'  => ['type' => 'text', 'label' => 'Menu slug', 'class' => '', 'readonly' => 'readonly'],
                'items' => ['type' => 'view', 'class' => 'Menu::menuBuilder'],
            ],
        ];

        if (preg_match("/add/", Route::currentRouteName())) {
            unset($defaults['data']['items']);
        }

        return $defaults;
    }

    public function getList()
    {
        return [
            ['field' => 'id', 'label' => '#'],
            ['field' => 'name', 'label' => 'Menu Name'],
            ['field' => 'slug', 'label' => 'Menu Slug'],
            ['field' => 'buttons', 'buttons' => ['edit', 'delete', 'state'], 'label' => ''],
        ];
    }

    public function handleMenuItems($collection)
    {

        $menuData = json_decode(request('menuContent'));

        $this->iterateMenuItems($menuData, $collection);
    }

    public function iterateMenuItems($menuData, $collection, $parent = null)
    {

        $sequence = 0;
        foreach ($menuData as $menuDataItem) {
            $item = FrontendMenuItem::updateOrCreate(['id' => $menuDataItem->id], ['frontend_menu_item_id' => $parent, 'sequence' => $sequence]);
            if (($menuDataItem->children ?? false)) {
                $itemId = $item->id;
                $this->iterateMenuItems($menuDataItem->children, $collection, $itemId);
            }
            $sequence++;
        }
    }

    public function removeMenuItems($item)
    {
        $subItems = $item->menuItems;
        if ($subItems) {
            foreach ($subItems as $subItem) {
                $this->removeMenuItems($subItem);
            }
        }
        $item->delete();
    }

    public function getEditName($id) {
        $fmenu = FrontendMenu::find($id);
        return $fmenu?$fmenu->name:"";
    }
}