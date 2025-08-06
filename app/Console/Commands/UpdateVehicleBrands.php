<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ApiDataController;

class UpdateVehicleBrands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:update-vehicle-brands {--cleanup : Clean up inactive brands after update}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update vehicle brands from NHTSA API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔄 Starting vehicle brands update from NHTSA API...');

        $controller = new ApiDataController();

        // نمایش وضعیت قبل از به‌روزرسانی
        $status = $controller->getVehicleBrandsStatus();
        $this->info("📊 Current status:");
        $this->info("   Total brands: {$status['data']['total_brands']}");
        $this->info("   Active brands: {$status['data']['active_brands']}");
        $this->info("   Inactive brands: {$status['data']['inactive_brands']}");

        // اجرای به‌روزرسانی
        $result = $controller->updateVehicleBrands();

        if ($result['success']) {
            $this->info('✅ ' . $result['message']);
            $this->info("📈 Update results:");
            $this->info("   Added: {$result['data']['added']}");
            $this->info("   Updated: {$result['data']['updated']}");
            $this->info("   Skipped: {$result['data']['skipped']}");
            $this->info("   Total processed: {$result['data']['total_processed']}");

            // نمایش وضعیت بعد از به‌روزرسانی
            $newStatus = $controller->getVehicleBrandsStatus();
            $this->info("📊 New status:");
            $this->info("   Total brands: {$newStatus['data']['total_brands']}");
            $this->info("   Active brands: {$newStatus['data']['active_brands']}");

            // پاک کردن برندهای غیرفعال اگر درخواست شده باشد
            if ($this->option('cleanup')) {
                $this->info('🧹 Cleaning up inactive brands...');
                $cleanupResult = $controller->cleanupInactiveBrands();
                $this->info('✅ ' . $cleanupResult['message']);
            }

        } else {
            $this->error('❌ ' . $result['message']);
            return 1;
        }

        return 0;
    }
}
