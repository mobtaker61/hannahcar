<x-admin-layout>
    <x-slot name="header">
        تنظیمات عمومی
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">تنظیمات عمومی سایت</h2>
                        <a href="{{ route('admin.settings.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            بازگشت
                        </a>
                    </div>

                    <form action="{{ route('admin.settings.general.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Site Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">اطلاعات سایت</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="site_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        نام سایت <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="site_name" id="site_name"
                                           value="{{ old('site_name', \App\Helpers\SettingHelper::get('site_name', 'هانا کار')) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           placeholder="نام سایت" required>
                                    @error('site_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="site_tagline" class="block text-sm font-medium text-gray-700 mb-2">
                                        شعار سایت
                                    </label>
                                    <input type="text" name="site_tagline" id="site_tagline"
                                           value="{{ old('site_tagline', \App\Helpers\SettingHelper::get('site_tagline', 'بهترین خدمات خودرو')) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           placeholder="شعار سایت">
                                    @error('site_tagline')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="site_description" class="block text-sm font-medium text-gray-700 mb-2">
                                        توضیحات سایت
                                    </label>
                                    <textarea name="site_description" id="site_description" rows="3"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                              placeholder="توضیحات کلی سایت">{{ old('site_description', \App\Helpers\SettingHelper::get('site_description')) }}</textarea>
                                    @error('site_description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="site_keywords" class="block text-sm font-medium text-gray-700 mb-2">
                                        کلمات کلیدی
                                    </label>
                                    <input type="text" name="site_keywords" id="site_keywords"
                                           value="{{ old('site_keywords', \App\Helpers\SettingHelper::get('site_keywords')) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           placeholder="کلمات کلیدی با کاما جدا کنید">
                                    @error('site_keywords')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Logo and Branding -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">لوگو و برندینگ</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="site_logo" class="block text-sm font-medium text-gray-700 mb-2">
                                        لوگوی سایت
                                    </label>
                                    <div class="space-y-2">
                                        <input type="file" name="site_logo_file" id="site_logo_file" accept="image/*"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <input type="hidden" name="site_logo" id="site_logo"
                                               value="{{ old('site_logo', \App\Helpers\SettingHelper::get('site_logo')) }}">
                                        @if(\App\Helpers\SettingHelper::get('site_logo'))
                                            <div class="flex items-center space-x-2 space-x-reverse">
                                                <img src="{{ \App\Helpers\SettingHelper::get('site_logo') }}" alt="لوگوی فعلی" class="h-8 w-auto">
                                                <span class="text-sm text-gray-500">لوگوی فعلی</span>
                                            </div>
                                        @endif
                                    </div>
                                    @error('site_logo')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="site_favicon" class="block text-sm font-medium text-gray-700 mb-2">
                                        آیکون سایت
                                    </label>
                                    <div class="space-y-2">
                                        <input type="file" name="site_favicon_file" id="site_favicon_file" accept="image/*"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <input type="hidden" name="site_favicon" id="site_favicon"
                                               value="{{ old('site_favicon', \App\Helpers\SettingHelper::get('site_favicon')) }}">
                                        @if(\App\Helpers\SettingHelper::get('site_favicon'))
                                            <div class="flex items-center space-x-2 space-x-reverse">
                                                <img src="{{ \App\Helpers\SettingHelper::get('site_favicon') }}" alt="آیکون فعلی" class="h-8 w-auto">
                                                <span class="text-sm text-gray-500">آیکون فعلی</span>
                                            </div>
                                        @endif
                                    </div>
                                    @error('site_favicon')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="primary_color" class="block text-sm font-medium text-gray-700 mb-2">
                                        رنگ اصلی
                                    </label>
                                    <input type="color" name="primary_color" id="primary_color"
                                           value="{{ old('primary_color', \App\Helpers\SettingHelper::get('primary_color', '#3B82F6')) }}"
                                           class="w-full h-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('primary_color')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="secondary_color" class="block text-sm font-medium text-gray-700 mb-2">
                                        رنگ ثانویه
                                    </label>
                                    <input type="color" name="secondary_color" id="secondary_color"
                                           value="{{ old('secondary_color', \App\Helpers\SettingHelper::get('secondary_color', '#6B7280')) }}"
                                           class="w-full h-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('secondary_color')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- System Settings -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">تنظیمات سیستم</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="default_language" class="block text-sm font-medium text-gray-700 mb-2">
                                        زبان پیش‌فرض
                                    </label>
                                    <select name="default_language" id="default_language"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="fa" {{ old('default_language', \App\Helpers\SettingHelper::get('default_language', 'fa')) === 'fa' ? 'selected' : '' }}>فارسی</option>
                                        <option value="en" {{ old('default_language', \App\Helpers\SettingHelper::get('default_language', 'fa')) === 'en' ? 'selected' : '' }}>English</option>
                                        <option value="ar" {{ old('default_language', \App\Helpers\SettingHelper::get('default_language', 'fa')) === 'ar' ? 'selected' : '' }}>العربية</option>
                                    </select>
                                    @error('default_language')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="timezone" class="block text-sm font-medium text-gray-700 mb-2">
                                        منطقه زمانی
                                    </label>
                                    <select name="timezone" id="timezone"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="Asia/Tehran" {{ old('timezone', \App\Helpers\SettingHelper::get('timezone', 'Asia/Tehran')) === 'Asia/Tehran' ? 'selected' : '' }}>تهران (UTC+3:30)</option>
                                        <option value="UTC" {{ old('timezone', \App\Helpers\SettingHelper::get('timezone', 'Asia/Tehran')) === 'UTC' ? 'selected' : '' }}>UTC</option>
                                        <option value="Europe/London" {{ old('timezone', \App\Helpers\SettingHelper::get('timezone', 'Asia/Tehran')) === 'Europe/London' ? 'selected' : '' }}>لندن (UTC+0)</option>
                                    </select>
                                    @error('timezone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="date_format" class="block text-sm font-medium text-gray-700 mb-2">
                                        فرمت تاریخ
                                    </label>
                                    <select name="date_format" id="date_format"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="Y-m-d" {{ old('date_format', \App\Helpers\SettingHelper::get('date_format', 'Y-m-d')) === 'Y-m-d' ? 'selected' : '' }}>2024-01-01</option>
                                        <option value="d/m/Y" {{ old('date_format', \App\Helpers\SettingHelper::get('date_format', 'Y-m-d')) === 'd/m/Y' ? 'selected' : '' }}>01/01/2024</option>
                                        <option value="m/d/Y" {{ old('date_format', \App\Helpers\SettingHelper::get('date_format', 'Y-m-d')) === 'm/d/Y' ? 'selected' : '' }}>01/01/2024</option>
                                    </select>
                                    @error('date_format')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="time_format" class="block text-sm font-medium text-gray-700 mb-2">
                                        فرمت زمان
                                    </label>
                                    <select name="time_format" id="time_format"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="H:i" {{ old('time_format', \App\Helpers\SettingHelper::get('time_format', 'H:i')) === 'H:i' ? 'selected' : '' }}>24 ساعته (14:30)</option>
                                        <option value="h:i A" {{ old('time_format', \App\Helpers\SettingHelper::get('time_format', 'H:i')) === 'h:i A' ? 'selected' : '' }}>12 ساعته (2:30 PM)</option>
                                    </select>
                                    @error('time_format')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Maintenance Mode -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">حالت نگهداری</h3>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <input type="checkbox" name="maintenance_mode" id="maintenance_mode" value="1"
                                           {{ old('maintenance_mode', \App\Helpers\SettingHelper::get('maintenance_mode')) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="maintenance_mode" class="mr-2 block text-sm text-gray-900">
                                        فعال کردن حالت نگهداری
                                    </label>
                                </div>

                                <div>
                                    <label for="maintenance_message" class="block text-sm font-medium text-gray-700 mb-2">
                                        پیام حالت نگهداری
                                    </label>
                                    <textarea name="maintenance_message" id="maintenance_message" rows="3"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                              placeholder="پیام نمایش داده شده در حالت نگهداری">{{ old('maintenance_message', \App\Helpers\SettingHelper::get('maintenance_message', 'سایت در حال نگهداری است. لطفاً بعداً مراجعه کنید.')) }}</textarea>
                                    @error('maintenance_message')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end space-x-3 space-x-reverse">
                            <a href="{{ route('admin.settings.index') }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                انصراف
                            </a>
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-save ml-2"></i>
                                ذخیره تنظیمات
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
