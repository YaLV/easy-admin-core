<?php

namespace App;

use App\Plugins\Orders\Model\OrderHeader;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'username',
        'name',
        'last_name',
        'email',
        'email_verified_at',
        'password',
        'registered',
        'phone',
        'is_legal',
        'legal_name',
        'legal_address',
        'legal_reg_nr',
        'legal_vat_reg_nr',
        'address',
        'city',
        'postal_code',
        'newsletter',
        'isAdmin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function discount()
    {
        return 0;
    }

    public function cart()
    {
        return $this->hasMany(OrderHeader::class);
    }

    public function isAnonimous()
    {
        return ($this->id ?? false) == 99;
    }
}
