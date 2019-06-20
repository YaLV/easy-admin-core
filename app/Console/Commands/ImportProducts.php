<?php

namespace App\Console\Commands;

use App\Plugins\Products\Functions\ProductImport;
use App\Schedules;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'svaigi:importproducts {schedule_id? : Id of schedule to run}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Products, if there is uploaded import file';

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
            $schedule = Schedules::where(['running' => 0, 'type' => 'productImport', 'finished' => 0])->orWhere(function (Builder $q) {
                $q->where('running', 1)
                    ->where('updated_at', '>=', Carbon::now()->addMinutes(-5))
                    ->where('type', 'productImport')
                    ->where('finished', 0);
            })->first();
        } else {
            $this->info('Searching job with id: '.$this->getScheduleId());
            $schedule = Schedules::find($this->getScheduleId());
            if($schedule->type!='orderExport') {
                $this->error('Schedule is not Product Import');
            }
        }

        if(!$schedule) {
            $this->error("Schedule not found");
            return;
        } else {
            $schedule->update(['running' => 1]);
        }

        $result = ProductImport::runImport($schedule->toArray());

        $msgType = "error";

        if($result['status']==true) {
            \Storage::delete('imports/products/'.$schedule['filename']);
            $msgType="info";
        }

        $schedule->update(['running' => 0, 'finished' => 1, 'result_state' => $result['status'], 'result_message' => $result['message']]);

        $this->$msgType($result['message']);

        return;
    }

    public function getScheduleId() {
        return $this->argument('schedule_id')??false;
    }
}
