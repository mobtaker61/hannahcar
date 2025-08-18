<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $vehicle->full_name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Edit') }}
                </a>
                <a href="{{ route('admin.vehicles.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Back to List') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <!-- Vehicle Image -->
                    <div class="mb-6">
                        @if($vehicle->featured_image)
                            <img src="{{ Storage::url($vehicle->featured_image) }}" alt="{{ $vehicle->full_name }}"
                                 class="w-full h-64 object-cover rounded-lg">
                        @else
                            <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                <svg class="h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Basic Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Basic Information') }}</h3>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Brand') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $vehicle->brand ? $vehicle->brand->name : __('N/A') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Model') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $vehicle->model ? $vehicle->model->name : __('N/A') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Year') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $vehicle->year }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Price') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $vehicle->formatted_price }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Mileage') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $vehicle->formatted_mileage ?? __('N/A') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Status') }}</dt>
                                    <dd class="text-sm text-gray-900">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            {{ $vehicle->status == 'new' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ $vehicle->status == 'new' ? __('New') : __('Used') }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Publish Status') }}</dt>
                                    <dd class="text-sm text-gray-900">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            {{ $vehicle->publish_status == 'published' ? 'bg-green-100 text-green-800' :
                                               ($vehicle->publish_status == 'draft' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($vehicle->publish_status) }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Featured') }}</dt>
                                    <dd class="text-sm text-gray-900">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            {{ $vehicle->is_featured ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $vehicle->is_featured ? __('Yes') : __('No') }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Available') }}</dt>
                                    <dd class="text-sm text-gray-900">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            {{ $vehicle->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $vehicle->is_available ? __('Yes') : __('No') }}
                                        </span>
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Specifications -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Specifications') }}</h3>
                            <dl class="space-y-3">
                                @if($vehicle->regionalSpec)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Regional Spec') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $vehicle->regionalSpec ? $vehicle->regionalSpec->name : __('N/A') }}</dd>
                                </div>
                                @endif

                                @if($vehicle->bodyType)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Body Type') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $vehicle->bodyType ? $vehicle->bodyType->name : __('N/A') }}</dd>
                                </div>
                                @endif

                                @if($vehicle->seatsCount)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Seats Count') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $vehicle->seatsCount ? $vehicle->seatsCount->count : __('N/A') }} {{ __('Seats') }}</dd>
                                </div>
                                @endif

                                @if($vehicle->fuelType)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Fuel Type') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $vehicle->fuelType ? $vehicle->fuelType->name : __('N/A') }}</dd>
                                </div>
                                @endif

                                @if($vehicle->transmissionType)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Transmission Type') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $vehicle->transmissionType ? $vehicle->transmissionType->name : __('N/A') }}</dd>
                                </div>
                                @endif

                                @if($vehicle->engineCapacityRange)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Engine Capacity') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $vehicle->engineCapacityRange ? $vehicle->engineCapacityRange->display_name : __('N/A') }}</dd>
                                </div>
                                @endif

                                @if($vehicle->horsepowerRange)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Horsepower') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $vehicle->horsepowerRange ? $vehicle->horsepowerRange->display_name : __('N/A') }}</dd>
                                </div>
                                @endif

                                @if($vehicle->cylindersCount)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Cylinders Count') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $vehicle->cylindersCount ? $vehicle->cylindersCount->count : __('N/A') }} {{ __('Cylinders') }}</dd>
                                </div>
                                @endif

                                @if($vehicle->steeringSide)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Steering Side') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $vehicle->steeringSide ? $vehicle->steeringSide->name : __('N/A') }}</dd>
                                </div>
                                @endif

                                @if($vehicle->exteriorColor)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Exterior Color') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $vehicle->exteriorColor ? $vehicle->exteriorColor->name : __('N/A') }}</dd>
                                </div>
                                @endif

                                @if($vehicle->interiorColor)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Interior Color') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $vehicle->interiorColor ? $vehicle->interiorColor->name : __('N/A') }}</dd>
                                </div>
                                @endif

                                @if($vehicle->vin_number)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('VIN Number') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $vehicle->vin_number }}</dd>
                                </div>
                                @endif
                            </dl>
                        </div>
                    </div>

                    <!-- Description -->
                    @if($vehicle->description)
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Description') }}</h3>
                        <p class="text-sm text-gray-900">{{ $vehicle->description }}</p>
                    </div>
                    @endif

                    <!-- Features -->
                    @if($vehicle->features_array && count($vehicle->features_array) > 0)
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Features') }}</h3>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($vehicle->features_array as $feature)
                                <li class="text-sm text-gray-900">{{ is_string($feature) ? $feature : (is_array($feature) ? json_encode($feature) : 'N/A') }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Gallery -->
                    @if($vehicle->gallery && $vehicle->gallery->count() > 0)
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Gallery') }}</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($vehicle->gallery as $image)
                                <img src="{{ Storage::url($image->image_path) }}" alt="{{ $image->alt_text ?? 'Gallery image' }}"
                                     class="w-full h-24 object-cover rounded-lg">
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Additional Information -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Additional Information') }}</h3>
                        <dl class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">{{ __('Views Count') }}</dt>
                                <dd class="text-sm text-gray-900">{{ number_format($vehicle->views_count) }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">{{ __('Created At') }}</dt>
                                <dd class="text-sm text-gray-900">{{ $vehicle->created_at->format('M d, Y H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">{{ __('Updated At') }}</dt>
                                <dd class="text-sm text-gray-900">{{ $vehicle->updated_at->format('M d, Y H:i') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
