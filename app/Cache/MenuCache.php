<?php

namespace App\Cache;


use App\Plugins\Menu\Model\FrontendMenu;

class MenuCache
{

    private $menuItems = [];
    private $tree = [];

    public function __construct($menuSlug)
    {
        $menuItems = FrontendMenu::where("slug", $menuSlug)->first() ?? new FrontendMenu();

        foreach ($menuItems->menuItems ?? [] as $item) {
            $this->menuItems[$item->id] = (object)[
                'slug'    => "{$item->menu_owner}.slug.{$item->owner_id}",
                'name'    => "{$item->menu_owner}.name.{$item->owner_id}",
                'parent'  => $item->frontend_menu_item_id,
                'urlType' => $item->menu_owner,
                'id'      => $item->owner_id,
            ];
            if (!($item->frontend_menu_item_id ?? false)) {
                $this->tree['first'][$item->sequence] = $item->id;
            } else {
                $this->tree[$item->frontend_menu_item_id][$item->sequence] = $item->id;
            }
        }
    }

    public function getItems($itemLevel = 'first', $autoParam = 'slug1')
    {
        if ($itemLevel == 'auto') {
            $itemLevel = $this->getItemId(request()->route($autoParam));
        }
        if(!is_array($this->tree[$itemLevel]??false)) return [];

        ksort($this->tree[$itemLevel]);

        return $this->tree[$itemLevel];
    }

    public function getItemId($routeParam, $type = "menuid", $strict = true)
    {
        $slugs = array_map(
            function ($a) use ($routeParam, $strict) {
                if($strict) {
                    return (__($a->slug) == $routeParam && !($a->parent ?? false));
                }
                return __($a->slug) == $routeParam;
            },
            $this->menuItems
        );

        $result = array_search(true, $slugs);
        if($type=='menuid') {
            return $result;
        }
        return $this->menuItems[$result]->id??"";
    }

    public function hasChildren($item)
    {
        return count($this->tree[$item] ?? []) > 0;
    }

    public function getName($item)
    {
        return __($this->menuItems[$item]->name);
    }

    public function getSlug($item)
    {
        return __($this->menuItems[$item]->slug);
    }

    public function getUrl($item)
    {
        $menuItem = $this->menuItems[$item];
        $menuItems = $this->getHierarchy($menuItem);

        return r("url" . isDefaultLanguage(), $menuItems);
    }

    private function getHierarchy($item, $level = 7)
    {
        if (!($item->slug ?? false)) return [];
        $nextLevel = $level - 1;

        return array_merge(["slug$level" => __($item->slug)], $this->getHierarchy($this->menuItems[$item->parent] ?? [], $nextLevel));
    }

    public function getCurrentId() {
        $x=8;
        do {
            $x--;
        } while(request()->route('slug'.$x)==null || $x==0);

        return $this->getItemId(request()->route('slug'.$x), 'menuid', false);
    }

    public function getCurrentCatId() {
        $x=8;
        do {
            $x--;
        } while(request()->route('slug'.$x)==null || $x==0);

        return $this->getItemId(request()->route('slug'.$x), 'catId', false);
    }
}