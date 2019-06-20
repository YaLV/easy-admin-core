<?php

namespace App\Console\Commands;

use App\Schedules;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class OrderImport extends Command
{

    use \App\Plugins\Orders\Functions\OrderImport;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'svaigi:importOrders {schedule_id? : Id of schedule to run}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Orders from Excel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /** @var Schedules $schedule */
        if(!$this->getScheduleId()) {
            $this->info('Searching Scheduled jobs');
            $schedule = Schedules::where(['running' => 0, 'type' => 'orderImport', 'finished' => 0])->orWhere(function (Builder $q) {
                $q->where('running', 1)
                    ->where('updated_at', '>=', Carbon::now()->addMinutes(-5))
                    ->where('type', 'orderImport')
                    ->where('finished', 0);
            })->first();
        } else {
            $this->info('Searching job with id: '.$this->getScheduleId());
            $schedule = Schedules::find($this->getScheduleId());
            if($schedule->type!='orderImport') {
                $this->error('Schedule is not order Import');
            }
        }

        if(!$schedule) {
            $this->error("Schedule not found");
            return;
        } else {
            $schedule->update(['running' => 1]);
        }

        $this->import($schedule);
    }

    public function getScheduleId() {
        return $this->argument('schedule_id')??false;
    }
}
