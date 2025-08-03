@extends('layouts.base')

@section('body')
    <div class="flex flex-col justify-center min-h-screen py-12 bg-gradient-to-br from-primary to-accent sm:px-6 lg:px-8">
        <!-- Logo Section -->
        <div class="sm:mx-auto sm:w-full sm:max-w-md mb-8">
            <div class="flex justify-center">
                <div class="bg-white p-4 rounded-full shadow-lg">
                    <i class="fas fa-car text-primary text-4xl"></i>
                </div>
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-white">
                Hannah Luxury Trading
            </h2>
            <p class="mt-2 text-center text-sm text-white/80">
                پلتفرم حرفه‌ای مدیریت خودرو
            </p>
        </div>

        <!-- Auth Content -->
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow-2xl sm:rounded-lg sm:px-10">
                @yield('content')

                @isset($slot)
                    {{ $slot }}
                @endisset
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center text-white/60">
            <p>&copy; {{ date('Y') }} Hannah Luxury Trading. تمامی حقوق محفوظ است.</p>
        </div>
    </div>
@endsection
