<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\SettingTranslation;
use App\Models\Language;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = Language::all();

        // Sample settings data
        $settings = [
            [
                'key' => 'site_name',
                'group' => 'general',
                'type' => 'text',
                'default_value' => 'هانا کار',
                'sort_order' => 1,
                'is_active' => true,
                'is_public' => true,
                'translations' => [
                    'fa' => [
                        'label' => 'نام سایت',
                        'value' => 'هانا کار',
                        'description' => 'نام اصلی سایت که در هدر و عنوان صفحات نمایش داده می‌شود',
                        'help_text' => 'نام سایت را وارد کنید',
                        'is_active' => true,
                    ],
                    'en' => [
                        'label' => 'Site Name',
                        'value' => 'Hannah Car',
                        'description' => 'Main site name displayed in header and page titles',
                        'help_text' => 'Enter the site name',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'label' => 'اسم الموقع',
                        'value' => 'هانا كار',
                        'description' => 'اسم الموقع الرئيسي المعروض في الترويسة وعناوين الصفحات',
                        'help_text' => 'أدخل اسم الموقع',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'key' => 'site_tagline',
                'group' => 'general',
                'type' => 'text',
                'default_value' => 'بهترین خدمات خودرو',
                'sort_order' => 2,
                'is_active' => true,
                'is_public' => true,
                'translations' => [
                    'fa' => [
                        'label' => 'شعار سایت',
                        'value' => 'بهترین خدمات خودرو',
                        'description' => 'شعار یا توضیح کوتاه سایت',
                        'help_text' => 'شعار سایت را وارد کنید',
                        'is_active' => true,
                    ],
                    'en' => [
                        'label' => 'Site Tagline',
                        'value' => 'Best Car Services',
                        'description' => 'Site slogan or short description',
                        'help_text' => 'Enter the site tagline',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'label' => 'شعار الموقع',
                        'value' => 'أفضل خدمات السيارات',
                        'description' => 'شعار الموقع أو الوصف المختصر',
                        'help_text' => 'أدخل شعار الموقع',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'key' => 'site_description',
                'group' => 'seo',
                'type' => 'textarea',
                'default_value' => 'هانا کار ارائه دهنده بهترین خدمات خودرو در ایران',
                'sort_order' => 3,
                'is_active' => true,
                'is_public' => true,
                'translations' => [
                    'fa' => [
                        'label' => 'توضیحات سایت',
                        'value' => 'هانا کار ارائه دهنده بهترین خدمات خودرو در ایران',
                        'description' => 'توضیحات کامل سایت برای SEO',
                        'help_text' => 'توضیحات کامل سایت را وارد کنید',
                        'is_active' => true,
                    ],
                    'en' => [
                        'label' => 'Site Description',
                        'value' => 'Hannah Car provides the best car services in Iran',
                        'description' => 'Complete site description for SEO',
                        'help_text' => 'Enter the complete site description',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'label' => 'وصف الموقع',
                        'value' => 'هانا كار تقدم أفضل خدمات السيارات في إيران',
                        'description' => 'وصف كامل للموقع لتحسين محركات البحث',
                        'help_text' => 'أدخل الوصف الكامل للموقع',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'key' => 'site_keywords',
                'group' => 'seo',
                'type' => 'text',
                'default_value' => 'خودرو, خدمات خودرو, تعمیر خودرو, هانا کار',
                'sort_order' => 4,
                'is_active' => true,
                'is_public' => true,
                'translations' => [
                    'fa' => [
                        'label' => 'کلمات کلیدی',
                        'value' => 'خودرو, خدمات خودرو, تعمیر خودرو, هانا کار',
                        'description' => 'کلمات کلیدی سایت برای SEO',
                        'help_text' => 'کلمات کلیدی را با کاما جدا کنید',
                        'is_active' => true,
                    ],
                    'en' => [
                        'label' => 'Site Keywords',
                        'value' => 'car, car services, car repair, hannah car',
                        'description' => 'Site keywords for SEO',
                        'help_text' => 'Separate keywords with commas',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'label' => 'كلمات مفتاحية',
                        'value' => 'سيارة, خدمات السيارات, إصلاح السيارات, هانا كار',
                        'description' => 'الكلمات المفتاحية للموقع لتحسين محركات البحث',
                        'help_text' => 'افصل الكلمات المفتاحية بفواصل',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'key' => 'primary_color',
                'group' => 'general',
                'type' => 'color',
                'default_value' => '#3B82F6',
                'sort_order' => 5,
                'is_active' => true,
                'is_public' => true,
                'translations' => [
                    'fa' => [
                        'label' => 'رنگ اصلی',
                        'value' => '#3B82F6',
                        'description' => 'رنگ اصلی سایت',
                        'help_text' => 'رنگ اصلی سایت را انتخاب کنید',
                        'is_active' => true,
                    ],
                    'en' => [
                        'label' => 'Primary Color',
                        'value' => '#3B82F6',
                        'description' => 'Main site color',
                        'help_text' => 'Select the main site color',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'label' => 'اللون الأساسي',
                        'value' => '#3B82F6',
                        'description' => 'اللون الأساسي للموقع',
                        'help_text' => 'اختر اللون الأساسي للموقع',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'key' => 'default_language',
                'group' => 'system',
                'type' => 'select',
                'default_value' => 'fa',
                'options' => "fa=فارسی\nen=English\nar=العربية",
                'sort_order' => 6,
                'is_active' => true,
                'is_public' => true,
                'translations' => [
                    'fa' => [
                        'label' => 'زبان پیش‌فرض',
                        'value' => 'fa',
                        'description' => 'زبان پیش‌فرض سایت',
                        'help_text' => 'زبان پیش‌فرض سایت را انتخاب کنید',
                        'is_active' => true,
                    ],
                    'en' => [
                        'label' => 'Default Language',
                        'value' => 'fa',
                        'description' => 'Default site language',
                        'help_text' => 'Select the default site language',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'label' => 'اللغة الافتراضية',
                        'value' => 'fa',
                        'description' => 'اللغة الافتراضية للموقع',
                        'help_text' => 'اختر اللغة الافتراضية للموقع',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'key' => 'maintenance_mode',
                'group' => 'system',
                'type' => 'boolean',
                'default_value' => '0',
                'sort_order' => 7,
                'is_active' => true,
                'is_public' => true,
                'translations' => [
                    'fa' => [
                        'label' => 'حالت نگهداری',
                        'value' => '0',
                        'description' => 'فعال یا غیرفعال کردن حالت نگهداری سایت',
                        'help_text' => 'برای فعال کردن حالت نگهداری تیک بزنید',
                        'is_active' => true,
                    ],
                    'en' => [
                        'label' => 'Maintenance Mode',
                        'value' => '0',
                        'description' => 'Enable or disable site maintenance mode',
                        'help_text' => 'Check to enable maintenance mode',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'label' => 'وضع الصيانة',
                        'value' => '0',
                        'description' => 'تفعيل أو إلغاء تفعيل وضع صيانة الموقع',
                        'help_text' => 'حدد لتفعيل وضع الصيانة',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'key' => 'contact_email',
                'group' => 'contact',
                'type' => 'email',
                'default_value' => 'info@hannahcar.com',
                'sort_order' => 8,
                'is_active' => true,
                'is_public' => true,
                'translations' => [
                    'fa' => [
                        'label' => 'ایمیل تماس',
                        'value' => 'info@hannahcar.com',
                        'description' => 'ایمیل اصلی برای تماس',
                        'help_text' => 'ایمیل تماس را وارد کنید',
                        'is_active' => true,
                    ],
                    'en' => [
                        'label' => 'Contact Email',
                        'value' => 'info@hannahcar.com',
                        'description' => 'Main contact email',
                        'help_text' => 'Enter the contact email',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'label' => 'البريد الإلكتروني للاتصال',
                        'value' => 'info@hannahcar.com',
                        'description' => 'البريد الإلكتروني الرئيسي للاتصال',
                        'help_text' => 'أدخل البريد الإلكتروني للاتصال',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'key' => 'contact_phone',
                'group' => 'contact',
                'type' => 'text',
                'default_value' => '+98 21 1234 5678',
                'sort_order' => 9,
                'is_active' => true,
                'is_public' => true,
                'translations' => [
                    'fa' => [
                        'label' => 'تلفن تماس',
                        'value' => '+98 21 1234 5678',
                        'description' => 'شماره تلفن اصلی',
                        'help_text' => 'شماره تلفن تماس را وارد کنید',
                        'is_active' => true,
                    ],
                    'en' => [
                        'label' => 'Contact Phone',
                        'value' => '+98 21 1234 5678',
                        'description' => 'Main phone number',
                        'help_text' => 'Enter the contact phone number',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'label' => 'هاتف الاتصال',
                        'value' => '+98 21 1234 5678',
                        'description' => 'رقم الهاتف الرئيسي',
                        'help_text' => 'أدخل رقم هاتف الاتصال',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'key' => 'contact_address',
                'group' => 'contact',
                'type' => 'textarea',
                'default_value' => 'تهران، خیابان ولیعصر، پلاک 123',
                'sort_order' => 10,
                'is_active' => true,
                'is_public' => true,
                'translations' => [
                    'fa' => [
                        'label' => 'آدرس',
                        'value' => 'تهران، خیابان ولیعصر، پلاک 123',
                        'description' => 'آدرس کامل شرکت',
                        'help_text' => 'آدرس کامل را وارد کنید',
                        'is_active' => true,
                    ],
                    'en' => [
                        'label' => 'Address',
                        'value' => 'Tehran, Valiasr Street, No. 123',
                        'description' => 'Complete company address',
                        'help_text' => 'Enter the complete address',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'label' => 'العنوان',
                        'value' => 'طهران، شارع ولي العصر، رقم 123',
                        'description' => 'عنوان الشركة الكامل',
                        'help_text' => 'أدخل العنوان الكامل',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'key' => 'site_author',
                'group' => 'general',
                'type' => 'text',
                'default_value' => 'هانا کار',
                'sort_order' => 11,
                'is_active' => true,
                'is_public' => true,
                'translations' => [
                    'fa' => [
                        'label' => 'نویسنده',
                        'value' => 'هانا کار',
                        'description' => 'نویسنده اصلی سایت',
                        'help_text' => 'نویسنده اصلی سایت را وارد کنید',
                        'is_active' => true,
                    ],
                    'en' => [
                        'label' => 'Author',
                        'value' => 'Hannah Car',
                        'description' => 'Main site author',
                        'help_text' => 'Enter the main site author',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'label' => 'المؤلف',
                        'value' => 'هانا كار',
                        'description' => 'المؤلف الرئيسي للموقع',
                        'help_text' => 'أدخل المؤلف الرئيسي للموقع',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'key' => 'site_logo',
                'group' => 'general',
                'type' => 'image',
                'default_value' => 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                'sort_order' => 12,
                'is_active' => true,
                'is_public' => true,
                'translations' => [
                    'fa' => [
                        'label' => 'لوگو سایت',
                        'value' => 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                        'description' => 'لوگو سایت',
                        'help_text' => 'لوگو سایت را انتخاب کنید',
                        'is_active' => true,
                    ],
                    'en' => [
                        'label' => 'Site Logo',
                        'value' => 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                        'description' => 'Main site logo',
                        'help_text' => 'Select the main site logo',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'label' => 'شعار الموقع',
                        'value' => 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                        'description' => 'شعار الموقع',
                        'help_text' => 'اختر شعار الموقع',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'key' => 'admin_phone_1',
                'group' => 'notifications',
                'type' => 'text',
                'default_value' => '+989123456789',
                'sort_order' => 13,
                'is_active' => true,
                'is_public' => false,
                'translations' => [
                    'fa' => [
                        'label' => 'شماره تلفن ادمین 1',
                        'value' => '+989123456789',
                        'description' => 'شماره تلفن اول برای ارسال اعلان‌های واتساپ',
                        'help_text' => 'شماره تلفن ادمین اول را وارد کنید',
                        'is_active' => true,
                    ],
                    'en' => [
                        'label' => 'Admin Phone 1',
                        'value' => '+989123456789',
                        'description' => 'First phone number for WhatsApp notifications',
                        'help_text' => 'Enter the first admin phone number',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'label' => 'هاتف المدير 1',
                        'value' => '+989123456789',
                        'description' => 'رقم الهاتف الأول لإشعارات واتساب',
                        'help_text' => 'أدخل رقم هاتف المدير الأول',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'key' => 'admin_phone_2',
                'group' => 'notifications',
                'type' => 'text',
                'default_value' => '+989876543210',
                'sort_order' => 14,
                'is_active' => true,
                'is_public' => false,
                'translations' => [
                    'fa' => [
                        'label' => 'شماره تلفن ادمین 2',
                        'value' => '+989876543210',
                        'description' => 'شماره تلفن دوم برای ارسال اعلان‌های واتساپ',
                        'help_text' => 'شماره تلفن ادمین دوم را وارد کنید',
                        'is_active' => true,
                    ],
                    'en' => [
                        'label' => 'Admin Phone 2',
                        'value' => '+989876543210',
                        'description' => 'Second phone number for WhatsApp notifications',
                        'help_text' => 'Enter the second admin phone number',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'label' => 'هاتف المدير 2',
                        'value' => '+989876543210',
                        'description' => 'رقم الهاتف الثاني لإشعارات واتساب',
                        'help_text' => 'أدخل رقم هاتف المدير الثاني',
                        'is_active' => true,
                    ],
                ],
            ],
        ];

        foreach ($settings as $settingData) {
            $translations = $settingData['translations'];
            unset($settingData['translations']);

            // Check if setting already exists
            $setting = Setting::where('key', $settingData['key'])->first();

            if (!$setting) {
                $setting = Setting::create($settingData);

                foreach ($languages as $language) {
                    if (isset($translations[$language->code])) {
                        $translationData = $translations[$language->code];
                        $translationData['language_id'] = $language->id;
                        $translationData['setting_id'] = $setting->id;

                        SettingTranslation::create($translationData);
                    }
                }
            }
        }

        $this->command->info('Settings seeded successfully!');
    }
}
