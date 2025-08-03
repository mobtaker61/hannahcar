<x-app-layout>
    <x-slot name="header">
        اخبار و مقالات
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Featured Articles -->
                    @if($featuredArticles->count() > 0)
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">مقالات ویژه</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($featuredArticles as $article)
                                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                                        @if($article->featured_image)
                                            <img src="{{ asset('storage/' . $article->featured_image) }}"
                                                 class="w-full h-48 object-cover" alt="{{ $article->title }}">
                                        @endif
                                        <div class="p-4">
                                            @if($article->category)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mb-2">
                                                    {{ $article->category->name }}
                                                </span>
                                            @endif
                                            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $article->title }}</h3>
                                            @if($article->excerpt)
                                                <p class="text-gray-600 text-sm mb-3">{{ $article->excerpt }}</p>
                                            @endif
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm text-gray-500">
                                                    <i class="fas fa-calendar ml-1"></i>
                                                    {{ $article->published_at->format('Y/m/d') }}
                                                </span>
                                                <a href="{{ route('news.show', $article->slug) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                    ادامه مطلب
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
