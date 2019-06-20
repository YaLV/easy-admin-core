<?php

namespace App;

use App\Cache\PromoCache;
use App\Http\Controllers\CacheController;
use App\Plugins\Orders\Model\OrderHeader;
use App\Plugins\UserGroups\Model\UserGroup;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

/**
 * Class User
 *
 * @package App
 */
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
        'address_comments'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Get all discounts for products, using current user
     *
     * @return int
     */
    public function discount($product = false, $category = false, $getName = false)
    {

        if(!$product || !$category) { return 0; }

        $pc = (new CacheController)->getPromotions();

        $discSeperated = [$pc->getKeyValuePair('product', $product, $this->user_group_id), $pc->getKeyValuePair('category', $category, $this->user_group_id)];
        $disc = max($discSeperated);

        if($getName) {
            return $pc->promotionNames[key($disc)] ?? "Unknown Name";
        }

        return current($disc);
    }

    /**
     * Get user cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cart()
    {
        return $this->hasMany(OrderHeader::class);
    }

    public function orders($id = null) {
        $relation = $this->hasMany(OrderHeader::class)->where('state', '!=', 'draft');

        if($id) {
            return $relation->where('id', $id);
        }
        return $relation;
    }

    /**
     * return if
     *
     * @return bool
     */
    public function isAnonimous()
    {
        return ($this->id ?? false) == 99;
    }

    /**
     * @return mixed
     */
    public function isAdmin() {
        return $this->isAdmin;
    }

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getFullNameAttribute() {
        return $this->name." ".$this->last_name;
    }

    /**
     * @param array $requestData
     *
     * @return User
     */
    public function updateUser(array $requestData) {

        if(($requestData['id']??false)) {
            $userFind['id'] = $requestData['id'];
        } else {
            $isInUsers = User::where(['email' => request('email'), 'registered' => 0])->first();
            $userFind['id'] = $isInUsers?$isInUsers->id:null;
        }
        $requestData['registered'] = 1;

        return User::updateOrCreate($userFind, $requestData);

    }

    public function group() {
        return $this->belongsTo(UserGroup::class, 'user_group_id', 'id');
    }
}
