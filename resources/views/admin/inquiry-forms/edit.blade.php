<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Inquiry Form') }}: {{ $inquiryForm->title }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.inquiry-forms.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Back to List') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            {{ __('Dashboard') }}
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('admin.inquiry-forms.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">{{ __('Inquiry Forms') }}</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ __('Edit') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-8">
                    <form action="{{ route('admin.inquiry-forms.update', $inquiryForm) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Basic Information -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Basic Information') }}</h3>
                            </div>

                            <div>
                                <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('Slug') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="slug" name="slug" value="{{ old('slug', $inquiryForm->slug) }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('slug') border-red-500 @enderror"
                                       placeholder="special_car_purchase">
                                @error('slug')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('Name') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="name" name="name" value="{{ old('name', $inquiryForm->name) }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                                       placeholder="Special Car Purchase">
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('Title') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="title" name="title" value="{{ old('title', $inquiryForm->title) }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                                       placeholder="درخواست خرید خودرو خاص">
                                @error('title')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('Description') }}
                                </label>
                                <textarea id="description" name="description" rows="3"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                                          placeholder="توضیحات فرم...">{{ old('description', $inquiryForm->description) }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Technical Information -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 mt-6">{{ __('Technical Information') }}</h3>
                            </div>

                            <div>
                                <label for="route_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('Route Name') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="route_name" name="route_name" value="{{ old('route_name', $inquiryForm->route_name) }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('route_name') border-red-500 @enderror"
                                       placeholder="inquiries.special_car_purchase.form">
                                @error('route_name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="controller" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('Controller') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="controller" name="controller" value="{{ old('controller', $inquiryForm->controller) }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('controller') border-red-500 @enderror"
                                       placeholder="App\Http\Controllers\InquirySpecialCarPurchaseController">
                                @error('controller')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="model" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('Model') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="model" name="model" value="{{ old('model', $inquiryForm->model) }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('model') border-red-500 @enderror"
                                       placeholder="App\Models\InquirySpecialCarPurchase">
                                @error('model')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Display Settings -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 mt-6">{{ __('Display Settings') }}</h3>
                            </div>

                            <div>
                                <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('Icon') }}
                                </label>
                                <select id="icon" name="icon"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('icon') border-red-500 @enderror">
                                    <option value="">-- {{ __('Select Icon') }} --</option>
                                    <option value="car" {{ old('icon', $inquiryForm->icon) === 'car' ? 'selected' : '' }}>{{ __('Car') }}</option>
                                    <option value="spare-part" {{ old('icon', $inquiryForm->icon) === 'spare-part' ? 'selected' : '' }}>{{ __('Spare Part') }}</option>
                                    <option value="vin-check" {{ old('icon', $inquiryForm->icon) === 'vin-check' ? 'selected' : '' }}>{{ __('VIN Check') }}</option>
                                    <option value="document" {{ old('icon', $inquiryForm->icon) === 'document' ? 'selected' : '' }}>{{ __('Document') }}</option>
                                </select>
                                @error('icon')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="color" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('Color') }} <span class="text-red-500">*</span>
                                </label>
                                <select id="color" name="color" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('color') border-red-500 @enderror">
                                    <option value="blue" {{ old('color', $inquiryForm->color) === 'blue' ? 'selected' : '' }}>{{ __('Blue') }}</option>
                                    <option value="green" {{ old('color', $inquiryForm->color) === 'green' ? 'selected' : '' }}>{{ __('Green') }}</option>
                                    <option value="purple" {{ old('color', $inquiryForm->color) === 'purple' ? 'selected' : '' }}>{{ __('Purple') }}</option>
                                    <option value="red" {{ old('color', $inquiryForm->color) === 'red' ? 'selected' : '' }}>{{ __('Red') }}</option>
                                    <option value="yellow" {{ old('color', $inquiryForm->color) === 'yellow' ? 'selected' : '' }}>{{ __('Yellow') }}</option>
                                    <option value="gray" {{ old('color', $inquiryForm->color) === 'gray' ? 'selected' : '' }}>{{ __('Gray') }}</option>
                                </select>
                                @error('color')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('Sort Order') }}
                                </label>
                                <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $inquiryForm->sort_order) }}" min="0"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('sort_order') border-red-500 @enderror">
                                @error('sort_order')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $inquiryForm->is_active) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700">{{ __('Active') }}</span>
                                </label>
                            </div>
                        </div>

                        <!-- Form Fields (JSON) -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Form Fields (JSON)') }}</h3>
                            <div>
                                <label for="fields" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('Fields Configuration') }}
                                </label>
                                <textarea id="fields" name="fields" rows="8"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('fields') border-red-500 @enderror font-mono text-sm"
                                          placeholder='{"field_name": {"type": "text", "label": "Field Label", "required": true}}'>{{ old('fields', is_array($inquiryForm->fields) ? json_encode($inquiryForm->fields, JSON_PRETTY_PRINT) : $inquiryForm->fields) }}</textarea>
                                <p class="text-sm text-gray-500 mt-1">{{ __('Enter JSON configuration for form fields') }}</p>
                                @error('fields')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.inquiry-forms.index') }}"
                               class="px-6 py-2 bg-gray-500 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit"
                                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                                {{ __('Update Form') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
