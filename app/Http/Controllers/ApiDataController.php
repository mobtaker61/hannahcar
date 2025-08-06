<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\VehicleBrand;
use App\Models\VehicleModel;
use Illuminate\Support\Str;

class ApiDataController extends Controller
{
        /**
     * به‌روزرسانی برندهای خودرو از API NHTSA
     */
    public function updateVehicleBrands()
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
                        'website' => null
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
                'message' => "به‌روزرسانی برندها با موفقیت انجام شد",
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
     * نمایش وضعیت برندهای موجود
     */
    public function getVehicleBrandsStatus()
    {
        $totalBrands = VehicleBrand::count();
        $activeBrands = VehicleBrand::where('is_active', true)->count();
        $inactiveBrands = VehicleBrand::where('is_active', false)->count();

        return [
            'success' => true,
            'data' => [
                'total_brands' => $totalBrands,
                'active_brands' => $activeBrands,
                'inactive_brands' => $inactiveBrands,
                'recent_brands' => VehicleBrand::orderBy('created_at', 'desc')
                    ->take(10)
                    ->get(['id', 'name', 'slug', 'is_active', 'created_at'])
            ]
        ];
    }

        /**
     * به‌روزرسانی مدل‌های خودرو از API NHTSA
     */
    public function updateVehicleModels()
    {
        try {
            Log::info('Starting vehicle models update from NHTSA API');

            // دریافت تمام برندهای فعال
            $brands = VehicleBrand::where('is_active', true)->get();
            $totalModels = 0;
            $added = 0;
            $updated = 0;
            $skipped = 0;
            $errors = 0;

            foreach ($brands as $brand) {
                try {
                    // دریافت مدل‌های هر برند
                    $response = Http::get("https://vpic.nhtsa.dot.gov/api/vehicles/GetModelsForMakeId/{$brand->id}?format=json");

                    if (!$response->successful()) {
                        Log::warning("Failed to fetch models for brand {$brand->name}", [
                            'brand_id' => $brand->id,
                            'status' => $response->status()
                        ]);
                        $errors++;
                        continue;
                    }

                    $data = $response->json();

                    if (!isset($data['Results']) || !is_array($data['Results'])) {
                        Log::warning("Invalid response format for brand {$brand->name}", ['data' => $data]);
                        $errors++;
                        continue;
                    }

                    $models = $data['Results'];

                    foreach ($models as $modelData) {
                        if (!isset($modelData['Model_Name']) || empty($modelData['Model_Name'])) {
                            $skipped++;
                            continue;
                        }

                        $name = trim($modelData['Model_Name']);
                        $slug = Str::slug($name);

                        // بررسی وجود مدل با همین نام یا slug در این برند
                        $existingModel = VehicleModel::where('brand_id', $brand->id)
                            ->where(function($query) use ($name, $slug) {
                                $query->where('name', $name)
                                      ->orWhere('slug', $slug);
                            })
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
                            VehicleModel::create([
                                'brand_id' => $brand->id,
                                'name' => $name,
                                'slug' => $slug,
                                'is_active' => true,
                                'sort_order' => 0,
                                'description' => "مدل {$name} از برند {$brand->name}"
                            ]);
                            $added++;
                        }

                        $totalModels++;
                    }

                    Log::info("Processed models for brand: {$brand->name}", [
                        'brand_id' => $brand->id,
                        'models_count' => count($models)
                    ]);

                } catch (\Exception $e) {
                    Log::error("Error processing models for brand {$brand->name}", [
                        'brand_id' => $brand->id,
                        'error' => $e->getMessage()
                    ]);
                    $errors++;
                }
            }

            Log::info('Vehicle models update completed', [
                'added' => $added,
                'updated' => $updated,
                'skipped' => $skipped,
                'errors' => $errors,
                'total_models' => $totalModels,
                'total_brands_processed' => $brands->count()
            ]);

            return [
                'success' => true,
                'message' => "به‌روزرسانی مدل‌ها با موفقیت انجام شد",
                'data' => [
                    'added' => $added,
                    'updated' => $updated,
                    'skipped' => $skipped,
                    'errors' => $errors,
                    'total_models' => $totalModels,
                    'total_brands_processed' => $brands->count()
                ]
            ];

        } catch (\Exception $e) {
            Log::error('Error updating vehicle models', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'خطا در به‌روزرسانی مدل‌ها: ' . $e->getMessage()
            ];
        }
    }

    /**
     * به‌روزرسانی کامل برندها و مدل‌ها
     */
    public function updateAllVehicleData()
    {
        Log::info('Starting complete vehicle data update');

        // ابتدا برندها را به‌روزرسانی کن
        $brandsResult = $this->updateVehicleBrands();

        if (!$brandsResult['success']) {
            return $brandsResult;
        }

        // سپس مدل‌ها را به‌روزرسانی کن
        $modelsResult = $this->updateVehicleModels();

        if (!$modelsResult['success']) {
            return $modelsResult;
        }

        return [
            'success' => true,
            'message' => 'به‌روزرسانی کامل برندها و مدل‌ها با موفقیت انجام شد',
            'data' => [
                'brands' => $brandsResult['data'],
                'models' => $modelsResult['data']
            ]
        ];
    }

    /**
     * نمایش وضعیت مدل‌های موجود
     */
    public function getVehicleModelsStatus()
    {
        $totalModels = VehicleModel::count();
        $activeModels = VehicleModel::where('is_active', true)->count();
        $inactiveModels = VehicleModel::where('is_active', false)->count();

        return [
            'success' => true,
            'data' => [
                'total_models' => $totalModels,
                'active_models' => $activeModels,
                'inactive_models' => $inactiveModels,
                'recent_models' => VehicleModel::with('brand')
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get(['id', 'brand_id', 'name', 'slug', 'is_active', 'created_at'])
            ]
        ];
    }

    /**
     * پاک کردن مدل‌های غیرفعال
     */
    public function cleanupInactiveModels()
    {
        $deleted = VehicleModel::where('is_active', false)->delete();

        Log::info("Cleaned up inactive models", ['deleted_count' => $deleted]);

        return [
            'success' => true,
            'message' => "{$deleted} مدل غیرفعال حذف شد",
            'data' => ['deleted_count' => $deleted]
        ];
    }

    /**
     * پاک کردن برندهای غیرفعال
     */
    public function cleanupInactiveBrands()
    {
        $deleted = VehicleBrand::where('is_active', false)->delete();

        Log::info("Cleaned up inactive brands", ['deleted_count' => $deleted]);

        return [
            'success' => true,
            'message' => "{$deleted} برند غیرفعال حذف شد",
            'data' => ['deleted_count' => $deleted]
        ];
    }
}
