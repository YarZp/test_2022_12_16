<?php

namespace App\Console\Commands;

use App\Services\TaskService;
use Illuminate\Console\Command;

class CompleteFiveMinute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:complete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Complete tasks older five minutes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        TaskService::completeTasksOlderFiveMinutes();
        return Command::SUCCESS;
    }
}
