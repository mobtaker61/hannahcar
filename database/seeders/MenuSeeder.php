<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\MenuTranslation;
use App\Models\Language;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = Language::all();

        // Sample menu data
        $menus = [
            [
                'position' => 'header',
                'sort_order' => 1,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'name' => 'منوی اصلی',
                        'description' => 'منوی اصلی سایت در هدر',
                        'is_active' => true,
                    ],
                    'en' => [
                        'name' => 'Main Menu',
                        'description' => 'Main site menu in header',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'name' => 'القائمة الرئيسية',
                        'description' => 'القائمة الرئيسية للموقع في الترويسة',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'position' => 'footer',
                'sort_order' => 2,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'name' => 'منوی فوتر',
                        'description' => 'منوی فوتر سایت',
                        'is_active' => true,
                    ],
                    'en' => [
                        'name' => 'Footer Menu',
                        'description' => 'Site footer menu',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'name' => 'قائمة التذييل',
                        'description' => 'قائمة تذييل الموقع',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'position' => 'mobile',
                'sort_order' => 3,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'name' => 'منوی موبایل',
                        'description' => 'منوی مخصوص موبایل',
                        'is_active' => true,
                    ],
                    'en' => [
                        'name' => 'Mobile Menu',
                        'description' => 'Mobile-specific menu',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'name' => 'قائمة الجوال',
                        'description' => 'قائمة مخصصة للجوال',
                        'is_active' => true,
                    ],
                ],
            ],
        ];

        foreach ($menus as $menuData) {
            $translations = $menuData['translations'];
            unset($menuData['translations']);

            $menu = Menu::create($menuData);

            foreach ($languages as $language) {
                if (isset($translations[$language->code])) {
                    $translationData = $translations[$language->code];
                    $translationData['language_id'] = $language->id;
                    $translationData['menu_id'] = $menu->id;

                    MenuTranslation::create($translationData);
                }
            }
        }

        $this->command->info('Menus seeded successfully!');
    }
}
