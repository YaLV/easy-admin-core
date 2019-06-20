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
                'applied'    => ['type' => 'select', 'class' => 'changeDT', 'label' => 'Discount applied to', 'options' => (object)[(object)['id' => 'category', 'name' => 'Only Category(-ies)'], (object)['id' => 'product', 'name' => 'Only Prodcut(-s)'], (object)['id' => 'delivery', 'name' => 'Only Delivery']]],
                'items'      => ['type' => 'text', 'label' => 'Discount Targets', 'class' => 'autocomplete target', 'dataAttr' => ['searchurl' => route('promotions.load', ['discount_to'])]],
                'valid_from' => ['type' => 'text', 'label' => 'Valid From', 'class' => 'datepicker', 'format' => 'm/d/Y'],
                'valid_to'   => ['type' => 'text', 'label' => 'Valid to', 'class' => 'datepicker', 'format' => 'm/d/Y'],
            ],
        ];
    }

    public function getList()
    {
        return [
            ['field' => 'code', 'label' => "Discount Code"],
            ['field' => 'applied', 'label' => "Discount Applied to", 'fn' => 'discountTo', 'results' => false],
            ['field' => 'amount', 'label' => 'Discount Amount', 'classbyfield' => 'unit'],
            ['field' => 'uses', 'label' => 'Uses Left', 'fn' => 'usesLeft', 'results' => false],
            ['field' => 'valid_range', 'label' => 'Discount Valid'],
            ['field' => 'buttons', 'label' => '', 'buttons' => ['edit', 'state', 'delete']],
        ];
    }
}