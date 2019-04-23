<?php

namespace App\Plugins\Orders\Functions;


use App\Plugins\MarketDays\Model\MarketDay;
use App\Plugins\Orders\Model\OrderHeader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;

/**
 * Trait Orders
 *
 * @package App\Plugins\Orders\Functions
 */
trait Orders
{
    /**
     * @return array
     */
    public function getList()
    {
        return [
            ['field' => 'check', 'label' => 'checkall'],
            ['field' => 'invoice', 'label' => 'Invoice'],
            ['field' => 'ordered_at_formatted', 'label' => 'Order Time'],
            ['field' => 'user_full_name', 'label' => 'Name, Last Name'],
            ['field' => 'user_email', 'label' => 'Email'],
            ['field' => 'payment', 'label' => 'Payment Type'],
            ['field' => 'paid_amount', 'label' => 'Paid'],
            ['field' => 'state_selector', 'label' => 'State'],
            ['field' => 'order_sum', 'label' => 'Sum of order'],
            ['field' => 'market_day', 'label' => 'Market Day'],
            ['field' => 'buttons', 'label' => '', 'buttons' => ['view', 'delete']],
        ];
    }


    /**
     * @param      $search
     * @param bool $trashed
     *
     * @return mixed
     */
    public function getFilteredResult($search, $trashed = false)
    {
        /** @var OrderHeader $orders */
        $orders = new OrderHeader;

        if ($trashed) {
            $orders = $orders->trashed();
        }

        $orders = $orders->where('state', '!=', 'draft');

        if ($search) {
            $orders = $orders->whereHas('buyer', function (Builder $q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            })->orWhere('invoice', 'like', "%$search%");
        }

        return $orders->paginate(20);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Routing\Route|object|string
     */
    public function getEditName($id)
    {
        $r = explode(".", Route::currentRouteName());
        if (($r[1] ?? "") == 'search') {
            return request()->route('search');
        }

        return OrderHeader::find($id)->invoice;
    }

    public function getViewFields()
    {
        return [
            'state_selectpicker'        => 'Order State',
            'invoice_url'               => 'Invoice Number',
            'ordered_at_formatted'      => 'Order Created',
            'startuser'                 => 'hr',
            'user_full_name'            => 'Klients',
            'user_email'                => 'Klienta e-pasts',
            'user_phone'                => 'Klienta Tel.',
            'user_group'                => 'Klienta Grupa',
            'user_comment'              => 'Klienta komentārs',
            'enduser_startDelivery'     => 'hr',
            'selected_delivery'         => 'Delivery',
            'address'                   => 'Address',
            'city'                      => 'City',
            'postcode'                  => 'Postal code',
            'comments'                  => 'Delivery Comment',
            'endDelivery'               => 'hr',
            'paid_amount'               => 'Paid Amount',
            'payment'                   => 'Payment',
            'market_day'                => 'Market Day',
            'market_day_date_formatted' => 'Market Day Date',
            'user_comment_invoice'      => 'Klienta Komentārs rēķinam',
            'user_comment_stats'        => 'Klienta Komentārs atskaitei',
        ];
    }

    public function getFilters()
    {

        $marketDays = MarketDay::all()->pluck('marketDay', 'id')->toArray();
        $market_days = [];

        foreach ($marketDays as $mdid => $md) {
            $market_days[$mdid] = $md[language()];
        }

        return [
            ['type' => 'select', 'name' => 'market_day', 'label' => 'Market Day', 'options' => $market_days],
        ];
    }
}