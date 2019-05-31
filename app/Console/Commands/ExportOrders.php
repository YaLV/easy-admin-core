<?php

namespace App\Console\Commands;

use App\Plugins\Orders\Functions\OrderExport;
use App\Schedules;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class ExportOrders extends Command
{
    use OrderExport;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'svaigi:exportOrders {schedule_id? : Id of schedule to run}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export Orders selected in order list';

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
            $schedule = Schedules::where(['running' => 0, 'type' => 'orderExport', 'finished' => 0])->orWhere(function (Builder $q) {
                $q->where('running', 1)
                    ->where('updated_at', '>=', Carbon::now()->addMinutes(-5))
                    ->where('type', 'orderExport')
                    ->where('finished', 0);
            })->first();
        } else {
            $this->info('Searching job with id: '.$this->getScheduleId());
            $schedule = Schedules::find($this->getScheduleId());
            if($schedule->type!='orderExport') {
                $this->error('Schedule is not order Export');
            }
        }

        if(!$schedule) {
            $this->error("Schedule not found");
            return;
        } else {
            $schedule->update(['running' => 1]);
        }

        $this->createExcel($schedule);

    }

    public function getScheduleId() {
        return $this->argument('schedule_id')??false;
    }
}
