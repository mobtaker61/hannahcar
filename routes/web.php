<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\LanguageController;
use App\Models\Page;

// Language Routes
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Page Routes (for middleware)
Route::get('/page/{slug}', [HomeController::class, 'showPage'])->name('page.show');

// Dynamic Page Routes
/* $pages = Page::where('status', 'published')->get();
foreach ($pages as $page) {
    Route::get('/' . $page->slug, function() use ($page) {
        return app(HomeController::class)->showPage($page->slug);
    })->name('page.' . $page->slug);
}
 */
// Auth Routes
require __DIR__.'/auth.php';

// Admin Routes
require __DIR__.'/admin.php';

// Logout Route
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// User Routes (Protected)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');
    Route::view('profile', 'profile')->name('profile');
});

// Article Routes
Route::get('news', [App\Http\Controllers\ArticleController::class, 'index'])->name('news.index');
Route::get('news/{article:slug}', [App\Http\Controllers\ArticleController::class, 'show'])->name('news.show');
Route::get('news/category/{category:slug}', [App\Http\Controllers\ArticleController::class, 'category'])->name('news.category');
Route::post('news/{article}/comment', [App\Http\Controllers\ArticleController::class, 'storeComment'])->name('news.comment');
Route::post('news/{article}/like', [App\Http\Controllers\ArticleController::class, 'toggleLike'])->name('news.like');
Route::post('news/{article}/share', [App\Http\Controllers\ArticleController::class, 'share'])->name('news.share');
Route::get('news/rss', [App\Http\Controllers\ArticleController::class, 'rss'])->name('news.rss');

// Service Routes
Route::get('services', [App\Http\Controllers\ServiceController::class, 'index'])->name('services.index');
Route::get('services/{service:slug}', [App\Http\Controllers\ServiceController::class, 'show'])->name('services.show');

// Vehicle Routes
Route::get('vehicles', [App\Http\Controllers\VehicleController::class, 'index'])->name('vehicles.index');
Route::get('vehicles/{vehicle:slug}', [App\Http\Controllers\VehicleController::class, 'show'])->name('vehicles.show');

// Inquiry Routes - با middleware مناسب
Route::middleware(['web'])->group(function () {
    // API ثبت فرم خرید خودرو خاص
    Route::post('/inquiries/special-car-purchase', [App\Http\Controllers\InquirySpecialCarPurchaseController::class, 'store'])
        ->name('inquiries.special_car_purchase.store')
        ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

    // API ثبت فرم درخواست قطعه یدکی خاص
    Route::post('/inquiries/special-spare-part', [App\Http\Controllers\InquirySpecialSparePartController::class, 'store'])
        ->name('inquiries.special_spare_part.store')
        ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

    // API ثبت فرم استعلام VIN Number
    Route::post('/inquiries/vin-check', [App\Http\Controllers\InquiryVinCheckController::class, 'store'])
        ->name('inquiries.vin_check.store')
        ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

    // API ثبت نام کاربر جدید پس از وریفای شماره تلفن
    Route::post('/inquiries/register-user', function(\Illuminate\Http\Request $request) {
        $request->validate([
            'phone' => 'required|regex:/^\+\d{1,4}\d{7,15}$/',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
        ]);
        $user = \App\Models\User::findOrCreateByPhone($request->phone, $request->first_name, $request->last_name);
        return response()->json([
            'success' => true,
            'message' => 'نام شما با موفقیت ثبت شد.',
            'user_id' => $user->id,
        ]);
    })->name('inquiries.register_user')
      ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

    // API بررسی وجود کاربر با شماره تلفن
    Route::post('/inquiries/check-user', function(\Illuminate\Http\Request $request) {
        $request->validate(['phone' => 'required|regex:/^\+\d{1,4}\d{7,15}$/']);
        $exists = \App\Models\User::where('phone', $request->phone)->exists();
        return response()->json(['exists' => $exists]);
    })->name('inquiries.check_user')
      ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

    // API لاگین کردن کاربر جدید پس از ثبت نام
    Route::post('/inquiries/login-user', function(\Illuminate\Http\Request $request) {
        $request->validate([
            'phone' => 'required|regex:/^\+\d{1,4}\d{7,15}$/',
        ]);
        $user = \App\Models\User::where('phone', $request->phone)->first();
        if ($user) {
            \Illuminate\Support\Facades\Auth::login($user);
            return response()->json([
                'success' => true,
                'message' => 'ورود موفقیت‌آمیز',
                'user_id' => $user->id,
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'کاربر یافت نشد',
        ]);
    })->name('inquiries.login_user')
      ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

    // API دریافت کد وریفای تستی (برای کامپوننت wrapper)
    Route::post('/inquiries/phone/verify', function(\Illuminate\Http\Request $request) {
        $request->validate([
            'phone' => 'required|regex:/^\+\d{1,4}\d{7,15}$/',
            'verification_method' => 'required|in:sms,whatsapp'
        ]);

        $verify_code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $phone = $request->phone;
        $method = $request->verification_method;

        $message = "لطفا جهت ادامه تکمیل فرم کد را در سایت وارد کنید،\n" .
                   "\n" .
                   "کد تایید شما: " . $verify_code . "\n" .
                   "\n" .
                   "HANNAH CAR";

        if ($method === 'whatsapp') {
            // ارسال از طریق WhatsApp
            \App\Helpers\NotificationHelper::send('whatsapp', $phone, $message);
        } else {
            // ارسال از طریق SMS
            \App\Helpers\NotificationHelper::send('sms', $phone, $message);
        }

        return response()->json([
            'success' => true,
            'message' => 'کد وریفای ارسال شد',
            'verify_code' => $verify_code,
            'method' => $method
        ]);
    })->name('inquiries.phone.verify')
      ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
});

// User Inquiry Routes - برای کاربران لاگین شده
Route::middleware(['auth'])->group(function () {
    Route::get('/inquiries/{type}/{id}', [App\Http\Controllers\InquiryController::class, 'show'])->name('inquiries.show');
});

// Inquiry Forms Routes - برای همه کاربران
Route::get('/inquiry-forms', [App\Http\Controllers\InquiryFormController::class, 'index'])->name('inquiry-forms.index');
Route::get('/inquiry-forms/{slug}', [App\Http\Controllers\InquiryFormController::class, 'show'])->name('inquiry-forms.show');
