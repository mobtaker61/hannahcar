<x-app-layout>

    <!-- Hero Section (75% + 25%) -->
    <section class="py-6 bg-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Hero Slider (75%) -->
                <div class="lg:col-span-3">
                    <livewire:hero-slider />
                </div>

                <!-- Service Cards (25%) -->
                <div class="lg:col-span-1">
                    <livewire:service-cards />
                </div>
            </div>
        </div>
    </section>

    <!-- Cars Search and Slider -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 hidden">
                <h2 class="text-3xl font-bold text-primary mb-4">جستجو و انتخاب خودرو</h2>
                <p class="text-lg text-secondary-text">خودرو مورد نظر خود را پیدا کنید</p>
            </div>
            <livewire:vehicle-search />
        </div>
    </section>

    <!-- Weekly Spotlight -->
    <section class="py-12 bg-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-primary mb-4">{{ __('Weekly Spotlight') }}</h2>
                <p class="text-lg text-secondary-text">{{ __('Best Offers with Special Discounts') }}</p>
            </div>
            <livewire:spotlight-carousel />
        </div>
    </section>

    <!-- Stats & Benefits -->
    <section class="py-0 bg-gradient-to-r">
        <livewire:stats-block />
    </section>

    <!-- Services Grid -->
    <section class="py-8 bg-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <livewire:services-grid />
        </div>
    </section>

    <!-- News & Insights -->
    <section class="py-8 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <livewire:news-grid />
        </div>
    </section>

</x-app-layout>
