<?php

namespace App\Plugins\units\Functions;


trait Unit
{
    public function getList()
    {
        return [
            ['field' => 'name', 'label' => 'Name'],
            ['field' => 'unit', 'label' => 'Measurement Unit'],
            ['field' => 'parent_amount', 'label' => 'Amount in parent'],
            ['field' => 'buttons', 'buttons' => ['edit', 'delete'], 'label' => ''],
        ];
    }

    public function form()
    {
        return [
            'data' => [
                'name'          => ['type' => 'text', 'class' => '', 'label' => 'Name'],
                'unit'          => ['type' => 'text', 'class' => '', 'label' => 'Measurement Unit'],
                'unit_id'       => ['type' => 'select', 'class' => '', 'label' => 'Parent of', 'options' => \App\Plugins\Units\Model\Unit::all()],
                'parent_amount' => ['type' => 'text', 'class' => '', 'label' => 'Amount to reach parent'],
            ],
        ];
    }
}