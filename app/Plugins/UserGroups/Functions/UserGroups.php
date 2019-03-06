<?php

namespace App\Plugins\UserGroups\Functions;


trait UserGroups
{
    public function form()
    {
        return [
            'data' => [
                'name'       => ['type' => 'text', 'label' => 'Name'],
                'min_orders' => ['type' => 'number', 'label' => 'Minimum Orders'],
            ],
        ];
    }

    public function getList()
    {
        return [
            ['field' => 'name', 'label' => 'Name'],
            ['field' => 'min_orders', 'label' => 'Minimum Orders'],
            ['field' => 'user_count', 'label' => 'Users in group'],
            ['field' => 'buttons', 'buttons' => ['edit', 'delete'], 'label' => ''],
        ];
    }
}