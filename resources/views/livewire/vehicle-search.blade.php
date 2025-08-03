<div>
    <!-- Search and Filter Row -->
    <div class="flex {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'flex-row-reverse' : 'flex-row' }} justify-between items-center mb-8">
        <!-- Filter Tabs -->
        <div class="flex {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'space-x-reverse space-x-8' : 'space-x-8' }}">
            <button wire:click="setActiveTab('new')"
                    class="relative py-2 px-4 text-sm font-medium transition-all duration-300 {{ $activeTab === 'new' ? 'text-black font-semibold' : 'text-gray-500 hover:text-gray-700' }}">
                {{ __('New') }}
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
    <div class="relative"
         x-data="{
             currentSlide: 0,
             totalSlides: {{ ceil(count($vehicles) / 4) }},
             totalVehicles: {{ count($vehicles) }},
             activeTab: '{{ $activeTab }}',

             nextSlide() {
                 this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
             },

             prevSlide() {
                 this.currentSlide = this.currentSlide > 0 ? this.currentSlide - 1 : this.totalSlides - 1;
             },

             goToSlide(slideIndex) {
                 this.currentSlide = slideIndex;
             }
         }"
         wire:ignore
         wire:key="vehicle-slider-{{ $activeTab }}">

        <div class="overflow-hidden">
            <div class="flex transition-transform duration-500 ease-in-out"
                 x-ref="sliderContainer"
                 :style="`transform: translateX(-${currentSlide * 100}%)`">

                <!-- Page 1: Vehicles 1-4 -->
                <div class="w-full flex-shrink-0">
                    <div class="grid grid-cols-4 gap-6">
                        @for($i = 0; $i < min(4, count($vehicles)); $i++)
                            @php $vehicle = $vehicles[$i]; @endphp
                            <div class="bg-white rounded-lg overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                                <a href="{{ route('vehicles.show', $vehicle['slug']) }}" class="block">
                                    <!-- Vehicle Image -->
                                    <div class="relative h-48">
                                        <img src="{{ $vehicle['image'] }}"
                                             alt="{{ $vehicle['name'] }}"
                                             class="w-full h-full object-cover rounded-lg">
                                        <div class="absolute top-3 {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'right-3' : 'left-3' }} bg-white/90 backdrop-blur-sm text-gray-800 px-2 py-1 rounded text-xs font-medium">
                                            {{ $vehicle['year'] }}
                                        </div>
                                    </div>

                                    <!-- Vehicle Info -->
                                    <div class="pt-2">
                                        <!-- Vehicle Name -->
                                        <h3 class="text-lg font-bold text-gray-900 mb-0">{{ $vehicle['name'] }}</h3>

                                        <!-- Vehicle Details -->
                                        <div class="text-sm text-gray-500 mb-0">
                                            {{ $vehicle['year'] }} | {{ $vehicle['km'] }} km
                                        </div>

                                        <!-- Price -->
                                        <div class="text-xl font-bold text-gray-900">
                                            {{ number_format($vehicle['price']) }} {{ $vehicle['currency'] }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Page 2: Vehicles 5-8 -->
                @if(count($vehicles) > 4)
                    <div class="w-full flex-shrink-0">
                        <div class="grid grid-cols-4 gap-6">
                            @for($i = 4; $i < min(8, count($vehicles)); $i++)
                                @php $vehicle = $vehicles[$i]; @endphp
                                <div class="bg-white rounded-lg overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                                    <a href="{{ route('vehicles.show', $vehicle['slug']) }}" class="block">
                                        <!-- Vehicle Image -->
                                        <div class="relative h-48">
                                            <img src="{{ $vehicle['image'] }}"
                                                 alt="{{ $vehicle['name'] }}"
                                                 class="w-full h-full object-cover rounded-lg">
                                            <div class="absolute top-3 {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'right-3' : 'left-3' }} bg-white/90 backdrop-blur-sm text-gray-800 px-2 py-1 rounded text-xs font-medium">
                                                {{ $vehicle['year'] }}
                                            </div>
                                        </div>

                                        <!-- Vehicle Info -->
                                        <div class="pt-2">
                                            <!-- Vehicle Name -->
                                            <h3 class="text-lg font-bold text-gray-900 mb-0">{{ $vehicle['name'] }}</h3>

                                            <!-- Vehicle Details -->
                                            <div class="text-sm text-gray-500 mb-0">
                                                {{ $vehicle['year'] }} | {{ $vehicle['km'] }} km
                                            </div>

                                            <!-- Price -->
                                            <div class="text-xl font-bold text-gray-900">
                                                {{ number_format($vehicle['price']) }} {{ $vehicle['currency'] }}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endfor
                        </div>
                    </div>
                @endif

                <!-- Page 3: Vehicles 9-12 -->
                @if(count($vehicles) > 8)
                    <div class="w-full flex-shrink-0">
                        <div class="grid grid-cols-4 gap-6">
                            @for($i = 8; $i < min(12, count($vehicles)); $i++)
                                @php $vehicle = $vehicles[$i]; @endphp
                                <div class="bg-white rounded-lg overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                                    <a href="{{ route('vehicles.show', $vehicle['slug']) }}" class="block">
                                        <!-- Vehicle Image -->
                                        <div class="relative h-48">
                                            <img src="{{ $vehicle['image'] }}"
                                                 alt="{{ $vehicle['name'] }}"
                                                 class="w-full h-full object-cover rounded-lg">
                                            <div class="absolute top-3 {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'right-3' : 'left-3' }} bg-white/90 backdrop-blur-sm text-gray-800 px-2 py-1 rounded text-xs font-medium">
                                                {{ $vehicle['year'] }}
                                            </div>
                                        </div>

                                        <!-- Vehicle Info -->
                                        <div class="pt-2">
                                            <!-- Vehicle Name -->
                                            <h3 class="text-lg font-bold text-gray-900 mb-0">{{ $vehicle['name'] }}</h3>

                                            <!-- Vehicle Details -->
                                            <div class="text-sm text-gray-500 mb-0">
                                                {{ $vehicle['year'] }} | {{ $vehicle['km'] }} km
                                            </div>

                                            <!-- Price -->
                                            <div class="text-xl font-bold text-gray-900">
                                                {{ number_format($vehicle['price']) }} {{ $vehicle['currency'] }}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endfor
                        </div>
                    </div>
                @endif

            </div>
        </div>

        <!-- Navigation Arrows -->
        @if(count($vehicles) > 4)
            <button @click="prevSlide()"
                    class="absolute {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'right-4' : 'left-4' }} top-1/2 transform -translate-y-1/2 bg-white/90 hover:bg-white text-gray-700 p-3 rounded-full shadow-lg transition-all duration-300 z-10">
                <i class="fas fa-chevron-{{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'right' : 'left' }}"></i>
            </button>

            <button @click="nextSlide()"
                    class="absolute {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'left-4' : 'right-4' }} top-1/2 transform -translate-y-1/2 bg-white/90 hover:bg-white text-gray-700 p-3 rounded-full shadow-lg transition-all duration-300 z-10">
                <i class="fas fa-chevron-{{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'left' : 'right' }}"></i>
            </button>
        @endif

        <!-- Dots Indicator -->
        @if(count($vehicles) > 4)
            <div class="flex justify-center mt-6 {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'space-x-reverse space-x-2' : 'space-x-2' }}" id="dotsContainer">
                @for($i = 0; $i < ceil(count($vehicles) / 4); $i++)
                    <button @click="goToSlide({{ $i }})"
                            class="w-3 h-3 rounded-full transition-all duration-300"
                            :class="currentSlide === {{ $i }} ? 'bg-blue-600' : 'bg-gray-300'">
                    </button>
                @endfor
            </div>
        @endif
    </div>

    <!-- Load More Button -->
    <div class="text-center mt-8">
        <a href="{{ route('vehicles.index') }}"
           class="inline-block bg-gray-100 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-200 transition-colors duration-300 font-medium">
            {{ __('View All') }} {{ __('Vehicles') }}
        </a>
    </div>
</div>
