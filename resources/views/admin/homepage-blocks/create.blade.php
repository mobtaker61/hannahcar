<x-admin-layout>
    <x-slot name="header">
        افزودن بلوک جدید
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.homepage-blocks.store') }}" method="POST">
                        @csrf

                        <!-- Basic Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">اطلاعات پایه</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Type -->
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                        نوع بلوک <span class="text-red-500">*</span>
                                    </label>
                                    <select name="type" id="type"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                        <option value="">انتخاب کنید</option>
                                        <option value="featured" {{ old('type') === 'featured' ? 'selected' : '' }}>ویژه</option>
                                        <option value="service" {{ old('type') === 'service' ? 'selected' : '' }}>خدمات</option>
                                        <option value="testimonial" {{ old('type') === 'testimonial' ? 'selected' : '' }}>نظرات</option>
                                        <option value="news" {{ old('type') === 'news' ? 'selected' : '' }}>اخبار</option>
                                        <option value="stats" {{ old('type') === 'stats' ? 'selected' : '' }}>آمار</option>
                                    </select>
                                    @error('type')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Image URL -->
                                <div>
                                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                        آدرس تصویر
                                    </label>
                                    <input type="text" name="image" id="image" value="{{ old('image') }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           placeholder="https://example.com/image.jpg">
                                    @error('image')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Button URL -->
                                <div>
                                    <label for="button_url" class="block text-sm font-medium text-gray-700 mb-2">
                                        آدرس دکمه
                                    </label>
                                    <input type="text" name="button_url" id="button_url" value="{{ old('button_url') }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           placeholder="https://example.com">
                                    @error('button_url')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Icon -->
                                <div>
                                    <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                                        آیکون
                                    </label>
                                    <input type="text" name="icon" id="icon" value="{{ old('icon') }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           placeholder="fas fa-car">
                                    @error('icon')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Background Color -->
                                <div>
                                    <label for="background_color" class="block text-sm font-medium text-gray-700 mb-2">
                                        رنگ پس‌زمینه
                                    </label>
                                    <input type="color" name="background_color" id="background_color" value="{{ old('background_color', '#F3F4F6') }}"
                                           class="w-full h-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('background_color')
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
                                        <!-- Title -->
                                        <div>
                                            <label for="translations[{{ $language->id }}][title]" class="block text-sm font-medium text-gray-700 mb-2">
                                                عنوان <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="translations[{{ $language->id }}][title]"
                                                   value="{{ old("translations.{$language->id}.title") }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   placeholder="عنوان بلوک" required>
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
                                                   value="{{ old("translations.{$language->id}.subtitle") }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   placeholder="زیرعنوان بلوک">
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
                                                  placeholder="توضیحات بلوک">{{ old("translations.{$language->id}.description") }}</textarea>
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
                                                   value="{{ old("translations.{$language->id}.button_text") }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   placeholder="مثال: مشاهده بیشتر">
                                            @error("translations.{$language->id}.button_text")
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Meta Data -->
                                        <div>
                                            <label for="translations[{{ $language->id }}][meta_data]" class="block text-sm font-medium text-gray-700 mb-2">
                                                داده‌های متا
                                            </label>
                                            <input type="text" name="translations[{{ $language->id }}][meta_data]"
                                                   value="{{ old("translations.{$language->id}.meta_data") }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   placeholder="داده‌های اضافی (JSON)">
                                            @error("translations.{$language->id}.meta_data")
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
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
                            <a href="{{ route('admin.homepage-blocks.index') }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                انصراف
                            </a>
                            <button type="submit"
                                    class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-save ml-2"></i>
                                ایجاد بلوک
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
