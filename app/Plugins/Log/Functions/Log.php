<?php

namespace App\Plugins\Log\Functions;


use App\Schedules;

trait Log
{

    public function getList()
    {
        return [
            ['field' => 'created_at', 'label' => 'Job initiated'],
            ['field' => 'type_name', 'label' => 'Job'],
            ['field' => 'result_state_switch', 'label' => 'State'],
            ['field' => 'result_message', 'label' => 'Message'],
        ];
    }

    public function getLog($types) {
        $schedule = new Schedules();
        if(!$types) {
            return $schedule->paginate(20);
        }

        return $schedule->whereIn('type', explode(",", $types))->limit(10)->get();
    }

    public function getEditName() {
        return "All Logs";
    }
}