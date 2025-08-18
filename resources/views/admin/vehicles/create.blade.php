<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Vehicle') }}
            </h2>
            <a href="{{ route('admin.vehicles.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Back to List') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Basic Information -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Basic Information') }}</h3>
                        </div>

                        <div>
                            <x-input-label for="brand_id" value="{{ __('Brand') }}" />
                            <select id="brand_id" name="brand_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-brand-ajax">
                                <option value="">{{ __('Search and select brand...') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('brand_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="model_id" value="{{ __('Model') }}" />
                            <select id="model_id" name="model_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-model-ajax">
                                <option value="">{{ __('Select brand first...') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('model_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="year" value="{{ __('Year') }}" />
                            <x-text-input id="year" name="year" type="number" class="mt-1 block w-full"
                                         value="{{ old('year') }}" min="1900" max="{{ date('Y') + 1 }}" required />
                            <x-input-error :messages="$errors->get('year')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="price" value="{{ __('Price') }}" />
                            <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full"
                                         value="{{ old('price') }}" min="0" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="currency" value="{{ __('Currency') }}" />
                            <select id="currency" name="currency" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="AED" {{ old('currency') == 'AED' ? 'selected' : '' }}>AED</option>
                                <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD</option>
                                <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR</option>
                                <option value="IRR" {{ old('currency') == 'IRR' ? 'selected' : '' }}>IRR</option>
                            </select>
                            <x-input-error :messages="$errors->get('currency')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="mileage" value="{{ __('Mileage (km)') }}" />
                            <x-text-input id="mileage" name="mileage" type="number" class="mt-1 block w-full"
                                         value="{{ old('mileage') }}" min="0" />
                            <x-input-error :messages="$errors->get('mileage')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="status" value="{{ __('Status') }}" />
                            <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="new" {{ old('status') == 'new' ? 'selected' : '' }}>{{ __('New') }}</option>
                                <option value="used" {{ old('status') == 'used' ? 'selected' : '' }}>{{ __('Used') }}</option>
                                <option value="export" {{ old('status') == 'export' ? 'selected' : '' }}>{{ __('Export') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="publish_status" value="{{ __('Publish Status') }}" />
                            <select id="publish_status" name="publish_status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="draft" {{ old('publish_status') == 'draft' ? 'selected' : '' }}>{{ __('Draft') }}</option>
                                <option value="published" {{ old('publish_status') == 'published' ? 'selected' : '' }}>{{ __('Published') }}</option>
                                <option value="archived" {{ old('publish_status') == 'archived' ? 'selected' : '' }}>{{ __('Archived') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('publish_status')" class="mt-2" />
                        </div>

                        <div class="flex items-center">
                            <input id="is_featured" name="is_featured" type="checkbox" value="1"
                                   {{ old('is_featured') ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <x-input-label for="is_featured" value="{{ __('Featured Vehicle') }}" class="ml-2" />
                        </div>

                        <div class="flex items-center">
                            <input id="is_available" name="is_available" type="checkbox" value="1"
                                   {{ old('is_available', true) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <x-input-label for="is_available" value="{{ __('Available') }}" class="ml-2" />
                        </div>

                        <div class="flex items-center">
                            <input id="is_negotiable" name="is_negotiable" type="checkbox" value="1"
                                   {{ old('is_negotiable') ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <x-input-label for="is_negotiable" value="{{ __('Price Negotiable') }}" class="ml-2" />
                        </div>

                        <div class="flex items-center">
                            <input id="is_imported" name="is_imported" type="checkbox" value="1"
                                   {{ old('is_imported') ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <x-input-label for="is_imported" value="{{ __('Imported Vehicle') }}" class="ml-2" />
                        </div>

                        <!-- Specifications -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Specifications') }}</h3>
                        </div>

                        <div>
                            <x-input-label for="regional_spec_id" value="{{ __('Regional Spec') }}" />
                            <select id="regional_spec_id" name="regional_spec_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-spec">
                                <option value="">{{ __('Select Regional Spec') }}</option>
                                @foreach($regionalSpecs as $spec)
                                    <option value="{{ $spec->id }}" {{ old('regional_spec_id') == $spec->id ? 'selected' : '' }}>
                                        {{ $spec->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('regional_spec_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="body_type_id" value="{{ __('Body Type') }}" />
                            <select id="body_type_id" name="body_type_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-body">
                                <option value="">{{ __('Select Body Type') }}</option>
                                @foreach($bodyTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('body_type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('body_type_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="seats_count_id" value="{{ __('Seats Count') }}" />
                            <select id="seats_count_id" name="seats_count_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-seats">
                                <option value="">{{ __('Select Seats Count') }}</option>
                                @foreach($seatsCounts as $seats)
                                    <option value="{{ $seats->id }}" {{ old('seats_count_id') == $seats->id ? 'selected' : '' }}>
                                        {{ $seats->count }} {{ __('Seats') }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('seats_count_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="fuel_type_id" value="{{ __('Fuel Type') }}" />
                            <select id="fuel_type_id" name="fuel_type_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-fuel">
                                <option value="">{{ __('Select Fuel Type') }}</option>
                                @foreach($fuelTypes as $fuel)
                                    <option value="{{ $fuel->id }}" {{ old('fuel_type_id') == $fuel->id ? 'selected' : '' }}>
                                        {{ $fuel->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('fuel_type_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="transmission_type_id" value="{{ __('Transmission Type') }}" />
                            <select id="transmission_type_id" name="transmission_type_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-transmission">
                                <option value="">{{ __('Select Transmission Type') }}</option>
                                @foreach($transmissionTypes as $transmission)
                                    <option value="{{ $transmission->id }}" {{ old('transmission_type_id') == $transmission->id ? 'selected' : '' }}>
                                        {{ $transmission->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('transmission_type_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="engine_capacity_range_id" value="{{ __('Engine Capacity') }}" />
                            <select id="engine_capacity_range_id" name="engine_capacity_range_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-engine">
                                <option value="">{{ __('Select Engine Capacity') }}</option>
                                @foreach($engineCapacityRanges as $engine)
                                    <option value="{{ $engine->id }}" {{ old('engine_capacity_range_id') == $engine->id ? 'selected' : '' }}>
                                        {{ $engine->display_name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('engine_capacity_range_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="horsepower_range_id" value="{{ __('Horsepower') }}" />
                            <select id="horsepower_range_id" name="horsepower_range_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-horsepower">
                                <option value="">{{ __('Select Horsepower Range') }}</option>
                                @foreach($horsepowerRanges as $hp)
                                    <option value="{{ $hp->id }}" {{ old('horsepower_range_id') == $hp->id ? 'selected' : '' }}>
                                        {{ $hp->display_name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('horsepower_range_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="cylinders_count_id" value="{{ __('Cylinders Count') }}" />
                            <select id="cylinders_count_id" name="cylinders_count_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-cylinders">
                                <option value="">{{ __('Select Cylinders Count') }}</option>
                                @foreach($cylindersCounts as $cylinders)
                                    <option value="{{ $cylinders->id }}" {{ old('cylinders_count_id') == $cylinders->id ? 'selected' : '' }}>
                                        {{ $cylinders->count }} {{ __('Cylinders') }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('cylinders_count_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="steering_side_id" value="{{ __('Steering Side') }}" />
                            <select id="steering_side_id" name="steering_side_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-steering">
                                <option value="">{{ __('Select Steering Side') }}</option>
                                @foreach($steeringSides as $steering)
                                    <option value="{{ $steering->id }}" {{ old('steering_side_id') == $steering->id ? 'selected' : '' }}>
                                        {{ $steering->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('steering_side_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="exterior_color_id" value="{{ __('Exterior Color') }}" />
                            <select id="exterior_color_id" name="exterior_color_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-color">
                                <option value="">{{ __('Select Exterior Color') }}</option>
                                @foreach($exteriorColors as $color)
                                    <option value="{{ $color->id }}" {{ old('exterior_color_id') == $color->id ? 'selected' : '' }}>
                                        {{ $color->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('exterior_color_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="interior_color_id" value="{{ __('Interior Color') }}" />
                            <select id="interior_color_id" name="interior_color_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 select2-color">
                                <option value="">{{ __('Select Interior Color') }}</option>
                                @foreach($interiorColors as $color)
                                    <option value="{{ $color->id }}" {{ old('interior_color_id') == $color->id ? 'selected' : '' }}>
                                        {{ $color->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('interior_color_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="vin_number" value="{{ __('VIN Number') }}" />
                            <x-text-input id="vin_number" name="vin_number" type="text" class="mt-1 block w-full"
                                         value="{{ old('vin_number') }}" maxlength="17" />
                            <x-input-error :messages="$errors->get('vin_number')" class="mt-2" />
                        </div>

                        <!-- Additional Information -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Additional Information') }}</h3>
                        </div>

                        <div>
                            <x-input-label for="purchase_date" value="{{ __('Purchase Date') }}" />
                            <x-text-input id="purchase_date" name="purchase_date" type="date" class="mt-1 block w-full"
                                         value="{{ old('purchase_date') }}" />
                            <x-input-error :messages="$errors->get('purchase_date')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="warranty_expiry" value="{{ __('Warranty Expiry') }}" />
                            <x-text-input id="warranty_expiry" name="warranty_expiry" type="date" class="mt-1 block w-full"
                                         value="{{ old('warranty_expiry') }}" />
                            <x-input-error :messages="$errors->get('warranty_expiry')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="insurance_expiry" value="{{ __('Insurance Expiry') }}" />
                            <x-text-input id="insurance_expiry" name="insurance_expiry" type="date" class="mt-1 block w-full"
                                         value="{{ old('insurance_expiry') }}" />
                            <x-input-error :messages="$errors->get('insurance_expiry')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="registration_number" value="{{ __('Registration Number') }}" />
                            <x-text-input id="registration_number" name="registration_number" type="text" class="mt-1 block w-full"
                                         value="{{ old('registration_number') }}" maxlength="20" />
                            <x-input-error :messages="$errors->get('registration_number')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="engine_number" value="{{ __('Engine Number') }}" />
                            <x-text-input id="engine_number" name="engine_number" type="text" class="mt-1 block w-full"
                                         value="{{ old('engine_number') }}" maxlength="30" />
                            <x-input-error :messages="$errors->get('engine_number')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="chassis_number" value="{{ __('Chassis Number') }}" />
                            <x-text-input id="chassis_number" name="chassis_number" type="text" class="mt-1 block w-full"
                                         value="{{ old('chassis_number') }}" maxlength="30" />
                            <x-input-error :messages="$errors->get('chassis_number')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="doors_count" value="{{ __('Doors Count') }}" />
                            <select id="doors_count" name="doors_count" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">{{ __('Select Doors Count') }}</option>
                                <option value="2" {{ old('doors_count') == '2' ? 'selected' : '' }}>2 {{ __('Doors') }}</option>
                                <option value="3" {{ old('doors_count') == '3' ? 'selected' : '' }}>3 {{ __('Doors') }}</option>
                                <option value="4" {{ old('doors_count') == '4' ? 'selected' : '' }}>4 {{ __('Doors') }}</option>
                                <option value="5" {{ old('doors_count') == '5' ? 'selected' : '' }}>5 {{ __('Doors') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('doors_count')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="air_conditioning" value="{{ __('Air Conditioning') }}" />
                            <select id="air_conditioning" name="air_conditioning" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">{{ __('Select Air Conditioning') }}</option>
                                <option value="manual" {{ old('air_conditioning') == 'manual' ? 'selected' : '' }}>{{ __('Manual') }}</option>
                                <option value="automatic" {{ old('air_conditioning') == 'automatic' ? 'selected' : '' }}>{{ __('Automatic') }}</option>
                                <option value="dual_zone" {{ old('air_conditioning') == 'dual_zone' ? 'selected' : '' }}>{{ __('Dual Zone') }}</option>
                                <option value="none" {{ old('air_conditioning') == 'none' ? 'selected' : '' }}>{{ __('None') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('air_conditioning')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="location_city" value="{{ __('City') }}" />
                            <x-text-input id="location_city" name="location_city" type="text" class="mt-1 block w-full"
                                         value="{{ old('location_city') }}" />
                            <x-input-error :messages="$errors->get('location_city')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="location_country" value="{{ __('Country') }}" />
                            <x-text-input id="location_country" name="location_country" type="text" class="mt-1 block w-full"
                                         value="{{ old('location_country') }}" />
                            <x-input-error :messages="$errors->get('location_country')" class="mt-2" />
                        </div>

                        <!-- Images -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Images') }}</h3>
                        </div>

                        <div>
                            <x-input-label for="featured_image" value="{{ __('Featured Image') }}" />
                            <input id="featured_image" name="featured_image" type="file" accept="image/*"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <x-input-error :messages="$errors->get('featured_image')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="gallery_images" value="{{ __('Gallery Images') }}" />
                            <input id="gallery_images" name="gallery_images[]" type="file" accept="image/*" multiple
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <x-input-error :messages="$errors->get('gallery_images.*')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <x-input-label for="description" value="{{ __('Description') }}" />
                            <textarea id="description" name="description" rows="4"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Features -->
                        <div class="md:col-span-2">
                            <x-input-label for="features" value="{{ __('Features (comma separated)') }}" />
                            <x-text-input id="features" name="features" type="text" class="mt-1 block w-full"
                                         value="{{ old('features') }}" placeholder="Feature 1, Feature 2, Feature 3" />
                            <x-input-error :messages="$errors->get('features')" class="mt-2" />
                        </div>

                        <!-- SEO Information -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('SEO Information') }}</h3>
                        </div>

                        <div>
                            <x-input-label for="meta_title" value="{{ __('Meta Title') }}" />
                            <x-text-input id="meta_title" name="meta_title" type="text" class="mt-1 block w-full"
                                         value="{{ old('meta_title') }}" maxlength="60" />
                            <x-input-error :messages="$errors->get('meta_title')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="meta_description" value="{{ __('Meta Description') }}" />
                            <textarea id="meta_description" name="meta_description" rows="3"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('meta_description') }}</textarea>
                            <x-input-error :messages="$errors->get('meta_description')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="meta_keywords" value="{{ __('Meta Keywords') }}" />
                            <x-text-input id="meta_keywords" name="meta_keywords" type="text" class="mt-1 block w-full"
                                         value="{{ old('meta_keywords') }}" placeholder="keyword1, keyword2, keyword3" />
                            <x-input-error :messages="$errors->get('meta_keywords')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="priority_order" value="{{ __('Priority Order') }}" />
                            <x-text-input id="priority_order" name="priority_order" type="number" class="mt-1 block w-full"
                                         value="{{ old('priority_order', 0) }}" min="0" max="999" />
                            <x-input-error :messages="$errors->get('priority_order')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <x-primary-button>{{ __('Create Vehicle') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize Select2 for all select elements
            $('.select2-brand-ajax').select2({
                placeholder: '{{ __("Search and select brand...") }}',
                allowClear: true,
                width: '100%',
                ajax: {
                    url: '{{ route("admin.brands.select") }}',
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
                placeholder: '{{ __("Search and select model...") }}',
                allowClear: true,
                width: '100%',
                disabled: true,
                ajax: {
                    url: '{{ route("admin.vehicle-models.select") }}',
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
                placeholder: '{{ __("Search and select regional spec...") }}',
                allowClear: true,
                width: '100%'
            });

            $('.select2-body').select2({
                placeholder: '{{ __("Search and select body type...") }}',
                allowClear: true,
                width: '100%'
            });

            $('.select2-seats').select2({
                placeholder: '{{ __("Search and select seats count...") }}',
                allowClear: true,
                width: '100%'
            });

            $('.select2-fuel').select2({
                placeholder: '{{ __("Search and select fuel type...") }}',
                allowClear: true,
                width: '100%'
            });

            $('.select2-transmission').select2({
                placeholder: '{{ __("Search and select transmission type...") }}',
                allowClear: true,
                width: '100%'
            });

            $('.select2-engine').select2({
                placeholder: '{{ __("Search and select engine capacity...") }}',
                allowClear: true,
                width: '100%'
            });

            $('.select2-horsepower').select2({
                placeholder: '{{ __("Search and select horsepower range...") }}',
                allowClear: true,
                width: '100%'
            });

            $('.select2-cylinders').select2({
                placeholder: '{{ __("Search and select cylinders count...") }}',
                allowClear: true,
                width: '100%'
            });

            $('.select2-steering').select2({
                placeholder: '{{ __("Search and select steering side...") }}',
                allowClear: true,
                width: '100%'
            });

            $('.select2-color').select2({
                placeholder: '{{ __("Search and select color...") }}',
                allowClear: true,
                width: '100%'
            });

            // Load models when brand is selected
            $('.select2-brand-ajax').on('change', function() {
                const brandId = $(this).val();
                const modelSelect = $('.select2-model-ajax');

                // Clear current options and disable
                modelSelect.empty().append('<option value="">{{ __("Select Model") }}</option>').prop('disabled', true);

                if (brandId) {
                    modelSelect.prop('disabled', false).trigger('change');
                }
            });
        });
    </script>
</x-admin-layout>
