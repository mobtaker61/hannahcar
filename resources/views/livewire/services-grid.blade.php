    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-primary mb-4">{{ __('Our Services') }}</h2>
            <p class="text-xl text-secondary-text">{{ __('Our_Services_Description') }}</p>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($services as $service)
                <div
                    class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $service['image'] }}" alt="{{ $service['title'] }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute {{ app()->getLocale() === 'fa' ? 'top-4 right-4' : 'top-4 left-4' }}">
                            <div class="w-12 h-12 bg-accent rounded-full flex items-center justify-center">
                                <i class="{{ $service['icon'] }} text-primary text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-primary mb-3">{{ $service['title'] }}</h3>
                        <p class="text-secondary-text mb-4">{{ $service['description'] }}</p>

                        <div class="flex items-center justify-between">
                            <a href="{{ $service['link'] }}"
                                class="inline-flex items-center text-accent hover:text-primary transition-colors duration-300 font-medium">
                                {{ __('View Details') }}
                                <i
                                    class="fas fa-arrow-{{ app()->getLocale() === 'fa' ? 'left' : 'right' }} {{ app()->getLocale() === 'fa' ? 'mr-2' : 'ml-2' }} text-sm"></i>
                            </a>

                            @if (isset($service['price']))
                                <span class="text-lg font-bold text-accent">{{ $service['price'] }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- CTA Section -->
        <div class="text-center mt-12">
            <a href="{{ route('services.index') }}"
                class="inline-flex items-center bg-primary text-white px-8 py-4 rounded-lg font-semibold hover:bg-primary/90 transition-colors">
                {{ __('View All Services') }}
                <i
                    class="fas fa-arrow-{{ app()->getLocale() === 'fa' ? 'left' : 'right' }} {{ app()->getLocale() === 'fa' ? 'mr-2' : 'ml-2' }}"></i>
            </a>
        </div>
    </div>

