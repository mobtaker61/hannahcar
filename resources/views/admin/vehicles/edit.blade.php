<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Vehicle') }} - {{ $vehicle->full_name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.vehicles.show', $vehicle) }}"
                    class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('View') }}
                </a>
                <a href="{{ route('admin.vehicles.index') }}"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Back to List') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('admin.vehicles.update', $vehicle) }}" method="POST"
                    enctype="multipart/form-data" class="p-6">
                    @csrf
                    @method('PUT')
                    <!-- Vehicle Summary -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                @if ($vehicle->featured_image)
                                    <img src="{{ Storage::url($vehicle->featured_image) }}"
                                        alt="{{ $vehicle->full_name }}" class="w-16 h-16 object-cover rounded-lg">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900">{{ $vehicle->full_name }}</h4>
                                    <p class="text-sm text-gray-600">
                                        {{ __('ID') }}: {{ $vehicle->id }} |
                                        {{ __('Status') }}: <span
                                            class="px-2 py-1 text-xs rounded-full {{ $vehicle->publish_status === 'published' ? 'bg-green-100 text-green-800' : ($vehicle->publish_status === 'draft' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ __(ucfirst($vehicle->publish_status)) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-indigo-600">{{ number_format($vehicle->price) }}
                                    {{ $vehicle->currency }}</p>
                                <p class="text-sm text-gray-500">{{ __('Last updated') }}:
                                    {{ $vehicle->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        <!-- Vehicle Statistics -->
                        <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4 pt-4 border-t border-gray-200">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-indigo-600">
                                    {{ $vehicle->gallery ? $vehicle->gallery->count() : 0 }}
                                </div>
                                <div class="text-sm text-gray-500">{{ __('Images') }}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-600">
                                    {{ $vehicle->year }}
                                </div>
                                <div class="text-sm text-gray-500">{{ __('Year') }}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-purple-600">
                                    {{ $vehicle->mileage ? number_format($vehicle->mileage) : 'N/A' }}
                                </div>
                                <div class="text-sm text-gray-500">{{ __('Mileage (km)') }}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-orange-600">
                                    {{ $vehicle->is_featured ? 'Yes' : 'No' }}
                                </div>
                                <div class="text-sm text-gray-500">{{ __('Featured') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-6">
                        <!-- Main Content - Vehicle Information -->
                        <div class="flex-1 space-y-6">
                            <!-- Basic Information Section -->
                            <div class="bg-white rounded-lg border border-gray-200 p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ __('Basic Information') }}
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                    <div>
                                        <x-input-label for="brand_id" value="{{ __('Brand') }}" />
                                        <select id="brand_id" name="brand_id" required
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-brand-ajax">
                                            <option value="">{{ __('Search and select brand...') }}</option>
                                            @if ($vehicle->brand)
                                                <option value="{{ $vehicle->brand->id }}" selected>
                                                    {{ $vehicle->brand->name }}</option>
                                            @endif
                                        </select>
                                        <x-input-error :messages="$errors->get('brand_id')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="model_id" value="{{ __('Model') }}" />
                                        <select id="model_id" name="model_id" required
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-model-ajax">
                                            <option value="">{{ __('Select brand first...') }}</option>
                                            @if ($vehicle->model)
                                                <option value="{{ $vehicle->model->id }}" selected>
                                                    {{ $vehicle->model->name }}</option>
                                            @endif
                                        </select>
                                        <x-input-error :messages="$errors->get('model_id')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="year" value="{{ __('Year') }}" />
                                        <x-text-input id="year" name="year" type="number"
                                            class="mt-1 block w-full" value="{{ old('year', $vehicle->year) }}"
                                            min="1900" max="{{ date('Y') + 1 }}" required />
                                        <x-input-error :messages="$errors->get('year')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="mileage" value="{{ __('Mileage (km)') }}" />
                                        <x-text-input id="mileage" name="mileage" type="number"
                                            class="mt-1 block w-full" value="{{ old('mileage', $vehicle->mileage) }}"
                                            min="0" />
                                        <x-input-error :messages="$errors->get('mileage')" class="mt-2" />
                                    </div>

                                    <!-- Price and Currency Input Group -->
                                    <div class="md:col-span-2">
                                        <x-input-label for="price" value="{{ __('Price') }}" />
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <div class="relative flex items-stretch flex-grow focus-within:z-10">
                                                <x-text-input id="price" name="price" type="number"
                                                    step="0.01"
                                                    class="rounded-r-none focus:ring-indigo-500 focus:border-indigo-500"
                                                    value="{{ old('price', $vehicle->price) }}" min="0"
                                                    required placeholder="0.00" />
                                            </div>
                                            <select id="currency" name="currency"
                                                class="relative -ml-px inline-flex items-center space-x-2 px-4 py-2 border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm font-medium rounded-r-md hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                                <option value="AED"
                                                    {{ old('currency', $vehicle->currency) == 'AED' ? 'selected' : '' }}>
                                                    AED</option>
                                                <option value="USD"
                                                    {{ old('currency', $vehicle->currency) == 'USD' ? 'selected' : '' }}>
                                                    USD</option>
                                                <option value="EUR"
                                                    {{ old('currency', $vehicle->currency) == 'EUR' ? 'selected' : '' }}>
                                                    EUR</option>
                                                <option value="IRR"
                                                    {{ old('currency', $vehicle->currency) == 'IRR' ? 'selected' : '' }}>
                                                    IRR</option>
                                            </select>
                                        </div>
                                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                        <x-input-error :messages="$errors->get('currency')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <!-- Sidebar -->
                            <div class="lg:w-80">
                                <div class="bg-white rounded-lg border border-gray-200 p-6 sticky top-6">
                                    <!-- Status & Publishing -->
                                    <div class="mb-6">
                                        <h4 class="text-lg font-medium text-gray-900 mb-4">
                                            {{ __('Status & Publishing') }}</h4>

                                        <div class="space-y-4">
                                            <div>
                                                <x-input-label for="status" value="{{ __('Vehicle Status') }}" />
                                                <select id="status" name="status"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                                    <option value="new"
                                                        {{ old('status', $vehicle->status) == 'new' ? 'selected' : '' }}>
                                                        {{ __('New') }}</option>
                                                    <option value="used"
                                                        {{ old('status', $vehicle->status) == 'used' ? 'selected' : '' }}>
                                                        {{ __('Used') }}</option>
                                                    <option value="export"
                                                        {{ old('status', $vehicle->status) == 'export' ? 'selected' : '' }}>
                                                        {{ __('Export') }}</option>
                                                </select>
                                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                            </div>

                                            <div>
                                                <x-input-label for="publish_status"
                                                    value="{{ __('Publish Status') }}" />
                                                <select id="publish_status" name="publish_status"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                                    <option value="draft"
                                                        {{ old('publish_status', $vehicle->publish_status) == 'draft' ? 'selected' : '' }}>
                                                        {{ __('Draft') }}</option>
                                                    <option value="published"
                                                        {{ old('publish_status', $vehicle->publish_status) == 'published' ? 'selected' : '' }}>
                                                        {{ __('Published') }}</option>
                                                    <option value="archived"
                                                        {{ old('publish_status', $vehicle->publish_status) == 'archived' ? 'selected' : '' }}>
                                                        {{ __('Archived') }}</option>
                                                </select>
                                                <x-input-error :messages="$errors->get('publish_status')" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Quick Actions -->
                                    <div class="mb-6">
                                        <h4 class="text-lg font-medium text-gray-900 mb-4">{{ __('Quick Actions') }}
                                        </h4>

                                        <div class="space-y-3">
                                            <button type="button" onclick="saveAsDraft()"
                                                class="w-full bg-gray-500 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                                                {{ __('Save as Draft') }}
                                            </button>

                                            <button type="button" onclick="previewVehicle()"
                                                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                                                {{ __('Preview Vehicle') }}
                                            </button>

                                            <a href="{{ route('admin.vehicles.show', $vehicle) }}"
                                                class="block w-full bg-indigo-500 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md text-center transition duration-200">
                                                {{ __('View Vehicle') }}
                                            </a>

                                            <a href="{{ route('admin.vehicles.index') }}"
                                                class="block w-full bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium py-2 px-4 rounded-md text-center transition duration-200">
                                                {{ __('Back to List') }}
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Vehicle Flags -->
                                    <div class="mb-6">
                                        <h4 class="text-lg font-medium text-gray-900 mb-4">{{ __('Vehicle Flags') }}
                                        </h4>

                                        <div class="space-y-3">
                                            <div class="flex items-center">
                                                <input id="is_featured" name="is_featured" type="checkbox"
                                                    value="1"
                                                    {{ old('is_featured', $vehicle->is_featured) ? 'checked' : '' }}
                                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                                <x-input-label for="is_featured" value="{{ __('Featured Vehicle') }}"
                                                    class="ml-2" />
                                            </div>

                                            <div class="flex items-center">
                                                <input id="is_available" name="is_available" type="checkbox"
                                                    value="1"
                                                    {{ old('is_available', $vehicle->is_available) ? 'checked' : '' }}
                                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                                <x-input-label for="is_available" value="{{ __('Available') }}"
                                                    class="ml-2" />
                                            </div>

                                            <div class="flex items-center">
                                                <input id="is_negotiable" name="is_negotiable" type="checkbox"
                                                    value="1"
                                                    {{ old('is_negotiable', $vehicle->is_negotiable) ? 'checked' : '' }}
                                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                                <x-input-label for="is_available"
                                                    value="{{ __('Price Negotiable') }}" class="ml-2" />
                                            </div>

                                            <div class="flex items-center">
                                                <input id="is_imported" name="is_imported" type="checkbox"
                                                    value="1"
                                                    {{ old('is_imported', $vehicle->is_imported) ? 'checked' : '' }}
                                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                                <x-input-label for="is_imported" value="{{ __('Imported Vehicle') }}"
                                                    class="ml-2" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Priority & Meta -->
                                    <div>
                                        <h4 class="text-lg font-medium text-gray-900 mb-4">{{ __('Priority & Meta') }}
                                        </h4>

                                        <div class="space-y-4">
                                            <div>
                                                <x-input-label for="priority_order"
                                                    value="{{ __('Priority Order') }}" />
                                                <x-text-input id="priority_order" name="priority_order"
                                                    type="number" class="mt-1 block w-full"
                                                    value="{{ old('priority_order', $vehicle->priority_order ?? 0) }}"
                                                    min="0" max="999" />
                                                <small
                                                    class="text-gray-500">{{ __('Higher number = higher priority') }}</small>
                                                <x-input-error :messages="$errors->get('priority_order')" class="mt-2" />
                                            </div>

                                            <div>
                                                <x-input-label for="meta_title" value="{{ __('Meta Title') }}" />
                                                <x-text-input id="meta_title" name="meta_title" type="text"
                                                    class="mt-1 block w-full"
                                                    value="{{ old('meta_title', $vehicle->meta_title) }}"
                                                    maxlength="60" />
                                                <small class="text-gray-500">{{ __('Max 60 characters') }}</small>
                                                <x-input-error :messages="$errors->get('meta_title')" class="mt-2" />
                                            </div>

                                            <div>
                                                <x-input-label for="meta_description"
                                                    value="{{ __('Meta Description') }}" />
                                                <textarea id="meta_description" name="meta_description" rows="3"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('meta_description', $vehicle->meta_description) }}</textarea>
                                                <small class="text-gray-500">{{ __('Max 160 characters') }}</small>
                                                <x-input-error :messages="$errors->get('meta_description')" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Specifications -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Specifications') }}</h3>
                            </div>

                            <div>
                                <x-input-label for="regional_spec_id" value="{{ __('Regional Spec') }}" />
                                <select id="regional_spec_id" name="regional_spec_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-spec">
                                    <option value="">{{ __('Select Regional Spec') }}</option>
                                    @foreach ($regionalSpecs as $spec)
                                        <option value="{{ $spec->id }}"
                                            {{ old('regional_spec_id', $vehicle->regional_spec_id) == $spec->id ? 'selected' : '' }}>
                                            {{ $spec->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('regional_spec_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="body_type_id" value="{{ __('Body Type') }}" />
                                <select id="body_type_id" name="body_type_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-body">
                                    <option value="">{{ __('Select Body Type') }}</option>
                                    @foreach ($bodyTypes as $type)
                                        <option value="{{ $type->id }}"
                                            {{ old('body_type_id', $vehicle->body_type_id) == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('body_type_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="seats_count_id" value="{{ __('Seats Count') }}" />
                                <select id="seats_count_id" name="seats_count_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-seats">
                                    <option value="">{{ __('Select Seats Count') }}</option>
                                    @foreach ($seatsCounts as $seats)
                                        <option value="{{ $seats->id }}"
                                            {{ old('seats_count_id', $vehicle->seats_count_id) == $seats->id ? 'selected' : '' }}>
                                            {{ $seats->count }} {{ __('Seats') }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('seats_count_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="fuel_type_id" value="{{ __('Fuel Type') }}" />
                                <select id="fuel_type_id" name="fuel_type_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-fuel">
                                    <option value="">{{ __('Select Fuel Type') }}</option>
                                    @foreach ($fuelTypes as $fuel)
                                        <option value="{{ $fuel->id }}"
                                            {{ old('fuel_type_id', $vehicle->fuel_type_id) == $fuel->id ? 'selected' : '' }}>
                                            {{ $fuel->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('fuel_type_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="transmission_type_id" value="{{ __('Transmission Type') }}" />
                                <select id="transmission_type_id" name="transmission_type_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-transmission">
                                    <option value="">{{ __('Select Transmission Type') }}</option>
                                    @foreach ($transmissionTypes as $transmission)
                                        <option value="{{ $transmission->id }}"
                                            {{ old('transmission_type_id', $vehicle->transmission_type_id) == $transmission->id ? 'selected' : '' }}>
                                            {{ $transmission->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('transmission_type_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="engine_capacity_range_id" value="{{ __('Engine Capacity') }}" />
                                <select id="engine_capacity_range_id" name="engine_capacity_range_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-engine">
                                    <option value="">{{ __('Select Engine Capacity') }}</option>
                                    @foreach ($engineCapacityRanges as $engine)
                                        <option value="{{ $engine->id }}"
                                            {{ old('engine_capacity_range_id', $vehicle->engine_capacity_range_id) == $engine->id ? 'selected' : '' }}>
                                            {{ $engine->display_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('engine_capacity_range_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="horsepower_range_id" value="{{ __('Horsepower') }}" />
                                <select id="horsepower_range_id" name="horsepower_range_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-horsepower">
                                    <option value="">{{ __('Select Horsepower Range') }}</option>
                                    @foreach ($horsepowerRanges as $hp)
                                        <option value="{{ $hp->id }}"
                                            {{ old('horsepower_range_id', $vehicle->horsepower_range_id) == $hp->id ? 'selected' : '' }}>
                                            {{ $hp->display_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('horsepower_range_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="cylinders_count_id" value="{{ __('Cylinders Count') }}" />
                                <select id="cylinders_count_id" name="cylinders_count_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-cylinders">
                                    <option value="">{{ __('Select Cylinders Count') }}</option>
                                    @foreach ($cylindersCounts as $cylinders)
                                        <option value="{{ $cylinders->id }}"
                                            {{ old('cylinders_count_id', $vehicle->cylinders_count_id) == $cylinders->id ? 'selected' : '' }}>
                                            {{ $cylinders->count }} {{ __('Cylinders') }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('cylinders_count_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="steering_side_id" value="{{ __('Steering Side') }}" />
                                <select id="steering_side_id" name="steering_side_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-steering">
                                    <option value="">{{ __('Select Steering Side') }}</option>
                                    @foreach ($steeringSides as $steering)
                                        <option value="{{ $steering->id }}"
                                            {{ old('steering_side_id', $vehicle->steering_side_id) == $steering->id ? 'selected' : '' }}>
                                            {{ $steering->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('steering_side_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="exterior_color_id" value="{{ __('Exterior Color') }}" />
                                <select id="exterior_color_id" name="exterior_color_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-color">
                                    <option value="">{{ __('Select Exterior Color') }}</option>
                                    @foreach ($exteriorColors as $color)
                                        <option value="{{ $color->id }}"
                                            {{ old('exterior_color_id', $vehicle->exterior_color_id) == $color->id ? 'selected' : '' }}>
                                            {{ $color->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('exterior_color_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="interior_color_id" value="{{ __('Interior Color') }}" />
                                <select id="interior_color_id" name="interior_color_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-color">
                                    <option value="">{{ __('Select Interior Color') }}</option>
                                    @foreach ($interiorColors as $color)
                                        <option value="{{ $color->id }}"
                                            {{ old('interior_color_id', $vehicle->interior_color_id) == $color->id ? 'selected' : '' }}>
                                            {{ $color->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('interior_color_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="vin_number" value="{{ __('VIN Number') }}" />
                                <x-text-input id="vin_number" name="vin_number" type="text"
                                    class="mt-1 block w-full" value="{{ old('vin_number', $vehicle->vin_number) }}"
                                    maxlength="17" />
                                <x-input-error :messages="$errors->get('vin_number')" class="mt-2" />
                            </div>

                            <!-- Images -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Images') }}</h3>
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="featured_image" value="{{ __('Featured Image') }}" />
                                @if ($vehicle->featured_image)
                                    <div class="mt-2 mb-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
                                        <div class="flex items-center space-x-4">
                                            <img src="{{ Storage::url($vehicle->featured_image) }}"
                                                alt="Current featured image"
                                                class="w-32 h-32 object-cover rounded-lg shadow-sm">
                                            <div class="flex-1">
                                                <p class="text-sm text-gray-600">{{ __('Current featured image') }}
                                                </p>
                                                <div class="mt-2 flex space-x-2">
                                                    <button type="button" onclick="removeFeaturedImage()"
                                                        class="bg-red-500 hover:bg-red-700 text-white text-xs px-3 py-1 rounded">
                                                        {{ __('Remove') }}
                                                    </button>
                                                    <a href="{{ Storage::url($vehicle->featured_image) }}"
                                                        target="_blank"
                                                        class="bg-blue-500 hover:bg-blue-700 text-white text-xs px-3 py-1 rounded">
                                                        {{ __('View Full Size') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="remove_featured_image" id="remove_featured_image"
                                            value="0">
                                    </div>
                                @endif
                                <div class="mt-2">
                                    <input id="featured_image" name="featured_image" type="file" accept="image/*"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ __('Recommended size: 800x600 pixels, Max: 2MB') }}</p>
                                </div>
                                <x-input-error :messages="$errors->get('featured_image')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="gallery_images" value="{{ __('Gallery Images') }}" />
                                @if ($vehicle->gallery && $vehicle->gallery->count() > 0)
                                    <div class="mt-2 mb-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
                                        <h4 class="text-sm font-medium text-gray-700 mb-3">
                                            {{ __('Current Gallery Images') }}</h4>
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                            @foreach ($vehicle->gallery as $index => $image)
                                                <div class="relative group">
                                                    <img src="{{ Storage::url($image->image_path) }}"
                                                        alt="Gallery image {{ $index + 1 }}"
                                                        class="w-full h-24 object-cover rounded-lg shadow-sm">
                                                    <div
                                                        class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-200 rounded-lg flex items-center justify-center">
                                                        <div class="flex space-x-2">
                                                            <button type="button"
                                                                onclick="removeGalleryImage({{ $index }})"
                                                                class="bg-red-500 hover:bg-red-700 text-white text-xs px-2 py-1 rounded">
                                                                {{ __('Remove') }}
                                                            </button>
                                                            <a href="{{ Storage::url($image->image_path) }}"
                                                                target="_blank"
                                                                class="bg-blue-500 hover:bg-blue-700 text-white text-xs px-2 py-1 rounded">
                                                                {{ __('View') }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="remove_gallery_images[]"
                                                        value="{{ $image->id }}"
                                                        id="remove_gallery_{{ $index }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div class="mt-2">
                                    <input id="gallery_images" name="gallery_images[]" type="file"
                                        accept="image/*" multiple
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ __('You can select multiple images. Recommended size: 800x600 pixels, Max: 2MB per image') }}
                                    </p>
                                </div>
                                <x-input-error :messages="$errors->get('gallery_images.*')" class="mt-2" />
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2">
                                <x-input-label for="description" value="{{ __('Description') }}" />
                                <textarea id="description" name="description" rows="4"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $vehicle->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <!-- Features -->
                            <div class="md:col-span-2">
                                <x-input-label for="features" value="{{ __('Features (comma separated)') }}" />
                                <div class="mt-1">
                                    <textarea id="features" name="features" rows="4"
                                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                        placeholder="Feature 1, Feature 2, Feature 3">{{ old('features', $vehicle->features_text) }}</textarea>
                                    <div class="mt-2 flex flex-wrap gap-2" id="features-tags">
                                        <!-- Feature tags will be displayed here -->
                                    </div>
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ __('Type features separated by commas, or press Enter to add individual features') }}
                                    </p>
                                </div>
                                <x-input-error :messages="$errors->get('features')" class="mt-2" />
                            </div>

                            <!-- Common Features Quick Add -->
                            <div class="md:col-span-2">
                                <x-input-label value="{{ __('Quick Add Common Features') }}" />
                                <div class="mt-2 flex flex-wrap gap-2">
                                    @php
                                        $commonFeatures = [
                                            'Air Conditioning',
                                            'Power Steering',
                                            'Power Windows',
                                            'Central Locking',
                                            'ABS',
                                            'Airbags',
                                            'Bluetooth',
                                            'Navigation System',
                                            'Leather Seats',
                                            'Sunroof',
                                            'Alloy Wheels',
                                            'Fog Lights',
                                            'Rear Camera',
                                            'Cruise Control',
                                        ];
                                    @endphp
                                    @foreach ($commonFeatures as $feature)
                                        <button type="button" onclick="addFeature('{{ $feature }}')"
                                            class="px-3 py-1 text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full border border-gray-300">
                                            + {{ __($feature) }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Additional Information -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Additional Information') }}
                                </h3>
                            </div>

                            <div>
                                <x-input-label for="purchase_date" value="{{ __('Purchase Date') }}" />
                                <x-text-input id="purchase_date" name="purchase_date" type="date"
                                    class="mt-1 block w-full"
                                    value="{{ old('purchase_date', $vehicle->purchase_date ? $vehicle->purchase_date->format('Y-m-d') : '') }}" />
                                <x-input-error :messages="$errors->get('purchase_date')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="warranty_expiry" value="{{ __('Warranty Expiry') }}" />
                                <x-text-input id="warranty_expiry" name="warranty_expiry" type="date"
                                    class="mt-1 block w-full"
                                    value="{{ old('warranty_expiry', $vehicle->warranty_expiry ? $vehicle->warranty_expiry->format('Y-m-d') : '') }}" />
                                <x-input-error :messages="$errors->get('warranty_expiry')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="insurance_expiry" value="{{ __('Insurance Expiry') }}" />
                                <x-text-input id="insurance_expiry" name="insurance_expiry" type="date"
                                    class="mt-1 block w-full"
                                    value="{{ old('insurance_expiry', $vehicle->insurance_expiry ? $vehicle->insurance_expiry->format('Y-m-d') : '') }}" />
                                <x-input-error :messages="$errors->get('insurance_expiry')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="registration_number" value="{{ __('Registration Number') }}" />
                                <x-text-input id="registration_number" name="registration_number" type="text"
                                    class="mt-1 block w-full"
                                    value="{{ old('registration_number', $vehicle->registration_number) }}"
                                    maxlength="20" />
                                <x-input-error :messages="$errors->get('registration_number')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="engine_number" value="{{ __('Engine Number') }}" />
                                <x-text-input id="engine_number" name="engine_number" type="text"
                                    class="mt-1 block w-full"
                                    value="{{ old('engine_number', $vehicle->engine_number) }}" maxlength="30" />
                                <x-input-error :messages="$errors->get('engine_number')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="chassis_number" value="{{ __('Chassis Number') }}" />
                                <x-text-input id="chassis_number" name="chassis_number" type="text"
                                    class="mt-1 block w-full"
                                    value="{{ old('chassis_number', $vehicle->chassis_number) }}" maxlength="30" />
                                <x-input-error :messages="$errors->get('chassis_number')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="doors_count" value="{{ __('Doors Count') }}" />
                                <select id="doors_count" name="doors_count"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">{{ __('Select Doors Count') }}</option>
                                    <option value="2"
                                        {{ old('doors_count', $vehicle->doors_count) == '2' ? 'selected' : '' }}>2
                                        {{ __('Doors') }}</option>
                                    <option value="3"
                                        {{ old('doors_count', $vehicle->doors_count) == '3' ? 'selected' : '' }}>3
                                        {{ __('Doors') }}</option>
                                    <option value="4"
                                        {{ old('doors_count', $vehicle->doors_count) == '4' ? 'selected' : '' }}>4
                                        {{ __('Doors') }}</option>
                                    <option value="5"
                                        {{ old('doors_count', $vehicle->doors_count) == '5' ? 'selected' : '' }}>5
                                        {{ __('Doors') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('doors_count')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="air_conditioning" value="{{ __('Air Conditioning') }}" />
                                <select id="air_conditioning" name="air_conditioning"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">{{ __('Select Air Conditioning') }}</option>
                                    <option value="manual"
                                        {{ old('air_conditioning', $vehicle->air_conditioning) == 'manual' ? 'selected' : '' }}>
                                        {{ __('Manual') }}</option>
                                    <option value="automatic"
                                        {{ old('air_conditioning', $vehicle->air_conditioning) == 'automatic' ? 'selected' : '' }}>
                                        {{ __('Automatic') }}</option>
                                    <option value="dual_zone"
                                        {{ old('air_conditioning', $vehicle->air_conditioning) == 'dual_zone' ? 'selected' : '' }}>
                                        {{ __('Dual Zone') }}</option>
                                    <option value="none"
                                        {{ old('air_conditioning', $vehicle->air_conditioning) == 'none' ? 'selected' : '' }}>
                                        {{ __('None') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('air_conditioning')" class="mt-2" />
                            </div>

                            <!-- Location Information -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Location Information') }}
                                </h3>
                            </div>

                            <div>
                                <x-input-label for="location_city" value="{{ __('City') }}" />
                                <x-text-input id="location_city" name="location_city" type="text"
                                    class="mt-1 block w-full"
                                    value="{{ old('location_city', $vehicle->location_city) }}" />
                                <x-input-error :messages="$errors->get('location_city')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="location_country" value="{{ __('Country') }}" />
                                <x-text-input id="location_country" name="location_country" type="text"
                                    class="mt-1 block w-full"
                                    value="{{ old('location_country', $vehicle->location_country) }}" />
                                <x-input-error :messages="$errors->get('location_country')" class="mt-2" />
                            </div>

                            <!-- SEO and Meta -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('SEO & Meta Information') }}
                                </h3>
                            </div>

                            <div>
                                <x-input-label for="meta_title" value="{{ __('Meta Title') }}" />
                                <x-text-input id="meta_title" name="meta_title" type="text"
                                    class="mt-1 block w-full" value="{{ old('meta_title', $vehicle->meta_title) }}"
                                    maxlength="60" />
                                <small class="text-gray-500">{{ __('Maximum 60 characters for SEO') }}</small>
                                <x-input-error :messages="$errors->get('meta_title')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="meta_description" value="{{ __('Meta Description') }}" />
                                <textarea id="meta_description" name="meta_description" rows="3"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('meta_description', $vehicle->meta_description) }}</textarea>
                                <small class="text-gray-500">{{ __('Maximum 160 characters for SEO') }}</small>
                                <x-input-error :messages="$errors->get('meta_description')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="meta_keywords" value="{{ __('Meta Keywords') }}" />
                                <x-text-input id="meta_keywords" name="meta_keywords" type="text"
                                    class="mt-1 block w-full"
                                    value="{{ old('meta_keywords', $vehicle->meta_keywords) }}"
                                    placeholder="keyword1, keyword2, keyword3" />
                                <x-input-error :messages="$errors->get('meta_keywords')" class="mt-2" />
                            </div>


                        </div>

                        <div class="flex justify-between items-center mt-6 pt-6 border-t border-gray-200">
                            <div class="flex space-x-3">
                                <button type="button" onclick="saveAsDraft()"
                                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    {{ __('Save as Draft') }}
                                </button>
                                <button type="button" onclick="previewVehicle()"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    {{ __('Preview') }}
                                </button>
                            </div>
                            <div class="flex space-x-3">
                                <a href="{{ route('admin.vehicles.show', $vehicle) }}"
                                    class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                    {{ __('View') }}
                                </a>
                                <a href="{{ route('admin.vehicles.index') }}"
                                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    {{ __('Cancel') }}
                                </a>
                                <x-primary-button>{{ __('Update Vehicle') }}</x-primary-button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize Select2 for all select elements
            $('.select2-brand-ajax').select2({
                placeholder: '{{ __('Search and select brand...') }}',
                allowClear: true,
                width: '100%',
                ajax: {
                    url: '{{ route('admin.vehicle-brands.select') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.data,
                            pagination: {
                                more: (params.page * 10) < data.total
                            }
                        };
                    },
                    cache: true
                }
            });

            $('.select2-model-ajax').select2({
                placeholder: '{{ __('Search and select model...') }}',
                allowClear: true,
                width: '100%',
                ajax: {
                    url: '{{ route('admin.vehicle-models.select') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page,
                            brand_id: $('.select2-brand-ajax').val() // Pass selected brand ID
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.data,
                            pagination: {
                                more: (params.page * 10) < data.total
                            }
                        };
                    },
                    cache: true
                }
            });

            $('.select2-spec').select2({
                placeholder: '{{ __('Search and select regional spec...') }}',
                allowClear: true,
                width: '100%'
            });

            $('.select2-body').select2({
                placeholder: '{{ __('Search and select body type...') }}',
                allowClear: true,
                width: '100%'
            });

            $('.select2-seats').select2({
                placeholder: '{{ __('Search and select seats count...') }}',
                allowClear: true,
                width: '100%'
            });

            $('.select2-fuel').select2({
                placeholder: '{{ __('Search and select fuel type...') }}',
                allowClear: true,
                width: '100%'
            });

            $('.select2-transmission').select2({
                placeholder: '{{ __('Search and select transmission type...') }}',
                allowClear: true,
                width: '100%'
            });

            $('.select2-engine').select2({
                placeholder: '{{ __('Search and select engine capacity...') }}',
                allowClear: true,
                width: '100%'
            });

            $('.select2-horsepower').select2({
                placeholder: '{{ __('Search and select horsepower range...') }}',
                allowClear: true,
                width: '100%'
            });

            $('.select2-cylinders').select2({
                placeholder: '{{ __('Search and select cylinders count...') }}',
                allowClear: true,
                width: '100%'
            });

            $('.select2-steering').select2({
                placeholder: '{{ __('Search and select steering side...') }}',
                allowClear: true,
                width: '100%'
            });

            $('.select2-color').select2({
                placeholder: '{{ __('Search and select color...') }}',
                allowClear: true,
                width: '100%'
            });

            // Load models when brand is selected
            $('.select2-brand-ajax').on('change', function() {
                const brandId = $(this).val();
                const modelSelect = $('.select2-model-ajax');

                // Clear current options and disable
                modelSelect.empty().append('<option value="">{{ __('Select Model') }}</option>').prop(
                    'disabled', true);

                if (brandId) {
                    modelSelect.prop('disabled', false).trigger('change');
                }
            });

            // Character counter for meta fields
            $('#meta_title').on('input', function() {
                const maxLength = 60;
                const currentLength = $(this).val().length;
                const remaining = maxLength - currentLength;

                if (!$(this).next('.char-counter').length) {
                    $(this).after(
                        `<div class="char-counter text-sm mt-1 ${remaining < 10 ? 'text-red-500' : 'text-gray-500'}">${remaining} characters remaining</div>`
                        );
                } else {
                    $(this).next('.char-counter').text(`${remaining} characters remaining`).removeClass(
                        'text-red-500 text-gray-500').addClass(remaining < 10 ? 'text-red-500' :
                        'text-gray-500');
                }
            });

            $('#meta_description').on('input', function() {
                const maxLength = 160;
                const currentLength = $(this).val().length;
                const remaining = maxLength - currentLength;

                if (!$(this).next('.char-counter').length) {
                    $(this).after(
                        `<div class="char-counter text-sm mt-1 ${remaining < 20 ? 'text-red-500' : 'text-gray-500'}">${remaining} characters remaining</div>`
                        );
                } else {
                    $(this).next('.char-counter').text(`${remaining} characters remaining`).removeClass(
                        'text-red-500 text-gray-500').addClass(remaining < 20 ? 'text-red-500' :
                        'text-gray-500');
                }
            });

            // Initialize character counters
            $('#meta_title, #meta_description').trigger('input');

            // Form validation
            $('form').on('submit', function(e) {
                const requiredFields = ['brand_id', 'model_id', 'year', 'price'];
                let isValid = true;

                requiredFields.forEach(field => {
                    const value = $(`#${field}`).val();
                    if (!value) {
                        $(`#${field}`).addClass('border-red-500');
                        isValid = false;
                    } else {
                        $(`#${field}`).removeClass('border-red-500');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('{{ __('Please fill in all required fields') }}');
                    return false;
                }

                // Validate year range
                const year = parseInt($('#year').val());
                const currentYear = new Date().getFullYear();
                if (year < 1900 || year > currentYear + 1) {
                    e.preventDefault();
                    alert('{{ __('Please enter a valid year between 1900 and') }} ' + (currentYear + 1));
                    return false;
                }

                // Validate price
                const price = parseFloat($('#price').val());
                if (price < 0) {
                    e.preventDefault();
                    alert('{{ __('Price cannot be negative') }}');
                    return false;
                }
            });

            // Auto-save draft functionality
            let autoSaveTimer;
            $('input, select, textarea').on('change', function() {
                clearTimeout(autoSaveTimer);
                autoSaveTimer = setTimeout(function() {
                    // You can implement auto-save AJAX call here
                    console.log('Auto-saving form data...');
                }, 3000); // Auto-save after 3 seconds of inactivity
            });
        });

        // Image management functions
        function removeFeaturedImage() {
            if (confirm('{{ __('Are you sure you want to remove the featured image?') }}')) {
                document.getElementById('remove_featured_image').value = '1';
                const imageContainer = document.querySelector('[id^="featured_image"]').closest('.md\\:col-span-2');
                const currentImageDiv = imageContainer.querySelector('.border.border-gray-200');
                if (currentImageDiv) {
                    currentImageDiv.style.display = 'none';
                }
            }
        }

        function removeGalleryImage(index) {
            if (confirm('{{ __('Are you sure you want to remove this gallery image?') }}')) {
                document.getElementById(`remove_gallery_${index}`).value = '1';
                const imageDiv = document.getElementById(`remove_gallery_${index}`).closest('.relative');
                if (imageDiv) {
                    imageDiv.style.display = 'none';
                }
            }
        }

        // File size validation
        document.getElementById('featured_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file && file.size > 2 * 1024 * 1024) { // 2MB
                alert('{{ __('Featured image size should be less than 2MB') }}');
                this.value = '';
            }
        });

        document.getElementById('gallery_images').addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            const maxSize = 2 * 1024 * 1024; // 2MB

            for (let file of files) {
                if (file.size > maxSize) {
                    alert(`{{ __('Image') }} ${file.name} {{ __('size should be less than 2MB') }}`);
                    this.value = '';
                    return;
                }
            }
        });

        // Preview image before upload
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Feature management
        function addFeature(featureName) {
            const featuresTextarea = document.getElementById('features');
            const currentFeatures = featuresTextarea.value;

            if (currentFeatures) {
                // Check if feature already exists
                const features = currentFeatures.split(',').map(f => f.trim());
                if (!features.includes(featureName)) {
                    featuresTextarea.value = currentFeatures + ', ' + featureName;
                }
            } else {
                featuresTextarea.value = featureName;
            }

            updateFeatureTags();
        }

        function updateFeatureTags() {
            const featuresTextarea = document.getElementById('features');
            const featuresTags = document.getElementById('features-tags');
            const features = featuresTextarea.value.split(',').map(f => f.trim()).filter(f => f);

            featuresTags.innerHTML = '';

            features.forEach((feature, index) => {
                if (feature) {
                    const tag = document.createElement('span');
                    tag.className =
                        'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800';
                    tag.innerHTML = `
                        ${feature}
                        <button type="button" onclick="removeFeature(${index})" class="ml-1.5 text-indigo-600 hover:text-indigo-800">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    `;
                    featuresTags.appendChild(tag);
                }
            });
        }

        function removeFeature(index) {
            const featuresTextarea = document.getElementById('features');
            const features = featuresTextarea.value.split(',').map(f => f.trim()).filter(f => f);

            features.splice(index, 1);
            featuresTextarea.value = features.join(', ');
            updateFeatureTags();
        }

        // Initialize feature tags on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateFeatureTags();

            // Update tags when features textarea changes
            document.getElementById('features').addEventListener('input', updateFeatureTags);
        });

        // Additional button functions
        function saveAsDraft() {
            // Change publish status to draft
            document.getElementById('publish_status').value = 'draft';

            // Show confirmation
            if (confirm('{{ __('Save vehicle as draft?') }}')) {
                // You can implement AJAX save here or just submit the form
                document.querySelector('form').submit();
            }
        }

        function previewVehicle() {
            // Open preview in new window/tab
            const previewUrl = '{{ route('admin.vehicles.show', $vehicle) }}';
            window.open(previewUrl, '_blank');
        }

        // Form progress indicator
        let formChanged = false;
        $('input, select, textarea').on('change', function() {
            formChanged = true;
            updateFormStatus();
        });

        function updateFormStatus() {
            const submitButton = document.querySelector('button[type="submit"]');
            if (formChanged) {
                submitButton.textContent = '{{ __('Update Vehicle *') }}';
                submitButton.classList.add('bg-yellow-600', 'hover:bg-yellow-700');
            }
        }

        // Warn user before leaving with unsaved changes
        window.addEventListener('beforeunload', function(e) {
            if (formChanged) {
                e.preventDefault();
                e.returnValue = '{{ __('You have unsaved changes. Are you sure you want to leave?') }}';
            }
        });
    </script>
</x-admin-layout>
