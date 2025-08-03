<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use App\Models\Menu;
use App\Models\Language;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share site settings and menus with all views
        View::composer('layouts.app', function ($view) {
            // Get current language from database
            $currentLocale = app()->getLocale();
            $currentLanguage = Language::where('code', $currentLocale)->first();

            // Fallback to default language if current language not found
            if (!$currentLanguage) {
                $currentLanguage = Language::where('is_default', true)->first();
            }

            // Fallback to first available language if no default language
            if (!$currentLanguage) {
                $currentLanguage = Language::first();
            }

            $siteSettings = Setting::with(['translations.language'])
                ->where('is_public', true)
                ->get()
                ->keyBy('key');

            $menus = Menu::with(['translations.language', 'menuItems.translations.language'])
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->keyBy('position');

            $view->with(compact('siteSettings', 'menus', 'currentLanguage'));
        });
    }
}
