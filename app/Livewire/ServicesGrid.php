<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Category;
use Livewire\Component;

class ServicesGrid extends Component
{
    public $services = [];

    public function mount()
    {
        // Get services category
        $servicesCategory = Category::where('slug', 'services')->first();

        if ($servicesCategory) {
            // Get current language
            $currentLanguage = \App\Models\Language::where('code', app()->getLocale())->first();

            if (!$currentLanguage) {
                $currentLanguage = \App\Models\Language::where('is_default', true)->first();
            }

            if (!$currentLanguage) {
                $currentLanguage = \App\Models\Language::first();
            }

            // Load services articles
            $servicesArticles = Article::with(['translations.language', 'category.translations'])
                ->where('category_id', $servicesCategory->id)
                ->published()
                ->services() // Only services
                ->featured()
                ->orderBy('published_at', 'desc')
                ->take(6)
                ->get();

            // Transform articles to services array
            $this->services = $servicesArticles->map(function ($article) use ($currentLanguage) {
                $translation = $article->translations->where('language_id', $currentLanguage->id)->first();

                if (!$translation) {
                    // Fallback to default language
                    $defaultLanguage = \App\Models\Language::where('is_default', true)->first();
                    $translation = $article->translations->where('language_id', $defaultLanguage->id)->first();
                }

                if (!$translation) {
                    // Fallback to first available translation
                    $translation = $article->translations->first();
                }

                if (!$translation) {
                    return null;
                }

                return [
                    'id' => $article->id,
                    'title' => $translation->title,
                    'description' => $translation->excerpt,
                    'image' => $article->featured_image ? asset('storage/' . $article->featured_image) : null,
                    'icon' => $article->icon ?? 'fas fa-cog', // Use database icon or fallback
                    'link' => route('services.show', $article->slug),
                    'is_featured' => $article->is_featured,
                    'views_count' => $article->views_count,
                    'comments_count' => $article->comments()->where('status', 'approved')->count(),
                ];
            })->filter()->toArray();
        }

        // Fallback to static data if no services found
        if (empty($this->services)) {
            $this->services = [
                [
                    'title' => app()->getLocale() === 'fa' ? 'تامین خودرو' : 'Vehicle Supply',
                    'description' => app()->getLocale() === 'fa' ? 'تامین خودروهای صفر و دست‌دوم با بهترین قیمت و کیفیت از سراسر جهان' : 'Supply of new and used vehicles with the best price and quality from around the world',
                    'icon' => 'fas fa-car',
                    'image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    'link' => '#vehicle-supply'
                ],
                [
                    'title' => app()->getLocale() === 'fa' ? 'خدمات واردات' : 'Import Services',
                    'description' => app()->getLocale() === 'fa' ? 'واردات خودرو به امارات و ایران با تمامی مجوزهای قانونی' : 'Vehicle import to UAE and Iran with all legal permits',
                    'icon' => 'fas fa-ship',
                    'image' => 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    'link' => '#import-services'
                ],
                [
                    'title' => app()->getLocale() === 'fa' ? 'ترخیص خودرو' : 'Vehicle Clearance',
                    'description' => app()->getLocale() === 'fa' ? 'ترخیص خودرو از گمرک با سریع‌ترین زمان و کمترین هزینه' : 'Vehicle clearance from customs with the fastest time and lowest cost',
                    'icon' => 'fas fa-file-contract',
                    'image' => 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    'link' => '#vehicle-clearance'
                ],
                [
                    'title' => app()->getLocale() === 'fa' ? 'قطعات یدکی' : 'Spare Parts',
                    'description' => app()->getLocale() === 'fa' ? 'تامین قطعات یدکی اوریجینال و مشابه برای تمامی برندها' : 'Supply of original and similar spare parts for all brands',
                    'icon' => 'fas fa-cogs',
                    'image' => 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    'link' => '#spare-parts'
                ],
                [
                    'title' => app()->getLocale() === 'fa' ? 'بازرسی خودرو' : 'Vehicle Inspection',
                    'description' => app()->getLocale() === 'fa' ? 'بازرسی و کارشناسی خودرو توسط متخصصان مجرب' : 'Vehicle inspection and expertise by experienced specialists',
                    'icon' => 'fas fa-clipboard-check',
                    'image' => 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    'link' => '#vehicle-inspection'
                ],
                [
                    'title' => app()->getLocale() === 'fa' ? 'سابقه VIN' : 'VIN History',
                    'description' => app()->getLocale() === 'fa' ? 'استعلام کامل سابقه خودرو با شماره VIN' : 'Complete vehicle history inquiry with VIN number',
                    'icon' => 'fas fa-history',
                    'image' => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                    'link' => '#vin-history'
                ]
            ];
        }
    }

    public function render()
    {
        return view('livewire.services-grid');
    }
}
