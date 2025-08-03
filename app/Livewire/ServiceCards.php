<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Category;
use Livewire\Component;

class ServiceCards extends Component
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

            // Load services articles for cards (smaller services)
            $servicesArticles = Article::with(['translations.language', 'category.translations'])
                ->where('category_id', $servicesCategory->id)
                ->published()
                ->services() // Only services
                ->where('is_featured', false) // Smaller services are not featured
                ->orderBy('published_at', 'desc')
                ->take(4)
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
                    'icon' => $article->icon ?? 'fas fa-cog', // Use database icon or fallback
                    'featured_image' => $article->featured_image ? asset('storage/' . $article->featured_image) : null,
                    'link' => route('services.show', $article->slug),
                ];
            })->filter()->toArray();
        }

        // Fallback to static data if no services found
        if (empty($this->services)) {
            $this->services = [
                [
                    'title' => app()->getLocale() === 'fa' ? 'استعلام قیمت' : 'Price Quote',
                    'description' => app()->getLocale() === 'fa' ? 'دریافت قیمت دقیق خودرو مورد نظر' : 'Get accurate price for your desired vehicle',
                    'icon' => 'fas fa-calculator',
                    'link' => '#price-quote'
                ],
                [
                    'title' => app()->getLocale() === 'fa' ? 'هزینه واردات' : 'Import Cost',
                    'description' => app()->getLocale() === 'fa' ? 'محاسبه هزینه‌های واردات خودرو' : 'Calculate vehicle import costs',
                    'icon' => 'fas fa-ship',
                    'link' => '#import-cost'
                ],
                [
                    'title' => app()->getLocale() === 'fa' ? 'بررسی VIN' : 'VIN Check',
                    'description' => app()->getLocale() === 'fa' ? 'استعلام سابقه کامل خودرو' : 'Complete vehicle history inquiry',
                    'icon' => 'fas fa-search',
                    'link' => '#vin-check'
                ],
                [
                    'title' => app()->getLocale() === 'fa' ? 'ثبت نام فروشنده' : 'Seller Registration',
                    'description' => app()->getLocale() === 'fa' ? 'ثبت نام به عنوان فروشنده خودرو' : 'Register as a vehicle seller',
                    'icon' => 'fas fa-user-plus',
                    'link' => '#seller-registration'
                ]
            ];
        }
    }

    public function render()
    {
        return view('livewire.service-cards');
    }
}
