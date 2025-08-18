<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Vehicles') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filters -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-8">
                <div class="p-6">
                    <form method="GET" action="{{ route('vehicles.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <!-- Search -->
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700">{{ __('Search') }}</label>
                                <input type="text" name="search" id="search"
                                       value="{{ request('search') }}"
                                       placeholder="{{ __('Search vehicles...') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <!-- Brand -->
                            <div>
                                <label for="brand_id" class="block text-sm font-medium text-gray-700">{{ __('Brand') }}</label>
                                <select name="brand_id" id="brand_id"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-brand">
                                    <option value="">{{ __('All Brands') }}</option>
                                    @if(request('brand_id') && $selectedBrand)
                                        <option value="{{ $selectedBrand->id }}" selected>{{ $selectedBrand->name }}</option>
                                    @endif
                                </select>
                            </div>

                            <!-- Model -->
                            <div>
                                <label for="model_id" class="block text-sm font-medium text-gray-700">{{ __('Model') }}</label>
                                <select name="model_id" id="model_id"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-model">
                                    <option value="">{{ __('All Models') }}</option>
                                    @if(request('model_id') && $selectedModel)
                                        <option value="{{ $selectedModel->id }}" selected>{{ $selectedModel->name }}</option>
                                    @endif
                                </select>
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">{{ __('Status') }}</label>
                                <select name="status" id="status"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">{{ __('All Status') }}</option>
                                    <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>{{ __('New') }}</option>
                                    <option value="used" {{ request('status') == 'used' ? 'selected' : '' }}>{{ __('Used') }}</option>
                                    <option value="export" {{ request('status') == 'export' ? 'selected' : '' }}>{{ __('Export') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Year -->
                            <div>
                                <label for="year" class="block text-sm font-medium text-gray-700">{{ __('Year') }}</label>
                                <select name="year" id="year"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">{{ __('All Years') }}</option>
                                    @for($year = date('Y'); $year >= 2010; $year--)
                                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Price Range -->
                            <div>
                                <label for="min_price" class="block text-sm font-medium text-gray-700">{{ __('Min Price') }}</label>
                                <input type="number" name="min_price" id="min_price"
                                       value="{{ request('min_price') }}"
                                       placeholder="{{ __('Min Price') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label for="max_price" class="block text-sm font-medium text-gray-700">{{ __('Max Price') }}</label>
                                <input type="number" name="max_price" id="max_price"
                                       value="{{ request('max_price') }}"
                                       placeholder="{{ __('Max Price') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500">
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <button type="submit"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Filter') }}
                            </button>
                            <a href="{{ route('vehicles.index') }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Clear Filters') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Results Count -->
            <div class="mb-4">
                <p class="text-gray-600">
                    {{ __('Showing') }} {{ $vehicles->firstItem() ?? 0 }} - {{ $vehicles->lastItem() ?? 0 }}
                    {{ __('of') }} {{ $vehicles->total() }} {{ __('vehicles') }}
                </p>
            </div>

            <!-- Vehicles Grid -->
            @if($vehicles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($vehicles as $vehicle)
                        <div class="bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                            <!-- Image Section with Bookmark Icon -->
                            <div class="relative">
                                <a href="{{ route('vehicles.show', $vehicle) }}" class="block">
                                    @if($vehicle->featured_image)
                                        <img src="{{ Storage::url($vehicle->featured_image) }}"
                                             alt="{{ $vehicle->full_name }}"
                                             class="w-full h-48 object-cover">
                                    @else
                                        <div class="w-full h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </a>

                                <!-- Bookmark Icon -->
                                <button class="absolute top-3 left-3 w-8 h-8 bg-white/90 hover:bg-white rounded-full flex items-center justify-center shadow-md transition-all duration-200 hover:scale-110">
                                    <svg class="w-5 h-5 text-gray-600 hover:text-red-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                    </svg>
                                </button>

                                <!-- Status Badge -->
                                @if($vehicle->status == 'used')
                                    <div class="absolute top-3 right-3 bg-black text-white text-xs px-2 py-1 rounded-full font-medium">
                                        {{ __('Used') }}
                                    </div>
                                @elseif($vehicle->status == 'new')
                                    <div class="absolute top-3 right-3 bg-green-500 text-white text-xs px-2 py-1 rounded-full font-medium">
                                        {{ __('New') }}
                                    </div>
                                @endif
                            </div>

                            <div class="p-4">
                                <!-- Brand Logo and Name -->
                                <div class="flex items-center space-x-2 mb-3">
                                    @if($vehicle->brand && $vehicle->brand->logo)
                                        <img src="{{ Storage::url($vehicle->brand->logo) }}"
                                             alt="{{ $vehicle->brand->name }}"
                                             class="w-6 h-6 object-contain">
                                    @else
                                        <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center">
                                            <span class="text-xs font-bold text-gray-600">{{ substr($vehicle->brand->name ?? 'V', 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <h3 class="font-bold text-gray-900 text-lg leading-tight">
                                        <a href="{{ route('vehicles.show', $vehicle) }}" class="hover:text-blue-600 transition-colors duration-200">
                                            {{ $vehicle->full_name }}
                                        </a>
                                    </h3>
                                </div>

                                <!-- Vehicle Details Grid -->
                                <div class="flex justify-between mb-4">
                                    <div class="text-center flex-1">
                                        <div class="flex justify-center mb-2">
                                            <i class="fas fa-calendar text-gray-500 text-lg"></i>
                                        </div>
                                        <div class="text-sm font-semibold text-gray-800">{{ $vehicle->year }}</div>
                                    </div>
                                    <div class="text-center flex-1">
                                        <div class="flex justify-center mb-2">
                                            <i class="fas fa-tachometer-alt text-gray-500 text-lg"></i>
                                        </div>
                                        <div class="text-sm font-semibold text-gray-800">
                                            @if($vehicle->mileage && $vehicle->mileage > 0)
                                                {{ number_format($vehicle->mileage) }} KM
                                            @else
                                                {{ __('Zero') }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-center flex-1">
                                        <div class="flex justify-center mb-2">
                                            <i class="fas fa-cog text-gray-500 text-lg"></i>
                                        </div>
                                        <div class="text-sm font-semibold text-gray-800">
                                            @if($vehicle->transmissionType)
                                                {{ $vehicle->transmissionType->name }}
                                            @else
                                                {{ __('Auto') }}
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Price and Action -->
                                <div class="flex justify-between items-center">
                                    <div class="text-left">
                                        <span class="text-xl font-bold text-green-600">
                                            {{ number_format($vehicle->price) }}
                                        </span>
                                        <span class="text-sm text-gray-500 ml-1">{{ $vehicle->currency ?? 'تومان' }}</span>
                                    </div>

                                    @if($vehicle->is_featured)
                                        <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full font-medium">
                                            {{ __('Featured') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $vehicles->links() }}
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">{{ __('No vehicles found') }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ __('Try adjusting your search criteria.') }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize Select2 for brand and model
            $('.select2-brand').select2({
                placeholder: '{{ __("Search and select brand...") }}',
                allowClear: true,
                width: '100%',
                ajax: {
                    url: '{{ route("vehicles.search-brands") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            page: params.page || 1
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            }),
                            pagination: {
                                more: data.next_page_url != null
                            }
                        };
                    },
                    cache: true
                }
            });

            $('.select2-model').select2({
                placeholder: '{{ __("Search and select model...") }}',
                allowClear: true,
                width: '100%',
                ajax: {
                    url: '{{ route("vehicles.search-models") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            brand_id: $('#brand_id').val(),
                            page: params.page || 1
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            }),
                            pagination: {
                                more: data.next_page_url != null
                            }
                        };
                    },
                    cache: true
                }
            });

            // Load models when brand changes
            $('.select2-brand').on('change', function() {
                const brandId = $(this).val();
                const modelSelect = $('.select2-model');

                // Clear model selection
                modelSelect.val(null).trigger('change');

                // Update model AJAX URL
                if (brandId) {
                    modelSelect.select2('destroy');
                    $('.select2-model').select2({
                        placeholder: '{{ __("Search and select model...") }}',
                        allowClear: true,
                        width: '100%',
                        ajax: {
                            url: '{{ route("vehicles.search-models") }}',
                            dataType: 'json',
                            delay: 250,
                            data: function(params) {
                                return {
                                    search: params.term,
                                    brand_id: brandId,
                                    page: params.page || 1
                                };
                            },
                            processResults: function(data, params) {
                                params.page = params.page || 1;
                                return {
                                    results: data.data.map(function(item) {
                                        return {
                                            id: item.id,
                                            text: item.name
                                        };
                                    }),
                                    pagination: {
                                        more: data.next_page_url != null
                                    }
                                };
                            },
                            cache: true
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>
