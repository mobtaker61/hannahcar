<?php
namespace App\Http\Controllers;

use App\Models\InquirySpecialCarPurchase;
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
                'phone' => 'required|regex:/^\+\d{1,4}\d{7,15}$/',
                'first_name' => 'nullable|string|max:100',
                'last_name' => 'nullable|string|max:100',
                'car_brand' => 'nullable|string|max:100',
                'car_model' => 'nullable|string|max:100',
                'car_year' => 'nullable|integer',
                'description' => 'nullable|string',
            ]);

            // جستجو یا ساخت کاربر بر اساس شماره تلفن
            $user = \App\Models\User::findOrCreateByPhone(
                $request->phone,
                $request->first_name ?? '',
                $request->last_name ?? ''
            );

            $inquiry = InquirySpecialCarPurchase::create([
                'user_id' => $user->id,
                'phone' => $request->phone,
                'first_name' => $request->first_name ?? $user->name,
                'last_name' => $request->last_name ?? '',
                'car_brand' => $request->car_brand,
                'car_model' => $request->car_model,
                'car_year' => $request->car_year,
                'description' => $request->description,
                'status' => 'new',
            ]);

            // ارسال پیام واتساپ به کاربر
            $userName = $user->name;
            \App\Helpers\NotificationHelper::send('whatsapp', $request->phone,
                'متقاضی گرامی، ' . $userName . "\n" .
                'درخواست خرید خودرو خاص شما با موفقیت ثبت شد.' .
                "\n" .
                'کد پیگیری: ' . $inquiry->id .
                "\n" .
                \App\Helpers\SettingHelper::getNotificationFooter()
            );

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
