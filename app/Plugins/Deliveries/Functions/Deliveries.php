<?php

namespace App\Plugins\Deliveries\Functions;


use App\Languages;
use App\Plugins\MarketDays\Model\MarketDay;
use App\Plugins\Vat\Model\Vat;

trait Deliveries
{
    public function getList()
    {
        return [
            ['field' => 'name', 'label' => 'Delivery Name', 'translate' => 'deliveries.name', 'key' => 'id'],
            ['field' => 'market_day_list', 'label' => 'Market Day(-s)'],
            ['field' => 'sequence', 'label' => 'Sequence', 'class' => 'seqTarget'],
            ['field' => 'buttons', 'buttons' => ['edit', 'state', 'delete'], 'label' => ''],
        ];
    }

    public function form()
    {
        return [
            [
                'Label'     => 'Display',
                'languages' => languages()->pluck('name', 'code'),
                'data'      => [
                    'name'        => ['type' => "text", 'label' => 'Name', 'meta' => true],
                    'description' => ['type' => 'textarea', 'label' => 'Description, (parametri: freeAbove, dayName)', 'meta' => true],
                    'address'     => ['type' => 'text', 'label' => 'Address', 'meta' => true],
                ],
            ],
            [
                'Label' => 'Parameters',
                'data'  => [
                    'addressUrl'   => ['type' => 'text', 'label' => 'Address Url'],
                    'marketDays'   => ['type' => 'chosen', 'label' => 'Market Day(-s)', 'options' => MarketDay::all()],
                    'price'        => ['type' => 'text', 'label' => 'Price'],
                    'freeAbove'    => ['type' => 'text', 'label' => 'Free above'],
                    'deliveryTime' => ['type' => 'select', 'label' => 'Delivery Date', 'options' => [(object)['id' => '0', 'name' => 'Same Day Delivery'], (object)['id' => '1', 'name' => 'Next Day Delivery']]],
                    'vat_id'       => ['type' => 'select', 'label' => 'VAT', 'options' => Vat::all()],
                    'type'         => ['type' => 'select', 'label' => 'Type', 'options' => [(object)['id' => 'local', 'name' => 'Collect at warehouse'], (object)['id' => 'delivery', 'name' => 'Delivery to address']]],
                ],
            ],
        ];
    }
}