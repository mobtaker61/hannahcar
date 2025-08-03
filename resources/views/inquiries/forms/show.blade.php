<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $form->title }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('inquiry-forms.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Back to Forms') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Form Content -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">{{ __('Fill Out the Form') }}</h3>

                    <!-- Dynamic Form based on form type -->
                    @if($form->slug === 'special_car_purchase')
                        @include('inquiries.forms.partials.special_car_purchase_form')
                    @elseif($form->slug === 'special_spare_part')
                        @include('inquiries.forms.partials.special_spare_part_form')
                    @elseif($form->slug === 'vin_check')
                        @include('inquiries.forms.partials.vin_check_form')
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ __('Form Not Available') }}</h4>
                            <p class="text-gray-600">{{ __('This form is not yet implemented. Please contact support.') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Additional Information -->
            <div class="mt-8 bg-blue-50 rounded-xl p-6">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-blue-900">{{ __('Important Information') }}</h4>
                        <div class="mt-2 text-sm text-blue-700">
                            <ul class="list-disc list-inside space-y-1">
                                <li>{{ __('All fields marked with * are required') }}</li>
                                <li>{{ __('We will contact you within 24 hours') }}</li>
                                <li>{{ __('Your information is kept confidential') }}</li>
                                <li>{{ __('You will receive a tracking code after submission') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
