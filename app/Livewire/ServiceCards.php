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
                    'title' => app()->getLocale() === 'fa' ? 'استعلام قیمت خودرو' : 'Vehicle Price Quote',
                    'description' => app()->getLocale() === 'fa' ? 'دریافت قیمت دقیق خودرو مورد نظر شما با بهترین شرایط' : 'Get accurate price for your desired vehicle with best conditions',
                    'icon' => 'fas fa-calculator',
                    'link' => route('inquiry-forms.show', 'price-quote')
                ],
                [
                    'title' => app()->getLocale() === 'fa' ? 'محاسبه هزینه واردات' : 'Import Cost Calculator',
                    'description' => app()->getLocale() === 'fa' ? 'محاسبه دقیق هزینه‌های واردات خودرو به ایران و امارات' : 'Calculate exact vehicle import costs to Iran and UAE',
                    'icon' => 'fas fa-ship',
                    'link' => route('inquiry-forms.show', 'import-cost')
                ],
                [
                    'title' => app()->getLocale() === 'fa' ? 'بررسی سابقه VIN' : 'VIN History Check',
                    'description' => app()->getLocale() === 'fa' ? 'استعلام کامل سابقه خودرو با شماره VIN و گزارش کامل' : 'Complete vehicle history inquiry with VIN number and full report',
                    'icon' => 'fas fa-search',
                    'link' => route('inquiry-forms.show', 'vin-check')
                ],
                [
                    'title' => app()->getLocale() === 'fa' ? 'ثبت نام فروشنده' : 'Seller Registration',
                    'description' => app()->getLocale() === 'fa' ? 'ثبت نام به عنوان فروشنده خودرو و دسترسی به بازار بزرگ' : 'Register as a vehicle seller and access large market',
                    'icon' => 'fas fa-user-plus',
                    'link' => route('inquiry-forms.show', 'seller-registration')
                ]
            ];
        }
    }

    public function render()
    {
        return view('livewire.service-cards');
    }
}
