<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Vehicle Model') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Form -->
                <div class="p-6">
                    <div class="flex items-center mb-6">
                        <a href="{{ route('admin.vehicle-models.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Create New Vehicle Model') }}</h3>
                    </div>

                    <form action="{{ route('admin.vehicle-models.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- برند -->
                            <div class="relative">
                                <label for="brand_search" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('Brand') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                       id="brand_search"
                                       placeholder="{{ __('Search brands...') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                       autocomplete="off">
                                <input type="hidden" name="brand_id" id="brand_id" required>
                                <div id="brand_results" class="hidden absolute z-10 w-full bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto mt-1"></div>
                                @error('brand_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- نام -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('Name') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       value="{{ old('name') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                       required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- ترتیب -->
                            <div>
                                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('Sort Order') }}
                                </label>
                                <input type="number"
                                       name="sort_order"
                                       id="sort_order"
                                       value="{{ old('sort_order', 0) }}"
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
                                {{ __('Description') }}
                            </label>
                            <textarea name="description"
                                       id="description"
                                       rows="3"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- وضعیت -->
                        <div class="mt-6">
                            <label class="flex items-center">
                                <input type="checkbox"
                                       name="is_active"
                                       value="1"
                                       {{ old('is_active', true) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                <span class="mr-2 text-sm text-gray-700">{{ __('Active') }}</span>
                            </label>
                        </div>

                        <div class="flex justify-end mt-8 space-x-3 space-x-reverse">
                            <a href="{{ route('admin.vehicle-models.index') }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit"
                                     class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Create Model') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const brandSearch = document.getElementById('brand_search');
            const brandId = document.getElementById('brand_id');
            const brandResults = document.getElementById('brand_results');
            let searchTimeout;

            // جستجوی برند
            brandSearch.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                const query = this.value.trim();

                if (query.length < 2) {
                    brandResults.classList.add('hidden');
                    return;
                }

                searchTimeout = setTimeout(() => {
                    fetch(`/admin/api/brands/search?q=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.brands && data.brands.length > 0) {
                                displayBrandResults(data.brands);
                            } else {
                                brandResults.classList.add('hidden');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            brandResults.classList.add('hidden');
                        });
                }, 300);
            });

            // نمایش نتایج برند
            function displayBrandResults(brands) {
                brandResults.innerHTML = '';
                brands.forEach(brand => {
                    const div = document.createElement('div');
                    div.className = 'px-4 py-2 hover:bg-gray-100 cursor-pointer border-b border-gray-200 last:border-b-0';
                    div.textContent = brand.name;
                    div.addEventListener('click', () => selectBrand(brand));
                    brandResults.appendChild(div);
                });
                brandResults.classList.remove('hidden');
            }

            // انتخاب برند
            function selectBrand(brand) {
                brandSearch.value = brand.name;
                brandId.value = brand.id;
                brandResults.classList.add('hidden');
            }

            // مخفی کردن نتایج با کلیک خارج
            document.addEventListener('click', function(e) {
                if (!brandSearch.contains(e.target) && !brandResults.contains(e.target)) {
                    brandResults.classList.add('hidden');
                }
            });

            // اگر برند قبلاً انتخاب شده (در صورت خطا)
            if (brandId.value) {
                const brandName = brandSearch.value;
                if (brandName) {
                    // برند قبلاً انتخاب شده
                }
            }
        });
    </script>
</x-admin-layout>
