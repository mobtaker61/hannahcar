<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VehicleVariant;

class VehicleVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ابتدا یک مدل نمونه ایجاد می‌کنیم
        $sampleModel = \App\Models\VehicleModel::first();

        if (!$sampleModel) {
            // اگر مدلی وجود ندارد، یک برند و مدل نمونه ایجاد می‌کنیم
            $brand = \App\Models\VehicleBrand::firstOrCreate(
                ['name' => 'Toyota'],
                ['name' => 'Toyota', 'name_en' => 'Toyota', 'slug' => 'toyota', 'is_active' => true]
            );

            $sampleModel = \App\Models\VehicleModel::firstOrCreate(
                ['name' => 'RAV4', 'brand_id' => $brand->id],
                ['name' => 'RAV4', 'name_en' => 'RAV4', 'slug' => 'rav4', 'brand_id' => $brand->id, 'is_active' => true]
            );
        }

        $vehicleVariants = [
            [
                'model_id' => $sampleModel->id,
                'name' => 'XLE',
                'name_en' => 'XLE',
                'description' => 'نسخه لوکس اقتصادی',
                'description_en' => 'Luxury Economy Edition',
                'icon' => 'fas fa-star',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'model_id' => $sampleModel->id,
                'name' => 'Hybrid',
                'name_en' => 'Hybrid',
                'description' => 'نسخه هیبریدی',
                'description_en' => 'Hybrid Edition',
                'icon' => 'fas fa-leaf',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'model_id' => $sampleModel->id,
                'name' => 'Navigator',
                'name_en' => 'Navigator',
                'description' => 'نسخه ناوبری',
                'description_en' => 'Navigation Edition',
                'icon' => 'fas fa-map-marker-alt',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'model_id' => $sampleModel->id,
                'name' => 'Smart Drive',
                'name_en' => 'Smart Drive',
                'description' => 'نسخه رانندگی هوشمند',
                'description_en' => 'Smart Driving Edition',
                'icon' => 'fas fa-brain',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'model_id' => $sampleModel->id,
                'name' => 'Sport',
                'name_en' => 'Sport',
                'description' => 'نسخه ورزشی',
                'description_en' => 'Sport Edition',
                'icon' => 'fas fa-tachometer-alt',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'model_id' => $sampleModel->id,
                'name' => 'Premium',
                'name_en' => 'Premium',
                'description' => 'نسخه پریمیوم',
                'description_en' => 'Premium Edition',
                'icon' => 'fas fa-crown',
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'model_id' => $sampleModel->id,
                'name' => 'Limited',
                'name_en' => 'Limited',
                'description' => 'نسخه محدود',
                'description_en' => 'Limited Edition',
                'icon' => 'fas fa-gem',
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'model_id' => $sampleModel->id,
                'name' => 'Base',
                'name_en' => 'Base',
                'description' => 'نسخه پایه',
                'description_en' => 'Base Edition',
                'icon' => 'fas fa-car',
                'is_active' => true,
                'sort_order' => 8,
            ],
        ];

        foreach ($vehicleVariants as $vehicleVariant) {
            VehicleVariant::updateOrCreate(
                ['name' => $vehicleVariant['name'], 'model_id' => $vehicleVariant['model_id']],
                $vehicleVariant
            );
        }

        $this->command->info('Vehicle Variants seeded successfully!');
    }
}
