<x-admin-layout>
    <x-slot name="header">
        پیگیری استعلام خرید خودرو خاص (کد: {{ $inquiry->id }})
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">اطلاعات فرم</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <span class="font-medium">نام و نام خانوادگی:</span> {{ $inquiry->first_name }} {{ $inquiry->last_name }}
                            </div>
                            <div>
                                <span class="font-medium">شماره تلفن:</span> {{ $inquiry->phone }}
                            </div>
                            <div>
                                <span class="font-medium">برند خودرو:</span> {{ $inquiry->car_brand }}
                            </div>
                            <div>
                                <span class="font-medium">مدل خودرو:</span> {{ $inquiry->car_model }}
                            </div>
                            <div>
                                <span class="font-medium">سال ساخت:</span> {{ $inquiry->car_year }}
                            </div>
                            <div>
                                <span class="font-medium">توضیحات:</span> {{ $inquiry->description }}
                            </div>
                            <div>
                                <span class="font-medium">تاریخ ثبت:</span> {{ jdate($inquiry->created_at)->format('Y/m/d H:i') }}
                            </div>
                            <div>
                                <span class="font-medium">وضعیت فعلی:</span>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $inquiry->status === 'new' ? 'bg-blue-100 text-blue-800' : ($inquiry->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : ($inquiry->status === 'done' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800')) }}">
                                    {{ __($inquiry->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">لاگ پیگیری کارمندان</h2>
                        <div class="mb-4">
                            <form action="{{ route('admin.inquiries.special_car_purchases.logs.store', $inquiry) }}" method="POST" class="flex flex-col md:flex-row gap-4 items-end">
                                @csrf
                                <div class="flex-1">
                                    <label for="action" class="block text-sm font-medium text-gray-700 mb-1">توضیح اقدام</label>
                                    <input type="text" name="action" id="action" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                                </div>
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">وضعیت جدید</label>
                                    <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                        <option value="new" {{ $inquiry->status === 'new' ? 'selected' : '' }}>جدید</option>
                                        <option value="in_progress" {{ $inquiry->status === 'in_progress' ? 'selected' : '' }}>در حال بررسی</option>
                                        <option value="done" {{ $inquiry->status === 'done' ? 'selected' : '' }}>انجام شده</option>
                                        <option value="rejected" {{ $inquiry->status === 'rejected' ? 'selected' : '' }}>رد شده</option>
                                    </select>
                                </div>
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">ثبت لاگ</button>
                            </form>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">تاریخ</th>
                                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">کارمند</th>
                                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">توضیح</th>
                                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">وضعیت</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($inquiry->logs as $log)
                                        <tr>
                                            <td class="px-4 py-2 text-sm text-gray-900">{{ jdate($log->created_at)->format('Y/m/d H:i') }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-900">{{ $log->user ? $log->user->name : '-' }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-900">{{ $log->action }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-900">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $log->status === 'new' ? 'bg-blue-100 text-blue-800' : ($log->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : ($log->status === 'done' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800')) }}">
                                                    {{ __($log->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-4 py-2 text-sm text-gray-500 text-center">لاگی ثبت نشده است.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('admin.inquiries.special_car_purchases.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">بازگشت به لیست</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
