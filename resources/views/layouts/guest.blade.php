<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'fa' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Hannah Luxury Trading') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Font Awesome for Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-primary to-accent">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <!-- Logo Section -->
            <div class="mb-8">
                <div class="flex items-center justify-center">
                    <div class="bg-white p-4 rounded-full shadow-lg">
                        <i class="fas fa-car text-primary text-4xl"></i>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <h1 class="text-3xl font-bold text-white">Hannah Luxury Trading</h1>
                    <p class="text-white/80 mt-2">پلتفرم حرفه‌ای مدیریت خودرو</p>
                </div>
            </div>

            <!-- Auth Card -->
            <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-2xl overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center text-white/60">
                <p>&copy; {{ date('Y') }} Hannah Luxury Trading. تمامی حقوق محفوظ است.</p>
            </div>
        </div>
    </body>
</html>
