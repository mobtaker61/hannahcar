<x-admin-layout>
    <x-slot name="header">
        تنظیمات ایمیل
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">تنظیمات ایمیل</h2>
                            <p class="text-sm text-gray-600 mt-1">تنظیمات ارسال ایمیل و قالب‌ها</p>
                        </div>
                        <a href="{{ route('admin.settings.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-arrow-right ml-2"></i>
                            بازگشت
                        </a>
                    </div>

                    <!-- Email Settings Form -->
                    <form action="{{ route('admin.settings.email.update') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- SMTP Settings -->
                        <div class="bg-red-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-red-900 mb-4">
                                <i class="fas fa-server ml-2"></i>
                                تنظیمات SMTP
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="smtp_host" class="block text-sm font-medium text-gray-700 mb-2">SMTP Host</label>
                                    <input type="text" name="settings[smtp_host][key]" value="smtp_host" hidden>
                                    <input type="text" name="settings[smtp_host][value]"
                                           value="{{ $emailSettings->where('key', 'smtp_host')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="smtp.gmail.com">
                                </div>

                                <div>
                                    <label for="smtp_port" class="block text-sm font-medium text-gray-700 mb-2">SMTP Port</label>
                                    <input type="text" name="settings[smtp_port][key]" value="smtp_port" hidden>
                                    <input type="number" name="settings[smtp_port][value]"
                                           value="{{ $emailSettings->where('key', 'smtp_port')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="587">
                                </div>

                                <div>
                                    <label for="smtp_username" class="block text-sm font-medium text-gray-700 mb-2">SMTP Username</label>
                                    <input type="text" name="settings[smtp_username][key]" value="smtp_username" hidden>
                                    <input type="email" name="settings[smtp_username][value]"
                                           value="{{ $emailSettings->where('key', 'smtp_username')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="user@gmail.com">
                                </div>

                                <div>
                                    <label for="smtp_password" class="block text-sm font-medium text-gray-700 mb-2">SMTP Password</label>
                                    <input type="text" name="settings[smtp_password][key]" value="smtp_password" hidden>
                                    <input type="password" name="settings[smtp_password][value]"
                                           value="{{ $emailSettings->where('key', 'smtp_password')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="رمز عبور">
                                </div>

                                <div>
                                    <label for="smtp_encryption" class="block text-sm font-medium text-gray-700 mb-2">نوع رمزگذاری</label>
                                    <input type="text" name="settings[smtp_encryption][key]" value="smtp_encryption" hidden>
                                    <select name="settings[smtp_encryption][value]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="tls" {{ ($emailSettings->where('key', 'smtp_encryption')->first()?->translations->first()?->value ?? '') == 'tls' ? 'selected' : '' }}>TLS</option>
                                        <option value="ssl" {{ ($emailSettings->where('key', 'smtp_encryption')->first()?->translations->first()?->value ?? '') == 'ssl' ? 'selected' : '' }}>SSL</option>
                                        <option value="" {{ ($emailSettings->where('key', 'smtp_encryption')->first()?->translations->first()?->value ?? '') == '' ? 'selected' : '' }}>بدون رمزگذاری</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="smtp_from_address" class="block text-sm font-medium text-gray-700 mb-2">آدرس فرستنده</label>
                                    <input type="text" name="settings[smtp_from_address][key]" value="smtp_from_address" hidden>
                                    <input type="email" name="settings[smtp_from_address][value]"
                                           value="{{ $emailSettings->where('key', 'smtp_from_address')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="noreply@example.com">
                                </div>
                            </div>
                        </div>

                        <!-- Email Templates -->
                        <div class="bg-blue-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-blue-900 mb-4">
                                <i class="fas fa-envelope-open ml-2"></i>
                                قالب‌های ایمیل
                            </h3>

                            <div class="space-y-4">
                                <div>
                                    <label for="email_welcome_subject" class="block text-sm font-medium text-gray-700 mb-2">موضوع ایمیل خوش‌آمدگویی</label>
                                    <input type="text" name="settings[email_welcome_subject][key]" value="email_welcome_subject" hidden>
                                    <input type="text" name="settings[email_welcome_subject][value]"
                                           value="{{ $emailSettings->where('key', 'email_welcome_subject')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="خوش آمدید به {{ config('app.name') }}">
                                </div>

                                <div>
                                    <label for="email_welcome_template" class="block text-sm font-medium text-gray-700 mb-2">قالب ایمیل خوش‌آمدگویی</label>
                                    <input type="text" name="settings[email_welcome_template][key]" value="email_welcome_template" hidden>
                                    <textarea name="settings[email_welcome_template][value]" rows="4"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                              placeholder="قالب HTML ایمیل خوش‌آمدگویی">{{ $emailSettings->where('key', 'email_welcome_template')->first()?->translations->first()?->value ?? '' }}</textarea>
                                </div>

                                <div>
                                    <label for="email_reset_subject" class="block text-sm font-medium text-gray-700 mb-2">موضوع ایمیل بازنشانی رمز عبور</label>
                                    <input type="text" name="settings[email_reset_subject][key]" value="email_reset_subject" hidden>
                                    <input type="text" name="settings[email_reset_subject][value]"
                                           value="{{ $emailSettings->where('key', 'email_reset_subject')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="بازنشانی رمز عبور">
                                </div>

                                <div>
                                    <label for="email_reset_template" class="block text-sm font-medium text-gray-700 mb-2">قالب ایمیل بازنشانی رمز عبور</label>
                                    <input type="text" name="settings[email_reset_template][key]" value="email_reset_template" hidden>
                                    <textarea name="settings[email_reset_template][value]" rows="4"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                              placeholder="قالب HTML ایمیل بازنشانی رمز عبور">{{ $emailSettings->where('key', 'email_reset_template')->first()?->translations->first()?->value ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex justify-end space-x-3 space-x-reverse">
                            <a href="{{ route('admin.settings.index') }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                انصراف
                            </a>
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-save ml-2"></i>
                                ذخیره تنظیمات ایمیل
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
