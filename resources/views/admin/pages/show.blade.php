<x-admin-layout>
    <x-slot name="header">
        نمایش صفحه: {{ $page->translations->first()?->title ?? $page->slug }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">جزئیات صفحه</h2>
                        <div class="flex space-x-2 space-x-reverse">
                            <a href="{{ route('admin.pages.edit', $page) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-edit ml-2"></i>
                                ویرایش
                            </a>
                            <a href="{{ route('admin.pages.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                بازگشت
                            </a>
                        </div>
                    </div>

                    <!-- Basic Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">اطلاعات پایه</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                                <div class="bg-gray-100 px-3 py-2 rounded-md">
                                    <code>{{ $page->slug }}</code>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">قالب</label>
                                <div class="bg-gray-100 px-3 py-2 rounded-md">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $page->template === 'simple' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                        {{ $page->template === 'simple' ? 'ساده' : 'سایدبار' }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">وضعیت</label>
                                <div class="bg-gray-100 px-3 py-2 rounded-md">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $page->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $page->status === 'published' ? 'منتشر شده' : 'پیش‌نویس' }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">ترتیب نمایش</label>
                                <div class="bg-gray-100 px-3 py-2 rounded-md">
                                    {{ $page->sort_order }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Translations -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">ترجمه‌ها</h3>
                        <div class="space-y-6">
                            @foreach($page->translations as $translation)
                                <div class="border border-gray-200 rounded-lg p-6">
                                    <h4 class="text-md font-medium text-gray-900 mb-4 flex items-center">
                                        <span class="w-6 h-6 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center text-sm font-bold ml-2">
                                            {{ strtoupper($translation->language->code) }}
                                        </span>
                                        {{ $translation->language->native_name }}
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $translation->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} mr-2">
                                            {{ $translation->is_active ? 'فعال' : 'غیرفعال' }}
                                        </span>
                                    </h4>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">عنوان</label>
                                            <div class="bg-gray-50 px-3 py-2 rounded-md">
                                                {{ $translation->title }}
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">عنوان متا</label>
                                            <div class="bg-gray-50 px-3 py-2 rounded-md">
                                                {{ $translation->meta_title ?: '-' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">توضیحات متا</label>
                                        <div class="bg-gray-50 px-3 py-2 rounded-md">
                                            {{ $translation->meta_description ?: '-' }}
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">کلمات کلیدی متا</label>
                                        <div class="bg-gray-50 px-3 py-2 rounded-md">
                                            {{ $translation->meta_keywords ?: '-' }}
                                        </div>
                                    </div>

                                    @if($translation->content)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">محتوای صفحه</label>
                                            <div class="bg-gray-50 px-3 py-2 rounded-md border">
                                                <div class="prose max-w-none">
                                                    {!! $translation->content !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        @if($page->translations->count() === 0)
                            <div class="text-center py-8">
                                <i class="fas fa-language text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-500">هیچ ترجمه‌ای برای این صفحه وجود ندارد.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Page Preview -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">پیش‌نمایش صفحه</h3>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-md font-medium text-gray-900">لینک صفحه</h4>
                                <a href="{{ url('/' . $page->slug) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-external-link-alt ml-2"></i>
                                    مشاهده در سایت
                                </a>
                            </div>
                            <div class="bg-white border border-gray-200 rounded p-3">
                                <code class="text-sm">{{ url('/' . $page->slug) }}</code>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
