<?php

namespace App\Plugins\UserGroups\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    public $fillable = ['name', 'min_orders'];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function getUserCountAttribute() {
        return $this->users()->count();
    }

}
