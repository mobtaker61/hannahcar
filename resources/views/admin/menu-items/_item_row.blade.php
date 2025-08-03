<tr>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
            <div class="flex-shrink-0" style="margin-left: {{ $level * 20 }}px;">
                @if($level > 0)
                    <i class="fas fa-level-down-alt text-gray-400 mr-2"></i>
                @endif
            </div>
            <div class="text-sm font-medium text-gray-900">
                {{ $menuItem->translations->first()?->title ?? 'بدون عنوان' }}
            </div>
        </div>
        <div class="text-sm text-gray-500">
            {{ $menuItem->translations->count() }} ترجمه
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <span class="font-mono text-xs bg-gray-100 px-2 py-1 rounded">
            {{ $menuItem->url }}
        </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
            {{ $menuItem->target }}
        </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        @if($menuItem->parent)
            <span class="text-green-600">
                {{ $menuItem->parent->translations->first()?->title ?? 'بدون عنوان' }}
            </span>
        @else
            <span class="text-gray-400">اصلی</span>
        @endif
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $menuItem->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
            {{ $menuItem->is_active ? 'فعال' : 'غیرفعال' }}
        </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        {{ $menuItem->sort_order }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <div class="flex space-x-2 space-x-reverse">
            <a href="{{ route('admin.menu-items.show', [$menu, $menuItem]) }}" class="text-gray-600 hover:text-gray-900" title="مشاهده">
                <i class="fas fa-eye"></i>
            </a>
            <a href="{{ route('admin.menu-items.edit', [$menu, $menuItem]) }}" class="text-blue-600 hover:text-blue-900" title="ویرایش">
                <i class="fas fa-edit"></i>
            </a>
            <form action="{{ route('admin.menu-items.toggle-status', [$menu, $menuItem]) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="{{ $menuItem->is_active ? 'text-red-600 hover:text-red-900' : 'text-green-600 hover:text-green-900' }}" title="{{ $menuItem->is_active ? 'غیرفعال کردن' : 'فعال کردن' }}">
                    <i class="fas {{ $menuItem->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                </button>
            </form>
            <form action="{{ route('admin.menu-items.destroy', [$menu, $menuItem]) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('آیا مطمئن هستید که می‌خواهید این آیتم منو را حذف کنید؟')" title="حذف">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </td>
</tr>

@foreach($menuItem->children->sortBy('sort_order') as $child)
    @include('admin.menu-items._item_row', ['menuItem' => $child, 'level' => $level + 1])
@endforeach
