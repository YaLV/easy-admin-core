<?php

namespace App\Plugins\Languages\Functions;


trait Language
{
    public function form()
    {
        return [
            'data' => [
                'code'      => ['type' => 'text', 'class' => '', 'label' => 'Kods'],
                'name'      => ['type' => 'text', 'class' => '', 'label' => 'Nosaukums'],
                'is_default' => ['type' => 'switch', 'class' => '', 'label' => 'Noklusējuma valoda'],
            ],
        ];
    }

    public function getList()
    {
        return [
            ['field' => 'code', 'label' => 'Kods'],
            ['field' => 'name', 'label' => 'Nosaukums'],
            ['field' => 'is_default', 'label' => 'Noklusējuma valoda', 'type' => 'yesno'],
            ['field' => 'buttons', 'buttons' => ['edit', 'delete'], 'label' => '']
        ];
    }
}