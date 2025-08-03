<x-admin-layout>
    <x-slot name="header">
        لیست همه استعلام‌ها
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="GET" class="mb-6 flex flex-col md:flex-row gap-4 items-end">
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">نوع درخواست</label>
                            <select name="type" id="type" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                <option value="">همه</option>
                                <option value="special_car_purchase" {{ $type === 'special_car_purchase' ? 'selected' : '' }}>خرید خودرو خاص</option>
                                <option value="special_spare_part" {{ $type === 'special_spare_part' ? 'selected' : '' }}>قطعه یدکی خاص</option>
                                <option value="vin_check" {{ $type === 'vin_check' ? 'selected' : '' }}>استعلام VIN</option>
                            </select>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">وضعیت</label>
                            <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                <option value="">همه</option>
                                <option value="new" {{ $status === 'new' ? 'selected' : '' }}>جدید</option>
                                <option value="in_progress" {{ $status === 'in_progress' ? 'selected' : '' }}>در حال بررسی</option>
                                <option value="done" {{ $status === 'done' ? 'selected' : '' }}>انجام شده</option>
                                <option value="rejected" {{ $status === 'rejected' ? 'selected' : '' }}>رد شده</option>
                            </select>
                        </div>
                        <div class="flex-1">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">جستجو (نام، تلفن، کد)</label>
                            <input type="text" name="search" id="search" value="{{ $search }}" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">اعمال فیلتر</button>
                    </form>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">نوع درخواست</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">نام کاربر</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">شماره تلفن</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">تاریخ ثبت</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">وضعیت</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">عملیات</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($inquiries as $inquiry)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $inquiry->form_type_label }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $inquiry->first_name }} {{ $inquiry->last_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $inquiry->phone }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $inquiry->created_at->format('Y/m/d H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $inquiry->status === 'new' ? 'bg-blue-100 text-blue-800' : ($inquiry->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : ($inquiry->status === 'done' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800')) }}">
                                                {{ __($inquiry->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2 space-x-reverse">
                                                @php $showRoute = route('admin.inquiries.show', ['type' => $inquiry->form_type, 'id' => $inquiry->id]); @endphp
                                                <button type="button" class="text-blue-600 hover:text-blue-900 show-inquiry-btn" title="مشاهده"
                                                    data-type="{{ $inquiry->form_type }}" data-id="{{ $inquiry->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button type="button" class="text-yellow-600 hover:text-yellow-900 change-status-btn" title="تغییر وضعیت"
                                                    data-type="{{ $inquiry->form_type }}" data-id="{{ $inquiry->id }}">
                                                    <i class="fas fa-exchange-alt"></i>
                                                </button>
                                                <a href="{{ $showRoute }}#logs" class="text-green-600 hover:text-green-900" title="پیگیری"><i class="fas fa-tasks"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">هیچ استعلامی یافت نشد.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $inquiries->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Show/Change Status -->
    <div id="inquiry-modal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative">
            <button id="close-inquiry-modal" class="absolute top-2 left-2 text-gray-500 hover:text-gray-700"><i class="fas fa-times"></i></button>
            <div id="inquiry-modal-content">
                <!-- محتوا به صورت داینامیک بارگذاری می‌شود -->
            </div>
        </div>
    </div>

    <script>
        function showModal(content) {
            document.getElementById('inquiry-modal-content').innerHTML = content;
            document.getElementById('inquiry-modal').classList.remove('hidden');
        }
        document.getElementById('close-inquiry-modal').onclick = function() {
            document.getElementById('inquiry-modal').classList.add('hidden');
        };
        document.querySelectorAll('.show-inquiry-btn').forEach(btn => {
            btn.onclick = function() {
                const id = this.dataset.id;
                const type = this.dataset.type;
                fetch(`/admin/inquiries/${type}/${id}?modal=1`)
                    .then(res => res.text())
                    .then(html => showModal(html));
            };
        });
        document.querySelectorAll('.change-status-btn').forEach(btn => {
            btn.onclick = function() {
                const id = this.dataset.id;
                const type = this.dataset.type;
                fetch(`/admin/inquiries/${type}/${id}?modal=status`)
                    .then(res => res.text())
                    .then(html => showModal(html));
            };
        });
    </script>
</x-admin-layout>
