<?php

namespace App\Helpers;

use App\Models\Language;
use App\Models\Setting;

class SettingHelper
{
    /**
     * Get setting value by key
     */
    public static function get($key, $default = null)
    {
        $setting = Setting::where('key', $key)->first();

        if (! $setting) {
            return $default;
        }

        // Get current language
        $currentLocale = app()->getLocale();
        $currentLanguage = Language::where('code', $currentLocale)->first();

        if (! $currentLanguage) {
            $currentLanguage = Language::where('is_default', true)->first();
        }

        if (! $currentLanguage) {
            $currentLanguage = Language::first();
        }

        // Get translation
        $translation = $setting->translations->where('language_id', $currentLanguage->id)->first();

        if (! $translation) {
            $translation = $setting->translations->first();
        }

        return $translation && $translation->value !== null ? $translation->value : $default;
    }

    /**
     * Set setting value
     */
    public static function set($key, $value, $group = 'general')
    {
        $setting = Setting::where('key', $key)->first();

        if (! $setting) {
            $setting = Setting::create([
                'key' => $key,
                'type' => 'text',
                'group' => $group,
                'description' => '',
                'is_public' => true,
            ]);
        }

        // Get current language
        $currentLocale = app()->getLocale();
        $currentLanguage = Language::where('code', $currentLocale)->first();

        if (! $currentLanguage) {
            $currentLanguage = Language::where('is_default', true)->first();
        }

        if (! $currentLanguage) {
            $currentLanguage = Language::first();
        }

        // Update translation
        $setting->translations()->updateOrCreate(
            ['language_id' => $currentLanguage->id],
            ['value' => $value]
        );

        return $setting;
    }

    /**
     * Get all settings by group
     */
    public static function getGroup($group)
    {
        return Setting::with(['translations.language'])
            ->where('group', $group)
            ->orderBy('key')
            ->get();
    }

    /**
     * Get all public settings
     */
    public static function getPublic()
    {
        return Setting::with(['translations.language'])
            ->where('is_public', true)
            ->orderBy('group')
            ->orderBy('key')
            ->get()
            ->keyBy('key');
    }

    public static function getNotificationFooter()
    {
        return self::get('notification_footer', "\nمنتظر تماس کارشناسان ما باشید\nتلفن تماس: 09123456789\nایمیل: info@hannahcar.ir\nHANNAH CAR");
    }

    /**
     * @see media_url()
     */
    public static function mediaUrl(?string $path): ?string
    {
        return media_url($path);
    }

    /**
     * Get file path from setting (removes domain if present)
     */
    public static function getFilePath($key, $default = null)
    {
        $value = self::get($key, $default);

        if (! $value) {
            return $default;
        }

        if (filter_var($value, FILTER_VALIDATE_URL)) {
            $parsedUrl = parse_url($value);

            return ltrim($parsedUrl['path'] ?? $value, '/');
        }

        return ltrim($value, '/');
    }
}
