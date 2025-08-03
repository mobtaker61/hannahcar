@props(['formType', 'formTitle', 'formAction'])

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        <!-- Phone Verification Section -->
        <div id="phone-verify-section" class="mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">تایید شماره تلفن</h3>
            <form id="phone-verify-form" class="space-y-4">
                @csrf

                <!-- Phone Number with Country Code -->
                <div>
                    <x-input-label for="phone" value="شماره تلفن همراه" />
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <!-- Phone Number Input -->
                        <x-text-input id="phone" name="phone" type="text"
                                     class="flex-1 rounded-r-none border-r-0 focus:z-10 focus:border-indigo-500 focus:ring-indigo-500"
                                     placeholder="مثلاً 09123456789" required />
                        <!-- Country Code Dropdown -->
                        <div class="relative flex items-stretch flex-grow-0">
                            <select id="country" name="country" class="h-full rounded-l-none border-l-0 focus:z-10 focus:border-indigo-500 focus:ring-indigo-500 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                <option value="+98" selected>🇮🇷 ایران (+98)</option>
                                <option value="+1">🇺🇸 آمریکا (+1)</option>
                                <option value="+44">🇬🇧 انگلستان (+44)</option>
                                <option value="+49">🇩🇪 آلمان (+49)</option>
                                <option value="+33">🇫🇷 فرانسه (+33)</option>
                                <option value="+39">🇮🇹 ایتالیا (+39)</option>
                                <option value="+34">🇪🇸 اسپانیا (+34)</option>
                                <option value="+31">🇳🇱 هلند (+31)</option>
                                <option value="+32">🇧🇪 بلژیک (+32)</option>
                                <option value="+41">🇨🇭 سوئیس (+41)</option>
                                <option value="+43">🇦🇹 اتریش (+43)</option>
                                <option value="+46">🇸🇪 سوئد (+46)</option>
                                <option value="+47">🇳🇴 نروژ (+47)</option>
                                <option value="+45">🇩🇰 دانمارک (+45)</option>
                                <option value="+358">🇫🇮 فنلاند (+358)</option>
                                <option value="+48">🇵🇱 لهستان (+48)</option>
                                <option value="+420">🇨🇿 جمهوری چک (+420)</option>
                                <option value="+36">🇭🇺 مجارستان (+36)</option>
                                <option value="+380">🇺🇦 اوکراین (+380)</option>
                                <option value="+7">🇷🇺 روسیه (+7)</option>
                                <option value="+90">🇹🇷 ترکیه (+90)</option>
                                <option value="+971">🇦🇪 امارات (+971)</option>
                                <option value="+966">🇸🇦 عربستان (+966)</option>
                                <option value="+965">🇰🇼 کویت (+965)</option>
                                <option value="+973">🇧🇭 بحرین (+973)</option>
                                <option value="+974">🇶🇦 قطر (+974)</option>
                                <option value="+968">🇴🇲 عمان (+968)</option>
                                <option value="+962">🇯🇴 اردن (+962)</option>
                                <option value="+961">🇱🇧 لبنان (+961)</option>
                                <option value="+963">🇸🇾 سوریه (+963)</option>
                                <option value="+964">🇮🇶 عراق (+964)</option>
                                <option value="+20">🇪🇬 مصر (+20)</option>
                                <option value="+212">🇲🇦 مراکش (+212)</option>
                                <option value="+216">🇹🇳 تونس (+216)</option>
                                <option value="+213">🇩🇿 الجزایر (+213)</option>
                                <option value="+218">🇱🇾 لیبی (+218)</option>
                                <option value="+249">🇸🇩 سودان (+249)</option>
                                <option value="+251">🇪🇹 اتیوپی (+251)</option>
                                <option value="+254">🇰🇪 کنیا (+254)</option>
                                <option value="+27">🇿🇦 آفریقای جنوبی (+27)</option>
                                <option value="+234">🇳🇬 نیجریه (+234)</option>
                                <option value="+233">🇬🇭 غنا (+233)</option>
                                <option value="+225">🇨🇮 ساحل عاج (+225)</option>
                                <option value="+237">🇨🇲 کامرون (+237)</option>
                                <option value="+236">🇨🇫 جمهوری آفریقای مرکزی (+236)</option>
                                <option value="+235">🇹🇩 چاد (+235)</option>
                                <option value="+241">🇬🇦 گابن (+241)</option>
                                <option value="+242">🇨🇬 جمهوری کنگو (+242)</option>
                                <option value="+243">🇨🇩 جمهوری دموکراتیک کنگو (+243)</option>
                                <option value="+244">🇦🇴 آنگولا (+244)</option>
                                <option value="+245">🇬🇼 گینه بیسائو (+245)</option>
                                <option value="+246">🇧🇮 بوروندی (+246)</option>
                                <option value="+247">🇦🇨 جزیره آسنشن (+247)</option>
                                <option value="+248">🇸🇨 سیشل (+248)</option>
                                <option value="+249">🇸🇩 سودان (+249)</option>
                                <option value="+250">🇷🇼 رواندا (+250)</option>
                                <option value="+251">🇪🇹 اتیوپی (+251)</option>
                                <option value="+252">🇸🇴 سومالی (+252)</option>
                                <option value="+253">🇩🇯 جیبوتی (+253)</option>
                                <option value="+254">🇰🇪 کنیا (+254)</option>
                                <option value="+255">🇹🇿 تانزانیا (+255)</option>
                                <option value="+256">🇺🇬 اوگاندا (+256)</option>
                                <option value="+257">🇧🇮 بوروندی (+257)</option>
                                <option value="+258">🇲🇿 موزامبیک (+258)</option>
                                <option value="+260">🇿🇲 زامبیا (+260)</option>
                                <option value="+261">🇲🇬 ماداگاسکار (+261)</option>
                                <option value="+262">🇷🇪 رئونیون (+262)</option>
                                <option value="+263">🇿🇼 زیمبابوه (+263)</option>
                                <option value="+264">🇳🇦 نامیبیا (+264)</option>
                                <option value="+265">🇲🇼 مالاوی (+265)</option>
                                <option value="+266">🇱🇸 لسوتو (+266)</option>
                                <option value="+267">🇧🇼 بوتسوانا (+267)</option>
                                <option value="+268">🇸🇿 اسواتینی (+268)</option>
                                <option value="+269">🇰🇲 کومور (+269)</option>
                                <option value="+290">🇸🇭 سنت هلنا (+290)</option>
                                <option value="+291">🇪🇷 اریتره (+291)</option>
                                <option value="+297">🇦🇼 آروبا (+297)</option>
                                <option value="+298">🇫🇴 جزایر فارو (+298)</option>
                                <option value="+299">🇬🇱 گرینلند (+299)</option>
                                <option value="+350">🇬🇮 جبل الطارق (+350)</option>
                                <option value="+351">🇵🇹 پرتغال (+351)</option>
                                <option value="+352">🇱🇺 لوکزامبورگ (+352)</option>
                                <option value="+353">🇮🇪 ایرلند (+353)</option>
                                <option value="+354">🇮🇸 ایسلند (+354)</option>
                                <option value="+355">🇦🇱 آلبانی (+355)</option>
                                <option value="+356">🇲🇹 مالت (+356)</option>
                                <option value="+357">🇨🇾 قبرس (+357)</option>
                                <option value="+358">🇫🇮 فنلاند (+358)</option>
                                <option value="+359">🇧🇬 بلغارستان (+359)</option>
                                <option value="+370">🇱🇹 لیتوانی (+370)</option>
                                <option value="+371">🇱🇻 لتونی (+371)</option>
                                <option value="+372">🇪🇪 استونی (+372)</option>
                                <option value="+373">🇲🇩 مولداوی (+373)</option>
                                <option value="+374">🇦🇲 ارمنستان (+374)</option>
                                <option value="+375">🇧🇾 بلاروس (+375)</option>
                                <option value="+376">🇦🇩 آندورا (+376)</option>
                                <option value="+377">🇲🇨 موناکو (+377)</option>
                                <option value="+378">🇸🇲 سن مارینو (+378)</option>
                                <option value="+379">🇻🇦 واتیکان (+379)</option>
                                <option value="+380">🇺🇦 اوکراین (+380)</option>
                                <option value="+381">🇷🇸 صربستان (+381)</option>
                                <option value="+382">🇲🇪 مونته‌نگرو (+382)</option>
                                <option value="+383">🇽🇰 کوزوو (+383)</option>
                                <option value="+385">🇭🇷 کرواسی (+385)</option>
                                <option value="+386">🇸🇮 اسلوونی (+386)</option>
                                <option value="+387">🇧🇦 بوسنی و هرزگوین (+387)</option>
                                <option value="+389">🇲🇰 مقدونیه شمالی (+389)</option>
                                <option value="+420">🇨🇿 جمهوری چک (+420)</option>
                                <option value="+421">🇸🇰 اسلواکی (+421)</option>
                                <option value="+423">🇱🇮 لیختن‌اشتاین (+423)</option>
                                <option value="+501">🇧🇿 بلیز (+501)</option>
                                <option value="+502">🇬🇹 گواتمالا (+502)</option>
                                <option value="+503">🇸🇻 السالوادور (+503)</option>
                                <option value="+504">🇭🇳 هندوراس (+504)</option>
                                <option value="+505">🇳🇮 نیکاراگوئه (+505)</option>
                                <option value="+506">🇨🇷 کاستاریکا (+506)</option>
                                <option value="+507">🇵🇦 پاناما (+507)</option>
                                <option value="+508">🇵🇲 سنت پیر و میکلون (+508)</option>
                                <option value="+509">🇭🇹 هائیتی (+509)</option>
                                <option value="+590">🇬🇵 گوادلوپ (+590)</option>
                                <option value="+591">🇧🇴 بولیوی (+591)</option>
                                <option value="+592">🇬🇾 گویان (+592)</option>
                                <option value="+593">🇪🇨 اکوادور (+593)</option>
                                <option value="+594">🇬🇫 گویان فرانسه (+594)</option>
                                <option value="+595">🇵🇾 پاراگوئه (+595)</option>
                                <option value="+596">🇲🇶 مارتینیک (+596)</option>
                                <option value="+597">🇸🇷 سورینام (+597)</option>
                                <option value="+598">🇺🇾 اروگوئه (+598)</option>
                                <option value="+599">🇧🇶 بونیر (+599)</option>
                                <option value="+670">🇹🇱 تیمور شرقی (+670)</option>
                                <option value="+672">🇦🇶 قلمرو جنوبی استرالیا (+672)</option>
                                <option value="+673">🇧🇳 برونئی (+673)</option>
                                <option value="+674">🇳🇷 نائورو (+674)</option>
                                <option value="+675">🇵🇬 پاپوآ گینه نو (+675)</option>
                                <option value="+676">🇹🇴 تونگا (+676)</option>
                                <option value="+677">🇸🇧 جزایر سلیمان (+677)</option>
                                <option value="+678">🇻🇺 وانواتو (+678)</option>
                                <option value="+679">🇫🇯 فیجی (+679)</option>
                                <option value="+680">🇵🇼 پالائو (+680)</option>
                                <option value="+681">🇼🇫 والیس و فوتونا (+681)</option>
                                <option value="+682">🇨🇰 جزایر کوک (+682)</option>
                                <option value="+683">🇳🇺 نیوئه (+683)</option>
                                <option value="+685">🇼🇸 ساموآ (+685)</option>
                                <option value="+686">🇰🇮 کیریباتی (+686)</option>
                                <option value="+687">🇳🇨 کالدونیای جدید (+687)</option>
                                <option value="+688">🇹🇻 تووالو (+688)</option>
                                <option value="+689">🇵🇫 پلینزی فرانسه (+689)</option>
                                <option value="+690">🇹🇰 توکلائو (+690)</option>
                                <option value="+691">🇫🇲 میکرونزی (+691)</option>
                                <option value="+692">🇲🇭 جزایر مارشال (+692)</option>
                                <option value="+850">🇰🇵 کره شمالی (+850)</option>
                                <option value="+852">🇭🇰 هنگ کنگ (+852)</option>
                                <option value="+853">🇲🇴 ماکائو (+853)</option>
                                <option value="+855">🇰🇭 کامبوج (+855)</option>
                                <option value="+856">🇱🇦 لائوس (+856)</option>
                                <option value="+880">🇧🇩 بنگلادش (+880)</option>
                                <option value="+886">🇹🇼 تایوان (+886)</option>
                                <option value="+960">🇲🇻 مالدیو (+960)</option>
                                <option value="+961">🇱🇧 لبنان (+961)</option>
                                <option value="+962">🇯🇴 اردن (+962)</option>
                                <option value="+963">🇸🇾 سوریه (+963)</option>
                                <option value="+964">🇮🇶 عراق (+964)</option>
                                <option value="+965">🇰🇼 کویت (+965)</option>
                                <option value="+966">🇸🇦 عربستان (+966)</option>
                                <option value="+967">🇾🇪 یمن (+967)</option>
                                <option value="+968">🇴🇲 عمان (+968)</option>
                                <option value="+970">🇵🇸 فلسطين (+970)</option>
                                <option value="+971">🇦🇪 امارات (+971)</option>
                                <option value="+972">🇮🇱 اسرائیل (+972)</option>
                                <option value="+973">🇧🇭 بحرین (+973)</option>
                                <option value="+974">🇶🇦 قطر (+974)</option>
                                <option value="+975">🇧🇹 بوتان (+975)</option>
                                <option value="+976">🇲🇳 مغولستان (+976)</option>
                                <option value="+977">🇳🇵 نپال (+977)</option>
                                <option value="+992">🇹🇯 تاجیکستان (+992)</option>
                                <option value="+993">🇹🇲 ترکمنستان (+993)</option>
                                <option value="+994">🇦🇿 جمهوری آذربایجان (+994)</option>
                                <option value="+995">🇬🇪 گرجستان (+995)</option>
                                <option value="+996">🇰🇬 قرقیزستان (+996)</option>
                                <option value="+998">🇺🇿 ازبکستان (+998)</option>
                                <option value="+1242">🇧🇸 باهاما (+1242)</option>
                                <option value="+1246">🇧🇧 باربادوس (+1246)</option>
                                <option value="+1264">🇦🇮 آنگویلا (+1264)</option>
                                <option value="+1268">🇦🇬 آنتیگوا و باربودا (+1268)</option>
                                <option value="+1284">🇻🇬 جزایر ویرجین بریتانیا (+1284)</option>
                                <option value="+1340">🇻🇮 جزایر ویرجین ایالات متحده (+1340)</option>
                                <option value="+1345">🇰🇾 جزایر کیمن (+1345)</option>
                                <option value="+1441">🇧🇲 برمودا (+1441)</option>
                                <option value="+1473">🇬🇩 گرنادا (+1473)</option>
                                <option value="+1649">🇹🇨 جزایر تورکس و کایکوس (+1649)</option>
                                <option value="+1664">🇲🇸 مونت‌سرات (+1664)</option>
                                <option value="+1758">🇱🇨 سنت لوسیا (+1758)</option>
                                <option value="+1767">🇩🇲 دومینیکا (+1767)</option>
                                <option value="+1784">🇻🇨 سنت وینسنت و گرنادین‌ها (+1784)</option>
                                <option value="+1787">🇵🇷 پورتوریکو (+1787)</option>
                                <option value="+1809">🇩🇴 جمهوری دومینیکن (+1809)</option>
                                <option value="+1868">🇹🇹 ترینیداد و توباگو (+1868)</option>
                                <option value="+1869">🇰🇳 سنت کیتس و نویس (+1869)</option>
                                <option value="+1876">🇯🇲 جامائیکا (+1876)</option>
                                <option value="+1939">🇵🇷 پورتوریکو (+1939)</option>
                            </select>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('phone')" />
                </div>

                <!-- Verification Method Buttons -->
                <div>
                    <x-input-label value="روش ارسال کد تایید" />
                    <div class="mt-2 flex space-x-3 space-x-reverse">
                        <button type="button" id="sms-btn" class="flex-1 flex items-center justify-center px-4 py-3 border border-blue-300 rounded-md shadow-sm bg-blue-50 text-sm font-medium text-blue-700 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 verification-method-btn active" data-method="sms">
                            <span class="text-lg mr-2">📱</span>
                            <span>ارسال SMS</span>
                        </button>
                        <button type="button" id="whatsapp-btn" class="flex-1 flex items-center justify-center px-4 py-3 border border-green-300 rounded-md shadow-sm bg-green-50 text-sm font-medium text-green-700 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 verification-method-btn" data-method="whatsapp">
                            <span class="text-lg mr-2">💬</span>
                            <span>ارسال WhatsApp</span>
                        </button>
                    </div>
                    <input type="hidden" name="verification_method" id="verification_method" value="sms">
                </div>
            </form>

            <!-- Verification Code Section -->
            <div id="verify-code-section" class="mt-6 hidden">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="text-sm font-medium text-gray-900 mb-2">کد وریفای ارسال شده</h4>
                    <div class="flex space-x-2 space-x-reverse">
                        <x-text-input id="verify_code" name="verify_code" type="text"
                                     class="block w-full text-center text-lg font-mono"
                                     maxlength="6" placeholder="000000" />
                        <x-primary-button type="button" onclick="verifyCode()">
                            تایید
                        </x-primary-button>
                    </div>
                    <div class="mt-2 text-sm text-gray-600">
                        کد تست: <span id="test-code" class="font-bold text-green-600"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Info Section (shown after verification) -->
        <div id="user-info-section" class="hidden">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-user-circle text-blue-600 text-2xl"></i>
                    </div>
                    <div class="mr-3">
                        <h4 class="text-sm font-medium text-blue-900" id="user-name">نام کاربر</h4>
                        <p class="text-sm text-blue-700" id="user-phone">شماره تلفن</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dynamic Form Content -->
        <div id="dynamic-form-container" class="hidden">
            {{ $slot }}
        </div>

        <!-- Success Message -->
        <div id="success-message" class="hidden">
            <div class="bg-green-50 border border-green-200 rounded-lg p-6 text-center">
                <div class="flex items-center justify-center mb-4">
                    <i class="fas fa-check-circle text-green-600 text-3xl"></i>
                </div>
                <h3 class="text-lg font-medium text-green-900 mb-2">درخواست با موفقیت ثبت شد</h3>
                <p class="text-green-700 mb-4">کد پیگیری شما: <span id="inquiry-code" class="font-bold text-lg"></span></p>
                <p class="text-sm text-green-600">کارشناسان ما در اسرع وقت با شما تماس خواهند گرفت.</p>
            </div>
        </div>
    </div>
