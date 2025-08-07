<?php

namespace App\Helpers;

use App\Models\Language;

class LanguageHelper
{
    /**
     * Get all active languages ordered by sort_order
     */
    public static function getActiveLanguages()
    {
        return Language::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Get current language
     */
    public static function getCurrentLanguage()
    {
        return Language::where('code', app()->getLocale())->first();
    }

    /**
     * Check if language is active
     */
    public static function isLanguageActive($code)
    {
        return Language::where('code', $code)
            ->where('is_active', true)
            ->exists();
    }

    /**
     * Get language name by code
     */
    public static function getLanguageName($code)
    {
        $language = Language::where('code', $code)->first();
        return $language ? $language->name : $code;
    }
}
