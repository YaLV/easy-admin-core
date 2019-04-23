<?php

namespace App\Console;

use App\Console\Commands\ImportProducts;
use App\Schedules;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ImportProducts::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command("svaigi:importproducts")->everyMinute()->when(function () {
            $scheduled = Schedules::where(['running' => 0, 'type' => 'productImport', 'finished' => 0])->orWhere(function (Builder $q) {
                $q->where('running', 1)
                    ->where('updated_at', '>=', Carbon::now()->addMinutes(-5))
                    ->where('type', 'productImport')
                    ->where('finished', 0);
            })->first();

            return $scheduled;
        })->runInBackground()
        ->withoutOverlapping()
        ->evenInMaintenanceMode();

        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
