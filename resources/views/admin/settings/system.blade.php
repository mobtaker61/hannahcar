<x-admin-layout>
    <x-slot name="header">
        تنظیمات سیستم
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">تنظیمات سیستم</h2>
                            <p class="text-sm text-gray-600 mt-1">تنظیمات پیشرفته سیستم</p>
                        </div>
                        <a href="{{ route('admin.settings.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-arrow-right ml-2"></i>
                            بازگشت
                        </a>
                    </div>

                    <!-- System Settings Form -->
                    <form action="{{ route('admin.settings.system.update') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Cache Settings -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">
                                <i class="fas fa-database ml-2"></i>
                                تنظیمات کش
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="cache_enabled" class="block text-sm font-medium text-gray-700 mb-2">فعال کردن کش</label>
                                    <input type="text" name="settings[cache_enabled][key]" value="cache_enabled" hidden>
                                    <select name="settings[cache_enabled][value]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="1" {{ ($systemSettings->where('key', 'cache_enabled')->first()?->translations->first()?->value ?? '') == '1' ? 'selected' : '' }}>فعال</option>
                                        <option value="0" {{ ($systemSettings->where('key', 'cache_enabled')->first()?->translations->first()?->value ?? '') == '0' ? 'selected' : '' }}>غیرفعال</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="cache_duration" class="block text-sm font-medium text-gray-700 mb-2">مدت زمان کش (دقیقه)</label>
                                    <input type="text" name="settings[cache_duration][key]" value="cache_duration" hidden>
                                    <input type="number" name="settings[cache_duration][value]"
                                           value="{{ $systemSettings->where('key', 'cache_duration')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="60">
                                </div>
                            </div>
                        </div>

                        <!-- Maintenance Mode -->
                        <div class="bg-yellow-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-yellow-900 mb-4">
                                <i class="fas fa-tools ml-2"></i>
                                حالت تعمیر و نگهداری
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="maintenance_mode" class="block text-sm font-medium text-gray-700 mb-2">حالت تعمیر و نگهداری</label>
                                    <input type="text" name="settings[maintenance_mode][key]" value="maintenance_mode" hidden>
                                    <select name="settings[maintenance_mode][value]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="0" {{ ($systemSettings->where('key', 'maintenance_mode')->first()?->translations->first()?->value ?? '') == '0' ? 'selected' : '' }}>غیرفعال</option>
                                        <option value="1" {{ ($systemSettings->where('key', 'maintenance_mode')->first()?->translations->first()?->value ?? '') == '1' ? 'selected' : '' }}>فعال</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="maintenance_message" class="block text-sm font-medium text-gray-700 mb-2">پیام تعمیر و نگهداری</label>
                                    <input type="text" name="settings[maintenance_message][key]" value="maintenance_message" hidden>
                                    <input type="text" name="settings[maintenance_message][value]"
                                           value="{{ $systemSettings->where('key', 'maintenance_message')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="سایت در حال تعمیر و نگهداری است">
                                </div>
                            </div>
                        </div>

                        <!-- Security Settings -->
                        <div class="bg-red-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-red-900 mb-4">
                                <i class="fas fa-shield-alt ml-2"></i>
                                تنظیمات امنیت
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="max_login_attempts" class="block text-sm font-medium text-gray-700 mb-2">حداکثر تلاش ورود</label>
                                    <input type="text" name="settings[max_login_attempts][key]" value="max_login_attempts" hidden>
                                    <input type="number" name="settings[max_login_attempts][value]"
                                           value="{{ $systemSettings->where('key', 'max_login_attempts')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="5">
                                </div>

                                <div>
                                    <label for="lockout_duration" class="block text-sm font-medium text-gray-700 mb-2">مدت زمان قفل (دقیقه)</label>
                                    <input type="text" name="settings[lockout_duration][key]" value="lockout_duration" hidden>
                                    <input type="number" name="settings[lockout_duration][value]"
                                           value="{{ $systemSettings->where('key', 'lockout_duration')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="15">
                                </div>

                                <div>
                                    <label for="password_min_length" class="block text-sm font-medium text-gray-700 mb-2">حداقل طول رمز عبور</label>
                                    <input type="text" name="settings[password_min_length][key]" value="password_min_length" hidden>
                                    <input type="number" name="settings[password_min_length][value]"
                                           value="{{ $systemSettings->where('key', 'password_min_length')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="8">
                                </div>

                                <div>
                                    <label for="session_timeout" class="block text-sm font-medium text-gray-700 mb-2">مدت زمان نشست (دقیقه)</label>
                                    <input type="text" name="settings[session_timeout][key]" value="session_timeout" hidden>
                                    <input type="number" name="settings[session_timeout][value]"
                                           value="{{ $systemSettings->where('key', 'session_timeout')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="120">
                                </div>
                            </div>
                        </div>

                        <!-- Performance Settings -->
                        <div class="bg-green-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-green-900 mb-4">
                                <i class="fas fa-tachometer-alt ml-2"></i>
                                تنظیمات عملکرد
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="image_compression" class="block text-sm font-medium text-gray-700 mb-2">فشرده‌سازی تصاویر</label>
                                    <input type="text" name="settings[image_compression][key]" value="image_compression" hidden>
                                    <select name="settings[image_compression][value]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="0" {{ ($systemSettings->where('key', 'image_compression')->first()?->translations->first()?->value ?? '') == '0' ? 'selected' : '' }}>غیرفعال</option>
                                        <option value="1" {{ ($systemSettings->where('key', 'image_compression')->first()?->translations->first()?->value ?? '') == '1' ? 'selected' : '' }}>فعال</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="max_upload_size" class="block text-sm font-medium text-gray-700 mb-2">حداکثر اندازه آپلود (MB)</label>
                                    <input type="text" name="settings[max_upload_size][key]" value="max_upload_size" hidden>
                                    <input type="number" name="settings[max_upload_size][value]"
                                           value="{{ $systemSettings->where('key', 'max_upload_size')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="10">
                                </div>

                                <div>
                                    <label for="allowed_file_types" class="block text-sm font-medium text-gray-700 mb-2">انواع فایل مجاز</label>
                                    <input type="text" name="settings[allowed_file_types][key]" value="allowed_file_types" hidden>
                                    <input type="text" name="settings[allowed_file_types][value]"
                                           value="{{ $systemSettings->where('key', 'allowed_file_types')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="jpg,jpeg,png,gif,pdf,doc,docx">
                                </div>

                                <div>
                                    <label for="debug_mode" class="block text-sm font-medium text-gray-700 mb-2">حالت دیباگ</label>
                                    <input type="text" name="settings[debug_mode][key]" value="debug_mode" hidden>
                                    <select name="settings[debug_mode][value]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="0" {{ ($systemSettings->where('key', 'debug_mode')->first()?->translations->first()?->value ?? '') == '0' ? 'selected' : '' }}>غیرفعال</option>
                                        <option value="1" {{ ($systemSettings->where('key', 'debug_mode')->first()?->translations->first()?->value ?? '') == '1' ? 'selected' : '' }}>فعال</option>
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
                            <button type="submit" class="bg-gray-600 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-save ml-2"></i>
                                ذخیره تنظیمات سیستم
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
