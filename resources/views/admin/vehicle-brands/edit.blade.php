<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Brand') }}
            </h2>
            <a href="{{ route('admin.vehicle-brands.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Back to List') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('admin.vehicle-brands.update', $vehicleBrand) }}" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="name" value="{{ __('Brand Name') }}" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                         value="{{ old('name', $vehicleBrand->name) }}" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="website" value="{{ __('Website URL') }}" />
                            <x-text-input id="website" name="website" type="url" class="mt-1 block w-full"
                                         value="{{ old('website', $vehicleBrand->website) }}" />
                            <x-input-error :messages="$errors->get('website')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="sort_order" value="{{ __('Sort Order') }}" />
                            <x-text-input id="sort_order" name="sort_order" type="number" class="mt-1 block w-full"
                                         value="{{ old('sort_order', $vehicleBrand->sort_order) }}" min="0" />
                            <x-input-error :messages="$errors->get('sort_order')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="logo" value="{{ __('Brand Logo') }}" />
                            <input id="logo" name="logo" type="file" accept="image/*"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            @if($vehicleBrand->logo)
                                <div class="mt-2">
                                    <p class="text-sm text-gray-600">{{ __('Current logo:') }}</p>
                                    <img src="{{ Storage::url($vehicleBrand->logo) }}" alt="{{ $vehicleBrand->name }}" class="w-20 h-20 object-contain mt-1">
                                </div>
                            @endif
                            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                        </div>

                        <div class="flex items-center">
                            <input id="is_active" name="is_active" type="checkbox" value="1"
                                   {{ old('is_active', $vehicleBrand->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <x-input-label for="is_active" value="{{ __('Active') }}" class="ml-2" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="description" value="{{ __('Description') }}" />
                            <textarea id="description" name="description" rows="4"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $vehicleBrand->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <x-primary-button>{{ __('Update Brand') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
