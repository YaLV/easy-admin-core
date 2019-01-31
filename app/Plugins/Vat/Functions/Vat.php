<?php

namespace App\Plugins\Vat\Functions;


trait Vat
{
    public function getList()
    {
        return [
            ['field' => 'name', 'label' => 'Name'],
            ['field' => 'amount', 'label' => 'Amount', 'class' => 'addPercent'],
            ['field' => 'buttons', 'buttons' => ['edit', 'delete'], 'label' => ''],
        ];
    }

    public function form()
    {
        return [
            'data' => [
                'name'   => ['type' => 'text', 'class' => '', 'label' => 'Name'],
                'amount' => ['type' => 'text', 'class' => '', 'label' => 'Amount'],
            ],
        ];
    }
}