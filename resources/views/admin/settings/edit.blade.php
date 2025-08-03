<x-admin-layout>
    <x-slot name="header">
        ویرایش تنظیم: {{ $setting->translations->first()?->label ?? $setting->key }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.settings.update', $setting) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">اطلاعات پایه</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Key (Read-only) -->
                                <div>
                                    <label for="key" class="block text-sm font-medium text-gray-700 mb-2">
                                        کلید تنظیم
                                    </label>
                                    <input type="text" name="key" id="key" value="{{ old('key', $setting->key) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50" readonly>
                                    <p class="mt-1 text-sm text-gray-500">کلید تنظیم قابل تغییر نیست</p>
                                </div>

                                <!-- Group -->
                                <div>
                                    <label for="group" class="block text-sm font-medium text-gray-700 mb-2">
                                        گروه <span class="text-red-500">*</span>
                                    </label>
                                    <select name="group" id="group"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                        <option value="">انتخاب کنید</option>
                                        <option value="general" {{ old('group', $setting->group) === 'general' ? 'selected' : '' }}>عمومی</option>
                                        <option value="seo" {{ old('group', $setting->group) === 'seo' ? 'selected' : '' }}>SEO</option>
                                        <option value="social" {{ old('group', $setting->group) === 'social' ? 'selected' : '' }}>شبکه‌های اجتماعی</option>
                                        <option value="contact" {{ old('group', $setting->group) === 'contact' ? 'selected' : '' }}>تماس</option>
                                        <option value="email" {{ old('group', $setting->group) === 'email' ? 'selected' : '' }}>ایمیل</option>
                                        <option value="system" {{ old('group', $setting->group) === 'system' ? 'selected' : '' }}>سیستم</option>
                                        <option value="notification" {{ old('group', $setting->group) === 'notification' ? 'selected' : '' }}>کانال‌های اطلاع‌رسانی</option>
                                    </select>
                                    @error('group')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Type (Read-only) -->
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                        نوع
                                    </label>
                                    <input type="text" name="type" id="type" value="{{ old('type', $setting->type) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50" readonly>
                                    <p class="mt-1 text-sm text-gray-500">نوع تنظیم قابل تغییر نیست</p>
                                </div>

                                <!-- Default Value -->
                                <div>
                                    <label for="default_value" class="block text-sm font-medium text-gray-700 mb-2">
                                        مقدار پیش‌فرض
                                    </label>
                                    <input type="text" name="default_value" id="default_value" value="{{ old('default_value', $setting->default_value) }}"
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
                                              placeholder="هر گزینه در یک خط:&#10;value1=عنوان 1&#10;value2=عنوان 2">{{ old('options', $setting->options) }}</textarea>
                                    @error('options')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Sort Order -->
                                <div>
                                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                                        ترتیب نمایش
                                    </label>
                                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $setting->sort_order) }}"
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
                                           {{ old('is_active', $setting->is_active) ? 'checked' : '' }}
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
                                @php
                                    $translation = $setting->translations->where('language_id', $language->id)->first();
                                @endphp
                                <div class="border border-gray-200 rounded-lg p-6 mb-6">
                                    <h4 class="text-md font-medium text-gray-900 mb-4 flex items-center">
                                        <span class="w-6 h-6 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center text-sm font-bold ml-2">
                                            {{ strtoupper($language->code) }}
                                        </span>
                                        {{ $language->native_name }}
                                        @if($translation)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $translation->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} mr-2">
                                                {{ $translation->is_active ? 'فعال' : 'غیرفعال' }}
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 mr-2">
                                                جدید
                                            </span>
                                        @endif
                                    </h4>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Label -->
                                        <div>
                                            <label for="translations[{{ $language->id }}][label]" class="block text-sm font-medium text-gray-700 mb-2">
                                                برچسب <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="translations[{{ $language->id }}][label]"
                                                   value="{{ old("translations.{$language->id}.label", $translation?->label) }}"
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
                                            @switch($setting->type)
                                                @case('textarea')
                                                    <textarea name="translations[{{ $language->id }}][value]" rows="3"
                                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                              placeholder="مقدار تنظیم">{{ old("translations.{$language->id}.value", $translation?->value) }}</textarea>
                                                    @break

                                                @case('number')
                                                    <input type="number" name="translations[{{ $language->id }}][value]"
                                                           value="{{ old("translations.{$language->id}.value", $translation?->value) }}"
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                           placeholder="مقدار تنظیم">
                                                    @break

                                                @case('email')
                                                    <input type="email" name="translations[{{ $language->id }}][value]"
                                                           value="{{ old("translations.{$language->id}.value", $translation?->value) }}"
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                           placeholder="example@domain.com">
                                                    @break

                                                @case('url')
                                                    <input type="url" name="translations[{{ $language->id }}][value]"
                                                           value="{{ old("translations.{$language->id}.value", $translation?->value) }}"
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                           placeholder="https://example.com">
                                                    @break

                                                @case('color')
                                                    <input type="color" name="translations[{{ $language->id }}][value]"
                                                           value="{{ old("translations.{$language->id}.value", $translation?->value) }}"
                                                           class="w-full h-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                    @break

                                                @case('boolean')
                                                    <div class="flex items-center">
                                                        <input type="checkbox" name="translations[{{ $language->id }}][value]" value="1"
                                                               {{ old("translations.{$language->id}.value", $translation?->value) ? 'checked' : '' }}
                                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                                        <label class="mr-2 block text-sm text-gray-900">فعال</label>
                                                    </div>
                                                    @break

                                                @case('select')
                                                    <select name="translations[{{ $language->id }}][value]"
                                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                        <option value="">انتخاب کنید</option>
                                                        @if($setting->options)
                                                            @foreach(explode("\n", $setting->options) as $option)
                                                                @php
                                                                    $parts = explode('=', trim($option));
                                                                    $value = $parts[0] ?? '';
                                                                    $label = $parts[1] ?? $value;
                                                                @endphp
                                                                <option value="{{ $value }}" {{ old("translations.{$language->id}.value", $translation?->value) == $value ? 'selected' : '' }}>
                                                                    {{ $label }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @break

                                                @default
                                                    <input type="text" name="translations[{{ $language->id }}][value]"
                                                           value="{{ old("translations.{$language->id}.value", $translation?->value) }}"
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                           placeholder="مقدار تنظیم">
                                            @endswitch
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
                                                  placeholder="توضیحات تنظیم">{{ old("translations.{$language->id}.description", $translation?->description) }}</textarea>
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
                                               value="{{ old("translations.{$language->id}.help_text", $translation?->help_text) }}"
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
                                                   {{ old("translations.{$language->id}.is_active", $translation?->is_active ?? true) ? 'checked' : '' }}
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
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-save ml-2"></i>
                                به‌روزرسانی تنظیم
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
