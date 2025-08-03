<x-admin-layout>
    <x-slot name="header">
        ویرایش خدمت
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.services.update', $article) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                            <!-- Main Content -->
                            <div class="lg:col-span-3">
                                <!-- Basic Information -->
                                <div class="mb-8">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">اطلاعات اصلی</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                                                Slug <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="slug" id="slug" value="{{ old('slug', $article->slug) }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   required>
                                            @error('slug')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                                دسته‌بندی
                                            </label>
                                            <select name="category_id" id="category_id"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                <option value="">انتخاب کنید</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                            {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                                        <div>
                                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                                وضعیت <span class="text-red-500">*</span>
                                            </label>
                                            <select name="status" id="status"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                    required>
                                                <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>
                                                    پیش‌نویس
                                                </option>
                                                <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>
                                                    منتشر شده
                                                </option>
                                                <option value="archived" {{ old('status', $article->status) == 'archived' ? 'selected' : '' }}>
                                                    آرشیو شده
                                                </option>
                                            </select>
                                            @error('status')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">
                                                تاریخ انتشار
                                            </label>
                                            <input type="datetime-local" name="published_at" id="published_at"
                                                   value="{{ old('published_at', $article->published_at ? $article->published_at->format('Y-m-d\TH:i') : '') }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            @error('published_at')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                                                آیکون (FontAwesome)
                                            </label>
                                            <input type="text" name="icon" id="icon" value="{{ old('icon', $article->icon) }}"
                                                   placeholder="مثال: fas fa-car"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <p class="mt-1 text-xs text-gray-500">کلاس آیکون FontAwesome (اختیاری)</p>
                                            @error('icon')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mt-6">
                                        <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">
                                            تصویر شاخص
                                        </label>
                                        @if($article->featured_image)
                                            <div class="mb-3">
                                                <img src="{{ asset('storage/' . $article->featured_image) }}"
                                                     alt="تصویر فعلی"
                                                     class="w-32 h-32 object-cover rounded-lg border">
                                                <p class="text-xs text-gray-500 mt-1">تصویر فعلی</p>
                                            </div>
                                        @endif
                                        <input type="file" name="featured_image" id="featured_image"
                                               accept="image/*"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <p class="mt-1 text-xs text-gray-500">فرمت‌های مجاز: JPEG, PNG, JPG, GIF, WebP (حداکثر 2MB)</p>
                                        @error('featured_image')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-6">
                                        <div class="space-y-3">
                                            <div class="flex items-center">
                                                <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                                       {{ old('is_featured', $article->is_featured) ? 'checked' : '' }}
                                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                                <label for="is_featured" class="mr-2 block text-sm text-gray-900">
                                                    خدمت ویژه
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input type="checkbox" name="allow_comments" id="allow_comments" value="1"
                                                       {{ old('allow_comments', $article->allow_comments) ? 'checked' : '' }}
                                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                                <label for="allow_comments" class="mr-2 block text-sm text-gray-900">
                                                    اجازه کامنت
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Translations with Tabs -->
                                <div class="mb-8">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">ترجمه‌ها</h3>

                                    <!-- Tab Navigation -->
                                    <div class="border-b border-gray-200 mb-6">
                                        <nav class="-mb-px flex space-x-8 space-x-reverse" aria-label="Tabs">
                                            @foreach ($languages as $index => $language)
                                                @php
                                                    $translation = $article->translations->where('language_id', $language->id)->first();
                                                @endphp
                                                <button type="button"
                                                        onclick="switchTab('{{ $language->code }}')"
                                                        id="tab-{{ $language->code }}"
                                                        class="tab-button whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-200
                                                               {{ $index === 0 ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                                    <span class="w-6 h-6 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center text-sm font-bold ml-2 inline-block">
                                                        {{ strtoupper($language->code) }}
                                                    </span>
                                                    {{ $language->native_name }}
                                                </button>
                                            @endforeach
                                        </nav>
                                    </div>

                                    <!-- Tab Content -->
                                    @foreach ($languages as $index => $language)
                                        @php
                                            $translation = $article->translations->where('language_id', $language->id)->first();
                                        @endphp
                                        <div id="content-{{ $language->code }}"
                                             class="tab-content {{ $index === 0 ? 'block' : 'hidden' }} bg-gray-50 rounded-lg p-6">

                                            <input type="hidden" name="translations[{{ $index }}][language_id]"
                                                   value="{{ $language->id }}">

                                            <div class="space-y-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        عنوان <span class="text-red-500">*</span>
                                                    </label>
                                                    <input type="text" name="translations[{{ $index }}][title]"
                                                           value="{{ old("translations.{$index}.title", $translation?->title) }}"
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                           required>
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        خلاصه
                                                    </label>
                                                    <textarea name="translations[{{ $index }}][excerpt]" rows="3"
                                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old("translations.{$index}.excerpt", $translation?->excerpt) }}</textarea>
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        محتوای اصلی
                                                    </label>
                                                    <textarea name="translations[{{ $index }}][content]" rows="10"
                                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent ckeditor">{{ old("translations.{$index}.content", $translation?->content) }}</textarea>
                                                </div>

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            Meta Title
                                                        </label>
                                                        <input type="text" name="translations[{{ $index }}][meta_title]"
                                                               value="{{ old("translations.{$index}.meta_title", $translation?->meta_title) }}"
                                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            Meta Description
                                                        </label>
                                                        <textarea name="translations[{{ $index }}][meta_description]" rows="3"
                                                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old("translations.{$index}.meta_description", $translation?->meta_description) }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            نام نویسنده
                                                        </label>
                                                        <input type="text" name="translations[{{ $index }}][author_name]"
                                                               value="{{ old("translations.{$index}.author_name", $translation?->author_name) }}"
                                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            تگ‌ها
                                                        </label>
                                                        <input type="text" name="translations[{{ $index }}][tags]"
                                                               value="{{ old("translations.{$index}.tags", $translation ? implode(', ', $translation->tags ?? []) : '') }}"
                                                               placeholder="تگ1, تگ2, تگ3"
                                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Sidebar -->
                            <div class="lg:col-span-1">
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">عملیات</h3>

                                    <div class="space-y-4">
                                        <button type="submit"
                                                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            به‌روزرسانی خدمت
                                        </button>

                                        <a href="{{ route('admin.services.index') }}"
                                           class="w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-center block">
                                            انصراف
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchTab(languageCode) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Remove active state from all tab buttons
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('border-blue-500', 'text-blue-600');
                button.classList.add('border-transparent', 'text-gray-500');
            });

            // Show selected tab content
            document.getElementById('content-' + languageCode).classList.remove('hidden');

            // Add active state to selected tab button
            document.getElementById('tab-' + languageCode).classList.remove('border-transparent', 'text-gray-500');
            document.getElementById('tab-' + languageCode).classList.add('border-blue-500', 'text-blue-600');
        }
    </script>
</x-admin-layout>
