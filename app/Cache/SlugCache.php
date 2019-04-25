<?php

namespace App\Cache;


class SlugCache
{

    private $slugs = [];

    public function __construct()
    {
        $this->actions = [
            'App\Plugins\Products\Model\Product'    => 'showProduct',
            'App\Plugins\Categories\Model\Category' => 'showCategory',
        ];

        foreach ($this->actions as $type => $action) {
            $slugList = (new $type)->metaLanguage(['slug']) ?? [];
            foreach ($slugList['slug'] as $slugId => $slug) {
                $this->slugs[$slug] = ['action' => $action, 'id' => $slugId];
            }
        }
        $this->slugs[config('app.searchSlug', 'search')] = ["action" => 'showCategory', 'id' => 0];
    }

    public function findAction()
    {
        $lastAction = "showHome";
        foreach (range(1,7) as $paramOrder) {
            $slug = request()->route(implode("",["slug", $paramOrder]));
            if($slug??false) {
                if (!($this->slugs[$slug] ?? false)) {
                    return null;
                }
                $lastAction = ["action" => $this->slugs[$slug]['action'], "slug" => $slug, "id" => $this->slugs[$slug]['id']];
            } else {
                break;
            }
        }
        return $lastAction;
    }

    public function getSlugs() {
        return $this->slugs;
    }
}