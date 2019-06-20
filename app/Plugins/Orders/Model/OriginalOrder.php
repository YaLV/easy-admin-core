<?php

namespace App\Plugins\Orders\Model;

use Illuminate\Database\Eloquent\Model;

class OriginalOrder extends Model
{
    public $fillable = ['id', 'headers', 'items'];
    public $incrementing = false;
    public $casts = [
        'headers' => 'array',
        'items' => 'array',
    ];

}
