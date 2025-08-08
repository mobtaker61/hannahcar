<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\VehicleBrand;
use App\Models\VehicleModel;

class ShowVehicleDataStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:show-vehicle-status {--detailed : Show detailed information for each brand}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show status of vehicle brands and models data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $detailed = $this->option('detailed');

        $this->info('📊 Vehicle Data Status Report');
        $this->info('=============================');

        // آمار کلی
        $this->showOverallStats();

        if ($detailed) {
            $this->showDetailedBrandsInfo();
        } else {
            $this->showSummaryInfo();
        }

        return 0;
    }

    /**
     * نمایش آمار کلی
     */
    private function showOverallStats()
    {
        $totalBrands = VehicleBrand::count();
        $activeBrands = VehicleBrand::where('is_active', true)->count();
        $inactiveBrands = VehicleBrand::where('is_active', false)->count();

        $completedBrands = VehicleBrand::where('models_completed', true)->count();
        $pendingBrands = $activeBrands - $completedBrands;

        $totalModels = VehicleModel::count();
        $activeModels = VehicleModel::where('is_active', true)->count();
        $inactiveModels = VehicleModel::where('is_active', false)->count();

        $this->info('📈 Overall Statistics:');
        $this->info("   Total brands: {$totalBrands}");
        $this->info("   Active brands: {$activeBrands}");
        $this->info("   Inactive brands: {$inactiveBrands}");
        $this->info("   Brands with completed models: {$completedBrands}");
        $this->info("   Brands pending model update: {$pendingBrands}");
        $this->info("   Total models: {$totalModels}");
        $this->info("   Active models: {$activeModels}");
        $this->info("   Inactive models: {$inactiveModels}");

        $this->newLine();
    }

    /**
     * نمایش اطلاعات خلاصه
     */
    private function showSummaryInfo()
    {
        // برندهای ناتمام
        $pendingBrands = VehicleBrand::where('is_active', true)
            ->where(function($query) {
                $query->where('models_completed', false)
                      ->orWhereNull('models_updated_at');
            })
            ->orderBy('name')
            ->get();

        if ($pendingBrands->isNotEmpty()) {
            $this->warn('⚠️ Brands pending model updates:');
            foreach ($pendingBrands as $brand) {
                $this->line("   - {$brand->name} (ID: {$brand->id})");
            }
            $this->newLine();
        }

        // برندهای کامل
        $completedBrands = VehicleBrand::where('is_active', true)
            ->where('models_completed', true)
            ->orderBy('models_updated_at', 'desc')
            ->limit(10)
            ->get();

        if ($completedBrands->isNotEmpty()) {
            $this->info('✅ Recently completed brands:');
            foreach ($completedBrands as $brand) {
                $modelsCount = $brand->models()->count();
                $updatedAt = $brand->models_updated_at ? $brand->models_updated_at->format('Y-m-d H:i') : 'N/A';
                $this->line("   - {$brand->name} ({$modelsCount} models) - Updated: {$updatedAt}");
            }
            $this->newLine();
        }

        // برندهای با بیشترین مدل
        $topBrands = VehicleBrand::where('is_active', true)
            ->withCount('models')
            ->orderBy('models_count', 'desc')
            ->limit(10)
            ->get();

        if ($topBrands->isNotEmpty()) {
            $this->info('🏆 Top brands by model count:');
            foreach ($topBrands as $brand) {
                $status = $brand->models_completed ? '✅' : '⏳';
                $this->line("   {$status} {$brand->name}: {$brand->models_count} models");
            }
            $this->newLine();
        }
    }

    /**
     * نمایش اطلاعات تفصیلی
     */
    private function showDetailedBrandsInfo()
    {
        $brands = VehicleBrand::where('is_active', true)
            ->withCount('models')
            ->orderBy('name')
            ->get();

        $this->info('📋 Detailed Brand Information:');
        $this->info('=============================');

        $headers = ['ID', 'Name', 'Models', 'Status', 'Last Updated'];
        $rows = [];

        foreach ($brands as $brand) {
            $status = $brand->models_completed ? '✅ Complete' : '⏳ Pending';
            $updatedAt = $brand->models_updated_at ? $brand->models_updated_at->format('Y-m-d H:i') : 'Never';

            $rows[] = [
                $brand->id,
                $brand->name,
                $brand->models_count,
                $status,
                $updatedAt
            ];
        }

        $this->table($headers, $rows);
    }
}
