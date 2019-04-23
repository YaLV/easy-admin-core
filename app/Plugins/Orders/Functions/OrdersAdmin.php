<?php

namespace App\Plugins\Orders\Functions;

use App\Plugins\Orders\Model\OrderHeader;
use Carbon\Carbon;


trait OrdersAdmin
{
    public $buyerData;
    public $states = ['ordered' => 'New', 'cancelled' => 'Canceled', 'finished' => 'Finished', 'draft' => 'Cart'];


    public function getCheckAttribute() {
        return "<input type='checkbox' name='massAction' class='massAction' value='{$this->id}' />";
    }

    public function getUserFullNameAttribute() {
        /** @var $this OrderHeader */
        return $this->buyer->full_name;
    }

    public function getUserEmailAttribute() {
        /** @var $this OrderHeader */
        return $this->buyer->email;
    }

    public function getUserPhoneAttribute() {
        /** @var $this OrderHeader */
        return $this->buyer->phone;
    }

    public function getUserGroupAttribute() {
        /** @var $this OrderHeader */
        return $this->buyergroup()->name;
    }

    public function getUserCommentAttribute() {
        /** @var $this OrderHeader */
        return $this->buyer->comment;
    }


    public function getStateSelectorAttribute() {
        return $this->stateSelect();
    }

    public function stateSelect($classes = "") {
        /** @var $this OrderHeader */
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
        $sum = getCartTotals($this);
        return $sum->toPay." &euro;";
    }

    public function getPaidAmountAttribute() {
        /** @var $this OrderHeader */
        return "<input type='text' value='{$this->paid}' size='4' class='paidinput' id='paid{$this->id}' data-origvalue='{$this->paid}' />&euro; <a href='".route('orders.setpaid', [$this->id])."' class='setPaid btn btn-xs btn-success invisible'><i class='fas fa-check'></i></a>";
    }

    public function getPaidAmountTextAttribute() {
        /** @var $this OrderHeader */
        return ($this->paid??0);
    }

    public function getPaymentAttribute() {
        return config('app.paymentNames.'.$this->payment_type);
    }

    public function getMarketDayAttribute() {
        /** @var $this OrderHeader */
        return $this->order_market_day->marketDay[language()];
    }

    public function getMarketDayDateFormattedAttribute($value){
        return Carbon::createFromTimeString($this->market_day_date)->format('d.m.Y');
    }

    public function getOrderedAtFormattedAttribute(){
        return Carbon::createFromTimeString($this->ordered_at)->format('d.m.Y H:i:s');
    }

    public function getSelectedDeliveryAttribute()
    {
        /** @var $this OrderHeader */
        $marketDayDeliveries = $this->order_market_day->deliveries()->get();
        $md = Carbon::createFromFormat("d.m.Y", $this->market_day_date_formatted);
        $mdopt = [];
        $deliveryTypes = ['local' => 'Collect at warehouse', 'delivery' => 'Delivery to address'];


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
        return implode("-",[$this->id, implode("#", [Carbon::createFromTimeString($this->ordered_at)->timestamp, $this->market_day_id])]);
    }

    public function getInvoiceUrlAttribute() {
        return "<a href='#'>{$this->invoice}</a>";
    }

    public function getCommentsAttribute($value) {
        return "<textarea name='comments' class='noEditor' style='width:100%;height:100px;'>$value</textarea>";
    }
}