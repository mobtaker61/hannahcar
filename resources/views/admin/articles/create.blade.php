<x-admin-layout>
    <x-slot name="header">
        ایجاد مقاله جدید
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                    <!-- Main Content -->
                    <div class="lg:col-span-3">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">

                                <!-- Translations with Tabs -->
                                <div class="mb-8">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">ترجمه‌ها</h3>

                                    @error('translations')
                                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <!-- Tab Navigation -->
                                    <div class="border-b border-gray-200 mb-6">
                                        <nav class="-mb-px flex space-x-8 space-x-reverse" aria-label="Tabs">
                                            @foreach ($languages as $index => $language)
                                                <button type="button" onclick="switchTab('{{ $language->code }}')"
                                                    id="tab-{{ $language->code }}"
                                                    class="tab-button whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-200
                                                               {{ $index === 0 ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                                    <span
                                                        class="w-6 h-6 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center text-sm font-bold ml-2 inline-block">
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

                                            <input type="hidden"
                                                name="translations[{{ $index }}][language_id]"
                                                value="{{ $language->id }}">

                                            <div class="space-y-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        عنوان
                                                    </label>
                                                    <input type="text"
                                                        name="translations[{{ $index }}][title]"
                                                        value="{{ old("translations.{$index}.title") }}"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                        onkeyup="handleTitleChange(this, '{{ $language->code }}', {{ $index }})"
                                                        placeholder="عنوان {{ $language->native_name }}">
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
                                                    <textarea name="translations[{{ $index }}][content]"
                                                        id="content_editor_{{ $language->code }}_{{ $index }}" rows="10"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent ckeditor">{{ old("translations.{$index}.content") }}</textarea>
                                                </div>

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            Meta Title
                                                        </label>
                                                        <input type="text"
                                                            name="translations[{{ $index }}][meta_title]"
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
                                                        <input type="text"
                                                            name="translations[{{ $index }}][author_name]"
                                                            value="{{ old("translations.{$index}.author_name") }}"
                                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            منبع
                                                        </label>
                                                        <input type="url"
                                                            name="translations[{{ $index }}][source_url]"
                                                            value="{{ old("translations.{$index}.source_url") }}"
                                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                    </div>
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        تگ‌ها (جدا شده با کاما)
                                                    </label>
                                                    <input type="text"
                                                        name="translations[{{ $index }}][tags]"
                                                        value="{{ old("translations.{$index}.tags") }}"
                                                        placeholder="خودرو, برقی, 2024"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Gallery Images -->
                                <div class="mt-8">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">گالری تصاویر</h3>

                                    <div class="bg-gray-50 rounded-lg p-6" id="gallery-container">
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                افزودن تصاویر به گالری
                                            </label>
                                            <input type="file" name="gallery[]" multiple accept="image/*" id="gallery-images"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <p class="mt-2 text-xs text-gray-500">
                                                فرمت‌های مجاز: JPEG, PNG, JPG, GIF, WebP (حداکثر 2MB هر فایل) - تصاویر با مقاله ذخیره می‌شوند
                                            </p>
                                        </div>

                                        <!-- Gallery Preview -->
                                        <div id="gallery-preview" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4 hidden">
                                            <!-- Gallery items will be added here dynamically -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:col-span-1">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <!-- Actions -->
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-6">
                                    <div class="px-4 py-3 border-b border-gray-200">
                                        <h5 class="text-lg font-medium text-gray-900">عملیات</h5>
                                    </div>
                                    <div class="p-4">
                                        <div class="space-y-3">
                                            <button type="submit"
                                                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                                                <i class="fas fa-save mr-2"></i>
                                                ذخیره مقاله
                                            </button>
                                            <a href="{{ route('admin.articles.index') }}"
                                                class="w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-300 block text-center">
                                                <i class="fas fa-arrow-left mr-2"></i>
                                                بازگشت
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Basic Information -->
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-6">
                                    <div class="px-4 py-3 border-b border-gray-200">
                                        <h5 class="text-lg font-medium text-gray-900">اطلاعات اصلی</h5>
                                    </div>
                                    <div class="p-4 space-y-4">
                                        <!-- Slug -->
                                        <div>
                                            <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                                                Slug
                                            </label>
                                            <input type="text" name="slug" id="slug"
                                                value="{{ old('slug') }}"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                                                placeholder="خودکار تولید می‌شود">
                                            <p class="mt-1 text-xs text-gray-500">از عنوان اولین زبان تولید می‌شود</p>
                                            @error('slug')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Type -->
                                        <div>
                                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                                نوع <span class="text-red-500">*</span>
                                            </label>
                                            <select name="type" id="type"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
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

                                        <!-- Category -->
                                        <div>
                                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                                دسته‌بندی
                                            </label>
                                            <select name="category_id" id="category_id"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                                <option value="">انتخاب کنید</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Icon -->
                                        <div>
                                            <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                                                آیکون (FontAwesome)
                                            </label>
                                            <input type="text" name="icon" id="icon"
                                                value="{{ old('icon') }}" placeholder="مثال: fas fa-car"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                            <p class="mt-1 text-xs text-gray-500">کلاس آیکون FontAwesome (اختیاری)</p>
                                            @error('icon')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Status -->
                                        <div>
                                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                                وضعیت <span class="text-red-500">*</span>
                                            </label>
                                            <select name="status" id="status"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
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

                                        <!-- Published Date -->
                                        <div>
                                            <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">
                                                تاریخ انتشار
                                            </label>
                                            <input type="datetime-local" name="published_at" id="published_at"
                                                value="{{ old('published_at') }}"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                            @error('published_at')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Checkboxes -->
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

                                <!-- Featured Image -->
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-6">
                                    <div class="px-4 py-3 border-b border-gray-200">
                                        <h5 class="text-lg font-medium text-gray-900">تصویر شاخص</h5>
                                    </div>
                                    <div class="p-4">
                                        <input type="file" name="featured_image" id="featured_image" accept="image/*"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                        <p class="mt-2 text-xs text-gray-500">فرمت‌های مجاز: JPEG, PNG, JPG, GIF, WebP (حداکثر 2MB)</p>
                                        @error('featured_image')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Hide duplicate CKEditor instances */
        .ck-editor__editable:not(.ck-focused)+.ck-editor {
            display: none !important;
        }

        /* Ensure only one editor per textarea */
        textarea.ckeditor[data-initialized="true"] {
            display: none !important;
        }

        /* Hide any extra CKEditor instances */
        .ck-editor+.ck-editor {
            display: none !important;
        }
    </style>

    <!-- Load CKEditor only once -->
    <script>
        // Prevent multiple CKEditor loads
        if (!window.CKEditorLoaded) {
            window.CKEditorLoaded = true;
            const script = document.createElement('script');
            script.src = 'https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js';
            script.onload = function() {
                console.log('CKEditor script loaded successfully');
                window.CKEditorReady = true;
                // Initialize editors after script loads
                if (typeof initializeEditors === 'function') {
                    initializeEditors();
                }
            };
            document.head.appendChild(script);
        }
    </script>
    <script>
        // Global variables
        let editorInstances = {};
        let editorsInitialized = false;

        // Wait for both DOM and CKEditor to be ready
        document.addEventListener('DOMContentLoaded', function() {
            if (window.CKEditorReady) {
                initializeEditors();
            } else {
                // Wait for CKEditor to load
                const checkCKEditor = setInterval(function() {
                    if (window.CKEditorReady && typeof ClassicEditor !== 'undefined') {
                        clearInterval(checkCKEditor);
                        initializeEditors();
                    }
                }, 100);
            }
        });

        // Function to initialize editors (called from script loader)
        function initializeEditors() {
            if (editorsInitialized) return;
            editorsInitialized = true;

            console.log('🚀 Initializing CKEditor...');
            cleanupExistingEditors();
            initializeFirstTabEditor();
        }

        // Cleanup any existing CKEditor instances
        function cleanupExistingEditors() {
            document.querySelectorAll('.ck-editor').forEach(editor => {
                if (editor.parentNode) {
                    editor.parentNode.removeChild(editor);
                }
            });

            // Reset all textareas
            document.querySelectorAll('.ckeditor').forEach(textarea => {
                textarea.removeAttribute('data-initialized');
                textarea.style.display = 'block';
            });

            // Clear instances
            editorInstances = {};
            console.log('🧹 Cleaned up existing editors');
        }

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

            // Initialize editor for this tab if not already done
            initializeTabEditor(languageCode);
        }

        function initializeFirstTabEditor() {
            // Get the first visible tab content
            const firstTabContent = document.querySelector('.tab-content:not(.hidden)');
            if (firstTabContent) {
                const editor = firstTabContent.querySelector('.ckeditor');
                if (editor && !editor.hasAttribute('data-initialized')) {
                    console.log('🎯 Initializing first tab editor:', editor.id || 'unnamed');
                    initializeEditor(editor);
                }
            }
        }

        function initializeTabEditor(languageCode) {
            const tabContent = document.getElementById('content-' + languageCode);
            if (tabContent) {
                const editor = tabContent.querySelector('.ckeditor:not([data-initialized])');
                if (editor) {
                    console.log('🎯 Initializing tab editor for:', languageCode, editor.id || 'unnamed');
                    // Small delay to ensure tab is fully visible
                    setTimeout(() => {
                        initializeEditor(editor);
                    }, 200);
                }
            }
        }

        function initializeEditor(element) {
            if (!element) {
                console.warn('⚠️ No element provided to initializeEditor');
                return;
            }

            // Multiple checks for already initialized editors
            if (element.hasAttribute('data-initialized')) {
                console.log(`ℹ️ Element already marked as initialized: ${element.id || 'unnamed'}`);
                return;
            }

            if (element.classList.contains('ck-editor__editable')) {
                console.log(`ℹ️ Element already has CKEditor classes: ${element.id || 'unnamed'}`);
                return;
            }

            if (element.nextSibling && element.nextSibling.classList && element.nextSibling.classList.contains(
                'ck-editor')) {
                console.log(`ℹ️ CKEditor already exists next to element: ${element.id || 'unnamed'}`);
                return;
            }

            // Check if CKEditor is available
            if (typeof ClassicEditor === 'undefined') {
                console.error('❌ ClassicEditor is not available');
                return;
            }

            // Ensure element has a unique ID
            if (!element.id) {
                element.id = `editor_${Date.now()}_${Math.random().toString(36).substr(2, 9)}`;
            }

            // Check if already has an instance
            if (editorInstances[element.id]) {
                console.log(`ℹ️ Instance already exists for: ${element.id}`);
                return;
            }

            // Mark as initialized BEFORE creating to prevent race conditions
            element.setAttribute('data-initialized', 'true');

            console.log(`🔧 Creating CKEditor for: ${element.id}`);

            ClassicEditor
                .create(element, {
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'link', '|',
                            'bulletedList', 'numberedList', '|',
                            'outdent', 'indent', '|',
                            'blockQuote', '|',
                            'undo', 'redo'
                        ]
                    }
                })
                .then(editor => {
                    editorInstances[element.id] = editor;
                    console.log(`✅ CKEditor successfully initialized: ${element.id}`);

                    // Additional check - hide the original textarea
                    if (element.style) {
                        element.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error(`❌ CKEditor initialization failed for ${element.id}:`, error);
                    // Remove the initialization flag on error
                    element.removeAttribute('data-initialized');
                });
        }

        // Handle title change and auto-generate slug
        function handleTitleChange(input, languageCode, index) {
            const title = input.value.trim();

            // Only generate slug for the first language or when slug is empty
            if (index === 0 || !document.getElementById('slug').value) {
                if (title) {
                    generateSlug(title);
                }
            }
        }

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
                        '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">' +
                            '<img src="' + data.url + '" class="w-full mb-2 rounded" style="max-width: 200px;">' +
                            '<br>' +
                            '<input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="' + data.path + '" readonly>' +
                        '</div>';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('خطا در آپلود تصویر');
                });
        }

        // Gallery Preview functionality
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🚀 Gallery: Setting up preview...');
            const galleryInput = document.getElementById('gallery-images');
            const galleryPreview = document.getElementById('gallery-preview');

            if (galleryInput && galleryPreview) {
                console.log('✅ Gallery: Elements found');
                galleryInput.addEventListener('change', function(e) {
                    console.log('📁 Gallery: Files selected:', e.target.files.length);
                    previewGalleryFiles(e.target.files, galleryPreview);
                });
            }
        });

        function previewGalleryFiles(files, container) {
            container.innerHTML = '';

            if (files.length === 0) {
                container.classList.add('hidden');
                return;
            }

            container.classList.remove('hidden');
            container.style.display = 'grid';

            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                if (!file.type.startsWith('image/')) continue;
                if (file.size > 2097152) {
                    alert('فایل "' + file.name + '" بیش از حد بزرگ است.');
                    continue;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-full h-48 object-cover';

                    const info = document.createElement('div');
                    info.className = 'p-3 text-xs text-gray-600';
                    info.innerHTML =
                        '<input type="text" name="gallery_alt_text[' + i + ']" placeholder="Alt text" class="w-full mb-2 px-2 py-1 border border-gray-300 rounded">' +
                        '<input type="text" name="gallery_caption[' + i + ']" placeholder="Caption" class="w-full mb-2 px-2 py-1 border border-gray-300 rounded">' +
                        '<input type="number" name="gallery_sort_order[' + i + ']" value="' + (i + 1) + '" min="1" class="w-full mb-2 px-2 py-1 border border-gray-300 rounded">' +
                        '<div class="text-green-600">✓ آماده آپلود</div>';

                    div.appendChild(img);
                    div.appendChild(info);
                    container.appendChild(div);
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-admin-layout>
