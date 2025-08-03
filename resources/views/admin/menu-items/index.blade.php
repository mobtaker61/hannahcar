<x-admin-layout>
    <x-slot name="header">
        مدیریت آیتم‌های منو - {{ $menu->translations->first()?->name ?? 'بدون نام' }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">آیتم‌های منو</h2>
                            <p class="text-sm text-gray-600 mt-1">
                                منو: {{ $menu->translations->first()?->name ?? 'بدون نام' }}
                                ({{ $menu->position }})
                            </p>
                        </div>
                        <div class="flex space-x-2 space-x-reverse">
                            <a href="{{ route('admin.menus.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-arrow-right ml-2"></i>
                                بازگشت به منوها
                            </a>
                            <a href="{{ route('admin.menu-items.create', $menu) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-plus ml-2"></i>
                                افزودن آیتم جدید
                            </a>
                        </div>
                    </div>

                    <!-- Menu Items Table -->
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
                                        هدف
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
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        عملیات
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($menu->menuItems->whereNull('parent_id')->sortBy('sort_order') as $menuItem)
                                    @include('admin.menu-items._item_row', ['menuItem' => $menuItem, 'level' => 0])
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($menu->menuItems->count() === 0)
                        <div class="text-center py-8">
                            <i class="fas fa-list text-4xl text-gray-400 mb-4"></i>
                            <p class="text-gray-500">هیچ آیتم منویی یافت نشد.</p>
                            <a href="{{ route('admin.menu-items.create', $menu) }}" class="mt-4 inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-700 text-white font-bold rounded">
                                <i class="fas fa-plus ml-2"></i>
                                افزودن اولین آیتم
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
