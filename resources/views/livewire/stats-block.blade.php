<div class="bg-gradient-to-r from-primary to-accent text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Stats Section -->
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">{{ app()->getLocale() === 'fa' ? 'آمار و دستاوردها' : 'Statistics & Achievements' }}</h2>
            <p class="text-xl opacity-90">{{ app()->getLocale() === 'fa' ? 'بیش از ۱۰ سال تجربه در زمینه واردات خودرو' : 'Over 10 years of experience in vehicle import' }}</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-16">
            @foreach($stats as $stat)
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2">{{ $stat['number'] }}</div>
                    <div class="text-lg opacity-90">{{ $stat['label'] }}</div>
                </div>
            @endforeach
        </div>

        <!-- Benefits Section -->
        <div class="text-center mb-12">
            <h3 class="text-2xl font-bold mb-8">{{ app()->getLocale() === 'fa' ? 'چرا هانا کار؟' : 'Why Hannah Car?' }}</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($benefits as $benefit)
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6 text-center hover:bg-white/20 transition-all duration-300">
                    <div class="w-16 h-16 bg-accent rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="{{ $benefit['icon'] }} text-2xl text-primary"></i>
                    </div>
                    <h4 class="text-lg font-semibold mb-3">{{ $benefit['title'] }}</h4>
                    <p class="text-sm opacity-90">{{ $benefit['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
