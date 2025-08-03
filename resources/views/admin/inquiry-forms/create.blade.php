<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create New Inquiry Form') }}
            </h2>
            <a href="{{ route('admin.inquiry-forms.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Back to Forms') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.inquiry-forms.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Basic Information -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-medium text-gray-900">{{ __('Basic Information') }}</h3>

                                <div>
                                    <label for="slug" class="block text-sm font-medium text-gray-700">{{ __('Slug') }}</label>
                                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    @error('slug')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name (English)') }}</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700">{{ __('Title (Persian)') }}</label>
                                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    @error('title')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                                    <textarea name="description" id="description" rows="3"
                                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Technical Information -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-medium text-gray-900">{{ __('Technical Information') }}</h3>

                                <div>
                                    <label for="route_name" class="block text-sm font-medium text-gray-700">{{ __('Route Name') }}</label>
                                    <input type="text" name="route_name" id="route_name" value="{{ old('route_name') }}"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    @error('route_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="controller" class="block text-sm font-medium text-gray-700">{{ __('Controller') }}</label>
                                    <input type="text" name="controller" id="controller" value="{{ old('controller') }}"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    @error('controller')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="model" class="block text-sm font-medium text-gray-700">{{ __('Model') }}</label>
                                    <input type="text" name="model" id="model" value="{{ old('model') }}"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    @error('model')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Appearance -->
                        <div class="mt-8 space-y-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Appearance') }}</h3>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="icon" class="block text-sm font-medium text-gray-700">{{ __('Icon') }}</label>
                                    <select name="icon" id="icon" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="car" {{ old('icon') == 'car' ? 'selected' : '' }}>Car</option>
                                        <option value="spare-part" {{ old('icon') == 'spare-part' ? 'selected' : '' }}>Spare Part</option>
                                        <option value="vin-check" {{ old('icon') == 'vin-check' ? 'selected' : '' }}>VIN Check</option>
                                        <option value="default" {{ old('icon') == 'default' ? 'selected' : '' }}>Default</option>
                                    </select>
                                    @error('icon')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="color" class="block text-sm font-medium text-gray-700">{{ __('Color') }}</label>
                                    <select name="color" id="color" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="blue" {{ old('color') == 'blue' ? 'selected' : '' }}>Blue</option>
                                        <option value="green" {{ old('color') == 'green' ? 'selected' : '' }}>Green</option>
                                        <option value="purple" {{ old('color') == 'purple' ? 'selected' : '' }}>Purple</option>
                                        <option value="red" {{ old('color') == 'red' ? 'selected' : '' }}>Red</option>
                                        <option value="yellow" {{ old('color') == 'yellow' ? 'selected' : '' }}>Yellow</option>
                                        <option value="indigo" {{ old('color') == 'indigo' ? 'selected' : '' }}>Indigo</option>
                                    </select>
                                    @error('color')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="sort_order" class="block text-sm font-medium text-gray-700">{{ __('Sort Order') }}</label>
                                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    @error('sort_order')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="is_active" class="mr-2 block text-sm text-gray-900">{{ __('Active') }}</label>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Create Form') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
