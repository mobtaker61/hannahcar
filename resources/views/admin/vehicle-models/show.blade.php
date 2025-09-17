<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Vehicle Model Details') }}
            </h2>
            <a href="{{ route('admin.vehicle-models.edit', $vehicleModel) }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-edit ml-2"></i>
                {{ __('Edit') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Header -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <a href="{{ route('admin.vehicle-models.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Model Information') }}</h3>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- نام -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Name') }}</label>
                            <p class="text-lg text-gray-900">{{ $vehicleModel->name }}</p>
                        </div>

                        <!-- برند -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Brand') }}</label>
                            <p class="text-lg text-gray-900">{{ $vehicleModel->brand->name ?? '—' }}</p>
                        </div>

                        <!-- وضعیت -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Status') }}</label>
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium {{ $vehicleModel->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $vehicleModel->is_active ? __('Active') : __('Inactive') }}
                                </span>
                        </div>

                        <!-- ترتیب -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Sort Order') }}</label>
                            <p class="text-lg text-gray-900">{{ $vehicleModel->sort_order }}</p>
                        </div>
                    </div>

                    <!-- توضیحات -->
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Description') }}</label>
                        <p class="text-gray-900">{{ $vehicleModel->description ?: __('No description available.') }}</p>
                    </div>

                    <!-- خودروهای مرتبط -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Related Vehicles') }}</h3>
                        @if($vehicleModel->vehicles && $vehicleModel->vehicles->count() > 0)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-600 mb-3">{{ __('This model has') }} {{ $vehicleModel->vehicles->count() }} {{ __('vehicles') }}:</p>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                    @foreach($vehicleModel->vehicles->take(6) as $vehicle)
                                        <div class="bg-white p-3 rounded border">
                                            <p class="font-medium text-gray-900">{{ $vehicle->full_name ?? $vehicle->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $vehicle->year ?? '—' }}</p>
                                        </div>
                                    @endforeach
                                    @if($vehicleModel->vehicles->count() > 6)
                                        <div class="bg-gray-100 p-3 rounded border text-center text-gray-500">
                                            {{ __('And') }} {{ $vehicleModel->vehicles->count() - 6 }} {{ __('more vehicles...') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <p class="text-gray-500">{{ __('No vehicles associated with this model.') }}</p>
                        @endif
                    </div>

                    <!-- واریانت‌های مرتبط -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Related Variants') }}</h3>
                        @if($vehicleModel->variants && $vehicleModel->variants->count() > 0)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-600 mb-3">{{ __('This model has') }} {{ $vehicleModel->variants->count() }} {{ __('variants') }}:</p>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                    @foreach($vehicleModel->variants->take(6) as $variant)
                                        <div class="bg-white p-3 rounded border">
                                            <p class="font-medium text-gray-900">{{ $variant->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $variant->name_en ?: '—' }}</p>
                                        </div>
                                    @endforeach
                                    @if($vehicleModel->variants->count() > 6)
                                        <div class="bg-gray-100 p-3 rounded border text-center text-gray-500">
                                            {{ __('And') }} {{ $vehicleModel->variants->count() - 6 }} {{ __('more variants...') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <p class="text-gray-500">{{ __('No variants associated with this model.') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
