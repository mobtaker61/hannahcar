    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header with Horizontal Layout -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-12">
            <!-- Title Section (Right side in RTL) -->
            <div class="text-center md:text-right mb-6 md:mb-0">
                <h2 class="text-3xl font-bold text-primary mb-4">{{ __('News & Articles') }}</h2>
                <p class="text-xl text-secondary-text">{{ __('Latest news and articles related to the automotive industry') }}</p>
            </div>

            <!-- Tab Navigation (Left side in RTL) -->
            <div class="flex justify-center md:justify-start">
                <div class="bg-gray-100 rounded-lg p-1">
                    <button wire:click="setActiveTab('news')"
                            class="px-6 py-2 rounded-md transition-all duration-200 {{ $activeTab === 'news' ? 'bg-primary text-white shadow-md' : 'text-gray-600 hover:text-gray-800' }}">
                        {{ __('News') }}
                    </button>
                    <button wire:click="setActiveTab('articles')"
                            class="px-6 py-2 rounded-md transition-all duration-200 {{ $activeTab === 'articles' ? 'bg-primary text-white shadow-md' : 'text-gray-600 hover:text-gray-800' }}">
                        {{ __('Articles') }}
                    </button>
                </div>
            </div>
        </div>

        <!-- News/Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            @foreach($articles as $article)
                <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $article['image'] }}"
                             alt="{{ $article['title'] }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute {{ app()->getLocale() === 'fa' ? 'top-4 right-4' : 'top-4 left-4' }}">
                            <span class="bg-accent text-primary px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $article['category'] }}
                            </span>
                        </div>
                        @if($article['is_featured'])
                            <div class="absolute {{ app()->getLocale() === 'fa' ? 'top-4 left-4' : 'top-4 right-4' }}">
                                <span class="bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                    {{ app()->getLocale() === 'fa' ? 'ویژه' : 'Featured' }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="p-2">
                        <div class="flex items-center text-sm text-gray-500 mb-3 justify-between">
                            <div>
                                <i class="fas fa-calendar {{ app()->getLocale() === 'fa' ? 'ml-2' : 'mr-2' }}"></i>
                                <span>{{ $article['date'] }}</span>
                            </div>
                            <div>
                                <span><i class="fas fa-eye"></i> {{ $article['views_count'] }}</span>
                                <span><i class="fas fa-comments"></i> {{ $article['comments_count'] }}</span>
                            </div>
                        </div>

                        <a href="{{ $article['link'] }}">
                            <h3 class="text-lg font-semibold text-primary mb-3 line-clamp-2">{{ $article['title'] }}</h3>
                        </a>
                        <p class="text-secondary-text text-sm mb-4 line-clamp-3">{{ $article['excerpt'] }}</p>


                    </div>
                </article>
            @endforeach
        </div>

        <!-- CTA Button -->
        <div class="text-center">
            <a href="{{ route('news.index') }}"
               class="inline-flex items-center bg-primary text-white px-8 py-4 rounded-lg font-semibold hover:bg-primary/90 transition-colors">
                {{ app()->getLocale() === 'fa' ? 'مشاهده همه اخبار و مقالات' : 'View All News & Articles' }}
                <i class="fas fa-arrow-{{ app()->getLocale() === 'fa' ? 'left' : 'right' }} {{ app()->getLocale() === 'fa' ? 'mr-2' : 'ml-2' }}"></i>
            </a>
        </div>
    </div>
