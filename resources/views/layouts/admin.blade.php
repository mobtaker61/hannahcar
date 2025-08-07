<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - ادمین</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        <nav class="bg-secondary border-b border-gray-100 ">
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex {{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'flex-row' : 'flex-row-reverse' }} justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-gray-800">
                                {{ config('app.name', 'Laravel') }} - ادمین
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('admin.dashboard') }}"
                               class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                داشبورد
                            </a>
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-auto relative">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out" id="user-menu-button">
                            <div class="text-right mr-2">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-400">{{ Auth::user()->email }}</div>
                            </div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                        <div class="absolute mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg py-2 z-50" id="user-menu-dropdown" style="min-width: 180px; right: 0; top: 100%; display: none;">
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i class="fas fa-user ml-2"></i>داشبورد</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-right px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i class="fas fa-sign-out-alt ml-2"></i>خروج</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="flex">
            <!-- Sidebar -->
            <div class="w-64 bg-white shadow-lg min-h-screen">
                <div class="p-4">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">مدیریت محتوا</h2>

                    <!-- Settings Menu -->
                    <div class="space-y-2">

                        <!-- Inquiries Submenu -->
                        <div class="relative">
                            <button class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                                <span class="flex items-center">
                                    <i class="fas fa-clipboard-list ml-2"></i>
                                    استعلامات
                                </span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div class="hidden mt-1 space-y-1">
                                <a href="{{ route('admin.inquiry-forms.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md">
                                    <i class="fas fa-list ml-2"></i>
                                    مدیریت فرم‌ها
                                </a>
                                <a href="{{ route('admin.inquiry-forms.create') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md">
                                    <i class="fas fa-plus ml-2"></i>
                                    فرم جدید
                                </a>
                                <a href="{{ route('admin.inquiries.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md">
                                    <i class="fas fa-clipboard-check ml-2"></i>
                                    فرم‌های تکمیل شده
                                </a>
                            </div>
                        </div>

                        <!-- Articles & News Submenu -->
                        <div class="relative">
                            <button class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                                <span class="flex items-center">
                                    <i class="fas fa-newspaper ml-2"></i>
                                    اخبار و مقالات
                                </span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div class="hidden mt-1 space-y-1">
                                <a href="{{ route('admin.articles.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md">
                                    <i class="fas fa-list ml-2"></i>
                                    مدیریت مقالات
                                </a>
                                <a href="{{ route('admin.articles.create') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md">
                                    <i class="fas fa-plus ml-2"></i>
                                    مقاله جدید
                                </a>
                                <a href="{{ route('admin.categories.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md">
                                    <i class="fas fa-folder ml-2"></i>
                                    دسته‌بندی‌ها
                                </a>
                                <a href="{{ route('admin.categories.create') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md">
                                    <i class="fas fa-folder-plus ml-2"></i>
                                    دسته‌بندی جدید
                                </a>
                            </div>
                        </div>

                        <!-- Services Submenu -->
                        <div class="relative">
                            <button class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                                <span class="flex items-center">
                                    <i class="fas fa-cogs ml-2"></i>
                                    خدمات
                                </span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div class="hidden mt-1 space-y-1">
                                <a href="{{ route('admin.services.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md">
                                    <i class="fas fa-list ml-2"></i>
                                    لیست خدمات
                                </a>
                                <a href="{{ route('admin.services.create') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md">
                                    <i class="fas fa-plus ml-2"></i>
                                    خدمت جدید
                                </a>
                            </div>
                        </div>

                        <!-- Vehicles Submenu -->
                        <div class="relative">
                            <button class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                                <span class="flex items-center">
                                    <i class="fas fa-car ml-2"></i>
                                    مدیریت خودروها
                                </span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div class="hidden mt-1 space-y-1">
                                <a href="{{ route('admin.vehicles.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md">
                                    <i class="fas fa-list ml-2"></i>
                                    لیست خودروها
                                </a>
                                <a href="{{ route('admin.vehicles.create') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md">
                                    <i class="fas fa-plus ml-2"></i>
                                    خودرو جدید
                                </a>
                                <a href="{{ route('admin.vehicle-brands.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md">
                                    <i class="fas fa-tags ml-2"></i>
                                    برندهای خودرو
                                </a>
                                <a href="{{ route('admin.vehicle-models.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md">
                                    <i class="fas fa-car-side ml-2"></i>
                                    مدل‌های خودرو
                                </a>
                                <a href="{{ route('admin.vehicle-specifications.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md">
                                    <i class="fas fa-cogs ml-2"></i>
                                    ویژگی‌های خودرو
                                </a>
                            </div>
                        </div>

                        <!-- Menus Submenu -->
                        <div class="relative">
                            <button class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                                <span class="flex items-center">
                                    <i class="fas fa-bars ml-2"></i>
                                    ساختار
                                </span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div class="hidden mt-1 space-y-1">
                                <a href="{{ route('admin.menus.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md">
                                    مدیریت منوها
                                </a>
                                <a href="{{ route('admin.pages.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md">
                                    مدیریت صفحات
                                </a>
                            </div>
                        </div>

                        <!-- Display Settings Submenu -->
                        <div class="relative">
                            <button class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                                <span class="flex items-center">
                                    <i class="fas fa-cog ml-2"></i>
                                    تنظیمات
                                </span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div class="hidden mt-1 space-y-1">
                                <a href="{{ route('admin.languages.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md">
                                    مدیریت زبان‌ها
                                </a>
                                <a href="{{ route('admin.hero-sliders.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md">
                                    اسلایدر اصلی
                                </a>
                                <a href="{{ route('admin.homepage-blocks.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md">
                                    بلوک‌های صفحه اول
                                </a>
                                <a href="{{ route('admin.settings.index') }}" class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md">
                                    تنظیمات سایت
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 p-0">
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ $header }}
                            </h2>
                        </div>
                    </header>
                @endif

                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    <!-- JavaScript for Dropdowns -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButtons = document.querySelectorAll('.relative button');

            dropdownButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const dropdown = this.nextElementSibling;
                    dropdown.classList.toggle('hidden');
                });
            });

            // Initialize CKEditor for content fields
            const contentTextareas = document.querySelectorAll('textarea.ckeditor');
            contentTextareas.forEach(function(textarea) {
                ClassicEditor
                    .create(textarea, {
                        toolbar: {
                            items: [
                                'heading',
                                '|',
                                'bold',
                                'italic',
                                'link',
                                'bulletedList',
                                'numberedList',
                                '|',
                                'outdent',
                                'indent',
                                '|',
                                'imageUpload',
                                'blockQuote',
                                'insertTable',
                                'mediaEmbed',
                                'undo',
                                'redo'
                            ]
                        },
                        language: 'fa',
                        image: {
                            toolbar: [
                                'imageTextAlternative',
                                'imageStyle:full',
                                'imageStyle:side'
                            ]
                        },
                        table: {
                            contentToolbar: [
                                'tableColumn',
                                'tableRow',
                                'mergeTableCells'
                            ]
                        }
                    })
                    .then(editor => {
                        console.log('CKEditor initialized for:', textarea.name);
                    })
                    .catch(error => {
                        console.error('Error initializing CKEditor:', error);
                    });
            });

                        // User menu dropdown
            const userMenuBtn = document.getElementById('user-menu-button');
            const userMenuDropdown = document.getElementById('user-menu-dropdown');

            console.log('User menu button:', userMenuBtn);
            console.log('User menu dropdown:', userMenuDropdown);

            if (userMenuBtn && userMenuDropdown) {
                userMenuBtn.addEventListener('click', function(e) {
                    console.log('Button clicked!');
                    e.preventDefault();
                    e.stopPropagation();

                    const isHidden = userMenuDropdown.style.display === 'none';
                    console.log('Dropdown is hidden:', isHidden);

                    if (isHidden) {
                        userMenuDropdown.style.display = 'block';
                    } else {
                        userMenuDropdown.style.display = 'none';
                    }

                    // Add visual feedback
                    const chevron = this.querySelector('svg');
                    if (chevron) {
                        chevron.style.transform = userMenuDropdown.style.display === 'none' ? 'rotate(0deg)' : 'rotate(180deg)';
                    }
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!userMenuDropdown.contains(e.target) && !userMenuBtn.contains(e.target)) {
                        userMenuDropdown.style.display = 'none';
                        const chevron = userMenuBtn.querySelector('svg');
                        if (chevron) {
                            chevron.style.transform = 'rotate(0deg)';
                        }
                    }
                });
            } else {
                console.error('User menu elements not found!');
            }
        });
    </script>
</body>
</html>
