<footer class="bg-primary text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div class="text-start">
                @php
                    $currentLanguage = App\Models\Language::where('code', app()->getLocale())->first();
                    $logoTranslation = \App\Helpers\SettingHelper::get('site_logo');
                    $nameTranslation = \App\Helpers\SettingHelper::get('site_name');
                @endphp

                @if($logoTranslation)
                    <div class="flex items-center justify-start mb-2">
                        <img src="{{ $logoTranslation }}" alt="{{ $nameTranslation ?? config('app.name') }}" class="h-8 w-auto">
                    </div>
                @endif

                @if($nameTranslation)
                    <div class="flex items-center justify-start mb-4">
                        <span class="text-xl font-bold">{{ $nameTranslation }}</span>
                    </div>
                @endif
                <p class="text-gray-300 mb-4">
                    {{ __('Company description') }}
                </p>
                <div class="flex justify-start space-x-4">
                    <a href="#" class="text-gray-300 hover:text-accent transition-colors">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-accent transition-colors">
                        <i class="fab fa-telegram text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-accent transition-colors">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-accent transition-colors">
                        <i class="fab fa-linkedin text-xl"></i>
                    </a>
                </div>
            </div>

            <!-- Services -->
            <div class="text-start">
                <h3 class="text-lg font-semibold mb-4">{{ __('Our Services') }}</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-300 hover:text-accent transition-colors">{{ __('Vehicle Import') }}</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-accent transition-colors">{{ __('Spare Parts') }}</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-accent transition-colors">{{ __('Vehicle Inspection') }}</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-accent transition-colors">{{ __('Business Consulting') }}</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-accent transition-colors">{{ __('Transportation') }}</a></li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div class="text-start">
                <h3 class="text-lg font-semibold mb-4">{{ __('Quick Links') }}</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-300 hover:text-accent transition-colors">{{ __('About Us') }}</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-accent transition-colors">{{ __('Contact Us') }}</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-accent transition-colors">{{ __('Blog') }}</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-accent transition-colors">{{ __('Terms & Conditions') }}</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-accent transition-colors">{{ __('Privacy Policy') }}</a></li>
                </ul>
            </div>

            <!-- Newsletter & Contact -->
            <div class="text-start">
                <h3 class="text-lg font-semibold mb-4">{{ __('Newsletter') }}</h3>

                <form class="mb-6">
                    <div class="flex space-x-2">
                        <input type="email"
                               placeholder="{{ __('Your email') }}"
                               class="flex-1 px-3 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-accent text-start">
                        <button type="submit" class="px-4 py-2 bg-accent text-primary rounded-lg hover:bg-accent/90 transition-colors">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>

                <div class="space-y-2" style="direction: ltr;">
                    <div class="flex items-center justify-start">
                        <i class="fas fa-phone text-accent mr-2"></i>
                        <span class="text-gray-300">+98 912 345 6789</span>
                    </div>
                    <div class="flex items-center justify-start">
                        <i class="fas fa-envelope text-accent mr-2"></i>
                        <span class="text-gray-300">info@hannahcar.com</span>
                    </div>
                    <div class="flex items-center justify-start">
                        <i class="fas fa-map-marker-alt text-accent mr-2"></i>
                        <span class="text-gray-300">{{ __('Tehran, Iran') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-white/20 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <p class="text-gray-300 text-sm">
                © {{ date('Y') }} {{ __('app_name') }}. {{ __('All rights reserved') }}
            </p>

            <!-- Language Switcher -->
            <div class="flex items-center space-x-4">
                <span class="text-gray-300 text-sm">{{ __('Language') }}:</span>
                                <div class="flex space-x-2">
                    @foreach(\App\Helpers\LanguageHelper::getActiveLanguages() as $lang)
                        <a href="{{ route('language.switch', $lang->code) }}"
                           class="text-sm px-2 py-1 rounded {{ app()->getLocale() === $lang->code ? 'bg-accent text-primary' : 'text-gray-300 hover:text-accent' }}">
                            {{ $lang->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</footer>
