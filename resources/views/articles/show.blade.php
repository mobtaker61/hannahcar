<x-app-layout>
    <x-slot name="header">
        {{ $article->title }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                        <!-- Main Article -->
                        <div class="lg:col-span-3">
                            <article class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                                @if($article->featured_image)
                                    <img src="{{ asset('storage/' . $article->featured_image) }}"
                                         class="w-full h-64 lg:h-96 object-cover" alt="{{ $article->title }}">
                                @endif

                                <div class="p-6">
                                    <!-- Article Header -->
                                    <div class="mb-6">
                                        @if($article->category)
                                            <a href="{{ route('news.category', $article->category->slug) }}"
                                               class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mb-3">
                                                {{ $article->category->name }}
                                            </a>
                                        @endif

                                        <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4">{{ $article->title }}</h1>

                                        <div class="flex flex-wrap justify-between items-center text-sm text-gray-500 mb-4">
                                            <div class="flex space-x-4 space-x-reverse">
                                                <span>
                                                    <i class="fas fa-calendar ml-1"></i>
                                                    {{ $article->published_at->format('Y/m/d H:i') }}
                                                </span>
                                                <span>
                                                    <i class="fas fa-eye ml-1"></i>
                                                    {{ $article->views_count }} بازدید
                                                </span>
                                                @if($article->author_name)
                                                    <span>
                                                        <i class="fas fa-user ml-1"></i>
                                                        {{ $article->author_name }}
                                                    </span>
                                                @endif
                                            </div>

                                            <!-- Social Share -->
                                            <div class="flex space-x-2 space-x-reverse mt-2 lg:mt-0">
                                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm" onclick="shareArticle('facebook')">
                                                    <i class="fab fa-facebook ml-1"></i>
                                                    فیسبوک
                                                </button>
                                                <button class="bg-blue-400 hover:bg-blue-500 text-white px-3 py-1 rounded text-sm" onclick="shareArticle('twitter')">
                                                    <i class="fab fa-twitter ml-1"></i>
                                                    توییتر
                                                </button>
                                                <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm" onclick="shareArticle('telegram')">
                                                    <i class="fab fa-telegram ml-1"></i>
                                                    تلگرام
                                                </button>
                                                <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm" onclick="shareArticle('whatsapp')">
                                                    <i class="fab fa-whatsapp ml-1"></i>
                                                    واتساپ
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Article Content -->
                                    <div class="prose max-w-none mb-6">
                                        {!! $article->content !!}
                                    </div>

                                    <!-- Tags -->
                                    @if($article->tags && count($article->tags) > 0)
                                        <div class="mb-6">
                                            <h3 class="text-lg font-medium text-gray-900 mb-3">تگ‌ها:</h3>
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($article->tags as $tag)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        {{ $tag }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Source -->
                                    @if($article->source_url)
                                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                                            <p class="text-sm text-gray-600">
                                                <strong>منبع:</strong>
                                                <a href="{{ $article->source_url }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                    {{ $article->source_url }}
                                                </a>
                                            </p>
                                        </div>
                                    @endif

                                    <!-- Like Button -->
                                    <div class="flex justify-between items-center mb-6">
                                        <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded flex items-center" onclick="toggleLike()" id="likeButton">
                                            <i class="fas fa-heart ml-2" id="likeIcon"></i>
                                            <span id="likeCount">{{ $article->likes_count }}</span>
                                        </button>

                                        <div class="text-gray-500">
                                            <small>
                                                <i class="fas fa-share ml-1"></i>
                                                <span id="shareCount">{{ $article->shares_count }}</span> اشتراک
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <!-- Comments Section -->
                            @if($article->canComment())
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm mt-6">
                                    <div class="px-6 py-4 border-b border-gray-200">
                                        <h3 class="text-lg font-medium text-gray-900">نظرات ({{ $article->comments_count }})</h3>
                                    </div>
                                    <div class="p-6">
                                        <!-- Comment Form -->
                                        <form method="POST" action="{{ route('news.comment', $article) }}" class="mb-6">
                                            @csrf
                                            <div class="mb-4">
                                                <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                          name="content" rows="3" placeholder="نظر خود را بنویسید..." required></textarea>
                                            </div>

                                            @guest
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                           name="guest_name" placeholder="نام شما" required>
                                                    <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                           name="guest_email" placeholder="ایمیل شما" required>
                                                </div>
                                            @endguest

                                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                ارسال نظر
                                            </button>
                                        </form>

                                        <!-- Comments List -->
                                        <div id="commentsList" class="space-y-4">
                                            @foreach($article->approvedComments as $comment)
                                                <div class="border border-gray-200 rounded-lg p-4">
                                                    <div class="flex space-x-3 space-x-reverse">
                                                        <div class="flex-shrink-0">
                                                            <div class="w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center font-medium">
                                                                {{ substr($comment->author_name, 0, 1) }}
                                                            </div>
                                                        </div>
                                                        <div class="flex-1">
                                                            <div class="flex justify-between items-start mb-2">
                                                                <h4 class="text-sm font-medium text-gray-900">{{ $comment->author_name }}</h4>
                                                                <span class="text-xs text-gray-500">{{ $comment->created_at->format('Y/m/d H:i') }}</span>
                                                            </div>
                                                            <p class="text-sm text-gray-700 mb-3">{{ $comment->content }}</p>

                                                            <!-- Reply Button -->
                                                            <button class="text-sm text-blue-600 hover:text-blue-800" onclick="showReplyForm({{ $comment->id }})">
                                                                پاسخ
                                                            </button>

                                                            <!-- Reply Form -->
                                                            <div id="replyForm{{ $comment->id }}" class="mt-3 hidden">
                                                                <form method="POST" action="{{ route('news.comment', $article) }}" class="space-y-3">
                                                                    @csrf
                                                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                                              name="content" rows="2" placeholder="پاسخ خود را بنویسید..." required></textarea>
                                                                    @guest
                                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                                                   name="guest_name" placeholder="نام شما" required>
                                                                            <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                                                   name="guest_email" placeholder="ایمیل شما" required>
                                                                        </div>
                                                                    @endguest
                                                                    <div class="flex space-x-2 space-x-reverse">
                                                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded">
                                                                            ارسال پاسخ
                                                                        </button>
                                                                        <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white text-sm font-bold py-2 px-4 rounded" onclick="hideReplyForm({{ $comment->id }})">
                                                                            انصراف
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <!-- Replies -->
                                                            @foreach($comment->replies as $reply)
                                                                <div class="mt-3 mr-6 border-r-2 border-gray-200 pr-4">
                                                                    <div class="flex space-x-2 space-x-reverse">
                                                                        <div class="flex-shrink-0">
                                                                            <div class="w-8 h-8 bg-gray-400 text-white rounded-full flex items-center justify-center text-xs font-medium">
                                                                                {{ substr($reply->author_name, 0, 1) }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-1">
                                                                            <div class="flex justify-between items-start mb-1">
                                                                                <h5 class="text-xs font-medium text-gray-900">{{ $reply->author_name }}</h5>
                                                                                <span class="text-xs text-gray-500">{{ $reply->created_at->format('Y/m/d H:i') }}</span>
                                                                            </div>
                                                                            <p class="text-xs text-gray-700">{{ $reply->content }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Sidebar -->
                        <div class="lg:col-span-1">
                            <!-- Related Articles -->
                            @if($relatedArticles->count() > 0)
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-6">
                                    <div class="px-4 py-3 border-b border-gray-200">
                                        <h3 class="text-lg font-medium text-gray-900">مقالات مرتبط</h3>
                                    </div>
                                    <div class="p-4">
                                        <div class="space-y-4">
                                            @foreach($relatedArticles as $relatedArticle)
                                                <div class="flex space-x-3 space-x-reverse">
                                                    @if($relatedArticle->featured_image)
                                                        <img src="{{ asset('storage/' . $relatedArticle->featured_image) }}"
                                                             class="w-16 h-16 object-cover rounded" alt="{{ $relatedArticle->title }}">
                                                    @endif
                                                    <div class="flex-1 min-w-0">
                                                        <h4 class="text-sm font-medium text-gray-900 mb-1">
                                                            <a href="{{ route('news.show', $relatedArticle->slug) }}" class="hover:text-blue-600">
                                                                {{ $relatedArticle->title }}
                                                            </a>
                                                        </h4>
                                                        <p class="text-sm text-gray-500">
                                                            {{ $relatedArticle->published_at->format('Y/m/d') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Popular Articles -->
                            @if($popularArticles->count() > 0)
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                                    <div class="px-4 py-3 border-b border-gray-200">
                                        <h3 class="text-lg font-medium text-gray-900">مقالات محبوب</h3>
                                    </div>
                                    <div class="p-4">
                                        <div class="space-y-4">
                                            @foreach($popularArticles as $popularArticle)
                                                <div class="flex space-x-3 space-x-reverse">
                                                    @if($popularArticle->featured_image)
                                                        <img src="{{ asset('storage/' . $popularArticle->featured_image) }}"
                                                             class="w-16 h-16 object-cover rounded" alt="{{ $popularArticle->title }}">
                                                    @endif
                                                    <div class="flex-1 min-w-0">
                                                        <h4 class="text-sm font-medium text-gray-900 mb-1">
                                                            <a href="{{ route('news.show', $popularArticle->slug) }}" class="hover:text-blue-600">
                                                                {{ $popularArticle->title }}
                                                            </a>
                                                        </h4>
                                                        <p class="text-sm text-gray-500">
                                                            <i class="fas fa-eye ml-1"></i> {{ $popularArticle->views_count }}
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

    <script>
    // Toggle like
    function toggleLike() {
        fetch('{{ route("news.like", $article) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            const likeButton = document.getElementById('likeButton');
            const likeIcon = document.getElementById('likeIcon');
            const likeCount = document.getElementById('likeCount');

            likeCount.textContent = data.likes_count;

            if (data.liked) {
                likeButton.classList.remove('bg-red-500', 'hover:bg-red-600');
                likeButton.classList.add('bg-red-600', 'hover:bg-red-700');
                likeIcon.classList.remove('far');
                likeIcon.classList.add('fas');
            } else {
                likeButton.classList.remove('bg-red-600', 'hover:bg-red-700');
                likeButton.classList.add('bg-red-500', 'hover:bg-red-600');
                likeIcon.classList.remove('fas');
                likeIcon.classList.add('far');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Share article
    function shareArticle(platform) {
        const url = encodeURIComponent(window.location.href);
        const title = encodeURIComponent('{{ $article->title }}');
        const text = encodeURIComponent('{{ $article->excerpt }}');

        let shareUrl = '';

        switch(platform) {
            case 'facebook':
                shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
                break;
            case 'twitter':
                shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
                break;
            case 'telegram':
                shareUrl = `https://t.me/share/url?url=${url}&text=${title}`;
                break;
            case 'whatsapp':
                shareUrl = `https://wa.me/?text=${title}%20${url}`;
                break;
        }

        if (shareUrl) {
            window.open(shareUrl, '_blank', 'width=600,height=400');

            // Record share
            fetch('{{ route("news.share", $article) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ platform: platform })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('shareCount').textContent = data.shares_count;
            });
        }
    }

    // Show reply form
    function showReplyForm(commentId) {
        document.getElementById(`replyForm${commentId}`).classList.remove('hidden');
    }

    // Hide reply form
    function hideReplyForm(commentId) {
        document.getElementById(`replyForm${commentId}`).classList.add('hidden');
    }
    </script>
</x-admin-layout>
