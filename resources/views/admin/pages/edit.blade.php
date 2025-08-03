<x-admin-layout>
    <x-slot name="header">
        ویرایش صفحه: {{ $page->translations->first()?->title ?? $page->slug }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.pages.update', $page) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">اطلاعات پایه</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Slug -->
                                <div>
                                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                                        Slug <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="slug" id="slug" value="{{ old('slug', $page->slug) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           placeholder="مثال: about-us" required>
                                    @error('slug')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Template -->
                                <div>
                                    <label for="template" class="block text-sm font-medium text-gray-700 mb-2">
                                        قالب <span class="text-red-500">*</span>
                                    </label>
                                    <select name="template" id="template"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                        <option value="">انتخاب کنید</option>
                                        <option value="simple" {{ old('template', $page->template) === 'simple' ? 'selected' : '' }}>ساده</option>
                                        <option value="sidebar" {{ old('template', $page->template) === 'sidebar' ? 'selected' : '' }}>سایدبار</option>
                                    </select>
                                    @error('template')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                        وضعیت <span class="text-red-500">*</span>
                                    </label>
                                    <select name="status" id="status"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                        <option value="">انتخاب کنید</option>
                                        <option value="published" {{ old('status', $page->status) === 'published' ? 'selected' : '' }}>منتشر شده</option>
                                        <option value="draft" {{ old('status', $page->status) === 'draft' ? 'selected' : '' }}>پیش‌نویس</option>
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Sort Order -->
                            <div class="mt-6">
                                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                                    ترتیب نمایش
                                </label>
                                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $page->sort_order) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="0">
                                @error('sort_order')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Translations -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">ترجمه‌ها</h3>
                            @foreach($languages as $language)
                                @php
                                    $translation = $page->translations->where('language_id', $language->id)->first();
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
                                                   placeholder="عنوان صفحه" required>
                                            @error("translations.{$language->id}.title")
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Meta Title -->
                                        <div>
                                            <label for="translations[{{ $language->id }}][meta_title]" class="block text-sm font-medium text-gray-700 mb-2">
                                                عنوان متا
                                            </label>
                                            <input type="text" name="translations[{{ $language->id }}][meta_title]"
                                                   value="{{ old("translations.{$language->id}.meta_title", $translation?->meta_title) }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   placeholder="عنوان متا">
                                            @error("translations.{$language->id}.meta_title")
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Meta Description -->
                                    <div class="mt-6">
                                        <label for="translations[{{ $language->id }}][meta_description]" class="block text-sm font-medium text-gray-700 mb-2">
                                            توضیحات متا
                                        </label>
                                        <textarea name="translations[{{ $language->id }}][meta_description]" rows="2"
                                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                  placeholder="توضیحات متا">{{ old("translations.{$language->id}.meta_description", $translation?->meta_description) }}</textarea>
                                        @error("translations.{$language->id}.meta_description")
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Meta Keywords -->
                                    <div class="mt-6">
                                        <label for="translations[{{ $language->id }}][meta_keywords]" class="block text-sm font-medium text-gray-700 mb-2">
                                            کلمات کلیدی متا
                                        </label>
                                        <input type="text" name="translations[{{ $language->id }}][meta_keywords]"
                                               value="{{ old("translations.{$language->id}.meta_keywords", $translation?->meta_keywords) }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                               placeholder="کلمات کلیدی (با کاما جدا کنید)">
                                        @error("translations.{$language->id}.meta_keywords")
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Content -->
                                    <div class="mt-6">
                                        <label for="translations[{{ $language->id }}][content]" class="block text-sm font-medium text-gray-700 mb-2">
                                            محتوا
                                        </label>
                                        <textarea name="translations[{{ $language->id }}][content]" rows="8"
                                                  class="ckeditor w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                  placeholder="محتوای صفحه">{{ old("translations.{$language->id}.content", $translation?->content) }}</textarea>
                                        @error("translations.{$language->id}.content")
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
                            <a href="{{ route('admin.pages.index') }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                انصراف
                            </a>
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-save ml-2"></i>
                                به‌روزرسانی صفحه
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
