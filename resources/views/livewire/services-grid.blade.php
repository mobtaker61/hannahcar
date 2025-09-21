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

                    <!-- Service Card (Figma-like) -->
                    <div class="relative h-96 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">

                        <!-- Background Image -->
                        <img src="{{ $service['image'] }}"
                             alt="{{ $service['title'] }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>

                        <!-- Icon Badge + Glass Title block -->
                        <div class="absolute bottom-6 left-6 right-6">
                            <div class="bg-white/90 backdrop-blur-xl rounded-xl p-4 shadow-md ring-1 ring-white/60">
                                <div class="flex items-center {{ app()->getLocale() === 'fa' ? 'flex-row-reverse' : '' }} gap-3">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-extrabold text-[#1F4E79]">{{ $service['title'] }}</h3>
                                        <p class="text-sm text-gray-700 line-clamp-2">{{ $service['description'] ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/10 transition-all duration-300"></div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- CTA Section -->
        <div class="text-center mt-6">
            <a href="{{ route('services.index') }}"
                class="inline-flex items-center text-primary px-8 py-4 rounded-lg font-semibold hover:bg-primary/90 transition-all duration-300 transform hover:scale-105">
                {{ __('View All Services') }}
                <i class="fas fa-arrow-{{ app()->getLocale() === 'fa' ? 'left' : 'right' }} {{ app()->getLocale() === 'fa' ? 'mr-2' : 'ml-2' }}"></i>
            </a>
        </div>
    </div>

