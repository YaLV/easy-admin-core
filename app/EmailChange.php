<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailChange extends Model
{
    public $fillable = [
        'verifyString',
        'invokedBy',
        'changes',
        'joinUser',
        'state',
    ];

    public $casts = [
        'changes' => 'array'
    ];

    public static function boot()
    {
        self::created(function ($model) {
            \Artisan::call("email:changed", ["--request" => $model->id]);
        });

        parent::boot(); // TODO: Change the autogenerated stub
    }
}