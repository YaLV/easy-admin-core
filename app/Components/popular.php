<?php

namespace App\Components;


class popular
{
    public $componentName = "Popular Products";
    public $disableEdit = true;

    public function template()
    {
        return "frontend.components.popular";
    }
}