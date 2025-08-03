<x-admin-layout>
    <x-slot name="header">
        ویرایش دسته‌بندی: {{ $category->name }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                            <!-- Main Content -->
                            <div class="lg:col-span-3">
                                <!-- Basic Information -->
                                <div class="mb-8">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">اطلاعات اصلی</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div>
                                            <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                                                Slug <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   required>
                                            @error('slug')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                                                ترتیب
                                            </label>
                                            <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $category->sort_order) }}" min="0"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            @error('sort_order')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <div class="flex items-center mt-6">
                                                <input type="checkbox" name="is_active" id="is_active" value="1"
                                                       {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                                <label for="is_active" class="mr-2 block text-sm text-gray-900">
                                                    فعال
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
                                            @foreach($languages as $index => $language)
                                                @php
                                                    $translation = $category->translations->where('language_id', $language->id)->first();
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
                                                    @if($translation && $translation->name)
                                                        <span class="ml-2 text-xs text-green-600">✓</span>
                                                    @endif
                                                </button>
                                            @endforeach
                                        </nav>
                                    </div>

                                    <!-- Tab Content -->
                                    @foreach($languages as $index => $language)
                                        @php
                                            $translation = $category->translations->where('language_id', $language->id)->first();
                                        @endphp
                                        <div id="content-{{ $language->code }}"
                                             class="tab-content {{ $index === 0 ? 'block' : 'hidden' }} bg-gray-50 rounded-lg p-6">

                                            <input type="hidden" name="translations[{{ $index }}][language_id]"
                                                   value="{{ $language->id }}">

                                            <div class="space-y-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        نام <span class="text-red-500">*</span>
                                                    </label>
                                                    <input type="text" name="translations[{{ $index }}][name]"
                                                           value="{{ old("translations.{$index}.name", $translation->name ?? '') }}"
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                           required>
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        توضیحات
                                                    </label>
                                                    <textarea name="translations[{{ $index }}][description]" rows="3"
                                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old("translations.{$index}.description", $translation->description ?? '') }}</textarea>
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
                                                            تصویر شاخص
                                                        </label>
                                                        <input type="text" name="translations[{{ $index }}][featured_image]"
                                                               value="{{ old("translations.{$index}.featured_image", $translation->featured_image ?? '') }}"
                                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                    </div>
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        Meta Description
                                                    </label>
                                                    <textarea name="translations[{{ $index }}][meta_description]" rows="3"
                                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old("translations.{$index}.meta_description", $translation->meta_description ?? '') }}</textarea>
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
                                                ذخیره تغییرات
                                            </button>
                                            <a href="{{ route('admin.categories.index') }}"
                                               class="w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-block text-center">
                                                <i class="fas fa-arrow-left ml-2"></i>
                                                بازگشت
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Category Info -->
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                                    <div class="px-4 py-3 border-b border-gray-200">
                                        <h5 class="text-lg font-medium text-gray-900">اطلاعات دسته‌بندی</h5>
                                    </div>
                                    <div class="p-4">
                                        <div class="space-y-3 text-sm">
                                            <div>
                                                <span class="font-medium text-gray-700">تاریخ ایجاد:</span>
                                                <div class="text-gray-600">{{ $category->created_at->format('Y/m/d H:i') }}</div>
                                            </div>
                                            <div>
                                                <span class="font-medium text-gray-700">آخرین بروزرسانی:</span>
                                                <div class="text-gray-600">{{ $category->updated_at->format('Y/m/d H:i') }}</div>
                                            </div>
                                            <div>
                                                <span class="font-medium text-gray-700">تعداد مقالات:</span>
                                                <div class="text-gray-600">{{ $category->articles->count() }} مقاله</div>
                                            </div>
                                            <div>
                                                <span class="font-medium text-gray-700">وضعیت:</span>
                                                <div class="text-gray-600">
                                                    @if($category->is_active)
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            فعال
                                                        </span>
                                                    @else
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                            غیرفعال
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
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

    <script>
        // Generate slug from name
        function generateSlug(name) {
            fetch('{{ route("admin.categories.generate-slug") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ name: name })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('slug').value = data.slug;
            });
        }

        // Auto-generate slug when name changes
        document.addEventListener('DOMContentLoaded', function() {
            const nameInputs = document.querySelectorAll('input[name*="[name]"]');
            nameInputs.forEach(function(input) {
                input.addEventListener('blur', function() {
                    if (this.value && !document.getElementById('slug').value) {
                        generateSlug(this.value);
                    }
                });
            });
        });

        // Tab switching functionality
        function switchTab(languageCode) {
            // Hide all tab content
            document.querySelectorAll('.tab-content').forEach(function(content) {
                content.classList.add('hidden');
            });

            // Remove active class from all tab buttons
            document.querySelectorAll('.tab-button').forEach(function(button) {
                button.classList.remove('border-blue-500', 'text-blue-600');
                button.classList.add('border-transparent', 'text-gray-500');
            });

            // Show the selected tab content
            document.getElementById('content-' + languageCode).classList.remove('hidden');

            // Add active class to the selected tab button
            document.getElementById('tab-' + languageCode).classList.add('border-blue-500', 'text-blue-600');
            document.getElementById('tab-' + languageCode).classList.remove('border-transparent', 'text-gray-500');
        }

        // Set initial active tab based on default language or first language
        document.addEventListener('DOMContentLoaded', function() {
            const defaultLanguageCode = '{{ $category->translations->first()->language->code }}';
            switchTab(defaultLanguageCode);
        });
    </script>
</x-admin-layout>
