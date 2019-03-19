<?php

namespace App\Plugins\Pages\Functions;


use App\Plugins\Admin\Model\File;

class PageComponentFactory
{
    public $metaData;
    public $images;
    public $pageimage;
    public $pageimage1;
    public $pageimage2;
    public $pageimage3;

    public function __construct($metaData, $images) {
        $this->meta = $metaData;
        $this->images = $images;
        $this->getPageImages();
    }

    public function getPageImages() {
        $this->pageimage = File::whereIn('id', $this->images)->where('owner', 'pageimage')->get();
        $this->pageimage1 = File::whereIn('id', $this->images)->where('owner', 'pageimage1')->get();
        $this->pageimage2 = File::whereIn('id', $this->images)->where('owner', 'pageimage2')->get();
        $this->pageimage3 = File::whereIn('id', $this->images)->where('owner', 'pageimage3')->get();
    }
}