<div>
    <h2 class="text-lg font-semibold text-gray-900 mb-4">تغییر وضعیت فرم</h2>
    <form action="{{ route('admin.inquiries.logs.store', ['type' => $type, 'id' => $inquiry->id]) }}" method="POST" class="flex flex-col md:flex-row gap-4 items-end">
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
        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">ثبت تغییر وضعیت</button>
    </form>
</div>
