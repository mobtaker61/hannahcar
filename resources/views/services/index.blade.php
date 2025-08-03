<x-app-layout>
    <div class="py-8 bg-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-primary mb-4">{{ __('Our Services') }}</h1>
                <p class="text-xl text-secondary-text max-w-3xl mx-auto">
                    {{ __('We provide comprehensive automotive services including vehicle supply, import, clearance, spare parts, and inspection services.') }}
                </p>
            </div>

            <!-- Search and Filter -->
            <div class="mb-8">
                <form method="GET" action="{{ route('services.index') }}" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="{{ __('Search services...') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div class="flex gap-2">
                        <select name="featured" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="">{{ __('All Services') }}</option>
                            <option value="true" {{ request('featured') === 'true' ? 'selected' : '' }}>{{ __('Featured Only') }}</option>
                            <option value="false" {{ request('featured') === 'false' ? 'selected' : '' }}>{{ __('Regular Services') }}</option>
                        </select>
                        <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                            {{ __('Search') }}
                        </button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Services Grid -->
                <div class="lg:col-span-3">
                    @if($services->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($services as $service)
                                @php
                                    $translation = $service->translations->where('language.code', app()->getLocale())->first();
                                    if (!$translation) {
                                        $translation = $service->translations->first();
                                    }
                                @endphp

                                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group">
                                    <div class="relative h-48 overflow-hidden">
                                        <img src="{{ $service->featured_image ? asset('storage/' . $service->featured_image) : asset('images/placeholder.jpg') }}" alt="{{ $translation->title }}"
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                        @if($service->is_featured)
                                            <div class="absolute top-4 {{ app()->getLocale() === 'fa' ? 'right-4' : 'left-4' }}">
                                                <span class="bg-accent text-white px-2 py-1 rounded-full text-xs font-medium">
                                                    {{ __('Featured') }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="p-6">
                                        <h3 class="text-xl font-semibold text-primary mb-3">{{ $translation->title }}</h3>
                                        <p class="text-secondary-text mb-4 line-clamp-3">{{ $translation->excerpt }}</p>

                                        <div class="flex items-center justify-between">
                                            <a href="{{ route('services.show', $service->slug) }}"
                                               class="inline-flex items-center text-accent hover:text-primary transition-colors duration-300 font-medium">
                                                {{ __('View Details') }}
                                                <i class="fas fa-arrow-{{ app()->getLocale() === 'fa' ? 'left' : 'right' }} {{ app()->getLocale() === 'fa' ? 'mr-2' : 'ml-2' }} text-sm"></i>
                                            </a>

                                            <div class="flex items-center space-x-4 {{ app()->getLocale() === 'fa' ? 'space-x-reverse' : '' }}">
                                                <span class="text-sm text-secondary-text">
                                                    <i class="fas fa-eye mr-1"></i>
                                                    {{ $service->views_count }}
                                                </span>
                                                <span class="text-sm text-secondary-text">
                                                    <i class="fas fa-comments mr-1"></i>
                                                    {{ $service->comments()->where('status', 'approved')->count() }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $services->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="text-6xl text-gray-300 mb-4">
                                <i class="fas fa-search"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-600 mb-2">{{ __('No services found') }}</h3>
                            <p class="text-secondary-text">{{ __('Try adjusting your search criteria or browse all services.') }}</p>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Featured Services -->
                    @if($featuredServices->count() > 0)
                        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                            <h3 class="text-lg font-semibold text-primary mb-4">{{ __('Featured Services') }}</h3>
                            <div class="space-y-4">
                                @foreach($featuredServices as $featuredService)
                                    @php
                                        $translation = $featuredService->translations->where('language.code', app()->getLocale())->first();
                                        if (!$translation) {
                                            $translation = $featuredService->translations->first();
                                        }
                                    @endphp

                                    <a href="{{ route('services.show', $featuredService->slug) }}"
                                       class="block group">
                                        <div class="flex items-center space-x-3 {{ app()->getLocale() === 'fa' ? 'space-x-reverse' : '' }}">
                                            <div class="flex-shrink-0 w-16 h-16 rounded-lg overflow-hidden">
                                                <img src="{{ $featuredService->featured_image ? asset('storage/' . $featuredService->featured_image) : asset('images/placeholder.jpg') }}" alt="{{ $translation->title }}"
                                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4 class="text-sm font-medium text-primary group-hover:text-accent transition-colors line-clamp-2">
                                                    {{ $translation->title }}
                                                </h4>
                                                <p class="text-xs text-secondary-text line-clamp-2">
                                                    {{ $translation->excerpt }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Quick Contact -->
                    <div class="bg-gradient-to-r from-primary to-accent rounded-lg p-6 text-white">
                        <h3 class="text-lg font-semibold mb-4">{{ __('Need Help?') }}</h3>
                        <p class="text-sm mb-4">{{ __('Contact our experts for personalized assistance with your automotive needs.') }}</p>
                        <a href="{{ route('page.show', 'contact') }}"
                           class="inline-flex items-center bg-white text-primary px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors">
                            {{ __('Contact Us') }}
                            <i class="fas fa-arrow-{{ app()->getLocale() === 'fa' ? 'left' : 'right' }} {{ app()->getLocale() === 'fa' ? 'mr-2' : 'ml-2' }} text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
