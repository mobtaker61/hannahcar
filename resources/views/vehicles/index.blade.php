<x-app-layout>
    <!-- Featured Vehicles -->
    <section class="relative max-w-7xl mx-auto">
        <livewire:spotlight-carousel />
    </section>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Results Count and Sort -->
            <div
                class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                <div class="flex items-center space-x-4 space-x-reverse mb-4 sm:mb-0">
                    <div class="flex items-center space-x-2 space-x-reverse">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                        <span class="text-gray-700 font-medium">
                            {{ __('Showing') }} {{ $vehicles->firstItem() ?? 0 }} - {{ $vehicles->lastItem() ?? 0 }}
                            {{ __('of') }} {{ $vehicles->total() }} {{ __('vehicles') }}
                        </span>
                    </div>
                    @if (request()->hasAny(['search', 'brand_id', 'model_id', 'status', 'year', 'min_price', 'max_price']))
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                            {{ __('Filtered') }}
                        </span>
                    @endif
                </div>

                <div class="flex items-center space-x-3 space-x-reverse">
                    <select id="sort-select"
                        class="text-sm border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">{{ __('Sort by') }}</option>
                        <option value="price_asc">{{ __('Price: Low to High') }}</option>
                        <option value="price_desc">{{ __('Price: High to Low') }}</option>
                        <option value="year_desc">{{ __('Year: Newest First') }}</option>
                        <option value="year_asc">{{ __('Year: Oldest First') }}</option>
                        <option value="mileage_asc">{{ __('Mileage: Low to High') }}</option>
                        <option value="created_at_desc">{{ __('Newest Added') }}</option>
                    </select>
                </div>
            </div>

            <!-- Vehicles Grid with Lazy Loading -->
            @if ($vehicles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6" id="vehicles-grid">
                    @foreach ($vehicles as $vehicle)
                        <div class="group bg-white overflow-hidden shadow-lg rounded-2xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100 vehicle-card"
                            data-vehicle-id="{{ $vehicle->id }}">
                            <!-- Image Section with Lazy Loading -->
                            <div class="relative overflow-hidden">
                                <a href="{{ route('vehicles.show', $vehicle) }}" class="block">
                                    @if ($vehicle->featured_image)
                                        <img src="{{ Storage::url($vehicle->featured_image) }}"
                                            alt="{{ $vehicle->full_name }}"
                                            class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-700"
                                            loading="lazy">
                                    @else
                                        <div
                                            class="w-full h-56 bg-gradient-to-br from-indigo-50 via-blue-50 to-purple-50 flex items-center justify-center">
                                            <div class="text-center">
                                                <svg class="w-20 h-20 text-indigo-300 mx-auto mb-2" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                                <p class="text-sm text-indigo-400 font-medium">{{ __('No Image') }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </a>

                                <!-- Action Buttons -->
                                <div class="absolute top-3 left-3 flex flex-col space-y-2 space-y-reverse">
                                    <!-- Bookmark Icon -->
                                    <button
                                        class="w-10 h-10 bg-white/95 hover:bg-white rounded-full flex items-center justify-center shadow-lg transition-all duration-300 hover:scale-110 group/bookmark"
                                        title="{{ __('Add to Favorites') }}">
                                        <svg class="w-5 h-5 text-gray-600 group-hover/bookmark:text-red-500 transition-colors duration-200"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                        </svg>
                                    </button>

                                    <!-- Compare Icon -->
                                    <button
                                        class="w-10 h-10 bg-white/95 hover:bg-white rounded-full flex items-center justify-center shadow-lg transition-all duration-300 hover:scale-110 group/compare"
                                        title="{{ __('Add to Compare') }}">
                                        <svg class="w-5 h-5 text-gray-600 group-hover/compare:text-indigo-500 transition-colors duration-200"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Status Badge -->
                                <div class="absolute top-3 right-3">
                                    @if ($vehicle->status == 'used')
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-900 text-white shadow-lg">
                                            <div class="w-2 h-2 bg-gray-300 rounded-full mr-2"></div>
                                            {{ __('Used') }}
                                        </span>
                                    @elseif($vehicle->status == 'new')
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-500 text-white shadow-lg">
                                            <div class="w-2 h-2 bg-green-200 rounded-full mr-2"></div>
                                            {{ __('New') }}
                                        </span>
                                    @elseif($vehicle->status == 'export')
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-500 text-white shadow-lg">
                                            <div class="w-2 h-2 bg-blue-200 rounded-full mr-2"></div>
                                            {{ __('Export') }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Featured Badge -->
                                @if ($vehicle->is_featured)
                                    <div class="absolute bottom-3 right-3">
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-yellow-400 text-yellow-900 shadow-lg">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                </path>
                                            </svg>
                                            {{ __('Featured') }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <div class="p-5">
                                <!-- Brand Logo and Name -->
                                <div class="flex items-center space-x-3 space-x-reverse mb-4">
                                    @if ($vehicle->brand && $vehicle->brand->logo)
                                        <div
                                            class="w-8 h-8 rounded-full bg-gray-50 p-1 flex items-center justify-center">
                                            <img src="{{ Storage::url($vehicle->brand->logo) }}"
                                                alt="{{ $vehicle->brand->name }}" class="w-6 h-6 object-contain">
                                        </div>
                                    @else
                                        <div
                                            class="w-8 h-8 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center">
                                            <span
                                                class="text-sm font-bold text-indigo-600">{{ substr($vehicle->brand->name ?? 'V', 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-bold text-gray-900 text-lg leading-tight truncate">
                                            <a href="{{ route('vehicles.show', $vehicle) }}"
                                                class="hover:text-indigo-600 transition-colors duration-200 group-hover:text-indigo-600">
                                                {{ $vehicle->full_name }}
                                            </a>
                                        </h3>
                                        @if ($vehicle->brand)
                                            <p class="text-sm text-gray-500 truncate">{{ $vehicle->brand->name }}</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Vehicle Details Grid -->
                                <div class="grid grid-cols-3 gap-4 ">
                                    <div class="text-center">
                                        <div
                                            class="w-10 h-10 bg-indigo-50 rounded-lg flex items-center justify-center mx-auto mb-2">
                                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="text-sm font-semibold text-gray-800">{{ $vehicle->year }}</div>
                                    </div>
                                    <div class="text-center">
                                        <div
                                            class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center mx-auto mb-2">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                            </svg>
                                        </div>
                                        <div class="text-sm font-semibold text-gray-800">
                                            @if ($vehicle->mileage && $vehicle->mileage > 0)
                                                {{ number_format($vehicle->mileage) }} KM
                                            @else
                                                {{ __('Zero') }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div
                                            class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center mx-auto mb-2">
                                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="text-sm font-semibold text-gray-800">
                                            @if ($vehicle->transmissionType)
                                                {{ $vehicle->transmissionType->name }}
                                            @else
                                                {{ __('Auto') }}
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Price and Action -->
                                <div class="flex justify-end items-center pt-4 border-t border-gray-100">
                                    <div class="text-left">
                                        <div class="flex items-baseline space-x-1 space-x-reverse">
                                            <span class="text-sm text-gray-500">{{ $vehicle->currency ?? __('تومان') }}</span>
                                            <span class="text-2xl font-bold text-green-600">
                                                {{ number_format($vehicle->price) }}
                                            </span>
                                        </div>
                                        @if ($vehicle->price_per_month)
                                            <div class="text-xs text-gray-400 mt-1">
                                                {{ __('From') }} {{ number_format($vehicle->price_per_month) }}
                                                {{ __('per month') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-2">
                        {{ $vehicles->links() }}
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="p-16 text-center">
                        <div
                            class="w-24 h-24 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-indigo-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('No vehicles found') }}</h3>
                        <p class="text-gray-500 mb-8 max-w-md mx-auto">
                            {{ __('We couldn\'t find any vehicles matching your criteria. Try adjusting your search filters or browse all vehicles.') }}
                        </p>

                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <button onclick="clearFilters()"
                                class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                {{ __('Clear Filters') }}
                            </button>
                            <a href="{{ route('vehicles.index') }}"
                                class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                                {{ __('View All Vehicles') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Floating Filter Button -->
    <div class="fixed bottom-6 left-6 z-50">
        <div class="flex flex-col space-y-3 space-y-reverse">
            <!-- Filter Button -->
            <button id="filter-toggle"
                class="group bg-indigo-600 hover:bg-indigo-700 text-white w-16 h-16 rounded-2xl shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-110 flex items-center justify-center">
                <svg class="w-6 h-6 group-hover:rotate-180 transition-transform duration-300" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z">
                    </path>
                </svg>
            </button>

            <!-- Quick Actions -->
            <div id="quick-actions" class="hidden flex flex-col space-y-2 space-y-reverse">
                <button
                    class="w-12 h-12 bg-white hover:bg-gray-50 text-gray-600 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 flex items-center justify-center"
                    title="{{ __('Sort') }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                    </svg>
                </button>
                <button
                    class="w-12 h-12 bg-white hover:bg-gray-50 text-gray-600 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 flex items-center justify-center"
                    title="{{ __('Compare') }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Floating Filter Overlay -->
    <div id="filter-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-5xl w-full max-h-[90vh] overflow-y-auto transform transition-all duration-300 scale-95 opacity-0"
                id="filter-panel">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">{{ __('Filter Vehicles') }}</h3>
                            <p class="text-gray-500 mt-1">{{ __('Refine your search to find the perfect vehicle') }}
                            </p>
                        </div>
                        <button id="filter-close"
                            class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center transition-colors duration-200">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form method="GET" action="{{ route('vehicles.index') }}" class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Search -->
                            <div class="lg:col-span-3">
                                <label for="search"
                                    class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Search') }}</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" name="search" id="search"
                                        value="{{ request('search') }}"
                                        placeholder="{{ __('Search by brand, model, or features...') }}"
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                </div>
                            </div>

                            <!-- Brand -->
                            <div>
                                <label for="brand_id"
                                    class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Brand') }}</label>
                                <select name="brand_id" id="brand_id"
                                    class="block w-full py-3 px-4 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm select2-brand">
                                    <option value="">{{ __('All Brands') }}</option>
                                    @if (request('brand_id') && $selectedBrand)
                                        <option value="{{ $selectedBrand->id }}" selected>{{ $selectedBrand->name }}
                                        </option>
                                    @endif
                                </select>
                            </div>

                            <!-- Model -->
                            <div>
                                <label for="model_id"
                                    class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Model') }}</label>
                                <select name="model_id" id="model_id"
                                    class="block w-full py-3 px-4 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm select2-model">
                                    <option value="">{{ __('All Models') }}</option>
                                    @if (request('model_id') && $selectedModel)
                                        <option value="{{ $selectedModel->id }}" selected>{{ $selectedModel->name }}
                                        </option>
                                    @endif
                                </select>
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status"
                                    class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Status') }}</label>
                                <select name="status" id="status"
                                    class="block w-full py-3 px-4 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                    <option value="">{{ __('All Status') }}</option>
                                    <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>
                                        {{ __('New') }}</option>
                                    <option value="used" {{ request('status') == 'used' ? 'selected' : '' }}>
                                        {{ __('Used') }}</option>
                                    <option value="export" {{ request('status') == 'export' ? 'selected' : '' }}>
                                        {{ __('Export') }}</option>
                                </select>
                            </div>

                            <!-- Year -->
                            <div>
                                <label for="year"
                                    class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Year') }}</label>
                                <select name="year" id="year"
                                    class="block w-full py-3 px-4 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                    <option value="">{{ __('All Years') }}</option>
                                    @for ($year = date('Y'); $year >= 2010; $year--)
                                        <option value="{{ $year }}"
                                            {{ request('year') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Price Range -->
                            <div>
                                <label for="min_price"
                                    class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Min Price') }}</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 text-sm">{{ $vehicle->currency ?? 'تومان' }}</span>
                                    </div>
                                    <input type="number" name="min_price" id="min_price"
                                        value="{{ request('min_price') }}" placeholder="{{ __('Min Price') }}"
                                        class="block w-full pl-16 pr-3 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                </div>
                            </div>
                            <div>
                                <label for="max_price"
                                    class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Max Price') }}</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 text-sm">{{ $vehicle->currency ?? 'تومان' }}</span>
                                    </div>
                                    <input type="number" name="max_price" id="max_price"
                                        value="{{ request('max_price') }}" placeholder="{{ __('Max Price') }}"
                                        class="block w-full pl-16 pr-3 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                </div>
                            </div>
                        </div>

                        <div
                            class="flex flex-col sm:flex-row justify-between items-center pt-6 border-t border-gray-200 space-y-3 sm:space-y-0 sm:space-x-4 space-x-reverse">
                            <div class="flex items-center space-x-4 space-x-reverse">
                                <button type="submit"
                                    class="inline-flex items-center px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-colors duration-200 shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z">
                                        </path>
                                    </svg>
                                    {{ __('Apply Filters') }}
                                </button>
                                <a href="{{ route('vehicles.index') }}"
                                    class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                        </path>
                                    </svg>
                                    {{ __('Clear Filters') }}
                                </a>
                            </div>

                            @if (request()->hasAny(['search', 'brand_id', 'model_id', 'status', 'year', 'min_price', 'max_price']))
                                <div class="text-sm text-gray-500">
                                    {{ __('Active filters applied') }}
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing enhanced filter system...');

            // Enhanced filter overlay functionality
            const filterToggle = document.getElementById('filter-toggle');
            const filterOverlay = document.getElementById('filter-overlay');
            const filterClose = document.getElementById('filter-close');
            const filterPanel = document.getElementById('filter-panel');
            const quickActions = document.getElementById('quick-actions');
            const sortSelect = document.getElementById('sort-select');

            // Filter overlay toggle
            if (filterToggle && filterOverlay && filterClose && filterPanel) {
                filterToggle.addEventListener('click', function() {
                    filterOverlay.classList.remove('hidden');
                    filterOverlay.classList.add('flex');
                    document.body.classList.add('overflow-hidden');

                    // Animate panel
                    setTimeout(() => {
                        filterPanel.classList.remove('scale-95', 'opacity-0');
                        filterPanel.classList.add('scale-100', 'opacity-100');
                    }, 10);
                });

                filterClose.addEventListener('click', function() {
                    closeFilterOverlay();
                });

                // Close overlay when clicking outside
                filterOverlay.addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeFilterOverlay();
                    }
                });

                function closeFilterOverlay() {
                    filterPanel.classList.remove('scale-100', 'opacity-100');
                    filterPanel.classList.add('scale-95', 'opacity-0');

                    setTimeout(() => {
                        filterOverlay.classList.remove('flex');
                        filterOverlay.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    }, 300);
                }
            }

            // Quick actions toggle
            if (filterToggle && quickActions) {
                let quickActionsVisible = false;

                filterToggle.addEventListener('click', function() {
                    if (!quickActionsVisible) {
                        quickActions.classList.remove('hidden');
                        quickActionsVisible = true;
                    } else {
                        quickActions.classList.add('hidden');
                        quickActionsVisible = false;
                    }
                });
            }

            // Sort functionality
            if (sortSelect) {
                sortSelect.addEventListener('change', function() {
                    const currentUrl = new URL(window.location);
                    const sortValue = this.value;

                    if (sortValue) {
                        currentUrl.searchParams.set('sort', sortValue);
                    } else {
                        currentUrl.searchParams.delete('sort');
                    }

                    window.location.href = currentUrl.toString();
                });
            }

            // Clear filters function
            window.clearFilters = function() {
                window.location.href = '{{ route('vehicles.index') }}';
            };

            // Initialize Select2 for brand and model (only if jQuery is available)
            if (typeof $ !== 'undefined' && typeof $.fn.select2 !== 'undefined') {
                console.log('jQuery and Select2 available, initializing...');

                $('.select2-brand').select2({
                    placeholder: '{{ __('Search and select brand...') }}',
                    allowClear: true,
                    width: '100%',
                    theme: 'default',
                    language: {
                        noResults: function() {
                            return '{{ __('No brands found') }}';
                        },
                        searching: function() {
                            return '{{ __('Searching...') }}';
                        }
                    },
                    ajax: {
                        url: '{{ route('vehicles.search-brands') }}',
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
                    placeholder: '{{ __('Search and select model...') }}',
                    allowClear: true,
                    width: '100%',
                    theme: 'default',
                    language: {
                        noResults: function() {
                            return '{{ __('No models found') }}';
                        },
                        searching: function() {
                            return '{{ __('Searching...') }}';
                        }
                    },
                    ajax: {
                        url: '{{ route('vehicles.search-models') }}',
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
                            placeholder: '{{ __('Search and select model...') }}',
                            allowClear: true,
                            width: '100%',
                            theme: 'default',
                            language: {
                                noResults: function() {
                                    return '{{ __('No models found') }}';
                                },
                                searching: function() {
                                    return '{{ __('Searching...') }}';
                                }
                            },
                            ajax: {
                                url: '{{ route('vehicles.search-models') }}',
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
            } else {
                console.log('jQuery or Select2 not available, skipping Select2 initialization');
            }

            // Add loading states for better UX
            const filterForm = document.querySelector('form[method="GET"]');
            if (filterForm) {
                filterForm.addEventListener('submit', function() {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.innerHTML = `
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            {{ __('Applying Filters...') }}
                        `;
                        submitBtn.disabled = true;
                    }
                });
            }
        });
    </script>
</x-app-layout>
