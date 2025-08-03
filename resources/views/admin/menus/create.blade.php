<x-admin-layout>
    <x-slot name="header">
        افزودن منوی جدید
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.menus.store') }}" method="POST">
                        @csrf

                        <!-- Basic Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">اطلاعات پایه</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Position -->
                                <div>
                                    <label for="position" class="block text-sm font-medium text-gray-700 mb-2">
                                        موقعیت منو <span class="text-red-500">*</span>
                                    </label>
                                    <select name="position" id="position"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                        <option value="">انتخاب کنید</option>
                                        <option value="header" {{ old('position') === 'header' ? 'selected' : '' }}>هدر</option>
                                        <option value="footer" {{ old('position') === 'footer' ? 'selected' : '' }}>فوتر</option>
                                        <option value="sidebar" {{ old('position') === 'sidebar' ? 'selected' : '' }}>سایدبار</option>
                                        <option value="mobile" {{ old('position') === 'mobile' ? 'selected' : '' }}>موبایل</option>
                                    </select>
                                    @error('position')
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
                                        <!-- Name -->
                                        <div>
                                            <label for="translations[{{ $language->id }}][name]" class="block text-sm font-medium text-gray-700 mb-2">
                                                نام منو <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="translations[{{ $language->id }}][name]"
                                                   value="{{ old("translations.{$language->id}.name") }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   placeholder="نام منو" required>
                                            @error("translations.{$language->id}.name")
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Description -->
                                        <div>
                                            <label for="translations[{{ $language->id }}][description]" class="block text-sm font-medium text-gray-700 mb-2">
                                                توضیحات
                                            </label>
                                            <input type="text" name="translations[{{ $language->id }}][description]"
                                                   value="{{ old("translations.{$language->id}.description") }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   placeholder="توضیحات منو">
                                            @error("translations.{$language->id}.description")
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
                            <a href="{{ route('admin.menus.index') }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                انصراف
                            </a>
                            <button type="submit"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-save ml-2"></i>
                                ایجاد منو
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
