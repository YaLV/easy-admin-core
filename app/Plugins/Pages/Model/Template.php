<?php

namespace App\Plugins\Pages\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    public $fillable = ['name', 'template'];

    public static function boot()
    {
        static::addGlobalScope('order', function(Builder $builder) {
            $builder->orderBy('name', 'asc');
        });

        parent::boot();
    }

    public function page() {
        return $this->hasMany(Page::class, 'template');
    }
}
