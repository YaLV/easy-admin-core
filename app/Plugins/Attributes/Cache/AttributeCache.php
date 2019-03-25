<?php

namespace App\Plugins\Attributes\Cache;


/**
 * Trait AttributeCache
 *
 * @package App\Plugins\Attributes\Cache
 */
trait AttributeCache
{

    /**
     * @return \App\Cache\CategoryCache
     */
    public function getAttributeCache($attributeId) {
        $cache = $this->getCache('attributes-'.$attributeId)??$this->createAttributeCache($attributeId);

        return $cache;
    }

    /**
     * @param      $attribute
     * @param bool $forget
     *
     * @return \App\Cache\AttributeCache
     */
    public function createAttributeCache($attributeId, $forget = false) {
        if($forget) {
            $this->forgetCache('attributes-'.$attributeId);
        }

        $cacheData = new \App\Cache\AttributeCache($attributeId);

        $this->setCache('attributes-'.$attributeId, $cacheData);
        return $cacheData;
    }

}
