<?php

namespace App\Console;

use App\src\Domain\ExcelDataUploads\Console\Commands\PublishExampleKafkaTopic;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        $this->load(base_path('app/src/Domain/ExcelDataUploads/Console/Commands'));

        require base_path('routes/console.php');
    }
}
