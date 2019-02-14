<?php

namespace App\Cache;


use App\Plugins\Suppliers\Model\Supplier;

class SupplierCache
{

    private $imageUrl;
    private $name;
    private $metaData = [];
    private $products = [];
    private $metaFields = ['description', 'google_keywords', 'google_description', 'location'];
    private $coords;

    public $isFarmer;
    public $isCraftsman;
    public $isFeatured;

    public function __construct(Supplier $supplier) {
        $this->setImage($supplier);
        $this->setData($supplier);
        $this->setProducts($supplier);
    }

    private function setImage(Supplier $supplier) {
        $this->imageUrl = $supplier->image??config('supplier.defaultImage', asset('assets/img/tmp/photo-9.jpg'));
    }

    private function setData(Supplier $supplier) {
        foreach(languages() as $language) {
            foreach ($supplier->metaData()->whereIn('meta_name', $this->metaFields)->get() as $meta) {
                $this->metaData[$meta->meta_name][$language->code] = $meta->meta_value;
            }
        }
        $this->coods = $supplier->coords;
        $this->isCraftsman = $supplier->craftsman;
        $this->isFarmer = $supplier->farmer;
        $this->isFeatured = $supplier->featured;
    }

    private function setProducts(Supplier $supplier) {
        $this->products = $supplier->products()->pluck('id')->toArray();
    }

    public function getMeta($key, $language = false) {
        return $this->metaData[$key][$language]??$this->metaData[$key][language()]??"";
    }

    public function getImage() {
        return $this->imageUrl;
    }

}