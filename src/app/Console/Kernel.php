<?php

namespace App\Console;

use App\Jobs\SyncNews;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function(){
            Log::info('Callback executed');
        })->everyMinute();
        $schedule->command('app:dump-database')->everyMinute();
        $schedule->job(new SyncNews(15))->everyMinute();
        $schedule->exec('touch storage/logs/test.log')->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
