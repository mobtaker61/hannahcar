<x-app-layout>

    <!-- Hero Section (Full Width Slider) -->
    <section class="py-0 bg-gradient-to-br from-surface via-blue-50 to-indigo-50 relative overflow-hidden">
        <div class="w-full relative z-10">
            <!-- Full Width Hero Slider -->
            <livewire:hero-slider />
        </div>
    </section>

    <!-- Cars Search and Slider -->
    <section class="py-16 bg-white relative">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-primary to-transparent opacity-20"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 hidden">
                <h2 class="text-4xl font-bold text-primary mb-6 relative">
                    <span class="relative">
                        جستجو و انتخاب خودرو
                        <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-accent rounded-full"></div>
                    </span>
                </h2>
                <p class="text-xl text-secondary-text max-w-2xl mx-auto leading-relaxed">خودرو مورد نظر خود را پیدا کنید و با بهترین قیمت خریداری کنید</p>
            </div>
            <livewire:vehicle-search />
        </div>
    </section>

    <!-- Service Cards Section -->
    <section class="py-16 bg-gradient-to-br from-gray-50 to-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-0 items-center relative">

                <!-- Left Part: Large Image (3/4 width) -->
                <div class="lg:col-span-3 relative">
                    <div class="relative h-96 lg:h-[500px] rounded-2xl overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1563720223185-11003d516935?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                             alt="استعلامات خودرو"
                             class="w-full h-full object-cover">

                        <!-- Image Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/20 to-transparent"></div>

                        <!-- Content on Image -->
                        <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                            <h3 class="text-2xl lg:text-3xl font-bold mb-3">استعلام خودرو</h3>
                            <p class="text-lg opacity-90">با تکمیل مراحل استعلام، به جواب برسید</p>
                        </div>
                    </div>
                </div>

                <!-- Right Part: Service Cards (1/4 width) with Small Overlay -->
                <div class="lg:col-span-1 relative z-10">
                    <div class="lg:absolute lg:-left-12 lg:top-1/2 lg:transform lg:-translate-y-1/2 w-full lg:w-80">
                        <livewire:service-cards />
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="text-center mt-16">
                <a href="{{ route('inquiry-forms.index') }}"
                   class="inline-flex items-center bg-primary text-white px-8 py-4 rounded-lg font-semibold hover:bg-primary/90 transition-all duration-300 transform hover:scale-105">
                    مشاهده همه استعلامات
                    <i class="fas fa-arrow-{{ app()->getLocale() === 'fa' ? 'left' : 'right' }} {{ app()->getLocale() === 'fa' ? 'mr-2' : 'ml-2' }}"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Weekly Spotlight -->
    <section class="py-16 bg-gradient-to-br from-gray-50 to-surface relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 hidden">
                <h2 class="text-4xl font-bold text-primary mb-6 relative">
                    <span class="relative">
                        {{ __('Weekly Spotlight') }}
                        <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-32 h-1 bg-accent rounded-full"></div>
                    </span>
                </h2>
                <p class="text-xl text-secondary-text max-w-3xl mx-auto leading-relaxed">{{ __('Best Offers with Special Discounts') }}</p>
            </div>
            <livewire:spotlight-carousel />
        </div>
    </section>

    <!-- Stats & Benefits -->
    <section class="py-0 bg-gradient-to-r from-primary via-blue-600 to-indigo-700 relative overflow-hidden hidden">
        <livewire:stats-block />
    </section>

    <!-- Services Grid -->
    <section class="py-16 bg-gradient-to-br from-white to-gray-50 relative">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-accent to-transparent opacity-30"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <livewire:services-grid />
        </div>
    </section>

    <!-- News & Insights -->
    <section class="py-16 bg-white relative">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-primary to-transparent opacity-20"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-primary mb-6 relative">
                    <span class="relative">
                        اخبار و بینش‌ها
                        <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-32 h-1 bg-accent rounded-full"></div>
                    </span>
                </h2>
                <p class="text-xl text-secondary-text max-w-3xl mx-auto leading-relaxed">آخرین اخبار و اطلاعات مفید در حوزه خودرو</p>
            </div>
            <livewire:news-grid />
        </div>
    </section>

</x-app-layout>
