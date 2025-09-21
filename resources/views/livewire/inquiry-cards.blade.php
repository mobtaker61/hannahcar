<div class="space-y-3">
    @foreach (array_slice($services, 0, 4) as $service)
        <a href="{{ $service['link'] }}" class="block">
            <div class="bg-white/95 backdrop-blur-md rounded-xl shadow-2xl p-4 hover:shadow-3xl transition-all duration-300 transform hover:-translate-y-1 group cursor-pointer border border-white/30 hover:border-accent/60 hover:bg-white">
                <div class="flex items-center space-x-3 {{ app()->getLocale() === 'fa' ? 'space-x-reverse' : '' }}">
                    <!-- Icon Column -->
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-accent/20 rounded-lg flex items-center justify-center group-hover:bg-accent transition-all duration-300 group-hover:scale-110">
                            <i class="{{ $service['icon'] }} text-lg text-accent group-hover:text-white transition-colors duration-300"></i>
                        </div>
                    </div>

                    <!-- Content Column -->
                    <div class="flex-1 min-w-0">
                        <h3 class="text-sm font-bold text-primary mb-1 group-hover:text-accent transition-colors duration-300 line-clamp-1">{{ $service['title'] }}</h3>
                        <p class="text-secondary-text text-xs line-clamp-2 leading-relaxed">{{ $service['description'] }}</p>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
    <!-- View All link placed at the end of the cards -->
    <div class="pt-2 text-end">
        <a href="{{ route('inquiry-forms.index') }}" class="inline-flex items-center text-primary hover:text-primary/90 font-semibold">
            {{ __('مشاهده همه استعلامات') }}
            <i class="fas fa-arrow-{{ app()->getLocale() === 'fa' ? 'left' : 'right' }} {{ app()->getLocale() === 'fa' ? 'mr-2' : 'ml-2' }}"></i>
        </a>
    </div>
</div>


