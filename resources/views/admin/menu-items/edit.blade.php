<x-admin-layout>
    <x-slot name="header">
        ویرایش آیتم منو
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">ویرایش آیتم منو</h2>
                            <p class="text-sm text-gray-600 mt-1">
                                منو: {{ $menu->translations->first()?->name ?? 'بدون نام' }}
                            </p>
                        </div>
                        <a href="{{ route('admin.menu-items.index', $menu) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-arrow-right ml-2"></i>
                            بازگشت
                        </a>
                    </div>

                    <!-- Form -->
                    <form action="{{ route('admin.menu-items.update', [$menu, $menuItem]) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">اطلاعات پایه</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- URL -->
                                <div>
                                    <label for="url" class="block text-sm font-medium text-gray-700 mb-2">لینک</label>
                                    <input type="text" name="url" id="url" value="{{ old('url', $menuItem->url) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="مثال: /about یا https://example.com" required>
                                    @error('url')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Target -->
                                <div>
                                    <label for="target" class="block text-sm font-medium text-gray-700 mb-2">هدف لینک</label>
                                    <select name="target" id="target" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="_self" {{ old('target', $menuItem->target) == '_self' ? 'selected' : '' }}>همان صفحه</option>
                                        <option value="_blank" {{ old('target', $menuItem->target) == '_blank' ? 'selected' : '' }}>صفحه جدید</option>
                                        <option value="_parent" {{ old('target', $menuItem->target) == '_parent' ? 'selected' : '' }}>صفحه والد</option>
                                        <option value="_top" {{ old('target', $menuItem->target) == '_top' ? 'selected' : '' }}>بالاترین صفحه</option>
                                    </select>
                                    @error('target')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Parent Item -->
                                <div>
                                    <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-2">آیتم والد</label>
                                    <select name="parent_id" id="parent_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">بدون والد (آیتم اصلی)</option>
                                        @foreach($parentItems as $parentItem)
                                            <option value="{{ $parentItem->id }}" {{ old('parent_id', $menuItem->parent_id) == $parentItem->id ? 'selected' : '' }}>
                                                {{ $parentItem->translations->first()?->title ?? 'بدون عنوان' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Sort Order -->
                                <div>
                                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">ترتیب نمایش</label>
                                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $menuItem->sort_order) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           min="0">
                                    @error('sort_order')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Active Status -->
                            <div class="mt-4">
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $menuItem->is_active) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <span class="mr-2 text-sm text-gray-700">فعال</span>
                                </label>
                            </div>
                        </div>

                        <!-- Translations -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">ترجمه‌ها</h3>

                            @foreach($languages as $language)
                                @php
                                    $translation = $menuItem->translations->where('language_id', $language->id)->first();
                                @endphp

                                <div class="border-b border-gray-200 pb-4 mb-4 last:border-b-0 last:pb-0 last:mb-0">
                                    <h4 class="text-md font-medium text-gray-800 mb-3">
                                        <span class="inline-block w-6 h-6 rounded-full bg-blue-100 text-blue-800 text-sm font-bold text-center leading-6 mr-2">
                                            {{ strtoupper(substr($language->code, 0, 1)) }}
                                        </span>
                                        {{ $language->name }}
                                    </h4>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="translations[{{ $language->id }}][title]" class="block text-sm font-medium text-gray-700 mb-2">عنوان</label>
                                            <input type="text" name="translations[{{ $language->id }}][title]"
                                                   value="{{ old("translations.{$language->id}.title", $translation?->title) }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                   placeholder="عنوان آیتم منو" required>
                                            @error("translations.{$language->id}.title")
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="flex items-end">
                                            <label class="flex items-center">
                                                <input type="checkbox" name="translations[{{ $language->id }}][is_active]" value="1"
                                                       {{ old("translations.{$language->id}.is_active", $translation?->is_active ?? true) ? 'checked' : '' }}
                                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                                <span class="mr-2 text-sm text-gray-700">فعال</span>
                                            </label>
                                        </div>
                                    </div>

                                    <input type="hidden" name="translations[{{ $language->id }}][language_id]" value="{{ $language->id }}">
                                </div>
                            @endforeach
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex justify-end space-x-3 space-x-reverse">
                            <a href="{{ route('admin.menu-items.index', $menu) }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                انصراف
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-save ml-2"></i>
                                به‌روزرسانی آیتم منو
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
