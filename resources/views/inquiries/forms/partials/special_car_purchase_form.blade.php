<x-inquiry-form-wrapper
    formType="special_car_purchase"
    formTitle="فرم خرید خودرو خاص"
    formAction="{{ route('inquiries.special_car_purchase.store') }}"
>
    <form id="car-purchase-form" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="phone" id="form_phone">

        <!-- Name fields for new users -->
        <div id="name-fields" class="hidden grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="form_first_name" value="نام" />
                <x-text-input id="form_first_name" name="first_name" type="text" class="mt-1 block w-full" />
            </div>
            <div>
                <x-input-label for="form_last_name" value="نام خانوادگی" />
                <x-text-input id="form_last_name" name="last_name" type="text" class="mt-1 block w-full" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="car_brand" value="برند خودرو" />
                <x-text-input id="car_brand" name="car_brand" type="text" class="mt-1 block w-full" />
            </div>
            <div>
                <x-input-label for="car_model" value="مدل خودرو" />
                <x-text-input id="car_model" name="car_model" type="text" class="mt-1 block w-full" />
            </div>
        </div>

        <div>
            <x-input-label for="car_year" value="سال ساخت" />
            <x-text-input id="car_year" name="car_year" type="number" class="mt-1 block w-full"
                         min="1900" max="2030" />
        </div>

        <div>
            <x-input-label for="description" value="توضیحات تکمیلی" />
            <textarea id="description" name="description" rows="4"
                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
        </div>

        <div class="flex items-center justify-end">
            <x-primary-button type="submit">
                ثبت درخواست
            </x-primary-button>
        </div>
    </form>

    <script>
        // Set phone value when form is shown
        if (typeof verifiedPhone !== 'undefined') {
            document.getElementById('form_phone').value = verifiedPhone;
        }

        // Handle form submission
        document.getElementById('car-purchase-form').addEventListener('submit', function(e) {
            e.preventDefault();
            // اطمینان از مقداردهی input مخفی phone
            document.getElementById('form_phone').value = verifiedPhone || document.getElementById('phone').value;
            console.log('form_phone value:', document.getElementById('form_phone').value);
            const formData = new FormData(this);
            window.submitInquiryForm(formData);
        });
    </script>
</x-inquiry-form-wrapper>
