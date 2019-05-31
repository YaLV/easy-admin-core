<?php

namespace App\Console;

use App\Console\Commands\ExportOrders;
use App\Console\Commands\ImportProductImages;
use App\Console\Commands\ImportProducts;
use App\Console\Commands\OrderImport;
use App\Console\Commands\PdfGeneration;
use App\Console\Commands\SendOrderEmails;
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
        ImportProducts::class,
        ImportProductImages::class,
        ExportOrders::class,
        OrderImport::class,
        PdfGeneration::class,
        SendOrderEmails::class
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
        // Import Products
        $this->importProductsSchedule($schedule);

        // Export Orders
        $this->exportOrders($schedule);

        // Import Orders
        $this->ImportOrders($schedule);

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

    /**
     * Product and product Image import scheduler
     *
     * @param Schedule $schedule
     */
    public function importProductsSchedule(Schedule $schedule)
    {
        // Products
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

        // Images
        $schedule->command("svaigi:importImages")->everyMinute()->when(function () {
            $scheduled = Schedules::where(['running' => 0, 'type' => 'productImageImport', 'finished' => 0])->orWhere(function (Builder $q) {
                $q->where('running', 1)
                    ->where('updated_at', '>=', Carbon::now()->addMinutes(-5))
                    ->where('type', 'productImageImport')
                    ->where('finished', 0);
            })->first();

            return $scheduled;

        })->runInBackground()
            ->withoutOverlapping()
            ->evenInMaintenanceMode();
    }

    /**
     * Order Export Scheduler
     *
     * @param Schedule $schedule
     *
     */
    public function exportOrders(Schedule $schedule)
    {
        // Images
        $schedule->command("svaigi:exportOrders")->everyMinute()->when(function () {
            $scheduled = Schedules::where(['running' => 0, 'type' => 'orderExport', 'finished' => 0])->orWhere(function (Builder $q) {
                $q->where('running', 1)
                    ->where('updated_at', '>=', Carbon::now()->addMinutes(-5))
                    ->where('type', 'orderExport')
                    ->where('finished', 0);
            })->first();

            return $scheduled;
        })->runInBackground()
            ->withoutOverlapping()
            ->evenInMaintenanceMode();
    }

    /**
     * Order Export Scheduler
     *
     * @param Schedule $schedule
     *
     */
    public function importOrders(Schedule $schedule)
    {
        // Order Update
        $schedule->command("svaigi:importOrders")->everyMinute()->when(function () {
            $scheduled = Schedules::where(['running' => 0, 'type' => 'orderImport', 'finished' => 0])->orWhere(function (Builder $q) {
                $q->where('running', 1)
                    ->where('updated_at', '>=', Carbon::now()->addMinutes(-5))
                    ->where('type', 'orderImport')
                    ->where('finished', 0);
            })->first();

            return $scheduled;
        })->runInBackground()
            ->withoutOverlapping()
            ->evenInMaintenanceMode();

        // PDF generation
        $schedule->command("svaigi:createPDF")->everyMinute()->when(function () {
            $scheduled = Schedules::where(['running' => 0, 'type' => 'createPDF', 'finished' => 0])->orWhere(function (Builder $q) {
                $q->where('running', 1)
                    ->where('updated_at', '>=', Carbon::now()->addMinutes(-5))
                    ->where('type', 'createPDF')
                    ->where('finished', 0);
            })->first();

            return $scheduled;
        })->runInBackground()
            ->withoutOverlapping()
            ->evenInMaintenanceMode();

        // Send PDF's
        $schedule->command("svaigi:sendOrderEmails")->everyMinute()->when(function () {
            $scheduled = Schedules::where(['running' => 0, 'type' => 'sendOrderEmails', 'finished' => 0])->orWhere(function (Builder $q) {
                $q->where('running', 1)
                    ->where('updated_at', '>=', Carbon::now()->addMinutes(-5))
                    ->where('type', 'sendOrderEmails')
                    ->where('finished', 0);
            })->first();

            return $scheduled;
        })->runInBackground()
            ->withoutOverlapping()
            ->evenInMaintenanceMode();
    }

}
