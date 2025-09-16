<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestSchedule extends Command
{
    protected $signature = 'test:run';
    protected $description = 'Basic test command';

    public function handle()
    {
        echo "✅ test:run executed at " . now() . "\n";
    }
}
