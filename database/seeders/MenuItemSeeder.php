<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\MenuItemTranslation;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = Language::all();
        $menus = Menu::all();

        // Sample menu items data
        $menuItems = [
            // Header Menu Items
            [
                'menu_id' => $menus->where('position', 'header')->first()->id,
                'url' => '/vehicles',
                'target' => '_self',
                'parent_id' => null,
                'sort_order' => 1,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'title' => 'گاراژ',
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'Garage',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'الغاراژ',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'menu_id' => $menus->where('position', 'header')->first()->id,
                'url' => '/about',
                'target' => '_self',
                'parent_id' => null,
                'sort_order' => 8,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'title' => 'درباره ما',
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'About Us',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'من نحن',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'menu_id' => $menus->where('position', 'header')->first()->id,
                'url' => '/services',
                'target' => '_self',
                'parent_id' => null,
                'sort_order' => 3,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'title' => 'خدمات',
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'Services',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'الخدمات',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'menu_id' => $menus->where('position', 'header')->first()->id,
                'url' => '/inquiry-forms',
                'target' => '_self',
                'parent_id' => null,
                'sort_order' => 4,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'title' => 'استعلامات',
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'Inquiries',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'الاستعلامات',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'menu_id' => $menus->where('position', 'header')->first()->id,
                'url' => '/news',
                'target' => '_self',
                'parent_id' => null,
                'sort_order' => 7,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'title' => 'اخبار',
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'News',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'الأخبار',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'menu_id' => $menus->where('position', 'header')->first()->id,
                'url' => '/contact',
                'target' => '_self',
                'parent_id' => null,
                'sort_order' => 9,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'title' => 'تماس با ما',
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'Contact Us',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'اتصل بنا',
                        'is_active' => true,
                    ],
                ],
            ],

            // Footer Menu Items
            [
                'menu_id' => $menus->where('position', 'footer')->first()->id,
                'url' => '/privacy',
                'target' => '_self',
                'parent_id' => null,
                'sort_order' => 1,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'title' => 'حریم خصوصی',
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'Privacy Policy',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'سياسة الخصوصية',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'menu_id' => $menus->where('position', 'footer')->first()->id,
                'url' => '/terms',
                'target' => '_self',
                'parent_id' => null,
                'sort_order' => 2,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'title' => 'قوانین و مقررات',
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'Terms & Conditions',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'الشروط والأحكام',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'menu_id' => $menus->where('position', 'footer')->first()->id,
                'url' => '/faq',
                'target' => '_self',
                'parent_id' => null,
                'sort_order' => 3,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'title' => 'سوالات متداول',
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'FAQ',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'الأسئلة الشائعة',
                        'is_active' => true,
                    ],
                ],
            ],

            // Mobile Menu Items
            [
                'menu_id' => $menus->where('position', 'mobile')->first()->id,
                'url' => '/',
                'target' => '_self',
                'parent_id' => null,
                'sort_order' => 1,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'title' => 'خانه',
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'Home',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'الرئيسية',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'menu_id' => $menus->where('position', 'mobile')->first()->id,
                'url' => '/services',
                'target' => '_self',
                'parent_id' => null,
                'sort_order' => 2,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'title' => 'خدمات',
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'Services',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'الخدمات',
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'menu_id' => $menus->where('position', 'mobile')->first()->id,
                'url' => '/contact',
                'target' => '_self',
                'parent_id' => null,
                'sort_order' => 3,
                'is_active' => true,
                'translations' => [
                    'fa' => [
                        'title' => 'تماس',
                        'is_active' => true,
                    ],
                    'en' => [
                        'title' => 'Contact',
                        'is_active' => true,
                    ],
                    'ar' => [
                        'title' => 'اتصل',
                        'is_active' => true,
                    ],
                ],
            ],
        ];

        foreach ($menuItems as $menuItemData) {
            $translations = $menuItemData['translations'];
            unset($menuItemData['translations']);

            $menuItem = MenuItem::create($menuItemData);

            foreach ($languages as $language) {
                if (isset($translations[$language->code])) {
                    $translationData = $translations[$language->code];
                    $translationData['language_id'] = $language->id;
                    $translationData['menu_item_id'] = $menuItem->id;

                    MenuItemTranslation::create($translationData);
                }
            }
        }

        $this->command->info('Menu items seeded successfully!');
    }
}
