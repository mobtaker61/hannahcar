<x-admin-layout>
    <x-slot name="header">
        ایجاد مقاله جدید
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
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
                                            <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   required>
                                            @error('slug')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                                نوع <span class="text-red-500">*</span>
                                            </label>
                                            <select name="type" id="type"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                    required>
                                                <option value="article" {{ old('type') == 'article' ? 'selected' : '' }}>
                                                    مقاله
                                                </option>
                                                <option value="news" {{ old('type') == 'news' ? 'selected' : '' }}>
                                                    خبر
                                                </option>
                                            </select>
                                            @error('type')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                        <div>
                                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                                دسته‌بندی
                                            </label>
                                            <select name="category_id" id="category_id"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                <option value="">انتخاب کنید</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                                                آیکون (FontAwesome)
                                            </label>
                                            <input type="text" name="icon" id="icon" value="{{ old('icon') }}"
                                                   placeholder="مثال: fas fa-car"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <p class="mt-1 text-xs text-gray-500">کلاس آیکون FontAwesome (اختیاری)</p>
                                            @error('icon')
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
                                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>
                                                    پیش‌نویس
                                                </option>
                                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>
                                                    منتشر شده
                                                </option>
                                                <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>
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
                                                   value="{{ old('published_at') }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            @error('published_at')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <div class="space-y-3">
                                                <div class="flex items-center">
                                                    <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                                           {{ old('is_featured') ? 'checked' : '' }}
                                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                                    <label for="is_featured" class="mr-2 block text-sm text-gray-900">
                                                        مقاله ویژه
                                                    </label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input type="checkbox" name="allow_comments" id="allow_comments" value="1"
                                                           {{ old('allow_comments', true) ? 'checked' : '' }}
                                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                                    <label for="allow_comments" class="mr-2 block text-sm text-gray-900">
                                                        اجازه کامنت
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-6">
                                        <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">
                                            تصویر شاخص
                                        </label>
                                        <input type="file" name="featured_image" id="featured_image"
                                               accept="image/*"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <p class="mt-1 text-xs text-gray-500">فرمت‌های مجاز: JPEG, PNG, JPG, GIF, WebP (حداکثر 2MB)</p>
                                        @error('featured_image')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Translations with Tabs -->
                                <div class="mb-8">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">ترجمه‌ها</h3>

                                    <!-- Tab Navigation -->
                                    <div class="border-b border-gray-200 mb-6">
                                        <nav class="-mb-px flex space-x-8 space-x-reverse" aria-label="Tabs">
                                            @foreach ($languages as $index => $language)
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
                                                           value="{{ old("translations.{$index}.title") }}"
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                           required>
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        خلاصه
                                                    </label>
                                                    <textarea name="translations[{{ $index }}][excerpt]" rows="3"
                                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old("translations.{$index}.excerpt") }}</textarea>
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        محتوای اصلی
                                                    </label>
                                                    <textarea name="translations[{{ $index }}][content]" rows="10"
                                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent ckeditor">{{ old("translations.{$index}.content") }}</textarea>
                                                </div>

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            Meta Title
                                                        </label>
                                                        <input type="text" name="translations[{{ $index }}][meta_title]"
                                                               value="{{ old("translations.{$index}.meta_title") }}"
                                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            Meta Description
                                                        </label>
                                                        <textarea name="translations[{{ $index }}][meta_description]" rows="3"
                                                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old("translations.{$index}.meta_description") }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            نام نویسنده
                                                        </label>
                                                        <input type="text" name="translations[{{ $index }}][author_name]"
                                                               value="{{ old("translations.{$index}.author_name") }}"
                                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            منبع
                                                        </label>
                                                        <input type="url" name="translations[{{ $index }}][source_url]"
                                                               value="{{ old("translations.{$index}.source_url") }}"
                                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                    </div>
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        تگ‌ها (جدا شده با کاما)
                                                    </label>
                                                    <input type="text" name="translations[{{ $index }}][tags]"
                                                           value="{{ old("translations.{$index}.tags") }}"
                                                           placeholder="خودرو, برقی, 2024"
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Sidebar -->
                            <div class="lg:col-span-1">
                                <!-- Actions -->
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-6">
                                    <div class="px-4 py-3 border-b border-gray-200">
                                        <h5 class="text-lg font-medium text-gray-900">عملیات</h5>
                                    </div>
                                    <div class="p-4">
                                        <div class="space-y-3">
                                            <button type="submit" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                                <i class="fas fa-save ml-2"></i>
                                                ذخیره مقاله
                                            </button>
                                            <a href="{{ route('admin.articles.index') }}"
                                               class="w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-block text-center">
                                                <i class="fas fa-arrow-left ml-2"></i>
                                                بازگشت
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Image Upload -->
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                                    <div class="px-4 py-3 border-b border-gray-200">
                                        <h5 class="text-lg font-medium text-gray-900">آپلود تصویر</h5>
                                    </div>
                                    <div class="p-4">
                                        <div class="space-y-3">
                                            <div>
                                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                                    انتخاب تصویر
                                                </label>
                                                <input type="file" id="image" accept="image/*"
                                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            </div>
                                            <button type="button" onclick="uploadImage()"
                                                    class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                <i class="fas fa-upload ml-2"></i>
                                                آپلود
                                            </button>
                                            <div id="uploadResult" class="mt-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    <script>
        // Tab switching functionality
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

        // Initialize CKEditor
        document.addEventListener('DOMContentLoaded', function() {
            const editors = document.querySelectorAll('.ckeditor');
            editors.forEach(function(element) {
                ClassicEditor
                    .create(element)
                    .catch(error => {
                        console.error(error);
                    });
            });
        });

        // Generate slug from title
        function generateSlug(title) {
            fetch('{{ route('admin.articles.generate-slug') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        title: title
                    })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('slug').value = data.slug;
                });
        }

        // Upload image
        function uploadImage() {
            const fileInput = document.getElementById('image');
            const file = fileInput.files[0];

            if (!file) {
                alert('لطفا یک تصویر انتخاب کنید');
                return;
            }

            const formData = new FormData();
            formData.append('image', file);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            fetch('{{ route('admin.articles.upload-image') }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('uploadResult').innerHTML =
                        `<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            <img src="${data.url}" class="w-full mb-2 rounded" style="max-width: 200px;">
                            <br>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="${data.path}" readonly>
                        </div>`;
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('خطا در آپلود تصویر');
                });
        }
    </script>
</x-admin-layout>
