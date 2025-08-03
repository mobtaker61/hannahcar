<x-admin-layout>
    <x-slot name="header">
        افزودن تنظیم جدید
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.settings.store') }}" method="POST">
                        @csrf

                        <!-- Basic Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">اطلاعات پایه</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Key -->
                                <div>
                                    <label for="key" class="block text-sm font-medium text-gray-700 mb-2">
                                        کلید تنظیم <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="key" id="key" value="{{ old('key') }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           placeholder="مثال: site_name" required>
                                    @error('key')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Group -->
                                <div>
                                    <label for="group" class="block text-sm font-medium text-gray-700 mb-2">
                                        گروه <span class="text-red-500">*</span>
                                    </label>
                                    <select name="group" id="group"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                        <option value="">انتخاب کنید</option>
                                        <option value="general" {{ old('group') === 'general' ? 'selected' : '' }}>عمومی</option>
                                        <option value="seo" {{ old('group') === 'seo' ? 'selected' : '' }}>SEO</option>
                                        <option value="social" {{ old('group') === 'social' ? 'selected' : '' }}>شبکه‌های اجتماعی</option>
                                        <option value="contact" {{ old('group') === 'contact' ? 'selected' : '' }}>تماس</option>
                                        <option value="email" {{ old('group') === 'email' ? 'selected' : '' }}>ایمیل</option>
                                        <option value="system" {{ old('group') === 'system' ? 'selected' : '' }}>سیستم</option>
                                        <option value="notification" {{ old('group') === 'notification' ? 'selected' : '' }}>کانال‌های اطلاع‌رسانی</option>
                                    </select>
                                    @error('group')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Type -->
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                        نوع <span class="text-red-500">*</span>
                                    </label>
                                    <select name="type" id="type"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                        <option value="">انتخاب کنید</option>
                                        <option value="text" {{ old('type') === 'text' ? 'selected' : '' }}>متن</option>
                                        <option value="textarea" {{ old('type') === 'textarea' ? 'selected' : '' }}>متن چندخطی</option>
                                        <option value="number" {{ old('type') === 'number' ? 'selected' : '' }}>عدد</option>
                                        <option value="email" {{ old('type') === 'email' ? 'selected' : '' }}>ایمیل</option>
                                        <option value="url" {{ old('type') === 'url' ? 'selected' : '' }}>لینک</option>
                                        <option value="color" {{ old('type') === 'color' ? 'selected' : '' }}>رنگ</option>
                                        <option value="file" {{ old('type') === 'file' ? 'selected' : '' }}>فایل</option>
                                        <option value="boolean" {{ old('type') === 'boolean' ? 'selected' : '' }}>بله/خیر</option>
                                        <option value="select" {{ old('type') === 'select' ? 'selected' : '' }}>انتخابی</option>
                                        <option value="json" {{ old('type') === 'json' ? 'selected' : '' }}>JSON</option>
                                    </select>
                                    @error('type')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Default Value -->
                                <div>
                                    <label for="default_value" class="block text-sm font-medium text-gray-700 mb-2">
                                        مقدار پیش‌فرض
                                    </label>
                                    <input type="text" name="default_value" id="default_value" value="{{ old('default_value') }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           placeholder="مقدار پیش‌فرض">
                                    @error('default_value')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Options (for select type) -->
                                <div>
                                    <label for="options" class="block text-sm font-medium text-gray-700 mb-2">
                                        گزینه‌ها (برای نوع انتخابی)
                                    </label>
                                    <textarea name="options" id="options" rows="3"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                              placeholder="هر گزینه در یک خط:&#10;value1=عنوان 1&#10;value2=عنوان 2">{{ old('options') }}</textarea>
                                    @error('options')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Sort Order -->
                                <div>
                                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                                        ترتیب نمایش
                                    </label>
                                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           placeholder="0">
                                    @error('sort_order')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Is Active -->
                            <div class="mt-6">
                                <div class="flex items-center">
                                    <input type="checkbox" name="is_active" id="is_active" value="1"
                                           {{ old('is_active', true) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="is_active" class="mr-2 block text-sm text-gray-900">
                                        فعال
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Translations -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">ترجمه‌ها</h3>
                            @foreach($languages as $language)
                                <div class="border border-gray-200 rounded-lg p-6 mb-6">
                                    <h4 class="text-md font-medium text-gray-900 mb-4 flex items-center">
                                        <span class="w-6 h-6 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center text-sm font-bold ml-2">
                                            {{ strtoupper($language->code) }}
                                        </span>
                                        {{ $language->native_name }}
                                    </h4>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Label -->
                                        <div>
                                            <label for="translations[{{ $language->id }}][label]" class="block text-sm font-medium text-gray-700 mb-2">
                                                برچسب <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="translations[{{ $language->id }}][label]"
                                                   value="{{ old("translations.{$language->id}.label") }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   placeholder="عنوان تنظیم" required>
                                            @error("translations.{$language->id}.label")
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Value -->
                                        <div>
                                            <label for="translations[{{ $language->id }}][value]" class="block text-sm font-medium text-gray-700 mb-2">
                                                مقدار
                                            </label>
                                            <input type="text" name="translations[{{ $language->id }}][value]"
                                                   value="{{ old("translations.{$language->id}.value") }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   placeholder="مقدار تنظیم">
                                            @error("translations.{$language->id}.value")
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="mt-6">
                                        <label for="translations[{{ $language->id }}][description]" class="block text-sm font-medium text-gray-700 mb-2">
                                            توضیحات
                                        </label>
                                        <textarea name="translations[{{ $language->id }}][description]" rows="3"
                                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                  placeholder="توضیحات تنظیم">{{ old("translations.{$language->id}.description") }}</textarea>
                                        @error("translations.{$language->id}.description")
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Help Text -->
                                    <div class="mt-6">
                                        <label for="translations[{{ $language->id }}][help_text]" class="block text-sm font-medium text-gray-700 mb-2">
                                            متن راهنما
                                        </label>
                                        <input type="text" name="translations[{{ $language->id }}][help_text]"
                                               value="{{ old("translations.{$language->id}.help_text") }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                               placeholder="متن راهنمای تنظیم">
                                        @error("translations.{$language->id}.help_text")
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Is Active -->
                                    <div class="mt-6">
                                        <div class="flex items-center">
                                            <input type="checkbox" name="translations[{{ $language->id }}][is_active]" value="1"
                                                   {{ old("translations.{$language->id}.is_active", true) ? 'checked' : '' }}
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label class="mr-2 block text-sm text-gray-900">
                                                فعال
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Hidden Language ID -->
                                    <input type="hidden" name="translations[{{ $language->id }}][language_id]" value="{{ $language->id }}">
                                </div>
                            @endforeach
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end space-x-3 space-x-reverse">
                            <a href="{{ route('admin.settings.index') }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                انصراف
                            </a>
                            <button type="submit"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-save ml-2"></i>
                                ایجاد تنظیم
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
