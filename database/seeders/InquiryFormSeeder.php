<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InquiryForm;

class InquiryFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $forms = [
            [
                'slug' => 'special_car_purchase',
                'name' => 'Special Car Purchase',
                'title' => 'درخواست خرید خودرو خاص',
                'description' => 'فرم درخواست خرید خودروهای خاص و نادر که در بازار معمول موجود نیستند.',
                'route_name' => 'inquiry-forms.show',
                'controller' => 'App\\Http\\Controllers\\InquirySpecialCarPurchaseController',
                'model' => 'App\\Models\\InquirySpecialCarPurchase',
                'icon' => 'car',
                'color' => 'blue',
                'is_active' => true,
                'sort_order' => 1,
                'fields' => [
                    'car_brand' => ['type' => 'text', 'label' => 'برند خودرو', 'required' => false],
                    'car_model' => ['type' => 'text', 'label' => 'مدل خودرو', 'required' => false],
                    'car_year' => ['type' => 'number', 'label' => 'سال ساخت', 'required' => false],
                    'description' => ['type' => 'textarea', 'label' => 'توضیحات تکمیلی', 'required' => false],
                ],
            ],
            [
                'slug' => 'special_spare_part',
                'name' => 'Special Spare Part',
                'title' => 'درخواست قطعه یدکی خاص',
                'description' => 'فرم درخواست قطعات یدکی خاص و نادر که در بازار معمول موجود نیستند.',
                'route_name' => 'inquiry-forms.show',
                'controller' => 'App\\Http\\Controllers\\InquirySpecialSparePartController',
                'model' => 'App\\Models\\InquirySpecialSparePart',
                'icon' => 'spare-part',
                'color' => 'green',
                'is_active' => true,
                'sort_order' => 2,
                'fields' => [
                    'part_name' => ['type' => 'text', 'label' => 'نام قطعه', 'required' => false],
                    'car_brand' => ['type' => 'text', 'label' => 'برند خودرو', 'required' => false],
                    'car_model' => ['type' => 'text', 'label' => 'مدل خودرو', 'required' => false],
                    'car_year' => ['type' => 'number', 'label' => 'سال ساخت', 'required' => false],
                    'description' => ['type' => 'textarea', 'label' => 'توضیحات تکمیلی', 'required' => false],
                ],
            ],
            [
                'slug' => 'vin_check',
                'name' => 'VIN Check',
                'title' => 'استعلام VIN Number',
                'description' => 'فرم استعلام و بررسی شماره VIN خودرو برای دریافت اطلاعات کامل.',
                'route_name' => 'inquiry-forms.show',
                'controller' => 'App\\Http\\Controllers\\InquiryVinCheckController',
                'model' => 'App\\Models\\InquiryVinCheck',
                'icon' => 'vin-check',
                'color' => 'purple',
                'is_active' => true,
                'sort_order' => 3,
                'fields' => [
                    'vin_number' => ['type' => 'text', 'label' => 'شماره VIN', 'required' => true],
                    'car_brand' => ['type' => 'text', 'label' => 'برند خودرو', 'required' => false],
                    'car_model' => ['type' => 'text', 'label' => 'مدل خودرو', 'required' => false],
                    'description' => ['type' => 'textarea', 'label' => 'توضیحات تکمیلی', 'required' => false],
                ],
            ],
        ];

        foreach ($forms as $form) {
            InquiryForm::updateOrCreate(
                ['slug' => $form['slug']],
                $form
            );
        }
    }
}
