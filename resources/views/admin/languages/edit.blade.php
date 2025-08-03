<x-admin-layout>
    <x-slot name="header">
        ویرایش زبان: {{ $language->name }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.languages.update', $language) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Code -->
                            <div>
                                <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                                    کد زبان <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="code" id="code" value="{{ old('code', $language->code) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="مثال: fa, en, ar" required>
                                @error('code')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    نام زبان <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name', $language->name) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="مثال: Persian, English, Arabic" required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Native Name -->
                            <div>
                                <label for="native_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    نام محلی <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="native_name" id="native_name" value="{{ old('native_name', $language->native_name) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="مثال: فارسی, English, العربية" required>
                                @error('native_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Direction -->
                            <div>
                                <label for="direction" class="block text-sm font-medium text-gray-700 mb-2">
                                    جهت نوشتار <span class="text-red-500">*</span>
                                </label>
                                <select name="direction" id="direction"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                    <option value="">انتخاب کنید</option>
                                    <option value="rtl" {{ old('direction', $language->direction) === 'rtl' ? 'selected' : '' }}>راست به چپ (RTL)</option>
                                    <option value="ltr" {{ old('direction', $language->direction) === 'ltr' ? 'selected' : '' }}>چپ به راست (LTR)</option>
                                </select>
                                @error('direction')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Sort Order -->
                            <div>
                                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                                    ترتیب نمایش
                                </label>
                                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $language->sort_order) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="0">
                                @error('sort_order')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Checkboxes -->
                        <div class="mt-6 space-y-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" id="is_active" value="1"
                                       {{ old('is_active', $language->is_active) ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="is_active" class="mr-2 block text-sm text-gray-900">
                                    فعال
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" name="is_default" id="is_default" value="1"
                                       {{ old('is_default', $language->is_default) ? 'checked' : '' }}
                                       class="h-4 w-4 text-yellow-600 focus:ring-yellow-500 border-gray-300 rounded">
                                <label for="is_default" class="mr-2 block text-sm text-gray-900">
                                    زبان پیش‌فرض
                                </label>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-8 flex justify-end space-x-3 space-x-reverse">
                            <a href="{{ route('admin.languages.index') }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                انصراف
                            </a>
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-save ml-2"></i>
                                به‌روزرسانی زبان
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
