<div>
    <h2 class="text-lg font-semibold text-gray-900 mb-4">اطلاعات فرم ثبت شده</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
        <div><span class="font-medium">نام و نام خانوادگی:</span> {{ $inquiry->first_name }} {{ $inquiry->last_name }}</div>
        <div><span class="font-medium">شماره تلفن:</span> {{ $inquiry->phone }}</div>
        @foreach($fields as $label => $value)
            <div><span class="font-medium">{{ $label }}:</span> {{ $value }}</div>
        @endforeach
        <div><span class="font-medium">تاریخ ثبت:</span> {{ $inquiry->created_at->format('Y/m/d H:i') }}</div>
        <div>
            <span class="font-medium">وضعیت فعلی:</span>
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $inquiry->status === 'new' ? 'bg-blue-100 text-blue-800' : ($inquiry->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : ($inquiry->status === 'done' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800')) }}">
                {{ __($inquiry->status) }}
            </span>
        </div>
    </div>
</div>
