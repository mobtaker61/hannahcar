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
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">{{ __('All Brands') }}</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
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
                        </div>

                        <!-- Price Range -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
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
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg hover:shadow-2xl transition-shadow duration-300">
                            <a href="{{ route('vehicles.show', $vehicle) }}" class="block">
                                @if($vehicle->featured_image)
                                    <img src="{{ Storage::url($vehicle->featured_image) }}"
                                         alt="{{ $vehicle->full_name }}"
                                         class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-500">{{ __('No Image') }}</span>
                                    </div>
                                @endif
                            </a>

                            <div class="p-4">
                                <h3 class="font-semibold text-gray-900 mb-2">
                                    <a href="{{ route('vehicles.show', $vehicle) }}" class="hover:text-blue-600">
                                        {{ $vehicle->full_name }}
                                    </a>
                                </h3>

                                <div class="space-y-2 mb-4">
                                    <div class="flex justify-between text-sm text-gray-600">
                                        <span>{{ __('Brand') }}:</span>
                                        <span>{{ $vehicle->brand->name }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm text-gray-600">
                                        <span>{{ __('Year') }}:</span>
                                        <span>{{ $vehicle->year }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm text-gray-600">
                                        <span>{{ __('Status') }}:</span>
                                        <span class="px-2 py-1 text-xs rounded-full
                                            @if($vehicle->status == 'new') bg-green-100 text-green-800
                                            @elseif($vehicle->status == 'used') bg-yellow-100 text-yellow-800
                                            @else bg-blue-100 text-blue-800 @endif">
                                            {{ __(ucfirst($vehicle->status)) }}
                                        </span>
                                    </div>
                                    @if($vehicle->mileage)
                                        <div class="flex justify-between text-sm text-gray-600">
                                            <span>{{ __('Mileage') }}:</span>
                                            <span>{{ number_format($vehicle->mileage) }} km</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="text-xl font-bold text-green-600">
                                        {{ number_format($vehicle->price) }} {{ $vehicle->currency }}
                                    </span>
                                    @if($vehicle->is_featured)
                                        <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">
                                            {{ __('Featured') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('vehicles.show', $vehicle) }}"
                                       class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-center block">
                                        {{ __('View Details') }}
                                    </a>
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
</x-app-layout>
