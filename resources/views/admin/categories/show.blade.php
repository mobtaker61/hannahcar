<x-admin-layout>
    <x-slot name="header">
        مشاهده دسته‌بندی: {{ $category->name }}
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
                                                <code class="bg-gray-100 px-2 py-1 rounded">{{ $category->slug }}</code>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">ترتیب</label>
                                            <div class="text-sm text-gray-900">{{ $category->sort_order }}</div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">وضعیت</label>
                                            <div class="text-sm text-gray-900">
                                                @if($category->is_active)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        فعال
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        غیرفعال
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">تعداد مقالات</label>
                                            <div class="text-sm text-gray-900">{{ $category->articles->count() }} مقاله</div>
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
                                        @foreach($category->translations as $translation)
                                            <div class="border border-gray-200 rounded-lg p-4">
                                                <div class="flex items-center mb-4">
                                                    <span class="w-6 h-6 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center text-sm font-bold ml-2">
                                                        {{ strtoupper($translation->language->code) }}
                                                    </span>
                                                    <h4 class="text-md font-medium text-gray-900">{{ $translation->language->native_name }}</h4>
                                                </div>

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">نام</label>
                                                        <div class="text-sm text-gray-900">{{ $translation->name }}</div>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                                                        <div class="text-sm text-gray-900">{{ $translation->meta_title ?: '-' }}</div>
                                                    </div>
                                                </div>

                                                @if($translation->description)
                                                    <div class="mt-4">
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">توضیحات</label>
                                                        <div class="text-sm text-gray-900">{{ $translation->description }}</div>
                                                    </div>
                                                @endif

                                                @if($translation->meta_description)
                                                    <div class="mt-4">
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                                                        <div class="text-sm text-gray-900">{{ $translation->meta_description }}</div>
                                                    </div>
                                                @endif

                                                @if($translation->featured_image)
                                                    <div class="mt-4">
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">تصویر شاخص</label>
                                                        <div class="text-sm text-gray-900">
                                                            <img src="{{ asset('storage/' . $translation->featured_image) }}"
                                                                 alt="{{ $translation->name }}"
                                                                 class="w-32 h-32 object-cover rounded">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Articles in this category -->
                            @if($category->articles->count() > 0)
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                                    <div class="px-6 py-4 border-b border-gray-200">
                                        <h3 class="text-lg font-medium text-gray-900">مقالات این دسته‌بندی</h3>
                                    </div>
                                    <div class="p-6">
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            عنوان
                                                        </th>
                                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            وضعیت
                                                        </th>
                                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            تاریخ انتشار
                                                        </th>
                                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            عملیات
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    @foreach($category->articles->take(10) as $article)
                                                        <tr>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <div class="text-sm font-medium text-gray-900">{{ $article->title }}</div>
                                                                <div class="text-sm text-gray-500">{{ $article->slug }}</div>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
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
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                                @if($article->published_at)
                                                                    {{ $article->published_at->format('Y/m/d H:i') }}
                                                                @else
                                                                    <span class="text-gray-500">-</span>
                                                                @endif
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                                <a href="{{ route('admin.articles.show', $article) }}" class="text-blue-600 hover:text-blue-900">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        @if($category->articles->count() > 10)
                                            <div class="mt-4 text-center">
                                                <p class="text-sm text-gray-500">
                                                    نمایش 10 مقاله از {{ $category->articles->count() }} مقاله
                                                </p>
                                                <a href="{{ route('admin.articles.index', ['category_id' => $category->id]) }}"
                                                   class="mt-2 inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">
                                                    مشاهده همه مقالات
                                                </a>
                                            </div>
                                        @endif
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
                                        <a href="{{ route('admin.categories.edit', $category) }}"
                                           class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block text-center">
                                            <i class="fas fa-edit ml-2"></i>
                                            ویرایش
                                        </a>
                                        <a href="{{ route('admin.categories.index') }}"
                                           class="w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-block text-center">
                                            <i class="fas fa-arrow-left ml-2"></i>
                                            بازگشت
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Category Info -->
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                                <div class="px-4 py-3 border-b border-gray-200">
                                    <h5 class="text-lg font-medium text-gray-900">اطلاعات دسته‌بندی</h5>
                                </div>
                                <div class="p-4">
                                    <div class="space-y-3 text-sm">
                                        <div>
                                            <span class="font-medium text-gray-700">تاریخ ایجاد:</span>
                                            <div class="text-gray-600">{{ $category->created_at->format('Y/m/d H:i') }}</div>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">آخرین بروزرسانی:</span>
                                            <div class="text-gray-600">{{ $category->updated_at->format('Y/m/d H:i') }}</div>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">تعداد مقالات:</span>
                                            <div class="text-gray-600">{{ $category->articles->count() }} مقاله</div>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">تعداد ترجمه‌ها:</span>
                                            <div class="text-gray-600">{{ $category->translations->count() }} زبان</div>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">وضعیت:</span>
                                            <div class="text-gray-600">
                                                @if($category->is_active)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        فعال
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        غیرفعال
                                                    </span>
                                                @endif
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
    </div>
</x-admin-layout>
