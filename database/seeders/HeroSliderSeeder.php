<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HeroSlider;
use App\Models\HeroSliderTranslation;
use App\Models\Language;

class HeroSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = Language::all();

        // Sample slider data from HeroSlider.php
        $sliders = [
            [
                'image' => 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                'button_url' => '#quote',
                'badge_color' => '#EF4444',
                'sort_order' => 1,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'title' => 'تامین خودرو تکی و عمده',
                        'subtitle' => 'بهترین قیمت و کیفیت از سراسر جهان',
                        'description' => 'تامین خودروهای صفر و دست‌دوم با بهترین قیمت و کیفیت از سراسر جهان',
                        'button_text' => 'درخواست قیمت',
                        'badge_text' => 'تامین',
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'Single and Bulk Car Supply',
                        'subtitle' => 'Best Price and Quality from Around the World',
                        'description' => 'Supply of new and used cars with the best price and quality from around the world',
                        'button_text' => 'Request Quote',
                        'badge_text' => 'Supply',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'توريد السيارات الفردية والجملة',
                        'subtitle' => 'أفضل سعر وجودة من جميع أنحاء العالم',
                        'description' => 'توريد السيارات الجديدة والمستعملة بأفضل سعر وجودة من جميع أنحاء العالم',
                        'button_text' => 'طلب عرض سعر',
                        'badge_text' => 'توريد',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                'button_url' => '#import',
                'badge_color' => '#3B82F6',
                'sort_order' => 2,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'title' => 'واردات خودرو به امارات',
                        'subtitle' => 'خدمات کامل واردات با مجوزهای قانونی',
                        'description' => 'واردات خودرو به امارات با تمامی مجوزهای قانونی و پشتیبانی کامل',
                        'button_text' => 'مشاوره واردات',
                        'badge_text' => 'واردات',
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'Car Import to UAE',
                        'subtitle' => 'Complete Import Services with Legal Permits',
                        'description' => 'Car import to UAE with all legal permits and complete support',
                        'button_text' => 'Import Consultation',
                        'badge_text' => 'Import',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'استيراد السيارات إلى الإمارات',
                        'subtitle' => 'خدمات الاستيراد الكاملة مع التصاريح القانونية',
                        'description' => 'استيراد السيارات إلى الإمارات مع جميع التصاريح القانونية والدعم الكامل',
                        'button_text' => 'استشارة الاستيراد',
                        'badge_text' => 'استيراد',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1580273916550-e323be2ae537?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                'button_url' => '#clearance',
                'badge_color' => '#10B981',
                'sort_order' => 3,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'title' => 'ترخیص خودرو در ایران',
                        'subtitle' => 'سریع‌ترین زمان و کمترین هزینه',
                        'description' => 'ترخیص خودرو از گمرک با سریع‌ترین زمان و کمترین هزینه ممکن',
                        'button_text' => 'استعلام هزینه',
                        'badge_text' => 'ترخیص',
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'Car Clearance in Iran',
                        'subtitle' => 'Fastest Time and Lowest Cost',
                        'description' => 'Car clearance from customs with the fastest time and lowest possible cost',
                        'button_text' => 'Cost Inquiry',
                        'badge_text' => 'Clearance',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'تخليص السيارات في إيران',
                        'subtitle' => 'أسرع وقت وأقل تكلفة',
                        'description' => 'تخليص السيارات من الجمارك بأسرع وقت وأقل تكلفة ممكنة',
                        'button_text' => 'استعلام التكلفة',
                        'badge_text' => 'تخليص',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                'button_url' => '#parts',
                'badge_color' => '#F59E0B',
                'sort_order' => 4,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'title' => 'قطعات یدکی اوریجینال',
                        'subtitle' => 'تامین قطعات برای تمامی برندها',
                        'description' => 'تامین قطعات یدکی اوریجینال و مشابه برای تمامی برندهای خودرو',
                        'button_text' => 'جستجوی قطعات',
                        'badge_text' => 'قطعات',
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'Original Spare Parts',
                        'subtitle' => 'Supply Parts for All Brands',
                        'description' => 'Supply original and similar spare parts for all car brands',
                        'button_text' => 'Search Parts',
                        'badge_text' => 'Parts',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'قطع غيار أصلية',
                        'subtitle' => 'توريد قطع الغيار لجميع الماركات',
                        'description' => 'توريد قطع الغيار الأصلية والمشابهة لجميع ماركات السيارات',
                        'button_text' => 'البحث عن قطع الغيار',
                        'badge_text' => 'قطع غيار',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1563720223185-11003d516935?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                'button_url' => '#inspection',
                'badge_color' => '#8B5CF6',
                'sort_order' => 5,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'title' => 'بازرسی و کارشناسی خودرو',
                        'subtitle' => 'توسط متخصصان مجرب',
                        'description' => 'بازرسی و کارشناسی خودرو توسط متخصصان مجرب و با تجربه',
                        'button_text' => 'درخواست بازرسی',
                        'badge_text' => 'بازرسی',
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'Car Inspection and Appraisal',
                        'subtitle' => 'By Experienced Specialists',
                        'description' => 'Car inspection and appraisal by experienced and skilled specialists',
                        'button_text' => 'Request Inspection',
                        'badge_text' => 'Inspection',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'فحص وتقييم السيارات',
                        'subtitle' => 'من قبل متخصصين ذوي خبرة',
                        'description' => 'فحص وتقييم السيارات من قبل متخصصين ذوي خبرة ومهارة',
                        'button_text' => 'طلب الفحص',
                        'badge_text' => 'فحص',
                        'is_active' => true,
                    ],
                ],
            ],
        ];

        foreach ($sliders as $sliderData) {
            $translations = $sliderData['translations'];
            unset($sliderData['translations']);

            $slider = HeroSlider::create($sliderData);

            foreach ($languages as $language) {
                if (isset($translations[$language->code])) {
                    $translationData = $translations[$language->code];
                    $translationData['language_id'] = $language->id;
                    $translationData['hero_slider_id'] = $slider->id;

                    HeroSliderTranslation::create($translationData);
                }
            }
        }

        $this->command->info('Hero sliders seeded successfully!');
    }
}
