<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

        <!-- Hero Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Side - Vehicle Info -->
                <div class="text-white space-y-6">
                    <!-- Vehicle Title -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            @if($vehicle->brand && $vehicle->brand->logo)
                                <img src="{{ Storage::url($vehicle->brand->logo) }}" alt="{{ $vehicle->brand->name }}" class="w-12 h-12 object-contain bg-white/10 rounded-lg p-2">
                            @endif
                            <div>
                                <p class="text-xl text-gray-300 mt-2">
                                    {{ $vehicle->year }} • {{ $vehicle->brand->name ?? '' }} • {{ $vehicle->model->name ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @if($vehicle->year)
                            <div class="text-center p-4 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20">
                                <div class="text-2xl font-bold">{{ $vehicle->year }}</div>
                                <div class="text-sm text-gray-300">{{ __('Year') }}</div>
                            </div>
                        @endif
                        @if($vehicle->mileage)
                            <div class="text-center p-4 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20">
                                <div class="text-2xl font-bold">{{ number_format($vehicle->mileage) }}</div>
                                <div class="text-sm text-gray-300">{{ __('KM') }}</div>
                            </div>
                        @endif
                        @if($vehicle->fuelType)
                            <div class="text-center p-4 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20">
                                <div class="text-2xl font-bold">{{ $vehicle->fuelType->name }}</div>
                                <div class="text-sm text-gray-300">{{ __('Fuel') }}</div>
                            </div>
                        @endif
                        @if($vehicle->transmissionType)
                            <div class="text-center p-4 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20">
                                <div class="text-2xl font-bold">{{ $vehicle->transmissionType->name }}</div>
                                <div class="text-sm text-gray-300">{{ __('Transmission') }}</div>
                            </div>
                        @endif
                    </div>

                    <!-- Price and Actions -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-4 sm:space-y-0 sm:space-x-6">
                        <div class="text-center sm:text-left">
                            <div class="text-4xl font-bold text-green-400 mb-1">
                                {{ number_format($vehicle->price) }} {{ $vehicle->currency }}
                            </div>
                            <div class="text-sm text-gray-300">{{ __('Price includes VAT') }}</div>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('vehicles.index') }}" class="bg-white/20 hover:bg-white/30 text-white font-semibold py-3 px-6 rounded-xl border border-white/30 transition-all duration-200 hover:scale-105 backdrop-blur-sm">
                                {{ __('Back to Vehicles') }}
                            </a>
                            @if($vehicle->user && $vehicle->user->phone)
                                <a href="tel:{{ $vehicle->user->phone }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 hover:scale-105 shadow-lg">
                                    {{ __('Call Now') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Side - Hero Image -->
                <div class="relative">
                    @if($vehicle->featured_image)
                        <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                            <img src="{{ Storage::url($vehicle->featured_image) }}"
                                 alt="{{ $vehicle->full_name }}"
                                 class="w-full h-80 lg:h-96 object-cover transform hover:scale-105 transition-transform duration-700">

                            <!-- Status Badge -->
                            <div class="absolute top-4 left-4 z-10">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    {{ $vehicle->status === 'new' ? 'bg-green-500 text-white' :
                                       ($vehicle->status === 'used' ? 'bg-blue-500 text-white' : 'bg-orange-500 text-white') }}">
                                    {{ __(ucfirst($vehicle->status)) }}
                                </span>
                            </div>

                            <!-- Price Badge -->
                            <div class="absolute top-4 right-4 z-10">
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold bg-white/95 backdrop-blur-sm text-green-600 shadow-lg">
                                    {{ number_format($vehicle->price) }} {{ $vehicle->currency }}
                                </span>
                            </div>

                            <!-- Overlay Gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>
                        </div>
                    @else
                        <div class="w-full h-80 lg:h-96 bg-gradient-to-br from-gray-700 to-gray-800 rounded-2xl flex items-center justify-center border-2 border-white/20">
                            <div class="text-center text-white/60">
                                <svg class="w-20 h-20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-xl">{{ __('No Image Available') }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS for Gallery -->
    <style>
        /* Hide scrollbar */
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        /* Thumbnail styles */
        .thumbnail-item {
            transition: all 0.3s ease;
            min-width: 96px;
            cursor: pointer;
            flex-shrink: 0;
            position: relative;
        }

        .thumbnail-item:hover {
            transform: translateY(-2px);
        }

        .thumbnail-item.active {
            transform: scale(1.05);
            z-index: 10;
        }

        /* Carousel item styles */
        .carousel-item {
            transition: opacity 0.5s ease-in-out;
        }

        .carousel-item.hidden {
            opacity: 0;
            pointer-events: none;
            display: none !important;
        }

        .carousel-item:not(.hidden) {
            opacity: 1;
            display: block !important;
        }

        /* Thumbnail container */
        .thumbnail-container {
            display: flex;
            gap: 12px;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding-bottom: 8px;
            -webkit-overflow-scrolling: touch;
            /* For iOS smooth scrolling */
            position: relative;
        }

        /* Ensure smooth scrolling */
        .overflow-x-auto {
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        /* Custom scrollbar for thumbnails */
        .overflow-x-auto::-webkit-scrollbar {
            height: 6px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Zoom effect on main image */
        .main-image-container {
            overflow: hidden;
            border-radius: 0.75rem;
        }

        .main-image-container img {
            transition: transform 0.3s ease;
        }

        .main-image-container:hover img {
            transform: scale(1.05);
        }

        /* Navigation buttons */
        .carousel-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 50%;
            padding: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            z-index: 20;
        }

        .carousel-nav-btn:hover {
            background: white;
            transform: translateY(-50%) scale(1.1);
        }

        .carousel-nav-btn.prev {
            left: 16px;
        }

        .carousel-nav-btn.next {
            right: 16px;
        }

        /* Indicators */
        .carousel-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .carousel-indicator.active {
            background-color: white;
        }

        .carousel-indicator.inactive {
            background-color: rgba(255, 255, 255, 0.5);
        }

        /* 360 View Card Styles */
        .view360-iframe {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .view360-iframe:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        /* Aspect ratio container */
        .aspect-w-16 {
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 aspect ratio */
        }

        .aspect-w-16 iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Vehicle Images Gallery -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                        <div class="relative">
                            <!-- Main Image Carousel -->
                            <div id="mainCarousel" class="relative main-image-container">
                                @if ($vehicle->gallery && $vehicle->gallery->count() > 0)
                                    @foreach ($vehicle->gallery as $index => $image)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : 'hidden' }}"
                                            data-index="{{ $index }}">
                                            <img src="{{ Storage::url($image->image_path) }}"
                                                alt="Gallery image {{ $index + 1 }}"
                                                class="w-full h-96 lg:h-[500px] object-cover">
                                        </div>
                                    @endforeach
                                @elseif($vehicle->featured_image)
                                    <div class="carousel-item active">
                                        <img src="{{ Storage::url($vehicle->featured_image) }}"
                                            alt="{{ $vehicle->full_name }}"
                                            class="w-full h-96 lg:h-[500px] object-cover">
                                    </div>
                                @else
                                    <div class="carousel-item active">
                                        <div
                                            class="w-full h-96 lg:h-[500px] bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                            <div class="text-center">
                                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                <span
                                                    class="text-gray-500 text-lg">{{ __('No Image Available') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Carousel Navigation -->
                                @if ($vehicle->gallery && $vehicle->gallery->count() > 1)
                                    <button id="prevBtn" class="carousel-nav-btn prev">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                    </button>
                                    <button id="nextBtn" class="carousel-nav-btn next">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </button>

                                    <!-- Carousel Indicators -->
                                    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                                        @foreach ($vehicle->gallery as $index => $image)
                                            <button
                                                class="carousel-indicator {{ $index === 0 ? 'active' : 'inactive' }}"
                                                data-index="{{ $index }}"></button>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <!-- Status Badge -->
                            <div class="absolute top-4 left-4 z-10">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    {{ $vehicle->status === 'new'
                                        ? 'bg-green-100 text-green-800'
                                        : ($vehicle->status === 'used'
                                            ? 'bg-blue-100 text-blue-800'
                                            : 'bg-orange-100 text-orange-800') }}">
                                    {{ __(ucfirst($vehicle->status)) }}
                                </span>
                            </div>

                            <!-- Price Badge -->
                            <div class="absolute top-4 right-4 z-10">
                                <span
                                    class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold bg-white/90 backdrop-blur-sm text-green-600 shadow-lg">
                                    {{ number_format($vehicle->price) }} {{ $vehicle->currency }}
                                </span>
                            </div>

                            <!-- Zoom Button -->
                            @if ($vehicle->gallery && $vehicle->gallery->count() > 0)
                                <div class="absolute bottom-4 right-4 z-10">
                                    <button id="zoomBtn"
                                        class="bg-white/80 hover:bg-white text-gray-800 p-3 rounded-full shadow-lg transition-all duration-200 hover:scale-110">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <!-- Thumbnail Gallery with Horizontal Scroll -->
                        @if ($vehicle->gallery && $vehicle->gallery->count() > 0)
                            <div class="p-4 bg-gray-50">
                                <div class="flex space-x-3 overflow-x-auto scrollbar-hide pb-2"
                                    style="scroll-behavior: smooth;">
                                    @foreach ($vehicle->gallery as $index => $image)
                                        <div class="thumbnail-item flex-shrink-0 cursor-pointer group {{ $index === 0 ? 'ring-2 ring-blue-500 active' : '' }}"
                                            data-index="{{ $index }}">
                                            <img src="{{ Storage::url($image->image_path) }}"
                                                alt="Gallery thumbnail {{ $index + 1 }}"
                                                class="w-24 h-20 object-cover rounded-lg border-2 border-transparent group-hover:border-blue-500 transition-all duration-200 hover:scale-105">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Fullscreen Modal -->
                    <div id="fullscreenModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden">
                        <div class="relative w-full h-full flex items-center justify-center">
                            <!-- Fullscreen Image -->
                            <div id="fullscreenImage" class="relative max-w-7xl max-h-full">
                                <img id="fullscreenImg" src="" alt="Fullscreen image"
                                    class="max-w-full max-h-full object-contain">

                                <!-- Fullscreen Navigation -->
                                <button id="fullscreenPrev"
                                    class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 p-3 rounded-full shadow-lg transition-all duration-200 hover:scale-110">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                                <button id="fullscreenNext"
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 p-3 rounded-full shadow-lg transition-all duration-200 hover:scale-110">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>

                                <!-- Close Button -->
                                <button id="closeFullscreen"
                                    class="absolute top-4 right-4 bg-white/80 hover:bg-white text-gray-800 p-3 rounded-full shadow-lg transition-all duration-200 hover:scale-110">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>

                                <!-- Image Counter -->
                                <div
                                    class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-black/50 text-white px-4 py-2 rounded-full text-sm">
                                    <span id="fullscreenCounter"></span>
                                </div>
                            </div>
                        </div>
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
                                        {{ $vehicle->year }} • {{ $vehicle->brand->name }} •
                                        {{ $vehicle->model->name }}
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
                                @if ($vehicle->mileage)
                                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                                        <div class="text-2xl font-bold text-gray-900">
                                            {{ number_format($vehicle->mileage) }}</div>
                                        <div class="text-sm text-gray-600">{{ __('KM') }}</div>
                                    </div>
                                @endif
                                @if ($vehicle->fuelType)
                                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                                        <div class="text-2xl font-bold text-gray-900">{{ $vehicle->fuelType->name }}
                                        </div>
                                        <div class="text-sm text-gray-600">{{ __('Fuel Type') }}</div>
                                    </div>
                                @endif
                                @if ($vehicle->transmissionType)
                                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                                        <div class="text-2xl font-bold text-gray-900">
                                            {{ $vehicle->transmissionType->name }}</div>
                                        <div class="text-sm text-gray-600">{{ __('Transmission') }}</div>
                                    </div>
                                @endif
                            </div>

                            <!-- Specifications -->
                            @if ($vehicle->regionalSpec || $vehicle->bodyType || $vehicle->fuelType || $vehicle->transmissionType)
                                <div class="mb-8">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ __('Vehicle Specifications') }}
                                    </h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        @if ($vehicle->regionalSpec)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span
                                                    class="text-gray-600 font-medium">{{ __('Regional Spec') }}</span>
                                                <span
                                                    class="font-semibold text-gray-900">{{ $vehicle->regionalSpec->name }}</span>
                                            </div>
                                        @endif
                                        @if ($vehicle->bodyType)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Body Type') }}</span>
                                                <span
                                                    class="font-semibold text-gray-900">{{ $vehicle->bodyType->name }}</span>
                                            </div>
                                        @endif
                                        @if ($vehicle->seatsCount)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Seats') }}</span>
                                                <span
                                                    class="font-semibold text-gray-900">{{ $vehicle->seatsCount->count }}</span>
                                            </div>
                                        @endif
                                        @if ($vehicle->fuelType)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Fuel Type') }}</span>
                                                <span
                                                    class="font-semibold text-gray-900">{{ $vehicle->fuelType->name }}</span>
                                            </div>
                                        @endif
                                        @if ($vehicle->transmissionType)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span
                                                    class="text-gray-600 font-medium">{{ __('Transmission') }}</span>
                                                <span
                                                    class="font-semibold text-gray-900">{{ $vehicle->transmissionType->name }}</span>
                                            </div>
                                        @endif
                                        @if ($vehicle->engineCapacityRange)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span
                                                    class="text-gray-600 font-medium">{{ __('Engine Capacity') }}</span>
                                                <span
                                                    class="font-semibold text-gray-900">{{ $vehicle->engineCapacityRange->display_name }}</span>
                                            </div>
                                        @endif
                                        @if ($vehicle->horsepowerRange)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Horsepower') }}</span>
                                                <span
                                                    class="font-semibold text-gray-900">{{ $vehicle->horsepowerRange->display_name }}</span>
                                            </div>
                                        @endif
                                        @if ($vehicle->cylindersCount)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Cylinders') }}</span>
                                                <span
                                                    class="font-semibold text-gray-900">{{ $vehicle->cylindersCount->count }}</span>
                                            </div>
                                        @endif
                                        @if ($vehicle->steeringSide)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Steering') }}</span>
                                                <span
                                                    class="font-semibold text-gray-900">{{ $vehicle->steeringSide->name }}</span>
                                            </div>
                                        @endif
                                        @if ($vehicle->exteriorColor)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span
                                                    class="text-gray-600 font-medium">{{ __('Exterior Color') }}</span>
                                                <span
                                                    class="font-semibold text-gray-900">{{ $vehicle->exteriorColor->name }}</span>
                                            </div>
                                        @endif
                                        @if ($vehicle->interiorColor)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span
                                                    class="text-gray-600 font-medium">{{ __('Interior Color') }}</span>
                                                <span
                                                    class="font-semibold text-gray-900">{{ $vehicle->interiorColor->name }}</span>
                                            </div>
                                        @endif
                                        @if ($vehicle->vin_number)
                                            <div
                                                class="flex items-center justify-between p-4 bg-gray-50 rounded-lg md:col-span-2">
                                                <span class="text-gray-600 font-medium">{{ __('VIN Number') }}</span>
                                                <span
                                                    class="font-mono text-sm text-gray-900">{{ $vehicle->vin_number }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- Description -->
                            @if ($vehicle->description)
                                <div class="mb-8">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        {{ __('Description') }}
                                    </h3>
                                    <div class="prose max-w-none text-gray-700 leading-relaxed">
                                        {!! nl2br(e($vehicle->description)) !!}
                                    </div>
                                </div>
                            @endif

                            <!-- Features -->
                            @if ($filteredFeatures && count($filteredFeatures) > 0)
                                <div class="mb-8">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        {{ __('Features & Options') }}
                                    </h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @foreach ($filteredFeatures as $feature)
                                            <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                                <svg class="w-5 h-5 text-green-600 mr-3 flex-shrink-0"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <span
                                                    class="text-gray-700">{{ is_string($feature) ? $feature : (is_array($feature) ? json_encode($feature) : 'N/A') }}</span>
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
                    <!-- 360 View Card -->
                    @if ($view360Url)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ __('360View') }}
                                </h3>
                                <div class="aspect-w-16 aspect-h-9 mb-4">
                                    <iframe src="{{ $view360Url }}" class="view360-iframe" frameborder="0" allowfullscreen loading="lazy">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Contact & Actions -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6 sticky top-6">
                        <div class="p-6">
                            <h2 class="font-bold leading-tight text-center mb-4">{{ $vehicle->full_name }}</h2>

                            <div class="text-center sm:text-left mb-4">
                                <div class="text-4xl font-bold text-green-400 mb-1">
                                    {{ number_format($vehicle->price) }} {{ $vehicle->currency }}
                                </div>
                                <div class="text-sm text-gray-300">{{ __('Price includes VAT') }}</div>
                            </div>

                            @if ($vehicle->user)
                                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center mb-3">
                                        <div
                                            class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $vehicle->user->full_name }}
                                            </div>
                                            <div class="text-sm text-gray-600">{{ __('Verified Seller') }}</div>
                                        </div>
                                    </div>
                                    @if ($vehicle->user->phone)
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                </path>
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
                                        <path
                                            d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z">
                                        </path>
                                    </svg>
                                    {{ __('Call Now') }}
                                </a>

                                <a href="https://wa.me/{{ $vehicle->user->phone ?? '' }}?text=I'm interested in {{ $vehicle->full_name }}"
                                    target="_blank"
                                    class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-6 rounded-lg flex items-center justify-center transition-colors duration-200 shadow-lg">
                                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488">
                                        </path>
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
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z">
                                    </path>
                                </svg>
                                {{ __('Share This Vehicle') }}
                            </h3>
                            <div class="grid grid-cols-2 gap-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                    target="_blank"
                                    class="flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                    </svg>
                                    Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($vehicle->full_name) }}"
                                    target="_blank"
                                    class="flex items-center justify-center bg-blue-400 hover:bg-blue-500 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                    </svg>
                                    Twitter
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Vehicles -->
            @if ($relatedVehicles->count() > 0)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden mt-8">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                            {{ __('Similar Vehicles') }}
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($relatedVehicles as $relatedVehicle)
                                <div
                                    class="bg-gray-50 rounded-lg overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                                    <a href="{{ route('vehicles.show', $relatedVehicle) }}" class="block">
                                        @if ($relatedVehicle->featured_image)
                                            <img src="{{ Storage::url($relatedVehicle->featured_image) }}"
                                                alt="{{ $relatedVehicle->full_name }}"
                                                class="w-full h-48 object-cover">
                                        @else
                                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                                <span class="text-gray-500">{{ __('No Image') }}</span>
                                            </div>
                                        @endif
                                        <div class="p-4">
                                            <h4
                                                class="font-semibold text-gray-900 mb-2 hover:text-blue-600 transition-colors">
                                                {{ $relatedVehicle->full_name }}
                                            </h4>
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm text-gray-600">{{ $relatedVehicle->year }}</span>
                                                <span class="text-green-600 font-bold">
                                                    {{ number_format($relatedVehicle->price) }}
                                                    {{ $relatedVehicle->currency }}
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

    <!-- Carousel JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing carousel...');

            const carousel = document.getElementById('mainCarousel');
            console.log('Carousel element:', carousel);

            if (!carousel) {
                console.error('Carousel not found!');
                return;
            }

            const items = carousel.querySelectorAll('.carousel-item');
            const indicators = carousel.querySelectorAll('.carousel-indicator');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const thumbnails = document.querySelectorAll('.thumbnail-item');
            const zoomBtn = document.getElementById('zoomBtn');

            console.log('Found elements:', {
                items: items.length,
                indicators: indicators.length,
                prevBtn: !!prevBtn,
                nextBtn: !!nextBtn,
                thumbnails: thumbnails.length,
                zoomBtn: !!zoomBtn
            });

            let currentIndex = 0;
            let interval;

            // Function to show specific slide
            function showSlide(index) {
                console.log('Showing slide:', index);

                // Hide all slides
                items.forEach(item => {
                    item.classList.add('hidden');
                    item.style.display = 'none';
                });

                // Show current slide
                if (items[index]) {
                    items[index].classList.remove('hidden');
                    items[index].style.display = 'block';
                }

                // Update indicators
                indicators.forEach(indicator => {
                    indicator.classList.remove('active', 'inactive');
                    indicator.classList.add('inactive');
                });

                if (indicators[index]) {
                    indicators[index].classList.remove('inactive');
                    indicators[index].classList.add('active');
                }

                // Update thumbnails
                thumbnails.forEach(thumb => {
                    thumb.classList.remove('ring-2', 'ring-blue-500', 'active');
                });

                if (thumbnails[index]) {
                    thumbnails[index].classList.add('ring-2', 'ring-blue-500', 'active');

                    // Scroll thumbnail into view
                    scrollThumbnailIntoView(index);

                    // Fallback: ensure thumbnail is visible
                    setTimeout(() => {
                        ensureThumbnailVisible(index);
                    }, 100);
                }

                currentIndex = index;
            }

            // Function to scroll thumbnail into view
            function scrollThumbnailIntoView(index) {
                const thumbnail = thumbnails[index];
                if (thumbnail) {
                    const container = thumbnail.closest('.overflow-x-auto');
                    if (container) {
                        // محاسبه موقعیت دقیق برای center کردن
                        const containerWidth = container.offsetWidth;
                        const thumbnailWidth = thumbnail.offsetWidth;
                        const thumbnailLeft = thumbnail.offsetLeft;

                        // محاسبه scroll position برای center کردن thumbnail
                        const targetScrollLeft = thumbnailLeft - (containerWidth / 2) + (thumbnailWidth / 2);

                        // اعمال scroll با محدودیت
                        const maxScrollLeft = container.scrollWidth - containerWidth;
                        const finalScrollLeft = Math.max(0, Math.min(targetScrollLeft, maxScrollLeft));

                        // فقط اگر container در view باشد، scroll کنیم
                        const containerRect = container.getBoundingClientRect();
                        const isContainerVisible = containerRect.top < window.innerHeight && containerRect.bottom >
                            0;

                        if (isContainerVisible) {
                            container.scrollTo({
                                left: finalScrollLeft,
                                behavior: 'smooth'
                            });

                            console.log('Scrolling thumbnail to center:', {
                                index: index,
                                containerWidth: containerWidth,
                                thumbnailLeft: thumbnailLeft,
                                targetScrollLeft: targetScrollLeft,
                                finalScrollLeft: finalScrollLeft,
                                maxScrollLeft: maxScrollLeft,
                                isContainerVisible: isContainerVisible
                            });
                        }
                    }
                }
            }

            // Function to ensure thumbnail is visible (fallback)
            function ensureThumbnailVisible(index) {
                const thumbnail = thumbnails[index];
                if (thumbnail) {
                    const container = thumbnail.closest('.overflow-x-auto');
                    if (container) {
                        // فقط اگر container در view باشد، scroll کنیم
                        const containerRect = container.getBoundingClientRect();
                        const isContainerVisible = containerRect.top < window.innerHeight && containerRect.bottom >
                            0;

                        if (isContainerVisible) {
                            // روش ساده‌تر: scroll تا thumbnail کاملاً visible باشد
                            thumbnail.scrollIntoView({
                                behavior: 'smooth',
                                block: 'nearest',
                                inline: 'center'
                            });
                        }
                    }
                }
            }

            // Function to show next slide (RTL: previous image)
            function nextSlide() {
                const nextIndex = (currentIndex - 1 + items.length) % items.length;
                showSlide(nextIndex);
            }

            // Function to show previous slide (RTL: next image)
            function prevSlide() {
                const prevIndex = (currentIndex + 1) % items.length;
                showSlide(prevIndex);
            }

            // Start auto-play
            function startAutoPlay() {
                if (items.length > 1) {
                    interval = setInterval(prevSlide, 3000); // Change every 3 seconds - use prevSlide for RTL
                    console.log('Auto-play started');
                }
            }

            // Stop auto-play
            function stopAutoPlay() {
                if (interval) {
                    clearInterval(interval);
                    console.log('Auto-play stopped');
                }
            }

            // Event listeners for navigation buttons (RTL corrected)
            if (prevBtn) {
                prevBtn.addEventListener('click', function() {
                    console.log('Prev button clicked');
                    prevSlide();
                    stopAutoPlay();
                    startAutoPlay();
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', function() {
                    console.log('Next button clicked');
                    nextSlide();
                    stopAutoPlay();
                    startAutoPlay();
                });
            }

            // Event listeners for indicators
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', function() {
                    console.log('Indicator clicked:', index);
                    showSlide(index);
                    stopAutoPlay();
                    startAutoPlay();
                });
            });

            // Event listeners for thumbnails
            thumbnails.forEach((thumbnail, index) => {
                thumbnail.addEventListener('click', function() {
                    console.log('Thumbnail clicked:', index);
                    showSlide(index);
                    stopAutoPlay();
                    startAutoPlay();
                });
            });

            // Pause auto-play on hover
            carousel.addEventListener('mouseenter', function() {
                console.log('Mouse enter carousel');
                stopAutoPlay();
            });

            carousel.addEventListener('mouseleave', function() {
                console.log('Mouse leave carousel');
                startAutoPlay();
            });

            // Start auto-play initially
            if (items.length > 1) {
                startAutoPlay();
            }

            // Show first slide initially
            showSlide(0);

            console.log('Carousel initialization complete');
        });
    </script>
</x-app-layout>
