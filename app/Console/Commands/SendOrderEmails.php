<?php

namespace App\Console\Commands;

use App\Plugins\Orders\Functions\SendOrders;
use App\Schedules;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class SendOrderEmails extends Command
{
    use SendOrders;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'svaigi:sendOrderEmails {schedule_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Generated PDF files to suppliers';

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
     * @return void
     */
    public function handle()
    {
        /** @var Schedules $schedule */
        if(!$this->getScheduleId()) {
            $this->info('Searching Scheduled jobs');
            $schedule = Schedules::where(['running' => 0, 'type' => 'sendOrderEmails', 'finished' => 0])->orWhere(function (Builder $q) {
                $q->where('running', 1)
                    ->where('updated_at', '>=', Carbon::now()->addMinutes(-5))
                    ->where('type', 'sendOrderEmails')
                    ->where('finished', 0);
            })->first();
        } else {
            $this->info('Searching job with id: '.$this->getScheduleId());
            $schedule = Schedules::find($this->getScheduleId());
            if($schedule->type!='sendOrderEmails') {
                $this->error('Schedule is not order Import');
            }
        }

        if(!$schedule) {
            $this->error("Schedule not found");
            return;
        } else {
            $schedule->update(['running' => 1]);
        }

        $this->sendEmails($schedule);
    }

    public function getScheduleId() {
        return $this->argument('schedule_id')??false;
    }
}
