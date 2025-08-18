<div>
    <!-- Custom CSS for Multi Image Carousel -->
    <style>
        .vehicle-slider {
            position: relative;
            overflow: hidden;
            min-height: 400px;
        }

        .carousel-container {
            display: flex;
            gap: 24px;
            overflow-x: auto;
            scroll-behavior: smooth;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            padding: 0 12px;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        .carousel-container::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .carousel-container {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .vehicle-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            flex-shrink: 0;
            scroll-snap-align: start;
            width: calc(25% - 18px); /* 4 items per row with gap consideration */
            min-width: 280px; /* Minimum width for mobile */
        }

        .vehicle-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .vehicle-image {
            width: 100%;
            height: 192px;
            object-fit: cover;
        }

        .vehicle-info {
            padding: 16px;
        }

        .vehicle-name {
            font-size: 18px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .vehicle-details {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 12px;
        }

        .vehicle-price {
            font-size: 20px;
            font-weight: bold;
            color: #059669;
        }

        .slider-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            padding: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 20;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .slider-nav-btn:hover:not(:disabled) {
            background: white;
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .slider-nav-btn:disabled {
            opacity: 0.25;
            cursor: not-allowed;
        }

        .slider-dots {
            display: flex;
            justify-content: center;
            margin-top: 24px;
        }

        .slider-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 0 4px;
        }

        .slider-dot.active {
            background-color: #2563eb;
            transform: scale(1.2);
        }

        .slider-dot.inactive {
            background-color: #d1d5db;
        }

        .slider-dot:hover {
            background-color: #9ca3af;
        }

        /* Responsive design */
        @media (max-width: 1200px) {
            .vehicle-card {
                width: calc(33.333% - 16px); /* 3 items per row */
                min-width: 250px;
            }
        }

        @media (max-width: 768px) {
            .vehicle-card {
                width: calc(50% - 12px); /* 2 items per row */
                min-width: 200px;
            }

            .carousel-container {
                gap: 16px;
                padding: 0 8px;
            }
        }

        @media (max-width: 640px) {
            .vehicle-card {
                width: calc(100% - 8px); /* 1 item per row */
                min-width: 180px;
            }

            .carousel-container {
                gap: 12px;
                padding: 0 4px;
            }
        }

        /* Touch and scroll improvements */
        .carousel-container {
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        .vehicle-card {
            scroll-snap-align: start;
        }
    </style>

    <!-- Search and Filter Row -->
    <div class="flex {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'flex-row-reverse' : 'flex-row' }} justify-between items-center mb-8">
        <!-- Filter Tabs -->
        <div class="flex {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'space-x-reverse space-x-8' : 'space-x-8' }}">
            <button wire:click="setActiveTab('all')"
                    class="relative py-2 px-4 text-sm font-medium transition-all duration-300 {{ $activeTab === 'all' ? 'text-black font-semibold' : 'text-gray-500 hover:text-gray-700' }}">
                {{ __('Latest') }}
                @if($activeTab === 'all')
                    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-blue-600"></div>
                @endif
            </button>
            <button wire:click="setActiveTab('new')"
                    class="relative py-2 px-4 text-sm font-medium transition-all duration-300 {{ $activeTab === 'new' ? 'text-black font-semibold' : 'text-gray-500 hover:text-gray-700' }}">
                {{ __('Brand New') }}
                @if($activeTab === 'new')
                    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-blue-600"></div>
                @endif
            </button>
            <button wire:click="setActiveTab('used')"
                    class="relative py-2 px-4 text-sm font-medium transition-all duration-300 {{ $activeTab === 'used' ? 'text-black font-semibold' : 'text-gray-500 hover:text-gray-700' }}">
                {{ __('Used') }}
                @if($activeTab === 'used')
                    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-blue-600"></div>
                @endif
            </button>
            <button wire:click="setActiveTab('export')"
                    class="relative py-2 px-4 text-sm font-medium transition-all duration-300 {{ $activeTab === 'export' ? 'text-black font-semibold' : 'text-gray-500 hover:text-gray-700' }}">
                {{ __('Export') }}
                @if($activeTab === 'export')
                    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-blue-600"></div>
                @endif
            </button>
        </div>

        <!-- Search Bar -->
        <div class="relative w-96">
            <input wire:model.live.debounce.500ms="searchQuery"
                   type="text"
                   placeholder="{{ __('Search for your dream car') }}"
                   class="w-full {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'pr-12 pl-4' : 'pl-12 pr-4' }} py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 text-gray-900 placeholder-gray-500">
            <div class="absolute inset-y-0 {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'right-0 pr-4' : 'left-0 pl-4' }} flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </div>
        </div>
    </div>

    <!-- Vehicle Slider -->
    <div class="relative vehicle-slider"
         x-data="{
             currentIndex: 0,
             maxScrollWidth: 0,

             init() {
                 this.$nextTick(() => {
                     this.updateMaxScrollWidth();
                     console.log('Carousel initialized');
                 });
             },

             movePrev() {
                 if (this.currentIndex > 0) {
                     this.currentIndex--;
                     this.scrollToIndex();
                 }
             },

             moveNext() {
                 if (this.currentIndex < this.maxScrollWidth) {
                     this.currentIndex++;
                     this.scrollToIndex();
                 }
             },

             scrollToIndex() {
                 const carousel = this.$refs.carousel;
                 if (carousel) {
                     const itemWidth = carousel.offsetWidth / 4; // 4 items visible at once
                     carousel.scrollLeft = itemWidth * this.currentIndex;
                 }
             },

             updateMaxScrollWidth() {
                 const carousel = this.$refs.carousel;
                 if (carousel) {
                     this.maxScrollWidth = Math.max(0, carousel.scrollWidth - carousel.offsetWidth);
                     console.log('Max scroll width:', this.maxScrollWidth);
                 }
             },

             isDisabled(direction) {
                 if (direction === 'prev') {
                     return this.currentIndex <= 0;
                 }
                 if (direction === 'next') {
                     return this.currentIndex >= Math.ceil(this.maxScrollWidth / (this.$refs.carousel?.offsetWidth / 4));
                 }
                 return false;
             }
         }"
         wire:ignore
         wire:key="vehicle-slider-{{ $activeTab }}-{{ count($vehicles) }}">

        <div class="relative overflow-hidden">
            <!-- Navigation Arrows -->
            @if(count($vehicles) > 4)
                <button @click="movePrev()"
                        :disabled="isDisabled('prev')"
                        class="slider-nav-btn {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'right-4' : 'left-4' }} disabled:opacity-25 disabled:cursor-not-allowed">
                    <i class="fas fa-chevron-{{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'right' : 'left' }}"></i>
                </button>

                <button @click="moveNext()"
                        :disabled="isDisabled('next')"
                        class="slider-nav-btn {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'left-4' : 'right-4' }} disabled:opacity-25 disabled:cursor-not-allowed">
                    <i class="fas fa-chevron-{{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'left' : 'right' }}"></i>
                </button>
            @endif

            <!-- Carousel Container -->
            <div x-ref="carousel"
                 class="carousel-container relative flex gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory touch-pan-x"
                 style="scrollbar-width: none; -ms-overflow-style: none;">

                @if(count($vehicles) > 0)
                    @foreach($vehicles as $vehicle)
                        <div class="vehicle-card flex-shrink-0 snap-start">
                            <a href="{{ route('vehicles.show', $vehicle['slug']) }}" class="block">
                                <!-- Vehicle Image -->
                                <div class="relative">
                                    <img src="{{ $vehicle['image'] }}"
                                         alt="{{ $vehicle['name'] }}"
                                         class="vehicle-image">
                                    <div class="absolute top-3 {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'right-3' : 'left-3' }} bg-white/90 backdrop-blur-sm text-gray-800 px-2 py-1 rounded text-xs font-medium">
                                        {{ $vehicle['year'] }}
                                    </div>
                                </div>

                                <!-- Vehicle Info -->
                                <div class="vehicle-info">
                                    <!-- Vehicle Name -->
                                    <h3 class="vehicle-name">{{ $vehicle['name'] }}</h3>

                                    <!-- Vehicle Details -->
                                    <div class="vehicle-details">
                                        {{ $vehicle['year'] }} | {{ $vehicle['km'] }} km
                                    </div>

                                    <!-- Price -->
                                    <div class="vehicle-price">
                                        {{ number_format($vehicle['price']) }} {{ $vehicle['currency'] }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <!-- No vehicles message -->
                    <div class="flex items-center justify-center h-64 w-full">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-gray-500 text-lg">{{ __('No vehicles found') }}</p>
                            <p class="text-gray-400 text-sm">{{ __('Try changing your search criteria') }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Dots Indicator -->
        @if(count($vehicles) > 4)
            <div class="slider-dots {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'space-x-reverse space-x-2' : 'space-x-2' }}" id="dotsContainer">
                @for($i = 0; $i < ceil(count($vehicles) / 4); $i++)
                    <button @click="currentIndex = {{ $i }}; scrollToIndex()"
                            class="slider-dot"
                            :class="currentIndex === {{ $i }} ? 'active' : 'inactive'">
                    </button>
                @endfor
            </div>
        @endif
    </div>

    <!-- JavaScript for Multi Image Carousel -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Wait for Alpine.js to be ready
            setTimeout(function() {
                const carousel = document.querySelector('[x-ref="carousel"]');
                if (carousel) {
                    // Add touch/swipe support for mobile
                    let startX = 0;
                    let endX = 0;

                    carousel.addEventListener('touchstart', function(e) {
                        startX = e.touches[0].clientX;
                    });

                    carousel.addEventListener('touchend', function(e) {
                        endX = e.changedTouches[0].clientX;
                        handleSwipe();
                    });

                    function handleSwipe() {
                        const swipeThreshold = 50;
                        const diff = startX - endX;

                        if (Math.abs(diff) > swipeThreshold) {
                            if (diff > 0) {
                                // Swipe left - next slide
                                const nextBtn = document.querySelector('[x-on\\:click="moveNext()"]');
                                if (nextBtn && !nextBtn.disabled) nextBtn.click();
                            } else {
                                // Swipe right - previous slide
                                const prevBtn = document.querySelector('[x-on\\:click="movePrev()"]');
                                if (prevBtn && !prevBtn.disabled) prevBtn.click();
                            }
                        }
                    }

                    // Add keyboard navigation
                    document.addEventListener('keydown', function(e) {
                        if (e.key === 'ArrowLeft') {
                            const prevBtn = document.querySelector('[x-on\\:click="movePrev()"]');
                            if (prevBtn && !prevBtn.disabled) prevBtn.click();
                        } else if (e.key === 'ArrowRight') {
                            const nextBtn = document.querySelector('[x-on\\:click="moveNext()"]');
                            if (nextBtn && !nextBtn.disabled) nextBtn.click();
                        }
                    });

                    // Debug: Log carousel state
                    console.log('Multi Image Carousel initialized successfully');
                    console.log('Carousel container:', carousel);
                    console.log('Vehicle cards:', carousel.querySelectorAll('.vehicle-card').length);
                    console.log('Carousel width:', carousel.offsetWidth);
                    console.log('Scroll width:', carousel.scrollWidth);
                }
            }, 100);
        });
    </script>

    <!-- Load More Button -->
    <div class="text-center mt-8">
        <a href="{{ route('vehicles.index') }}"
           class="inline-block bg-gray-100 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-200 transition-colors duration-300 font-medium">
            {{ __('View All') }} {{ __('Vehicles') }}
        </a>
    </div>
</div>
