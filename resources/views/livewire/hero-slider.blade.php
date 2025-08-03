<div class="relative h-72 lg:h-[370px] overflow-hidden rounded-lg"
     wire:poll.5s="nextSlide">
    <!-- Slides -->
    @foreach($slides as $index => $slide)
        <div class="absolute inset-0 transition-opacity duration-1000 {{ $index === $currentSlide ? 'opacity-100' : 'opacity-0' }}"
             style="background: linear-gradient(135deg, rgba(26, 34, 67, 0.8) 0%, rgba(242, 160, 36, 0.6) 100%), url('{{ $slide['image'] }}') center/cover;">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>

            <!-- Content -->
            <div class="relative h-full flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                    <div class="max-w-3xl {{ app()->getLocale() === 'fa' ? 'text-right' : 'text-left' }}">
                        <h2 class="text-3xl lg:text-5xl font-bold text-white mb-3 animate-slide-up">
                            {{ $slide['title'] }}
                        </h2>
                        <p class="text-lg lg:text-xl text-white/90 mb-4 animate-slide-up" style="animation-delay: 0.2s;">
                            {{ $slide['subtitle'] }}
                        </p>
                        <p class="text-base text-white/80 mb-6 animate-slide-up" style="animation-delay: 0.4s;">
                            {{ $slide['description'] }}
                        </p>
                        <a href="{{ $slide['cta_link'] }}"
                           class="inline-flex items-center px-6 py-3 bg-accent text-primary font-semibold rounded-lg hover:bg-accent/90 transition-all duration-300 transform hover:scale-105 animate-slide-up"
                           style="animation-delay: 0.6s;">
                            {{ $slide['cta_text'] }}
                            <i class="fas fa-arrow-{{ app()->getLocale() === 'fa' ? 'left' : 'right' }} {{ app()->getLocale() === 'fa' ? 'mr-2' : 'ml-2' }}"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Control Buttons Group -->
    <div class="absolute top-4 {{ app()->getLocale() === 'fa' ? 'left-4' : 'right-4' }} flex items-center space-x-2 {{ app()->getLocale() === 'fa' ? 'space-x-reverse' : '' }} z-10">
        <!-- Previous Button -->
        <button wire:click="prevSlide" wire:loading.attr="disabled"
                class="bg-white/20 hover:bg-white/30 text-white p-1.5 rounded-full transition-all duration-300 backdrop-blur-sm disabled:opacity-50 disabled:cursor-not-allowed">
            <i class="fas fa-chevron-{{ app()->getLocale() === 'fa' ? 'right' : 'left' }} text-sm"></i>
        </button>

        <!-- Pause/Play Button -->
        <button wire:click="toggleAutoSlide"
                class="bg-white/20 hover:bg-white/30 text-white p-1.5 rounded-full transition-all duration-300 backdrop-blur-sm">
            <i class="fas {{ $autoSlide ? 'fa-pause' : 'fa-play' }} text-sm"></i>
        </button>

        <!-- Next Button -->
        <button wire:click="nextSlide" wire:loading.attr="disabled"
                class="bg-white/20 hover:bg-white/30 text-white p-1.5 rounded-full transition-all duration-300 backdrop-blur-sm disabled:opacity-50 disabled:cursor-not-allowed">
            <i class="fas fa-chevron-{{ app()->getLocale() === 'fa' ? 'left' : 'right' }} text-sm"></i>
        </button>
    </div>

    <!-- Dots Indicator -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex {{ app()->getLocale() === 'fa' ? 'space-x-reverse space-x-2' : 'space-x-2' }} z-10">
        @foreach($slides as $index => $slide)
            <button wire:click="goToSlide({{ $index }})" wire:loading.attr="disabled"
                    class="w-3 h-3 rounded-full transition-all duration-300 {{ $index === $currentSlide ? 'bg-accent' : 'bg-white/50 hover:bg-white/70' }} disabled:opacity-50 disabled:cursor-not-allowed">
            </button>
        @endforeach
    </div>
</div>
