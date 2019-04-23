<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    public $fillable = [
        'type',
        'filename',
        'total_lines',
        'stopped_at',
        'running',
        'finished',
        'result_state',
        'result_message',
    ];
}
