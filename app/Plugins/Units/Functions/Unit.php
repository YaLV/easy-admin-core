<?php

namespace App\Plugins\units\Functions;


trait Unit
{
    public function getList()
    {
        return [
            ['field' => 'name', 'label' => 'Name'],
            ['field' => 'unit', 'label' => 'Measurement Unit'],
            ['field' => 'buttons', 'buttons' => ['edit', 'delete'], 'label' => ''],
        ];
    }

    public function form()
    {
        return [
            'data' => [
                'name'   => ['type' => 'text', 'class' => '', 'label' => 'Name'],
                'unit' => ['type' => 'text', 'class' => '', 'label' => 'Measurement Unit'],
            ],
        ];
    }
}