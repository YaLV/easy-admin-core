<?php

namespace App\Plugins\DiscountCodes\Functions;

use Carbon\Carbon;

trait DiscountCodes
{
    public function form()
    {
        return [
            'data' => [
                'code'       => ['type' => 'text', 'label' => 'Discount Code'],
                'uses'       => ['type' => 'text', 'label' => 'Uses'],
                'amount'     => ['type' => 'text', 'label' => 'Discount Amount'],
                'unit'       => ['type' => 'select', 'label' => 'Discount unit', 'options' => (object)[(object)['id' => 'amount', 'name' => 'Money'], (object)['id' => 'percent', 'name' => 'Percent']]],
                'applied'    => ['type' => 'select', 'label' => 'Discount applied to', 'options' => (object)[(object)['id' => 'all', 'name' => 'All Order'], (object)['id' => 'product', 'name' => 'Only Prodcuts'], (object)['id' => 'delivery', 'name' => 'Only Delivery']]],
                'valid_from' => ['type' => 'text', 'label' => 'Valid From', 'class' => 'datepicker', 'value' => Carbon::now()->format('Y-m-d')],
                'valid_to'   => ['type' => 'text', 'label' => 'Valid to', 'class' => 'datepicker'],
            ],
        ];
    }

    public function getList()
    {
        return [
            ['field' => 'code', 'label' => "Discount Code"],
            ['field' => 'applied', 'label' => "Discount Applied to"],
            ['field' => 'amount', 'label' => 'Discount Amount', 'classbyfield' => 'unit'],
            ['field' => 'buttons', 'label' => '', 'buttons' => ['edit', 'state', 'delete']],
        ];
    }
}