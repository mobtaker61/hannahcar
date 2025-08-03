<?php
namespace App\Http\Controllers;

use App\Models\InquiryVinCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InquiryVinCheckController extends Controller
{
    public function index()
    {
        $inquiries = InquiryVinCheck::with('user')->latest()->paginate(20);
        return view('admin.inquiries.vin_checks.index', compact('inquiries'));
    }

    public function show(InquiryVinCheck $inquiry)
    {
        $inquiry->load('user', 'logs.user');
        return view('admin.inquiries.vin_checks.show', compact('inquiry'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'phone' => 'required|regex:/^\+\d{1,4}\d{7,15}$/',
                'first_name' => 'nullable|string|max:100',
                'last_name' => 'nullable|string|max:100',
                'vin_number' => 'required|string|max:50',
                'car_brand' => 'nullable|string|max:100',
                'car_model' => 'nullable|string|max:100',
                'description' => 'nullable|string',
            ]);

            // جستجو یا ساخت کاربر بر اساس شماره تلفن
            $user = \App\Models\User::findOrCreateByPhone(
                $request->phone,
                $request->first_name ?? '',
                $request->last_name ?? ''
            );

            $inquiry = InquiryVinCheck::create([
                'user_id' => $user->id,
                'phone' => $request->phone,
                'first_name' => $request->first_name ?? $user->name,
                'last_name' => $request->last_name ?? '',
                'vin_number' => $request->vin_number,
                'car_brand' => $request->car_brand,
                'car_model' => $request->car_model,
                'description' => $request->description,
                'status' => 'new',
            ]);

            // ارسال پیام واتساپ به کاربر
            $userName = $user->name;
            \App\Helpers\NotificationHelper::send('whatsapp', $request->phone,
                'متقاضی گرامی، ' . $userName . "\n" .
                'درخواست استعلام VIN شما با موفقیت ثبت شد.' .
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
            Log::error('Error in InquiryVinCheckController::store: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'خطا در ثبت فرم. لطفاً دوباره تلاش کنید.',
            ], 500);
        }
    }

    public function update(Request $request, InquiryVinCheck $inquiry)
    {
        // به‌روزرسانی توسط کارمند (مثلاً تغییر وضعیت یا افزودن لاگ)
    }

    public function destroy(InquiryVinCheck $inquiry)
    {
        $inquiry->delete();
        return redirect()->route('admin.inquiries.vin_checks.index')->with('success', 'فرم حذف شد.');
    }
}
