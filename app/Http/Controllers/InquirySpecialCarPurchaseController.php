<?php
namespace App\Http\Controllers;

use App\Models\InquirySpecialCarPurchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InquirySpecialCarPurchaseController extends Controller
{
    public function index()
    {
        $inquiries = InquirySpecialCarPurchase::with('user')->latest()->paginate(20);
        return view('admin.inquiries.special_car_purchases.index', compact('inquiries'));
    }

    public function show(InquirySpecialCarPurchase $inquiry)
    {
        $inquiry->load('user', 'logs.user');
        return view('admin.inquiries.special_car_purchases.show', compact('inquiry'));
    }

    public function store(Request $request)
    {
        try {
            // اگر request JSON است، آن را درست پردازش کن
            if ($request->isJson()) {
                $data = $request->json()->all();
            } else {
                $data = $request->all();
            }

            $request->validate([
                'user_id' => 'required|exists:users,id',
                'car_brand' => 'nullable|string|max:100',
                'car_model' => 'nullable|string|max:100',
                'car_brand_id' => 'nullable|exists:vehicle_brands,id',
                'car_model_id' => 'nullable|exists:vehicle_models,id',
                'car_year' => 'nullable|integer|min:2020|max:2026',
                'delivery_location' => 'nullable|string',
                'description' => 'nullable|string',
            ]);

            // Get user
            $user = User::findOrFail($request->user_id);

            $inquiry = InquirySpecialCarPurchase::create([
                'user_id' => $user->id,
                'phone' => $user->phone,
                'first_name' => $user->name,
                'last_name' => '',
                'car_brand' => $request->car_brand,
                'car_model' => $request->car_model,
                'car_brand_id' => $request->car_brand_id,
                'car_model_id' => $request->car_model_id,
                'car_year' => $request->car_year,
                'delivery_location' => $request->delivery_location,
                'description' => $request->description,
                'status' => 'new',
            ]);

            // ارسال پیام واتساپ به کاربر و شماره‌های اضافی
            $userName = $user->name;
            $message = 'متقاضی گرامی، ' . $userName . "\n" .
                'درخواست خرید خودرو خاص شما با موفقیت ثبت شد.' .
                "\n" .
                'کد پیگیری: ' . $inquiry->id .
                "\n" .
                \App\Helpers\SettingHelper::getNotificationFooter();

            // ارسال به کاربر
            \App\Helpers\NotificationHelper::send('whatsapp', $user->phone, $message);

            // ارسال به شماره‌های اضافی
            $additionalPhones = [
                \App\Helpers\SettingHelper::get('admin_phone_1', '+989123456789'),
                \App\Helpers\SettingHelper::get('admin_phone_2', '+989876543210')
            ];

            $adminMessage = 'درخواست جدید خرید خودرو خاص' . "\n" .
                'نام متقاضی: ' . $userName . "\n" .
                'شماره تلفن: ' . $user->phone . "\n" .
                'کد پیگیری: ' . $inquiry->id . "\n" .
                'برند: ' . ($request->car_brand ?? '-') . "\n" .
                'مدل: ' . ($request->car_model ?? '-') . "\n" .
                'سال: ' . ($request->car_year ?? '-') . "\n" .
                'محل تحویل: ' . ($request->delivery_location ?? '-') . "\n" .
                'توضیحات: ' . ($request->description ?? '-');

            foreach ($additionalPhones as $phone) {
                if (!empty($phone) && $phone !== '+989123456789' && $phone !== '+989876543210') {
                    \App\Helpers\NotificationHelper::send('whatsapp', $phone, $adminMessage);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'فرم با موفقیت ثبت شد.',
                'inquiry_id' => $inquiry->id,
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در اعتبارسنجی داده‌ها',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error in InquirySpecialCarPurchaseController::store: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'خطا در ثبت فرم. لطفاً دوباره تلاش کنید.',
            ], 500);
        }
    }

    public function update(Request $request, InquirySpecialCarPurchase $inquiry)
    {
        // به‌روزرسانی توسط کارمند (مثلاً تغییر وضعیت یا افزودن لاگ)
    }

    public function destroy(InquirySpecialCarPurchase $inquiry)
    {
        $inquiry->delete();
        return redirect()->route('admin.inquiries.special_car_purchases.index')->with('success', 'فرم حذف شد.');
    }
}
