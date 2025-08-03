<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InquirySpecialCarPurchase;
use Illuminate\Http\Request;

class InquirySpecialCarPurchaseController extends Controller
{
    public function index()
    {
        $inquiries = InquirySpecialCarPurchase::orderByDesc('created_at')->paginate(20);
        return view('admin.inquiries.special_car_purchases.index', compact('inquiries'));
    }

    public function show(InquirySpecialCarPurchase $inquiry)
    {
        $inquiry->load('user', 'logs.user');
        return view('admin.inquiries.special_car_purchases.show', compact('inquiry'));
    }

    public function logsStore(Request $request, InquirySpecialCarPurchase $inquiry)
    {
        $request->validate([
            'action' => 'required|string|max:500',
            'status' => 'required|in:new,in_progress,done,rejected',
        ]);
        $inquiry->logs()->create([
            'user_id' => auth()->id(),
            'action' => $request->action,
            'status' => $request->status,
        ]);
        $inquiry->status = $request->status;
        $inquiry->save();
        return redirect()->route('admin.inquiries.special_car_purchases.show', $inquiry)->with('success', 'لاگ پیگیری با موفقیت ثبت شد.');
    }
}
