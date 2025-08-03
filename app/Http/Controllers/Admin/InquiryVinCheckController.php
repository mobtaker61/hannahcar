<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InquiryVinCheck;
use Illuminate\Http\Request;

class InquiryVinCheckController extends Controller
{
    public function index()
    {
        $inquiries = InquiryVinCheck::orderByDesc('created_at')->paginate(20);
        return view('admin.inquiries.vin_checks.index', compact('inquiries'));
    }

    public function show(InquiryVinCheck $inquiry)
    {
        $inquiry->load('user', 'logs.user');
        return view('admin.inquiries.vin_checks.show', compact('inquiry'));
    }
}
