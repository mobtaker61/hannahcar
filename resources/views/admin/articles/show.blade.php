<x-admin-layout>
    <x-slot name="header">
        مشاهده مقاله: {{ $article->title }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                        <!-- Main Content -->
                        <div class="lg:col-span-3">
                            <!-- Basic Information -->
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-6">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900">اطلاعات اصلی</h3>
                                </div>
                                <div class="p-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                                            <div class="text-sm text-gray-900">
                                                <code class="bg-gray-100 px-2 py-1 rounded">{{ $article->slug }}</code>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">دسته‌بندی</label>
                                            <div class="text-sm text-gray-900">
                                                @if($article->category)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        {{ $article->category->name }}
                                                    </span>
                                                @else
                                                    <span class="text-gray-500">بدون دسته</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">وضعیت</label>
                                            <div class="text-sm text-gray-900">
                                                @switch($article->status)
                                                    @case('published')
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            منتشر شده
                                                        </span>
                                                        @break
                                                    @case('draft')
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                            پیش‌نویس
                                                        </span>
                                                        @break
                                                    @case('archived')
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                            آرشیو شده
                                                        </span>
                                                        @break
                                                @endswitch
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">تاریخ انتشار</label>
                                            <div class="text-sm text-gray-900">
                                                @if($article->published_at)
                                                    {{ $article->published_at->format('Y/m/d H:i') }}
                                                @else
                                                    <span class="text-gray-500">-</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">ویژه</label>
                                            <div class="text-sm text-gray-900">
                                                @if($article->is_featured)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                                        بله
                                                    </span>
                                                @else
                                                    <span class="text-gray-500">خیر</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">اجازه کامنت</label>
                                            <div class="text-sm text-gray-900">
                                                @if($article->allow_comments)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        بله
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        خیر
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Translations -->
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-6">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900">ترجمه‌ها</h3>
                                </div>
                                <div class="p-6">
                                    <div class="space-y-6">
                                        @foreach($article->translations as $translation)
                                            <div class="border border-gray-200 rounded-lg p-4">
                                                <div class="flex items-center mb-4">
                                                    <span class="w-6 h-6 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center text-sm font-bold ml-2">
                                                        {{ strtoupper($translation->language->code) }}
                                                    </span>
                                                    <h4 class="text-md font-medium text-gray-900">{{ $translation->language->native_name }}</h4>
                                                </div>

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">عنوان</label>
                                                        <div class="text-sm text-gray-900">{{ $translation->title }}</div>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                                                        <div class="text-sm text-gray-900">{{ $translation->meta_title ?: '-' }}</div>
                                                    </div>
                                                </div>

                                                @if($translation->excerpt)
                                                    <div class="mb-4">
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">خلاصه</label>
                                                        <div class="text-sm text-gray-900">{{ $translation->excerpt }}</div>
                                                    </div>
                                                @endif

                                                @if($translation->content)
                                                    <div class="mb-4">
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">محتوای اصلی</label>
                                                        <div class="text-sm text-gray-900 prose max-w-none">
                                                            {!! $translation->content !!}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($translation->meta_description)
                                                    <div class="mb-4">
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                                                        <div class="text-sm text-gray-900">{{ $translation->meta_description }}</div>
                                                    </div>
                                                @endif

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">نام نویسنده</label>
                                                        <div class="text-sm text-gray-900">{{ $translation->author_name ?: '-' }}</div>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">منبع</label>
                                                        <div class="text-sm text-gray-900">
                                                            @if($translation->source_url)
                                                                <a href="{{ $translation->source_url }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                                    {{ $translation->source_url }}
                                                                </a>
                                                            @else
                                                                <span class="text-gray-500">-</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                @if($translation->featured_image)
                                                    <div class="mb-4">
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">تصویر شاخص</label>
                                                        <div class="text-sm text-gray-900">
                                                            <img src="{{ asset('storage/' . $translation->featured_image) }}"
                                                                 alt="{{ $translation->title }}"
                                                                 class="w-32 h-32 object-cover rounded">
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($translation->tags)
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">تگ‌ها</label>
                                                        <div class="text-sm text-gray-900">
                                                            @if(is_array($translation->tags))
                                                                @foreach($translation->tags as $tag)
                                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 ml-1">
                                                                        {{ trim($tag) }}
                                                                    </span>
                                                                @endforeach
                                                            @else
                                                                @foreach(explode(',', $translation->tags) as $tag)
                                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 ml-1">
                                                                        {{ trim($tag) }}
                                                                    </span>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Comments -->
                            @if($article->comments->count() > 0)
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                                    <div class="px-6 py-4 border-b border-gray-200">
                                        <h3 class="text-lg font-medium text-gray-900">کامنت‌ها ({{ $article->comments->count() }})</h3>
                                    </div>
                                    <div class="p-6">
                                        <div class="space-y-4">
                                            @foreach($article->comments->take(5) as $comment)
                                                <div class="border border-gray-200 rounded-lg p-4">
                                                    <div class="flex justify-between items-start mb-2">
                                                        <div class="flex items-center">
                                                            <div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-medium ml-2">
                                                                {{ substr($comment->author_name, 0, 1) }}
                                                            </div>
                                                            <div>
                                                                <div class="text-sm font-medium text-gray-900">{{ $comment->author_name }}</div>
                                                                <div class="text-xs text-gray-500">{{ $comment->created_at->format('Y/m/d H:i') }}</div>
                                                            </div>
                                                        </div>
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $comment->is_approved ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                            {{ $comment->is_approved ? 'تایید شده' : 'در انتظار تایید' }}
                                                        </span>
                                                    </div>
                                                    <div class="text-sm text-gray-700">{{ $comment->content }}</div>
                                                </div>
                                            @endforeach

                                            @if($article->comments->count() > 5)
                                                <div class="text-center">
                                                    <p class="text-sm text-gray-500">
                                                        نمایش 5 کامنت از {{ $article->comments->count() }} کامنت
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Sidebar -->
                        <div class="lg:col-span-1">
                            <!-- Actions -->
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-6">
                                <div class="px-4 py-3 border-b border-gray-200">
                                    <h5 class="text-lg font-medium text-gray-900">عملیات</h5>
                                </div>
                                <div class="p-4">
                                    <div class="space-y-3">
                                        <a href="{{ route('admin.articles.edit', $article) }}"
                                           class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block text-center">
                                            <i class="fas fa-edit ml-2"></i>
                                            ویرایش
                                        </a>
                                        <a href="{{ route('admin.articles.index') }}"
                                           class="w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-block text-center">
                                            <i class="fas fa-arrow-left ml-2"></i>
                                            بازگشت
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Article Stats -->
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-6">
                                <div class="px-4 py-3 border-b border-gray-200">
                                    <h5 class="text-lg font-medium text-gray-900">آمار مقاله</h5>
                                </div>
                                <div class="p-4">
                                    <div class="space-y-3 text-sm">
                                        <div>
                                            <span class="font-medium text-gray-700">بازدید:</span>
                                            <div class="text-gray-600">{{ $article->views_count }} بار</div>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">کامنت‌ها:</span>
                                            <div class="text-gray-600">{{ $article->comments_count }} کامنت</div>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">لایک‌ها:</span>
                                            <div class="text-gray-600">{{ $article->likes_count }} لایک</div>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">اشتراک‌ها:</span>
                                            <div class="text-gray-600">{{ $article->shares_count }} اشتراک</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Article Info -->
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                                <div class="px-4 py-3 border-b border-gray-200">
                                    <h5 class="text-lg font-medium text-gray-900">اطلاعات مقاله</h5>
                                </div>
                                <div class="p-4">
                                    <div class="space-y-3 text-sm">
                                        <div>
                                            <span class="font-medium text-gray-700">تاریخ ایجاد:</span>
                                            <div class="text-gray-600">{{ $article->created_at->format('Y/m/d H:i') }}</div>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">آخرین بروزرسانی:</span>
                                            <div class="text-gray-600">{{ $article->updated_at->format('Y/m/d H:i') }}</div>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">نویسنده:</span>
                                            <div class="text-gray-600">
                                                @if($article->user)
                                                    {{ $article->user->name }}
                                                @else
                                                    {{ $article->author_name ?: 'نامشخص' }}
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">تعداد ترجمه‌ها:</span>
                                            <div class="text-gray-600">{{ $article->translations->count() }} زبان</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
