<x-admin-layout>
    <x-slot name="header">
        مدیریت بلوک‌های صفحه اول
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">لیست بلوک‌های صفحه اول</h2>
                        <a href="{{ route('admin.homepage-blocks.create') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-plus ml-2"></i>
                            افزودن بلوک جدید
                        </a>
                    </div>

                    <!-- Blocks Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        تصویر
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        عنوان
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        نوع
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
                                @foreach($blocks as $block)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="w-16 h-12 bg-gray-200 rounded-lg overflow-hidden">
                                                @if($block->image)
                                                    <img src="{{ $block->image }}" alt="تصویر بلوک" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                        <i class="fas fa-image text-xl"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $block->translations->first()?->title ?? 'بدون عنوان' }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $block->translations->count() }} ترجمه
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                                {{ $block->type }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $block->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $block->is_active ? 'فعال' : 'غیرفعال' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $block->sort_order }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2 space-x-reverse">
                                                <a href="{{ route('admin.homepage-blocks.show', $block) }}" class="text-gray-600 hover:text-gray-900">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.homepage-blocks.edit', $block) }}" class="text-blue-600 hover:text-blue-900">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.homepage-blocks.toggle-status', $block) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="{{ $block->is_active ? 'text-red-600 hover:text-red-900' : 'text-green-600 hover:text-green-900' }}">
                                                        <i class="fas {{ $block->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.homepage-blocks.destroy', $block) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('آیا مطمئن هستید که می‌خواهید این بلوک را حذف کنید؟')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($blocks->count() === 0)
                        <div class="text-center py-8">
                            <i class="fas fa-th-large text-4xl text-gray-400 mb-4"></i>
                            <p class="text-gray-500">هیچ بلوکی یافت نشد.</p>
                            <a href="{{ route('admin.homepage-blocks.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-700 text-white font-bold rounded">
                                <i class="fas fa-plus ml-2"></i>
                                افزودن اولین بلوک
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
