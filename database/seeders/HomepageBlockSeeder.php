<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HomepageBlock;
use App\Models\HomepageBlockTranslation;
use App\Models\Language;

class HomepageBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = Language::all();

        // Sample block data
        $blocks = [
            [
                'type' => 'featured',
                'image' => 'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=800&h=400&fit=crop',
                'button_url' => '/vehicles',
                'icon' => 'fas fa-star',
                'background_color' => '#FEF3C7',
                'sort_order' => 1,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'title' => 'خودروهای ویژه',
                        'subtitle' => 'بهترین انتخاب‌ها',
                        'description' => 'مجموعه‌ای از بهترین و محبوب‌ترین خودروهای موجود در بازار را مشاهده کنید.',
                        'button_text' => 'مشاهده خودروها',
                        'meta_data' => json_encode(['featured_count' => 6]),
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'Featured Cars',
                        'subtitle' => 'Best Selections',
                        'description' => 'View a collection of the best and most popular cars available in the market.',
                        'button_text' => 'View Cars',
                        'meta_data' => json_encode(['featured_count' => 6]),
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'سيارات مميزة',
                        'subtitle' => 'أفضل الاختيارات',
                        'description' => 'شاهد مجموعة من أفضل وأشهر السيارات المتوفرة في السوق.',
                        'button_text' => 'عرض السيارات',
                        'meta_data' => json_encode(['featured_count' => 6]),
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'type' => 'service',
                'image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&h=400&fit=crop',
                'button_url' => '/services',
                'icon' => 'fas fa-tools',
                'background_color' => '#DBEAFE',
                'sort_order' => 2,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'title' => 'خدمات حرفه‌ای',
                        'subtitle' => 'تعمیر و نگهداری',
                        'description' => 'تیم متخصص ما با استفاده از جدیدترین تجهیزات، خدمات تعمیر و نگهداری خودرو ارائه می‌دهد.',
                        'button_text' => 'مشاهده خدمات',
                        'meta_data' => json_encode(['service_count' => 8]),
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'Professional Services',
                        'subtitle' => 'Repair & Maintenance',
                        'description' => 'Our expert team provides car repair and maintenance services using the latest equipment.',
                        'button_text' => 'View Services',
                        'meta_data' => json_encode(['service_count' => 8]),
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'خدمات مهنية',
                        'subtitle' => 'إصلاح وصيانة',
                        'description' => 'فريقنا المتخصص يقدم خدمات إصلاح وصيانة السيارات باستخدام أحدث المعدات.',
                        'button_text' => 'عرض الخدمات',
                        'meta_data' => json_encode(['service_count' => 8]),
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'type' => 'testimonial',
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&h=400&fit=crop',
                'button_url' => '/testimonials',
                'icon' => 'fas fa-quote-left',
                'background_color' => '#F3E8FF',
                'sort_order' => 3,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'title' => 'نظرات مشتریان',
                        'subtitle' => 'تجربیات واقعی',
                        'description' => 'نظرات و تجربیات مشتریان راضی ما را بخوانید و از کیفیت خدمات ما مطمئن شوید.',
                        'button_text' => 'مشاهده نظرات',
                        'meta_data' => json_encode(['testimonial_count' => 12]),
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'Customer Reviews',
                        'subtitle' => 'Real Experiences',
                        'description' => 'Read reviews and experiences of our satisfied customers and be assured of our service quality.',
                        'button_text' => 'View Reviews',
                        'meta_data' => json_encode(['testimonial_count' => 12]),
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'آراء العملاء',
                        'subtitle' => 'تجارب حقيقية',
                        'description' => 'اقرأ آراء وتجارب عملائنا الراضين وتأكد من جودة خدماتنا.',
                        'button_text' => 'عرض الآراء',
                        'meta_data' => json_encode(['testimonial_count' => 12]),
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'type' => 'stats',
                'image' => 'https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=800&h=400&fit=crop',
                'button_url' => '/about',
                'icon' => 'fas fa-chart-bar',
                'background_color' => '#D1FAE5',
                'sort_order' => 4,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'title' => 'آمار و دستاوردها',
                        'subtitle' => 'موفقیت‌های ما',
                        'description' => 'در طول سال‌ها فعالیت، هزاران مشتری راضی و پروژه‌های موفق داشته‌ایم.',
                        'button_text' => 'درباره ما',
                        'meta_data' => json_encode(['customers' => 5000, 'projects' => 1200, 'years' => 15]),
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'Statistics & Achievements',
                        'subtitle' => 'Our Success',
                        'description' => 'Over years of activity, we have had thousands of satisfied customers and successful projects.',
                        'button_text' => 'About Us',
                        'meta_data' => json_encode(['customers' => 5000, 'projects' => 1200, 'years' => 15]),
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'الإحصائيات والإنجازات',
                        'subtitle' => 'نجاحنا',
                        'description' => 'على مر السنين من النشاط، لدينا آلاف العملاء الراضين والمشاريع الناجحة.',
                        'button_text' => 'من نحن',
                        'meta_data' => json_encode(['customers' => 5000, 'projects' => 1200, 'years' => 15]),
                        'is_active' => true,
                    ],
                ],
            ],
        ];

        foreach ($blocks as $blockData) {
            $translations = $blockData['translations'];
            unset($blockData['translations']);

            $block = HomepageBlock::create($blockData);

            foreach ($languages as $language) {
                if (isset($translations[$language->code])) {
                    $translationData = $translations[$language->code];
                    $translationData['language_id'] = $language->id;
                    $translationData['homepage_block_id'] = $block->id;

                    HomepageBlockTranslation::create($translationData);
                }
            }
        }

        $this->command->info('Homepage blocks seeded successfully!');
    }
}
