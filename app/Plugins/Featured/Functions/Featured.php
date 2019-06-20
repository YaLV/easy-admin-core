<?php

namespace App\Plugins\Featured\Functions;


use App\Plugins\Suppliers\Model\Supplier;

trait Featured
{
    public function getList()
    {
        return [
            ['field' => 'name', 'label' => 'Supplier Name', 'translate' => 'supplier.name', 'key' => 'supplier_id'],
            ['field' => 'buttons', 'buttons' => ['edit', 'state', 'delete'], 'label' => ''],
        ];
    }

    public function form()
    {
        return [
            [
                'Label' => 'Parameters',
                'data'  => [
                    'supplier_id'    => ['type' => 'select', 'label' => 'Supplier', 'options' => Supplier::all()],
                    'featured_image' => ['type' => 'image', 'label' => 'Background Image', 'preview' => true],
                ],
            ],
            [
                'Label'     => 'Display',
                'languages' => languages()->pluck('name', 'code'),
                'data'      => [
                    'title'       => ['type' => 'text', 'label' => 'Title', 'meta' => true],
                    'description' => ['type' => 'textarea', 'label' => 'Description', 'meta' => true],
                ],
            ],
        ];
    }
}