<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $vehicleBrand->name }}
                </h2>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.vehicle-brands.edit', $vehicleBrand) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Edit') }}
                    </a>
                    <a href="{{ route('admin.vehicle-brands.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Back to List') }}
                    </a>
                </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <!-- Brand Logo -->
                    <div class="mb-6">
                        @if($vehicleBrand->logo)
                            <img src="{{ Storage::url($vehicleBrand->logo) }}" alt="{{ $vehicleBrand->name }}"
                                 class="w-32 h-32 object-contain rounded-lg">
                        @else
                            <div class="w-32 h-32 bg-gray-200 rounded-lg flex items-center justify-center">
                                <svg class="h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Basic Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Basic Information') }}</h3>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Brand Name') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $vehicleBrand->name }}</dd>
                                </div>
                                @if($vehicleBrand->website)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Website') }}</dt>
                                    <dd class="text-sm text-gray-900">
                                        <a href="{{ $vehicleBrand->website }}" target="_blank" class="text-blue-600 hover:text-blue-900">
                                            {{ $vehicleBrand->website }}
                                        </a>
                                    </dd>
                                </div>
                                @endif
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Status') }}</dt>
                                    <dd class="text-sm text-gray-900">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            {{ $vehicleBrand->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $vehicleBrand->is_active ? __('Active') : __('Inactive') }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Sort Order') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $vehicleBrand->sort_order }}</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Statistics -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Statistics') }}</h3>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Total Models') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $vehicleBrand->models->count() }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Total Vehicles') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $vehicleBrand->vehicles->count() }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Description -->
                    @if($vehicleBrand->description)
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Description') }}</h3>
                        <p class="text-sm text-gray-900">{{ $vehicleBrand->description }}</p>
                    </div>
                    @endif

                    <!-- Models -->
                    @if($vehicleBrand->models && $vehicleBrand->models->count() > 0)
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Models') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach($vehicleBrand->models as $model)
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="font-medium text-gray-900">{{ $model->name }}</h4>
                                    @if($model->description)
                                        <p class="text-sm text-gray-600 mt-1">{{ $model->description }}</p>
                                    @endif
                                    <div class="mt-2">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            {{ $model->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $model->is_active ? __('Active') : __('Inactive') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Recent Vehicles -->
                    @if($vehicleBrand->vehicles && $vehicleBrand->vehicles->count() > 0)
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Recent Vehicles') }}</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Vehicle') }}
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Model') }}
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Year') }}
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Price') }}
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Status') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($vehicleBrand->vehicles as $vehicle)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ route('admin.vehicles.show', $vehicle) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    {{ $vehicle->full_name }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $vehicle->model->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $vehicle->year }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $vehicle->formatted_price }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                    {{ $vehicle->status == 'new' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                                    {{ $vehicle->status == 'new' ? __('New') : __('Used') }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    <!-- Additional Information -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Additional Information') }}</h3>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">{{ __('Created At') }}</dt>
                                <dd class="text-sm text-gray-900">{{ $vehicleBrand->created_at->format('M d, Y H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">{{ __('Updated At') }}</dt>
                                <dd class="text-sm text-gray-900">{{ $vehicleBrand->updated_at->format('M d, Y H:i') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
