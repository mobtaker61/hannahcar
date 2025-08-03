<div class="flex items-center justify-between w-full"
     wire:init="
        // Initialize component
        console.log('Navigation initialized');
     ">
    <!-- Left Side: Mobile Menu & Search -->
    <div class="flex items-center flex-1 min-w-0">
        <!-- Mobile menu button -->
        <button wire:click="toggleSidebar" class="md:hidden px-3 py-2 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-accent">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Search Bar -->
        <div class="flex-1 flex ml-2 md:ml-4">
            <div class="relative w-full max-w-md text-gray-400 focus-within:text-gray-600">
                <div class="absolute inset-y-0 {{ app()->getLocale() === 'fa' ? 'right-0' : 'left-0' }} flex items-center pointer-events-none px-3">
                    <i class="fas fa-search"></i>
                </div>
                <input wire:model.live="searchQuery"
                       class="block w-full h-10 {{ app()->getLocale() === 'fa' ? 'pr-10 pl-3' : 'pl-10 pr-3' }} py-2 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent sm:text-sm"
                       placeholder="{{ __('Search vehicles, parts...') }}"
                       type="search">
            </div>
        </div>
    </div>

    <!-- Right Side: Language & User Menu -->
    <div class="flex items-center space-x-2 {{ app()->getLocale() === 'fa' ? 'space-x-reverse' : '' }} ml-4">
        <!-- Language Switcher -->
        <div class="relative">
            <button onclick="toggleLanguageMenu()"
                    class="p-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-600 focus:outline-none focus:ring-2 focus:ring-accent transition-colors duration-200">
                <i class="fas fa-globe text-sm"></i>
            </button>
            <div id="languageMenu" class="hidden absolute {{ app()->getLocale() === 'fa' ? 'left-0' : 'right-0' }} top-full mt-1 w-32 rounded-lg shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                <a href="{{ route('language.switch', 'fa') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('Persian') }}</a>
                <a href="{{ route('language.switch', 'en') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('English') }}</a>
                <a href="{{ route('language.switch', 'ar') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('Arabic') }}</a>
            </div>
        </div>

        <!-- User Dropdown -->
        <div class="relative">
            <button onclick="toggleUserMenu()"
                    class="p-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-600 focus:outline-none focus:ring-2 focus:ring-accent transition-colors duration-200">
                <i class="fas fa-user-circle text-lg"></i>
            </button>
            <div id="userMenu" class="hidden absolute {{ app()->getLocale() === 'fa' ? 'left-0' : 'right-0' }} top-full mt-1 w-48 rounded-lg shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                <div class="px-3 py-2 text-sm text-gray-700 border-b border-gray-100">
                    <div class="font-medium truncate">{{ auth()->user()->name }}</div>
                    <div class="text-gray-500 text-xs truncate">{{ auth()->user()->email }}</div>
                </div>
                <a href="#" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-user {{ app()->getLocale() === 'fa' ? 'ml-2' : 'mr-2' }}"></i>
                    {{ __('Profile') }}
                </a>
                <a href="#" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-cog {{ app()->getLocale() === 'fa' ? 'ml-2' : 'mr-2' }}"></i>
                    {{ __('Settings') }}
                </a>
                <button onclick="performLogout()"
                        class="block w-full {{ app()->getLocale() === 'fa' ? 'text-right' : 'text-left' }} px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-sign-out-alt {{ app()->getLocale() === 'fa' ? 'ml-2' : 'mr-2' }}"></i>
                    {{ __('Logout') }}
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function toggleLanguageMenu() {
    const menu = document.getElementById('languageMenu');
    const userMenu = document.getElementById('userMenu');
    userMenu.classList.add('hidden');
    menu.classList.toggle('hidden');
}

function toggleUserMenu() {
    const menu = document.getElementById('userMenu');
    const languageMenu = document.getElementById('languageMenu');
    languageMenu.classList.add('hidden');
    menu.classList.toggle('hidden');
}

function performLogout() {
    // Create a form and submit it
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route('logout') }}';

    // Add CSRF token
    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = '{{ csrf_token() }}';
    form.appendChild(csrfToken);

    // Submit form
    document.body.appendChild(form);
    form.submit();
}

// Close menus when clicking outside
document.addEventListener('click', function(event) {
    const languageMenu = document.getElementById('languageMenu');
    const userMenu = document.getElementById('userMenu');
    const languageButton = event.target.closest('button[onclick="toggleLanguageMenu()"]');
    const userButton = event.target.closest('button[onclick="toggleUserMenu()"]');

    if (!languageButton && !userButton) {
        languageMenu.classList.add('hidden');
        userMenu.classList.add('hidden');
    }
});
</script>
