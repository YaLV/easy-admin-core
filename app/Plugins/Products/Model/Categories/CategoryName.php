<?php

namespace App\Plugins\Products\Model\Categories;

use Illuminate\Database\Eloquent\Model;

class CategoryName extends Model
{
    public $fillable = ['category_name', 'category_id', 'language'];
}
