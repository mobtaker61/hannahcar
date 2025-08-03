<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InquirySpecialCarPurchase;
use App\Models\InquirySpecialSparePart;
use App\Models\InquiryVinCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type');
        $search = $request->get('search');
        $status = $request->get('status');

        $all = collect();

        // خرید خودرو خاص
        if (!$type || $type === 'special_car_purchase') {
            $carPurchases = InquirySpecialCarPurchase::query();
            if ($search) {
                $carPurchases->where(function($q) use ($search) {
                    $q->where('first_name', 'like', "%$search%")
                      ->orWhere('last_name', 'like', "%$search%")
                      ->orWhere('phone', 'like', "%$search%")
                      ->orWhere('id', $search);
                });
            }
            if ($status) {
                $carPurchases->where('status', $status);
            }
            $all = $all->concat($carPurchases->get()->map(function($item) {
                $item->form_type = 'special_car_purchase';
                $item->form_type_label = 'خرید خودرو خاص';
                $item->form_detail = $item->car_brand . ' ' . $item->car_model;
                return $item;
            }));
        }
        // قطعه یدکی خاص
        if (!$type || $type === 'special_spare_part') {
            $spareParts = InquirySpecialSparePart::query();
            if ($search) {
                $spareParts->where(function($q) use ($search) {
                    $q->where('first_name', 'like', "%$search%")
                      ->orWhere('last_name', 'like', "%$search%")
                      ->orWhere('phone', 'like', "%$search%")
                      ->orWhere('id', $search);
                });
            }
            if ($status) {
                $spareParts->where('status', $status);
            }
            $all = $all->concat($spareParts->get()->map(function($item) {
                $item->form_type = 'special_spare_part';
                $item->form_type_label = 'قطعه یدکی خاص';
                $item->form_detail = $item->part_name;
                return $item;
            }));
        }
        // استعلام VIN
        if (!$type || $type === 'vin_check') {
            $vinChecks = InquiryVinCheck::query();
            if ($search) {
                $vinChecks->where(function($q) use ($search) {
                    $q->where('first_name', 'like', "%$search%")
                      ->orWhere('last_name', 'like', "%$search%")
                      ->orWhere('phone', 'like', "%$search%")
                      ->orWhere('id', $search);
                });
            }
            if ($status) {
                $vinChecks->where('status', $status);
            }
            $all = $all->concat($vinChecks->get()->map(function($item) {
                $item->form_type = 'vin_check';
                $item->form_type_label = 'استعلام VIN';
                $item->form_detail = $item->vin_number;
                return $item;
            }));
        }

        // مرتب‌سازی و صفحه‌بندی دستی
        $all = $all->sortByDesc('created_at');
        $perPage = 20;
        $page = $request->get('page', 1);
        $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $all->forPage($page, $perPage),
            $all->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.inquiries.index', [
            'inquiries' => $paginated,
            'type' => $type,
            'search' => $search,
            'status' => $status,
        ]);
    }

    public function show($type, $id)
    {
        $modal = request('modal');
        if ($type === 'special_car_purchase') {
            $inquiry = \App\Models\InquirySpecialCarPurchase::with(['user', 'logs.user'])->findOrFail($id);
            $fields = [
                'برند خودرو' => $inquiry->car_brand,
                'مدل خودرو' => $inquiry->car_model,
                'سال ساخت' => $inquiry->car_year,
                'توضیحات' => $inquiry->description,
            ];
        } elseif ($type === 'special_spare_part') {
            $inquiry = \App\Models\InquirySpecialSparePart::with(['user', 'logs.user'])->findOrFail($id);
            $fields = [
                'نام قطعه' => $inquiry->part_name,
                'برند' => $inquiry->car_brand,
                'مدل' => $inquiry->car_model,
                'سال' => $inquiry->car_year,
                'توضیحات' => $inquiry->description,
            ];
        } elseif ($type === 'vin_check') {
            $inquiry = \App\Models\InquiryVinCheck::with(['user', 'logs.user'])->findOrFail($id);
            $fields = [
                'VIN' => $inquiry->vin_number,
                'برند' => $inquiry->car_brand,
                'مدل' => $inquiry->car_model,
                'توضیحات' => $inquiry->description,
            ];
        } else {
            abort(404);
        }
        if ($modal === '1') {
            return view('admin.inquiries.partials.show', compact('inquiry', 'fields', 'type'));
        } elseif ($modal === 'status') {
            return view('admin.inquiries.partials.status', compact('inquiry', 'type'));
        }
        return view('admin.inquiries.show', [
            'inquiry' => $inquiry,
            'fields' => $fields,
            'type' => $type,
        ]);
    }

    public function logsStore(Request $request, $type, $id)
    {
        $request->validate([
            'action' => 'required|string|max:500',
            'status' => 'required|in:new,in_progress,done,rejected',
        ]);
        if ($type === 'special_car_purchase') {
            $inquiry = \App\Models\InquirySpecialCarPurchase::findOrFail($id);
        } elseif ($type === 'special_spare_part') {
            $inquiry = \App\Models\InquirySpecialSparePart::findOrFail($id);
        } elseif ($type === 'vin_check') {
            $inquiry = \App\Models\InquiryVinCheck::findOrFail($id);
        } else {
            abort(404);
        }
        $inquiry->logs()->create([
            'user_id' => $request->user()->id,
            'action' => $request->action,
            'status' => $request->status,
        ]);
        $inquiry->status = $request->status;
        $inquiry->save();
        // ارسال پیام واتساپ به کاربر
        $phone = $inquiry->phone;
        $formCode = $inquiry->id;
        $statusLabel = match ($request->status) {
            'new' => 'جدید',
            'in_progress' => 'در حال بررسی',
            'done' => 'انجام شد',
            'rejected' => 'رد شده',
            default => $request->status,
        };
        $message = "کاربر گرامی،\nوضعیت فرم شما تغییر کرد.\nکد فرم: {$formCode}\nوضعیت جدید: {$statusLabel}\nتوضیح اقدام: {$request->action}\n";
        if ($phone) {
            \App\Helpers\NotificationHelper::send('whatsapp', $phone, $message);
        }
        return redirect()->route('admin.inquiries.index')->with('success', 'لاگ پیگیری با موفقیت ثبت شد.');
    }
}
