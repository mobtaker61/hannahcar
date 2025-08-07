<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                پیگیری استعلام (کد: {{ $inquiry->id }})
            </h2>
            <div class="flex items-center gap-2">
                <span class="font-medium">وضعیت فعلی:</span>
                <span
                    class="px-2 inline-flex leading-5 font-semibold rounded-full {{ $inquiry->status === 'new' ? 'bg-blue-100 text-blue-800' : ($inquiry->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : ($inquiry->status === 'done' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800')) }}">
                    {{ __($inquiry->status) }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- کارت اطلاعات فرم -->
                <div class="lg:col-span-3">
                    <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">اطلاعات درخواست</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($fields as $label => $value)
                                <div>
                                    <span class="font-medium">{{ $label }}:</span>
                                    @if ($label === 'توضیحات' && $value)
                                        <div class="mt-1 p-3 bg-gray-50 rounded-md text-sm">{{ $value }}</div>
                                    @else
                                        <span
                                            class="{{ $value ? 'text-gray-900' : 'text-gray-500' }}">{{ $value ?: '-' }}</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- کارت اطلاعات کاربر -->
                <div class="lg:col-span-1">
                    <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">اطلاعات کاربر</h2>
                        <div class="space-y-3">
                            <div><span class="font-medium">نام و نام خانوادگی:</span> {{ $inquiry->user->name ?? ($inquiry->first_name . ' ' . $inquiry->last_name) }}</div>
                            <div><span class="font-medium">شماره تلفن:</span> {{ $inquiry->user->phone ?? $inquiry->phone }}</div>
                            <div><span class="font-medium">تاریخ ثبت:</span>
                                {{ $inquiry->created_at->format('Y/m/d H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- بخش لاگ پیگیری -->
            <div class="bg-white shadow-sm rounded-lg p-6 mt-2">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">لاگ پیگیری کارمندان</h2>
                <div class="mb-4">
                    <form action="{{ route('admin.inquiries.logs.store', ['type' => $type, 'id' => $inquiry->id]) }}"
                        method="POST" class="flex flex-col md:flex-row gap-4 items-end">
                        @csrf
                        <div class="flex-1">
                            <label for="action" class="block text-sm font-medium text-gray-700 mb-1">توضیح
                                اقدام</label>
                            <input type="text" name="action" id="action"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">وضعیت
                                جدید</label>
                            <select name="status" id="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                <option value="new" {{ $inquiry->status === 'new' ? 'selected' : '' }}>جدید</option>
                                <option value="in_progress" {{ $inquiry->status === 'in_progress' ? 'selected' : '' }}>
                                    در حال بررسی</option>
                                <option value="done" {{ $inquiry->status === 'done' ? 'selected' : '' }}>انجام شده
                                </option>
                                <option value="rejected" {{ $inquiry->status === 'rejected' ? 'selected' : '' }}>رد شده
                                </option>
                            </select>
                        </div>
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">ثبت
                            لاگ</button>
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
                                    <td class="px-4 py-2 text-sm text-gray-900">
                                        {{ $log->created_at->format('Y/m/d H:i') }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">
                                        {{ $log->user ? $log->user->name : '-' }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">{{ $log->action }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $log->status === 'new' ? 'bg-blue-100 text-blue-800' : ($log->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : ($log->status === 'done' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800')) }}">
                                            {{ __($log->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-sm text-gray-500 text-center">لاگی ثبت نشده
                                        است.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end mt-6">
                    <a href="{{ route('admin.inquiries.index') }}"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">بازگشت به لیست</a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
