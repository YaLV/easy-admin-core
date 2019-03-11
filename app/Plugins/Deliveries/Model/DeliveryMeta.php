<?php

namespace App\Plugins\Deliveries\Model;

use Illuminate\Database\Eloquent\Model;

class DeliveryMeta extends Model
{
    public $fillable = ['meta_name', 'meta_value', 'language', 'owner_id'];

    public function delivery() {
        return $this->belongsTo(Delivery::class, 'owner_id');
    }
}
