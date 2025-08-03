<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Vehicle Specifications Management') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Tabs -->
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button onclick="showTab('regional-specs')" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm active" data-tab="regional-specs">
                            {{ __('Regional Specs') }}
                        </button>
                        <button onclick="showTab('body-types')" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-tab="body-types">
                            {{ __('Body Types') }}
                        </button>
                        <button onclick="showTab('seats-counts')" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-tab="seats-counts">
                            {{ __('Seats Counts') }}
                        </button>
                        <button onclick="showTab('fuel-types')" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-tab="fuel-types">
                            {{ __('Fuel Types') }}
                        </button>
                        <button onclick="showTab('transmission-types')" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-tab="transmission-types">
                            {{ __('Transmission Types') }}
                        </button>
                        <button onclick="showTab('engine-capacity-ranges')" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-tab="engine-capacity-ranges">
                            {{ __('Engine Capacity') }}
                        </button>
                        <button onclick="showTab('horsepower-ranges')" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-tab="horsepower-ranges">
                            {{ __('Horsepower') }}
                        </button>
                        <button onclick="showTab('cylinders-counts')" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-tab="cylinders-counts">
                            {{ __('Cylinders') }}
                        </button>
                        <button onclick="showTab('steering-sides')" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-tab="steering-sides">
                            {{ __('Steering Sides') }}
                        </button>
                        <button onclick="showTab('exterior-colors')" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-tab="exterior-colors">
                            {{ __('Exterior Colors') }}
                        </button>
                        <button onclick="showTab('interior-colors')" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-tab="interior-colors">
                            {{ __('Interior Colors') }}
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="p-6">
                    <!-- Regional Specs Tab -->
                    <div id="regional-specs" class="tab-content">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Regional Specifications') }}</h3>
                            <button onclick="openModal('regional-spec-modal')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Add New') }}
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Name') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Description') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Vehicles') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($regionalSpecs as $spec)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $spec->name }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($spec->description, 50) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $spec->vehicles_count }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $spec->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $spec->is_active ? __('Active') : __('Inactive') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button onclick="editRegionalSpec({{ $spec->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">{{ __('Edit') }}</button>
                                                <button onclick="deleteRegionalSpec({{ $spec->id }})" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Body Types Tab -->
                    <div id="body-types" class="tab-content hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Body Types') }}</h3>
                            <button onclick="openModal('body-type-modal')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Add New') }}
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Name') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Description') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Vehicles') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($bodyTypes as $type)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $type->name }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($type->description, 50) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $type->vehicles_count }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $type->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $type->is_active ? __('Active') : __('Inactive') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button onclick="editBodyType({{ $type->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">{{ __('Edit') }}</button>
                                                <button onclick="deleteBodyType({{ $type->id }})" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Seats Counts Tab -->
                    <div id="seats-counts" class="tab-content hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Seats Counts') }}</h3>
                            <button onclick="openModal('seats-count-modal')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Add New') }}
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Count') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Description') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Vehicles') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($seatsCounts as $seats)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $seats->count }} {{ __('Seats') }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($seats->description, 50) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $seats->vehicles_count }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $seats->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $seats->is_active ? __('Active') : __('Inactive') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button onclick="editSeatsCount({{ $seats->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">{{ __('Edit') }}</button>
                                                <button onclick="deleteSeatsCount({{ $seats->id }})" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Fuel Types Tab -->
                    <div id="fuel-types" class="tab-content hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Fuel Types') }}</h3>
                            <button onclick="openModal('fuel-type-modal')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Add New') }}
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Name') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Description') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Vehicles') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($fuelTypes as $fuel)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $fuel->name }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($fuel->description, 50) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $fuel->vehicles_count }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $fuel->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $fuel->is_active ? __('Active') : __('Inactive') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button onclick="editFuelType({{ $fuel->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">{{ __('Edit') }}</button>
                                                <button onclick="deleteFuelType({{ $fuel->id }})" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Transmission Types Tab -->
                    <div id="transmission-types" class="tab-content hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Transmission Types') }}</h3>
                            <button onclick="openModal('transmission-type-modal')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Add New') }}
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Name') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Description') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Vehicles') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($transmissionTypes as $transmission)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $transmission->name }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($transmission->description, 50) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $transmission->vehicles_count }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $transmission->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $transmission->is_active ? __('Active') : __('Inactive') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button onclick="editTransmissionType({{ $transmission->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">{{ __('Edit') }}</button>
                                                <button onclick="deleteTransmissionType({{ $transmission->id }})" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Engine Capacity Ranges Tab -->
                    <div id="engine-capacity-ranges" class="tab-content hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Engine Capacity Ranges') }}</h3>
                            <button onclick="openModal('engine-capacity-range-modal')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Add New') }}
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Range') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Description') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Vehicles') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($engineCapacityRanges as $engine)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $engine->display_name }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($engine->description, 50) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $engine->vehicles_count }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $engine->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $engine->is_active ? __('Active') : __('Inactive') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button onclick="editEngineCapacityRange({{ $engine->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">{{ __('Edit') }}</button>
                                                <button onclick="deleteEngineCapacityRange({{ $engine->id }})" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Horsepower Ranges Tab -->
                    <div id="horsepower-ranges" class="tab-content hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Horsepower Ranges') }}</h3>
                            <button onclick="openModal('horsepower-range-modal')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Add New') }}
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Range') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Description') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Vehicles') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($horsepowerRanges as $hp)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $hp->display_name }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($hp->description, 50) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $hp->vehicles_count }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $hp->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $hp->is_active ? __('Active') : __('Inactive') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button onclick="editHorsepowerRange({{ $hp->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">{{ __('Edit') }}</button>
                                                <button onclick="deleteHorsepowerRange({{ $hp->id }})" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Cylinders Counts Tab -->
                    <div id="cylinders-counts" class="tab-content hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Cylinders Counts') }}</h3>
                            <button onclick="openModal('cylinders-count-modal')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Add New') }}
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Count') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Description') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Vehicles') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($cylindersCounts as $cylinders)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $cylinders->count }} {{ __('Cylinders') }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($cylinders->description, 50) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $cylinders->vehicles_count }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $cylinders->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $cylinders->is_active ? __('Active') : __('Inactive') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button onclick="editCylindersCount({{ $cylinders->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">{{ __('Edit') }}</button>
                                                <button onclick="deleteCylindersCount({{ $cylinders->id }})" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Steering Sides Tab -->
                    <div id="steering-sides" class="tab-content hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Steering Sides') }}</h3>
                            <button onclick="openModal('steering-side-modal')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Add New') }}
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Name') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Description') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Vehicles') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($steeringSides as $steering)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $steering->name }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($steering->description, 50) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $steering->vehicles_count }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $steering->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $steering->is_active ? __('Active') : __('Inactive') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button onclick="editSteeringSide({{ $steering->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">{{ __('Edit') }}</button>
                                                <button onclick="deleteSteeringSide({{ $steering->id }})" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Exterior Colors Tab -->
                    <div id="exterior-colors" class="tab-content hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Exterior Colors') }}</h3>
                            <button onclick="openModal('exterior-color-modal')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Add New') }}
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Name') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Color') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Vehicles') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($exteriorColors as $color)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $color->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($color->hex_code)
                                                    <div class="flex items-center">
                                                        <div class="w-6 h-6 rounded border border-gray-300" style="background-color: {{ $color->hex_code }};"></div>
                                                        <span class="ml-2 text-sm text-gray-500">{{ $color->hex_code }}</span>
                                                    </div>
                                                @else
                                                    <span class="text-sm text-gray-500">{{ __('No color code') }}</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $color->vehicles_count }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $color->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $color->is_active ? __('Active') : __('Inactive') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button onclick="editExteriorColor({{ $color->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">{{ __('Edit') }}</button>
                                                <button onclick="deleteExteriorColor({{ $color->id }})" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Interior Colors Tab -->
                    <div id="interior-colors" class="tab-content hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Interior Colors') }}</h3>
                            <button onclick="openModal('interior-color-modal')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Add New') }}
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Name') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Color') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Vehicles') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($interiorColors as $color)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $color->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($color->hex_code)
                                                    <div class="flex items-center">
                                                        <div class="w-6 h-6 rounded border border-gray-300" style="background-color: {{ $color->hex_code }};"></div>
                                                        <span class="ml-2 text-sm text-gray-500">{{ $color->hex_code }}</span>
                                                    </div>
                                                @else
                                                    <span class="text-sm text-gray-500">{{ __('No color code') }}</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $color->vehicles_count }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $color->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $color->is_active ? __('Active') : __('Inactive') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button onclick="editInteriorColor({{ $color->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">{{ __('Edit') }}</button>
                                                <button onclick="deleteInteriorColor({{ $color->id }})" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->

    <!-- Regional Spec Modal -->
    <div id="regional-spec-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-[9999] hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4" id="regional-spec-modal-title">{{ __('Add Regional Spec') }}</h3>
                <form id="regional-spec-form" class="space-y-4">
                    @csrf
                    <input type="hidden" id="regional-spec-id" name="id">

                    <div>
                        <label for="regional-spec-name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                        <input type="text" id="regional-spec-name" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <div>
                        <label for="regional-spec-description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                        <textarea id="regional-spec-description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                    <div>
                        <label for="regional-spec-sort-order" class="block text-sm font-medium text-gray-700">{{ __('Sort Order') }}</label>
                        <input type="number" id="regional-spec-sort-order" name="sort_order" value="0" min="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="regional-spec-is-active" name="is_active" value="1" checked class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <label for="regional-spec-is-active" class="ml-2 block text-sm text-gray-900">{{ __('Active') }}</label>
                    </div>

                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeModal('regional-spec-modal')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Body Type Modal -->
    <div id="body-type-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-[9999] hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4" id="body-type-modal-title">{{ __('Add Body Type') }}</h3>
                <form id="body-type-form" class="space-y-4">
                    @csrf
                    <input type="hidden" id="body-type-id" name="id">

                    <div>
                        <label for="body-type-name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                        <input type="text" id="body-type-name" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <div>
                        <label for="body-type-description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                        <textarea id="body-type-description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                    <div>
                        <label for="body-type-sort-order" class="block text-sm font-medium text-gray-700">{{ __('Sort Order') }}</label>
                        <input type="number" id="body-type-sort-order" name="sort_order" value="0" min="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="body-type-is-active" name="is_active" value="1" checked class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <label for="body-type-is-active" class="ml-2 block text-sm text-gray-900">{{ __('Active') }}</label>
                    </div>

                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeModal('body-type-modal')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Seats Count Modal -->
    <div id="seats-count-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-[9999] hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4" id="seats-count-modal-title">{{ __('Add Seats Count') }}</h3>
                <form id="seats-count-form" class="space-y-4">
                    @csrf
                    <input type="hidden" id="seats-count-id" name="id">

                    <div>
                        <label for="seats-count-count" class="block text-sm font-medium text-gray-700">{{ __('Count') }}</label>
                        <input type="number" id="seats-count-count" name="count" min="1" max="20" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <div>
                        <label for="seats-count-description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                        <textarea id="seats-count-description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                    <div>
                        <label for="seats-count-sort-order" class="block text-sm font-medium text-gray-700">{{ __('Sort Order') }}</label>
                        <input type="number" id="seats-count-sort-order" name="sort_order" value="0" min="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="seats-count-is-active" name="is_active" value="1" checked class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <label for="seats-count-is-active" class="ml-2 block text-sm text-gray-900">{{ __('Active') }}</label>
                    </div>

                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeModal('seats-count-modal')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Fuel Type Modal -->
    <div id="fuel-type-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-[9999] hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4" id="fuel-type-modal-title">{{ __('Add Fuel Type') }}</h3>
                <form id="fuel-type-form" class="space-y-4">
                    @csrf
                    <input type="hidden" id="fuel-type-id" name="id">

                    <div>
                        <label for="fuel-type-name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                        <input type="text" id="fuel-type-name" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <div>
                        <label for="fuel-type-description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                        <textarea id="fuel-type-description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                    <div>
                        <label for="fuel-type-sort-order" class="block text-sm font-medium text-gray-700">{{ __('Sort Order') }}</label>
                        <input type="number" id="fuel-type-sort-order" name="sort_order" value="0" min="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="fuel-type-is-active" name="is_active" value="1" checked class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <label for="fuel-type-is-active" class="ml-2 block text-sm text-gray-900">{{ __('Active') }}</label>
                    </div>

                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeModal('fuel-type-modal')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Transmission Type Modal -->
    <div id="transmission-type-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-[9999] hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4" id="transmission-type-modal-title">{{ __('Add Transmission Type') }}</h3>
                <form id="transmission-type-form" class="space-y-4">
                    @csrf
                    <input type="hidden" id="transmission-type-id" name="id">

                    <div>
                        <label for="transmission-type-name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                        <input type="text" id="transmission-type-name" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <div>
                        <label for="transmission-type-description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                        <textarea id="transmission-type-description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                    <div>
                        <label for="transmission-type-sort-order" class="block text-sm font-medium text-gray-700">{{ __('Sort Order') }}</label>
                        <input type="number" id="transmission-type-sort-order" name="sort_order" value="0" min="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="transmission-type-is-active" name="is_active" value="1" checked class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <label for="transmission-type-is-active" class="ml-2 block text-sm text-gray-900">{{ __('Active') }}</label>
                    </div>

                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeModal('transmission-type-modal')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Engine Capacity Range Modal -->
    <div id="engine-capacity-range-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-[9999] hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4" id="engine-capacity-range-modal-title">{{ __('Add Engine Capacity Range') }}</h3>
                <form id="engine-capacity-range-form" class="space-y-4">
                    @csrf
                    <input type="hidden" id="engine-capacity-range-id" name="id">

                    <div>
                        <label for="engine-capacity-range-min" class="block text-sm font-medium text-gray-700">{{ __('Min Capacity (cc)') }}</label>
                        <input type="number" id="engine-capacity-range-min" name="min_capacity" min="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <div>
                        <label for="engine-capacity-range-max" class="block text-sm font-medium text-gray-700">{{ __('Max Capacity (cc)') }}</label>
                        <input type="number" id="engine-capacity-range-max" name="max_capacity" min="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <div>
                        <label for="engine-capacity-range-display" class="block text-sm font-medium text-gray-700">{{ __('Display Name') }}</label>
                        <input type="text" id="engine-capacity-range-display" name="display_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <div>
                        <label for="engine-capacity-range-description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                        <textarea id="engine-capacity-range-description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                    <div>
                        <label for="engine-capacity-range-sort-order" class="block text-sm font-medium text-gray-700">{{ __('Sort Order') }}</label>
                        <input type="number" id="engine-capacity-range-sort-order" name="sort_order" value="0" min="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="engine-capacity-range-is-active" name="is_active" value="1" checked class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <label for="engine-capacity-range-is-active" class="ml-2 block text-sm text-gray-900">{{ __('Active') }}</label>
                    </div>

                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeModal('engine-capacity-range-modal')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Horsepower Range Modal -->
    <div id="horsepower-range-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-[9999] hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4" id="horsepower-range-modal-title">{{ __('Add Horsepower Range') }}</h3>
                <form id="horsepower-range-form" class="space-y-4">
                    @csrf
                    <input type="hidden" id="horsepower-range-id" name="id">

                    <div>
                        <label for="horsepower-range-min" class="block text-sm font-medium text-gray-700">{{ __('Min Horsepower') }}</label>
                        <input type="number" id="horsepower-range-min" name="min_horsepower" min="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <div>
                        <label for="horsepower-range-max" class="block text-sm font-medium text-gray-700">{{ __('Max Horsepower') }}</label>
                        <input type="number" id="horsepower-range-max" name="max_horsepower" min="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <div>
                        <label for="horsepower-range-display" class="block text-sm font-medium text-gray-700">{{ __('Display Name') }}</label>
                        <input type="text" id="horsepower-range-display" name="display_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <div>
                        <label for="horsepower-range-description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                        <textarea id="horsepower-range-description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                    <div>
                        <label for="horsepower-range-sort-order" class="block text-sm font-medium text-gray-700">{{ __('Sort Order') }}</label>
                        <input type="number" id="horsepower-range-sort-order" name="sort_order" value="0" min="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="horsepower-range-is-active" name="is_active" value="1" checked class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <label for="horsepower-range-is-active" class="ml-2 block text-sm text-gray-900">{{ __('Active') }}</label>
                    </div>

                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeModal('horsepower-range-modal')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Cylinders Count Modal -->
    <div id="cylinders-count-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-[9999] hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4" id="cylinders-count-modal-title">{{ __('Add Cylinders Count') }}</h3>
                <form id="cylinders-count-form" class="space-y-4">
                    @csrf
                    <input type="hidden" id="cylinders-count-id" name="id">

                    <div>
                        <label for="cylinders-count-count" class="block text-sm font-medium text-gray-700">{{ __('Count') }}</label>
                        <input type="number" id="cylinders-count-count" name="count" min="1" max="16" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <div>
                        <label for="cylinders-count-description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                        <textarea id="cylinders-count-description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                    <div>
                        <label for="cylinders-count-sort-order" class="block text-sm font-medium text-gray-700">{{ __('Sort Order') }}</label>
                        <input type="number" id="cylinders-count-sort-order" name="sort_order" value="0" min="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="cylinders-count-is-active" name="is_active" value="1" checked class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <label for="cylinders-count-is-active" class="ml-2 block text-sm text-gray-900">{{ __('Active') }}</label>
                    </div>

                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeModal('cylinders-count-modal')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Steering Side Modal -->
    <div id="steering-side-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-[9999] hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4" id="steering-side-modal-title">{{ __('Add Steering Side') }}</h3>
                <form id="steering-side-form" class="space-y-4">
                    @csrf
                    <input type="hidden" id="steering-side-id" name="id">

                    <div>
                        <label for="steering-side-name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                        <input type="text" id="steering-side-name" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <div>
                        <label for="steering-side-description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                        <textarea id="steering-side-description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                    <div>
                        <label for="steering-side-sort-order" class="block text-sm font-medium text-gray-700">{{ __('Sort Order') }}</label>
                        <input type="number" id="steering-side-sort-order" name="sort_order" value="0" min="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="steering-side-is-active" name="is_active" value="1" checked class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <label for="steering-side-is-active" class="ml-2 block text-sm text-gray-900">{{ __('Active') }}</label>
                    </div>

                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeModal('steering-side-modal')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Exterior Color Modal -->
    <div id="exterior-color-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-[9999] hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4" id="exterior-color-modal-title">{{ __('Add Exterior Color') }}</h3>
                <form id="exterior-color-form" class="space-y-4">
                    @csrf
                    <input type="hidden" id="exterior-color-id" name="id">

                    <div>
                        <label for="exterior-color-name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                        <input type="text" id="exterior-color-name" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <div>
                        <label for="exterior-color-hex_code" class="block text-sm font-medium text-gray-700">{{ __('Hex Code') }}</label>
                        <input type="color" id="exterior-color-hex_code" name="hex_code" class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label for="exterior-color-description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                        <textarea id="exterior-color-description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                    <div>
                        <label for="exterior-color-sort-order" class="block text-sm font-medium text-gray-700">{{ __('Sort Order') }}</label>
                        <input type="number" id="exterior-color-sort-order" name="sort_order" value="0" min="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="exterior-color-is-active" name="is_active" value="1" checked class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <label for="exterior-color-is-active" class="ml-2 block text-sm text-gray-900">{{ __('Active') }}</label>
                    </div>

                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeModal('exterior-color-modal')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Interior Color Modal -->
    <div id="interior-color-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-[9999] hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4" id="interior-color-modal-title">{{ __('Add Interior Color') }}</h3>
                <form id="interior-color-form" class="space-y-4">
                    @csrf
                    <input type="hidden" id="interior-color-id" name="id">

                    <div>
                        <label for="interior-color-name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                        <input type="text" id="interior-color-name" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <div>
                        <label for="interior-color-hex_code" class="block text-sm font-medium text-gray-700">{{ __('Hex Code') }}</label>
                        <input type="color" id="interior-color-hex_code" name="hex_code" class="mt-1 block w-full h-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label for="interior-color-description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                        <textarea id="interior-color-description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                    <div>
                        <label for="interior-color-sort-order" class="block text-sm font-medium text-gray-700">{{ __('Sort Order') }}</label>
                        <input type="number" id="interior-color-sort-order" name="sort_order" value="0" min="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="interior-color-is-active" name="is_active" value="1" checked class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <label for="interior-color-is-active" class="ml-2 block text-sm text-gray-900">{{ __('Active') }}</label>
                    </div>

                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeModal('interior-color-modal')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Remove active class from all tab buttons
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('border-indigo-500', 'text-indigo-600');
                button.classList.add('border-transparent', 'text-gray-500');
            });

            // Show selected tab content
            const tabContent = document.getElementById(tabName);
            if (tabContent) {
                tabContent.classList.remove('hidden');
            }

            // Add active class to selected tab button
            const activeButton = document.querySelector(`[data-tab="${tabName}"]`);
            if (activeButton) {
                activeButton.classList.remove('border-transparent', 'text-gray-500');
                activeButton.classList.add('border-indigo-500', 'text-indigo-600');
            }
        }

        // Initialize first tab as active
        document.addEventListener('DOMContentLoaded', function() {
            showTab('regional-specs');
        });

        // Modal functions
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('hidden');
                // Prevent body scroll
                document.body.style.overflow = 'hidden';
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
                // Restore body scroll
                document.body.style.overflow = 'auto';
            }
            // Reset form
            const form = document.querySelector(`#${modalId} form`);
            if (form) {
                form.reset();
                const idInput = form.querySelector('input[name="id"]');
                if (idInput) idInput.value = '';
                // Reset title
                const titleElement = document.querySelector(`#${modalId} h3`);
                if (titleElement) {
                    if (modalId.includes('regional-spec')) {
                        titleElement.textContent = '{{ __("Add Regional Spec") }}';
                    } else if (modalId.includes('body-type')) {
                        titleElement.textContent = '{{ __("Add Body Type") }}';
                    } else if (modalId.includes('seats-count')) {
                        titleElement.textContent = '{{ __("Add Seats Count") }}';
                    } else if (modalId.includes('fuel-type')) {
                        titleElement.textContent = '{{ __("Add Fuel Type") }}';
                    } else if (modalId.includes('transmission-type')) {
                        titleElement.textContent = '{{ __("Add Transmission Type") }}';
                    } else if (modalId.includes('engine-capacity-range')) {
                        titleElement.textContent = '{{ __("Add Engine Capacity Range") }}';
                    } else if (modalId.includes('horsepower-range')) {
                        titleElement.textContent = '{{ __("Add Horsepower Range") }}';
                    } else if (modalId.includes('cylinders-count')) {
                        titleElement.textContent = '{{ __("Add Cylinders Count") }}';
                    } else if (modalId.includes('steering-side')) {
                        titleElement.textContent = '{{ __("Add Steering Side") }}';
                    } else if (modalId.includes('exterior-color')) {
                        titleElement.textContent = '{{ __("Add Exterior Color") }}';
                    } else if (modalId.includes('interior-color')) {
                        titleElement.textContent = '{{ __("Add Interior Color") }}';
                    }
                }
            }
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('fixed') && e.target.classList.contains('inset-0') && e.target.classList.contains('bg-gray-900')) {
                const modalId = e.target.id;
                if (modalId) {
                    closeModal(modalId);
                }
            }
        });

        // Regional Spec functions
        function editRegionalSpec(id) {
            // Fetch data and populate form
            fetch(`/admin/vehicle-specifications/regional-specs/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('regional-spec-id').value = data.id;
                    document.getElementById('regional-spec-name').value = data.name;
                    document.getElementById('regional-spec-description').value = data.description || '';
                    document.getElementById('regional-spec-sort-order').value = data.sort_order || 0;
                    document.getElementById('regional-spec-is-active').checked = data.is_active;
                    document.getElementById('regional-spec-modal-title').textContent = '{{ __("Edit Regional Spec") }}';
                    openModal('regional-spec-modal');
                });
        }

        function deleteRegionalSpec(id) {
            if (confirm('{{ __("Are you sure you want to delete this regional spec?") }}')) {
                fetch(`/admin/vehicle-specifications/regional-specs/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                });
            }
        }

        // Body Type functions
        function editBodyType(id) {
            fetch(`/admin/vehicle-specifications/body-types/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('body-type-id').value = data.id;
                    document.getElementById('body-type-name').value = data.name;
                    document.getElementById('body-type-description').value = data.description || '';
                    document.getElementById('body-type-sort-order').value = data.sort_order || 0;
                    document.getElementById('body-type-is-active').checked = data.is_active;
                    document.getElementById('body-type-modal-title').textContent = '{{ __("Edit Body Type") }}';
                    openModal('body-type-modal');
                });
        }

        function deleteBodyType(id) {
            if (confirm('{{ __("Are you sure you want to delete this body type?") }}')) {
                fetch(`/admin/vehicle-specifications/body-types/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                });
            }
        }

        // Form submissions
        document.getElementById('regional-spec-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = formData.get('id');
            const url = id ? `/admin/vehicle-specifications/regional-specs/${id}` : '/admin/vehicle-specifications/regional-specs';
            const method = id ? 'PUT' : 'POST';

            fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message);
                }
            });
        });

        document.getElementById('body-type-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = formData.get('id');
            const url = id ? `/admin/vehicle-specifications/body-types/${id}` : '/admin/vehicle-specifications/body-types';
            const method = id ? 'PUT' : 'POST';

            fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message);
                }
            });
        });

        // Seats Count functions
        function editSeatsCount(id) {
            fetch(`/admin/vehicle-specifications/seats-counts/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('seats-count-id').value = data.id;
                    document.getElementById('seats-count-count').value = data.count;
                    document.getElementById('seats-count-description').value = data.description || '';
                    document.getElementById('seats-count-sort-order').value = data.sort_order || 0;
                    document.getElementById('seats-count-is-active').checked = data.is_active;
                    document.getElementById('seats-count-modal-title').textContent = '{{ __("Edit Seats Count") }}';
                    openModal('seats-count-modal');
                });
        }

        function deleteSeatsCount(id) {
            if (confirm('{{ __("Are you sure you want to delete this seats count?") }}')) {
                fetch(`/admin/vehicle-specifications/seats-counts/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                });
            }
        }

        // Fuel Type functions
        function editFuelType(id) {
            fetch(`/admin/vehicle-specifications/fuel-types/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('fuel-type-id').value = data.id;
                    document.getElementById('fuel-type-name').value = data.name;
                    document.getElementById('fuel-type-description').value = data.description || '';
                    document.getElementById('fuel-type-sort-order').value = data.sort_order || 0;
                    document.getElementById('fuel-type-is-active').checked = data.is_active;
                    document.getElementById('fuel-type-modal-title').textContent = '{{ __("Edit Fuel Type") }}';
                    openModal('fuel-type-modal');
                });
        }

        function deleteFuelType(id) {
            if (confirm('{{ __("Are you sure you want to delete this fuel type?") }}')) {
                fetch(`/admin/vehicle-specifications/fuel-types/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                });
            }
        }

        // Form submissions for new modals
        document.getElementById('seats-count-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = formData.get('id');
            const url = id ? `/admin/vehicle-specifications/seats-counts/${id}` : '/admin/vehicle-specifications/seats-counts';
            const method = id ? 'PUT' : 'POST';

            fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message);
                }
            });
        });

        document.getElementById('fuel-type-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = formData.get('id');
            const url = id ? `/admin/vehicle-specifications/fuel-types/${id}` : '/admin/vehicle-specifications/fuel-types';
            const method = id ? 'PUT' : 'POST';

            fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message);
                }
            });
        });

        // Transmission Type functions
        function editTransmissionType(id) {
            fetch(`/admin/vehicle-specifications/transmission-types/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('transmission-type-id').value = data.id;
                    document.getElementById('transmission-type-name').value = data.name;
                    document.getElementById('transmission-type-description').value = data.description || '';
                    document.getElementById('transmission-type-sort-order').value = data.sort_order || 0;
                    document.getElementById('transmission-type-is-active').checked = data.is_active;
                    document.getElementById('transmission-type-modal-title').textContent = '{{ __("Edit Transmission Type") }}';
                    openModal('transmission-type-modal');
                });
        }

        function deleteTransmissionType(id) {
            if (confirm('{{ __("Are you sure you want to delete this transmission type?") }}')) {
                fetch(`/admin/vehicle-specifications/transmission-types/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                });
            }
        }

        // Engine Capacity Range functions
        function editEngineCapacityRange(id) {
            fetch(`/admin/vehicle-specifications/engine-capacity-ranges/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('engine-capacity-range-id').value = data.id;
                    document.getElementById('engine-capacity-range-min').value = data.min_capacity;
                    document.getElementById('engine-capacity-range-max').value = data.max_capacity;
                    document.getElementById('engine-capacity-range-display').value = data.display_name;
                    document.getElementById('engine-capacity-range-description').value = data.description || '';
                    document.getElementById('engine-capacity-range-sort-order').value = data.sort_order || 0;
                    document.getElementById('engine-capacity-range-is-active').checked = data.is_active;
                    document.getElementById('engine-capacity-range-modal-title').textContent = '{{ __("Edit Engine Capacity Range") }}';
                    openModal('engine-capacity-range-modal');
                });
        }

        function deleteEngineCapacityRange(id) {
            if (confirm('{{ __("Are you sure you want to delete this engine capacity range?") }}')) {
                fetch(`/admin/vehicle-specifications/engine-capacity-ranges/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                });
            }
        }

        // Horsepower Range functions
        function editHorsepowerRange(id) {
            fetch(`/admin/vehicle-specifications/horsepower-ranges/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('horsepower-range-id').value = data.id;
                    document.getElementById('horsepower-range-min').value = data.min_horsepower;
                    document.getElementById('horsepower-range-max').value = data.max_horsepower;
                    document.getElementById('horsepower-range-display').value = data.display_name;
                    document.getElementById('horsepower-range-description').value = data.description || '';
                    document.getElementById('horsepower-range-sort-order').value = data.sort_order || 0;
                    document.getElementById('horsepower-range-is-active').checked = data.is_active;
                    document.getElementById('horsepower-range-modal-title').textContent = '{{ __("Edit Horsepower Range") }}';
                    openModal('horsepower-range-modal');
                });
        }

        function deleteHorsepowerRange(id) {
            if (confirm('{{ __("Are you sure you want to delete this horsepower range?") }}')) {
                fetch(`/admin/vehicle-specifications/horsepower-ranges/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                });
            }
        }

        // Form submissions for new modals
        document.getElementById('transmission-type-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = formData.get('id');
            const url = id ? `/admin/vehicle-specifications/transmission-types/${id}` : '/admin/vehicle-specifications/transmission-types';
            const method = id ? 'PUT' : 'POST';

            fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message);
                }
            });
        });

        document.getElementById('engine-capacity-range-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = formData.get('id');
            const url = id ? `/admin/vehicle-specifications/engine-capacity-ranges/${id}` : '/admin/vehicle-specifications/engine-capacity-ranges';
            const method = id ? 'PUT' : 'POST';

            fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message);
                }
            });
        });

        document.getElementById('horsepower-range-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = formData.get('id');
            const url = id ? `/admin/vehicle-specifications/horsepower-ranges/${id}` : '/admin/vehicle-specifications/horsepower-ranges';
            const method = id ? 'PUT' : 'POST';

            fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message);
                }
            });
        });

        // Cylinders Count functions
        function editCylindersCount(id) {
            fetch(`/admin/vehicle-specifications/cylinders-counts/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('cylinders-count-id').value = data.id;
                    document.getElementById('cylinders-count-count').value = data.count;
                    document.getElementById('cylinders-count-description').value = data.description || '';
                    document.getElementById('cylinders-count-sort-order').value = data.sort_order || 0;
                    document.getElementById('cylinders-count-is-active').checked = data.is_active;
                    document.getElementById('cylinders-count-modal-title').textContent = '{{ __("Edit Cylinders Count") }}';
                    openModal('cylinders-count-modal');
                });
        }

        function deleteCylindersCount(id) {
            if (confirm('{{ __("Are you sure you want to delete this cylinders count?") }}')) {
                fetch(`/admin/vehicle-specifications/cylinders-counts/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                });
            }
        }

        // Steering Side functions
        function editSteeringSide(id) {
            fetch(`/admin/vehicle-specifications/steering-sides/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('steering-side-id').value = data.id;
                    document.getElementById('steering-side-name').value = data.name;
                    document.getElementById('steering-side-description').value = data.description || '';
                    document.getElementById('steering-side-sort-order').value = data.sort_order || 0;
                    document.getElementById('steering-side-is-active').checked = data.is_active;
                    document.getElementById('steering-side-modal-title').textContent = '{{ __("Edit Steering Side") }}';
                    openModal('steering-side-modal');
                });
        }

        function deleteSteeringSide(id) {
            if (confirm('{{ __("Are you sure you want to delete this steering side?") }}')) {
                fetch(`/admin/vehicle-specifications/steering-sides/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                });
            }
        }

        // Exterior Color functions
        function editExteriorColor(id) {
            fetch(`/admin/vehicle-specifications/exterior-colors/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('exterior-color-id').value = data.id;
                    document.getElementById('exterior-color-name').value = data.name;
                    document.getElementById('exterior-color-hex_code').value = data.hex_code || '#000000';
                    document.getElementById('exterior-color-description').value = data.description || '';
                    document.getElementById('exterior-color-sort-order').value = data.sort_order || 0;
                    document.getElementById('exterior-color-is-active').checked = data.is_active;
                    document.getElementById('exterior-color-modal-title').textContent = '{{ __("Edit Exterior Color") }}';
                    openModal('exterior-color-modal');
                });
        }

        function deleteExteriorColor(id) {
            if (confirm('{{ __("Are you sure you want to delete this exterior color?") }}')) {
                fetch(`/admin/vehicle-specifications/exterior-colors/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                });
            }
        }

        // Interior Color functions
        function editInteriorColor(id) {
            fetch(`/admin/vehicle-specifications/interior-colors/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('interior-color-id').value = data.id;
                    document.getElementById('interior-color-name').value = data.name;
                    document.getElementById('interior-color-hex_code').value = data.hex_code || '#000000';
                    document.getElementById('interior-color-description').value = data.description || '';
                    document.getElementById('interior-color-sort-order').value = data.sort_order || 0;
                    document.getElementById('interior-color-is-active').checked = data.is_active;
                    document.getElementById('interior-color-modal-title').textContent = '{{ __("Edit Interior Color") }}';
                    openModal('interior-color-modal');
                });
        }

        function deleteInteriorColor(id) {
            if (confirm('{{ __("Are you sure you want to delete this interior color?") }}')) {
                fetch(`/admin/vehicle-specifications/interior-colors/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                });
            }
        }

        // Form submissions for new modals
        document.getElementById('cylinders-count-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = formData.get('id');
            const url = id ? `/admin/vehicle-specifications/cylinders-counts/${id}` : '/admin/vehicle-specifications/cylinders-counts';
            const method = id ? 'PUT' : 'POST';

            fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message);
                }
            });
        });

        document.getElementById('steering-side-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = formData.get('id');
            const url = id ? `/admin/vehicle-specifications/steering-sides/${id}` : '/admin/vehicle-specifications/steering-sides';
            const method = id ? 'PUT' : 'POST';

            fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message);
                }
            });
        });

        document.getElementById('exterior-color-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = formData.get('id');
            const url = id ? `/admin/vehicle-specifications/exterior-colors/${id}` : '/admin/vehicle-specifications/exterior-colors';
            const method = id ? 'PUT' : 'POST';

            fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message);
                }
            });
        });

        document.getElementById('interior-color-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = formData.get('id');
            const url = id ? `/admin/vehicle-specifications/interior-colors/${id}` : '/admin/vehicle-specifications/interior-colors';
            const method = id ? 'PUT' : 'POST';

            fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message);
                }
            });
        });
    </script>
</x-admin-layout>
