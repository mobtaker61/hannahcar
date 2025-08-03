<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Language;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = Language::all();

        $pages = [
            [
                'slug' => 'about-us',
                'template' => 'simple',
                'status' => 'published',
                'sort_order' => 1,
                'translations' => [
                    'fa' => [
                        'title' => 'درباره ما',
                        'content' => '<h2>درباره شرکت هانا کار</h2><p>شرکت هانا کار با بیش از ۱۰ سال تجربه در زمینه فروش و خدمات خودرو، یکی از معتبرترین شرکت‌های فعال در این حوزه است.</p>',
                        'meta_title' => 'درباره ما - هانا کار',
                        'meta_description' => 'درباره شرکت هانا کار و خدمات ما در زمینه فروش و خدمات خودرو',
                        'meta_keywords' => 'درباره ما, هانا کار, خدمات خودرو',
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'About Us',
                        'content' => '<h2>About Hannah Car Company</h2><p>Hannah Car Company with more than 10 years of experience in car sales and services, is one of the most reputable companies in this field.</p>',
                        'meta_title' => 'About Us - Hannah Car',
                        'meta_description' => 'About Hannah Car Company and our services in car sales and services',
                        'meta_keywords' => 'about us, hannah car, car services',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'من نحن',
                        'content' => '<h2>عن شركة هانا كار</h2><p>شركة هانا كار مع أكثر من 10 سنوات من الخبرة في بيع وخدمات السيارات، هي واحدة من أكثر الشركات سمعة في هذا المجال.</p>',
                        'meta_title' => 'من نحن - هانا كار',
                        'meta_description' => 'عن شركة هانا كار وخدماتنا في بيع وخدمات السيارات',
                        'meta_keywords' => 'من نحن, هانا كار, خدمات السيارات',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'slug' => 'contact',
                'template' => 'simple',
                'status' => 'published',
                'sort_order' => 2,
                'translations' => [
                    'fa' => [
                        'title' => 'تماس با ما',
                        'content' => '<h2>اطلاعات تماس</h2><p>آدرس: تهران، خیابان ولیعصر</p><p>تلفن: ۰۲۱-۱۲۳۴۵۶۷۸</p><p>ایمیل: info@hannahcar.com</p>',
                        'meta_title' => 'تماس با ما - هانا کار',
                        'meta_description' => 'اطلاعات تماس با شرکت هانا کار',
                        'meta_keywords' => 'تماس با ما, هانا کار, آدرس',
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'Contact Us',
                        'content' => '<h2>Contact Information</h2><p>Address: Tehran, Valiasr Street</p><p>Phone: +98-21-12345678</p><p>Email: info@hannahcar.com</p>',
                        'meta_title' => 'Contact Us - Hannah Car',
                        'meta_description' => 'Contact information for Hannah Car Company',
                        'meta_keywords' => 'contact us, hannah car, address',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'اتصل بنا',
                        'content' => '<h2>معلومات الاتصال</h2><p>العنوان: طهران، شارع ولي العصر</p><p>الهاتف: +98-21-12345678</p><p>البريد الإلكتروني: info@hannahcar.com</p>',
                        'meta_title' => 'اتصل بنا - هانا كار',
                        'meta_description' => 'معلومات الاتصال لشركة هانا كار',
                        'meta_keywords' => 'اتصل بنا, هانا كار, عنوان',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'slug' => 'terms',
                'template' => 'simple',
                'status' => 'published',
                'sort_order' => 3,
                'translations' => [
                    'fa' => [
                        'title' => 'قوانین و مقررات',
                        'content' => '<h2>قوانین و مقررات استفاده</h2><p>متن قوانین و مقررات استفاده از خدمات شرکت هانا کار...</p>',
                        'meta_title' => 'قوانین و مقررات - هانا کار',
                        'meta_description' => 'قوانین و مقررات استفاده از خدمات شرکت هانا کار',
                        'meta_keywords' => 'قوانین, مقررات, هانا کار',
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'Terms & Conditions',
                        'content' => '<h2>Terms and Conditions of Use</h2><p>Terms and conditions for using Hannah Car Company services...</p>',
                        'meta_title' => 'Terms & Conditions - Hannah Car',
                        'meta_description' => 'Terms and conditions for using Hannah Car Company services',
                        'meta_keywords' => 'terms, conditions, hannah car',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'الشروط والأحكام',
                        'content' => '<h2>الشروط والأحكام للاستخدام</h2><p>الشروط والأحكام لاستخدام خدمات شركة هانا كار...</p>',
                        'meta_title' => 'الشروط والأحكام - هانا كار',
                        'meta_description' => 'الشروط والأحكام لاستخدام خدمات شركة هانا كار',
                        'meta_keywords' => 'شروط, أحكام, هانا كار',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'slug' => 'privacy',
                'template' => 'simple',
                'status' => 'published',
                'sort_order' => 4,
                'translations' => [
                    'fa' => [
                        'title' => 'حریم خصوصی',
                        'content' => '<h2>سیاست حریم خصوصی</h2><p>متن سیاست حریم خصوصی شرکت هانا کار...</p>',
                        'meta_title' => 'حریم خصوصی - هانا کار',
                        'meta_description' => 'سیاست حریم خصوصی شرکت هانا کار',
                        'meta_keywords' => 'حریم خصوصی, هانا کار',
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'Privacy Policy',
                        'content' => '<h2>Privacy Policy</h2><p>Hannah Car Company privacy policy...</p>',
                        'meta_title' => 'Privacy Policy - Hannah Car',
                        'meta_description' => 'Hannah Car Company privacy policy',
                        'meta_keywords' => 'privacy policy, hannah car',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'سياسة الخصوصية',
                        'content' => '<h2>سياسة الخصوصية</h2><p>سياسة خصوصية شركة هانا كار...</p>',
                        'meta_title' => 'سياسة الخصوصية - هانا كار',
                        'meta_description' => 'سياسة خصوصية شركة هانا كار',
                        'meta_keywords' => 'سياسة الخصوصية, هانا كار',
                        'is_active' => true,
                    ],
                ],
            ],
        ];

        foreach ($pages as $pageData) {
            $page = Page::create([
                'slug' => $pageData['slug'],
                'template' => $pageData['template'],
                'status' => $pageData['status'],
                'sort_order' => $pageData['sort_order'],
            ]);

            foreach ($pageData['translations'] as $langCode => $translation) {
                $language = $languages->where('code', $langCode)->first();
                if ($language) {
                    $page->translations()->create([
                        'language_id' => $language->id,
                        'title' => $translation['title'],
                        'content' => $translation['content'],
                        'meta_title' => $translation['meta_title'],
                        'meta_description' => $translation['meta_description'],
                        'meta_keywords' => $translation['meta_keywords'],
                        'is_active' => $translation['is_active'],
                    ]);
                }
            }
        }
    }
}
