<x-admin-layout>
    <x-slot name="header">
        تنظیمات شبکه‌های اجتماعی
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">تنظیمات شبکه‌های اجتماعی</h2>
                            <p class="text-sm text-gray-600 mt-1">لینک‌های شبکه‌های اجتماعی</p>
                        </div>
                        <a href="{{ route('admin.settings.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-arrow-right ml-2"></i>
                            بازگشت
                        </a>
                    </div>

                    <!-- Social Media Settings Form -->
                    <form action="{{ route('admin.settings.social.update') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Popular Social Networks -->
                        <div class="bg-purple-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-purple-900 mb-4">
                                <i class="fas fa-share-alt ml-2"></i>
                                شبکه‌های اجتماعی محبوب
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="social_instagram" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fab fa-instagram ml-2 text-pink-600"></i>
                                        اینستاگرام
                                    </label>
                                    <input type="text" name="settings[social_instagram][key]" value="social_instagram" hidden>
                                    <input type="url" name="settings[social_instagram][value]"
                                           value="{{ $socialSettings->where('key', 'social_instagram')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="https://instagram.com/username">
                                </div>

                                <div>
                                    <label for="social_telegram" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fab fa-telegram ml-2 text-blue-600"></i>
                                        تلگرام
                                    </label>
                                    <input type="text" name="settings[social_telegram][key]" value="social_telegram" hidden>
                                    <input type="url" name="settings[social_telegram][value]"
                                           value="{{ $socialSettings->where('key', 'social_telegram')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="https://t.me/username">
                                </div>

                                <div>
                                    <label for="social_whatsapp" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fab fa-whatsapp ml-2 text-green-600"></i>
                                        واتساپ
                                    </label>
                                    <input type="text" name="settings[social_whatsapp][key]" value="social_whatsapp" hidden>
                                    <input type="url" name="settings[social_whatsapp][value]"
                                           value="{{ $socialSettings->where('key', 'social_whatsapp')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="https://wa.me/989123456789">
                                </div>

                                <div>
                                    <label for="social_facebook" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fab fa-facebook ml-2 text-blue-600"></i>
                                        فیسبوک
                                    </label>
                                    <input type="text" name="settings[social_facebook][key]" value="social_facebook" hidden>
                                    <input type="url" name="settings[social_facebook][value]"
                                           value="{{ $socialSettings->where('key', 'social_facebook')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="https://facebook.com/username">
                                </div>

                                <div>
                                    <label for="social_twitter" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fab fa-twitter ml-2 text-blue-400"></i>
                                        توییتر
                                    </label>
                                    <input type="text" name="settings[social_twitter][key]" value="social_twitter" hidden>
                                    <input type="url" name="settings[social_twitter][value]"
                                           value="{{ $socialSettings->where('key', 'social_twitter')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="https://twitter.com/username">
                                </div>

                                <div>
                                    <label for="social_linkedin" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fab fa-linkedin ml-2 text-blue-700"></i>
                                        لینکدین
                                    </label>
                                    <input type="text" name="settings[social_linkedin][key]" value="social_linkedin" hidden>
                                    <input type="url" name="settings[social_linkedin][value]"
                                           value="{{ $socialSettings->where('key', 'social_linkedin')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="https://linkedin.com/in/username">
                                </div>

                                <div>
                                    <label for="social_youtube" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fab fa-youtube ml-2 text-red-600"></i>
                                        یوتیوب
                                    </label>
                                    <input type="text" name="settings[social_youtube][key]" value="social_youtube" hidden>
                                    <input type="url" name="settings[social_youtube][value]"
                                           value="{{ $socialSettings->where('key', 'social_youtube')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="https://youtube.com/channel/username">
                                </div>

                                <div>
                                    <label for="social_aparat" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-video ml-2 text-orange-600"></i>
                                        آپارات
                                    </label>
                                    <input type="text" name="settings[social_aparat][key]" value="social_aparat" hidden>
                                    <input type="url" name="settings[social_aparat][value]"
                                           value="{{ $socialSettings->where('key', 'social_aparat')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="https://aparat.com/username">
                                </div>
                            </div>
                        </div>

                        <!-- Additional Social Networks -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">
                                <i class="fas fa-plus ml-2"></i>
                                شبکه‌های اجتماعی اضافی
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="social_github" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fab fa-github ml-2 text-gray-800"></i>
                                        گیت‌هاب
                                    </label>
                                    <input type="text" name="settings[social_github][key]" value="social_github" hidden>
                                    <input type="url" name="settings[social_github][value]"
                                           value="{{ $socialSettings->where('key', 'social_github')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="https://github.com/username">
                                </div>

                                <div>
                                    <label for="social_stackoverflow" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fab fa-stack-overflow ml-2 text-orange-600"></i>
                                        استک اورفلو
                                    </label>
                                    <input type="text" name="settings[social_stackoverflow][key]" value="social_stackoverflow" hidden>
                                    <input type="url" name="settings[social_stackoverflow][value]"
                                           value="{{ $socialSettings->where('key', 'social_stackoverflow')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="https://stackoverflow.com/users/username">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex justify-end space-x-3 space-x-reverse">
                            <a href="{{ route('admin.settings.index') }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                انصراف
                            </a>
                            <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-save ml-2"></i>
                                ذخیره تنظیمات شبکه‌های اجتماعی
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
