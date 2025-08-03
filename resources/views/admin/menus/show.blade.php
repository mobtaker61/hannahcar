<x-admin-layout>
    <x-slot name="header">
        نمایش منو: {{ $menu->translations->first()?->name ?? 'بدون نام' }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">جزئیات منو</h2>
                        <div class="flex space-x-2 space-x-reverse">
                            <a href="{{ route('admin.menu-items.index', ['menu' => $menu->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-list ml-2"></i>
                                مدیریت آیتم‌ها
                            </a>
                            <a href="{{ route('admin.menus.edit', $menu) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-edit ml-2"></i>
                                ویرایش
                            </a>
                            <a href="{{ route('admin.menus.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                بازگشت
                            </a>
                        </div>
                    </div>

                    <!-- Basic Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">اطلاعات پایه</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">موقعیت منو</label>
                                <div class="bg-gray-100 px-3 py-2 rounded-md">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $menu->position }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">وضعیت</label>
                                <div class="bg-gray-100 px-3 py-2 rounded-md">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $menu->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $menu->is_active ? 'فعال' : 'غیرفعال' }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">ترتیب نمایش</label>
                                <div class="bg-gray-100 px-3 py-2 rounded-md">
                                    {{ $menu->sort_order }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Translations -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">ترجمه‌ها</h3>
                        <div class="space-y-6">
                            @foreach($menu->translations as $translation)
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

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">نام منو</label>
                                            <div class="bg-gray-50 px-3 py-2 rounded-md">
                                                {{ $translation->name }}
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">توضیحات</label>
                                            <div class="bg-gray-50 px-3 py-2 rounded-md">
                                                {{ $translation->description ?: '-' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if($menu->translations->count() === 0)
                            <div class="text-center py-8">
                                <i class="fas fa-language text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-500">هیچ ترجمه‌ای برای این منو وجود ندارد.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Menu Items -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">آیتم‌های منو</h3>
                        @if($menu->menuItems->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                عنوان
                                            </th>
                                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                لینک
                                            </th>
                                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                والد
                                            </th>
                                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                وضعیت
                                            </th>
                                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                ترتیب
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($menu->menuItems->sortBy('sort_order') as $item)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $item->translations->first()?->title ?? 'بدون عنوان' }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $item->url ?: '-' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $item->parent ? $item->parent->translations->first()?->title : '-' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                        {{ $item->is_active ? 'فعال' : 'غیرفعال' }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $item->sort_order }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-list text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-500">هیچ آیتمی در این منو وجود ندارد.</p>
                                <a href="{{ route('admin.menu-items.create', ['menu' => $menu->id]) }}" class="mt-4 inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-700 text-white font-bold rounded">
                                    <i class="fas fa-plus ml-2"></i>
                                    افزودن آیتم جدید
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Menu Preview -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">پیش‌نمایش منو</h3>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                            <div class="bg-white rounded-lg p-4">
                                <h4 class="text-lg font-semibold text-gray-900 mb-3">{{ $menu->translations->first()?->name ?? 'منو' }}</h4>
                                @if($menu->menuItems->count() > 0)
                                    <ul class="space-y-2">
                                        @foreach($menu->menuItems->where('parent_id', null)->sortBy('sort_order') as $item)
                                            <li class="flex items-center">
                                                <span class="w-2 h-2 bg-blue-500 rounded-full ml-2"></span>
                                                <a href="{{ $item->url }}" class="text-blue-600 hover:text-blue-800">
                                                    {{ $item->translations->first()?->title ?? 'بدون عنوان' }}
                                                </a>
                                                @if($item->children->count() > 0)
                                                    <ul class="mr-6 mt-2 space-y-1">
                                                        @foreach($item->children->sortBy('sort_order') as $child)
                                                            <li class="flex items-center">
                                                                <span class="w-1 h-1 bg-gray-400 rounded-full ml-2"></span>
                                                                <a href="{{ $child->url }}" class="text-gray-600 hover:text-gray-800 text-sm">
                                                                    {{ $child->translations->first()?->title ?? 'بدون عنوان' }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-gray-500">هیچ آیتمی برای نمایش وجود ندارد.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
