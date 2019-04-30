<?php

namespace App\Cache;


use App\Plugins\Sales\Model\Sale;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PromoCache
{
    public $userGroups = [];
    public $category = [];
    public $product = [];
    public $promotions = [];

    public function __construct()
    {
        /** @var Sale $promo */
        $promo = Sale::where(function (Builder $q) {
            $q->where('valid_to', '>=', Carbon::now())
                ->orWhereNull('valid_to');
        })->where('valid_from', '<=', Carbon::now())
            ->get();

        $this->promotions = $promo->pluck('amount', 'id')->toArray();

        foreach ($promo as $promoItem) {
            if (is_array($promoItem->user_group)) {
                foreach ($promoItem->user_group as $user_group) {
                    if (!($this->userGroups[$user_group]??false)) {
                        $this->userGroups[$user_group] = [];
                    }
                    $this->userGroups[$user_group][] = $promoItem->id;
                }
            }

            $targets = json_decode($promoItem->getOriginal()['discount_target']);

            if (is_array($targets)) {
                $discount_target = $promoItem->discount_to;
                foreach ($targets as $target) {
                    if (!($this->$discount_target[$target]??false)) {
                        $this->$discount_target[$target] = [];
                    }
                    $this->$discount_target[$target][] = $promoItem->id;
                }
            }
        }
    }

    public function getDiscount($target, $id) {

        $ugroup = Auth::user()?Auth::user()->user_group:0;

        return array_only($this->promotions, $this->hasDiscount($target, $id, $ugroup));
    }

    public function hasDiscount($target, $id, $userGroup) {
        return array_intersect(($this->$target[$id]??[]), ($this->userGroups[$userGroup]??[]));
    }
}