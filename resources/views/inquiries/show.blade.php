<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Inquiry Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('inquiries.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Back to Inquiries') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            {{ __('Home') }}
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('inquiries.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">{{ __('My Inquiries') }}</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $formTitle }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Inquiry Information -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-6">
                                <div>
                                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $formTitle }}</h1>
                                    <p class="text-gray-600">کد درخواست: {{ $inquiry->id }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                                        {{ $inquiry->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                           ($inquiry->status === 'approved' ? 'bg-green-100 text-green-800' :
                                           ($inquiry->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                        {{ __(ucfirst($inquiry->status)) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Quick Info -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <div class="text-2xl font-bold text-gray-900">{{ $inquiry->created_at->format('Y/m/d') }}</div>
                                    <div class="text-sm text-gray-600">{{ __('Submission Date') }}</div>
                                </div>
                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <div class="text-2xl font-bold text-gray-900">{{ $inquiry->created_at->format('H:i') }}</div>
                                    <div class="text-sm text-gray-600">{{ __('Time') }}</div>
                                </div>
                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <div class="text-2xl font-bold text-gray-900">{{ $inquiry->phone }}</div>
                                    <div class="text-sm text-gray-600">{{ __('Phone Number') }}</div>
                                </div>
                            </div>

                            <!-- Form Details -->
                            <div class="mb-8">
                                <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    {{ __('Form Details') }}
                                </h3>

                                @if($type === 'special_car_purchase')
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        @if($inquiry->car_brand)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Brand') }}</span>
                                                <span class="font-semibold text-gray-900">{{ $inquiry->car_brand }}</span>
                                            </div>
                                        @endif
                                        @if($inquiry->car_model)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Model') }}</span>
                                                <span class="font-semibold text-gray-900">{{ $inquiry->car_model }}</span>
                                            </div>
                                        @endif
                                        @if($inquiry->car_year)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Year') }}</span>
                                                <span class="font-semibold text-gray-900">{{ $inquiry->car_year }}</span>
                                            </div>
                                        @endif
                                        @if($inquiry->description)
                                            <div class="md:col-span-2">
                                                <div class="p-4 bg-gray-50 rounded-lg">
                                                    <span class="text-gray-600 font-medium block mb-2">{{ __('Description') }}</span>
                                                    <p class="text-gray-900">{{ $inquiry->description }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @elseif($type === 'special_spare_part')
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        @if($inquiry->part_name)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Part Name') }}</span>
                                                <span class="font-semibold text-gray-900">{{ $inquiry->part_name }}</span>
                                            </div>
                                        @endif
                                        @if($inquiry->car_brand)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Brand') }}</span>
                                                <span class="font-semibold text-gray-900">{{ $inquiry->car_brand }}</span>
                                            </div>
                                        @endif
                                        @if($inquiry->car_model)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Model') }}</span>
                                                <span class="font-semibold text-gray-900">{{ $inquiry->car_model }}</span>
                                            </div>
                                        @endif
                                        @if($inquiry->car_year)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Year') }}</span>
                                                <span class="font-semibold text-gray-900">{{ $inquiry->car_year }}</span>
                                            </div>
                                        @endif
                                        @if($inquiry->description)
                                            <div class="md:col-span-2">
                                                <div class="p-4 bg-gray-50 rounded-lg">
                                                    <span class="text-gray-600 font-medium block mb-2">{{ __('Description') }}</span>
                                                    <p class="text-gray-900">{{ $inquiry->description }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        @if($inquiry->vin_number)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg md:col-span-2">
                                                <span class="text-gray-600 font-medium">{{ __('VIN Number') }}</span>
                                                <span class="font-mono text-gray-900">{{ $inquiry->vin_number }}</span>
                                            </div>
                                        @endif
                                        @if($inquiry->car_brand)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Brand') }}</span>
                                                <span class="font-semibold text-gray-900">{{ $inquiry->car_brand }}</span>
                                            </div>
                                        @endif
                                        @if($inquiry->car_model)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <span class="text-gray-600 font-medium">{{ __('Model') }}</span>
                                                <span class="font-semibold text-gray-900">{{ $inquiry->car_model }}</span>
                                            </div>
                                        @endif
                                        @if($inquiry->description)
                                            <div class="md:col-span-2">
                                                <div class="p-4 bg-gray-50 rounded-lg">
                                                    <span class="text-gray-600 font-medium block mb-2">{{ __('Description') }}</span>
                                                    <p class="text-gray-900">{{ $inquiry->description }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Status Updates -->
                    @if($inquiry->logs && $inquiry->logs->count() > 0)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ __('Status Updates') }}
                                </h3>

                                <div class="space-y-4">
                                    @foreach($inquiry->logs->sortByDesc('created_at') as $log)
                                        <div class="border-l-4 border-blue-500 pl-4 py-2">
                                            <div class="flex items-start justify-between">
                                                <div class="flex-1">
                                                    <div class="flex items-center mb-2">
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                            {{ $log->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                                               ($log->status === 'approved' ? 'bg-green-100 text-green-800' :
                                                               ($log->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                                            {{ __(ucfirst($log->status)) }}
                                                        </span>
                                                        <span class="text-sm text-gray-500 ml-3">{{ $log->created_at->format('Y/m/d H:i') }}</span>
                                                    </div>
                                                    <p class="text-gray-900">{{ $log->action }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Contact Information -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6 sticky top-6">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                {{ __('Need Help?') }}
                            </h3>
                            <p class="text-gray-600 mb-4 text-sm">
                                {{ __('If you have any questions about your inquiry, please contact our support team.') }}
                            </p>
                            <div class="space-y-3">
                                <a href="tel:+989123456789"
                                   class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg flex items-center justify-center transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                    </svg>
                                    {{ __('Call Support') }}
                                </a>
                                <a href="https://wa.me/989123456789?text=I need help with my inquiry #{{ $inquiry->id }}"
                                   target="_blank"
                                   class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-lg flex items-center justify-center transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"></path>
                                    </svg>
                                    {{ __('WhatsApp Support') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                                </svg>
                                {{ __('Quick Actions') }}
                            </h3>
                            <div class="space-y-3">
                                <a href="{{ route('inquiries.index') }}"
                                   class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg flex items-center justify-center transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    {{ __('All My Inquiries') }}
                                </a>
                                <a href="{{ route('home') }}"
                                   class="w-full bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-4 rounded-lg flex items-center justify-center transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    {{ __('Back to Home') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
