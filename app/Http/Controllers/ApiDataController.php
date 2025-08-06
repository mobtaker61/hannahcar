<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\VehicleBrand;
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
