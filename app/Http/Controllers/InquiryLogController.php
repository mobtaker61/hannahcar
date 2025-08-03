<?php
namespace App\Http\Controllers;

use App\Models\InquiryLog;
use Illuminate\Http\Request;

class InquiryLogController extends Controller
{
    public function store(Request $request)
    {
        // ثبت لاگ پیگیری توسط کارمند
    }

    public function destroy(InquiryLog $log)
    {
        $log->delete();
        return back()->with('success', 'لاگ حذف شد.');
    }
}
