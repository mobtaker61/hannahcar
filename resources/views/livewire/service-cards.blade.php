<div class="grid grid-cols-4 md:grid-cols-2 lg:grid-cols-1 gap-4">
    @foreach($services as $service)
        <a href="{{ $service['link'] }}" class="block">
            <div class="bg-white rounded-lg shadow-lg p-4 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group cursor-pointer">
                <div class="flex items-center space-x-3 {{ app()->getLocale() === 'fa' ? 'space-x-reverse' : '' }}">
                    <!-- Icon Column -->
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-accent/10 rounded-full flex items-center justify-center group-hover:bg-accent transition-colors duration-300">
                            <i class="{{ $service['icon'] }} text-xl text-accent group-hover:text-primary transition-colors duration-300"></i>
                        </div>
                    </div>

                    <!-- Content Column -->
                    <div class="flex-1 min-w-0">
                        <h3 class="text-sm font-semibold text-primary mb-1 group-hover:text-accent transition-colors duration-300 line-clamp-1">{{ $service['title'] }}</h3>
                        <p class="text-secondary-text text-xs line-clamp-2">{{ $service['description'] }}</p>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
</div>
