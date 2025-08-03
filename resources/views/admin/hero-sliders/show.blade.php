<x-admin-layout>
    <x-slot name="header">
        نمایش اسلایدر: {{ $heroSlider->translations->first()?->title ?? 'بدون عنوان' }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">جزئیات اسلایدر</h2>
                        <div class="flex space-x-2 space-x-reverse">
                            <a href="{{ route('admin.hero-sliders.edit', $heroSlider) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-edit ml-2"></i>
                                ویرایش
                            </a>
                            <a href="{{ route('admin.hero-sliders.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
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
                                    @if($heroSlider->image)
                                        <img src="{{ $heroSlider->image }}" alt="تصویر اسلایدر" class="w-full h-48 object-cover rounded-lg">
                                    @else
                                        <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400">
                                            <i class="fas fa-image text-4xl"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">آدرس دکمه</label>
                                    <div class="bg-gray-100 px-3 py-2 rounded-md">
                                        {{ $heroSlider->button_url ?: '-' }}
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">رنگ نشان</label>
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 rounded-full border border-gray-300 ml-2" style="background-color: {{ $heroSlider->badge_color }}"></div>
                                        <span class="text-sm text-gray-900">{{ $heroSlider->badge_color }}</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">وضعیت</label>
                                    <div class="bg-gray-100 px-3 py-2 rounded-md">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $heroSlider->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $heroSlider->is_active ? 'فعال' : 'غیرفعال' }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">ترتیب نمایش</label>
                                    <div class="bg-gray-100 px-3 py-2 rounded-md">
                                        {{ $heroSlider->sort_order }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Translations -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">ترجمه‌ها</h3>
                        <div class="space-y-6">
                            @foreach($heroSlider->translations as $translation)
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
                                            <label class="block text-sm font-medium text-gray-700 mb-2">متن نشان</label>
                                            <div class="bg-gray-50 px-3 py-2 rounded-md">
                                                {{ $translation->badge_text ?: '-' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if($heroSlider->translations->count() === 0)
                            <div class="text-center py-8">
                                <i class="fas fa-language text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-500">هیچ ترجمه‌ای برای این اسلایدر وجود ندارد.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Preview -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">پیش‌نمایش اسلایدر</h3>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                                @if($heroSlider->image)
                                    <div class="relative">
                                        <img src="{{ $heroSlider->image }}" alt="تصویر اسلایدر" class="w-full h-64 object-cover">
                                        @if($heroSlider->translations->first()?->badge_text)
                                            <div class="absolute top-4 right-4">
                                                <span class="px-3 py-1 text-sm font-semibold text-white rounded-full" style="background-color: {{ $heroSlider->badge_color }}">
                                                    {{ $heroSlider->translations->first()->badge_text }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                                        {{ $heroSlider->translations->first()?->title ?? 'بدون عنوان' }}
                                    </h3>
                                    @if($heroSlider->translations->first()?->subtitle)
                                        <p class="text-lg text-gray-600 mb-3">{{ $heroSlider->translations->first()->subtitle }}</p>
                                    @endif
                                    @if($heroSlider->translations->first()?->description)
                                        <p class="text-gray-700 mb-4">{{ $heroSlider->translations->first()->description }}</p>
                                    @endif
                                    @if($heroSlider->translations->first()?->button_text && $heroSlider->button_url)
                                        <a href="{{ $heroSlider->button_url }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            {{ $heroSlider->translations->first()->button_text }}
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
