<?php

namespace App\Components;


class featuredSupplier
{
    public $componentName = "Featured Supplier";
    public $disableEdit = true;

    public function template()
    {
        return "frontend.components.featuredSupplier";
    }
}