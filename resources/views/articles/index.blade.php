<x-app-layout>
    <x-slot name="header">
        اخبار و مقالات
    </x-slot>

    <style>
        /* Line clamp utility classes */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Featured articles hover effects */
        .group:hover .group-hover\:scale-110 {
            transform: scale(1.1);
        }

        /* Backdrop blur fallback for older browsers */
        .backdrop-blur-sm {
            backdrop-filter: blur(4px);
        }

        /* Custom animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .group:hover .animate-fade-in-up {
            animation: fadeInUp 0.3s ease-out;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                                        <!-- Featured Articles -->
                    @if($featuredArticles->count() > 0)
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-8">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-xl font-bold text-gray-900 flex items-center">
                                        <i class="fas fa-star text-yellow-500 mr-3"></i>
                                        مقالات ویژه
                                    </h2>
                                    <div class="h-1 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full w-16"></div>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex space-x-4 space-x-reverse">
                                    @foreach($featuredArticles->take(4) as $article)
                                        <div class="flex-1 group relative rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                            <a href="{{ route('news.show', $article->slug) }}" class="block relative h-48">
                                                @if($article->featured_image)
                                                    <img src="{{ asset('storage/' . $article->featured_image) }}"
                                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                                         alt="{{ $article->title }}">
                                                @else
                                                    <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-600 flex items-center justify-center">
                                                        <i class="fas fa-newspaper text-white text-3xl opacity-50"></i>
                                                    </div>
                                                @endif

                                                <!-- Gradient Overlay -->
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-70 group-hover:opacity-90 transition-opacity duration-300"></div>

                                                <!-- Category Badge -->
                                                @if($article->category)
                                                    <div class="absolute top-3 right-3 z-10">
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-white/90 text-gray-800">
                                                            {{ $article->category->name }}
                                                        </span>
                                                    </div>
                                                @endif

                                                <!-- Content Overlay -->
                                                <div class="absolute inset-0 flex flex-col justify-end p-4 text-white">
                                                    <!-- Title -->
                                                    <h3 class="text-sm font-bold mb-2 line-clamp-2 group-hover:text-yellow-300 transition-colors duration-300">
                                                        {{ $article->title }}
                                                    </h3>

                                                    <!-- Meta Info -->
                                                    <div class="flex items-center justify-between text-xs opacity-90">
                                                        <span class="flex items-center">
                                                            <i class="fas fa-calendar mr-1"></i>
                                                            {{ $article->published_at->format('m/d') }}
                                                        </span>
                                                        <span class="flex items-center">
                                                            <i class="fas fa-eye mr-1"></i>
                                                            {{ $article->views_count }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Main Content -->
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                        <!-- Articles List -->
                        <div class="lg:col-span-3">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-xl font-semibold text-gray-900">آخرین مقالات</h2>
                                <form method="GET" action="{{ route('news.index') }}" class="flex">
                                    <input type="text" name="search" class="rounded-r-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                           placeholder="جستجو در مقالات..." value="{{ request('search') }}">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-l-md">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>

                            @if($articles->count() > 0)
                                <div class="space-y-6">
                                    @foreach($articles as $article)
                                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                                            <div class="md:flex">
                                                @if($article->featured_image)
                                                    <div class="md:w-1/3">
                                                        <img src="{{ asset('storage/' . $article->featured_image) }}"
                                                             class="w-full h-48 md:h-full object-cover" alt="{{ $article->title }}">
                                                    </div>
                                                @endif
                                                <div class="p-6 md:w-2/3">
                                                    @if($article->category)
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 mb-2">
                                                            {{ $article->category->name }}
                                                        </span>
                                                    @endif
                                                    <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $article->title }}</h3>
                                                    @if($article->excerpt)
                                                        <p class="text-gray-600 text-sm mb-3">{{ $article->excerpt }}</p>
                                                    @endif
                                                    <div class="flex justify-between items-center">
                                                        <div class="flex space-x-4 space-x-reverse text-sm text-gray-500">
                                                            <span>
                                                                <i class="fas fa-calendar ml-1"></i>
                                                                {{ $article->published_at->format('Y/m/d') }}
                                                            </span>
                                                            <span>
                                                                <i class="fas fa-eye ml-1"></i>
                                                                {{ $article->views_count }}
                                                            </span>
                                                            @if($article->comments_count > 0)
                                                                <span>
                                                                    <i class="fas fa-comments ml-1"></i>
                                                                    {{ $article->comments_count }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <a href="{{ route('news.show', $article->slug) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                            ادامه مطلب
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Pagination -->
                                <div class="mt-8">
                                    {{ $articles->links() }}
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <i class="fas fa-newspaper text-4xl text-gray-400 mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">هیچ مقاله‌ای یافت نشد</h3>
                                    <p class="text-gray-500">لطفا جستجوی خود را تغییر دهید یا بعداً مراجعه کنید.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Sidebar -->
                        <div class="lg:col-span-1">
                            <!-- Categories -->
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-6">
                                <div class="px-4 py-3 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900">دسته‌بندی‌ها</h3>
                                </div>
                                <div class="p-4">
                                    <div class="space-y-2">
                                        <a href="{{ route('news.index') }}"
                                           class="flex justify-between items-center px-3 py-2 rounded-md {{ !request('category') ? 'bg-blue-100 text-blue-800' : 'text-gray-700 hover:bg-gray-100' }}">
                                            <span>همه مقالات</span>
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">
                                                {{ $articles->total() }}
                                            </span>
                                        </a>
                                        @foreach($categories as $category)
                                            <a href="{{ route('news.index', ['category' => $category->slug]) }}"
                                               class="flex justify-between items-center px-3 py-2 rounded-md {{ request('category') == $category->slug ? 'bg-blue-100 text-blue-800' : 'text-gray-700 hover:bg-gray-100' }}">
                                                <span>{{ $category->name }}</span>
                                                <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-1 rounded-full">
                                                    {{ $category->articles->count() }}
                                                </span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Popular Articles -->
                            @if($featuredArticles->count() > 0)
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                                    <div class="px-4 py-3 border-b border-gray-200">
                                        <h3 class="text-lg font-medium text-gray-900">مقالات محبوب</h3>
                                    </div>
                                    <div class="p-4">
                                        <div class="space-y-4">
                                            @foreach($featuredArticles->take(3) as $article)
                                                <div class="flex space-x-3 space-x-reverse">
                                                    @if($article->featured_image)
                                                        <img src="{{ asset('storage/' . $article->featured_image) }}"
                                                             class="w-16 h-16 object-cover rounded" alt="{{ $article->title }}">
                                                    @endif
                                                    <div class="flex-1 min-w-0">
                                                        <h4 class="text-sm font-medium text-gray-900 mb-1">
                                                            <a href="{{ route('news.show', $article->slug) }}" class="hover:text-blue-600">
                                                                {{ $article->title }}
                                                            </a>
                                                        </h4>
                                                        <p class="text-sm text-gray-500">
                                                            {{ $article->published_at->format('Y/m/d') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