</div>

<script>
    let verifiedPhone = '';
    let verifiedUser = null;
    const formType = '{{ $formType }}';
    const formAction = '{{ $formAction }}';

    // Update country code display when country changes
    document.getElementById('country').addEventListener('change', function() {
        // No need to update display since we're using a dropdown now
    });

        // Handle verification method button clicks
    document.querySelectorAll('.verification-method-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const method = this.dataset.method;

            // Remove active class from all buttons
            document.querySelectorAll('.verification-method-btn').forEach(b => {
                if (b.dataset.method === 'sms') {
                    b.classList.remove('active', 'bg-blue-100', 'border-blue-500', 'text-blue-800');
                    b.classList.add('bg-blue-50', 'border-blue-300', 'text-blue-700');
                } else if (b.dataset.method === 'whatsapp') {
                    b.classList.remove('active', 'bg-green-100', 'border-green-500', 'text-green-800');
                    b.classList.add('bg-green-50', 'border-green-300', 'text-green-700');
                }
            });

            // Add active class to clicked button
            if (method === 'sms') {
                this.classList.remove('bg-blue-50', 'border-blue-300', 'text-blue-700');
                this.classList.add('active', 'bg-blue-100', 'border-blue-500', 'text-blue-800');
            } else if (method === 'whatsapp') {
                this.classList.remove('bg-green-50', 'border-green-300', 'text-green-700');
                this.classList.add('active', 'bg-green-100', 'border-green-500', 'text-green-800');
            }

            // Update hidden input
            document.getElementById('verification_method').value = method;

            // Send verification code immediately
            sendVerificationCode(method);
        });
    });

    // Function to send verification code
    function sendVerificationCode(method) {
        const phone = document.getElementById('phone').value;
        const countryCode = document.getElementById('country').value;
        const fullPhone = countryCode + phone;

        if (!phone.trim()) {
            alert('لطفاً شماره تلفن را وارد کنید');
            return;
        }

        // Disable buttons during sending
        document.querySelectorAll('.verification-method-btn').forEach(btn => {
            btn.disabled = true;
            btn.innerHTML = '<span class="text-sm">در حال ارسال...</span>';
        });

        fetch('{{ route("inquiries.phone.verify") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                phone: fullPhone,
                verification_method: method
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById('verify-code-section').classList.remove('hidden');
                document.getElementById('test-code').textContent = data.verify_code;
                document.getElementById('phone').disabled = true;
                document.getElementById('country').disabled = true;

                // Show success message (removed alert)
                const methodText = method === 'sms' ? 'SMS' : 'WhatsApp';
            } else {
                alert(data.message || 'خطا در ارسال کد');
            }
        })
        .catch(error => {
            alert('خطا در ارسال کد: ' + error.message);
        })
        .finally(() => {
            // Re-enable buttons
            document.querySelectorAll('.verification-method-btn').forEach(btn => {
                btn.disabled = false;
                const method = btn.dataset.method;
                if (method === 'sms') {
                    btn.innerHTML = '<span class="text-lg mr-2">📱</span><span>ارسال SMS</span>';
                } else if (method === 'whatsapp') {
                    btn.innerHTML = '<span class="text-lg mr-2">💬</span><span>ارسال WhatsApp</span>';
                }
            });
        });
    }

    // بررسی لاگین بودن کاربر در ابتدای صفحه
    @if(auth()->check())
        // کاربر لاگین کرده، اطلاعات را پر کن و فرم را نمایش بده
        verifiedPhone = '{{ auth()->user()->phone }}';
        verifiedUser = {
            name: '{{ auth()->user()->name }}',
            phone: '{{ auth()->user()->phone }}'
        };
        document.getElementById('user-name').textContent = verifiedUser.name;
        document.getElementById('user-phone').textContent = verifiedUser.phone;
        document.getElementById('user-info-section').classList.remove('hidden');
        document.getElementById('dynamic-form-container').classList.remove('hidden');
        document.getElementById('phone-verify-section').classList.add('hidden');
        // اگر کاربر قبلاً ثبت‌نام کرده، فیلدهای نام را مخفی کن
        const nameFields = document.getElementById('name-fields');
        if (nameFields) {
            nameFields.classList.add('hidden');
        }
    @endif

    // Prevent form submission (buttons handle it now)
    document.getElementById('phone-verify-form').addEventListener('submit', function(e) {
        e.preventDefault();
    });

    // Verify code
    function verifyCode() {
        const code = document.getElementById('verify_code').value;
        const phone = document.getElementById('phone').value;
        const countryCode = document.getElementById('country').value;
        const fullPhone = countryCode + phone;

        // بررسی وجود کاربر با شماره تلفن
        fetch("{{ route('inquiries.check_user') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ phone: fullPhone })
        })
        .then(res => res.json())
        .then(data => {
            verifiedPhone = fullPhone;
            if (data.exists) {
                // کاربر قبلاً ثبت‌نام کرده، لاگین کن
                return fetch("{{ route('inquiries.login_user') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ phone: fullPhone })
                });
            } else {
                // کاربر جدید است - نمایش فرم نام و نام خانوادگی
                verifiedUser = { name: '', phone: fullPhone };
                document.getElementById('user-name').textContent = 'کاربر جدید';
                document.getElementById('user-phone').textContent = fullPhone;
                document.getElementById('user-info-section').classList.remove('hidden');
                document.getElementById('dynamic-form-container').classList.remove('hidden');
                document.getElementById('phone-verify-section').classList.add('hidden');
                // نمایش فیلدهای نام و نام خانوادگی
                const nameFields = document.getElementById('name-fields');
                if (nameFields) {
                    nameFields.classList.remove('hidden');
                }
                return Promise.resolve({ success: true, isNewUser: true });
            }
        })
        .then(res => {
            if (res && res.json) {
                return res.json();
            }
            return res;
        })
        .then(data => {
            if (data.success && !data.isNewUser) {
                // کاربر قبلاً ثبت‌نام کرده و لاگین شد
                verifiedUser = { name: 'کاربر ثبت‌نام شده', phone: fullPhone };
                document.getElementById('user-name').textContent = verifiedUser.name;
                document.getElementById('user-phone').textContent = verifiedUser.phone;
                document.getElementById('user-info-section').classList.remove('hidden');
                document.getElementById('dynamic-form-container').classList.remove('hidden');
                document.getElementById('phone-verify-section').classList.add('hidden');
                // مخفی کردن فیلدهای نام و نام خانوادگی
                const nameFields = document.getElementById('name-fields');
                if (nameFields) {
                    nameFields.classList.add('hidden');
                }
            }
        });
    }

    // Global function to submit form
    window.submitInquiryForm = function(formData) {
        // اگر کاربر جدید است و فیلدهای نام پر شده، ابتدا ثبت نام کن
        const nameFields = document.getElementById('name-fields');
        if (nameFields && !nameFields.classList.contains('hidden')) {
            const firstName = document.getElementById('form_first_name').value.trim();
            const lastName = document.getElementById('form_last_name').value.trim();
            const phone = document.getElementById('form_phone').value.trim();

            if (!firstName || !lastName || !phone) {
                alert('لطفاً نام، نام خانوادگی و شماره تلفن را وارد کنید');
                return Promise.reject('validation.required');
            }
            // ابتدا کاربر را ثبت نام کن
            return fetch("{{ route('inquiries.register_user') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ phone: phone, first_name: firstName, last_name: lastName })
            })
            .then(async res => {
                if (!res.ok) {
                    let err = await res.json().catch(() => ({}));
                    throw err;
                }
                return res.json();
            })
            .then(data => {
                if (data.success) {
                    // سپس لاگین کن
                    return fetch("{{ route('inquiries.login_user') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({ phone: phone })
                    });
                } else {
                    throw new Error(data.message || 'خطا در ثبت نام');
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // حالا فرم اصلی را ارسال کن
                    return submitFormData(formData);
                } else {
                    throw new Error(data.message || 'خطا در ورود');
                }
            })
            .catch(error => {
                if (error && error.errors) {
                    alert(Object.values(error.errors).flat().join('\n'));
                } else {
                    alert('خطا در ارسال فرم: ' + (error.message || error));
                }
            });
        } else {
            // کاربر قبلاً ثبت‌نام کرده، مستقیماً فرم را ارسال کن
            return submitFormData(formData);
        }
    };

    // تابع جداگانه برای ارسال فرم
    function submitFormData(formData) {
        // تبدیل FormData به object
        const formDataObj = {};
        for (let [key, value] of formData.entries()) {
            formDataObj[key] = value;
        }

        return fetch(formAction, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formDataObj)
        })
        .then(res => {
            console.log('Response status:', res.status);
            console.log('Response headers:', res.headers);

            if (!res.ok) {
                return res.text().then(text => {
                    console.log('Error response body:', text);
                    throw new Error(`HTTP error! status: ${res.status}`);
                });
            }
            return res.json();
        })
        .then(data => {
            console.log('Success response:', data);
            if (data.success) {
                document.getElementById('dynamic-form-container').classList.add('hidden');
                document.getElementById('success-message').classList.remove('hidden');
                document.getElementById('inquiry-code').textContent = data.inquiry_id;
            } else {
                alert(data.message || 'خطا در ثبت فرم');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('خطا در ارسال فرم: ' + error.message);
        });
    }
</script>
