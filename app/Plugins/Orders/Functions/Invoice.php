<?php

namespace App\Plugins\Orders\Functions;


use App\Plugins\Orders\Model\OrderHeader;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;

trait Invoice
{
    public function invoice($invoice) {
        $order = OrderHeader::where('invoice', $invoice)->first();
        $user = (\Auth::user()??new User());

        $curUserOrder = "{$order->id}-u{$user->id}";

        if($user->isAdmin || $curUserOrder==$order->invoice) {
            return PDF::loadView('Orders::pdf.invoice', ['order' => $order])->download($curUserOrder.".pdf");
        }
        abort(404);
    }
}