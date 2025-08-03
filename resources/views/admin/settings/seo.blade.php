<x-admin-layout>
    <x-slot name="header">
        تنظیمات SEO
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">تنظیمات SEO</h2>
                            <p class="text-sm text-gray-600 mt-1">تنظیمات بهینه‌سازی موتورهای جستجو</p>
                        </div>
                        <a href="{{ route('admin.settings.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-arrow-right ml-2"></i>
                            بازگشت
                        </a>
                    </div>

                    <!-- SEO Settings Form -->
                    <form action="{{ route('admin.settings.seo.update') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Meta Tags -->
                        <div class="bg-blue-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-blue-900 mb-4">
                                <i class="fas fa-tags ml-2"></i>
                                تگ‌های متا
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">عنوان متا پیش‌فرض</label>
                                    <input type="text" name="settings[meta_title][key]" value="meta_title" hidden>
                                    <input type="text" name="settings[meta_title][value]"
                                           value="{{ $seoSettings->where('key', 'meta_title')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="عنوان پیش‌فرض سایت">
                                </div>

                                <div>
                                    <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">توضیحات متا پیش‌فرض</label>
                                    <input type="text" name="settings[meta_description][key]" value="meta_description" hidden>
                                    <textarea name="settings[meta_description][value]" rows="3"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                              placeholder="توضیحات پیش‌فرض سایت">{{ $seoSettings->where('key', 'meta_description')->first()?->translations->first()?->value ?? '' }}</textarea>
                                </div>

                                <div>
                                    <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-2">کلمات کلیدی پیش‌فرض</label>
                                    <input type="text" name="settings[meta_keywords][key]" value="meta_keywords" hidden>
                                    <input type="text" name="settings[meta_keywords][value]"
                                           value="{{ $seoSettings->where('key', 'meta_keywords')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="کلمات کلیدی (با کاما جدا کنید)">
                                </div>

                                <div>
                                    <label for="meta_author" class="block text-sm font-medium text-gray-700 mb-2">نویسنده پیش‌فرض</label>
                                    <input type="text" name="settings[meta_author][key]" value="meta_author" hidden>
                                    <input type="text" name="settings[meta_author][value]"
                                           value="{{ $seoSettings->where('key', 'meta_author')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="نام نویسنده">
                                </div>
                            </div>
                        </div>

                        <!-- Google Analytics -->
                        <div class="bg-green-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-green-900 mb-4">
                                <i class="fas fa-chart-line ml-2"></i>
                                گوگل آنالیتیکس
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="google_analytics_id" class="block text-sm font-medium text-gray-700 mb-2">شناسه گوگل آنالیتیکس</label>
                                    <input type="text" name="settings[google_analytics_id][key]" value="google_analytics_id" hidden>
                                    <input type="text" name="settings[google_analytics_id][value]"
                                           value="{{ $seoSettings->where('key', 'google_analytics_id')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="G-XXXXXXXXXX">
                                </div>

                                <div>
                                    <label for="google_tag_manager" class="block text-sm font-medium text-gray-700 mb-2">گوگل تگ منیجر</label>
                                    <input type="text" name="settings[google_tag_manager][key]" value="google_tag_manager" hidden>
                                    <input type="text" name="settings[google_tag_manager][value]"
                                           value="{{ $seoSettings->where('key', 'google_tag_manager')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="GTM-XXXXXXX">
                                </div>
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="bg-purple-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-purple-900 mb-4">
                                <i class="fas fa-share-alt ml-2"></i>
                                شبکه‌های اجتماعی
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="og_image" class="block text-sm font-medium text-gray-700 mb-2">تصویر پیش‌فرض Open Graph</label>
                                    <input type="text" name="settings[og_image][key]" value="og_image" hidden>
                                    <input type="text" name="settings[og_image][value]"
                                           value="{{ $seoSettings->where('key', 'og_image')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="URL تصویر">
                                </div>

                                <div>
                                    <label for="twitter_card" class="block text-sm font-medium text-gray-700 mb-2">نوع کارت توییتر</label>
                                    <input type="text" name="settings[twitter_card][key]" value="twitter_card" hidden>
                                    <select name="settings[twitter_card][value]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="summary" {{ ($seoSettings->where('key', 'twitter_card')->first()?->translations->first()?->value ?? '') == 'summary' ? 'selected' : '' }}>خلاصه</option>
                                        <option value="summary_large_image" {{ ($seoSettings->where('key', 'twitter_card')->first()?->translations->first()?->value ?? '') == 'summary_large_image' ? 'selected' : '' }}>خلاصه با تصویر بزرگ</option>
                                        <option value="app" {{ ($seoSettings->where('key', 'twitter_card')->first()?->translations->first()?->value ?? '') == 'app' ? 'selected' : '' }}>اپلیکیشن</option>
                                        <option value="player" {{ ($seoSettings->where('key', 'twitter_card')->first()?->translations->first()?->value ?? '') == 'player' ? 'selected' : '' }}>پخش کننده</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex justify-end space-x-3 space-x-reverse">
                            <a href="{{ route('admin.settings.index') }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                انصراف
                            </a>
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-save ml-2"></i>
                                ذخیره تنظیمات SEO
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
