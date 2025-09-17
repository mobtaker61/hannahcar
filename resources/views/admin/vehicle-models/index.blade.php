<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Vehicle Models Management') }}
            </h2>
            <a href="{{ route('admin.vehicle-models.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Add New Model') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Filters -->
                <div class="p-6 border-b border-gray-200">
                    <form method="GET" action="{{ route('admin.vehicle-models.index') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="relative">
                            <label for="brand_search" class="block text-sm font-medium text-gray-700">{{ __('Filter by Brand') }}</label>
                            <input type="text"
                                   id="brand_search"
                                   name="brand_search"
                                   placeholder="{{ __('Search brands...') }}"
                                   value="{{ request('brand_search') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                   autocomplete="off">
                            <input type="hidden" name="brand_id" id="brand_id" value="{{ request('brand_id') }}">
                            <div id="brand_results" class="hidden absolute z-10 w-full bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto mt-1"></div>
                        </div>

                        <div class="flex items-end">
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Filter') }}
                            </button>
                            <a href="{{ route('admin.vehicle-models.index') }}" class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Clear') }}
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Models List -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Model') }}
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Brand') }}
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Vehicles Count') }}
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Status') }}
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($models as $model)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $model->name }}
                                        </div>
                                        @if($model->description)
                                            <div class="text-sm text-gray-500">
                                                {{ Str::limit($model->description, 50) }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $model->brand->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $model->vehicles_count ?? 0 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            {{ $model->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $model->is_active ? __('Active') : __('Inactive') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.vehicle-models.show', $model) }}"
                                               class="text-indigo-600 hover:text-indigo-900">{{ __('View') }}</a>
                                            <a href="{{ route('admin.vehicle-models.edit', $model) }}"
                                               class="text-blue-600 hover:text-blue-900">{{ __('Edit') }}</a>
                                            <form action="{{ route('admin.vehicle-models.destroy', $model) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900"
                                                        onclick="return confirm('{{ __('Are you sure you want to delete this model?') }}')">
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        {{ __('No models found.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4">
                    {{ $models->links() }}
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

            // اگر برند قبلاً انتخاب شده (در صورت refresh صفحه)
            if (brandId.value) {
                // برند قبلاً انتخاب شده
            }
        });
    </script>
</x-admin-layout>
