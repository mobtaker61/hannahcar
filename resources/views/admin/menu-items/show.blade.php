<x-admin-layout>
    <x-slot name="header">
        مشاهده آیتم منو
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">جزئیات آیتم منو</h2>
                            <p class="text-sm text-gray-600 mt-1">
                                منو: {{ $menu->translations->first()?->name ?? 'بدون نام' }}
                            </p>
                        </div>
                        <div class="flex space-x-2 space-x-reverse">
                            <a href="{{ route('admin.menu-items.index', $menu) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-arrow-right ml-2"></i>
                                بازگشت
                            </a>
                            <a href="{{ route('admin.menu-items.edit', [$menu, $menuItem]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-edit ml-2"></i>
                                ویرایش
                            </a>
                        </div>
                    </div>

                    <!-- Basic Information -->
                    <div class="bg-gray-50 p-6 rounded-lg mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">اطلاعات پایه</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">لینک</label>
                                <p class="text-sm text-gray-900 font-mono bg-white px-3 py-2 rounded border">
                                    {{ $menuItem->url }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">هدف لینک</label>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $menuItem->target }}
                                </span>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">آیتم والد</label>
                                <p class="text-sm text-gray-900">
                                    @if($menuItem->parent)
                                        <span class="text-green-600">
                                            {{ $menuItem->parent->translations->first()?->title ?? 'بدون عنوان' }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">بدون والد (آیتم اصلی)</span>
                                    @endif
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">ترتیب نمایش</label>
                                <p class="text-sm text-gray-900">{{ $menuItem->sort_order }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">وضعیت</label>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $menuItem->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $menuItem->is_active ? 'فعال' : 'غیرفعال' }}
                                </span>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">تاریخ ایجاد</label>
                                <p class="text-sm text-gray-900">{{ $menuItem->created_at->format('Y/m/d H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Translations -->
                    <div class="bg-gray-50 p-6 rounded-lg mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">ترجمه‌ها</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($menuItem->translations as $translation)
                                <div class="bg-white p-4 rounded-lg border">
                                    <div class="flex items-center mb-3">
                                        <span class="inline-block w-6 h-6 rounded-full bg-blue-100 text-blue-800 text-sm font-bold text-center leading-6 mr-2">
                                            {{ strtoupper(substr($translation->language->code, 0, 1)) }}
                                        </span>
                                        <h4 class="text-md font-medium text-gray-800">{{ $translation->language->name }}</h4>
                                    </div>

                                    <div class="space-y-2">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-700">عنوان</label>
                                            <p class="text-sm text-gray-900 font-medium">{{ $translation->title }}</p>
                                        </div>

                                        <div>
                                            <label class="block text-xs font-medium text-gray-700">وضعیت</label>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $translation->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $translation->is_active ? 'فعال' : 'غیرفعال' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Children Items -->
                    @if($menuItem->children->count() > 0)
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">آیتم‌های فرزند</h3>

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">عنوان</th>
                                            <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">لینک</th>
                                            <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">وضعیت</th>
                                            <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($menuItem->children->sortBy('sort_order') as $child)
                                            <tr>
                                                <td class="px-4 py-2 text-sm text-gray-900">
                                                    {{ $child->translations->first()?->title ?? 'بدون عنوان' }}
                                                </td>
                                                <td class="px-4 py-2 text-sm text-gray-900 font-mono text-xs">
                                                    {{ $child->url }}
                                                </td>
                                                <td class="px-4 py-2 text-sm text-gray-900">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $child->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                        {{ $child->is_active ? 'فعال' : 'غیرفعال' }}
                                                    </span>
                                                </td>
                                                <td class="px-4 py-2 text-sm font-medium">
                                                    <a href="{{ route('admin.menu-items.show', [$menu, $child]) }}" class="text-blue-600 hover:text-blue-900">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
