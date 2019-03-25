<?php

namespace App\Components;


class blogposts
{
    public $componentName = "Blog Posts";
    public $disableEdit = true;

    public function template()
    {
        return "frontend.components.blogposts";
    }
}