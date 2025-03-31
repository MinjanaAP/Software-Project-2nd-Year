<?php

namespace App\Console\Commands;

use App\Models\free_ad;
use Illuminate\Console\Command;

class DeleteOldAds extends Command
{
    //? toRun : php artisan ads:delete-old
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ads:delete-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete ads older than 3 months';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        $threeMonthsAgo = now()->subMonths(3);

        $deletedAdsCount = free_ad::where('created_at', '<', $threeMonthsAgo)->delete();

        $this->info("$deletedAdsCount ads deleted.");
    }
}
