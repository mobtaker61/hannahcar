<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ApiDataController;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// API Data Management Commands
Artisan::command('api:update-vehicle-brands', function () {
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
        
    } else {
        $this->error('❌ ' . $result['message']);
    }
})->purpose('Update vehicle brands from NHTSA API');

Artisan::command('api:vehicle-brands-status', function () {
    $controller = new ApiDataController();
    $status = $controller->getVehicleBrandsStatus();
    
    $this->info("📊 Vehicle Brands Status:");
    $this->info("   Total brands: {$status['data']['total_brands']}");
    $this->info("   Active brands: {$status['data']['active_brands']}");
    $this->info("   Inactive brands: {$status['data']['inactive_brands']}");
    
    if ($status['data']['recent_brands']->count() > 0) {
        $this->info("📋 Recent brands:");
        foreach ($status['data']['recent_brands'] as $brand) {
            $status = $brand->is_active ? '✅' : '❌';
            $this->info("   {$status} {$brand->name} ({$brand->slug})");
        }
    }
})->purpose('Show vehicle brands status');

Artisan::command('api:cleanup-inactive-brands', function () {
    $this->info('🧹 Cleaning up inactive brands...');
    
    $controller = new ApiDataController();
    $result = $controller->cleanupInactiveBrands();
    
    $this->info('✅ ' . $result['message']);
})->purpose('Clean up inactive vehicle brands');
