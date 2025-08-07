<x-admin-layout>
    <x-slot name="header">
        تنظیمات کانال‌های اطلاع‌رسانی
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.settings.notification.update') }}" method="POST" class="space-y-8">
                        @csrf

                        <!-- SMS Settings -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">
                                <i class="fas fa-sms ml-2"></i>
                                تنظیمات پیامک (SMS)
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="sms_active" class="block text-sm font-medium text-gray-700 mb-2">فعال بودن ارسال پیامک</label>
                                    <select name="settings[sms_active][value]" id="sms_active" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                        <option value="1" {{ (old('settings.sms_active.value', $notificationSettings['sms_active'] ?? '') == '1') ? 'selected' : '' }}>فعال</option>
                                        <option value="0" {{ (old('settings.sms_active.value', $notificationSettings['sms_active'] ?? '') == '0') ? 'selected' : '' }}>غیرفعال</option>
                                    </select>
                                    <input type="hidden" name="settings[sms_active][key]" value="sms_active">
                                </div>
                                <div>
                                    <label for="sms_provider" class="block text-sm font-medium text-gray-700 mb-2">Provider پیامک (در آینده)</label>
                                    <input type="text" name="settings[sms_provider][value]" id="sms_provider" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ old('settings.sms_provider.value', $notificationSettings['sms_provider'] ?? '') }}" placeholder="مثال: kavenegar">
                                    <input type="hidden" name="settings[sms_provider][key]" value="sms_provider">
                                </div>
                            </div>
                        </div>

                        <!-- WhatsApp Settings -->
                        <div class="bg-green-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-green-900 mb-4">
                                <i class="fab fa-whatsapp ml-2"></i>
                                تنظیمات واتساپ (RoniBot)
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="whatsapp_appkey" class="block text-sm font-medium text-gray-700 mb-2">App Key</label>
                                    <input type="text" name="settings[whatsapp_appkey][value]" id="whatsapp_appkey" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ old('settings.whatsapp_appkey.value', $notificationSettings['whatsapp_appkey'] ?? '') }}">
                                    <input type="hidden" name="settings[whatsapp_appkey][key]" value="whatsapp_appkey">
                                </div>
                                <div>
                                    <label for="whatsapp_authkey" class="block text-sm font-medium text-gray-700 mb-2">Auth Key</label>
                                    <input type="text" name="settings[whatsapp_authkey][value]" id="whatsapp_authkey" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ old('settings.whatsapp_authkey.value', $notificationSettings['whatsapp_authkey'] ?? '') }}">
                                    <input type="hidden" name="settings[whatsapp_authkey][key]" value="whatsapp_authkey">
                                </div>
                            </div>
                        </div>

                        <!-- Telegram Settings -->
                        <div class="bg-blue-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-blue-900 mb-4">
                                <i class="fab fa-telegram ml-2"></i>
                                تنظیمات تلگرام
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="telegram_bot_token" class="block text-sm font-medium text-gray-700 mb-2">توکن ربات تلگرام</label>
                                    <input type="text" name="settings[telegram_bot_token][value]" id="telegram_bot_token" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ old('settings.telegram_bot_token.value', $notificationSettings['telegram_bot_token'] ?? '') }}">
                                    <input type="hidden" name="settings[telegram_bot_token][key]" value="telegram_bot_token">
                                </div>
                            </div>
                        </div>

                        <!-- Email Settings -->
                        <div class="bg-red-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-red-900 mb-4">
                                <i class="fas fa-envelope ml-2"></i>
                                تنظیمات ایمیل
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="email_address" class="block text-sm font-medium text-gray-700 mb-2">آدرس ایمیل</label>
                                    <input type="email" name="settings[email_address][value]" id="email_address" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ old('settings.email_address.value', $notificationSettings['email_address'] ?? '') }}">
                                    <input type="hidden" name="settings[email_address][key]" value="email_address">
                                </div>
                                <div>
                                    <label for="email_password" class="block text-sm font-medium text-gray-700 mb-2">رمز ایمیل</label>
                                    <input type="password" name="settings[email_password][value]" id="email_password" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ old('settings.email_password.value', $notificationSettings['email_password'] ?? '') }}">
                                    <input type="hidden" name="settings[email_password][key]" value="email_password">
                                </div>
                            </div>
                        </div>

                        <!-- Admin Phone Numbers -->
                        <div class="bg-purple-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-purple-900 mb-4">
                                <i class="fas fa-phone ml-2"></i>
                                شماره‌های تلفن ادمین برای اعلان‌ها
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="admin_phone_1" class="block text-sm font-medium text-gray-700 mb-2">شماره تلفن ادمین 1</label>
                                    <input type="text" name="settings[admin_phone_1][value]" id="admin_phone_1" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ old('settings.admin_phone_1.value', $notificationSettings['admin_phone_1'] ?? '') }}" placeholder="+989123456789">
                                    <input type="hidden" name="settings[admin_phone_1][key]" value="admin_phone_1">
                                    <p class="text-xs text-gray-500 mt-1">شماره تلفن اول برای ارسال اعلان‌های واتساپ</p>
                                </div>
                                <div>
                                    <label for="admin_phone_2" class="block text-sm font-medium text-gray-700 mb-2">شماره تلفن ادمین 2</label>
                                    <input type="text" name="settings[admin_phone_2][value]" id="admin_phone_2" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ old('settings.admin_phone_2.value', $notificationSettings['admin_phone_2'] ?? '') }}" placeholder="+989876543210">
                                    <input type="hidden" name="settings[admin_phone_2][key]" value="admin_phone_2">
                                    <p class="text-xs text-gray-500 mt-1">شماره تلفن دوم برای ارسال اعلان‌های واتساپ</p>
                                </div>
                            </div>
                        </div>

                        <!-- Notification Footer -->
                        <div class="bg-gray-100 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">
                                <i class="fas fa-info-circle ml-2"></i>
                                متن فوتر پیام‌های اطلاع‌رسانی
                            </h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="notification_footer" class="block text-sm font-medium text-gray-700 mb-2">متن فوتر پیام</label>
                                    <textarea name="settings[notification_footer][value]" id="notification_footer" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md">{{ old('settings.notification_footer.value', $notificationSettings['notification_footer'] ?? '') }}</textarea>
                                    <input type="hidden" name="settings[notification_footer][key]" value="notification_footer">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-6 rounded">
                                ذخیره تنظیمات
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
