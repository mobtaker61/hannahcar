<?php

namespace App\Helpers;

use App\Models\Page;
use App\Models\Language;

class PageHelper
{
    /**
     * Get page URL by slug
     */
    public static function getPageUrl($slug)
    {
        return '/' . $slug;
    }

    /**
     * Get page by slug
     */
    public static function getPage($slug)
    {
        return Page::where('slug', $slug)
            ->where('status', 'published')
            ->with(['translations.language'])
            ->first();
    }

    /**
     * Get page translation for current language
     */
    public static function getPageTranslation($page, $languageId = null)
    {
        if (!$languageId) {
            $currentLocale = app()->getLocale();
            $currentLanguage = Language::where('code', $currentLocale)->first();

            if (!$currentLanguage) {
                $currentLanguage = Language::where('is_default', true)->first();
            }

            if (!$currentLanguage) {
                $currentLanguage = Language::first();
            }

            $languageId = $currentLanguage->id;
        }

        $translation = $page->translations->where('language_id', $languageId)->first();

        if (!$translation) {
            $translation = $page->translations->first();
        }

        return $translation;
    }

    /**
     * Get all published pages
     */
    public static function getPublishedPages()
    {
        return Page::where('status', 'published')
            ->with(['translations.language'])
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Check if page exists and is published
     */
    public static function pageExists($slug)
    {
        return Page::where('slug', $slug)
            ->where('status', 'published')
            ->exists();
    }
}