<footer class="bg-primary text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div class="{{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'text-right' : 'text-left' }}">
                <div class="flex items-center {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'justify-end' : 'justify-start' }} mb-4">
                    <i class="fas fa-car text-accent text-2xl {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'ml-2' : 'mr-2' }}"></i>
                    <span class="text-xl font-bold">{{ __('app_name') }}</span>
                </div>
                <p class="text-gray-300 mb-4">
                    {{ __('Company description') }}
                </p>
                <div class="flex {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'justify-end space-x-reverse space-x-4' : 'justify-start space-x-4' }}">
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
            <div class="{{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'text-right' : 'text-left' }}">
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
            <div class="{{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'text-right' : 'text-left' }}">
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
            <div class="{{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'text-right' : 'text-left' }}">
                <h3 class="text-lg font-semibold mb-4">{{ __('Newsletter') }}</h3>
                <p class="text-gray-300 mb-4">{{ __('Newsletter description') }}</p>

                <form class="mb-6">
                    <div class="flex {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'space-x-reverse space-x-2' : 'space-x-2' }}">
                        <input type="email"
                               placeholder="{{ __('Your email') }}"
                               class="flex-1 px-3 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-accent {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'text-right' : 'text-left' }}">
                        <button type="submit" class="px-4 py-2 bg-accent text-primary rounded-lg hover:bg-accent/90 transition-colors">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>

                <div class="space-y-2">
                    <div class="flex items-center {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'justify-end' : 'justify-start' }}">
                        <i class="fas fa-phone text-accent {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'ml-2' : 'mr-2' }}"></i>
                        <span class="text-gray-300">+98 912 345 6789</span>
                    </div>
                    <div class="flex items-center {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'justify-end' : 'justify-start' }}">
                        <i class="fas fa-envelope text-accent {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'ml-2' : 'mr-2' }}"></i>
                        <span class="text-gray-300">info@hannahcar.com</span>
                    </div>
                    <div class="flex items-center {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'justify-end' : 'justify-start' }}">
                        <i class="fas fa-map-marker-alt text-accent {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'ml-2' : 'mr-2' }}"></i>
                        <span class="text-gray-300">{{ __('Tehran, Iran') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-white/20 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'space-y-reverse space-y-4 md:space-y-0' : 'space-y-4 md:space-y-0' }}">
            <p class="text-gray-300 text-sm">
                © {{ date('Y') }} {{ __('app_name') }}. {{ __('All rights reserved') }}
            </p>

            <!-- Language Switcher -->
            <div class="flex items-center {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'space-x-reverse space-x-4' : 'space-x-4' }}">
                <span class="text-gray-300 text-sm">{{ __('Language') }}:</span>
                <div class="flex {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'space-x-reverse space-x-2' : 'space-x-2' }}">
                    <a href="{{ route('language.switch', 'fa') }}" class="text-sm px-2 py-1 rounded {{ app()->getLocale() === 'fa' ? 'bg-accent text-primary' : 'text-gray-300 hover:text-accent' }}">{{ __('Persian') }}</a>
                    <a href="{{ route('language.switch', 'en') }}" class="text-sm px-2 py-1 rounded {{ app()->getLocale() === 'en' ? 'bg-accent text-primary' : 'text-gray-300 hover:text-accent' }}">{{ __('English') }}</a>
                    <a href="{{ route('language.switch', 'ar') }}" class="text-sm px-2 py-1 rounded {{ app()->getLocale() === 'ar' ? 'bg-accent text-primary' : 'text-gray-300 hover:text-accent' }}">{{ __('Arabic') }}</a>
                </div>
            </div>
        </div>
    </div>
</footer>
