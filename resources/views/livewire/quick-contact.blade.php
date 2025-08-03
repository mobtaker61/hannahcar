<div class="bg-white rounded-lg shadow-lg p-8">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-primary mb-4">{{ app()->getLocale() === 'fa' ? 'تماس سریع' : 'Quick Contact' }}</h2>
        <p class="text-secondary-text">{{ app()->getLocale() === 'fa' ? 'برای دریافت مشاوره رایگان با ما تماس بگیرید' : 'Contact us for free consultation' }}</p>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit="submit" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-primary mb-2 {{ app()->getLocale() === 'fa' ? 'text-right' : 'text-left' }}">
                    {{ app()->getLocale() === 'fa' ? 'نام و نام خانوادگی' : 'Full Name' }}
                </label>
                <input wire:model="name"
                       type="text"
                       id="name"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent {{ app()->getLocale() === 'fa' ? 'text-right' : 'text-left' }}"
                       placeholder="{{ app()->getLocale() === 'fa' ? 'نام خود را وارد کنید' : 'Enter your name' }}">
                @error('name')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-primary mb-2 {{ app()->getLocale() === 'fa' ? 'text-right' : 'text-left' }}">
                    {{ app()->getLocale() === 'fa' ? 'شماره تماس' : 'Phone Number' }}
                </label>
                <input wire:model="phone"
                       type="tel"
                       id="phone"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent {{ app()->getLocale() === 'fa' ? 'text-right' : 'text-left' }}"
                       placeholder="{{ app()->getLocale() === 'fa' ? 'شماره تماس خود را وارد کنید' : 'Enter your phone number' }}">
                @error('phone')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-primary mb-2 {{ app()->getLocale() === 'fa' ? 'text-right' : 'text-left' }}">
                {{ app()->getLocale() === 'fa' ? 'ایمیل' : 'Email' }}
            </label>
            <input wire:model="email"
                   type="email"
                   id="email"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent {{ app()->getLocale() === 'fa' ? 'text-right' : 'text-left' }}"
                   placeholder="{{ app()->getLocale() === 'fa' ? 'ایمیل خود را وارد کنید' : 'Enter your email' }}">
            @error('email')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="message" class="block text-sm font-medium text-primary mb-2 {{ app()->getLocale() === 'fa' ? 'text-right' : 'text-left' }}">
                {{ app()->getLocale() === 'fa' ? 'پیام' : 'Message' }}
            </label>
            <textarea wire:model="message"
                      id="message"
                      rows="4"
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent {{ app()->getLocale() === 'fa' ? 'text-right' : 'text-left' }}"
                      placeholder="{{ app()->getLocale() === 'fa' ? 'پیام خود را بنویسید...' : 'Write your message...' }}"></textarea>
            @error('message')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col sm:flex-row {{ app()->getLocale() === 'fa' ? 'space-y-reverse space-y-4 sm:space-y-0 sm:space-x-reverse sm:space-x-4' : 'space-y-4 sm:space-y-0 sm:space-x-4' }}">
            <button type="submit"
                    class="flex-1 bg-primary text-white py-3 px-6 rounded-lg font-semibold hover:bg-primary/90 transition-colors">
                {{ app()->getLocale() === 'fa' ? 'ارسال پیام' : 'Send Message' }}
            </button>

            <a href="tel:+989123456789"
               class="flex-1 bg-accent text-primary py-3 px-6 rounded-lg font-semibold hover:bg-accent/90 transition-colors text-center">
                <i class="fas fa-phone {{ app()->getLocale() === 'fa' ? 'ml-2' : 'mr-2' }}"></i>
                {{ app()->getLocale() === 'fa' ? 'تماس تلفنی' : 'Call Now' }}
            </a>

            <a href="https://wa.me/989123456789"
               target="_blank"
               class="flex-1 bg-green-500 text-white py-3 px-6 rounded-lg font-semibold hover:bg-green-600 transition-colors text-center">
                <i class="fab fa-whatsapp {{ app()->getLocale() === 'fa' ? 'ml-2' : 'mr-2' }}"></i>
                {{ app()->getLocale() === 'fa' ? 'واتساپ' : 'WhatsApp' }}
            </a>
        </div>
    </form>
</div>
