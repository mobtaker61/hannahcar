<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ویرایش واریانت خودرو
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Form -->
                <div class="p-6">
                    <div class="flex items-center mb-6">
                        <a href="{{ route('admin.vehicle-variants.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <h3 class="text-lg font-medium text-gray-900">فرم ویرایش واریانت خودرو</h3>
                    </div>

                    <form action="{{ route('admin.vehicle-variants.update', $vehicleVariant) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- برند (فقط نمایش) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">برند</label>
                                <p class="text-lg text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    {{ $vehicleVariant->model->brand->name ?? '—' }}
                                </p>
                            </div>

                            <!-- مدل (فقط نمایش) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">مدل</label>
                                <p class="text-lg text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    {{ $vehicleVariant->model->name ?? '—' }}
                                </p>
                            </div>

                            <!-- نام -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    نام <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       value="{{ old('name', $vehicleVariant->name) }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                       required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- نام انگلیسی -->
                            <div>
                                <label for="name_en" class="block text-sm font-medium text-gray-700 mb-2">
                                    نام انگلیسی
                                </label>
                                <input type="text"
                                       name="name_en"
                                       id="name_en"
                                       value="{{ old('name_en', $vehicleVariant->name_en) }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                @error('name_en')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- ترتیب -->
                            <div>
                                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                                    ترتیب
                                </label>
                                <input type="number"
                                       name="sort_order"
                                       id="sort_order"
                                       value="{{ old('sort_order', $vehicleVariant->sort_order) }}"
                                       min="0"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                @error('sort_order')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- توضیحات -->
                        <div class="mt-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                توضیحات
                            </label>
                            <textarea name="description"
                                       id="description"
                                       rows="3"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $vehicleVariant->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- توضیحات انگلیسی -->
                        <div class="mt-6">
                            <label for="description_en" class="block text-sm font-medium text-gray-700 mb-2">
                                توضیحات انگلیسی
                            </label>
                            <textarea name="description_en"
                                       id="description_en"
                                       rows="3"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description_en', $vehicleVariant->description_en) }}</textarea>
                            @error('description_en')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- وضعیت -->
                        <div class="mt-6">
                            <label class="flex items-center">
                                <input type="checkbox"
                                       name="is_active"
                                       value="1"
                                       {{ old('is_active', $vehicleVariant->is_active) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                <span class="mr-2 text-sm text-gray-700">فعال</span>
                            </label>
                        </div>

                        <div class="flex justify-end mt-8 space-x-3 space-x-reverse">
                            <a href="{{ route('admin.vehicle-variants.index') }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                انصراف
                            </a>
                            <button type="submit"
                                     class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                به‌روزرسانی واریانت خودرو
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
