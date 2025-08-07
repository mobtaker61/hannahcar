<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $currentLanguage->direction ?? 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $siteSettings['site_name']->translations->first()?->value ?? config('app.name') }}</title>

    <!-- Favicon -->
    @php
        $siteFavicon = \App\Helpers\SettingHelper::getFilePath('site_favicon');
    @endphp
    @if($siteFavicon)
        <link rel="icon" type="image/x-icon" href="{{ asset($siteFavicon) }}">
    @endif

    <!-- Meta Tags -->
    <meta name="description" content="{{ $siteSettings['site_description']->translations->first()?->value ?? '' }}">
    <meta name="keywords" content="{{ $siteSettings['site_keywords']->translations->first()?->value ?? '' }}">
    <meta name="author" content="{{ $siteSettings['site_author']->translations->first()?->value ?? '' }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vazirmatn Font for Persian -->
    <link
        href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

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

        [dir="rtl"] .space-x-reverse> :not([hidden])~ :not([hidden]) {
            --tw-space-x-reverse: 1;
        }

        [dir="rtl"] .space-x-8> :not([hidden])~ :not([hidden]) {
            margin-right: calc(2rem * var(--tw-space-x-reverse));
            margin-left: calc(2rem * calc(1 - var(--tw-space-x-reverse)));
        }

        [dir="rtl"] .space-x-4> :not([hidden])~ :not([hidden]) {
            margin-right: calc(1rem * var(--tw-space-x-reverse));
            margin-left: calc(1rem * calc(1 - var(--tw-space-x-reverse)));
        }

        [dir="rtl"] .space-x-2> :not([hidden])~ :not([hidden]) {
            margin-right: calc(0.5rem * var(--tw-space-x-reverse));
            margin-left: calc(0.5rem * calc(1 - var(--tw-space-x-reverse)));
        }

        [dir="rtl"] .space-x-1> :not([hidden])~ :not([hidden]) {
            margin-right: calc(0.25rem * var(--tw-space-x-reverse));
            margin-left: calc(0.25rem * calc(1 - var(--tw-space-x-reverse)));
        }

        /* Font Family for RTL */
        [dir="rtl"] body {
            font-family: 'Vazirmatn', 'Tahoma', 'Arial', sans-serif;
        }

        /* RTL Input Styles */
        [dir="rtl"] input,
        [dir="rtl"] textarea {
            text-align: right;
        }

        /* RTL Button Styles */
        [dir="rtl"] .btn-icon {
            flex-direction: row-reverse;
        }

        /* RTL Search Input Styles */
        [dir="rtl"] .search-input {
            padding-left: 1rem !important;
            padding-right: 2.5rem !important;
        }

        [dir="rtl"] .search-icon {
            left: auto !important;
            right: 0.75rem !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-surface">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Left Side -->
                <div class="flex items-center space-x-8">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center">
                            @php
                                $currentLanguage = App\Models\Language::where('code', app()->getLocale())->first();
                                $logoUrl = \App\Helpers\SettingHelper::get('site_logo');
                                $nameTranslation = $siteSettings['site_name']->translations
                                    ->where('language_id', $currentLanguage->id)
                                    ->first();
                                if (!$nameTranslation) {
                                    $nameTranslation = $siteSettings['site_name']->translations->first();
                                }
                            @endphp

                            @if($logoUrl)
                                <img src="{{ asset($logoUrl) }}"
                                    alt="{{ $nameTranslation?->value ?? config('app.name') }}" class="h-8 w-auto me-2">
                            @else
                                <span class="text-primary text-xl font-bold">{{ $nameTranslation?->value ?? config('app.name') }}</span>
                            @endif
                        </a>
                    </div>
                    <!-- Desktop Navigation -->
                    <nav class="hidden md:flex space-x-6">
                        @if (isset($menus['header']))
                            @foreach ($menus['header']->menuItems->whereNull('parent_id')->where('is_active', true)->sortBy('sort_order') as $menuItem)
                                @php
                                    $translation = $menuItem->translations
                                        ->where('language_id', $currentLanguage->id)
                                        ->first();
                                    if (!$translation) {
                                        $translation = $menuItem->translations->first();
                                    }
                                    $hasChildren =
                                        $menus['header']->menuItems
                                            ->where('parent_id', $menuItem->id)
                                            ->where('is_active', true)
                                            ->count() > 0;
                                @endphp

                                @if ($hasChildren)
                                    <div class="relative group">
                                        <div class="flex items-center">
                                            <a href="{{ $menuItem->url }}" target="{{ $menuItem->target }}"
                                                class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium transition-colors">
                                                {{ $translation?->title ?? 'بدون عنوان' }}
                                            </a>
                                            <button
                                                class="text-gray-700 hover:text-primary px-1 py-2 text-sm font-medium transition-colors"
                                                onclick="toggleDesktopSubmenu('desktop-submenu-{{ $menuItem->id }}')">
                                                <i class="fas fa-chevron-down text-xs transition-transform"
                                                    id="desktop-chevron-{{ $menuItem->id }}"></i>
                                            </button>
                                        </div>
                                        <div id="desktop-submenu-{{ $menuItem->id }}"
                                            class="hidden absolute start-0 top-full mt-1 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                            @foreach ($menus['header']->menuItems->where('parent_id', $menuItem->id)->where('is_active', true)->sortBy('sort_order') as $childItem)
                                                @php
                                                    $childTranslation = $childItem->translations
                                                        ->where('language_id', $currentLanguage->id)
                                                        ->first();
                                                    if (!$childTranslation) {
                                                        $childTranslation = $childItem->translations->first();
                                                    }
                                                @endphp
                                                <a href="{{ $childItem->url }}" target="{{ $childItem->target }}"
                                                    class="block px-4 py-2 text-sm text-gray-700 hover:text-primary hover:bg-gray-100">
                                                    {{ $childTranslation?->title ?? 'بدون عنوان' }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ $menuItem->url }}" target="{{ $menuItem->target }}"
                                        class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium transition-colors">
                                        {{ $translation?->title ?? 'بدون عنوان' }}
                                    </a>
                                @endif
                            @endforeach
                        @else
                            <a href="{{ route('home') }}"
                                class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium transition-colors">
                                {{ __('Home') }}
                            </a>
                            <a href="{{ route('vehicles.index') }}"
                                class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium transition-colors">
                                {{ __('Vehicles') }}
                            </a>
                        @endif
                    </nav>
                </div>
                <!-- Right Side -->
                <div class="flex items-center space-x-6">
                    <!-- Language Switcher -->
                    <div class="relative" style="margin: 0 10px;">
                        <button onclick="toggleLanguageMenu()"
                            class="text-gray-700 hover:text-primary focus:outline-none">
                            <i class="fas fa-globe"></i>
                        </button>
                        <div id="languageMenu"
                            class="hidden absolute end-0 mt-2 w-32 bg-white rounded-md shadow-lg py-1 z-50">
                            @foreach (\App\Helpers\LanguageHelper::getActiveLanguages() as $lang)
                                <a href="{{ route('language.switch', $lang->code) }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ app()->getLocale() === $lang->code ? 'bg-gray-100 font-medium' : '' }}">
                                    {{ $lang->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Search -->
                    <div class="relative">
                        <input type="text" placeholder="{{ __('Search') }}"
                            class="search-input w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        <div class="search-icon absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Auth Buttons -->
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition-colors">
                            {{ __('Dashboard') }}
                        </a>
                    @else
                        <div class="flex items-center hidden">
                            <a href="{{ route('login') }}"
                                class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium transition-colors">
                                {{ __('Login') }}
                            </a>
                            <a href="{{ route('register') }}"
                                class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition-colors">
                                {{ __('Register') }}
                            </a>
                        </div>
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
                @if (isset($menus['mobile']))
                    @foreach ($menus['mobile']->menuItems->whereNull('parent_id')->where('is_active', true)->sortBy('sort_order') as $menuItem)
                        @php
                            $translation = $menuItem->translations->where('language_id', $currentLanguage->id)->first();
                            if (!$translation) {
                                $translation = $menuItem->translations->first();
                            }
                            $hasChildren =
                                $menus['mobile']->menuItems
                                    ->where('parent_id', $menuItem->id)
                                    ->where('is_active', true)
                                    ->count() > 0;
                        @endphp

                        @if ($hasChildren)
                            <div class="mobile-menu-item">
                                <div class="flex items-center justify-between">
                                    <a href="{{ $menuItem->url }}" target="{{ $menuItem->target }}"
                                        class="flex-1 px-3 py-2 text-gray-700 hover:text-primary">
                                        {{ $translation?->title ?? 'بدون عنوان' }}
                                    </a>
                                    <button onclick="toggleMobileSubmenu('mobile-submenu-{{ $menuItem->id }}')"
                                        class="px-3 py-2 text-gray-700 hover:text-primary">
                                        <i class="fas fa-chevron-down text-xs transition-transform"
                                            id="mobile-chevron-{{ $menuItem->id }}"></i>
                                    </button>
                                </div>
                                <div id="mobile-submenu-{{ $menuItem->id }}"
                                    class="hidden ps-4 border-s-2 border-gray-200">
                                    @foreach ($menus['mobile']->menuItems->where('parent_id', $menuItem->id)->where('is_active', true)->sortBy('sort_order') as $childItem)
                                        @php
                                            $childTranslation = $childItem->translations
                                                ->where('language_id', $currentLanguage->id)
                                                ->first();
                                            if (!$childTranslation) {
                                                $childTranslation = $childItem->translations->first();
                                            }
                                        @endphp
                                        <a href="{{ $childItem->url }}" target="{{ $childItem->target }}"
                                            class="block px-3 py-2 text-gray-600 hover:text-primary text-sm">
                                            {{ $childTranslation?->title ?? 'بدون عنوان' }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <a href="{{ $menuItem->url }}" target="{{ $menuItem->target }}"
                                class="block px-3 py-2 text-gray-700 hover:text-primary">
                                {{ $translation?->title ?? 'بدون عنوان' }}
                            </a>
                        @endif
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

        function toggleMobileSubmenu(submenuId) {
            const submenu = document.getElementById(submenuId);
            const chevron = document.getElementById(submenuId.replace('mobile-submenu-', 'mobile-chevron-'));

            if (submenu.classList.contains('hidden')) {
                submenu.classList.remove('hidden');
                chevron.style.transform = 'rotate(180deg)';
            } else {
                submenu.classList.add('hidden');
                chevron.style.transform = 'rotate(0deg)';
            }
        }

        function toggleDesktopSubmenu(submenuId) {
            const submenu = document.getElementById(submenuId);
            const chevron = document.getElementById(submenuId.replace('desktop-submenu-', 'desktop-chevron-'));

            if (submenu.classList.contains('hidden')) {
                submenu.classList.remove('hidden');
                chevron.style.transform = 'rotate(180deg)';
            } else {
                submenu.classList.add('hidden');
                chevron.style.transform = 'rotate(0deg)';
            }
        }

        // Close menus when clicking outside
        document.addEventListener('click', function(event) {
            const languageMenu = document.getElementById('languageMenu');
            const languageButton = event.target.closest('button[onclick="toggleLanguageMenu()"]');
            const desktopSubmenuButtons = document.querySelectorAll('button[onclick^="toggleDesktopSubmenu"]');
            const mobileSubmenuButtons = document.querySelectorAll('button[onclick^="toggleMobileSubmenu"]');

            // Close language menu
            if (!languageButton) {
                languageMenu.classList.add('hidden');
            }

            // Close desktop submenus when clicking outside
            desktopSubmenuButtons.forEach(button => {
                const submenuId = button.getAttribute('onclick').match(/toggleDesktopSubmenu\('([^']+)'\)/)[
                    1];
                const submenu = document.getElementById(submenuId);
                const isClickInside = event.target.closest(`#${submenuId}`) || event.target.closest(
                    `button[onclick*="${submenuId}"]`);

                if (!isClickInside) {
                    submenu.classList.add('hidden');
                    const chevron = document.getElementById(submenuId.replace('desktop-submenu-',
                        'desktop-chevron-'));
                    chevron.style.transform = 'rotate(0deg)';
                }
            });

            // Close mobile submenus when clicking outside
            mobileSubmenuButtons.forEach(button => {
                const submenuId = button.getAttribute('onclick').match(/toggleMobileSubmenu\('([^']+)'\)/)[
                    1];
                const submenu = document.getElementById(submenuId);
                const isClickInside = event.target.closest(`#${submenuId}`) || event.target.closest(
                    `button[onclick*="${submenuId}"]`);

                if (!isClickInside) {
                    submenu.classList.add('hidden');
                    const chevron = document.getElementById(submenuId.replace('mobile-submenu-',
                        'mobile-chevron-'));
                    chevron.style.transform = 'rotate(0deg)';
                }
            });
        });
    </script>

    @livewireScripts
</body>

</html>
