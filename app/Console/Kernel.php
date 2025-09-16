<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\ProcessPendingJobs::class,
        \App\Console\Commands\ProcessInprogressJobs::class,
        \App\Console\Commands\UpdateReportJobs::class,
    ];

    protected function schedule(Schedule $schedule): void
    {


        $schedule->command('filejobs:tiling')
            ->everyTwoMinutes()
            ->withoutOverlapping()
            ->evenInMaintenanceMode();
        $schedule->command('filejobs:process')
            ->everyTwoMinutes()
            ->withoutOverlapping()
            ->evenInMaintenanceMode();
        $schedule->command('filejobs:updateReport')
            ->everyTwoMinutes()
            ->withoutOverlapping()
            ->evenInMaintenanceMode();
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
