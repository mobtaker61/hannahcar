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

// Vehicle Models Commands
Artisan::command('api:update-vehicle-models', function () {
    $this->info('🔄 Starting vehicle models update from NHTSA API...');

    $controller = new ApiDataController();

    // نمایش وضعیت قبل از به‌روزرسانی
    $status = $controller->getVehicleModelsStatus();
    $this->info("📊 Current models status:");
    $this->info("   Total models: {$status['data']['total_models']}");
    $this->info("   Active models: {$status['data']['active_models']}");
    $this->info("   Inactive models: {$status['data']['inactive_models']}");

    // اجرای به‌روزرسانی
    $result = $controller->updateVehicleModels();

    if ($result['success']) {
        $this->info('✅ ' . $result['message']);
        $this->info("📈 Models update results:");
        $this->info("   Added: {$result['data']['added']}");
        $this->info("   Updated: {$result['data']['updated']}");
        $this->info("   Skipped: {$result['data']['skipped']}");
        $this->info("   Errors: {$result['data']['errors']}");
        $this->info("   Total models: {$result['data']['total_models']}");
        $this->info("   Brands processed: {$result['data']['total_brands_processed']}");

        // نمایش وضعیت بعد از به‌روزرسانی
        $newStatus = $controller->getVehicleModelsStatus();
        $this->info("📊 New models status:");
        $this->info("   Total models: {$newStatus['data']['total_models']}");
        $this->info("   Active models: {$newStatus['data']['active_models']}");

    } else {
        $this->error('❌ ' . $result['message']);
    }
})->purpose('Update vehicle models from NHTSA API');

Artisan::command('api:vehicle-models-status', function () {
    $controller = new ApiDataController();
    $status = $controller->getVehicleModelsStatus();

    $this->info("📊 Vehicle Models Status:");
    $this->info("   Total models: {$status['data']['total_models']}");
    $this->info("   Active models: {$status['data']['active_models']}");
    $this->info("   Inactive models: {$status['data']['inactive_models']}");

    if ($status['data']['recent_models']->count() > 0) {
        $this->info("📋 Recent models:");
        foreach ($status['data']['recent_models'] as $model) {
            $status = $model->is_active ? '✅' : '❌';
            $brandName = $model->brand ? $model->brand->name : 'Unknown';
            $this->info("   {$status} {$model->name} ({$brandName})");
        }
    }
})->purpose('Show vehicle models status');

Artisan::command('api:cleanup-inactive-models', function () {
    $this->info('🧹 Cleaning up inactive models...');

    $controller = new ApiDataController();
    $result = $controller->cleanupInactiveModels();

    $this->info('✅ ' . $result['message']);
})->purpose('Clean up inactive vehicle models');

// Complete Update Command
Artisan::command('api:update-all-vehicle-data', function () {
    $this->info('🔄 Starting complete vehicle data update...');

    $controller = new ApiDataController();
    $result = $controller->updateAllVehicleData();

    if ($result['success']) {
        $this->info('✅ ' . $result['message']);
        $this->info("📈 Complete update results:");

        // Brands results
        $this->info("   Brands - Added: {$result['data']['brands']['added']}");
        $this->info("   Brands - Updated: {$result['data']['brands']['updated']}");
        $this->info("   Brands - Skipped: {$result['data']['brands']['skipped']}");

        // Models results
        $this->info("   Models - Added: {$result['data']['models']['added']}");
        $this->info("   Models - Updated: {$result['data']['models']['updated']}");
        $this->info("   Models - Skipped: {$result['data']['models']['skipped']}");
        $this->info("   Models - Errors: {$result['data']['models']['errors']}");
        $this->info("   Total Models: {$result['data']['models']['total_models']}");

    } else {
        $this->error('❌ ' . $result['message']);
    }
})->purpose('Update all vehicle data (brands and models) from NHTSA API');
