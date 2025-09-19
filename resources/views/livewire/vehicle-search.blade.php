<div>
    <!-- Custom CSS for Multi Image Carousel -->
    <style>
        .vehicle-slider {
            position: relative;
            overflow: hidden;
            min-height: 400px;
        }

        /* Figma-inspired pills + search */
        .pill-group{
            display:flex;align-items:center;gap:10px;background:#E9EAEB;border-radius:23px;padding:2px;height:46px
        }
        .pill{
            min-width:138px;height:42px;border-radius:23px;background:#E9EAEB;color:#A5A5A5;font-weight:600;font-size:16px;line-height:21px;display:flex;align-items:center;justify-content:center;padding:0 16px;white-space:nowrap
        }
        .pill--active{background:#1F4E79;color:#fff;box-shadow:0 15px 30px -10px rgba(0,0,0,.08)}
        .search-box{width:415px;max-width:100%;height:46px;background:#fff;border-radius:23px;box-shadow:0 15px 30px -10px rgba(0,0,0,.08)}
        .search-box input{height:46px;border:none;outline:none;background:transparent}

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
            background: #FFFFFF;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 8px 8px -4px rgba(10, 13, 18, 0.03), 0px 20px 24px -4px rgba(10, 13, 18, 0.08);
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

        /* Card spec row (Figma-like) */
        .spec-row{background:#E9EAEB;border-radius:10px;display:grid;grid-template-columns:repeat(3,1fr);gap:12px;padding:14px}
        .spec-col{display:flex;align-items:center;justify-content:center;gap:8px;color:#A5A5A5}
        .spec-col .label{font-size:12px;font-weight:600}
        .spec-col .value{font-size:16px;font-weight:800;color:#6B7280}
        .price-row{display:flex;align-items:center;justify-content:flex-end;gap:10px;margin-top:12px}
        .price-badge{width:46px;height:46px;border-radius:12px;background:#FFFFFF;display:flex;align-items:center;justify-content:center;box-shadow:0 15px 30px -10px rgba(0,0,0,.08)}
        .price-text{font-size:24px;font-weight:700;color:#32D583}
        .card-divider{height:1px;background:#E9EAEB;margin:14px 0}
        .view-link{display:flex;align-items:center;justify-content:center;color:#535862;font-weight:600}

        .slider-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: #FFFFFF;
            border: none;
            border-radius: 23px;
            padding: 0;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 20;
            box-shadow: 0px 15px 30px -10px rgba(0, 0, 0, 0.08);
            width: 46px;
            height: 46px;
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
    <div class="flex {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'flex-row' : 'flex-row-reverse' }} justify-between items-center mb-8 gap-6">
        <!-- Search Box -->
        <div class="relative search-box flex items-center px-4">
            <input wire:model.live.debounce.500ms="searchQuery"
                   type="text"
                   placeholder="{{ __('Vehicle name') }}"
                   class="w-full {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'pr-8 pl-2 text-right' : 'pl-8 pr-2 text-left' }} text-gray-900 placeholder-[#A5A5A5]">
            <div class="absolute inset-y-0 {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'right-3' : 'left-3' }} flex items-center pointer-events-none">
                <i class="fas fa-search text-[#A5A5A5]"></i>
            </div>
        </div>
        <!-- Pills -->
        <div class="md:flex pill-group {{ in_array(app()->getLocale(), ['fa', 'ar']) ? '' : 'ml-auto' }}">
            <button wire:click="setActiveTab('all')" class="pill {{ $activeTab === 'all' ? 'pill--active' : '' }}">{{ __('Latest') }}</button>
            <button wire:click="setActiveTab('new')" class="pill {{ $activeTab === 'new' ? 'pill--active' : '' }}">{{ __('Brand New') }}</button>
            <button wire:click="setActiveTab('used')" class="pill {{ $activeTab === 'used' ? 'pill--active' : '' }}">{{ __('Used') }}</button>
            <button wire:click="setActiveTab('export')" class="pill {{ $activeTab === 'export' ? 'pill--active' : '' }}">{{ __('Export') }}</button>
        </div>

    </div>

    <!-- Brand/Model/Variant Filter Row -->
    <div class="flex {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'flex-row-reverse' : 'flex-row' }} items-center space-x-4 {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'space-x-reverse' : '' }} mb-6 hidden">
        <!-- Brand Filter -->
        <div class="flex items-center space-x-2 {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'space-x-reverse' : '' }}">
            <label class="text-sm font-medium text-gray-700">{{ __('Brand') }}:</label>
            <select wire:model.live="selectedBrand"
                    class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-900 min-w-32">
                <option value="">{{ __('All Brands') }}</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Model Filter -->
        <div class="flex items-center space-x-2 {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'space-x-reverse' : '' }}">
            <label class="text-sm font-medium text-gray-700">{{ __('Model') }}:</label>
            <select wire:model.live="selectedModel"
                    class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-900 min-w-32"
                    {{ empty($selectedBrand) ? 'disabled' : '' }}>
                <option value="">{{ __('All Models') }}</option>
                @if($selectedBrand)
                    @foreach($models as $model)
                        <option value="{{ $model->id }}">{{ $model->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <!-- Variant Filter -->
        <div class="flex items-center space-x-2 {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'space-x-reverse' : '' }}">
            <label class="text-sm font-medium text-gray-700">{{ __('Variant') }}:</label>
            <select wire:model.live="selectedVariant"
                    class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-900 min-w-32"
                    {{ empty($selectedModel) ? 'disabled' : '' }}>
                <option value="">{{ __('All Variants') }}</option>
                @if($selectedModel)
                    @foreach($vehicleVariants as $variant)
                        <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                    @endforeach
                @endif
            </select>
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
                        <x-vehicle-card :url="route('vehicles.show', $vehicle['slug'])"
                                        :image="$vehicle['image']"
                                        :name="$vehicle['name']"
                                        :year="$vehicle['year']"
                                        :km="$vehicle['km']"
                                        :price="$vehicle['price']"
                                        :badge="$vehicle['status'] ?? ($activeTab === 'new' ? __('Brand New') : ($activeTab === 'used' ? __('Used') : ($activeTab === 'export' ? __('Export') : __('Latest'))))"
                                        :currency="$vehicle['currency'] ?? null" />
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
           class="inline-flex items-center justify-center px-6 h-[46px] rounded-[23px] bg-white/20 backdrop-blur-md text-[#1F4E79] font-semibold shadow-[0_15px_30px_-10px_rgba(0,0,0,0.08)]">
            {{ __('View All') }}
        </a>
    </div>
</div>
