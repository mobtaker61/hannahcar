<x-admin-layout>
    <x-slot name="header">
        مدیریت تنظیمات سایت
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">تنظیمات سایت</h2>
                        <a href="{{ route('admin.settings.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-plus ml-2"></i>
                            افزودن تنظیم جدید
                        </a>
                    </div>

                    <!-- Settings Categories -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        <!-- General Settings -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-cog text-blue-600 text-xl ml-3"></i>
                                <h3 class="text-lg font-medium text-blue-900">تنظیمات عمومی</h3>
                            </div>
                            <p class="text-blue-700 text-sm mb-4">تنظیمات کلی سایت مانند نام، لوگو، و اطلاعات تماس</p>
                            <a href="{{ route('admin.settings.general') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                مشاهده تنظیمات <i class="fas fa-arrow-left mr-2"></i>
                            </a>
                        </div>

                        <!-- SEO Settings -->
                        <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-search text-green-600 text-xl ml-3"></i>
                                <h3 class="text-lg font-medium text-green-900">تنظیمات SEO</h3>
                            </div>
                            <p class="text-green-700 text-sm mb-4">تنظیمات بهینه‌سازی موتورهای جستجو</p>
                            <a href="{{ route('admin.settings.seo') }}" class="text-green-600 hover:text-green-800 font-medium">
                                مشاهده تنظیمات <i class="fas fa-arrow-left mr-2"></i>
                            </a>
                        </div>

                        <!-- Social Media -->
                        <div class="bg-purple-50 border border-purple-200 rounded-lg p-6">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-share-alt text-purple-600 text-xl ml-3"></i>
                                <h3 class="text-lg font-medium text-purple-900">شبکه‌های اجتماعی</h3>
                            </div>
                            <p class="text-purple-700 text-sm mb-4">لینک‌های شبکه‌های اجتماعی</p>
                            <a href="{{ route('admin.settings.social') }}" class="text-purple-600 hover:text-purple-800 font-medium">
                                مشاهده تنظیمات <i class="fas fa-arrow-left mr-2"></i>
                            </a>
                        </div>

                        <!-- Contact Settings -->
                        <div class="bg-orange-50 border border-orange-200 rounded-lg p-6">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-phone text-orange-600 text-xl ml-3"></i>
                                <h3 class="text-lg font-medium text-orange-900">اطلاعات تماس</h3>
                            </div>
                            <p class="text-orange-700 text-sm mb-4">آدرس، تلفن، ایمیل و ساعات کاری</p>
                            <a href="{{ route('admin.settings.contact') }}" class="text-orange-600 hover:text-orange-800 font-medium">
                                مشاهده تنظیمات <i class="fas fa-arrow-left mr-2"></i>
                            </a>
                        </div>

                        <!-- Email Settings -->
                        <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-envelope text-red-600 text-xl ml-3"></i>
                                <h3 class="text-lg font-medium text-red-900">تنظیمات ایمیل</h3>
                            </div>
                            <p class="text-red-700 text-sm mb-4">تنظیمات ارسال ایمیل و قالب‌ها</p>
                            <a href="{{ route('admin.settings.email') }}" class="text-red-600 hover:text-red-800 font-medium">
                                مشاهده تنظیمات <i class="fas fa-arrow-left mr-2"></i>
                            </a>
                        </div>

                        <!-- System Settings -->
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-server text-gray-600 text-xl ml-3"></i>
                                <h3 class="text-lg font-medium text-gray-900">تنظیمات سیستم</h3>
                            </div>
                            <p class="text-gray-700 text-sm mb-4">تنظیمات پیشرفته سیستم</p>
                            <a href="{{ route('admin.settings.system') }}" class="text-gray-600 hover:text-gray-800 font-medium">
                                مشاهده تنظیمات <i class="fas fa-arrow-left mr-2"></i>
                            </a>
                        </div>

                        <!-- Notification Channels Settings -->
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-bell text-yellow-600 text-xl ml-3"></i>
                                <h3 class="text-lg font-medium text-yellow-900">کانال‌های اطلاع‌رسانی</h3>
                            </div>
                            <p class="text-yellow-700 text-sm mb-4">مدیریت و تنظیمات ارسال پیام از طریق SMS، واتساپ، تلگرام و ایمیل</p>
                            <a href="{{ route('admin.settings.notification') }}" class="text-yellow-600 hover:text-yellow-800 font-medium">
                                مشاهده تنظیمات <i class="fas fa-arrow-left mr-2"></i>
                            </a>
                        </div>
                    </div>

                    <!-- All Settings Table -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">همه تنظیمات</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            کلید
                                        </th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            مقدار
                                        </th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            گروه
                                        </th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            وضعیت
                                        </th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            عملیات
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($settings as $setting)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $setting->key }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <div class="max-w-xs truncate">
                                                    {{ $setting->translations->first()?->value ?? $setting->default_value ?? '-' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    {{ $setting->group }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $setting->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $setting->is_active ? 'فعال' : 'غیرفعال' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2 space-x-reverse">
                                                    <a href="{{ route('admin.settings.show', $setting) }}" class="text-gray-600 hover:text-gray-900">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.settings.edit', $setting) }}" class="text-blue-600 hover:text-blue-900">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.settings.toggle-status', $setting) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="{{ $setting->is_active ? 'text-red-600 hover:text-red-900' : 'text-green-600 hover:text-green-900' }}">
                                                            <i class="fas {{ $setting->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.settings.destroy', $setting) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('آیا مطمئن هستید که می‌خواهید این تنظیم را حذف کنید؟')">
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

                        @if($settings->count() === 0)
                            <div class="text-center py-8">
                                <i class="fas fa-cogs text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-500">هیچ تنظیمی یافت نشد.</p>
                                <a href="{{ route('admin.settings.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-700 text-white font-bold rounded">
                                    <i class="fas fa-plus ml-2"></i>
                                    افزودن اولین تنظیم
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">عملیات سریع</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <a href="{{ route('admin.settings.export') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                                <i class="fas fa-download ml-2"></i>
                                خروجی تنظیمات
                            </a>
                            <a href="{{ route('admin.settings.import') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-center">
                                <i class="fas fa-upload ml-2"></i>
                                ورودی تنظیمات
                            </a>
                            <a href="{{ route('admin.settings.reset') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-center" onclick="return confirm('آیا مطمئن هستید که می‌خواهید همه تنظیمات را به حالت پیش‌فرض بازگردانید؟')">
                                <i class="fas fa-undo ml-2"></i>
                                بازگشت به پیش‌فرض
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
