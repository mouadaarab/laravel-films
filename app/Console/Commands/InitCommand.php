<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init {--sync-data=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init App';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Run artisan migrate command
        $this->info('Run artisan migrate command');
        $this->call('migrate:fresh');

        // Run artisan db:seed command
        $this->info('Run artisan db:seed command');
        $this->call('db:seed');

        // Run artisan app:sync command
        if ($this->option('sync-data') == 'true') {
            $this->info('Run artisan app:sync command');
            $this->call('app:sync');
        }

    }
}
