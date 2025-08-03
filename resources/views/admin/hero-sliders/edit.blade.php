<x-admin-layout>
    <x-slot name="header">
        ویرایش اسلایدر: {{ $heroSlider->translations->first()?->title ?? 'بدون عنوان' }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.hero-sliders.update', $heroSlider) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">اطلاعات پایه</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Image URL -->
                                <div>
                                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                        آدرس تصویر <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="image" id="image" value="{{ old('image', $heroSlider->image) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           placeholder="https://example.com/image.jpg" required>
                                    @error('image')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Button URL -->
                                <div>
                                    <label for="button_url" class="block text-sm font-medium text-gray-700 mb-2">
                                        آدرس دکمه
                                    </label>
                                    <input type="text" name="button_url" id="button_url" value="{{ old('button_url', $heroSlider->button_url) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           placeholder="https://example.com">
                                    @error('button_url')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Badge Color -->
                                <div>
                                    <label for="badge_color" class="block text-sm font-medium text-gray-700 mb-2">
                                        رنگ نشان <span class="text-red-500">*</span>
                                    </label>
                                    <input type="color" name="badge_color" id="badge_color" value="{{ old('badge_color', $heroSlider->badge_color) }}"
                                           class="w-full h-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('badge_color')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Sort Order -->
                                <div>
                                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                                        ترتیب نمایش
                                    </label>
                                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $heroSlider->sort_order) }}"
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
                                           {{ old('is_active', $heroSlider->is_active) ? 'checked' : '' }}
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
                                    $translation = $heroSlider->translations->where('language_id', $language->id)->first();
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
                                        <!-- Title -->
                                        <div>
                                            <label for="translations[{{ $language->id }}][title]" class="block text-sm font-medium text-gray-700 mb-2">
                                                عنوان <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="translations[{{ $language->id }}][title]"
                                                   value="{{ old("translations.{$language->id}.title", $translation?->title) }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   placeholder="عنوان اسلایدر" required>
                                            @error("translations.{$language->id}.title")
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Subtitle -->
                                        <div>
                                            <label for="translations[{{ $language->id }}][subtitle]" class="block text-sm font-medium text-gray-700 mb-2">
                                                زیرعنوان
                                            </label>
                                            <input type="text" name="translations[{{ $language->id }}][subtitle]"
                                                   value="{{ old("translations.{$language->id}.subtitle", $translation?->subtitle) }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   placeholder="زیرعنوان اسلایدر">
                                            @error("translations.{$language->id}.subtitle")
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
                                                  placeholder="توضیحات اسلایدر">{{ old("translations.{$language->id}.description", $translation?->description) }}</textarea>
                                        @error("translations.{$language->id}.description")
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                        <!-- Button Text -->
                                        <div>
                                            <label for="translations[{{ $language->id }}][button_text]" class="block text-sm font-medium text-gray-700 mb-2">
                                                متن دکمه
                                            </label>
                                            <input type="text" name="translations[{{ $language->id }}][button_text]"
                                                   value="{{ old("translations.{$language->id}.button_text", $translation?->button_text) }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   placeholder="مثال: مشاهده بیشتر">
                                            @error("translations.{$language->id}.button_text")
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Badge Text -->
                                        <div>
                                            <label for="translations[{{ $language->id }}][badge_text]" class="block text-sm font-medium text-gray-700 mb-2">
                                                متن نشان
                                            </label>
                                            <input type="text" name="translations[{{ $language->id }}][badge_text]"
                                                   value="{{ old("translations.{$language->id}.badge_text", $translation?->badge_text) }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   placeholder="مثال: جدید">
                                            @error("translations.{$language->id}.badge_text")
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
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
                            <a href="{{ route('admin.hero-sliders.index') }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                انصراف
                            </a>
                            <button type="submit"
                                    class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-save ml-2"></i>
                                به‌روزرسانی اسلایدر
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
