    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-primary mb-4">{{ __('Our Services') }}</h2>
            <p class="text-xl text-secondary-text">{{ __('Our_Services_Description') }}</p>
        </div>
        <!-- Services Grid - 4 Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach (array_slice($services, 0, 4) as $service)
                <div class="group cursor-pointer transform transition-all duration-300 hover:-translate-y-2"
                     onclick="window.location.href='{{ $service['link'] }}'">

                    <!-- Service Card -->
                    <div class="relative h-96 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">

                        <!-- Background Image -->
                        <img src="{{ $service['image'] }}"
                             alt="{{ $service['title'] }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                        <!-- Icon Badge -->
                        <div class="absolute {{ app()->getLocale() === 'fa' ? 'top-4 right-4' : 'top-4 left-4' }}">
                            <div class="w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center group-hover:bg-accent transition-all duration-300">
                                <i class="{{ $service['icon'] }} text-primary text-xl group-hover:text-white transition-colors duration-300"></i>
                            </div>
                        </div>

                        <!-- Service Title Overlay -->
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <div class="bg-white/0 group-hover:bg-white/95 transition-all duration-300 rounded-t-xl p-4 -mt-2">
                                <h3 class="text-lg font-bold text-white group-hover:text-primary transition-all duration-300 text-center">
                                    {{ $service['title'] }}
                                </h3>
                            </div>
                        </div>

                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/10 transition-all duration-300"></div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- CTA Section -->
        <div class="text-center mt-12">
            <a href="{{ route('services.index') }}"
                class="inline-flex items-center bg-primary text-white px-8 py-4 rounded-lg font-semibold hover:bg-primary/90 transition-all duration-300 transform hover:scale-105">
                {{ __('View All Services') }}
                <i class="fas fa-arrow-{{ app()->getLocale() === 'fa' ? 'left' : 'right' }} {{ app()->getLocale() === 'fa' ? 'mr-2' : 'ml-2' }}"></i>
            </a>
        </div>
    </div>

