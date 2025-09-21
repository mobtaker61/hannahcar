<x-app-layout>

    <!-- Hero Section (Full Width Slider) -->
    <section class="py-0 bg-gradient-to-br from-surface via-blue-50 to-indigo-50 relative overflow-hidden">
        <div class="w-full relative z-10">
            <!-- Full Width Hero Slider -->
            <livewire:hero-slider />
        </div>
    </section>

    <!-- Cars Search and Slider -->
    <section class="py-16 relative">
        <!-- Decorative Elements -->
        <div
            class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-primary to-transparent opacity-20">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <livewire:vehicle-search />
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-16 bg-gradient-to-br from-white to-gray-50 relative">
        <!-- Decorative Elements -->
        <div
            class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-accent to-transparent opacity-30">
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <livewire:services-grid />
        </div>
    </section>

    <!-- استعلامات -->
    <section id="inquirySection" class="from-gray-50 to-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-0 items-center relative">
                <!-- Left Part: Services Cards (1/4 width) with Small Overlay -->
                <div class="lg:col-span-1 relative z-10">
                    <div class="lg:absolute lg:-left-12 lg:top-1/2 lg:transform lg:-translate-y-1/2 w-full lg:w-80">
                        <livewire:service-cards />
                    </div>
                </div>

                <!-- Right Part: Image column with blue/gold crossfade -->
                <div class="lg:col-span-3 relative">
                    <div id="inquiryImageContainer" class="relative h-96 lg:h-[500px] overflow-visible">
                        <img src="{{ asset('images/qoute-bg-blue.png') }}" alt="استعلامات خودرو - آبی"
                            class="absolute bottom-[12%] left-0 h-[80%] w-auto object-contain select-none pointer-events-none">
                        <img id="inquiryGoldImage" src="{{ asset('images/qoute-bg-gold.png') }}"
                            alt="استعلامات خودرو - طلایی"
                            class="absolute bottom-[12%] left-0 h-[80%] w-auto object-contain opacity-0 transition-opacity duration-300 will-change-[opacity] select-none pointer-events-none">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 relative overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/whyus_bg.jpg') }}" alt="Background"
                 class="w-full h-full object-cover">
        </div>

        <!-- Animated Background Elements -->
        <div class="absolute inset-0 z-1 overflow-hidden">
            <!-- Floating circles with glow effects -->
            <div class="absolute top-20 left-10 w-32 h-32 bg-blue-500 rounded-full opacity-20 blur-xl animate-pulse"></div>
            <div class="absolute top-40 right-20 w-24 h-24 bg-green-500 rounded-full opacity-15 blur-lg animate-bounce"></div>
            <div class="absolute bottom-20 left-1/4 w-20 h-20 bg-purple-500 rounded-full opacity-25 blur-md animate-pulse"></div>
            <div class="absolute bottom-32 right-1/3 w-28 h-28 bg-red-500 rounded-full opacity-20 blur-xl animate-bounce"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Title -->
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-white mb-4">{{ __('Why Us') }}</h2>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                <!-- Feature Card 1: Fast Services -->
                <div class="group relative">
                    <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 text-center border border-white/20 hover:border-blue-400/50 transition-all duration-300 hover:transform hover:scale-105 hover:shadow-2xl hover:shadow-blue-500/25">
                        <!-- Icon Container with Glow Effect -->
                        <div class="relative mb-6">
                            <div class="w-20 h-20 mx-auto flex items-center justify-center transition-all duration-300">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <!-- Glow effect -->
                            <div class="absolute inset-0 w-20 h-20 mx-auto bg-blue-400 rounded-full opacity-0 group-hover:opacity-30 blur-xl transition-opacity duration-300"></div>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-4 group-hover:text-blue-300 transition-colors duration-300">
                            خدمات سریع
                        </h3>
                        <p class="text-gray-300 text-sm leading-relaxed">
                            ارائه خدمات با سرعت بالا و کیفیت مطلوب
                        </p>
                    </div>
                </div>

                <!-- Feature Card 2: Expert Consultation -->
                <div class="group relative">
                    <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 text-center border border-white/20 hover:border-green-400/50 transition-all duration-300 hover:transform hover:scale-105 hover:shadow-2xl hover:shadow-green-500/25">
                        <!-- Icon Container with Glow Effect -->
                        <div class="relative mb-6">
                            <div class="w-20 h-20 mx-auto flex items-center justify-center transition-all duration-300">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <!-- Glow effect -->
                            <div class="absolute inset-0 w-20 h-20 mx-auto bg-green-400 rounded-full opacity-0 group-hover:opacity-30 blur-xl transition-opacity duration-300"></div>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-4 group-hover:text-green-300 transition-colors duration-300">
                            مشاوره تخصصی
                        </h3>
                        <p class="text-gray-300 text-sm leading-relaxed">
                            راهنمایی توسط متخصصان باتجربه در حوزه خودرو
                        </p>
                    </div>
                </div>

                <!-- Feature Card 3: Transparency -->
                <div class="group relative">
                    <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 text-center border border-white/20 hover:border-purple-400/50 transition-all duration-300 hover:transform hover:scale-105 hover:shadow-2xl hover:shadow-purple-500/25">
                        <!-- Icon Container with Glow Effect -->
                        <div class="relative mb-6">
                            <div class="w-20 h-20 mx-auto flex items-center justify-center transition-all duration-300">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <!-- Glow effect -->
                            <div class="absolute inset-0 w-20 h-20 mx-auto bg-purple-400 rounded-full opacity-0 group-hover:opacity-30 blur-xl transition-opacity duration-300"></div>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-4 group-hover:text-purple-300 transition-colors duration-300">
                            شفافیت در خدمات
                        </h3>
                        <p class="text-gray-300 text-sm leading-relaxed">
                            ارائه اطلاعات شفاف و دقیق در تمام مراحل
                        </p>
                    </div>
                </div>

                <!-- Feature Card 4: Fair Rates -->
                <div class="group relative">
                    <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 text-center border border-white/20 hover:border-red-400/50 transition-all duration-300 hover:transform hover:scale-105 hover:shadow-2xl hover:shadow-red-500/25">
                        <!-- Icon Container with Glow Effect -->
                        <div class="relative mb-6">
                            <div class="w-20 h-20 mx-auto flex items-center justify-center transition-all duration-300">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            <!-- Glow effect -->
                            <div class="absolute inset-0 w-20 h-20 mx-auto bg-red-400 rounded-full opacity-0 group-hover:opacity-30 blur-xl transition-opacity duration-300"></div>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-4 group-hover:text-red-300 transition-colors duration-300">
                            نرخ عادلانه خدمات
                        </h3>
                        <p class="text-gray-300 text-sm leading-relaxed">
                            قیمت‌گذاری منصفانه و رقابتی برای تمام خدمات
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="py-16 bg-white relative">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-primary to-transparent opacity-20"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Content Column -->
                <div class="order-2 lg:order-1">
                    <div class="max-w-2xl">
                        <!-- Section Badge -->
                        <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 text-primary text-sm font-medium mb-6">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            درباره هانا لاکچری
                        </div>

                        <!-- Title -->
                        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                            <span class="text-primary">تجربه‌ای</span> متفاوت در خودرو
                        </h2>

                        <!-- Description -->
                        <div class="space-y-4 mb-8">
                            <p class="text-lg text-gray-600 leading-relaxed">
                                هانا لاکچری با بیش از یک دهه تجربه در صنعت خودرو، به عنوان یکی از پیشروترین مراکز خدمات واردات خودرو در کشور شناخته می‌شود. ما متعهد به ارائه بهترین خدمات و تجربه‌ای منحصر به فرد برای مشتریان خود هستیم.
                            </p>

                            <p class="text-lg text-gray-600 leading-relaxed">
                                تیم متخصص ما با همکاری مستقیم سازنده ها و برندهای معتبر جهانی، و بهره مندی از کارشناسان خبره در زمینه خودرو، بازرسی، ترخیص و فروش، همیشه در کنار مشتریان است.
                            </p>
                        </div>

                        <!-- CTA Button -->
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="#contact" class="inline-flex items-center justify-center px-8 py-4 bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 transition-colors duration-300 shadow-lg hover:shadow-xl">
                                <span>تماس با ما</span>
                                    <i class="fas fa-arrow-{{ app()->getLocale() === 'fa' ? 'left' : 'right' }} {{ app()->getLocale() === 'fa' ? 'mr-2' : 'ml-2' }}"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Image Column -->
                <div class="order-1 lg:order-2">
                    <div class="relative">
                        <!-- Main Image Container -->
                        <div class="relative from-primary/5 to-accent/5 rounded-2xl">
                            <img src="{{ asset('images/about_us_bg-min.png') }}" alt="About Us" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ('is_featured'==='true')
    <!-- Featured Vehicles -->
    <section class="py-16 bg-gradient-to-br from-gray-50 to-surface relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 hidden">
                <h2 class="text-4xl font-bold text-primary mb-6 relative">
                    <span class="relative">
                        {{ __('Featured Vehicles') }}
                        <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-32 h-1 bg-accent rounded-full"></div>
                    </span>
                </h2>
                <p class="text-xl text-secondary-text max-w-3xl mx-auto leading-relaxed">{{ __('Best Offers with Special Discounts') }}</p>
            </div>
            <livewire:spotlight-carousel />
        </div>
    </section>
    @endif

    <!-- News & Insights -->
    <section class="py-16 relative">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-primary to-transparent opacity-20"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <livewire:news-grid />
        </div>
    </section>

</x-app-layout>

