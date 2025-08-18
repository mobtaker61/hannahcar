<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CarApiService;
use App\Models\Vehicle;
use App\Models\VehicleBrand;
use App\Models\VehicleModel;
use App\Models\VehicleGallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SyncCarsFromApi extends Command
{
    protected $signature = 'cars:sync-from-api {--limit=100} {--force} {--check-only} {--debug}';
    protected $description = 'همگام‌سازی خودروها از API پایتون';

    protected $carApiService;

    public function __construct(CarApiService $carApiService)
    {
        parent::__construct();
        $this->carApiService = $carApiService;
    }

    public function handle()
    {
        $this->info('🚗 شروع همگام‌سازی خودروها از API...');

        // بررسی وضعیت API
        if (!$this->checkApiStatus()) {
            $this->error('❌ API پایتون در دسترس نیست');
            return 1;
        }

        $limit = $this->option('limit');
        $force = $this->option('force');

        try {
            // دریافت خودروهای sync نشده از API
            $carsData = $this->carApiService->getCars(1, $limit, false);

            if (!$carsData || !isset($carsData['cars'])) {
                $this->error('❌ خطا در دریافت خودروها از API');
                return 1;
            }

            $this->info("📊 تعداد خودروهای sync نشده: " . count($carsData['cars']));

            if ($this->option('debug')) {
                $this->line('🔍 داده‌های دریافتی از API:');
                $this->line(json_encode($carsData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                $this->newLine();
            }

            $imported = 0;
            $updated = 0;
            $errors = 0;
            $synced = 0;

            $bar = $this->output->createProgressBar(count($carsData['cars']));
            $bar->start();

            foreach ($carsData['cars'] as $carData) {
                try {
                    // بررسی وضعیت sync
                    $isAlreadySynced = $carData['is_synced'] ?? false;

                    if ($isAlreadySynced && !$force) {
                        if ($this->option('debug')) {
                            $this->line("⏭️ خودرو ID: {$carData['id']} قبلاً sync شده است");
                        }
                        $bar->advance();
                        continue;
                    }

                    if ($this->option('debug')) {
                        $this->info("🔍 پردازش خودرو ID: " . $carData['id']);
                    }

                    // پردازش خودرو (ایجاد یا بروزرسانی)
                    $result = $this->processCar($carData, $force);

                    if ($result === 'imported') {
                        $imported++;
                        if ($this->option('debug')) {
                            $this->info("📥 خودرو جدید ایجاد شد: ID {$carData['id']}");
                        }
                    } elseif ($result === 'updated') {
                        $updated++;
                        if ($this->option('debug')) {
                            $this->info("🔄 خودرو موجود بروزرسانی شد: ID {$carData['id']}");
                        }
                    }

                    // دریافت جزئیات کامل و تصاویر
                    $this->info("📥 دریافت جزئیات کامل برای خودرو ID: " . $carData['id']);
                    $fullDetailsResult = $this->processCarFullDetails($carData['id']);

                    if ($fullDetailsResult) {
                        // اعلام sync شدن به API پایتون
                        $this->markCarAsSynced($carData['id']);
                        if ($this->option('debug')) {
                            $this->info("✅ خودرو ID: {$carData['id']} به عنوان sync شده علامت‌گذاری شد");
                        }
                    }

                } catch (\Exception $e) {
                    $errors++;
                    if ($this->option('debug')) {
                        $this->error('❌ خطا در پردازش خودرو: ' . $e->getMessage());
                        $this->line('داده‌های خودرو: ' . json_encode($carData, JSON_UNESCAPED_UNICODE));
                        $this->newLine();
                    }
                    Log::error('خطا در پردازش خودرو: ' . $e->getMessage(), [
                        'car_data' => $carData
                    ]);
                }

                $bar->advance();
            }

            $bar->finish();
            $this->newLine(2);

            $this->info('✅ همگام‌سازی تکمیل شد!');
            $this->table(
                ['عملیات', 'تعداد'],
                [
                    ['جدید', $imported],
                    ['بروزرسانی', $updated],
                    ['خطا', $errors],
                ]
            );

            return 0;

        } catch (\Exception $e) {
            $this->error('❌ خطای کلی در همگام‌سازی: ' . $e->getMessage());
            Log::error('خطای کلی در همگام‌سازی: ' . $e->getMessage());
            return 1;
        }
    }

    protected function checkApiStatus()
    {
        if ($this->carApiService->healthCheck()) {
            $this->info('✅ API پایتون در دسترس است');
            return true;
        } else {
            $this->error('❌ API پایتون در دسترس نیست');
            return false;
        }
    }

    protected function processCar($carData, $force = false)
    {
        // بررسی وجود خودرو با external_id
        $vehicle = Vehicle::where('external_id', $carData['id'])->first();

        // اگر خودرو موجود است و force نیست، skip کن
        if ($vehicle && !$force) {
            return 'skipped';
        }

        if ($vehicle) {
            // بروزرسانی خودرو موجود
            $this->updateVehicle($vehicle, $carData);
            return 'updated';
        } else {
            // ایجاد خودرو جدید
            $newVehicle = $this->createVehicle($carData);
            return 'imported';
        }
    }

    protected function processCarFullDetails($externalId)
    {
        try {
            $fullData = $this->carApiService->getCarFullDetails($externalId);

            if (!$fullData || !isset($fullData['car'])) {
                Log::error('دریافت جزئیات کامل برای خودرو ID: ' . $externalId . ' ناموفق');
                return false;
            }

            $carData = $fullData['car'];
            $carDetails = $fullData['car_details'] ?? [];
            $carImages = $fullData['car_images'] ?? [];
            $carAttributes = $fullData['car_attributes'] ?? [];

            $vehicle = Vehicle::where('external_id', $externalId)->first();

            if ($vehicle) {
                // بروزرسانی خودرو با اطلاعات کامل
                $this->updateVehicleWithFullDetails($vehicle, $carData, $carDetails, $carAttributes);

                // پردازش تصاویر
                if (!empty($carImages)) {
                    $this->processCarImages($vehicle, $carImages);
                }
                return true;
            } else {
                Log::error('خودرو با external_id: ' . $externalId . ' یافت نشد');
                return false;
            }

        } catch (\Exception $e) {
            Log::error('خطا در پردازش جزئیات کامل خودرو ID: ' . $externalId . ': ' . $e->getMessage());
            return false;
        }
    }

    protected function extractBrandFromTitle($title)
    {
        // استخراج برند از عنوان (اولین کلمه)
        $words = explode(' ', trim($title));
        return $words[0] ?? 'Unknown';
    }

    protected function extractModelFromTitle($title)
    {
        // استخراج مدل از عنوان (کلمات دوم و سوم)
        $words = explode(' ', trim($title));
        if (count($words) >= 2) {
            return $words[1] . (isset($words[2]) ? ' ' . $words[2] : '');
        }
        return 'Unknown';
    }

    protected function findOrCreateBrand($brandName)
    {
        return VehicleBrand::firstOrCreate(
            ['name' => ucfirst(strtolower($brandName))],
            [
                'name' => ucfirst(strtolower($brandName)),
                'slug' => Str::slug($brandName),
                'is_active' => true,
                'sort_order' => 0
            ]
        );
    }

    protected function findOrCreateModel($brandId, $modelName)
    {
        return VehicleModel::firstOrCreate(
            [
                'brand_id' => $brandId,
                'name' => ucfirst(strtolower($modelName))
            ],
            [
                'brand_id' => $brandId,
                'name' => ucfirst(strtolower($modelName)),
                'slug' => Str::slug($modelName),
                'is_active' => true,
                'sort_order' => 0
            ]
        );
    }

    protected function createVehicle($carData)
    {
        // استخراج برند و مدل از عنوان
        $brandName = $this->extractBrandFromTitle($carData['title']);
        $modelName = $this->extractModelFromTitle($carData['title']);

        // پردازش برند و مدل
        $brand = $this->findOrCreateBrand($brandName);
        $model = $this->findOrCreateModel($brand->id, $modelName);

        $vehicle = Vehicle::create([
            'external_id' => $carData['id'],
            'brand_id' => $brand->id,
            'model_id' => $model->id,
            'year' => date('Y'), // سال بعداً از car_details بروزرسانی می‌شود
            'price' => $carData['price'] ?? 0,
            'currency' => $carData['price_currency'] ?? 'AED',
            'status' => 'used', // همه خودروها used هستند
            'publish_status' => 'published',
            'is_available' => true,
            'description' => $carData['title'] ?? '',
            'mileage' => intval($carData['mileage'] ?? 0),
            'slug' => Str::slug($carData['title'] ?? $brand->name . ' ' . $model->name) . '-' . $carData['id'] . '-' . time(),
        ]);

        return $vehicle;
    }

    protected function updateVehicle($vehicle, $carData)
    {
        // استخراج برند و مدل از عنوان
        $brandName = $this->extractBrandFromTitle($carData['title']);
        $modelName = $this->extractModelFromTitle($carData['title']);

        // پردازش برند و مدل
        $brand = $this->findOrCreateBrand($brandName);
        $model = $this->findOrCreateModel($brand->id, $modelName);

        $vehicle->update([
            'brand_id' => $brand->id,
            'model_id' => $model->id,
            'year' => $vehicle->year, // سال بعداً از car_details بروزرسانی می‌شود
            'price' => $carData['price'] ?? $vehicle->price,
            'currency' => $carData['price_currency'] ?? $vehicle->currency,
            'status' => 'used',
            'description' => $carData['title'] ?? $vehicle->description,
            'mileage' => intval($carData['mileage'] ?? $vehicle->mileage),
        ]);
    }

    protected function updateVehicleWithFullDetails($vehicle, $carData, $carDetails, $carAttributes)
    {
        // بروزرسانی اطلاعات اصلی خودرو
        $updateData = [
            'price' => $carData['price'] ?? $vehicle->price,
            'currency' => $carData['price_currency'] ?? $vehicle->currency,
            'mileage' => intval($carData['mileage'] ?? $vehicle->mileage),
            'description' => $carData['title'] ?? $vehicle->description,
        ];

        // بروزرسانی VIN number از vehicle_id در car_details
        if (!empty($carDetails) && isset($carDetails[0]['vehicle_id'])) {
            $updateData['vin_number'] = $carDetails[0]['vehicle_id'];
        }

        $vehicle->update($updateData);

        // پردازش جزئیات اضافی (car_details)
        if (!empty($carDetails)) {
            $this->processCarDetails($vehicle, $carDetails[0]); // اولین مورد
        }

        // پردازش ویژگی‌ها (car_attributes)
        if (!empty($carAttributes)) {
            $this->processCarAttributes($vehicle, $carAttributes);
        }
    }

    protected function processCarDetails($vehicle, $carDetail)
    {
        // بروزرسانی اطلاعات اضافی خودرو
        $updateData = [];

        // بروزرسانی سال مدل
        if (isset($carDetail['model_year'])) {
            $updateData['year'] = intval($carDetail['model_year']);
        }

        // بروزرسانی نوع بدنه
        if (isset($carDetail['body_type']) && $carDetail['body_type']) {
            $bodyType = $this->findOrCreateBodyType($carDetail['body_type']);
            if ($bodyType) {
                $updateData['body_type_id'] = $bodyType->id;
            }
        }

        // بروزرسانی نوع سوخت
        if (isset($carDetail['fuel_type']) && $carDetail['fuel_type']) {
            $fuelType = $this->findOrCreateFuelType($carDetail['fuel_type']);
            if ($fuelType) {
                $updateData['fuel_type_id'] = $fuelType->id;
            }
        }

        // بروزرسانی نوع گیربکس
        if (isset($carDetail['transmission_type']) && $carDetail['transmission_type']) {
            $transmissionType = $this->findOrCreateTransmissionType($carDetail['transmission_type']);
            if ($transmissionType) {
                $updateData['transmission_type_id'] = $transmissionType->id;
            }
        }

        // بروزرسانی رنگ خارجی
        if (isset($carDetail['exterior_colors']) && $carDetail['exterior_colors']) {
            $exteriorColor = $this->findOrCreateExteriorColor($carDetail['exterior_colors']);
            if ($exteriorColor) {
                $updateData['exterior_color_id'] = $exteriorColor->id;
            }
        }

        // بروزرسانی رنگ داخلی
        if (isset($carDetail['interior_colors']) && $carDetail['interior_colors']) {
            $interiorColor = $this->findOrCreateInteriorColor($carDetail['interior_colors']);
            if ($interiorColor) {
                $updateData['interior_color_id'] = $interiorColor->id;
            }
        }

        // بروزرسانی slug با VIN number
        if (isset($carDetail['vehicle_id']) && $carDetail['vehicle_id']) {
            $updateData['slug'] = Str::slug($vehicle->description ?? 'vehicle') . '-' . $carDetail['vehicle_id'];
        }

        if (!empty($updateData)) {
            $vehicle->update($updateData);
        }
    }

    protected function processCarAttributes($vehicle, $attributes)
    {
        if (empty($attributes)) {
            return;
        }

        $simpleFeatures = [];

        foreach ($attributes as $attribute) {
            // فقط ویژگی‌های ساده را در features ذخیره کن
            if (isset($attribute['attribute_value']) && is_string($attribute['attribute_value'])) {
                $simpleFeatures[] = $attribute['attribute_value'];
            }
        }

        // بروزرسانی فیلد features با ویژگی‌های ساده
        if (!empty($simpleFeatures)) {
            $vehicle->update(['features' => $simpleFeatures]);
        }

        if ($this->option('debug')) {
            $this->info("✅ پردازش ویژگی‌های خودرو {$vehicle->id} تکمیل شد");
        }
    }

    protected function processCarImages($vehicle, $images)
    {
        if (empty($images)) {
            return;
        }

        // حذف تصاویر موجود از دیتابیس
        $vehicle->gallery()->delete();

        // حذف فایل‌های تصاویر قبلی از storage
        $vehicleFolder = "vehicles/gallery/{$vehicle->id}";
        if (Storage::disk('public')->exists($vehicleFolder)) {
            Storage::disk('public')->deleteDirectory($vehicleFolder);
        }

        // ایجاد پوشه برای خودرو
        Storage::disk('public')->makeDirectory($vehicleFolder);

        // دانلود و ذخیره تصاویر
        foreach ($images as $index => $imageData) {
            try {
                $imageUrl = $imageData['image_url'];
                $imageContent = $this->carApiService->downloadImage($imageUrl);

                if ($imageContent) {
                    // نام فایل با timestamp
                    $timestamp = time();
                    $fileName = "{$vehicle->id}_{$timestamp}_{$index}.jpg";
                    $filePath = "{$vehicleFolder}/{$fileName}";

                    // ذخیره فایل
                    Storage::disk('public')->put($filePath, $imageContent);

                    // ایجاد رکورد در دیتابیس
                    VehicleGallery::create([
                        'vehicle_id' => $vehicle->id,
                        'image_path' => $filePath,
                        'image_type' => $imageData['image_type'] ?? 'gallery',
                        'alt_text' => $imageData['alt_text'] ?? $vehicle->description,
                        'sort_order' => $index,
                        'is_active' => true
                    ]);

                    // تنظیم تصویر اول به عنوان featured_image
                    if ($index === 0) {
                        $vehicle->update(['featured_image' => $filePath]);
                    }

                    if ($this->option('debug')) {
                        $this->info("📸 تصویر دانلود شد: {$filePath}");
                    }
                }
            } catch (\Exception $e) {
                if ($this->option('debug')) {
                    $this->error("❌ خطا در دانلود تصویر: " . $e->getMessage());
                }
                Log::error('خطا در دانلود تصویر: ' . $e->getMessage(), [
                    'vehicle_id' => $vehicle->id,
                    'image_url' => $imageData['image_url'] ?? 'N/A'
                ]);
            }
        }

        if ($this->option('debug')) {
            $this->info("✅ پردازش تصاویر برای خودرو {$vehicle->id} تکمیل شد");
        }
    }

    protected function findOrCreateBodyType($bodyTypeName)
    {
        return \App\Models\BodyType::firstOrCreate(
            ['name' => ucfirst(strtolower($bodyTypeName))],
            [
                'name' => ucfirst(strtolower($bodyTypeName)),
                'status' => 'active',
                'sort_order' => 0
            ]
        );
    }

    protected function findOrCreateFuelType($fuelTypeName)
    {
        return \App\Models\FuelType::firstOrCreate(
            ['name' => ucfirst(strtolower($fuelTypeName))],
            [
                'name' => ucfirst(strtolower($fuelTypeName)),
                'status' => 'active',
                'sort_order' => 0
            ]
        );
    }

    protected function findOrCreateTransmissionType($transmissionTypeName)
    {
        return \App\Models\TransmissionType::firstOrCreate(
            ['name' => ucfirst(strtolower($transmissionTypeName))],
            [
                'name' => ucfirst(strtolower($transmissionTypeName)),
                'status' => 'active',
                'sort_order' => 0
            ]
        );
    }

    protected function findOrCreateExteriorColor($colorName)
    {
        return \App\Models\ExteriorColor::firstOrCreate(
            ['name' => ucfirst(strtolower($colorName))],
            [
                'name' => ucfirst(strtolower($colorName)),
                'slug' => Str::slug($colorName),
                'is_active' => true,
                'sort_order' => 0
            ]
        );
    }

    protected function findOrCreateInteriorColor($colorName)
    {
        return \App\Models\InteriorColor::firstOrCreate(
            ['name' => ucfirst(strtolower($colorName))],
            [
                'name' => ucfirst(strtolower($colorName)),
                'slug' => Str::slug($colorName),
                'is_active' => true,
                'sort_order' => 0
            ]
        );
    }

    protected function markCarAsSynced($externalId)
    {
        try {
            $this->carApiService->markCarAsSynced($externalId);
            Log::info('خودرو با external_id: ' . $externalId . ' به عنوان sync شده علامت‌گذاری شد');
        } catch (\Exception $e) {
            Log::error('خطا در علامت‌گذاری خودرو به عنوان sync شده: ' . $e->getMessage(), [
                'external_id' => $externalId
            ]);
        }
    }
}
