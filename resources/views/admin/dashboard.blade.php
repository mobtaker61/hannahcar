<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="text-sm text-gray-500">
                {{ __('Welcome back') }}, {{ Auth::user()->name }}
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Users Stats -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                            <div class="mr-4">
                                <div class="text-sm font-medium text-gray-500">{{ __('Users') }}</div>
                                <div class="text-2xl font-semibold text-gray-900">{{ \App\Models\User::count() }}</div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                {{ __('View All') }} →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Articles Stats -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                            <div class="mr-4">
                                <div class="text-sm font-medium text-gray-500">{{ __('Articles') }}</div>
                                <div class="text-2xl font-semibold text-gray-900">{{ \App\Models\Article::count() }}</div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.articles.index') }}" class="text-green-600 hover:text-green-800 text-sm font-medium">
                                {{ __('View All') }} →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Vehicles Stats -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <div class="mr-4">
                                <div class="text-sm font-medium text-gray-500">{{ __('Vehicles') }}</div>
                                <div class="text-2xl font-semibold text-gray-900">{{ \App\Models\Vehicle::count() }}</div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.vehicles.index') }}" class="text-purple-600 hover:text-purple-800 text-sm font-medium">
                                {{ __('View All') }} →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Inquiries Stats -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <div class="mr-4">
                                <div class="text-sm font-medium text-gray-500">{{ __('Inquiries') }}</div>
                                <div class="text-2xl font-semibold text-gray-900">
                                    {{ \App\Models\InquirySpecialCarPurchase::count() + \App\Models\InquirySpecialSparePart::count() + \App\Models\InquiryVinCheck::count() }}
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.inquiries.index') }}" class="text-orange-600 hover:text-orange-800 text-sm font-medium">
                                {{ __('View All') }} →
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Quick Actions') }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('admin.articles.create') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <svg class="w-5 h-5 text-green-500 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">{{ __('New Article') }}</span>
                        </a>
                        <a href="{{ route('admin.vehicles.create') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <svg class="w-5 h-5 text-purple-500 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">{{ __('New Vehicle') }}</span>
                        </a>
                        <a href="{{ route('admin.inquiry-forms.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <svg class="w-5 h-5 text-orange-500 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">{{ __('Manage Forms') }}</span>
                        </a>
                        <a href="{{ route('admin.settings.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <svg class="w-5 h-5 text-blue-500 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">{{ __('Settings') }}</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity & System Info -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Activity -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Recent Activity') }}</h3>
                        <div class="space-y-4">
                            <!-- Recent Articles -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-700 mb-2">{{ __('Recent Articles') }}</h4>
                                @php
                                    $recentArticles = \App\Models\Article::with('translations.language')
                                        ->orderBy('created_at', 'desc')
                                        ->take(3)
                                        ->get();
                                @endphp
                                @if($recentArticles->count() > 0)
                                    <div class="space-y-2">
                                        @foreach($recentArticles as $article)
                                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $article->translations->first()?->title ?? $article->slug }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $article->created_at->diffForHumans() }}
                                                    </div>
                                                </div>
                                                <a href="{{ route('admin.articles.edit', $article) }}" class="text-green-600 hover:text-green-800 text-sm">
                                                    {{ __('Edit') }}
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500">{{ __('No articles found.') }}</p>
                                @endif
                            </div>

                            <!-- Recent Vehicles -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-700 mb-2">{{ __('Recent Vehicles') }}</h4>
                                @php
                                    $recentVehicles = \App\Models\Vehicle::with('brand', 'model')
                                        ->orderBy('created_at', 'desc')
                                        ->take(3)
                                        ->get();
                                @endphp
                                @if($recentVehicles->count() > 0)
                                    <div class="space-y-2">
                                        @foreach($recentVehicles as $vehicle)
                                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $vehicle->brand?->name }} {{ $vehicle->model?->name }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $vehicle->created_at->diffForHumans() }}
                                                    </div>
                                                </div>
                                                <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="text-purple-600 hover:text-purple-800 text-sm">
                                                    {{ __('Edit') }}
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500">{{ __('No vehicles found.') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Information -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('System Information') }}</h3>
                        <div class="space-y-4">
                            <!-- Server Info -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-700 mb-2">{{ __('Server Information') }}</h4>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">{{ __('PHP Version') }}:</span>
                                        <span class="font-medium">{{ phpversion() }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">{{ __('Laravel Version') }}:</span>
                                        <span class="font-medium">{{ app()->version() }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">{{ __('Database') }}:</span>
                                        <span class="font-medium">{{ config('database.default') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Storage Info -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-700 mb-2">{{ __('Storage Information') }}</h4>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">{{ __('Files Count') }}:</span>
                                        <span class="font-medium">
                                            @php
                                                try {
                                                    $storagePath = storage_path('app/public');
                                                    if (is_dir($storagePath)) {
                                                        $files = new RecursiveIteratorIterator(
                                                            new RecursiveDirectoryIterator($storagePath, RecursiveDirectoryIterator::SKIP_DOTS)
                                                        );
                                                        $fileCount = 0;
                                                        foreach ($files as $file) {
                                                            if ($file->isFile()) {
                                                                $fileCount++;
                                                            }
                                                        }
                                                        echo $fileCount . ' ' . __('files');
                                                    } else {
                                                        echo 'N/A';
                                                    }
                                                } catch (\Exception $e) {
                                                    echo 'N/A';
                                                }
                                            @endphp
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">{{ __('Cache Status') }}:</span>
                                        <span class="font-medium">
                                            @if(\Illuminate\Support\Facades\Cache::has('system_status'))
                                                <span class="text-green-600">{{ __('Active') }}</span>
                                            @else
                                                <span class="text-red-600">{{ __('Inactive') }}</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Recent Inquiries -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-700 mb-2">{{ __('Recent Inquiries') }}</h4>
                                @php
                                    $recentInquiries = collect();
                                    $recentInquiries = $recentInquiries->concat(
                                        \App\Models\InquirySpecialCarPurchase::latest()->take(2)->get()->map(function($item) {
                                            $item->type = 'special_car_purchase';
                                            return $item;
                                        })
                                    );
                                    $recentInquiries = $recentInquiries->concat(
                                        \App\Models\InquirySpecialSparePart::latest()->take(2)->get()->map(function($item) {
                                            $item->type = 'special_spare_part';
                                            return $item;
                                        })
                                    );
                                    $recentInquiries = $recentInquiries->concat(
                                        \App\Models\InquiryVinCheck::latest()->take(2)->get()->map(function($item) {
                                            $item->type = 'vin_check';
                                            return $item;
                                        })
                                    );
                                    $recentInquiries = $recentInquiries->sortByDesc('created_at')->take(3);
                                @endphp
                                @if($recentInquiries->count() > 0)
                                    <div class="space-y-2">
                                        @foreach($recentInquiries as $inquiry)
                                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ ucfirst(str_replace('_', ' ', $inquiry->type)) }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $inquiry->created_at->diffForHumans() }}
                                                    </div>
                                                </div>
                                                <a href="{{ route('admin.inquiries.show', ['type' => $inquiry->type, 'id' => $inquiry->id]) }}" class="text-orange-600 hover:text-orange-800 text-sm">
                                                    {{ __('View') }}
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500">{{ __('No inquiries found.') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
