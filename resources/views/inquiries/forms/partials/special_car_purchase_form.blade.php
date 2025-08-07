<x-inquiry-form-wrapper
    formType="special_car_purchase"
    formTitle="فرم خرید خودرو خاص"
    formAction="{{ route('inquiries.special_car_purchase.store') }}"
>
    <form id="car-purchase-form" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="user_id" id="form_user_id">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="car_brand" value="برند خودرو" />
                <div class="relative">
                    <x-text-input id="car_brand" name="car_brand" type="text" class="mt-1 block w-full"
                                 placeholder="نام برند را تایپ کنید..." autocomplete="off" />
                    <div id="brand-suggestions" class="absolute z-10 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden max-h-60 overflow-y-auto"></div>
                </div>
                <input type="hidden" id="car_brand_id" name="car_brand_id" />
            </div>
            <div>
                <x-input-label for="car_model" value="مدل خودرو" />
                <select id="car_model" name="car_model" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" disabled>
                    <option value="">ابتدا برند را انتخاب کنید</option>
                </select>
                <input type="hidden" id="car_model_id" name="car_model_id" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="car_year" value="سال ساخت" />
                <select id="car_year" name="car_year" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">سال را انتخاب کنید</option>
                    @for($year = 2026; $year >= 2020; $year--)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <x-input-label for="delivery_location" value="محل تحویل" />
                <select id="delivery_location" name="delivery_location" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">محل تحویل را انتخاب کنید</option>
                    <option value="بندرهای جنوب ایران">بندرهای جنوب ایران</option>
                    <option value="تهران">تهران</option>
                    <option value="درب منزل">درب منزل</option>
                </select>
            </div>
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
        // Set user_id when form is shown
        if (typeof verifiedUser !== 'undefined' && verifiedUser && verifiedUser.id) {
            document.getElementById('form_user_id').value = verifiedUser.id;
        }

        // Brand search functionality
        const brandInput = document.getElementById('car_brand');
        const brandSuggestions = document.getElementById('brand-suggestions');
        const brandIdInput = document.getElementById('car_brand_id');
        const modelSelect = document.getElementById('car_model');
        const modelIdInput = document.getElementById('car_model_id');
        let brandSearchTimeout;

        brandInput.addEventListener('input', function() {
            const query = this.value.trim();

            // Clear timeout if user is still typing
            clearTimeout(brandSearchTimeout);

            if (query.length < 2) {
                brandSuggestions.classList.add('hidden');
                return;
            }

            // Set timeout to avoid too many requests
            brandSearchTimeout = setTimeout(() => {
                searchBrands(query);
            }, 300);
        });

        // Hide suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (!brandInput.contains(e.target) && !brandSuggestions.contains(e.target)) {
                brandSuggestions.classList.add('hidden');
            }
        });

        function searchBrands(query) {
            fetch(`/api/vehicle-brands`)
                .then(response => response.json())
                .then(brands => {
                    const filteredBrands = brands.filter(brand =>
                        brand.name.toLowerCase().includes(query.toLowerCase())
                    );

                    displayBrandSuggestions(filteredBrands);
                })
                .catch(error => {
                    console.error('Error fetching brands:', error);
                });
        }

        function displayBrandSuggestions(brands) {
            brandSuggestions.innerHTML = '';

            if (brands.length === 0) {
                brandSuggestions.innerHTML = '<div class="px-4 py-2 text-gray-500">برندی یافت نشد</div>';
            } else {
                brands.forEach(brand => {
                    const div = document.createElement('div');
                    div.className = 'px-4 py-2 hover:bg-gray-100 cursor-pointer border-b border-gray-200 last:border-b-0';
                    div.textContent = brand.name;
                    div.addEventListener('click', () => selectBrand(brand));
                    brandSuggestions.appendChild(div);
                });
            }

            brandSuggestions.classList.remove('hidden');
        }

        function selectBrand(brand) {
            brandInput.value = brand.name;
            brandIdInput.value = brand.id;
            brandSuggestions.classList.add('hidden');

            // Load models for selected brand
            loadModels(brand.id);
        }

        function loadModels(brandId) {
            // Reset model select
            modelSelect.innerHTML = '<option value="">در حال بارگذاری...</option>';
            modelSelect.disabled = true;
            modelIdInput.value = '';

            fetch(`/api/vehicle-models/${brandId}`)
                .then(response => response.json())
                .then(models => {
                    modelSelect.innerHTML = '<option value="">مدل را انتخاب کنید</option>';

                    models.forEach(model => {
                        const option = document.createElement('option');
                        option.value = model.name;
                        option.textContent = model.name;
                        option.dataset.modelId = model.id;
                        modelSelect.appendChild(option);
                    });

                    modelSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Error fetching models:', error);
                    modelSelect.innerHTML = '<option value="">خطا در بارگذاری مدل‌ها</option>';
                });
        }

        // Handle model selection
        modelSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.dataset.modelId) {
                modelIdInput.value = selectedOption.dataset.modelId;
            } else {
                modelIdInput.value = '';
            }
        });

                // Handle form submission
        document.getElementById('car-purchase-form').addEventListener('submit', function(e) {
            e.preventDefault();

            // اطمینان از مقداردهی input مخفی user_id
            if (verifiedUser && verifiedUser.id) {
                document.getElementById('form_user_id').value = verifiedUser.id;
            }

            console.log('form_user_id value:', document.getElementById('form_user_id').value);
            console.log('verifiedUser:', verifiedUser);

            const formData = new FormData(this);
            window.submitInquiryForm(formData);
        });
    </script>
</x-inquiry-form-wrapper>
