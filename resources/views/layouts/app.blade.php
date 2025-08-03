<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $currentLanguage->direction ?? 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $siteSettings['site_name']->translations->first()?->value ?? config('app.name') }}</title>

        <!-- Meta Tags -->
        <meta name="description" content="{{ $siteSettings['site_description']->translations->first()?->value ?? '' }}">
        <meta name="keywords" content="{{ $siteSettings['site_keywords']->translations->first()?->value ?? '' }}">
        <meta name="author" content="{{ $siteSettings['site_author']->translations->first()?->value ?? '' }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Vazirmatn Font for Persian -->
        <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Font Awesome for Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

        <style>
            /* RTL Specific Styles */
            [dir="rtl"] {
                direction: rtl;
                text-align: right;
            }

            [dir="rtl"] .rtl-flip {
                transform: scaleX(-1);
            }

            [dir="rtl"] .rtl-mirror {
                transform: scaleX(-1);
            }

            [dir="rtl"] .space-x-reverse > :not([hidden]) ~ :not([hidden]) {
                --tw-space-x-reverse: 1;
            }

            [dir="rtl"] .space-x-8 > :not([hidden]) ~ :not([hidden]) {
                margin-right: calc(2rem * var(--tw-space-x-reverse));
                margin-left: calc(2rem * calc(1 - var(--tw-space-x-reverse)));
            }

            [dir="rtl"] .space-x-4 > :not([hidden]) ~ :not([hidden]) {
                margin-right: calc(1rem * var(--tw-space-x-reverse));
                margin-left: calc(1rem * calc(1 - var(--tw-space-x-reverse)));
            }

            [dir="rtl"] .space-x-2 > :not([hidden]) ~ :not([hidden]) {
                margin-right: calc(0.5rem * var(--tw-space-x-reverse));
                margin-left: calc(0.5rem * calc(1 - var(--tw-space-x-reverse)));
            }

            [dir="rtl"] .space-x-1 > :not([hidden]) ~ :not([hidden]) {
                margin-right: calc(0.25rem * var(--tw-space-x-reverse));
                margin-left: calc(0.25rem * calc(1 - var(--tw-space-x-reverse)));
            }

            /* Font Family for RTL */
            [dir="rtl"] body {
                font-family: 'Vazirmatn', 'Tahoma', 'Arial', sans-serif;
            }

            /* RTL Input Styles */
            [dir="rtl"] input, [dir="rtl"] textarea {
                text-align: right;
            }

            /* RTL Button Styles */
            [dir="rtl"] .btn-icon {
                flex-direction: row-reverse;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-surface">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center">
                            @php
                                $currentLanguage = App\Models\Language::where('code', app()->getLocale())->first();
                                $logoTranslation = $siteSettings['site_logo']->translations->where('language_id', $currentLanguage->id)->first();
                                if (!$logoTranslation) {
                                    $logoTranslation = $siteSettings['site_logo']->translations->first();
                                }
                                $nameTranslation = $siteSettings['site_name']->translations->where('language_id', $currentLanguage->id)->first();
                                if (!$nameTranslation) {
                                    $nameTranslation = $siteSettings['site_name']->translations->first();
                                }
                            @endphp
                            @if($logoTranslation?->value)
                                <img src="{{ $logoTranslation->value }}" alt="{{ $nameTranslation?->value ?? config('app.name') }}" class="h-8 w-auto ml-2">
                            @endif
                            <span class="text-primary text-xl font-bold">{{ $nameTranslation?->value ?? config('app.name') }}</span>
                        </a>
                    </div>

                    <!-- Desktop Navigation -->
                    <nav class="hidden md:flex {{ $currentLanguage->direction === 'rtl' ? 'space-x-reverse space-x-8' : 'space-x-8' }}">
                        @if(isset($menus['header']))
                            @foreach($menus['header']->menuItems->whereNull('parent_id')->sortBy('sort_order') as $menuItem)
                                @php
                                    $translation = $menuItem->translations->where('language_id', $currentLanguage->id)->first();
                                    if (!$translation) {
                                        $translation = $menuItem->translations->first();
                                    }
                                @endphp
                                <a href="{{ $menuItem->url }}" target="{{ $menuItem->target }}" class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium transition-colors">
                                    {{ $translation?->title ?? 'بدون عنوان' }}
                                </a>
                            @endforeach
                        @else
                            <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium transition-colors">
                                {{ __('Home') }}
                            </a>
                            <a href="{{ route('vehicles.index') }}" class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium transition-colors">
                                {{ __('Vehicles') }}
                            </a>
                        @endif
                    </nav>

                    <!-- Right Side -->
                    <div class="flex items-center {{ $currentLanguage->direction === 'rtl' ? 'space-x-reverse space-x-4' : 'space-x-4' }}">
                        <!-- Language Switcher -->
                        <div class="relative">
                            <button onclick="toggleLanguageMenu()" class="text-gray-700 hover:text-primary focus:outline-none">
                                <i class="fas fa-globe"></i>
                            </button>
                            <div id="languageMenu" class="hidden absolute {{ $currentLanguage->direction === 'rtl' ? 'left-0' : 'right-0' }} mt-2 w-32 bg-white rounded-md shadow-lg py-1 z-50">
                                <a href="{{ route('language.switch', 'fa') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('Persian') }}</a>
                                <a href="{{ route('language.switch', 'en') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('English') }}</a>
                                <a href="{{ route('language.switch', 'ar') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('Arabic') }}</a>
                            </div>
                        </div>

                        <!-- Search -->
                        <div class="relative">
                            <input type="text"
                                   placeholder="{{ __('Search') }}"
                                   class="w-64 {{ $currentLanguage->direction === 'rtl' ? 'pr-10 pl-4' : 'pl-10 pr-4' }} py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            <div class="absolute inset-y-0 {{ $currentLanguage->direction === 'rtl' ? 'right-0 pr-3' : 'left-0 pl-3' }} flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Auth Buttons -->
                        @auth
                            <a href="{{ route('dashboard') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition-colors">
                                {{ __('Dashboard') }}
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium transition-colors">
                                {{ __('Login') }}
                            </a>
                            <a href="{{ route('register') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition-colors">
                                {{ __('Register') }}
                            </a>
                        @endauth

                        <!-- Mobile menu button -->
                        <button class="md:hidden" onclick="toggleMobileMenu()">
                            <i class="fas fa-bars text-gray-700"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div id="mobileMenu" class="hidden md:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t">
                    @if(isset($menus['mobile']))
                        @foreach($menus['mobile']->menuItems->whereNull('parent_id')->sortBy('sort_order') as $menuItem)
                            @php
                                $translation = $menuItem->translations->where('language_id', $currentLanguage->id)->first();
                                if (!$translation) {
                                    $translation = $menuItem->translations->first();
                                }
                            @endphp
                            <a href="{{ $menuItem->url }}" target="{{ $menuItem->target }}" class="block px-3 py-2 text-gray-700 hover:text-primary">
                                {{ $translation?->title ?? 'بدون عنوان' }}
                            </a>
                        @endforeach
                    @else
                        <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-700 hover:text-primary">
                            {{ __('Home') }}
                        </a>
                        <a href="{{ route('vehicles.index') }}" class="block px-3 py-2 text-gray-700 hover:text-primary">
                            {{ __('Vehicles') }}
                        </a>
                    @endif
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1">
            @if (isset($header))
                <div class="bg-gradient-to-r from-primary to-accent text-white">
                    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                        <h1 class="text-3xl font-bold">{{ $header }}</h1>
                        @if (isset($subheader))
                            <p class="mt-2 text-lg opacity-90">{{ $subheader }}</p>
                        @endif
                    </div>
                </div>
            @endif

            {{ $slot }}
        </main>

        <!-- Footer -->
        <livewire:site-footer />

        <script>
        function toggleLanguageMenu() {
            const menu = document.getElementById('languageMenu');
            menu.classList.toggle('hidden');
        }

        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        // Close menus when clicking outside
        document.addEventListener('click', function(event) {
            const languageMenu = document.getElementById('languageMenu');
            const languageButton = event.target.closest('button[onclick="toggleLanguageMenu()"]');

            if (!languageButton) {
                languageMenu.classList.add('hidden');
            }
        });
        </script>

        @livewireScripts
    </body>
</html>
