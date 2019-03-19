<?php

namespace App\Cache;


use App\Plugins\Pages\Functions\Components;
use App\Plugins\Pages\Model\PageComponentMeta;

class PageCache
{
    use Components;

    public $pageData;
    public $components = [];
    public $componentData = [];
    public $hasChildren = false;
    public $template;


    public function __construct($data) {
        $this->pageData = $data;
        $this->id = $data->id;
        $this->component_slug = $data->component_slug;
        $this->hasChildren = $data->hasChildren;
        $this->template = $data->templates->template;
        $this->createComponents();
    }

    private function createComponents() {
        $this->components = $this->pageData->components;
    }
}