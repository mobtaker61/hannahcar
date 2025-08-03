<x-admin-layout>
    <x-slot name="header">
        تنظیمات اطلاعات تماس
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">تنظیمات اطلاعات تماس</h2>
                            <p class="text-sm text-gray-600 mt-1">آدرس، تلفن، ایمیل و ساعات کاری</p>
                        </div>
                        <a href="{{ route('admin.settings.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-arrow-right ml-2"></i>
                            بازگشت
                        </a>
                    </div>

                    <!-- Contact Settings Form -->
                    <form action="{{ route('admin.settings.contact.update') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Contact Information -->
                        <div class="bg-orange-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-orange-900 mb-4">
                                <i class="fas fa-phone ml-2"></i>
                                اطلاعات تماس
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-phone ml-2"></i>
                                        شماره تلفن
                                    </label>
                                    <input type="text" name="settings[contact_phone][key]" value="contact_phone" hidden>
                                    <input type="tel" name="settings[contact_phone][value]"
                                           value="{{ $contactSettings->where('key', 'contact_phone')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="021-12345678">
                                </div>

                                <div>
                                    <label for="contact_mobile" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-mobile-alt ml-2"></i>
                                        شماره موبایل
                                    </label>
                                    <input type="text" name="settings[contact_mobile][key]" value="contact_mobile" hidden>
                                    <input type="tel" name="settings[contact_mobile][value]"
                                           value="{{ $contactSettings->where('key', 'contact_mobile')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="09123456789">
                                </div>

                                <div>
                                    <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-envelope ml-2"></i>
                                        آدرس ایمیل
                                    </label>
                                    <input type="text" name="settings[contact_email][key]" value="contact_email" hidden>
                                    <input type="email" name="settings[contact_email][value]"
                                           value="{{ $contactSettings->where('key', 'contact_email')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="info@example.com">
                                </div>

                                <div>
                                    <label for="contact_fax" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-fax ml-2"></i>
                                        شماره فکس
                                    </label>
                                    <input type="text" name="settings[contact_fax][key]" value="contact_fax" hidden>
                                    <input type="tel" name="settings[contact_fax][value]"
                                           value="{{ $contactSettings->where('key', 'contact_fax')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="021-12345679">
                                </div>
                            </div>
                        </div>

                        <!-- Address Information -->
                        <div class="bg-blue-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-blue-900 mb-4">
                                <i class="fas fa-map-marker-alt ml-2"></i>
                                اطلاعات آدرس
                            </h3>

                            <div class="space-y-4">
                                <div>
                                    <label for="contact_address" class="block text-sm font-medium text-gray-700 mb-2">آدرس کامل</label>
                                    <input type="text" name="settings[contact_address][key]" value="contact_address" hidden>
                                    <textarea name="settings[contact_address][value]" rows="3"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                              placeholder="آدرس کامل شرکت یا دفتر">{{ $contactSettings->where('key', 'contact_address')->first()?->translations->first()?->value ?? '' }}</textarea>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label for="contact_city" class="block text-sm font-medium text-gray-700 mb-2">شهر</label>
                                        <input type="text" name="settings[contact_city][key]" value="contact_city" hidden>
                                        <input type="text" name="settings[contact_city][value]"
                                               value="{{ $contactSettings->where('key', 'contact_city')->first()?->translations->first()?->value ?? '' }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                               placeholder="تهران">
                                    </div>

                                    <div>
                                        <label for="contact_state" class="block text-sm font-medium text-gray-700 mb-2">استان</label>
                                        <input type="text" name="settings[contact_state][key]" value="contact_state" hidden>
                                        <input type="text" name="settings[contact_state][value]"
                                               value="{{ $contactSettings->where('key', 'contact_state')->first()?->translations->first()?->value ?? '' }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                               placeholder="تهران">
                                    </div>

                                    <div>
                                        <label for="contact_postal_code" class="block text-sm font-medium text-gray-700 mb-2">کد پستی</label>
                                        <input type="text" name="settings[contact_postal_code][key]" value="contact_postal_code" hidden>
                                        <input type="text" name="settings[contact_postal_code][value]"
                                               value="{{ $contactSettings->where('key', 'contact_postal_code')->first()?->translations->first()?->value ?? '' }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                               placeholder="1234567890">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="contact_latitude" class="block text-sm font-medium text-gray-700 mb-2">عرض جغرافیایی</label>
                                        <input type="text" name="settings[contact_latitude][key]" value="contact_latitude" hidden>
                                        <input type="text" name="settings[contact_latitude][value]"
                                               value="{{ $contactSettings->where('key', 'contact_latitude')->first()?->translations->first()?->value ?? '' }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                               placeholder="35.6892">
                                    </div>

                                    <div>
                                        <label for="contact_longitude" class="block text-sm font-medium text-gray-700 mb-2">طول جغرافیایی</label>
                                        <input type="text" name="settings[contact_longitude][key]" value="contact_longitude" hidden>
                                        <input type="text" name="settings[contact_longitude][value]"
                                               value="{{ $contactSettings->where('key', 'contact_longitude')->first()?->translations->first()?->value ?? '' }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                               placeholder="51.3890">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Working Hours -->
                        <div class="bg-green-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-green-900 mb-4">
                                <i class="fas fa-clock ml-2"></i>
                                ساعات کاری
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="working_hours" class="block text-sm font-medium text-gray-700 mb-2">ساعات کاری</label>
                                    <input type="text" name="settings[working_hours][key]" value="working_hours" hidden>
                                    <input type="text" name="settings[working_hours][value]"
                                           value="{{ $contactSettings->where('key', 'working_hours')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="شنبه تا چهارشنبه: 8 صبح تا 6 عصر">
                                </div>

                                <div>
                                    <label for="working_days" class="block text-sm font-medium text-gray-700 mb-2">روزهای کاری</label>
                                    <input type="text" name="settings[working_days][key]" value="working_days" hidden>
                                    <input type="text" name="settings[working_days][value]"
                                           value="{{ $contactSettings->where('key', 'working_days')->first()?->translations->first()?->value ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="شنبه تا چهارشنبه">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex justify-end space-x-3 space-x-reverse">
                            <a href="{{ route('admin.settings.index') }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                انصراف
                            </a>
                            <button type="submit" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-save ml-2"></i>
                                ذخیره تنظیمات تماس
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
