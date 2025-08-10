<x-admin-layout>
    <x-slot name="header">
        ویرایش مقاله: {{ $article->title }}
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.articles.update', $article) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
                    <!-- Main Content -->
                    <div class="lg:col-span-3">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <!-- Article Info Dashboard -->
                                <div class="mb-8">
                                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                                <i class="fas fa-chart-line text-blue-600 mr-2"></i>
                                                آمار و اطلاعات مقاله
                                            </h3>
                                            <div class="flex items-center space-x-2 space-x-reverse">
                                                @switch($article->status)
                                                    @case('published')
                                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 border border-green-200">
                                                            <i class="fas fa-check-circle mr-1"></i>
                                                            منتشر شده
                                                        </span>
                                                        @break
                                                    @case('draft')
                                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                            <i class="fas fa-edit mr-1"></i>
                                                            پیش‌نویس
                                                        </span>
                                                        @break
                                                    @case('archived')
                                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800 border border-gray-200">
                                                            <i class="fas fa-archive mr-1"></i>
                                                            آرشیو شده
                                                        </span>
                                                        @break
                                                @endswitch
                                                @if($article->is_featured)
                                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800 border border-purple-200">
                                                        <i class="fas fa-star mr-1"></i>
                                                        ویژه
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Stats Grid -->
                                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                                            <!-- Views -->
                                            <div class="text-center p-3 bg-white rounded-lg border border-gray-100 shadow-sm">
                                                <div class="text-xs font-medium text-gray-500 mb-1">
                                                    <i class="fas fa-eye text-blue-500"></i>
                                                    بازدید</div>
                                                <div class="text-lg font-bold text-blue-600">{{ number_format($article->views_count) }}</div>
                                            </div>

                                            <!-- Comments -->
                                            <div class="text-center p-3 bg-white rounded-lg border border-gray-100 shadow-sm">
                                                <div class="text-xs font-medium text-gray-500 mb-1">
                                                    <i class="fas fa-comments text-green-500"></i>
                                                    کامنت</div>
                                                <div class="text-lg font-bold text-green-600">{{ number_format($article->comments_count) }}</div>
                                            </div>

                                            <!-- Likes -->
                                            <div class="text-center p-3 bg-white rounded-lg border border-gray-100 shadow-sm">
                                                <div class="text-xs font-medium text-gray-500 mb-1">
                                                    <i class="fas fa-heart text-red-500"></i>
                                                    لایک</div>
                                                <div class="text-lg font-bold text-red-600">{{ number_format($article->likes_count) }}</div>
                                            </div>

                                            <!-- Shares -->
                                            <div class="text-center p-3 bg-white rounded-lg border border-gray-100 shadow-sm">
                                                <div class="text-xs font-medium text-gray-500 mb-1">
                                                    <i class="fas fa-share text-purple-500"></i>
                                                    اشتراک</div>
                                                <div class="text-lg font-bold text-purple-600">{{ number_format($article->shares_count) }}</div>
                                            </div>
                                        </div>

                                        <!-- Additional Info -->
                                        <div class="mt-4 pt-4 border-t border-blue-200">
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                                <div class="flex items-center">
                                                    <i class="fas fa-user text-gray-400 mr-2"></i>
                                                    <span class="text-gray-600">نویسنده:</span>
                                                    <span class="font-medium text-gray-900 mr-1">{{ $article->user->name ?? 'نامشخص' }}</span>
                                                </div>
                                                @if($article->created_at)
                                                    <div class="flex items-center">
                                                        <i class="fas fa-calendar text-gray-400 mr-2"></i>
                                                        <span class="text-gray-600">تاریخ ایجاد</span>
                                                        <span class="font-medium text-gray-900 mr-1">{{ $article->created_at->format('Y/m/d') }}</span>
                                                    </div>
                                                @endif
                                                @if($article->updated_at)
                                                    <div class="flex items-center">
                                                        <i class="fas fa-calendar text-gray-400 mr-2"></i>
                                                        <span class="text-gray-600">آخرین بروزرسانی</span>
                                                        <span class="font-medium text-gray-900 mr-1">{{ $article->updated_at->format('Y/m/d') }}</span>
                                                    </div>
                                                @endif
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
                                                    @if($translation && $translation->title)
                                                        <span class="ml-2 text-xs text-green-600">✓</span>
                                                    @endif
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
                                                        عنوان @if($index === 0)<span class="text-red-500">*</span>@endif
                                                    </label>
                                                    <input type="text" name="translations[{{ $index }}][title]"
                                                           value="{{ old("translations.{$index}.title", $translation->title ?? '') }}"
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                           @if($index === 0) required @endif>
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        خلاصه
                                                    </label>
                                                    <textarea name="translations[{{ $index }}][excerpt]" rows="3"
                                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old("translations.{$index}.excerpt", $translation->excerpt ?? '') }}</textarea>
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        محتوای اصلی
                                                    </label>
                                                    <textarea name="translations[{{ $index }}][content]" rows="10"
                                                              id="content_editor_{{ $language->code }}_{{ $index }}"
                                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent ckeditor">{{ old("translations.{$index}.content", $translation->content ?? '') }}</textarea>
                                                </div>

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            Meta Title
                                                        </label>
                                                        <input type="text" name="translations[{{ $index }}][meta_title]"
                                                               value="{{ old("translations.{$index}.meta_title", $translation->meta_title ?? '') }}"
                                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            Meta Description
                                                        </label>
                                                        <textarea name="translations[{{ $index }}][meta_description]" rows="3"
                                                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old("translations.{$index}.meta_description", $translation->meta_description ?? '') }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            نام نویسنده
                                                        </label>
                                                        <input type="text" name="translations[{{ $index }}][author_name]"
                                                               value="{{ old("translations.{$index}.author_name", $translation->author_name ?? '') }}"
                                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            منبع
                                                        </label>
                                                        <input type="url" name="translations[{{ $index }}][source_url]"
                                                               value="{{ old("translations.{$index}.source_url", $translation->source_url ?? '') }}"
                                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                    </div>
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        تگ‌ها (جدا شده با کاما)
                                                    </label>
                                                    <input type="text" name="translations[{{ $index }}][tags]"
                                                           value="{{ old("translations.{$index}.tags", is_array($translation->tags ?? null) ? implode(', ', $translation->tags) : ($translation->tags ?? '')) }}"
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
                                        <!-- Existing Gallery Images -->
                                        @if($article->gallery->count() > 0)
                                            <div class="mb-6">
                                                <h4 class="text-md font-medium text-gray-800 mb-3">تصاویر موجود</h4>
                                                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="existing-gallery">
                                                    @foreach($article->gallery as $galleryImage)
                                                        <div class="relative bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden" data-gallery-id="{{ $galleryImage->id }}">
                                                            <div class="aspect-square">
                                                                <img src="{{ asset('storage/' . $galleryImage->image_path) }}"
                                                                     alt="{{ $galleryImage->alt_text }}"
                                                                     class="w-full h-full object-cover">
                                                            </div>
                                                            <div class="p-3">
                                                                <div class="mb-2">
                                                                    <label class="block text-xs font-medium text-gray-700 mb-1">Alt Text</label>
                                                                    <input type="text" name="existing_gallery[{{ $galleryImage->id }}][alt_text]"
                                                                        value="{{ $galleryImage->alt_text }}"
                                                                        placeholder="توضیح تصویر"
                                                                        class="w-full px-2 py-1 text-xs border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label class="block text-xs font-medium text-gray-700 mb-1">Caption</label>
                                                                    <input type="text" name="existing_gallery[{{ $galleryImage->id }}][caption]"
                                                                        value="{{ $galleryImage->caption }}"
                                                                        placeholder="عنوان تصویر"
                                                                        class="w-full px-2 py-1 text-xs border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label class="block text-xs font-medium text-gray-700 mb-1">ترتیب</label>
                                                                    <input type="number" name="existing_gallery[{{ $galleryImage->id }}][sort_order]"
                                                                        value="{{ $galleryImage->sort_order }}" min="1"
                                                                        class="w-full px-2 py-1 text-xs border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                                                </div>
                                                                <button type="button" onclick="removeExistingGalleryItem(this, {{ $galleryImage->id }})"
                                                                    class="w-full px-2 py-1 text-xs bg-red-500 text-white rounded hover:bg-red-600 transition-colors">
                                                                    حذف
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Add New Images -->
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                افزودن تصاویر جدید به گالری
                                            </label>
                                            <input type="file" name="gallery[]" multiple accept="image/*" id="gallery-images"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <p class="mt-2 text-xs text-gray-500">
                                                فرمت‌های مجاز: JPEG, PNG, JPG, GIF, WebP (حداکثر 2MB هر فایل) - چند فایل انتخاب کنید
                                            </p>
                                        </div>

                                        <!-- New Gallery Preview -->
                                        <div id="gallery-preview" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4 hidden">
                                            <!-- New gallery items will be added here dynamically -->
                                        </div>

                                        <!-- Hidden inputs for deleted items -->
                                        <div id="deleted-gallery-items"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:col-span-1">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-1">
                                <!-- Actions -->
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-6">
                                    <div class="px-4 py-3 border-b border-gray-200">
                                        <h5 class="text-lg font-medium text-gray-900">عملیات</h5>
                                    </div>
                                    <div class="p-4">
                                        <div class="space-y-3">
                                            <button type="submit" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                                                <i class="fas fa-save mr-2"></i>
                                                ذخیره تغییرات
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
                                                Slug <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="slug" id="slug" value="{{ old('slug', $article->slug) }}"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                                                required>
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
                                                <option value="article" {{ old('type', $article->type) == 'article' ? 'selected' : '' }}>
                                                    مقاله
                                                </option>
                                                <option value="news" {{ old('type', $article->type) == 'news' ? 'selected' : '' }}>
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
                                                    <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
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
                                            <input type="text" name="icon" id="icon" value="{{ old('icon', $article->icon) }}"
                                                placeholder="مثال: fas fa-car"
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

                                        <!-- Published Date -->
                                        <div>
                                            <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">
                                                تاریخ انتشار
                                            </label>
                                            <input type="datetime-local" name="published_at" id="published_at"
                                                value="{{ old('published_at', $article->published_at ? $article->published_at->format('Y-m-d\TH:i') : '') }}"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                            @error('published_at')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Checkboxes -->
                                        <div class="space-y-3">
                                            <div class="flex items-center">
                                                <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                                    {{ old('is_featured', $article->is_featured) ? 'checked' : '' }}
                                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                                <label for="is_featured" class="mr-2 block text-sm text-gray-900">
                                                    مقاله ویژه
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

                                <!-- Featured Image -->
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-6">
                                    <div class="px-4 py-3 border-b border-gray-200">
                                        <h5 class="text-lg font-medium text-gray-900">تصویر شاخص</h5>
                                    </div>
                                    <div class="p-4">
                                        @if($article->featured_image)
                                            <div class="mb-4">
                                                <img src="{{ asset('storage/' . $article->featured_image) }}"
                                                     alt="تصویر فعلی"
                                                     class="w-full h-32 object-cover rounded-lg border">
                                                <p class="text-xs text-gray-500 mt-2">تصویر فعلی</p>
                                            </div>
                                        @endif
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
        // Check if CKEditor is already loaded
        if (typeof ClassicEditor !== 'undefined') {
            console.log('CKEditor already loaded, skipping script load');
            window.CKEditorReady = true;
            window.CKEditorLoaded = true;
        } else if (!window.CKEditorLoaded) {
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
            script.onerror = function() {
                console.error('Failed to load CKEditor script');
                window.CKEditorLoaded = false;
            };
            document.head.appendChild(script);
        } else {
            console.log('CKEditor load already in progress');
        }
    </script>
    <script>
        // Global variables
        let editorInstances = {};
        let editorsInitialized = false;

        // Wait for both DOM and CKEditor to be ready
        document.addEventListener('DOMContentLoaded', function() {
            // Check if editors are already initialized
            if (editorsInitialized) {
                console.log('Editors already initialized, skipping');
                return;
            }

            if (window.CKEditorReady && typeof ClassicEditor !== 'undefined') {
                initializeEditors();
            } else {
                // Wait for CKEditor to load
                const checkCKEditor = setInterval(function() {
                    if (window.CKEditorReady && typeof ClassicEditor !== 'undefined') {
                        clearInterval(checkCKEditor);
                        initializeEditors();
                    }
                }, 100);

                // Fallback timeout
                setTimeout(function() {
                    if (!editorsInitialized && typeof ClassicEditor !== 'undefined') {
                        console.log('Fallback: Initializing editors after timeout');
                        initializeEditors();
                    }
                }, 3000);
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

        // PAGE LOAD TEST
        console.log('🌟 EDIT PAGE: JavaScript loaded successfully!');
        console.log('🌟 EDIT PAGE: Current time:', new Date().toLocaleTimeString());

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

            // Check if element is hidden (in non-active tab)
            if (element.offsetParent === null && element.style.display !== 'none') {
                console.log(`ℹ️ Element is hidden, skipping: ${element.id || 'unnamed'}`);
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

            // Clear any potential duplicate modules
            try {
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

                        // If it's a duplicated modules error, try to reload the page
                        if (error.message && error.message.includes('ckeditor-duplicated-modules')) {
                            console.warn('🔄 Duplicated modules detected, will refresh page if needed');
                        }
                    });
            } catch (error) {
                console.error(`❌ Exception during CKEditor creation for ${element.id}:`, error);
                element.removeAttribute('data-initialized');
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

        // Gallery Management for Edit Page
        let galleryFiles = [];
        let deletedGalleryItems = [];

        document.addEventListener('DOMContentLoaded', function() {
            const galleryInput = document.getElementById('gallery-images');
            const galleryPreview = document.getElementById('gallery-preview');

            if (galleryInput) {
                galleryInput.addEventListener('change', function(e) {
                    handleGalleryFiles(e.target.files);
                });
            }

                                                // Form submission handler
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    // Remove old gallery inputs
                    form.querySelectorAll('input[name^="gallery["]').forEach(input => input.remove());
                    form.querySelectorAll('input[name="deleted_gallery[]"]').forEach(input => input.remove());

                    // Add current gallery files as hidden inputs
                    galleryFiles.forEach((file, index) => {
                        const fileInput = document.createElement('input');
                        fileInput.type = 'file';
                        fileInput.name = `gallery[${index}]`;
                        fileInput.style.display = 'none';

                        // Create DataTransfer to assign file
                        const dt = new DataTransfer();
                        dt.items.add(file);
                        fileInput.files = dt.files;

                        form.appendChild(fileInput);

                        console.log('Added gallery file:', index, file.name);
                    });

                    // Add deleted items as hidden inputs
                    deletedGalleryItems.forEach(id => {
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'deleted_gallery[]';
                        hiddenInput.value = id;
                        form.appendChild(hiddenInput);

                        console.log('Added deleted gallery item:', id);
                    });

                    console.log('Form submitted with', galleryFiles.length, 'new gallery files and', deletedGalleryItems.length, 'deleted items');
                });
            }
        });

        function handleGalleryFiles(files) {
            const galleryPreview = document.getElementById('gallery-preview');

            Array.from(files).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const currentIndex = galleryFiles.length;
                    galleryFiles.push(file);

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const galleryItem = createNewGalleryItem(e.target.result, currentIndex, file.name);
                        galleryPreview.appendChild(galleryItem);
                        galleryPreview.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });
        }



        function removeExistingGalleryItem(button, galleryId) {
            const item = button.closest('[data-gallery-id]');
            item.style.display = 'none';

            // Add to deleted items
            deletedGalleryItems.push(galleryId);

            // Add hidden input to mark for deletion
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'deleted_gallery[]';
            hiddenInput.value = galleryId;
            document.getElementById('deleted-gallery-items').appendChild(hiddenInput);
        }

        function removeNewGalleryItem(button, index) {
            const item = button.closest('.relative');
            item.remove();

            // Remove from galleryFiles array
            galleryFiles.splice(index, 1);

            // Hide preview if no items left
            const galleryPreview = document.getElementById('gallery-preview');
            if (galleryPreview.children.length === 0) {
                galleryPreview.classList.add('hidden');
            }

            // Update indices
            updateNewGalleryIndices();
        }

        function updateNewGalleryIndices() {
            const galleryPreview = document.getElementById('gallery-preview');
            Array.from(galleryPreview.children).forEach((item, newIndex) => {
                const inputs = item.querySelectorAll('input[name*="gallery_"]');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    const newName = name.replace(/\[\d+\]/, `[${newIndex}]`);
                    input.setAttribute('name', newName);
                });

                const button = item.querySelector('button[onclick*="removeNewGalleryItem"]');
                if (button) {
                    button.setAttribute('onclick', `removeNewGalleryItem(this, ${newIndex})`);
                }

                // Update sort order value
                const sortInput = item.querySelector('input[name*="sort_order"]');
                if (sortInput) {
                    sortInput.value = newIndex + 1;
                }
            });
        }

        // Gallery Preview for new images
        function setupEditGalleryPreview() {
            console.log('🔍 EDIT: Looking for gallery elements...');
            const galleryInput = document.getElementById('gallery-images');
            const galleryPreview = document.getElementById('gallery-preview');

            console.log('🔍 EDIT: Gallery input:', galleryInput);
            console.log('🔍 EDIT: Gallery preview:', galleryPreview);

            if (!galleryInput || !galleryPreview) {
                console.error('❌ EDIT: Gallery elements not found!');
                return;
            }

            console.log('✅ EDIT: Gallery elements found, adding event listener...');
            galleryInput.addEventListener('change', function(e) {
                console.log('📁 EDIT: Files selected:', e.target.files.length);
                handleEditGalleryFiles(e.target.files, galleryPreview);
            });
        }

        function handleEditGalleryFiles(files, previewContainer) {
            // Clear previous NEW file previews only
            previewContainer.innerHTML = '';

            if (files.length === 0) {
                previewContainer.classList.add('hidden');
                return;
            }

            // Show preview container
            previewContainer.classList.remove('hidden');
            previewContainer.style.display = 'grid'; // Force grid display

            // Process each file
            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                if (!file.type.startsWith('image/')) {
                    continue;
                }

                // Check file size (2MB limit)
                if (file.size > 2097152) {
                    alert(`فایل "${file.name}" بیش از حد بزرگ است. حداکثر سایز مجاز 2MB می‌باشد.`);
                    continue;
                }

                // Create preview for this file
                createEditFilePreview(file, i, previewContainer);
            }
        }

        function createEditFilePreview(file, index, container) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Get existing gallery items count to set correct sort order
                const existingCount = document.querySelectorAll('#existing-gallery [data-gallery-id]').length;
                const sortOrder = existingCount + index + 1;

                const previewDiv = document.createElement('div');
                previewDiv.className = 'relative bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden';

                // Create image container
                const imageDiv = document.createElement('div');
                imageDiv.className = 'aspect-square';
                imageDiv.innerHTML = '<img src="' + e.target.result + '" alt="' + file.name + '" class="w-full h-full object-cover">';

                // Create form container
                const formDiv = document.createElement('div');
                formDiv.className = 'p-3';

                // Create alt text input
                const altDiv = document.createElement('div');
                altDiv.className = 'mb-2';
                altDiv.innerHTML = '<label class="block text-xs font-medium text-gray-700 mb-1">Alt Text</label>' +
                    '<input type="text" name="gallery_alt_text[' + index + ']" placeholder="Alt text" class="w-full px-2 py-1 text-xs border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">';

                // Create caption input
                const captionDiv = document.createElement('div');
                captionDiv.className = 'mb-2';
                captionDiv.innerHTML = '<label class="block text-xs font-medium text-gray-700 mb-1">Caption</label>' +
                    '<input type="text" name="gallery_caption[' + index + ']" placeholder="Caption" class="w-full px-2 py-1 text-xs border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">';

                // Create sort order input
                const sortDiv = document.createElement('div');
                sortDiv.className = 'mb-2';
                sortDiv.innerHTML = '<label class="block text-xs font-medium text-gray-700 mb-1">Sort Order</label>' +
                    '<input type="number" name="gallery_sort_order[' + index + ']" value="' + sortOrder + '" min="1" class="w-full px-2 py-1 text-xs border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">';

                // Create status message
                const statusDiv = document.createElement('div');
                statusDiv.className = 'text-xs text-green-600 font-medium';
                statusDiv.textContent = '✓ Ready to upload';

                // Assemble form container
                formDiv.appendChild(altDiv);
                formDiv.appendChild(captionDiv);
                formDiv.appendChild(sortDiv);
                formDiv.appendChild(statusDiv);

                // Assemble preview container
                previewDiv.appendChild(imageDiv);
                previewDiv.appendChild(formDiv);

                container.appendChild(previewDiv);
            };

            reader.onerror = function() {
                alert(`خطا در خواندن فایل: ${file.name}`);
            };

            reader.readAsDataURL(file);
        }

        // Initialize edit gallery when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🚀 EDIT FORM: DOM loaded, initializing gallery...');
            setupEditGalleryPreview();
        });
    </script>
</x-admin-layout>
