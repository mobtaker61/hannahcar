<x-app-layout>
    <div class="py-8 bg-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @php
                $translation = $service->translations->where('language.code', app()->getLocale())->first();
                if (!$translation) {
                    $translation = $service->translations->first();
                }
            @endphp

            <!-- Breadcrumb -->
            <nav class="mb-8">
                <ol class="flex items-center space-x-2 {{ app()->getLocale() === 'fa' ? 'space-x-reverse' : '' }} text-sm text-secondary-text">
                    <li><a href="{{ route('home') }}" class="hover:text-primary transition-colors">{{ __('Home') }}</a></li>
                    <li><i class="fas fa-chevron-{{ app()->getLocale() === 'fa' ? 'left' : 'right' }} text-xs"></i></li>
                    <li><a href="{{ route('services.index') }}" class="hover:text-primary transition-colors">{{ __('Services') }}</a></li>
                    <li><i class="fas fa-chevron-{{ app()->getLocale() === 'fa' ? 'left' : 'right' }} text-xs"></i></li>
                    <li class="text-primary">{{ $translation->title }}</li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <!-- Service Header -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                        <div class="relative h-64 md:h-96">
                            <img src="{{ $service->featured_image ? asset('storage/' . $service->featured_image) : asset('images/placeholder.jpg') }}" alt="{{ $translation->title }}"
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            @if($service->is_featured)
                                <div class="absolute top-4 {{ app()->getLocale() === 'fa' ? 'right-4' : 'left-4' }}">
                                    <span class="bg-accent text-white px-3 py-1 rounded-full text-sm font-medium">
                                        {{ __('Featured Service') }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div class="p-6">
                            <h1 class="text-3xl font-bold text-primary mb-4">{{ $translation->title }}</h1>
                            <p class="text-lg text-secondary-text mb-6">{{ $translation->excerpt }}</p>

                            <!-- Service Meta -->
                            <div class="flex items-center justify-between text-sm text-secondary-text border-t pt-4">
                                <div class="flex items-center space-x-4 {{ app()->getLocale() === 'fa' ? 'space-x-reverse' : '' }}">
                                    <span>
                                        <i class="fas fa-calendar mr-1"></i>
                                        {{ $service->published_at->format('M d, Y') }}
                                    </span>
                                    <span>
                                        <i class="fas fa-eye mr-1"></i>
                                        {{ $service->views_count }} {{ __('views') }}
                                    </span>
                                    <span>
                                        <i class="fas fa-comments mr-1"></i>
                                        {{ $service->comments()->where('status', 'approved')->count() }} {{ __('comments') }}
                                    </span>
                                </div>
                                @if($service->user)
                                    <span>
                                        <i class="fas fa-user mr-1"></i>
                                        {{ $service->user->name }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Service Content -->
                    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                        <div class="prose prose-lg max-w-none">
                            {!! $translation->content !!}
                        </div>
                    </div>

                    <!-- Comments Section -->
                    @if($service->allow_comments)
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-xl font-semibold text-primary mb-6">{{ __('Comments') }}</h3>

                            <!-- Comment Form -->
                            @auth
                                <form method="POST" action="{{ route('news.comment', $service) }}" class="mb-8">
                                    @csrf
                                    <div class="mb-4">
                                        <textarea name="content" rows="4"
                                                  placeholder="{{ __('Write your comment...') }}"
                                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                                  required></textarea>
                                    </div>
                                    <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary/90 transition-colors">
                                        {{ __('Post Comment') }}
                                    </button>
                                </form>
                            @else
                                <div class="mb-8 p-4 bg-gray-50 rounded-lg">
                                    <p class="text-secondary-text">
                                        {{ __('Please') }}
                                        <a href="{{ route('login') }}" class="text-primary hover:underline">{{ __('login') }}</a>
                                        {{ __('to post a comment.') }}
                                    </p>
                                </div>
                            @endauth

                            <!-- Comments List -->
                            @if($service->approvedComments->count() > 0)
                                <div class="space-y-6">
                                    @foreach($service->approvedComments as $comment)
                                        <div class="border-b border-gray-200 pb-6 last:border-b-0">
                                            <div class="flex items-start space-x-3 {{ app()->getLocale() === 'fa' ? 'space-x-reverse' : '' }}">
                                                <div class="flex-shrink-0">
                                                    <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white font-semibold">
                                                        {{ substr($comment->user->name, 0, 1) }}
                                                    </div>
                                                </div>
                                                <div class="flex-1">
                                                    <div class="flex items-center justify-between mb-2">
                                                        <h4 class="font-semibold text-primary">{{ $comment->user->name }}</h4>
                                                        <span class="text-sm text-secondary-text">{{ $comment->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <p class="text-secondary-text">{{ $comment->content }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-secondary-text text-center py-8">{{ __('No comments yet. Be the first to comment!') }}</p>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Related Services -->
                    @if($relatedServices->count() > 0)
                        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                            <h3 class="text-lg font-semibold text-primary mb-4">{{ __('Related Services') }}</h3>
                            <div class="space-y-4">
                                @foreach($relatedServices as $relatedService)
                                    @php
                                        $relatedTranslation = $relatedService->translations->where('language.code', app()->getLocale())->first();
                                        if (!$relatedTranslation) {
                                            $relatedTranslation = $relatedService->translations->first();
                                        }
                                    @endphp

                                    <a href="{{ route('services.show', $relatedService->slug) }}"
                                       class="block group">
                                        <div class="flex items-center space-x-3 {{ app()->getLocale() === 'fa' ? 'space-x-reverse' : '' }}">
                                            <div class="flex-shrink-0 w-16 h-16 rounded-lg overflow-hidden">
                                                <img src="{{ $relatedService->featured_image ? asset('storage/' . $relatedService->featured_image) : asset('images/placeholder.jpg') }}" alt="{{ $relatedTranslation->title }}"
                                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4 class="text-sm font-medium text-primary group-hover:text-accent transition-colors line-clamp-2">
                                                    {{ $relatedTranslation->title }}
                                                </h4>
                                                <p class="text-xs text-secondary-text line-clamp-2">
                                                    {{ $relatedTranslation->excerpt }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Popular Services -->
                    @if($popularServices->count() > 0)
                        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                            <h3 class="text-lg font-semibold text-primary mb-4">{{ __('Popular Services') }}</h3>
                            <div class="space-y-4">
                                @foreach($popularServices as $popularService)
                                    @php
                                        $popularTranslation = $popularService->translations->where('language.code', app()->getLocale())->first();
                                        if (!$popularTranslation) {
                                            $popularTranslation = $popularService->translations->first();
                                        }
                                    @endphp

                                    <a href="{{ route('services.show', $popularService->slug) }}"
                                       class="block group">
                                        <div class="flex items-center space-x-3 {{ app()->getLocale() === 'fa' ? 'space-x-reverse' : '' }}">
                                            <div class="flex-shrink-0 w-16 h-16 rounded-lg overflow-hidden">
                                                <img src="{{ $popularService->featured_image ? asset('storage/' . $popularService->featured_image) : asset('images/placeholder.jpg') }}" alt="{{ $popularTranslation->title }}"
                                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4 class="text-sm font-medium text-primary group-hover:text-accent transition-colors line-clamp-2">
                                                    {{ $popularTranslation->title }}
                                                </h4>
                                                <div class="flex items-center text-xs text-secondary-text mt-1">
                                                    <i class="fas fa-eye mr-1"></i>
                                                    {{ $popularService->views_count }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Quick Contact -->
                    <div class="bg-gradient-to-r from-primary to-accent rounded-lg p-6 text-white">
                        <h3 class="text-lg font-semibold mb-4">{{ __('Interested in this service?') }}</h3>
                        <p class="text-sm mb-4">{{ __('Contact us for more information and personalized assistance.') }}</p>
                        <a href="{{ route('page.show', 'contact') }}"
                           class="inline-flex items-center bg-white text-primary px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors">
                            {{ __('Get Quote') }}
                            <i class="fas fa-arrow-{{ app()->getLocale() === 'fa' ? 'left' : 'right' }} {{ app()->getLocale() === 'fa' ? 'mr-2' : 'ml-2' }} text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
