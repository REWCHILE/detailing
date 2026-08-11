<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\InstagramService;

class FetchInstagramFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instagram:fetch {--force : Force refresh the cache}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches and caches the latest Instagram feed';

    /**
     * Execute the console command.
     */
    public function handle(InstagramService $instagram)
    {
        $this->info('Fetching Instagram feed...');
        
        if ($this->option('force')) {
            \Illuminate\Support\Facades\Cache::forget('instagram_feed');
            $this->info('Cleared existing cache.');
        }

        $feed = $instagram->getFeed();

        if (!empty($feed)) {
            $this->info('Successfully fetched and cached ' . count($feed) . ' items.');
            return 0;
        }

        $this->error('Failed to fetch feed.');
        return 1;
    }
}
