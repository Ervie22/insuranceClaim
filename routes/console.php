<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Scheduling\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
Artisan::command('force:scheduler-test', function () {
    echo "👉 Came inside function: \n";
    $schedule = app(Schedule::class);
    foreach ($schedule->events() as $event) {
        echo "👉 Found scheduled event: {$event->command}\n";
    }
});
