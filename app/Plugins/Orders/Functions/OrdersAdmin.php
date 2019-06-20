<?php

namespace App\Plugins\Orders\Functions;

use App\Plugins\Orders\Model\OrderHeader;
use Carbon\Carbon;

/**
 * Trait OrdersAdmin
 *
 * @used-by OrderHeader
 * @package App\Plugins\Orders\Functions
 */
trait OrdersAdmin
{

    public $buyerData;
    public $states = ['ordered' => 'New', 'cancelled' => 'Canceled', 'finished' => 'Finished', 'draft' => 'Cart'];
    public $isOriginal = false;


    /**
     * @return string
     */
    public function getCheckAttribute() {
        /** @var OrderHeader $this */
        return "<input type='checkbox' name='massAction' class='massAction' value='{$this->id}' />";
    }

    public function getUserFullNameAttribute() {
        /** @var  OrderHeader $this  */
        return $this->buyer->full_name;
    }

    public function getUserEmailAttribute() {
        /** @var  OrderHeader $this  */
        return $this->buyer->email;
    }

    public function getUserPhoneAttribute() {
        /** @var  OrderHeader $this  */
        return $this->buyer->phone;
    }

    public function getUserGroupAttribute() {
        /** @var  OrderHeader $this  */
        return $this->buyergroup()->name;
    }

    public function getUserCommentAttribute() {
        /** @var  OrderHeader $this  */
        return $this->buyer->comments;
    }

    public function getStateSelectorAttribute() {
        return $this->stateSelect();
    }

    public function stateSelect($classes = "") {
        /** @var  OrderHeader $this  */
        if($this->isOriginal) {
            return $this->states[$this->state];
        }
        $opts = [];
        foreach($this->states as $opt => $optName) {
            $opts[] = "<option value='$opt' ".($this->state==$opt?"selected":"").">$optName</option>";
        }

        return "<select name='state' class='changeState {$classes}' data-url='".route('orders.changeState', [$this->id])."'>".implode("",$opts)."</select>";
    }

    public function getStateSelectpickerAttribute() {
        return $this->stateSelect("selectpicker");
    }

    public function getOrderSumAttribute() {
        /** @var  OrderHeader $this  */
        $sum = getCartTotals($this);
        return $sum->toPay." &euro;";
    }

    public function getPaidAmountAttribute() {
        /** @var  OrderHeader $this  */
        if($this->isOriginal) {
            return $this->paid." &euro;";
        }
        return "<input type='text' value='{$this->paid}' size='4' class='paidinput' id='paid{$this->id}' data-origvalue='{$this->paid}' />&euro; <a href='".route('orders.setpaid', [$this->id])."' class='setPaid btn btn-xs btn-success invisible'><i class='fas fa-check'></i></a>";
    }

    public function getPaidAmountTextAttribute() {
        /** @var  OrderHeader $this  */
        return ($this->paid??0);
    }

    public function getPaymentAttribute() {
        /** @var  OrderHeader $this  */
        return config('app.paymentNames.'.$this->payment_type);
    }

    public function getMarketDayAttribute() {
        /** @var  OrderHeader $this  */
        return $this->order_market_day->marketDay[language()];
    }

    public function getMarketDayDateFormattedAttribute(){
        /** @var  OrderHeader $this  */
        return Carbon::createFromTimeString($this->market_day_date)->format('d.m.Y');
    }

    public function getOrderedAtFormattedAttribute(){
        /** @var  OrderHeader $this  */
        $oa = is_array($this->ordered_at)?$this->ordered_at['date']:$this->ordered_at;
        return Carbon::createFromTimeString($oa)->format('d.m.Y H:i:s');
    }

    public function getSelectedDeliveryAttribute()
    {
        /** @var OrderHeader $this */
        $marketDayDeliveries = $this->order_market_day->deliveries()->get();
        $md = Carbon::createFromFormat("d.m.Y", $this->market_day_date_formatted);
        $mdopt = [];
        $deliveryTypes = ['local' => 'Collect at warehouse', 'delivery' => 'Delivery to address'];

        if($this->isOriginal) {
            $delivery = $this->delivery;
            $dt = $md->copy();
            $modifiedMD = $dt->addDays($delivery->deliveryTime ?? 0);
            $mdDate = $modifiedMD->format('j');
            $month = __("translations." . $modifiedMD->format('F'));
            $dayName = __("translations." . $modifiedMD->format('l'));

            return __('translations.marketDayDeliveryText', ["dayname" => $dayName, 'date' => $mdDate, 'month' => $month]);
        }


        foreach ($marketDayDeliveries as $delivery) {
            $dt = $md->copy();
            $modifiedMD = $dt->addDays($delivery->deliveryTime ?? 0);
            $mdDate = $modifiedMD->format('j');
            $month = __("translations." . $modifiedMD->format('F'));
            $dayName = __("translations." . $modifiedMD->format('l'));
            $sel = $delivery->id==$this->delivery_id?"selected":"";

            $deliveryType = $deliveryTypes[$delivery->type];
            $mdopt[] = "<option value='{$delivery->id}' $sel>".__('translations.marketDayDeliveryText', ["dayname" => $dayName, 'date' => $mdDate, 'month' => $month])." ($deliveryType)</option>";
        }

        return "<select name='delivery' data-url='".route('orders.changeDelivery', [$this->id])."' class='changeDelivery selectpicker'>".implode(" ",$mdopt)."</select>";
    }

    public function getOrderIdAttribute() {
        /** @var OrderHeader $this */
        return implode("-",[$this->id, implode("#", [Carbon::createFromTimeString($this->ordered_at)->timestamp, $this->market_day_id])]);
    }

    public function getInvoiceUrlAttribute() {
        /** @var OrderHeader $this */
        return "<a href='".route("getInvoice", [$this->invoice])."'>{$this->invoice}</a>";
    }

    public function getCommentsAttribute($value) {
        /** @var OrderHeader $this */
        if($this->isOriginal) {
            return $value;
        }
        return "<textarea name='comments' class='noEditor autosave' style='width:100%;height:100px;' data-id='".$this->id."'>$value</textarea>";
    }

    public function getSvaigiCommentInvoiceAttribute($value) {
        /** @var OrderHeader $this */
        if($this->isOriginal) {
            return $value;
        }
        return "<textarea name='svaigi_comment_invoice' class='noEditor autosave' data-id='".$this->id."' style='width:100%;height:100px;'>$value</textarea>";
    }

    public function getSvaigiCommentStatsAttribute($value) {
        /** @var OrderHeader $this */
        if($this->isOriginal) {
            return $value;
        }
        return "<textarea name='svaigi_comment_stats' class='noEditor autosave' data-id='".$this->id."' style='width:100%;height:100px;'>$value</textarea>";
    }
}