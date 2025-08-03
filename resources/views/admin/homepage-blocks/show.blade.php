<x-admin-layout>
    <x-slot name="header">
        نمایش بلوک: {{ $homepageBlock->translations->first()?->title ?? 'بدون عنوان' }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">جزئیات بلوک</h2>
                        <div class="flex space-x-2 space-x-reverse">
                            <a href="{{ route('admin.homepage-blocks.edit', $homepageBlock) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-edit ml-2"></i>
                                ویرایش
                            </a>
                            <a href="{{ route('admin.homepage-blocks.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                بازگشت
                            </a>
                        </div>
                    </div>

                    <!-- Basic Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">اطلاعات پایه</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">تصویر</label>
                                <div class="bg-gray-100 p-4 rounded-md">
                                    @if($homepageBlock->image)
                                        <img src="{{ $homepageBlock->image }}" alt="تصویر بلوک" class="w-full h-48 object-cover rounded-lg">
                                    @else
                                        <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400">
                                            <i class="fas fa-image text-4xl"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">نوع بلوک</label>
                                    <div class="bg-gray-100 px-3 py-2 rounded-md">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                            {{ $homepageBlock->type }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">آدرس دکمه</label>
                                    <div class="bg-gray-100 px-3 py-2 rounded-md">
                                        {{ $homepageBlock->button_url ?: '-' }}
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">آیکون</label>
                                    <div class="bg-gray-100 px-3 py-2 rounded-md">
                                        @if($homepageBlock->icon)
                                            <i class="{{ $homepageBlock->icon }} text-xl text-gray-600"></i>
                                            <span class="mr-2">{{ $homepageBlock->icon }}</span>
                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">رنگ پس‌زمینه</label>
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 rounded-full border border-gray-300 ml-2" style="background-color: {{ $homepageBlock->background_color }}"></div>
                                        <span class="text-sm text-gray-900">{{ $homepageBlock->background_color }}</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">وضعیت</label>
                                    <div class="bg-gray-100 px-3 py-2 rounded-md">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $homepageBlock->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $homepageBlock->is_active ? 'فعال' : 'غیرفعال' }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">ترتیب نمایش</label>
                                    <div class="bg-gray-100 px-3 py-2 rounded-md">
                                        {{ $homepageBlock->sort_order }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Translations -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">ترجمه‌ها</h3>
                        <div class="space-y-6">
                            @foreach($homepageBlock->translations as $translation)
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
                                            <label class="block text-sm font-medium text-gray-700 mb-2">زیرعنوان</label>
                                            <div class="bg-gray-50 px-3 py-2 rounded-md">
                                                {{ $translation->subtitle ?: '-' }}
                                            </div>
                                        </div>
                                    </div>

                                    @if($translation->description)
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">توضیحات</label>
                                            <div class="bg-gray-50 px-3 py-2 rounded-md">
                                                {{ $translation->description }}
                                            </div>
                                        </div>
                                    @endif

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">متن دکمه</label>
                                            <div class="bg-gray-50 px-3 py-2 rounded-md">
                                                {{ $translation->button_text ?: '-' }}
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">داده‌های متا</label>
                                            <div class="bg-gray-50 px-3 py-2 rounded-md">
                                                @if($translation->meta_data)
                                                    <pre class="text-xs text-gray-600">{{ json_encode(json_decode($translation->meta_data), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if($homepageBlock->translations->count() === 0)
                            <div class="text-center py-8">
                                <i class="fas fa-language text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-500">هیچ ترجمه‌ای برای این بلوک وجود ندارد.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Block Preview -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">پیش‌نمایش بلوک</h3>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg" style="background-color: {{ $homepageBlock->background_color }}">
                                @if($homepageBlock->image)
                                    <div class="relative">
                                        <img src="{{ $homepageBlock->image }}" alt="تصویر بلوک" class="w-full h-48 object-cover">
                                    </div>
                                @endif
                                <div class="p-6">
                                    <div class="flex items-center mb-3">
                                        @if($homepageBlock->icon)
                                            <i class="{{ $homepageBlock->icon }} text-2xl text-gray-600 ml-3"></i>
                                        @endif
                                        <h3 class="text-xl font-bold text-gray-900">
                                            {{ $homepageBlock->translations->first()?->title ?? 'بدون عنوان' }}
                                        </h3>
                                    </div>
                                    @if($homepageBlock->translations->first()?->subtitle)
                                        <p class="text-lg text-gray-600 mb-3">{{ $homepageBlock->translations->first()->subtitle }}</p>
                                    @endif
                                    @if($homepageBlock->translations->first()?->description)
                                        <p class="text-gray-700 mb-4">{{ $homepageBlock->translations->first()->description }}</p>
                                    @endif
                                    @if($homepageBlock->translations->first()?->button_text && $homepageBlock->button_url)
                                        <a href="{{ $homepageBlock->button_url }}" class="inline-block bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                            {{ $homepageBlock->translations->first()->button_text }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
