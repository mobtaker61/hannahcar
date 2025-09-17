<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                نمایش واریانت خودرو
            </h2>
            <a href="{{ route('admin.vehicle-variants.edit', $vehicleVariant) }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-edit ml-2"></i>
                ویرایش
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Header -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <a href="{{ route('admin.vehicle-variants.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <h3 class="text-lg font-medium text-gray-900">اطلاعات واریانت خودرو</h3>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- نام -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">نام</label>
                            <p class="text-lg text-gray-900">{{ $vehicleVariant->name }}</p>
                        </div>

                        <!-- نام انگلیسی -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">نام انگلیسی</label>
                            <p class="text-lg text-gray-900">{{ $vehicleVariant->name_en ?: '—' }}</p>
                        </div>

                        <!-- مدل -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">مدل</label>
                            <p class="text-lg text-gray-900">
                                @if($vehicleVariant->model)
                                    {{ $vehicleVariant->model->brand->name }} - {{ $vehicleVariant->model->name }}
                                @else
                                    —
                                @endif
                            </p>
                        </div>

                        <!-- آیکون -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">آیکون</label>
                            <div class="text-lg text-gray-900">
                                @if($vehicleVariant->icon)
                                    <i class="{{ $vehicleVariant->icon }} text-2xl text-gray-600"></i>
                                    <span class="mr-2">{{ $vehicleVariant->icon }}</span>
                                @else
                                    —
                                @endif
                            </div>
                        </div>

                        <!-- وضعیت -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">وضعیت</label>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium {{ $vehicleVariant->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $vehicleVariant->is_active ? 'فعال' : 'غیرفعال' }}
                            </span>
                        </div>

                        <!-- ترتیب -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">ترتیب</label>
                            <p class="text-lg text-gray-900">{{ $vehicleVariant->sort_order }}</p>
                        </div>
                    </div>

                    <!-- توضیحات -->
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">توضیحات</label>
                        <p class="text-gray-900">{{ $vehicleVariant->description ?: 'توضیحی ثبت نشده است.' }}</p>
                    </div>

                    <!-- توضیحات انگلیسی -->
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">توضیحات انگلیسی</label>
                        <p class="text-gray-900">{{ $vehicleVariant->description_en ?: 'توضیح انگلیسی ثبت نشده است.' }}</p>
                    </div>

                    <!-- خودروهای مرتبط -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">خودروهای مرتبط</h3>
                        @if($vehicleVariant->vehicles->count() > 0)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-600 mb-3">این واریانت در {{ $vehicleVariant->vehicles->count() }} خودرو استفاده شده است:</p>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                    @foreach($vehicleVariant->vehicles->take(6) as $vehicle)
                                        <div class="bg-white p-3 rounded border">
                                            <p class="font-medium text-gray-900">{{ $vehicle->full_name }}</p>
                                            <p class="text-sm text-gray-500">{{ $vehicle->year }}</p>
                                        </div>
                                    @endforeach
                                    @if($vehicleVariant->vehicles->count() > 6)
                                        <div class="bg-gray-100 p-3 rounded border text-center text-gray-500">
                                            و {{ $vehicleVariant->vehicles->count() - 6 }} خودرو دیگر...
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <p class="text-gray-500">هیچ خودرویی با این واریانت مرتبط نیست.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
