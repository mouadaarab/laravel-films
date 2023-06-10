<?php

namespace App\Console\Commands;

use App\Services\TheMovieDBService;
use Illuminate\Console\Command;

class SyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call sync genres/films service';

    /**
     * Execute the console command.
     */
    public function handle(TheMovieDBService $theMovieDBService)
    {
        $this->info('Sync film genres');
        $theMovieDBService->syncGenres();

        $this->info('Sync day trending films');
        $theMovieDBService->syncTrendingFilms('day');

        $this->info('Sync week trending films');
        $theMovieDBService->syncTrendingFilms('week');

        $this->info('Sync films done!');
    }
}
