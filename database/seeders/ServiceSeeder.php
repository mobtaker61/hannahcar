<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use App\Models\Language;
use App\Models\User;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = Language::all();
        $servicesCategory = Category::where('slug', 'services')->first();
        $user = User::first();

        if (!$servicesCategory) {
            $this->command->error('Services category not found. Please run CategorySeeder first.');
            return;
        }

        $services = [
            [
                'slug' => 'vehicle-supply-service',
                'status' => 'published',
                'is_featured' => true,
                'icon' => 'fas fa-car',
                'published_at' => now()->subDays(1),
                'type' => 'service',
                'translations' => [
                    'fa' => [
                        'title' => 'تامین خودرو',
                        'content' => '<p>خدمات تخصصی تامین خودروهای صفر و دست‌دوم با بهترین قیمت و کیفیت از سراسر جهان. ما با شبکه گسترده‌ای از تامین‌کنندگان معتبر در کشورهای مختلف همکاری می‌کنیم تا بهترین خودروها را برای شما فراهم کنیم.</p><p>خدمات ما شامل:</p><ul><li>تامین خودروهای صفر از کارخانه‌های معتبر</li><li>تامین خودروهای دست‌دوم با کیفیت تضمین شده</li><li>بازرسی کامل خودرو قبل از خرید</li><li>گارانتی و پشتیبانی کامل</li><li>خدمات پس از فروش</li></ul><p>ما متعهد به ارائه بهترین کیفیت و قیمت به مشتریان خود هستیم.</p>',
                        'excerpt' => 'تامین خودروهای صفر و دست‌دوم با بهترین قیمت و کیفیت از سراسر جهان',
                        'meta_title' => 'تامین خودرو - خدمات تخصصی تامین خودرو',
                        'meta_description' => 'خدمات تخصصی تامین خودروهای صفر و دست‌دوم با بهترین قیمت و کیفیت از سراسر جهان',
                        'tags' => ['تامین خودرو', 'خودرو صفر', 'خودرو دست‌دوم', 'کیفیت'],
                        'author_name' => 'تیم تامین',
                        'featured_image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                    'en' => [
                        'title' => 'Vehicle Supply',
                        'content' => '<p>Specialized services for supplying new and used vehicles with the best price and quality from around the world. We collaborate with an extensive network of reliable suppliers in various countries to provide the best vehicles for you.</p><p>Our services include:</p><ul><li>Supply of new vehicles from reputable factories</li><li>Supply of used vehicles with guaranteed quality</li><li>Complete vehicle inspection before purchase</li><li>Warranty and complete support</li><li>After-sales services</li></ul><p>We are committed to providing the best quality and price to our customers.</p>',
                        'excerpt' => 'Supply of new and used vehicles with the best price and quality from around the world',
                        'meta_title' => 'Vehicle Supply - Specialized Vehicle Supply Services',
                        'meta_description' => 'Specialized services for supplying new and used vehicles with the best price and quality from around the world',
                        'tags' => ['Vehicle Supply', 'New Vehicle', 'Used Vehicle', 'Quality'],
                        'author_name' => 'Supply Team',
                        'featured_image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                    'ar' => [
                        'title' => 'توريد السيارات',
                        'content' => '<p>خدمات متخصصة لتوريد السيارات الجديدة والمستعملة بأفضل سعر وجودة من جميع أنحاء العالم. نتعاون مع شبكة واسعة من الموردين الموثوقين في مختلف البلدان لتوفير أفضل السيارات لك.</p><p>تشمل خدماتنا:</p><ul><li>توريد السيارات الجديدة من المصانع الموثوقة</li><li>توريد السيارات المستعملة بجودة مضمونة</li><li>فحص كامل للسيارة قبل الشراء</li><li>الضمان والدعم الكامل</li><li>خدمات ما بعد البيع</li></ul><p>نحن ملتزمون بتقديم أفضل جودة وسعر لعملائنا.</p>',
                        'excerpt' => 'توريد السيارات الجديدة والمستعملة بأفضل سعر وجودة من جميع أنحاء العالم',
                        'meta_title' => 'توريد السيارات - خدمات توريد السيارات المتخصصة',
                        'meta_description' => 'خدمات متخصصة لتوريد السيارات الجديدة والمستعملة بأفضل سعر وجودة من جميع أنحاء العالم',
                        'tags' => ['توريد السيارات', 'سيارة جديدة', 'سيارة مستعملة', 'جودة'],
                        'author_name' => 'فريق التوريد',
                        'featured_image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                ],
            ],
            [
                'slug' => 'import-services',
                'status' => 'published',
                'is_featured' => true,
                'icon' => 'fas fa-truck',
                'published_at' => now()->subDays(2),
                'type' => 'service',
                'translations' => [
                    'fa' => [
                        'title' => 'خدمات واردات',
                        'content' => '<p>واردات خودرو به امارات و ایران با تمامی مجوزهای قانونی. ما تمام مراحل واردات خودرو را از ابتدا تا انتها مدیریت می‌کنیم تا شما با خیال راحت خودرو مورد نظر خود را دریافت کنید.</p><p>خدمات واردات ما شامل:</p><ul><li>اخذ مجوزهای لازم از مراجع ذی‌صلاح</li><li>مذاکره با تامین‌کنندگان خارجی</li><li>مدیریت حمل و نقل بین‌المللی</li><li>ترخیص از گمرک</li><li>تحویل در محل مورد نظر</li></ul><p>تیم متخصص ما با سال‌ها تجربه در زمینه واردات خودرو، آماده ارائه خدمات به شماست.</p>',
                        'excerpt' => 'واردات خودرو به امارات و ایران با تمامی مجوزهای قانونی',
                        'meta_title' => 'خدمات واردات - واردات خودرو با مجوزهای قانونی',
                        'meta_description' => 'واردات خودرو به امارات و ایران با تمامی مجوزهای قانونی و مدیریت کامل مراحل واردات',
                        'tags' => ['واردات', 'امارات', 'ایران', 'مجوز قانونی'],
                        'author_name' => 'تیم واردات',
                        'featured_image' => 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                    'en' => [
                        'title' => 'Import Services',
                        'content' => '<p>Vehicle import to UAE and Iran with all legal permits. We manage all vehicle import procedures from start to finish so you can receive your desired vehicle with peace of mind.</p><p>Our import services include:</p><ul><li>Obtaining necessary permits from relevant authorities</li><li>Negotiation with foreign suppliers</li><li>International transportation management</li><li>Customs clearance</li><li>Delivery to desired location</li></ul><p>Our expert team with years of experience in vehicle import is ready to provide services to you.</p>',
                        'excerpt' => 'Vehicle import to UAE and Iran with all legal permits',
                        'meta_title' => 'Import Services - Vehicle Import with Legal Permits',
                        'meta_description' => 'Vehicle import to UAE and Iran with all legal permits and complete management of import procedures',
                        'tags' => ['Import', 'UAE', 'Iran', 'Legal Permits'],
                        'author_name' => 'Import Team',
                        'featured_image' => 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                    'ar' => [
                        'title' => 'خدمات الاستيراد',
                        'content' => '<p>استيراد السيارات إلى الإمارات وإيران مع جميع التصاريح القانونية. ندير جميع إجراءات استيراد السيارات من البداية إلى النهاية حتى تتمكن من استلام سيارتك المطلوبة باطمئنان.</p><p>تشمل خدمات الاستيراد لدينا:</p><ul><li>الحصول على التصاريح اللازمة من السلطات المختصة</li><li>التفاوض مع الموردين الأجانب</li><li>إدارة النقل الدولي</li><li>ترخیص من الجمارك</li><li>التسليم في الموقع المطلوب</li></ul><p>فريقنا المتخصص مع سنوات من الخبرة في استيراد السيارات مستعد لتقديم الخدمات لك.</p>',
                        'excerpt' => 'استيراد السيارات إلى الإمارات وإيران مع جميع التصاريح القانونية',
                        'meta_title' => 'خدمات الاستيراد - استيراد السيارات مع التصاريح القانونية',
                        'meta_description' => 'استيراد السيارات إلى الإمارات وإيران مع جميع التصاريح القانونية والإدارة الكاملة لإجراءات الاستيراد',
                        'tags' => ['استيراد', 'الإمارات', 'إيران', 'تصاريح قانونية'],
                        'author_name' => 'فريق الاستيراد',
                        'featured_image' => 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                ],
            ],
            [
                'slug' => 'vehicle-clearance',
                'status' => 'published',
                'is_featured' => false,
                'icon' => 'fas fa-check-circle',
                'published_at' => now()->subDays(3),
                'type' => 'service',
                'translations' => [
                    'fa' => [
                        'title' => 'ترخیص خودرو',
                        'content' => '<p>ترخیص خودرو از گمرک با سریع‌ترین زمان و کمترین هزینه. ما با تجربه‌ای طولانی در زمینه ترخیص خودرو، تمام مراحل گمرکی را به صورت تخصصی انجام می‌دهیم.</p><p>خدمات ترخیص ما شامل:</p><ul><li>تهیه و تکمیل مدارک گمرکی</li><li>پرداخت عوارض و مالیات</li><li>بازرسی گمرکی</li><li>ترخیص سریع</li><li>تحویل در محل</li></ul><p>ما متعهد به ارائه سریع‌ترین و اقتصادی‌ترین خدمات ترخیص هستیم.</p>',
                        'excerpt' => 'ترخیص خودرو از گمرک با سریع‌ترین زمان و کمترین هزینه',
                        'meta_title' => 'ترخیص خودرو - ترخیص سریع و اقتصادی',
                        'meta_description' => 'ترخیص خودرو از گمرک با سریع‌ترین زمان و کمترین هزینه و مدیریت کامل مراحل گمرکی',
                        'tags' => ['ترخیص', 'گمرک', 'سریع', 'اقتصادی'],
                        'author_name' => 'تیم ترخیص',
                        'featured_image' => 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                    'en' => [
                        'title' => 'Vehicle Clearance',
                        'content' => '<p>Vehicle clearance from customs with the fastest time and lowest cost. With years of experience in vehicle clearance, we perform all customs procedures professionally.</p><p>Our clearance services include:</p><ul><li>Preparation and completion of customs documents</li><li>Payment of duties and taxes</li><li>Customs inspection</li><li>Fast clearance</li><li>Delivery on site</li></ul><p>We are committed to providing the fastest and most economical clearance services.</p>',
                        'excerpt' => 'Vehicle clearance from customs with the fastest time and lowest cost',
                        'meta_title' => 'Vehicle Clearance - Fast and Economical Clearance',
                        'meta_description' => 'Vehicle clearance from customs with the fastest time and lowest cost and complete management of customs procedures',
                        'tags' => ['Clearance', 'Customs', 'Fast', 'Economical'],
                        'author_name' => 'Clearance Team',
                        'featured_image' => 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                    'ar' => [
                        'title' => 'ترخیص السيارات',
                        'content' => '<p>ترخیص السيارات من الجمارك بأسرع وقت وأقل تكلفة. مع سنوات من الخبرة في ترخیص السيارات، نقوم بتنفيذ جميع الإجراءات الجمركية باحترافية.</p><p>تشمل خدمات الترخیص لدينا:</p><ul><li>إعداد وإكمال المستندات الجمركية</li><li>دفع الرسوم والضرائب</li><li>الفحص الجمركي</li><li>الترخیص السريع</li><li>التسليم في الموقع</li></ul><p>نحن ملتزمون بتقديم أسرع وأكثر الخدمات الجمركية اقتصاداً.</p>',
                        'excerpt' => 'ترخیص السيارات من الجمارك بأسرع وقت وأقل تكلفة',
                        'meta_title' => 'ترخیص السيارات - ترخیص سريع واقتصادي',
                        'meta_description' => 'ترخیص السيارات من الجمارك بأسرع وقت وأقل تكلفة والإدارة الكاملة للإجراءات الجمركية',
                        'tags' => ['ترخیص', 'جمارك', 'سريع', 'اقتصادي'],
                        'author_name' => 'فريق الترخیص',
                        'featured_image' => 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                ],
            ],
            [
                'slug' => 'spare-parts',
                'status' => 'published',
                'is_featured' => false,
                'icon' => 'fas fa-tools',
                'published_at' => now()->subDays(4),
                'type' => 'service',
                'translations' => [
                    'fa' => [
                        'title' => 'قطعات یدکی',
                        'content' => '<p>تامین قطعات یدکی اوریجینال و مشابه برای تمامی برندها. ما با تامین‌کنندگان معتبر در سراسر جهان همکاری می‌کنیم تا بهترین قطعات را با قیمت مناسب ارائه دهیم.</p><p>خدمات قطعات یدکی ما شامل:</p><ul><li>قطعات اوریجینال تمامی برندها</li><li>قطعات مشابه با کیفیت بالا</li><li>گارانتی و پشتیبانی</li><li>تحویل سریع</li><li>قیمت‌های رقابتی</li></ul><p>ما متعهد به ارائه بهترین کیفیت و قیمت در زمینه قطعات یدکی هستیم.</p>',
                        'excerpt' => 'تامین قطعات یدکی اوریجینال و مشابه برای تمامی برندها',
                        'meta_title' => 'قطعات یدکی - تامین قطعات اوریجینال و مشابه',
                        'meta_description' => 'تامین قطعات یدکی اوریجینال و مشابه برای تمامی برندها با کیفیت بالا و قیمت مناسب',
                        'tags' => ['قطعات یدکی', 'اوریجینال', 'مشابه', 'کیفیت'],
                        'author_name' => 'تیم قطعات',
                        'featured_image' => 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                    'en' => [
                        'title' => 'Spare Parts',
                        'content' => '<p>Supply of original and similar spare parts for all brands. We collaborate with reliable suppliers around the world to provide the best parts at reasonable prices.</p><p>Our spare parts services include:</p><ul><li>Original parts for all brands</li><li>High-quality similar parts</li><li>Warranty and support</li><li>Fast delivery</li><li>Competitive prices</li></ul><p>We are committed to providing the best quality and price in spare parts.</p>',
                        'excerpt' => 'Supply of original and similar spare parts for all brands',
                        'meta_title' => 'Spare Parts - Supply of Original and Similar Parts',
                        'meta_description' => 'Supply of original and similar spare parts for all brands with high quality and reasonable prices',
                        'tags' => ['Spare Parts', 'Original', 'Similar', 'Quality'],
                        'author_name' => 'Parts Team',
                        'featured_image' => 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                    'ar' => [
                        'title' => 'القطع الاحتياطية',
                        'content' => '<p>توريد القطع الاحتياطية الأصلية والمشابهة لجميع الماركات. نتعاون مع موردين موثوقين حول العالم لتوفير أفضل القطع بأسعار معقولة.</p><p>تشمل خدمات القطع الاحتياطية لدينا:</p><ul><li>القطع الأصلية لجميع الماركات</li><li>قطع مشابهة عالية الجودة</li><li>الضمان والدعم</li><li>التسليم السريع</li><li>أسعار تنافسية</li></ul><p>نحن ملتزمون بتقديم أفضل جودة وسعر في القطع الاحتياطية.</p>',
                        'excerpt' => 'توريد القطع الاحتياطية الأصلية والمشابهة لجميع الماركات',
                        'meta_title' => 'القطع الاحتياطية - توريد القطع الأصلية والمشابهة',
                        'meta_description' => 'توريد القطع الاحتياطية الأصلية والمشابهة لجميع الماركات بجودة عالية وأسعار معقولة',
                        'tags' => ['قطع احتياطية', 'أصلية', 'مشابهة', 'جودة'],
                        'author_name' => 'فريق القطع',
                        'featured_image' => 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                ],
            ],
            [
                'slug' => 'vehicle-inspection',
                'status' => 'published',
                'is_featured' => false,
                'icon' => 'fas fa-wrench',
                'published_at' => now()->subDays(5),
                'type' => 'service',
                'translations' => [
                    'fa' => [
                        'title' => 'بازرسی خودرو',
                        'content' => '<p>بازرسی و کارشناسی خودرو توسط متخصصان مجرب. ما با استفاده از تجهیزات پیشرفته و تیم متخصص، بازرسی کامل خودرو را انجام می‌دهیم.</p><p>خدمات بازرسی ما شامل:</p><ul><li>بازرسی کامل بدنه و رنگ</li><li>بررسی موتور و سیستم تعلیق</li><li>تست سیستم ترمز و فرمان</li><li>بررسی سیستم الکتریکی</li><li>گزارش کامل و دقیق</li></ul><p>ما متعهد به ارائه دقیق‌ترین گزارش بازرسی هستیم.</p>',
                        'excerpt' => 'بازرسی و کارشناسی خودرو توسط متخصصان مجرب',
                        'meta_title' => 'بازرسی خودرو - بازرسی تخصصی و کارشناسی',
                        'meta_description' => 'بازرسی و کارشناسی خودرو توسط متخصصان مجرب با استفاده از تجهیزات پیشرفته',
                        'tags' => ['بازرسی', 'کارشناسی', 'متخصص', 'تجهیزات'],
                        'author_name' => 'تیم بازرسی',
                        'featured_image' => 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                    'en' => [
                        'title' => 'Vehicle Inspection',
                        'content' => '<p>Vehicle inspection and expertise by experienced specialists. We perform complete vehicle inspection using advanced equipment and expert team.</p><p>Our inspection services include:</p><ul><li>Complete body and paint inspection</li><li>Engine and suspension system check</li><li>Brake and steering system test</li><li>Electrical system check</li><li>Complete and accurate report</li></ul><p>We are committed to providing the most accurate inspection report.</p>',
                        'excerpt' => 'Vehicle inspection and expertise by experienced specialists',
                        'meta_title' => 'Vehicle Inspection - Professional Inspection and Expertise',
                        'meta_description' => 'Vehicle inspection and expertise by experienced specialists using advanced equipment',
                        'tags' => ['Inspection', 'Expertise', 'Specialist', 'Equipment'],
                        'author_name' => 'Inspection Team',
                        'featured_image' => 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                    'ar' => [
                        'title' => 'فحص السيارات',
                        'content' => '<p>فحص وخبرة السيارات من قبل متخصصين ذوي خبرة. نقوم بإجراء فحص كامل للسيارة باستخدام معدات متقدمة وفريق متخصص.</p><p>تشمل خدمات الفحص لدينا:</p><ul><li>فحص كامل للهيكل والطلاء</li><li>فحص المحرك ونظام التعليق</li><li>اختبار نظام الفرامل والتوجيه</li><li>فحص النظام الكهربائي</li><li>تقرير كامل ودقيق</li></ul><p>نحن ملتزمون بتقديم أكثر تقرير فحص دقة.</p>',
                        'excerpt' => 'فحص وخبرة السيارات من قبل متخصصين ذوي خبرة',
                        'meta_title' => 'فحص السيارات - فحص متخصص وخبرة',
                        'meta_description' => 'فحص وخبرة السيارات من قبل متخصصين ذوي خبرة باستخدام معدات متقدمة',
                        'tags' => ['فحص', 'خبرة', 'متخصص', 'معدات'],
                        'author_name' => 'فريق الفحص',
                        'featured_image' => 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                ],
            ],
            [
                'slug' => 'vin-history',
                'status' => 'published',
                'is_featured' => false,
                'icon' => 'fas fa-history',
                'published_at' => now()->subDays(6),
                'type' => 'service',
                'translations' => [
                    'fa' => [
                        'title' => 'سابقه VIN',
                        'content' => '<p>استعلام کامل سابقه خودرو با شماره VIN. ما با دسترسی به پایگاه‌های داده معتبر، اطلاعات کامل سابقه خودرو را در اختیار شما قرار می‌دهیم.</p><p>خدمات سابقه VIN ما شامل:</p><ul><li>استعلام سابقه تصادفات</li><li>بررسی سابقه تعمیرات</li><li>تاریخچه مالکیت</li><li>بررسی مسافت طی شده</li><li>گزارش کامل و دقیق</li></ul><p>ما متعهد به ارائه دقیق‌ترین اطلاعات سابقه خودرو هستیم.</p>',
                        'excerpt' => 'استعلام کامل سابقه خودرو با شماره VIN',
                        'meta_title' => 'سابقه VIN - استعلام کامل سابقه خودرو',
                        'meta_description' => 'استعلام کامل سابقه خودرو با شماره VIN و دسترسی به پایگاه‌های داده معتبر',
                        'tags' => ['VIN', 'سابقه', 'استعلام', 'دقیق'],
                        'author_name' => 'تیم استعلام',
                        'featured_image' => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                    'en' => [
                        'title' => 'VIN History',
                        'content' => '<p>Complete vehicle history inquiry with VIN number. We provide complete vehicle history information with access to reliable databases.</p><p>Our VIN history services include:</p><ul><li>Accident history inquiry</li><li>Repair history check</li><li>Ownership history</li><li>Mileage verification</li><li>Complete and accurate report</li></ul><p>We are committed to providing the most accurate vehicle history information.</p>',
                        'excerpt' => 'Complete vehicle history inquiry with VIN number',
                        'meta_title' => 'VIN History - Complete Vehicle History Inquiry',
                        'meta_description' => 'Complete vehicle history inquiry with VIN number and access to reliable databases',
                        'tags' => ['VIN', 'History', 'Inquiry', 'Accurate'],
                        'author_name' => 'Inquiry Team',
                        'featured_image' => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                    'ar' => [
                        'title' => 'سجل VIN',
                        'content' => '<p>استعلام كامل لسجل السيارة برقم VIN. نوفر معلومات كاملة لسجل السيارة مع الوصول إلى قواعد بيانات موثوقة.</p><p>تشمل خدمات سجل VIN لدينا:</p><ul><li>استعلام سجل الحوادث</li><li>فحص سجل الإصلاحات</li><li>سجل الملكية</li><li>التحقق من المسافة المقطوعة</li><li>تقرير كامل ودقيق</li></ul><p>نحن ملتزمون بتقديم أكثر معلومات سجل السيارة دقة.</p>',
                        'excerpt' => 'استعلام كامل لسجل السيارة برقم VIN',
                        'meta_title' => 'سجل VIN - استعلام كامل لسجل السيارة',
                        'meta_description' => 'استعلام كامل لسجل السيارة برقم VIN والوصول إلى قواعد بيانات موثوقة',
                        'tags' => ['VIN', 'سجل', 'استعلام', 'دقيق'],
                        'author_name' => 'فريق الاستعلام',
                        'featured_image' => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                ],
            ],
            [
                'slug' => 'price-quote',
                'status' => 'published',
                'is_featured' => false,
                'icon' => 'fas fa-dollar-sign',
                'published_at' => now()->subDays(7),
                'type' => 'service',
                'translations' => [
                    'fa' => [
                        'title' => 'استعلام قیمت',
                        'content' => '<p>دریافت قیمت دقیق خودرو مورد نظر. ما با بررسی بازار و قیمت‌های روز، قیمت دقیق خودرو مورد نظر شما را ارائه می‌دهیم.</p><p>خدمات استعلام قیمت ما شامل:</p><ul><li>بررسی قیمت‌های بازار</li><li>مقایسه قیمت‌های مختلف</li><li>تحلیل روند قیمت‌ها</li><li>پیش‌بینی قیمت آینده</li><li>گزارش کامل قیمت</li></ul><p>ما متعهد به ارائه دقیق‌ترین قیمت‌های بازار هستیم.</p>',
                        'excerpt' => 'دریافت قیمت دقیق خودرو مورد نظر',
                        'meta_title' => 'استعلام قیمت - دریافت قیمت دقیق خودرو',
                        'meta_description' => 'دریافت قیمت دقیق خودرو مورد نظر با بررسی بازار و قیمت‌های روز',
                        'tags' => ['قیمت', 'استعلام', 'بازار', 'دقیق'],
                        'author_name' => 'تیم قیمت',
                        'featured_image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                    'en' => [
                        'title' => 'Price Quote',
                        'content' => '<p>Get accurate price for your desired vehicle. We provide accurate prices for your desired vehicle by examining the market and current prices.</p><p>Our price quote services include:</p><ul><li>Market price review</li><li>Comparison of different prices</li><li>Price trend analysis</li><li>Future price prediction</li><li>Complete price report</li></ul><p>We are committed to providing the most accurate market prices.</p>',
                        'excerpt' => 'Get accurate price for your desired vehicle',
                        'meta_title' => 'Price Quote - Get Accurate Vehicle Price',
                        'meta_description' => 'Get accurate price for your desired vehicle by examining the market and current prices',
                        'tags' => ['Price', 'Quote', 'Market', 'Accurate'],
                        'author_name' => 'Price Team',
                        'featured_image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                    'ar' => [
                        'title' => 'عرض السعر',
                        'content' => '<p>احصل على سعر دقيق لسيارتك المطلوبة. نوفر أسعار دقيقة لسيارتك المطلوبة من خلال فحص السوق والأسعار الحالية.</p><p>تشمل خدمات عرض السعر لدينا:</p><ul><li>مراجعة أسعار السوق</li><li>مقارنة الأسعار المختلفة</li><li>تحليل اتجاهات الأسعار</li><li>توقع الأسعار المستقبلية</li><li>تقرير سعر كامل</li></ul><p>نحن ملتزمون بتقديم أكثر أسعار السوق دقة.</p>',
                        'excerpt' => 'احصل على سعر دقيق لسيارتك المطلوبة',
                        'meta_title' => 'عرض السعر - احصل على سعر دقيق للسيارة',
                        'meta_description' => 'احصل على سعر دقيق لسيارتك المطلوبة من خلال فحص السوق والأسعار الحالية',
                        'tags' => ['سعر', 'عرض', 'سوق', 'دقيق'],
                        'author_name' => 'فريق السعر',
                        'featured_image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                ],
            ],
            [
                'slug' => 'import-cost',
                'status' => 'published',
                'is_featured' => false,
                'icon' => 'fas fa-calculator',
                'published_at' => now()->subDays(8),
                'type' => 'service',
                'translations' => [
                    'fa' => [
                        'title' => 'هزینه واردات',
                        'content' => '<p>محاسبه هزینه‌های واردات خودرو. ما تمام هزینه‌های مربوط به واردات خودرو را محاسبه کرده و گزارش کامل ارائه می‌دهیم.</p><p>خدمات محاسبه هزینه واردات ما شامل:</p><ul><li>محاسبه عوارض گمرکی</li><li>هزینه حمل و نقل</li><li>هزینه بیمه</li><li>هزینه‌های اداری</li><li>گزارش کامل هزینه‌ها</li></ul><p>ما متعهد به ارائه دقیق‌ترین محاسبات هزینه واردات هستیم.</p>',
                        'excerpt' => 'محاسبه هزینه‌های واردات خودرو',
                        'meta_title' => 'هزینه واردات - محاسبه دقیق هزینه‌های واردات',
                        'meta_description' => 'محاسبه هزینه‌های واردات خودرو با در نظر گرفتن تمام هزینه‌های مربوطه',
                        'tags' => ['هزینه', 'واردات', 'محاسبه', 'دقیق'],
                        'author_name' => 'تیم محاسبه',
                        'featured_image' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                    'en' => [
                        'title' => 'Import Cost',
                        'content' => '<p>Calculate vehicle import costs. We calculate all costs related to vehicle import and provide a complete report.</p><p>Our import cost calculation services include:</p><ul><li>Customs duty calculation</li><li>Transportation costs</li><li>Insurance costs</li><li>Administrative costs</li><li>Complete cost report</li></ul><p>We are committed to providing the most accurate import cost calculations.</p>',
                        'excerpt' => 'Calculate vehicle import costs',
                        'meta_title' => 'Import Cost - Accurate Import Cost Calculation',
                        'meta_description' => 'Calculate vehicle import costs considering all related costs',
                        'tags' => ['Cost', 'Import', 'Calculation', 'Accurate'],
                        'author_name' => 'Calculation Team',
                        'featured_image' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                    'ar' => [
                        'title' => 'تكلفة الاستيراد',
                        'content' => '<p>احسب تكاليف استيراد السيارات. نحسب جميع التكاليف المتعلقة باستيراد السيارات ونوفر تقريراً كاملاً.</p><p>تشمل خدمات حساب تكلفة الاستيراد لدينا:</p><ul><li>حساب الرسوم الجمركية</li><li>تكاليف النقل</li><li>تكاليف التأمين</li><li>التكاليف الإدارية</li><li>تقرير تكلفة كامل</li></ul><p>نحن ملتزمون بتقديم أكثر حسابات تكلفة الاستيراد دقة.</p>',
                        'excerpt' => 'احسب تكاليف استيراد السيارات',
                        'meta_title' => 'تكلفة الاستيراد - حساب دقيق لتكلفة الاستيراد',
                        'meta_description' => 'احسب تكاليف استيراد السيارات مع مراعاة جميع التكاليف ذات الصلة',
                        'tags' => ['تكلفة', 'استيراد', 'حساب', 'دقيق'],
                        'author_name' => 'فريق الحساب',
                        'featured_image' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                ],
            ],
            [
                'slug' => 'seller-registration',
                'status' => 'published',
                'is_featured' => false,
                'icon' => 'fas fa-user-plus',
                'published_at' => now()->subDays(9),
                'type' => 'service',
                'translations' => [
                    'fa' => [
                        'title' => 'ثبت نام فروشنده',
                        'content' => '<p>ثبت نام به عنوان فروشنده خودرو. ما به فروشندگان خودرو امکان ثبت نام و ارائه خدمات فروش را می‌دهیم.</p><p>خدمات ثبت نام فروشنده ما شامل:</p><ul><li>ثبت نام رایگان</li><li>پنل مدیریت فروشنده</li><li>مدیریت آگهی‌های فروش</li><li>پشتیبانی کامل</li><li>دریافت کمیسیون</li></ul><p>ما متعهد به ارائه بهترین خدمات به فروشندگان هستیم.</p>',
                        'excerpt' => 'ثبت نام به عنوان فروشنده خودرو',
                        'meta_title' => 'ثبت نام فروشنده - ثبت نام رایگان فروشندگان',
                        'meta_description' => 'ثبت نام به عنوان فروشنده خودرو با پنل مدیریت و پشتیبانی کامل',
                        'tags' => ['فروشنده', 'ثبت نام', 'رایگان', 'پنل'],
                        'author_name' => 'تیم فروش',
                        'featured_image' => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                    'en' => [
                        'title' => 'Seller Registration',
                        'content' => '<p>Register as a vehicle seller. We provide vehicle sellers with the opportunity to register and provide sales services.</p><p>Our seller registration services include:</p><ul><li>Free registration</li><li>Seller management panel</li><li>Sales ad management</li><li>Complete support</li><li>Commission earning</li></ul><p>We are committed to providing the best services to sellers.</p>',
                        'excerpt' => 'Register as a vehicle seller',
                        'meta_title' => 'Seller Registration - Free Seller Registration',
                        'meta_description' => 'Register as a vehicle seller with management panel and complete support',
                        'tags' => ['Seller', 'Registration', 'Free', 'Panel'],
                        'author_name' => 'Sales Team',
                        'featured_image' => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                    'ar' => [
                        'title' => 'تسجيل البائع',
                        'content' => '<p>سجل كبائع سيارات. نوفر لبائعي السيارات فرصة التسجيل وتقديم خدمات البيع.</p><p>تشمل خدمات تسجيل البائع لدينا:</p><ul><li>تسجيل مجاني</li><li>لوحة إدارة البائع</li><li>إدارة إعلانات البيع</li><li>دعم كامل</li><li>كسب العمولة</li></ul><p>نحن ملتزمون بتقديم أفضل الخدمات للبائعين.</p>',
                        'excerpt' => 'سجل كبائع سيارات',
                        'meta_title' => 'تسجيل البائع - تسجيل مجاني للبائعين',
                        'meta_description' => 'سجل كبائع سيارات مع لوحة إدارة ودعم كامل',
                        'tags' => ['بائع', 'تسجيل', 'مجاني', 'لوحة'],
                        'author_name' => 'فريق المبيعات',
                        'featured_image' => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    ],
                ],
            ],
        ];

        foreach ($services as $serviceData) {
            // Get featured_image from first translation
            $firstTranslation = reset($serviceData['translations']);
            $featuredImage = $firstTranslation['featured_image'] ?? null;

            $article = Article::create([
                'slug' => $serviceData['slug'],
                'category_id' => $servicesCategory->id,
                'user_id' => $user ? $user->id : null,
                'status' => $serviceData['status'],
                'is_featured' => $serviceData['is_featured'],
                'allow_comments' => true,
                'published_at' => $serviceData['published_at'],
                'icon' => $serviceData['icon'],
                'featured_image' => $featuredImage,
                'type' => $serviceData['type'],
            ]);

            foreach ($serviceData['translations'] as $langCode => $translation) {
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
