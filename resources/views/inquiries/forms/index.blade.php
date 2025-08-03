<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Inquiry Forms') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('home') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Back to Home') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <!-- Forms Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($inquiryForms as $form)
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <div class="p-6">
                                    <!-- Icon -->
                                    <div class="w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto
                                        {{ $form->color === 'blue' ? 'bg-blue-100 text-blue-600' :
                                           ($form->color === 'green' ? 'bg-green-100 text-green-600' :
                                           ($form->color === 'purple' ? 'bg-purple-100 text-purple-600' :
                                           ($form->color === 'red' ? 'bg-red-100 text-red-600' :
                                           ($form->color === 'yellow' ? 'bg-yellow-100 text-yellow-600' :
                                           'bg-gray-100 text-gray-600')))) }}">
                                        @if($form->icon === 'car')
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                            </svg>
                                        @elseif($form->icon === 'spare-part')
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        @elseif($form->icon === 'vin-check')
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @else
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        @endif
                                    </div>

                                    <!-- Title -->
                                    <h3 class="text-xl font-bold text-gray-900 mb-3 text-center">
                                        {{ $form->title }}
                                    </h3>

                                    <!-- Description -->
                                    <p class="text-gray-600 text-center mb-6 leading-relaxed">
                                        {{ $form->description }}
                                    </p>

                                    <!-- Action Button -->
                                    <div class="text-center">
                                        <a href="{{ route('inquiry-forms.show', $form->slug) }}"
                                           class="inline-flex items-center px-6 py-3 {{ $form->color_class }} text-white font-medium rounded-lg transition-colors duration-200 shadow-lg">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            {{ __('Start Form') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    @if(Auth::check() && $userInquiries->count() > 0)
                        <!-- Recent Inquiries -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden sticky top-6">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    {{ __('Recent Inquiries') }}
                                </h3>
                                <div class="space-y-3">
                                    @foreach($userInquiries as $inquiry)
                                        <div class="border border-gray-200 rounded-lg p-3 hover:bg-gray-50 transition-colors">
                                            <div class="flex items-start justify-between">
                                                <div class="flex-1">
                                                    <div class="flex items-center mb-1">
                                                        <div class="w-6 h-6 rounded-full flex items-center justify-center mr-2
                                                            {{ $inquiry->form->color === 'blue' ? 'bg-blue-100 text-blue-600' :
                                                               ($inquiry->form->color === 'green' ? 'bg-green-100 text-green-600' :
                                                               ($inquiry->form->color === 'purple' ? 'bg-purple-100 text-purple-600' :
                                                               'bg-gray-100 text-gray-600')) }}">
                                                            @if($inquiry->form->icon === 'car')
                                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                                </svg>
                                                            @elseif($inquiry->form->icon === 'spare-part')
                                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                </svg>
                                                            @elseif($inquiry->form->icon === 'vin-check')
                                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                </svg>
                                                            @endif
                                                        </div>
                                                        <span class="text-sm font-medium text-gray-900">{{ $inquiry->form_title }}</span>
                                                    </div>
                                                    <div class="text-xs text-gray-500">{{ $inquiry->created_at->diffForHumans() }}</div>
                                                    <div class="text-xs text-gray-500">کد: {{ $inquiry->id }}</div>
                                                </div>
                                                <a href="{{ route('inquiries.show', ['type' => $inquiry->form_type, 'id' => $inquiry->id]) }}"
                                                   class="text-blue-600 hover:text-blue-800 text-sm">
                                                    {{ __('View') }}
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <p class="text-gray-500 text-sm">
                                        {{ __('Showing your latest inquiries. Click on any inquiry to view details.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Additional Info -->
            <div class="bg-gray-50 rounded-xl p-8 mt-8">
                <div class="text-center">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ __('How It Works') }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <span class="text-blue-600 font-bold text-lg">1</span>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-2">{{ __('Choose Form') }}</h4>
                            <p class="text-gray-600 text-sm">{{ __('Select the appropriate form for your inquiry type') }}</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <span class="text-green-600 font-bold text-lg">2</span>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-2">{{ __('Fill Details') }}</h4>
                            <p class="text-gray-600 text-sm">{{ __('Complete the form with your requirements') }}</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <span class="text-purple-600 font-bold text-lg">3</span>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-2">{{ __('Get Response') }}</h4>
                            <p class="text-gray-600 text-sm">{{ __('We will contact you with the best solution') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
