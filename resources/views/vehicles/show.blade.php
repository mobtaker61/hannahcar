<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $vehicle->full_name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('vehicles.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Back to Vehicles') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            {{ __('Home') }}
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('vehicles.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">{{ __('Vehicles') }}</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $vehicle->full_name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Vehicle Images Gallery -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                        <div class="relative">
                            @if($vehicle->featured_image)
                                <img src="{{ Storage::url($vehicle->featured_image) }}"
                                     alt="{{ $vehicle->full_name }}"
                                     class="w-full h-96 lg:h-[500px] object-cover">
                            @else
                                <div class="w-full h-96 lg:h-[500px] bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-gray-500 text-lg">{{ __('No Image Available') }}</span>
                                    </div>
                                </div>
                            @endif

                            <!-- Status Badge -->
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    {{ $vehicle->status === 'new' ? 'bg-green-100 text-green-800' :
                                       ($vehicle->status === 'used' ? 'bg-blue-100 text-blue-800' : 'bg-orange-100 text-orange-800') }}">
                                    {{ __(ucfirst($vehicle->status)) }}
                                </span>
                            </div>

                            <!-- Price Badge -->
                            <div class="absolute top-4 right-4">
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold bg-white/90 backdrop-blur-sm text-green-600 shadow-lg">
                                    {{ number_format($vehicle->price) }} {{ $vehicle->currency }}
                                </span>
                            </div>
                        </div>

                        <!-- Thumbnail Gallery -->
                        @if($vehicle->gallery && $vehicle->gallery->count() > 0)
                            <div class="p-4 bg-gray-50">
                                <div class="grid grid-cols-4 gap-3">
                                    @foreach($vehicle->gallery->take(4) as $image)
                                        <div class="relative group cursor-pointer">
                                            <img src="{{ Storage::url($image->image_path) }}"
                                                 alt="Gallery image"
                                                 class="w-full h-20 object-cover rounded-lg border-2 border-transparent group-hover:border-blue-500 transition-all duration-200">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Vehicle Information -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-6">
                                <div>
                                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                                        {{ $vehicle->full_name }}
                                    </h1>
                                    <p class="text-gray-600 text-lg">
                                        {{ $vehicle->year }} • {{ $vehicle->brand->name }} • {{ $vehicle->model->name }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <div class="text-3xl font-bold text-green-600 mb-1">
                                        {{ number_format($vehicle->price) }} {{ $vehicle->currency }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ __('Price includes VAT') }}
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Stats -->
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <div class="text-2xl font-bold text-gray-900">{{ $vehicle->year }}</div>
                                    <div class="text-sm text-gray-600">{{ __('Year') }}</div>
                                </div>
                                @if($vehicle->mileage)
                                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                                        <div class="text-2xl font-bold text-gray-900">{{ number_format($vehicle->mileage) }}</div>
                                        <div class="text-sm text-gray-600">{{ __('KM') }}</div>
                                    </div>
                                @endif
                                @if($vehicle->fuelType)
                                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                                        <div class="text-2xl font-bold text-gray-900">{{ $vehicle->fuelType->name }}</div>
                                        <div class="text-sm text-gray-600">{{ __('Fuel Type') }}</div>
                                    </div>
                                @endif
                                @if($vehicle->transmissionType)
                                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                                        <div class="text-2xl font-bold text-gray-900">{{ $vehicle->transmissionType->name }}</div>
                                        <div class="text-sm text-gray-600">{{ __('Transmission') }}</div>
                                    </div>
                                @endif
                            </div>

                            <!-- Specifications -->
                            @if($vehicle->regionalSpec || $vehicle->bodyType || $vehicle->fuelType || $vehicle->transmissionType)
                                <div class="mb-8">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ __('Vehicle Specifications') }}
                                    </h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        @if($vehicle->regionalSpec)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Regional Spec') }}</span>
                                                <span class="font-semibold text-gray-900">{{ $vehicle->regionalSpec->name }}</span>
                                            </div>
                                        @endif
                                        @if($vehicle->bodyType)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Body Type') }}</span>
                                                <span class="font-semibold text-gray-900">{{ $vehicle->bodyType->name }}</span>
                                            </div>
                                        @endif
                                        @if($vehicle->seatsCount)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Seats') }}</span>
                                                <span class="font-semibold text-gray-900">{{ $vehicle->seatsCount->count }}</span>
                                            </div>
                                        @endif
                                        @if($vehicle->fuelType)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Fuel Type') }}</span>
                                                <span class="font-semibold text-gray-900">{{ $vehicle->fuelType->name }}</span>
                                            </div>
                                        @endif
                                        @if($vehicle->transmissionType)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Transmission') }}</span>
                                                <span class="font-semibold text-gray-900">{{ $vehicle->transmissionType->name }}</span>
                                            </div>
                                        @endif
                                        @if($vehicle->engineCapacityRange)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Engine Capacity') }}</span>
                                                <span class="font-semibold text-gray-900">{{ $vehicle->engineCapacityRange->display_name }}</span>
                                            </div>
                                        @endif
                                        @if($vehicle->horsepowerRange)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Horsepower') }}</span>
                                                <span class="font-semibold text-gray-900">{{ $vehicle->horsepowerRange->display_name }}</span>
                                            </div>
                                        @endif
                                        @if($vehicle->cylindersCount)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Cylinders') }}</span>
                                                <span class="font-semibold text-gray-900">{{ $vehicle->cylindersCount->count }}</span>
                                            </div>
                                        @endif
                                        @if($vehicle->steeringSide)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Steering') }}</span>
                                                <span class="font-semibold text-gray-900">{{ $vehicle->steeringSide->name }}</span>
                                            </div>
                                        @endif
                                        @if($vehicle->exteriorColor)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Exterior Color') }}</span>
                                                <span class="font-semibold text-gray-900">{{ $vehicle->exteriorColor->name }}</span>
                                            </div>
                                        @endif
                                        @if($vehicle->interiorColor)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Interior Color') }}</span>
                                                <span class="font-semibold text-gray-900">{{ $vehicle->interiorColor->name }}</span>
                                            </div>
                                        @endif
                                        @if($vehicle->vin_number)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg md:col-span-2">
                                                <span class="text-gray-600 font-medium">{{ __('VIN Number') }}</span>
                                                <span class="font-mono text-sm text-gray-900">{{ $vehicle->vin_number }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- Description -->
                            @if($vehicle->description)
                                <div class="mb-8">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        {{ __('Description') }}
                                    </h3>
                                    <div class="prose max-w-none text-gray-700 leading-relaxed">
                                        {!! nl2br(e($vehicle->description)) !!}
                                    </div>
                                </div>
                            @endif

                            <!-- Features -->
                            @if($vehicle->features && count($vehicle->features) > 0)
                                <div class="mb-8">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        {{ __('Features & Options') }}
                                    </h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @foreach($vehicle->features as $feature)
                                            <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                                <svg class="w-5 h-5 text-green-600 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="text-gray-700">{{ $feature }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Contact & Actions -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6 sticky top-6">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                {{ __('Contact Seller') }}
                            </h3>

                            @if($vehicle->user)
                                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center mb-3">
                                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $vehicle->user->full_name }}</div>
                                            <div class="text-sm text-gray-600">{{ __('Verified Seller') }}</div>
                                        </div>
                                    </div>
                                    @if($vehicle->user->phone)
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                            {{ $vehicle->user->phone }}
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <div class="space-y-4">
                                <a href="tel:{{ $vehicle->user->phone ?? '' }}"
                                   class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-6 rounded-lg flex items-center justify-center transition-colors duration-200 shadow-lg">
                                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                    </svg>
                                    {{ __('Call Now') }}
                                </a>

                                <a href="https://wa.me/{{ $vehicle->user->phone ?? '' }}?text=I'm interested in {{ $vehicle->full_name }}"
                                   target="_blank"
                                   class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-6 rounded-lg flex items-center justify-center transition-colors duration-200 shadow-lg">
                                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"></path>
                                    </svg>
                                    {{ __('WhatsApp') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Share -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                </svg>
                                {{ __('Share This Vehicle') }}
                            </h3>
                            <div class="grid grid-cols-2 gap-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                   target="_blank"
                                   class="flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                    Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($vehicle->full_name) }}"
                                   target="_blank"
                                   class="flex items-center justify-center bg-blue-400 hover:bg-blue-500 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                    </svg>
                                    Twitter
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Vehicles -->
            @if($relatedVehicles->count() > 0)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden mt-8">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            {{ __('Similar Vehicles') }}
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($relatedVehicles as $relatedVehicle)
                                <div class="bg-gray-50 rounded-lg overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                                    <a href="{{ route('vehicles.show', $relatedVehicle) }}" class="block">
                                        @if($relatedVehicle->featured_image)
                                            <img src="{{ Storage::url($relatedVehicle->featured_image) }}"
                                                 alt="{{ $relatedVehicle->full_name }}"
                                                 class="w-full h-48 object-cover">
                                        @else
                                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                                <span class="text-gray-500">{{ __('No Image') }}</span>
                                            </div>
                                        @endif
                                        <div class="p-4">
                                            <h4 class="font-semibold text-gray-900 mb-2 hover:text-blue-600 transition-colors">
                                                {{ $relatedVehicle->full_name }}
                                            </h4>
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm text-gray-600">{{ $relatedVehicle->year }}</span>
                                                <span class="text-green-600 font-bold">
                                                    {{ number_format($relatedVehicle->price) }} {{ $relatedVehicle->currency }}
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
