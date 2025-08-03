<x-admin-layout>
    <x-slot name="header">
        مشاهده خدمت
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">{{ $service->title }}</h2>
                        <div class="flex space-x-2 space-x-reverse">
                            <a href="{{ route('admin.services.edit', $service) }}"
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-edit ml-2"></i>
                                ویرایش
                            </a>
                            <a href="{{ route('admin.services.index') }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                بازگشت
                            </a>
                        </div>
                    </div>

                    <!-- Service Details -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Main Content -->
                        <div class="lg:col-span-2">
                            <!-- Basic Information -->
                            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">اطلاعات اصلی</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Slug</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $service->slug }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">نوع</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $service->type }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">دسته‌بندی</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $service->category ? $service->category->name : 'بدون دسته‌بندی' }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">وضعیت</label>
                                        <span class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            {{ $service->status === 'published' ? 'bg-green-100 text-green-800' :
                                               ($service->status === 'draft' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ $service->status === 'published' ? 'منتشر شده' :
                                               ($service->status === 'draft' ? 'پیش‌نویس' : 'آرشیو شده') }}
                                        </span>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">تاریخ انتشار</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $service->published_at ? $service->published_at->format('Y/m/d H:i') : 'تعیین نشده' }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">بازدید</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ number_format($service->views_count) }}</p>
                                    </div>
                                </div>

                                <div class="mt-4 flex space-x-4 space-x-reverse">
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-700 ml-2">ویژه:</span>
                                        @if($service->is_featured)
                                            <span class="text-green-600">
                                                <i class="fas fa-star"></i>
                                            </span>
                                        @else
                                            <span class="text-gray-400">
                                                <i class="far fa-star"></i>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-700 ml-2">کامنت:</span>
                                        @if($service->allow_comments)
                                            <span class="text-green-600">
                                                <i class="fas fa-check"></i>
                                            </span>
                                        @else
                                            <span class="text-red-600">
                                                <i class="fas fa-times"></i>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">محتوای خدمت</h3>

                                @if($service->icon)
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">آیکون</label>
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                                <i class="{{ $service->icon }} text-blue-600 text-xl"></i>
                                            </div>
                                            <span class="mr-3 text-sm text-gray-600">{{ $service->icon }}</span>
                                        </div>
                                    </div>
                                @endif

                                @if($service->featured_image)
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">تصویر شاخص</label>
                                        <img src="{{ $service->featured_image }}" alt="{{ $service->title }}"
                                             class="w-full h-48 object-cover rounded-lg">
                                    </div>
                                @endif

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">خلاصه</label>
                                    <p class="text-sm text-gray-900">{{ $service->excerpt ?: 'خلاصه‌ای تعریف نشده است.' }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">محتوای اصلی</label>
                                    <div class="text-sm text-gray-900 prose max-w-none">
                                        {!! $service->content ?: 'محتوایی تعریف نشده است.' !!}
                                    </div>
                                </div>
                            </div>

                            <!-- SEO Information -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">اطلاعات SEO</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Meta Title</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $service->meta_title ?: 'تعریف نشده' }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Meta Description</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $service->meta_description ?: 'تعریف نشده' }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">نویسنده</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $service->author_name ?: 'تعریف نشده' }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">تگ‌ها</label>
                                        <p class="mt-1 text-sm text-gray-900">
                                            @if($service->tags && count($service->tags) > 0)
                                                @foreach($service->tags as $tag)
                                                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded ml-1 mb-1">{{ $tag }}</span>
                                                @endforeach
                                            @else
                                                تگی تعریف نشده است.
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="lg:col-span-1">
                            <!-- Statistics -->
                            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">آمار</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">بازدید:</span>
                                        <span class="text-sm font-medium text-gray-900">{{ number_format($service->views_count) }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">کامنت‌ها:</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $service->comments()->count() }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">لایک‌ها:</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $service->likes()->count() }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">اشتراک‌گذاری:</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $service->shares()->count() }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">عملیات سریع</h3>
                                <div class="space-y-2">
                                    <a href="{{ route('services.show', $service->slug) }}" target="_blank"
                                       class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-center block">
                                        <i class="fas fa-external-link-alt ml-2"></i>
                                        مشاهده در سایت
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline w-full">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                                onclick="return confirm('آیا مطمئن هستید که می‌خواهید این خدمت را حذف کنید؟')">
                                            <i class="fas fa-trash ml-2"></i>
                                            حذف خدمت
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
