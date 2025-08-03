<x-app-layout>
    <x-slot name="header">
        {{ $currentTranslation->title ?? 'صفحه' }}
    </x-slot>

    @if($page->template === 'simple')
        <!-- Simple Template -->
        <div class="py-12">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-8">
                        <!-- Page Title -->
                        <h1 class="text-3xl font-bold text-gray-900 mb-6">
                            {{ $currentTranslation->title ?? 'بدون عنوان' }}
                        </h1>

                        <!-- Page Meta -->
                        <div class="flex items-center text-sm text-gray-500 mb-8 {{ $currentLanguage->direction === 'rtl' ? 'space-x-reverse space-x-4' : 'space-x-4' }}">
                            <span class="{{ $currentLanguage->direction === 'rtl' ? 'ml-4' : 'mr-4' }}">
                                <i class="fas fa-calendar {{ $currentLanguage->direction === 'rtl' ? 'ml-1' : 'mr-1' }}"></i>
                                {{ $page->created_at->format('Y/m/d') }}
                            </span>
                            <span class="{{ $currentLanguage->direction === 'rtl' ? 'ml-4' : 'mr-4' }}">
                                <i class="fas fa-user {{ $currentLanguage->direction === 'rtl' ? 'ml-1' : 'mr-1' }}"></i>
                                {{ __('Admin') }}
                            </span>
                            <span>
                                <i class="fas fa-eye {{ $currentLanguage->direction === 'rtl' ? 'ml-1' : 'mr-1' }}"></i>
                                {{ __('Published') }}
                            </span>
                        </div>

                        <!-- Page Content -->
                        <div class="prose prose-lg max-w-none {{ $currentLanguage->direction === 'rtl' ? 'text-right' : 'text-left' }}">
                            {!! $currentTranslation->content ?? 'محتوایی برای نمایش وجود ندارد.' !!}
                        </div>

                        <!-- Page Meta Tags -->
                        @if($currentTranslation->meta_description || $currentTranslation->meta_keywords)
                            <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                                <h3 class="text-sm font-medium text-gray-700 mb-2">{{ __('Meta Information') }}</h3>
                                @if($currentTranslation->meta_description)
                                    <p class="text-sm text-gray-600 mb-2">
                                        <strong>{{ __('Description') }}:</strong> {{ $currentTranslation->meta_description }}
                                    </p>
                                @endif
                                @if($currentTranslation->meta_keywords)
                                    <p class="text-sm text-gray-600">
                                        <strong>{{ __('Keywords') }}:</strong> {{ $currentTranslation->meta_keywords }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Sidebar Template -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                    <!-- Main Content -->
                    <div class="lg:col-span-3">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-8">
                                <!-- Page Title -->
                                <h1 class="text-3xl font-bold text-gray-900 mb-6">
                                    {{ $currentTranslation->title ?? 'بدون عنوان' }}
                                </h1>

                                <!-- Page Meta -->
                                <div class="flex items-center text-sm text-gray-500 mb-8 {{ $currentLanguage->direction === 'rtl' ? 'space-x-reverse space-x-4' : 'space-x-4' }}">
                                    <span class="{{ $currentLanguage->direction === 'rtl' ? 'ml-4' : 'mr-4' }}">
                                        <i class="fas fa-calendar {{ $currentLanguage->direction === 'rtl' ? 'ml-1' : 'mr-1' }}"></i>
                                        {{ $page->created_at->format('Y/m/d') }}
                                    </span>
                                    <span class="{{ $currentLanguage->direction === 'rtl' ? 'ml-4' : 'mr-4' }}">
                                        <i class="fas fa-user {{ $currentLanguage->direction === 'rtl' ? 'ml-1' : 'mr-1' }}"></i>
                                        {{ __('Admin') }}
                                    </span>
                                    <span>
                                        <i class="fas fa-eye {{ $currentLanguage->direction === 'rtl' ? 'ml-1' : 'mr-1' }}"></i>
                                        {{ __('Published') }}
                                    </span>
                                </div>

                                <!-- Page Content -->
                                <div class="prose prose-lg max-w-none {{ $currentLanguage->direction === 'rtl' ? 'text-right' : 'text-left' }}">
                                    {!! $currentTranslation->content ?? 'محتوایی برای نمایش وجود ندارد.' !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:col-span-1">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Page Information') }}</h3>

                                <!-- Page Meta Tags -->
                                @if($currentTranslation->meta_description || $currentTranslation->meta_keywords)
                                    <div class="space-y-4">
                                        @if($currentTranslation->meta_description)
                                            <div>
                                                <h4 class="text-sm font-medium text-gray-700 mb-1">{{ __('Description') }}</h4>
                                                <p class="text-sm text-gray-600">{{ $currentTranslation->meta_description }}</p>
                                            </div>
                                        @endif
                                        @if($currentTranslation->meta_keywords)
                                            <div>
                                                <h4 class="text-sm font-medium text-gray-700 mb-1">{{ __('Keywords') }}</h4>
                                                <p class="text-sm text-gray-600">{{ $currentTranslation->meta_keywords }}</p>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                <!-- Template Info -->
                                <div class="mt-6 pt-6 border-t border-gray-200">
                                    <h4 class="text-sm font-medium text-gray-700 mb-1">{{ __('Template') }}</h4>
                                    <p class="text-sm text-gray-600">{{ $page->template === 'simple' ? __('Simple') : __('Sidebar') }}</p>
                                </div>

                                <!-- Last Updated -->
                                <div class="mt-4">
                                    <h4 class="text-sm font-medium text-gray-700 mb-1">{{ __('Last Updated') }}</h4>
                                    <p class="text-sm text-gray-600">{{ $page->updated_at->format('Y/m/d H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-app-layout>
