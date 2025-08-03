<x-admin-layout>
    <x-slot name="header">
        نمایش تنظیم: {{ $setting->translations->first()?->label ?? $setting->key }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">جزئیات تنظیم</h2>
                        <div class="flex space-x-2 space-x-reverse">
                            <a href="{{ route('admin.settings.edit', $setting) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-edit ml-2"></i>
                                ویرایش
                            </a>
                            <a href="{{ route('admin.settings.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                بازگشت
                            </a>
                        </div>
                    </div>

                    <!-- Basic Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">اطلاعات پایه</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">کلید تنظیم</label>
                                <div class="bg-gray-100 px-3 py-2 rounded-md">
                                    <code class="text-sm text-gray-900">{{ $setting->key }}</code>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">گروه</label>
                                <div class="bg-gray-100 px-3 py-2 rounded-md">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $setting->group }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">نوع</label>
                                <div class="bg-gray-100 px-3 py-2 rounded-md">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $setting->type }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">وضعیت</label>
                                <div class="bg-gray-100 px-3 py-2 rounded-md">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $setting->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $setting->is_active ? 'فعال' : 'غیرفعال' }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">مقدار پیش‌فرض</label>
                                <div class="bg-gray-100 px-3 py-2 rounded-md">
                                    {{ $setting->default_value ?: '-' }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">ترتیب نمایش</label>
                                <div class="bg-gray-100 px-3 py-2 rounded-md">
                                    {{ $setting->sort_order }}
                                </div>
                            </div>
                        </div>

                        @if($setting->options)
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">گزینه‌ها</label>
                                <div class="bg-gray-100 px-3 py-2 rounded-md">
                                    <pre class="text-sm text-gray-900 whitespace-pre-wrap">{{ $setting->options }}</pre>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Translations -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">ترجمه‌ها</h3>
                        <div class="space-y-6">
                            @foreach($setting->translations as $translation)
                                <div class="border border-gray-200 rounded-lg p-6">
                                    <h4 class="text-md font-medium text-gray-900 mb-4 flex items-center">
                                        <span class="w-6 h-6 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center text-sm font-bold ml-2">
                                            {{ strtoupper($translation->language->code) }}
                                        </span>
                                        {{ $translation->language->native_name }}
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $translation->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} mr-2">
                                            {{ $translation->is_active ? 'فعال' : 'غیرفعال' }}
                                        </span>
                                    </h4>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">برچسب</label>
                                            <div class="bg-gray-50 px-3 py-2 rounded-md">
                                                {{ $translation->label }}
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">مقدار</label>
                                            <div class="bg-gray-50 px-3 py-2 rounded-md">
                                                @if($setting->type === 'color')
                                                    <div class="flex items-center">
                                                        <div class="w-6 h-6 rounded-full border border-gray-300 ml-2" style="background-color: {{ $translation->value }}"></div>
                                                        <span class="text-sm text-gray-900">{{ $translation->value ?: '-' }}</span>
                                                    </div>
                                                @elseif($setting->type === 'boolean')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $translation->value ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                        {{ $translation->value ? 'بله' : 'خیر' }}
                                                    </span>
                                                @elseif($setting->type === 'url')
                                                    <a href="{{ $translation->value }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                        {{ $translation->value ?: '-' }}
                                                    </a>
                                                @elseif($setting->type === 'email')
                                                    <a href="mailto:{{ $translation->value }}" class="text-blue-600 hover:text-blue-800">
                                                        {{ $translation->value ?: '-' }}
                                                    </a>
                                                @else
                                                    {{ $translation->value ?: '-' }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    @if($translation->description)
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">توضیحات</label>
                                            <div class="bg-gray-50 px-3 py-2 rounded-md">
                                                {{ $translation->description }}
                                            </div>
                                        </div>
                                    @endif

                                    @if($translation->help_text)
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">متن راهنما</label>
                                            <div class="bg-gray-50 px-3 py-2 rounded-md">
                                                {{ $translation->help_text }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        @if($setting->translations->count() === 0)
                            <div class="text-center py-8">
                                <i class="fas fa-language text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-500">هیچ ترجمه‌ای برای این تنظیم وجود ندارد.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Setting Preview -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">پیش‌نمایش تنظیم</h3>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                            <div class="max-w-md">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ $setting->translations->first()?->label ?? $setting->key }}
                                </label>

                                @switch($setting->type)
                                    @case('textarea')
                                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md" rows="3" readonly>{{ $setting->translations->first()?->value ?? $setting->default_value }}</textarea>
                                        @break

                                    @case('number')
                                        <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ $setting->translations->first()?->value ?? $setting->default_value }}" readonly>
                                        @break

                                    @case('email')
                                        <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ $setting->translations->first()?->value ?? $setting->default_value }}" readonly>
                                        @break

                                    @case('url')
                                        <input type="url" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ $setting->translations->first()?->value ?? $setting->default_value }}" readonly>
                                        @break

                                    @case('color')
                                        <input type="color" class="w-full h-10 border border-gray-300 rounded-md" value="{{ $setting->translations->first()?->value ?? $setting->default_value }}" readonly>
                                        @break

                                    @case('boolean')
                                        <div class="flex items-center">
                                            <input type="checkbox" class="h-4 w-4 text-blue-600" {{ ($setting->translations->first()?->value ?? $setting->default_value) ? 'checked' : '' }} disabled>
                                            <label class="mr-2 block text-sm text-gray-900">فعال</label>
                                        </div>
                                        @break

                                    @case('select')
                                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md" disabled>
                                            @if($setting->options)
                                                @foreach(explode("\n", $setting->options) as $option)
                                                    @php
                                                        $parts = explode('=', trim($option));
                                                        $value = $parts[0] ?? '';
                                                        $label = $parts[1] ?? $value;
                                                    @endphp
                                                    <option value="{{ $value }}" {{ ($setting->translations->first()?->value ?? $setting->default_value) == $value ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @break

                                    @default
                                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ $setting->translations->first()?->value ?? $setting->default_value }}" readonly>
                                @endswitch

                                @if($setting->translations->first()?->help_text)
                                    <p class="mt-1 text-sm text-gray-500">{{ $setting->translations->first()->help_text }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Usage Information -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-blue-900 mb-4">اطلاعات استفاده</h3>
                        <div class="space-y-4">
                            <div>
                                <h4 class="text-sm font-medium text-blue-800 mb-2">دسترسی در کد:</h4>
                                <div class="bg-blue-100 px-3 py-2 rounded-md">
                                    <code class="text-sm text-blue-900">setting('{{ $setting->key }}')</code>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-blue-800 mb-2">دسترسی در Blade:</h4>
                                <div class="bg-blue-100 px-3 py-2 rounded-md">
                                    <code class="text-sm text-blue-900">{{ '{{ setting(\'' . $setting->key . '\') }}' }}</code>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-blue-800 mb-2">دسترسی در JavaScript:</h4>
                                <div class="bg-blue-100 px-3 py-2 rounded-md">
                                    <code class="text-sm text-blue-900">window.settings.{{ $setting->key }}</code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
