<?php

namespace App\Plugins\Suppliers\Cache;


use App\Plugins\Suppliers\Model\Supplier;

trait SupplierCache
{
    public function getSupplier($supplierId) {
        $cache = $this->getCache("supplier$supplierId")??$this->createSupplierCache($supplierId);

        return $cache;
    }

    public function createSupplierCache($supplierId, $forget = false) {

        if($forget) {
            $this->forgetCache("supplier$supplierId");
        }

        $supplier = Supplier::findOrFail($supplierId);

        $cacheData = new \App\Cache\SupplierCache($supplier);

        $this->setCache("supplier$supplierId", $cacheData);
        return $cacheData;
    }
}