<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Inquiry Form Details') }}: {{ $inquiryForm->title }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.inquiry-forms.edit', $inquiryForm) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Edit') }}
                </a>
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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ __('Details') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-8">
                    <!-- Header -->
                    <div class="flex items-center mb-8">
                        <div class="w-16 h-16 rounded-lg flex items-center justify-center mr-6
                            {{ $inquiryForm->color === 'blue' ? 'bg-blue-100 text-blue-600' :
                               ($inquiryForm->color === 'green' ? 'bg-green-100 text-green-600' :
                               ($inquiryForm->color === 'purple' ? 'bg-purple-100 text-purple-600' :
                               ($inquiryForm->color === 'red' ? 'bg-red-100 text-red-600' :
                               ($inquiryForm->color === 'yellow' ? 'bg-yellow-100 text-yellow-600' :
                               'bg-gray-100 text-gray-600')))) }}">
                            @if($inquiryForm->icon === 'car')
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            @elseif($inquiryForm->icon === 'spare-part')
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            @elseif($inquiryForm->icon === 'vin-check')
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @else
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            @endif
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $inquiryForm->title }}</h1>
                            <p class="text-gray-600">{{ $inquiryForm->name }}</p>
                            <div class="flex items-center mt-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $inquiryForm->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $inquiryForm->is_active ? __('Active') : __('Inactive') }}
                                </span>
                                <span class="ml-2 text-sm text-gray-500">{{ __('Sort Order') }}: {{ $inquiryForm->sort_order }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Basic Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Basic Information') }}</h3>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Slug') }}</dt>
                                    <dd class="text-sm text-gray-900 font-mono">{{ $inquiryForm->slug }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Name') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $inquiryForm->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Title') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $inquiryForm->title }}</dd>
                                </div>
                                @if($inquiryForm->description)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">{{ __('Description') }}</dt>
                                        <dd class="text-sm text-gray-900">{{ $inquiryForm->description }}</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Technical Information') }}</h3>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Route Name') }}</dt>
                                    <dd class="text-sm text-gray-900 font-mono">{{ $inquiryForm->route_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Controller') }}</dt>
                                    <dd class="text-sm text-gray-900 font-mono">{{ $inquiryForm->controller }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Model') }}</dt>
                                    <dd class="text-sm text-gray-900 font-mono">{{ $inquiryForm->model }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Icon') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ $inquiryForm->icon ?: __('Not set') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ __('Color') }}</dt>
                                    <dd class="text-sm text-gray-900">{{ ucfirst($inquiryForm->color) }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Form Fields -->
                    @if($inquiryForm->fields)
                        <div class="bg-gray-50 rounded-lg p-6 mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Form Fields') }}</h3>
                            <div class="bg-white rounded-lg p-4">
                                <pre class="text-sm text-gray-900 font-mono overflow-x-auto">{{ json_encode($inquiryForm->fields, JSON_PRETTY_PRINT) }}</pre>
                            </div>
                        </div>
                    @endif

                    <!-- Statistics -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Statistics') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-white rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold text-blue-600">{{ $inquiryForm->created_at->format('Y/m/d') }}</div>
                                <div class="text-sm text-gray-500">{{ __('Created Date') }}</div>
                            </div>
                            <div class="bg-white rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold text-green-600">{{ $inquiryForm->updated_at->format('Y/m/d') }}</div>
                                <div class="text-sm text-gray-500">{{ __('Last Updated') }}</div>
                            </div>
                            <div class="bg-white rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold text-purple-600">{{ $inquiryForm->id }}</div>
                                <div class="text-sm text-gray-500">{{ __('Form ID') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                        <form action="{{ route('admin.inquiry-forms.toggle-active', $inquiryForm) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                    class="px-4 py-2 {{ $inquiryForm->is_active ? 'bg-red-500 hover:bg-red-700' : 'bg-green-500 hover:bg-green-700' }} text-white font-medium rounded-lg transition-colors duration-200">
                                {{ $inquiryForm->is_active ? __('Deactivate') : __('Activate') }}
                            </button>
                        </form>
                        <a href="{{ route('admin.inquiry-forms.edit', $inquiryForm) }}"
                           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                            {{ __('Edit Form') }}
                        </a>
                        <form action="{{ route('admin.inquiry-forms.destroy', $inquiryForm) }}" method="POST" class="inline"
                              onsubmit="return confirm('{{ __('Are you sure you want to delete this form?') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200">
                                {{ __('Delete Form') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
