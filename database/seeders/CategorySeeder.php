<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Language;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = Language::all();

        $categories = [
            [
                'slug' => 'automotive-news',
                'translations' => [
                    'fa' => [
                        'name' => 'اخبار خودرو',
                        'description' => 'آخرین اخبار و اطلاعات مربوط به صنعت خودرو',
                        'meta_title' => 'اخبار خودرو - آخرین اخبار صنعت خودرو',
                        'meta_description' => 'آخرین اخبار، اطلاعات و تحلیل‌های مربوط به صنعت خودرو در ایران و جهان',
                    ],
                    'en' => [
                        'name' => 'Automotive News',
                        'description' => 'Latest news and information about the automotive industry',
                        'meta_title' => 'Automotive News - Latest Automotive Industry News',
                        'meta_description' => 'Latest news, information and analysis about the automotive industry in Iran and the world',
                    ],
                    'ar' => [
                        'name' => 'أخبار السيارات',
                        'description' => 'أحدث الأخبار والمعلومات حول صناعة السيارات',
                        'meta_title' => 'أخبار السيارات - أحدث أخبار صناعة السيارات',
                        'meta_description' => 'أحدث الأخبار والمعلومات والتحليلات حول صناعة السيارات في إيران والعالم',
                    ],
                ],
            ],
            [
                'slug' => 'car-reviews',
                'translations' => [
                    'fa' => [
                        'name' => 'بررسی خودرو',
                        'description' => 'بررسی و نقد خودروهای مختلف با جزئیات کامل',
                        'meta_title' => 'بررسی خودرو - نقد و بررسی خودروهای مختلف',
                        'meta_description' => 'بررسی و نقد خودروهای مختلف با جزئیات کامل شامل امکانات، عملکرد و قیمت',
                    ],
                    'en' => [
                        'name' => 'Car Reviews',
                        'description' => 'Review and critique of various vehicles with complete details',
                        'meta_title' => 'Car Reviews - Review and Critique of Various Vehicles',
                        'meta_description' => 'Review and critique of various vehicles with complete details including features, performance and price',
                    ],
                    'ar' => [
                        'name' => 'مراجعة السيارات',
                        'description' => 'مراجعة ونقد السيارات المختلفة مع تفاصيل كاملة',
                        'meta_title' => 'مراجعة السيارات - مراجعة ونقد السيارات المختلفة',
                        'meta_description' => 'مراجعة ونقد السيارات المختلفة مع تفاصيل كاملة تشمل الميزات والأداء والسعر',
                    ],
                ],
            ],
            [
                'slug' => 'services',
                'translations' => [
                    'fa' => [
                        'name' => 'خدمات',
                        'description' => 'خدمات تخصصی تامین، واردات و ترخیص خودرو',
                        'meta_title' => 'خدمات خودرو - تامین، واردات و ترخیص',
                        'meta_description' => 'خدمات تخصصی تامین خودرو، واردات، ترخیص، قطعات یدکی و بازرسی خودرو',
                    ],
                    'en' => [
                        'name' => 'Services',
                        'description' => 'Specialized services for vehicle supply, import and clearance',
                        'meta_title' => 'Vehicle Services - Supply, Import and Clearance',
                        'meta_description' => 'Specialized services for vehicle supply, import, clearance, spare parts and vehicle inspection',
                    ],
                    'ar' => [
                        'name' => 'الخدمات',
                        'description' => 'خدمات متخصصة لتوريد واستيراد وترخیص السيارات',
                        'meta_title' => 'خدمات السيارات - التوريد والاستيراد والترخیص',
                        'meta_description' => 'خدمات متخصصة لتوريد السيارات والاستيراد والترخیص والقطع الاحتياطية وفحص السيارات',
                    ],
                ],
            ],
            [
                'slug' => 'maintenance-tips',
                'translations' => [
                    'fa' => [
                        'name' => 'نکات نگهداری',
                        'description' => 'نکات و راهنمایی‌های نگهداری خودرو',
                        'meta_title' => 'نکات نگهداری خودرو - راهنمایی نگهداری',
                        'meta_description' => 'نکات مهم و راهنمایی‌های کاربردی برای نگهداری صحیح خودرو',
                    ],
                    'en' => [
                        'name' => 'Maintenance Tips',
                        'description' => 'Car maintenance tips and guides',
                        'meta_title' => 'Car Maintenance Tips - Maintenance Guide',
                        'meta_description' => 'Important tips and practical guides for proper car maintenance',
                    ],
                    'ar' => [
                        'name' => 'نصائح الصيانة',
                        'description' => 'نصائح وأدلة صيانة السيارات',
                        'meta_title' => 'نصائح صيانة السيارات - دليل الصيانة',
                        'meta_description' => 'نصائح مهمة وأدلة عملية للصيانة الصحيحة للسيارات',
                    ],
                ],
            ],
            [
                'slug' => 'technology',
                'translations' => [
                    'fa' => [
                        'name' => 'فناوری',
                        'description' => 'آخرین فناوری‌های خودرو',
                        'meta_title' => 'فناوری خودرو - آخرین فناوری‌ها',
                        'meta_description' => 'آخرین فناوری‌ها و نوآوری‌های صنعت خودرو',
                    ],
                    'en' => [
                        'name' => 'Technology',
                        'description' => 'Latest automotive technologies',
                        'meta_title' => 'Automotive Technology - Latest Technologies',
                        'meta_description' => 'Latest technologies and innovations in the automotive industry',
                    ],
                    'ar' => [
                        'name' => 'التكنولوجيا',
                        'description' => 'أحدث تكنولوجيات السيارات',
                        'meta_title' => 'تكنولوجيا السيارات - أحدث التكنولوجيات',
                        'meta_description' => 'أحدث التكنولوجيات والابتكارات في صناعة السيارات',
                    ],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = Category::create([
                'slug' => $categoryData['slug'],
                'is_active' => true,
                'sort_order' => 0,
            ]);

            foreach ($categoryData['translations'] as $langCode => $translation) {
                $language = $languages->where('code', $langCode)->first();
                if ($language) {
                    $category->translations()->create([
                        'language_id' => $language->id,
                        'name' => $translation['name'],
                        'description' => $translation['description'],
                        'meta_title' => $translation['meta_title'],
                        'meta_description' => $translation['meta_description'],
                    ]);
                }
            }
        }
    }
}
