<div class="relative h-96 lg:h-[500px] overflow-hidden rounded-lg"
     wire:poll.{{ $autoPlayInterval }}ms="nextSlide"
     @mouseenter="$wire.stopAutoPlay()"
     @mouseleave="$wire.startAutoPlay()">
    <!-- Slides -->
    @foreach($spotlightVehicles as $index => $vehicle)
        <div class="absolute inset-0 transition-opacity duration-1000 {{ $index === $currentSlide ? 'opacity-100' : 'opacity-0' }}">
            <div class="relative h-full">
                <img src="{{ $vehicle['image'] }}"
                     alt="{{ $vehicle['name'] }}"
                     class="w-full h-full object-cover">

                <!-- Overlay -->
                <div class="absolute inset-0 bg-gradient-to-r from-primary/80 to-transparent"></div>

                <!-- Badge -->
                <div class="absolute top-4 {{ app()->getLocale() === 'fa' ? 'right-4' : 'left-4' }}">
                    <span class="{{ $vehicle['badge_color'] }} text-white px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $vehicle['badge'] }}
                    </span>
                </div>

                <!-- Content - Moved to bottom and end side -->
                <div class="absolute bottom-8 {{ app()->getLocale() === 'fa' ? 'left-8' : 'right-8' }} max-w-md {{ app()->getLocale() === 'fa' ? 'text-left' : 'text-right' }}">
                    <h2 class="text-2xl lg:text-4xl font-bold text-white mb-3">
                        {{ $vehicle['name'] }}
                    </h2>
                    <p class="text-base text-white/90 mb-4">
                        {{ $vehicle['description'] }}
                    </p>
                    <div class="flex items-center {{ app()->getLocale() === 'fa' ? 'space-x-reverse space-x-3' : 'space-x-3' }} mb-4">
                        @if($vehicle['original_price'] !== $vehicle['price'])
                            <span class="text-base text-white/60 line-through">
                                {{ number_format($vehicle['original_price']) }} {{ app()->getLocale() === 'fa' ? 'تومان' : 'Toman' }}
                            </span>
                        @endif
                        <span class="text-xl font-bold text-accent">
                            {{ number_format($vehicle['price']) }} {{ app()->getLocale() === 'fa' ? 'تومان' : 'Toman' }}
                        </span>
                    </div>
                    <a href="{{ route('vehicles.show', $vehicle['slug']) }}" class="inline-block bg-accent text-primary px-6 py-2 rounded-lg font-semibold hover:bg-accent/90 transition-colors text-sm">
                        {{ app()->getLocale() === 'fa' ? 'مشاهده جزئیات' : 'View Details' }}
                    </a>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Dots Indicator - Moved to bottom and start side -->
    <div class="absolute bottom-6 {{ app()->getLocale() === 'fa' ? 'right-6' : 'left-6' }} flex {{ app()->getLocale() === 'fa' ? 'space-x-reverse space-x-2' : 'space-x-2' }}">
        @foreach($spotlightVehicles as $index => $vehicle)
            <button wire:click="goToSlide({{ $index }})"
                    class="w-3 h-3 rounded-full transition-all duration-300 {{ $index === $currentSlide ? 'bg-accent' : 'bg-white/50 hover:bg-white/70' }}">
            </button>
        @endforeach
    </div>
</div>
