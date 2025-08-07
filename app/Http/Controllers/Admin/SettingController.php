<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::with('translations.language')
            ->orderBy('group')
            ->orderBy('key')
            ->get();

        $settingsGrouped = $settings->groupBy('group');

        return view('admin.settings.index', compact('settings', 'settingsGrouped'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::active()->get();
        return view('admin.settings.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string|unique:settings',
            'type' => 'required|in:text,textarea,image,boolean,number,email,url',
            'group' => 'required|string',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
            'translations' => 'required|array',
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.value' => 'required|string',
            'translations.*.is_active' => 'boolean',
        ]);

        $setting = Setting::create([
            'key' => $request->key,
            'type' => $request->type,
            'group' => $request->group,
            'description' => $request->description,
            'is_public' => $request->boolean('is_public'),
        ]);

        // Create translations
        foreach ($request->translations as $translation) {
            $setting->translations()->create($translation);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'تنظیم با موفقیت ایجاد شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        $setting->load('translations.language');
        return view('admin.settings.show', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        $languages = Language::active()->get();
        $setting->load('translations.language');
        return view('admin.settings.edit', compact('setting', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'key' => 'required|string|unique:settings,key,' . $setting->id,
            'type' => 'required|in:text,textarea,image,boolean,number,email,url',
            'group' => 'required|string',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
            'translations' => 'required|array',
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.value' => 'required|string',
            'translations.*.is_active' => 'boolean',
        ]);

        $setting->update([
            'key' => $request->key,
            'type' => $request->type,
            'group' => $request->group,
            'description' => $request->description,
            'is_public' => $request->boolean('is_public'),
        ]);

        // Update translations
        foreach ($request->translations as $translation) {
            $setting->translations()->updateOrCreate(
                ['language_id' => $translation['language_id']],
                $translation
            );
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'تنظیم با موفقیت به‌روزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();

        return redirect()->route('admin.settings.index')
            ->with('success', 'تنظیم با موفقیت حذف شد.');
    }

    /**
     * Show settings by group
     */
    public function showGroup($group)
    {
        $settings = Setting::with('translations.language')
            ->where('group', $group)
            ->orderBy('key')
            ->get();

        return view('admin.settings.show-group', compact('settings', 'group'));
    }

    /**
     * Bulk update settings
     */
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*.id' => 'required|exists:settings,id',
            'settings.*.value' => 'required|string',
        ]);

        foreach ($request->settings as $settingData) {
            $setting = Setting::find($settingData['id']);
            if ($setting) {
                $setting->translations()->updateOrCreate(
                    ['language_id' => app()->getLocale() === 'fa' ? 1 : (app()->getLocale() === 'en' ? 2 : 3)],
                    ['value' => $settingData['value']]
                );
            }
        }

        return redirect()->back()->with('success', 'تنظیمات با موفقیت به‌روزرسانی شدند.');
    }

    /**
     * Show general settings page
     */
    public function general()
    {
        $languages = Language::active()->get();
        $generalSettings = Setting::with('translations.language')
            ->where('group', 'general')
            ->orderBy('key')
            ->get();

        return view('admin.settings.general', compact('generalSettings', 'languages'));
    }

    /**
     * Update general settings
     */
    public function updateGeneral(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'site_description' => 'nullable|string',
            'site_keywords' => 'nullable|string',
            'site_logo' => 'nullable|string',
            'site_logo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'site_favicon' => 'nullable|string',
            'site_favicon_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,ico,svg|max:1024',
            'primary_color' => 'nullable|string|max:7',
            'secondary_color' => 'nullable|string|max:7',
            'default_language' => 'required|string|in:fa,en,ar',
            'timezone' => 'required|string',
            'date_format' => 'required|string',
            'time_format' => 'required|string',
            'maintenance_mode' => 'boolean',
            'maintenance_message' => 'nullable|string',
        ]);

        // Handle file uploads
        $siteLogo = $request->site_logo;
        $siteFavicon = $request->site_favicon;

        if ($request->hasFile('site_logo_file')) {
            $logoFile = \App\Models\File::upload($request->file('site_logo_file'), 'logo');
            $siteLogo = $logoFile->url;
        }

        if ($request->hasFile('site_favicon_file')) {
            $faviconFile = \App\Models\File::upload($request->file('site_favicon_file'), 'favicon');
            $siteFavicon = $faviconFile->url;
        }

        // Update or create settings
        $settings = [
            'site_name' => $request->site_name,
            'site_tagline' => $request->site_tagline,
            'site_description' => $request->site_description,
            'site_keywords' => $request->site_keywords,
            'site_logo' => $siteLogo,
            'site_favicon' => $siteFavicon,
            'primary_color' => $request->primary_color,
            'secondary_color' => $request->secondary_color,
            'default_language' => $request->default_language,
            'timezone' => $request->timezone,
            'date_format' => $request->date_format,
            'time_format' => $request->time_format,
            'maintenance_mode' => $request->boolean('maintenance_mode'),
            'maintenance_message' => $request->maintenance_message,
        ];

        foreach ($settings as $key => $value) {
            // Skip null values
            if ($value === null) {
                continue;
            }

            $setting = Setting::where('key', $key)->first();

            if (!$setting) {
                $setting = Setting::create([
                    'key' => $key,
                    'type' => $this->getSettingType($key),
                    'group' => 'general',
                    'description' => $this->getSettingDescription($key),
                    'is_public' => true,
                ]);
            }

            // Get current language ID
            $currentLocale = app()->getLocale();
            $currentLanguage = Language::where('code', $currentLocale)->first();

            if (!$currentLanguage) {
                $currentLanguage = Language::where('is_default', true)->first();
            }

            if (!$currentLanguage) {
                $currentLanguage = Language::first();
            }

            // Update translation only if value is not null
            if ($value !== null) {
                $setting->translations()->updateOrCreate(
                    ['language_id' => $currentLanguage->id],
                    ['value' => $value]
                );
            }
        }

        return redirect()->route('admin.settings.general')
            ->with('success', 'تنظیمات عمومی با موفقیت به‌روزرسانی شدند.');
    }

    /**
     * Get setting type based on key
     */
    private function getSettingType($key)
    {
        $types = [
            'site_name' => 'text',
            'site_tagline' => 'text',
            'site_description' => 'textarea',
            'site_keywords' => 'text',
            'site_logo' => 'url',
            'site_favicon' => 'url',
            'primary_color' => 'text',
            'secondary_color' => 'text',
            'default_language' => 'text',
            'timezone' => 'text',
            'date_format' => 'text',
            'time_format' => 'text',
            'maintenance_mode' => 'boolean',
            'maintenance_message' => 'textarea',
        ];

        return $types[$key] ?? 'text';
    }

    /**
     * Get setting description based on key
     */
    private function getSettingDescription($key)
    {
        $descriptions = [
            'site_name' => 'نام اصلی سایت',
            'site_tagline' => 'شعار یا توضیح کوتاه سایت',
            'site_description' => 'توضیحات کامل سایت برای SEO',
            'site_keywords' => 'کلمات کلیدی سایت',
            'site_logo' => 'آدرس لوگوی سایت',
            'site_favicon' => 'آدرس آیکون سایت',
            'primary_color' => 'رنگ اصلی سایت',
            'secondary_color' => 'رنگ ثانویه سایت',
            'default_language' => 'زبان پیش‌فرض سایت',
            'timezone' => 'منطقه زمانی سایت',
            'date_format' => 'فرمت نمایش تاریخ',
            'time_format' => 'فرمت نمایش زمان',
            'maintenance_mode' => 'حالت نگهداری سایت',
            'maintenance_message' => 'پیام نمایش داده شده در حالت نگهداری',
        ];

        return $descriptions[$key] ?? '';
    }

    /**
     * Show SEO settings page
     */
    public function seo()
    {
        $languages = Language::active()->get();
        $seoSettings = Setting::with('translations.language')
            ->where('group', 'seo')
            ->orderBy('key')
            ->get();

        return view('admin.settings.seo', compact('seoSettings', 'languages'));
    }

    /**
     * Update SEO settings
     */
    public function updateSeo(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*.key' => 'required|string',
            'settings.*.value' => 'required|string',
        ]);

        foreach ($request->settings as $settingData) {
            $setting = Setting::where('key', $settingData['key'])->first();
            if ($setting) {
                $setting->translations()->updateOrCreate(
                    ['language_id' => app()->getLocale() === 'fa' ? 1 : (app()->getLocale() === 'en' ? 2 : 3)],
                    ['value' => $settingData['value']]
                );
            }
        }

        return redirect()->route('admin.settings.seo')
            ->with('success', 'تنظیمات SEO با موفقیت به‌روزرسانی شدند.');
    }

    /**
     * Show social media settings page
     */
    public function social()
    {
        $languages = Language::active()->get();
        $socialSettings = Setting::with('translations.language')
            ->where('group', 'social')
            ->orderBy('key')
            ->get();

        return view('admin.settings.social', compact('socialSettings', 'languages'));
    }

    /**
     * Update social media settings
     */
    public function updateSocial(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*.key' => 'required|string',
            'settings.*.value' => 'required|string',
        ]);

        foreach ($request->settings as $settingData) {
            $setting = Setting::where('key', $settingData['key'])->first();
            if ($setting) {
                $setting->translations()->updateOrCreate(
                    ['language_id' => app()->getLocale() === 'fa' ? 1 : (app()->getLocale() === 'en' ? 2 : 3)],
                    ['value' => $settingData['value']]
                );
            }
        }

        return redirect()->route('admin.settings.social')
            ->with('success', 'تنظیمات شبکه‌های اجتماعی با موفقیت به‌روزرسانی شدند.');
    }

    /**
     * Show contact settings page
     */
    public function contact()
    {
        $languages = Language::active()->get();
        $contactSettings = Setting::with('translations.language')
            ->where('group', 'contact')
            ->orderBy('key')
            ->get();

        return view('admin.settings.contact', compact('contactSettings', 'languages'));
    }

    /**
     * Update contact settings
     */
    public function updateContact(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*.key' => 'required|string',
            'settings.*.value' => 'required|string',
        ]);

        foreach ($request->settings as $settingData) {
            $setting = Setting::where('key', $settingData['key'])->first();
            if ($setting) {
                $setting->translations()->updateOrCreate(
                    ['language_id' => app()->getLocale() === 'fa' ? 1 : (app()->getLocale() === 'en' ? 2 : 3)],
                    ['value' => $settingData['value']]
                );
            }
        }

        return redirect()->route('admin.settings.contact')
            ->with('success', 'تنظیمات تماس با موفقیت به‌روزرسانی شدند.');
    }

    /**
     * Show email settings page
     */
    public function email()
    {
        $languages = Language::active()->get();
        $emailSettings = Setting::with('translations.language')
            ->where('group', 'email')
            ->orderBy('key')
            ->get();

        return view('admin.settings.email', compact('emailSettings', 'languages'));
    }

    /**
     * Update email settings
     */
    public function updateEmail(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*.key' => 'required|string',
            'settings.*.value' => 'required|string',
        ]);

        foreach ($request->settings as $settingData) {
            $setting = Setting::where('key', $settingData['key'])->first();
            if ($setting) {
                $setting->translations()->updateOrCreate(
                    ['language_id' => app()->getLocale() === 'fa' ? 1 : (app()->getLocale() === 'en' ? 2 : 3)],
                    ['value' => $settingData['value']]
                );
            }
        }

        return redirect()->route('admin.settings.email')
            ->with('success', 'تنظیمات ایمیل با موفقیت به‌روزرسانی شدند.');
    }

    /**
     * نمایش تنظیمات کانال‌های اطلاع‌رسانی
     */
    public function notification()
    {
        $languages = Language::active()->get();
        $notificationSettings = Setting::with('translations.language')
            ->whereIn('group', ['notification', 'notifications'])
            ->orderBy('key')
            ->get()
            ->mapWithKeys(function($item) {
                return [$item->key => $item->translations->first()?->value ?? $item->default_value];
            });

        return view('admin.settings.notification', compact('notificationSettings', 'languages'));
    }

    /**
     * ذخیره تنظیمات کانال‌های اطلاع‌رسانی
     */
    public function updateNotification(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*.key' => 'required|string',
            'settings.*.value' => 'nullable|string',
        ]);

        foreach ($request->settings as $settingData) {
            $setting = Setting::where('key', $settingData['key'])->first();

            // اگر تنظیم وجود نداشت، آن را ایجاد کن
            if (!$setting) {
                $setting = Setting::create([
                    'key' => $settingData['key'],
                    'type' => 'text',
                    'group' => 'notifications',
                    'description' => '',
                    'is_public' => false,
                    'is_active' => true,
                ]);
            }

            // به‌روزرسانی یا ایجاد ترجمه
            $setting->translations()->updateOrCreate(
                ['language_id' => app()->getLocale() === 'fa' ? 1 : (app()->getLocale() === 'en' ? 2 : 3)],
                ['value' => $settingData['value']]
            );
        }

        return redirect()->route('admin.settings.notification')
            ->with('success', 'تنظیمات کانال‌های اطلاع‌رسانی با موفقیت ذخیره شد.');
    }

    /**
     * Show system settings page
     */
    public function system()
    {
        $languages = Language::active()->get();
        $systemSettings = Setting::with('translations.language')
            ->where('group', 'system')
            ->orderBy('key')
            ->get();

        return view('admin.settings.system', compact('systemSettings', 'languages'));
    }

    /**
     * Update system settings
     */
    public function updateSystem(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*.key' => 'required|string',
            'settings.*.value' => 'required|string',
        ]);

        foreach ($request->settings as $settingData) {
            $setting = Setting::where('key', $settingData['key'])->first();
            if ($setting) {
                $setting->translations()->updateOrCreate(
                    ['language_id' => app()->getLocale() === 'fa' ? 1 : (app()->getLocale() === 'en' ? 2 : 3)],
                    ['value' => $settingData['value']]
                );
            }
        }

        return redirect()->route('admin.settings.system')
            ->with('success', 'تنظیمات سیستم با موفقیت به‌روزرسانی شدند.');
    }

    /**
     * Export settings
     */
    public function export()
    {
        $settings = Setting::with('translations.language')->get();

        $data = [];
        foreach ($settings as $setting) {
            $data[] = [
                'key' => $setting->key,
                'type' => $setting->type,
                'group' => $setting->group,
                'description' => $setting->description,
                'is_public' => $setting->is_public,
                'translations' => $setting->translations->map(function($translation) {
                    return [
                        'language_code' => $translation->language->code,
                        'value' => $translation->value,
                        'is_active' => $translation->is_active,
                    ];
                })->toArray(),
            ];
        }

        return response()->json($data, 200, [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="settings.json"'
        ]);
    }

    /**
     * Import settings
     */
    public function import(Request $request)
    {
        $request->validate([
            'settings_file' => 'required|file|mimes:json',
        ]);

        $file = $request->file('settings_file');
        $data = json_decode(file_get_contents($file->getPathname()), true);

        foreach ($data as $settingData) {
            $setting = Setting::updateOrCreate(
                ['key' => $settingData['key']],
                [
                    'type' => $settingData['type'],
                    'group' => $settingData['group'],
                    'description' => $settingData['description'] ?? null,
                    'is_public' => $settingData['is_public'] ?? false,
                ]
            );

            foreach ($settingData['translations'] as $translationData) {
                $language = Language::where('code', $translationData['language_code'])->first();
                if ($language) {
                    $setting->translations()->updateOrCreate(
                        ['language_id' => $language->id],
                        [
                            'value' => $translationData['value'],
                            'is_active' => $translationData['is_active'] ?? true,
                        ]
                    );
                }
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'تنظیمات با موفقیت وارد شدند.');
    }

    /**
     * Reset settings to default
     */
    public function reset()
    {
        // Delete all settings
        Setting::truncate();

        // Re-run the seeder
        Artisan::call('db:seed', ['--class' => 'SettingSeeder']);

        return redirect()->route('admin.settings.index')
            ->with('success', 'تنظیمات به حالت پیش‌فرض بازگردانده شدند.');
    }

    /**
     * Toggle setting status
     */
    public function toggleStatus(Setting $setting)
    {
        $setting->update(['is_active' => !$setting->is_active]);

        return redirect()->route('admin.settings.index')
            ->with('success', 'وضعیت تنظیم تغییر کرد.');
    }
}
