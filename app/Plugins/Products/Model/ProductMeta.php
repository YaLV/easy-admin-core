<?php
/**
 * Created by PhpStorm.
 * User: ya
 * Date: 1/21/19
 * Time: 3:14 PM
 */

namespace App\Plugins\Products\Model;


use App\BaseModel;

class ProductMeta extends BaseModel
{
    public $fillable = ['meta_name', 'meta_value', 'language', 'owner_id'];
}