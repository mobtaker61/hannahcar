<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeroSlider;
use App\Models\HomepageBlock;
use App\Models\Page;
use App\Models\Language;

class HomeController extends Controller
{
    public function index()
    {
        // Get active hero sliders
        $heroSliders = HeroSlider::with(['translations.language'])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Get homepage blocks
        $homepageBlocks = HomepageBlock::with(['translations.language'])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('home', compact('heroSliders', 'homepageBlocks'));
    }

    /**
     * Show a specific page
     */
    public function showPage($slug)
    {
        // Get current language
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

        // Get page with translations
        $page = Page::with(['translations.language'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Get current language translation
        $currentTranslation = $page->translations->where('language_id', $currentLanguage->id)->first();

        // Fallback to first available translation if current language translation not found
        if (!$currentTranslation) {
            $currentTranslation = $page->translations->first();
        }

        return view('pages.show', compact('page', 'currentLanguage', 'currentTranslation'));
    }

    /**
     * Switch language
     */
    public function switchLanguage($locale)
    {
        if (in_array($locale, ['fa', 'en', 'ar'])) {
            session()->put('locale', $locale);
        }

        return redirect()->back();
    }
}
