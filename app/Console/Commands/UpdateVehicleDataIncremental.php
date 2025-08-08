<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ApiDataController;
use App\Models\VehicleBrand;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UpdateVehicleDataIncremental extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:update-vehicle-data-incremental
                            {--brand-limit=10 : Number of brands to process in one run}
                            {--force : Force update even if models are completed}
                            {--cleanup : Clean up inactive brands after update}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update vehicle brands and models incrementally from NHTSA API';

        /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔄 Starting incremental vehicle data update from NHTSA API...');

        $brandLimit = (int) $this->option('brand-limit');
        $forceUpdate = $this->option('force');
        $cleanup = $this->option('cleanup');

        // مرحله 1: به‌روزرسانی برندها
        $this->info('📋 Step 1: Updating vehicle brands...');
        $brandsResult = $this->updateBrands();

        if (!$brandsResult['success']) {
            $this->error('❌ Failed to update brands: ' . $brandsResult['message']);
            return 1;
        }

        $this->info('✅ Brands updated successfully');
        $this->info("   Added: {$brandsResult['data']['added']}");
        $this->info("   Updated: {$brandsResult['data']['updated']}");

        // مرحله 2: پردازش برندها و مدل‌هایشان یکی یکی
        $this->info('🚗 Step 2: Processing brands and their models one by one...');
        $modelsResult = $this->processBrandsAndModelsSequentially($brandLimit, $forceUpdate);

        if (!$modelsResult['success']) {
            $this->error('❌ Failed to update models: ' . $modelsResult['message']);
            return 1;
        }

        $this->info('✅ Models updated successfully');
        $this->info("   Brands processed: {$modelsResult['data']['brands_processed']}");
        $this->info("   Models added: {$modelsResult['data']['models_added']}");
        $this->info("   Models updated: {$modelsResult['data']['models_updated']}");

        // نمایش وضعیت کلی
        $this->displayOverallStatus();

        // پاک کردن برندهای غیرفعال اگر درخواست شده باشد
        if ($cleanup) {
            $this->info('🧹 Cleaning up inactive brands...');
            $controller = new ApiDataController();
            $cleanupResult = $controller->cleanupInactiveBrands();
            $this->info('✅ ' . $cleanupResult['message']);
        }

        $this->info('🎉 Incremental update completed successfully!');
        return 0;
    }

    /**
     * به‌روزرسانی برندها
     */
    private function updateBrands()
    {
        try {
            Log::info('Starting vehicle brands update from NHTSA API');

            // دریافت داده‌ها از API
            $response = Http::get('https://vpic.nhtsa.dot.gov/api/vehicles/getallmakes?format=json');

            if (!$response->successful()) {
                Log::error('Failed to fetch data from NHTSA API', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return [
                    'success' => false,
                    'message' => 'خطا در دریافت داده‌ها از API',
                    'status' => $response->status()
                ];
            }

            $data = $response->json();

            if (!isset($data['Results']) || !is_array($data['Results'])) {
                Log::error('Invalid response format from NHTSA API', ['data' => $data]);
                return [
                    'success' => false,
                    'message' => 'فرمت پاسخ API نامعتبر است'
                ];
            }

            $brands = $data['Results'];
            $added = 0;
            $updated = 0;
            $skipped = 0;

            foreach ($brands as $brandData) {
                if (!isset($brandData['Make_Name']) || empty($brandData['Make_Name'])) {
                    $skipped++;
                    continue;
                }

                $name = trim($brandData['Make_Name']);
                $slug = Str::slug($name);
                $makeId = $brandData['Make_ID'] ?? null;

                // بررسی وجود برند با همین نام یا slug
                $existingBrand = VehicleBrand::where('name', $name)
                    ->orWhere('slug', $slug)
                    ->first();

                if ($existingBrand) {
                    // به‌روزرسانی برند موجود
                    $existingBrand->update([
                        'name' => $name,
                        'slug' => $slug,
                        'is_active' => true,
                        'sort_order' => $existingBrand->sort_order ?? 0
                    ]);
                    $updated++;
                    Log::info("Updated existing brand: {$name}");
                } else {
                    // اضافه کردن برند جدید
                    VehicleBrand::create([
                        'name' => $name,
                        'slug' => $slug,
                        'is_active' => true,
                        'sort_order' => 0,
                        'description' => "برند خودرو: {$name}",
                        'website' => null,
                        'models_completed' => false,
                        'models_updated_at' => null
                    ]);
                    $added++;
                    Log::info("Added new brand: {$name}");
                }
            }

            Log::info('Vehicle brands update completed', [
                'added' => $added,
                'updated' => $updated,
                'skipped' => $skipped,
                'total_processed' => count($brands)
            ]);

            return [
                'success' => true,
                'message' => 'به‌روزرسانی برندها با موفقیت انجام شد',
                'data' => [
                    'added' => $added,
                    'updated' => $updated,
                    'skipped' => $skipped,
                    'total_processed' => count($brands)
                ]
            ];

        } catch (\Exception $e) {
            Log::error('Error updating vehicle brands', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'خطا در به‌روزرسانی برندها: ' . $e->getMessage()
            ];
        }
    }

        /**
     * پردازش برندها و مدل‌هایشان یکی یکی
     */
    private function processBrandsAndModelsSequentially($limit, $forceUpdate = false)
    {
        try {
            Log::info('Starting sequential brand and model processing');

            // دریافت برندهایی که مدل‌هایشان کامل نشده یا force update درخواست شده
            $query = VehicleBrand::where('is_active', true);

            if (!$forceUpdate) {
                $query->where(function($q) {
                    $q->where('models_completed', false)
                      ->orWhereNull('models_updated_at');
                });
            }

            $brands = $query->orderBy('id')->limit($limit)->get();

            if ($brands->isEmpty()) {
                $this->info('✅ All brands have been processed!');
                return [
                    'success' => true,
                    'message' => 'هیچ برندی برای به‌روزرسانی یافت نشد',
                    'data' => [
                        'brands_processed' => 0,
                        'models_added' => 0,
                        'models_updated' => 0
                    ]
                ];
            }

            $this->info("🔄 Processing {$brands->count()} brands sequentially...");
            $this->newLine();

            $brandsProcessed = 0;
            $totalModelsAdded = 0;
            $totalModelsUpdated = 0;
            $errors = 0;

            foreach ($brands as $index => $brand) {
                $brandNumber = $index + 1;
                $this->info("📋 Brand {$brandNumber}/{$brands->count()}: {$brand->name} (ID: {$brand->id})");

                try {
                    $this->info("   🔄 Fetching models for {$brand->name}...");
                    $result = $this->updateModelsForBrand($brand);

                    if ($result['success']) {
                        $brandsProcessed++;
                        $totalModelsAdded += $result['data']['added'];
                        $totalModelsUpdated += $result['data']['updated'];

                        // علامت‌گذاری برند به عنوان کامل
                        $brand->update([
                            'models_completed' => true,
                            'models_updated_at' => now()
                        ]);

                        $this->info("   ✅ {$brand->name} completed successfully!");
                        $this->info("      📊 Models: Added {$result['data']['added']}, Updated {$result['data']['updated']}, Skipped {$result['data']['skipped']}");
                        $this->info("      📅 Last updated: " . now()->format('Y-m-d H:i:s'));

                    } else {
                        $errors++;
                        $this->warn("   ⚠️ Failed to process {$brand->name}: {$result['message']}");
                    }

                } catch (\Exception $e) {
                    $errors++;
                    Log::error("Error processing models for brand {$brand->name}", [
                        'brand_id' => $brand->id,
                        'error' => $e->getMessage()
                    ]);
                    $this->warn("   ❌ Error processing {$brand->name}: {$e->getMessage()}");
                }

                $this->newLine();
            }

            // نمایش خلاصه نتایج
            $this->info('📊 Processing Summary:');
            $this->info("   ✅ Brands processed successfully: {$brandsProcessed}");
            $this->info("   📈 Total models added: {$totalModelsAdded}");
            $this->info("   🔄 Total models updated: {$totalModelsUpdated}");
            if ($errors > 0) {
                $this->warn("   ⚠️ Errors encountered: {$errors}");
            }

            Log::info('Sequential brand and model processing completed', [
                'brands_processed' => $brandsProcessed,
                'models_added' => $totalModelsAdded,
                'models_updated' => $totalModelsUpdated,
                'errors' => $errors
            ]);

            return [
                'success' => true,
                'message' => 'پردازش برندها و مدل‌ها با موفقیت انجام شد',
                'data' => [
                    'brands_processed' => $brandsProcessed,
                    'models_added' => $totalModelsAdded,
                    'models_updated' => $totalModelsUpdated,
                    'errors' => $errors
                ]
            ];

        } catch (\Exception $e) {
            Log::error('Error in sequential brand and model processing', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'خطا در پردازش برندها و مدل‌ها: ' . $e->getMessage()
            ];
        }
    }

    /**
     * به‌روزرسانی مدل‌های یک برند خاص
     */
    private function updateModelsForBrand(VehicleBrand $brand)
    {
        try {
            // دریافت مدل‌های برند از API
            $response = Http::get("https://vpic.nhtsa.dot.gov/api/vehicles/GetModelsForMakeId/{$brand->id}?format=json");

            if (!$response->successful()) {
                Log::warning("Failed to fetch models for brand {$brand->name}", [
                    'brand_id' => $brand->id,
                    'status' => $response->status()
                ]);
                return [
                    'success' => false,
                    'message' => "خطا در دریافت مدل‌های برند {$brand->name}"
                ];
            }

            $data = $response->json();

            if (!isset($data['Results']) || !is_array($data['Results'])) {
                Log::warning("Invalid response format for brand {$brand->name}", ['data' => $data]);
                return [
                    'success' => false,
                    'message' => "فرمت پاسخ نامعتبر برای برند {$brand->name}"
                ];
            }

            $models = $data['Results'];
            $added = 0;
            $updated = 0;
            $skipped = 0;

            foreach ($models as $modelData) {
                if (!isset($modelData['Model_Name']) || empty($modelData['Model_Name'])) {
                    $skipped++;
                    continue;
                }

                $name = trim($modelData['Model_Name']);
                $baseSlug = Str::slug($name);

                // تولید slug یکتا
                $slug = $this->generateUniqueSlug($baseSlug, $brand->id);

                // بررسی وجود مدل با همین نام در این برند
                $existingModel = \App\Models\VehicleModel::where('brand_id', $brand->id)
                    ->where('name', $name)
                    ->first();

                if ($existingModel) {
                    // به‌روزرسانی مدل موجود
                    $existingModel->update([
                        'name' => $name,
                        'slug' => $slug,
                        'is_active' => true,
                        'sort_order' => $existingModel->sort_order ?? 0
                    ]);
                    $updated++;
                } else {
                    // اضافه کردن مدل جدید
                    try {
                        \App\Models\VehicleModel::create([
                            'brand_id' => $brand->id,
                            'name' => $name,
                            'slug' => $slug,
                            'is_active' => true,
                            'sort_order' => 0,
                            'description' => "مدل {$name} از برند {$brand->name}"
                        ]);
                        $added++;
                    } catch (\Illuminate\Database\QueryException $e) {
                        // اگر هنوز خطای duplicate entry داشتیم، slug جدید تولید کنیم
                        if ($e->getCode() == 23000 && str_contains($e->getMessage(), 'Duplicate entry')) {
                            $slug = $this->generateUniqueSlug($baseSlug, $brand->id, true);
                            \App\Models\VehicleModel::create([
                                'brand_id' => $brand->id,
                                'name' => $name,
                                'slug' => $slug,
                                'is_active' => true,
                                'sort_order' => 0,
                                'description' => "مدل {$name} از برند {$brand->name}"
                            ]);
                            $added++;
                        } else {
                            throw $e;
                        }
                    }
                }
            }

            Log::info("Processed models for brand: {$brand->name}", [
                'brand_id' => $brand->id,
                'models_count' => count($models),
                'added' => $added,
                'updated' => $updated,
                'skipped' => $skipped
            ]);

            return [
                'success' => true,
                'message' => "مدل‌های برند {$brand->name} با موفقیت به‌روزرسانی شد",
                'data' => [
                    'added' => $added,
                    'updated' => $updated,
                    'skipped' => $skipped,
                    'total' => count($models)
                ]
            ];

        } catch (\Exception $e) {
            Log::error("Error processing models for brand {$brand->name}", [
                'brand_id' => $brand->id,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => "خطا در پردازش مدل‌های برند {$brand->name}: " . $e->getMessage()
            ];
        }
    }

    /**
     * تولید slug یکتا برای مدل
     */
    private function generateUniqueSlug($baseSlug, $brandId, $forceUnique = false)
    {
        $slug = $baseSlug;
        $counter = 1;

        // اگر forceUnique باشد، از ابتدا با شماره شروع کنیم
        if ($forceUnique) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        // بررسی وجود slug در کل جدول
        while (\App\Models\VehicleModel::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * نمایش وضعیت کلی
     */
    private function displayOverallStatus()
    {
        $totalBrands = VehicleBrand::count();
        $activeBrands = VehicleBrand::where('is_active', true)->count();
        $completedBrands = VehicleBrand::where('models_completed', true)->count();
        $pendingBrands = $activeBrands - $completedBrands;

        $totalModels = \App\Models\VehicleModel::count();
        $activeModels = \App\Models\VehicleModel::where('is_active', true)->count();

        $this->info('📊 Overall Status:');
        $this->info("   Total brands: {$totalBrands}");
        $this->info("   Active brands: {$activeBrands}");
        $this->info("   Brands with completed models: {$completedBrands}");
        $this->info("   Brands pending model update: {$pendingBrands}");
        $this->info("   Total models: {$totalModels}");
        $this->info("   Active models: {$activeModels}");

        if ($pendingBrands > 0) {
            $this->warn("⚠️ {$pendingBrands} brands still need model updates. Run this command again to continue.");
        } else {
            $this->info('🎉 All brands have been processed!');
        }
    }
}
