<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use App\Models\Language;
use App\Models\User;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = Language::all();
        $categories = Category::all();
        $user = User::first();

        $articles = [
            [
                'slug' => 'vehicle-price-trends-iran-market',
                'category_slug' => 'automotive-news',
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now()->subDays(2),
                'featured_image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                'type' => 'news',
                'translations' => [
                    'fa' => [
                        'title' => 'روند جدید قیمت خودرو در بازار ایران',
                        'content' => '<p>تحلیل جامع از تغییرات قیمت خودرو در ماه‌های اخیر و پیش‌بینی روند آینده بازار خودرو در ایران. در این مقاله به بررسی عوامل موثر بر قیمت خودرو، روندهای بازار و پیش‌بینی‌های کارشناسی می‌پردازیم.</p><p>بازار خودرو ایران در ماه‌های اخیر شاهد نوسانات قابل توجهی بوده است. عوامل مختلفی از جمله تغییرات نرخ ارز، سیاست‌های دولت، عرضه و تقاضا و شرایط اقتصادی بر این نوسانات تاثیرگذار بوده‌اند.</p><p>کارشناسان بازار پیش‌بینی می‌کنند که در ماه‌های آینده شاهد تثبیت نسبی قیمت‌ها خواهیم بود، اما همچنان نوسانات جزئی در برخی مدل‌ها ادامه خواهد داشت.</p>',
                        'excerpt' => 'تحلیل جامع از تغییرات قیمت خودرو در ماه‌های اخیر و پیش‌بینی روند آینده',
                        'meta_title' => 'روند جدید قیمت خودرو در بازار ایران - تحلیل جامع',
                        'meta_description' => 'تحلیل جامع از تغییرات قیمت خودرو در ماه‌های اخیر و پیش‌بینی روند آینده بازار خودرو در ایران',
                        'tags' => ['قیمت خودرو', 'بازار ایران', 'تحلیل اقتصادی', 'پیش‌بینی'],
                        'author_name' => 'تیم تحریریه',
                    ],
                    'en' => [
                        'title' => 'New Vehicle Price Trends in Iran Market',
                        'content' => '<p>Comprehensive analysis of vehicle price changes in recent months and future trend predictions for the Iranian automotive market. In this article, we examine the factors affecting vehicle prices, market trends and expert predictions.</p><p>The Iranian automotive market has experienced significant fluctuations in recent months. Various factors including exchange rate changes, government policies, supply and demand, and economic conditions have influenced these fluctuations.</p><p>Market experts predict that we will see relative price stabilization in the coming months, but minor fluctuations in some models will continue.</p>',
                        'excerpt' => 'Comprehensive analysis of vehicle price changes in recent months and future trend predictions',
                        'meta_title' => 'New Vehicle Price Trends in Iran Market - Comprehensive Analysis',
                        'meta_description' => 'Comprehensive analysis of vehicle price changes in recent months and future trend predictions for the Iranian automotive market',
                        'tags' => ['Vehicle Prices', 'Iran Market', 'Economic Analysis', 'Predictions'],
                        'author_name' => 'Editorial Team',
                    ],
                    'ar' => [
                        'title' => 'اتجاهات أسعار السيارات الجديدة في السوق الإيراني',
                        'content' => '<p>تحليل شامل لتغيرات أسعار السيارات في الأشهر الأخيرة وتوقعات الاتجاهات المستقبلية لسوق السيارات الإيراني. في هذه المقالة، ندرس العوامل المؤثرة على أسعار السيارات واتجاهات السوق وتوقعات الخبراء.</p><p>شهد السوق الإيراني للسيارات تقلبات كبيرة في الأشهر الأخيرة. أثرت عوامل مختلفة بما في ذلك تغيرات أسعار الصرف والسياسات الحكومية والعرض والطلب والظروف الاقتصادية على هذه التقلبات.</p><p>يتوقع خبراء السوق أن نشهد استقرارًا نسبيًا للأسعار في الأشهر القادمة، لكن ستستمر التقلبات البسيطة في بعض الموديلات.</p>',
                        'excerpt' => 'تحليل شامل لتغيرات أسعار السيارات في الأشهر الأخيرة وتوقعات الاتجاهات المستقبلية',
                        'meta_title' => 'اتجاهات أسعار السيارات الجديدة في السوق الإيراني - تحليل شامل',
                        'meta_description' => 'تحليل شامل لتغيرات أسعار السيارات في الأشهر الأخيرة وتوقعات الاتجاهات المستقبلية لسوق السيارات الإيراني',
                        'tags' => ['أسعار السيارات', 'السوق الإيراني', 'تحليل اقتصادي', 'توقعات'],
                        'author_name' => 'فريق التحرير',
                    ],
                ],
            ],
            [
                'slug' => 'complete-guide-vehicle-import-uae',
                'category_slug' => 'import-export',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subDays(5),
                'featured_image' => 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                'type' => 'article',
                'translations' => [
                    'fa' => [
                        'title' => 'راهنمای کامل واردات خودرو از امارات',
                        'content' => '<p>مراحل قانونی و نکات مهم برای واردات خودرو از امارات به ایران. در این راهنمای جامع، تمام مراحل قانونی، مدارک مورد نیاز، هزینه‌ها و نکات مهم واردات خودرو از امارات را بررسی می‌کنیم.</p><p>واردات خودرو از امارات یکی از مهم‌ترین مسیرهای واردات خودرو به ایران است. این کشور با داشتن بنادر مجهز و قوانین تجاری مناسب، گزینه‌ای ایده‌آل برای واردات خودرو محسوب می‌شود.</p><p>در این مقاله، مراحل گمرکی، مدارک مورد نیاز، هزینه‌های حمل و نقل و بیمه، و نکات مهم برای جلوگیری از مشکلات احتمالی را به تفصیل بررسی می‌کنیم.</p>',
                        'excerpt' => 'مراحل قانونی و نکات مهم برای واردات خودرو از امارات به ایران',
                        'meta_title' => 'راهنمای کامل واردات خودرو از امارات - مراحل قانونی',
                        'meta_description' => 'راهنمای جامع واردات خودرو از امارات شامل مراحل قانونی، مدارک مورد نیاز و نکات مهم',
                        'tags' => ['واردات', 'امارات', 'خودرو', 'گمرک'],
                        'author_name' => 'کارشناس واردات',
                    ],
                    'en' => [
                        'title' => 'Complete Guide to Vehicle Import from UAE',
                        'content' => '<p>Legal procedures and important points for importing vehicles from UAE to Iran. In this comprehensive guide, we examine all legal procedures, required documents, costs and important points for importing vehicles from UAE.</p><p>Importing vehicles from UAE is one of the most important routes for importing vehicles to Iran. This country, with its equipped ports and suitable commercial laws, is considered an ideal option for vehicle import.</p><p>In this article, we examine customs procedures, required documents, transportation and insurance costs, and important points to prevent potential problems in detail.</p>',
                        'excerpt' => 'Legal procedures and important points for importing vehicles from UAE to Iran',
                        'meta_title' => 'Complete Guide to Vehicle Import from UAE - Legal Procedures',
                        'meta_description' => 'Comprehensive guide to importing vehicles from UAE including legal procedures, required documents and important points',
                        'tags' => ['Import', 'UAE', 'Vehicle', 'Customs'],
                        'author_name' => 'Import Expert',
                    ],
                    'ar' => [
                        'title' => 'دليل شامل لاستيراد السيارات من الإمارات',
                        'content' => '<p>الإجراءات القانونية والنقاط المهمة لاستيراد السيارات من الإمارات إلى إيران. في هذا الدليل الشامل، ندرس جميع الإجراءات القانونية والمستندات المطلوبة والتكاليف والنقاط المهمة لاستيراد السيارات من الإمارات.</p><p>استيراد السيارات من الإمارات هو أحد أهم طرق استيراد السيارات إلى إيران. تعتبر هذه الدولة، مع موانئها المجهزة وقوانينها التجارية المناسبة، خيارًا مثاليًا لاستيراد السيارات.</p><p>في هذه المقالة، ندرس إجراءات الجمارك والمستندات المطلوبة وتكاليف النقل والتأمين والنقاط المهمة لمنع المشاكل المحتملة بالتفصيل.</p>',
                        'excerpt' => 'الإجراءات القانونية والنقاط المهمة لاستيراد السيارات من الإمارات إلى إيران',
                        'meta_title' => 'دليل شامل لاستيراد السيارات من الإمارات - الإجراءات القانونية',
                        'meta_description' => 'دليل شامل لاستيراد السيارات من الإمارات بما في ذلك الإجراءات القانونية والمستندات المطلوبة والنقاط المهمة',
                        'tags' => ['استيراد', 'الإمارات', 'سيارة', 'جمارك'],
                        'author_name' => 'خبير الاستيراد',
                    ],
                ],
            ],
            [
                'slug' => 'important-points-used-vehicle-inspection',
                'category_slug' => 'car-reviews',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subDays(8),
                'featured_image' => 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                'type' => 'news',
                'translations' => [
                    'fa' => [
                        'title' => 'نکات مهم در بازرسی خودروهای دست‌دوم',
                        'content' => '<p>چک‌لیست کامل برای بازرسی خودروهای دست‌دوم قبل از خرید. در این راهنمای جامع، تمام نکات مهم و مراحل بازرسی خودروهای دست‌دوم را بررسی می‌کنیم تا از خرید خودروی مناسب اطمینان حاصل کنیم.</p><p>خرید خودروی دست‌دوم نیاز به دقت و بررسی دقیق دارد. بازرسی کامل خودرو قبل از خرید می‌تواند از مشکلات آینده جلوگیری کند و به شما کمک کند تا تصمیم درستی بگیرید.</p><p>در این مقاله، مراحل بازرسی موتور، بدنه، سیستم تعلیق، ترمزها، سیستم الکتریکی و سایر بخش‌های مهم خودرو را به تفصیل بررسی می‌کنیم.</p>',
                        'excerpt' => 'چک‌لیست کامل برای بازرسی خودروهای دست‌دوم قبل از خرید',
                        'meta_title' => 'نکات مهم در بازرسی خودروهای دست‌دوم - راهنمای کامل',
                        'meta_description' => 'راهنمای جامع بازرسی خودروهای دست‌دوم شامل چک‌لیست کامل و نکات مهم قبل از خرید',
                        'tags' => ['خودرو دست‌دوم', 'بازرسی', 'خرید', 'چک‌لیست'],
                        'author_name' => 'کارشناس فنی',
                    ],
                    'en' => [
                        'title' => 'Important Points in Used Vehicle Inspection',
                        'content' => '<p>Complete checklist for inspecting used vehicles before purchase. In this comprehensive guide, we examine all important points and steps for inspecting used vehicles to ensure we purchase the right vehicle.</p><p>Buying a used vehicle requires care and thorough inspection. Complete vehicle inspection before purchase can prevent future problems and help you make the right decision.</p><p>In this article, we examine the steps for inspecting the engine, body, suspension system, brakes, electrical system and other important parts of the vehicle in detail.</p>',
                        'excerpt' => 'Complete checklist for inspecting used vehicles before purchase',
                        'meta_title' => 'Important Points in Used Vehicle Inspection - Complete Guide',
                        'meta_description' => 'Comprehensive guide to inspecting used vehicles including complete checklist and important points before purchase',
                        'tags' => ['Used Vehicle', 'Inspection', 'Purchase', 'Checklist'],
                        'author_name' => 'Technical Expert',
                    ],
                    'ar' => [
                        'title' => 'نقاط مهمة في فحص السيارات المستعملة',
                        'content' => '<p>قائمة فحص شاملة لفحص السيارات المستعملة قبل الشراء. في هذا الدليل الشامل، ندرس جميع النقاط المهمة وخطوات فحص السيارات المستعملة لضمان شراء السيارة المناسبة.</p><p>شراء سيارة مستعملة يتطلب العناية والفحص الشامل. الفحص الكامل للسيارة قبل الشراء يمكن أن يمنع المشاكل المستقبلية ويساعدك على اتخاذ القرار الصحيح.</p><p>في هذه المقالة، ندرس خطوات فحص المحرك والهيكل ونظام التعليق والفرامل والنظام الكهربائي وأجزاء السيارة المهمة الأخرى بالتفصيل.</p>',
                        'excerpt' => 'قائمة فحص شاملة لفحص السيارات المستعملة قبل الشراء',
                        'meta_title' => 'نقاط مهمة في فحص السيارات المستعملة - دليل شامل',
                        'meta_description' => 'دليل شامل لفحص السيارات المستعملة بما في ذلك قائمة فحص شاملة ونقاط مهمة قبل الشراء',
                        'tags' => ['سيارة مستعملة', 'فحص', 'شراء', 'قائمة فحص'],
                        'author_name' => 'خبير تقني',
                    ],
                ],
            ],
            [
                'slug' => 'new-changes-vehicle-clearance-laws',
                'category_slug' => 'automotive-news',
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now()->subDays(10),
                'featured_image' => 'https://images.unsplash.com/photo-1580273916550-e323be2ae537?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                'type' => 'article',
                'translations' => [
                    'fa' => [
                        'title' => 'تغییرات جدید قوانین ترخیص خودرو',
                        'content' => '<p>آخرین تغییرات در قوانین و مقررات ترخیص خودرو از گمرک. در این مقاله، تغییرات جدید قوانین ترخیص خودرو و تاثیرات آن بر واردات و صادرات خودرو را بررسی می‌کنیم.</p><p>قوانین ترخیص خودرو از گمرک به طور مداوم در حال تغییر و به‌روزرسانی است. این تغییرات می‌تواند تاثیرات قابل توجهی بر هزینه‌ها، زمان ترخیص و فرآیند واردات داشته باشد.</p><p>در این مقاله، تغییرات جدید در تعرفه‌ها، مدارک مورد نیاز، مراحل گمرکی و نکات مهم برای ترخیص خودرو را به تفصیل بررسی می‌کنیم.</p>',
                        'excerpt' => 'آخرین تغییرات در قوانین و مقررات ترخیص خودرو از گمرک',
                        'meta_title' => 'تغییرات جدید قوانین ترخیص خودرو - آخرین اخبار',
                        'meta_description' => 'آخرین تغییرات در قوانین و مقررات ترخیص خودرو از گمرک و تاثیرات آن بر واردات',
                        'tags' => ['ترخیص', 'گمرک', 'قوانین', 'واردات'],
                        'author_name' => 'کارشناس گمرکی',
                    ],
                    'en' => [
                        'title' => 'New Changes in Vehicle Clearance Laws',
                        'content' => '<p>Latest changes in vehicle clearance laws and regulations from customs. In this article, we examine the new changes in vehicle clearance laws and their effects on vehicle import and export.</p><p>Vehicle clearance laws from customs are constantly changing and updating. These changes can have significant effects on costs, clearance time and import process.</p><p>In this article, we examine new changes in tariffs, required documents, customs procedures and important points for vehicle clearance in detail.</p>',
                        'excerpt' => 'Latest changes in vehicle clearance laws and regulations from customs',
                        'meta_title' => 'New Changes in Vehicle Clearance Laws - Latest News',
                        'meta_description' => 'Latest changes in vehicle clearance laws and regulations from customs and their effects on import',
                        'tags' => ['Clearance', 'Customs', 'Laws', 'Import'],
                        'author_name' => 'Customs Expert',
                    ],
                    'ar' => [
                        'title' => 'تغييرات جديدة في قوانين ترخیص السيارات',
                        'content' => '<p>أحدث التغييرات في قوانين ولوائح ترخیص السيارات من الجمارك. في هذه المقالة، ندرس التغييرات الجديدة في قوانين ترخیص السيارات وتأثيراتها على استيراد وتصدير السيارات.</p><p>قوانين ترخیص السيارات من الجمارك تتغير وتتحدث باستمرار. هذه التغييرات يمكن أن يكون لها تأثيرات كبيرة على التكاليف ووقت الترخیص وعملية الاستيراد.</p><p>في هذه المقالة، ندرس التغييرات الجديدة في التعريفات الجمركية والمستندات المطلوبة والإجراءات الجمركية والنقاط المهمة لترخیص السيارات بالتفصيل.</p>',
                        'excerpt' => 'أحدث التغييرات في قوانين ولوائح ترخیص السيارات من الجمارک',
                        'meta_title' => 'تغييرات جديدة في قوانين ترخیص السيارات - أحدث الأخبار',
                        'meta_description' => 'أحدث التغييرات في قوانين ولوائح ترخیص السيارات من الجمارك وتأثيراتها على الاستيراد',
                        'tags' => ['ترخیص', 'جمارك', 'قوانين', 'استيراد'],
                        'author_name' => 'خبير جمركي',
                    ],
                ],
            ],
        ];

        foreach ($articles as $articleData) {
            $category = $categories->where('slug', $articleData['category_slug'])->first();

            $article = Article::create([
                'slug' => $articleData['slug'],
                'category_id' => $category ? $category->id : null,
                'user_id' => $user ? $user->id : null,
                'status' => $articleData['status'],
                'is_featured' => $articleData['is_featured'],
                'allow_comments' => true,
                'featured_image' => $articleData['featured_image'],
                'published_at' => $articleData['published_at'],
                'type' => $articleData['type'],
            ]);

            foreach ($articleData['translations'] as $langCode => $translation) {
                $language = $languages->where('code', $langCode)->first();
                if ($language) {
                    $article->translations()->create([
                        'language_id' => $language->id,
                        'title' => $translation['title'],
                        'content' => $translation['content'],
                        'excerpt' => $translation['excerpt'],
                        'meta_title' => $translation['meta_title'],
                        'meta_description' => $translation['meta_description'],
                        'tags' => $translation['tags'],
                        'author_name' => $translation['author_name'],
                    ]);
                }
            }
        }
    }
}
