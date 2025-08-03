<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InquirySpecialSparePart;
use Illuminate\Http\Request;

class InquirySpecialSparePartController extends Controller
{
    public function index()
    {
        $inquiries = InquirySpecialSparePart::orderByDesc('created_at')->paginate(20);
        return view('admin.inquiries.special_spare_parts.index', compact('inquiries'));
    }

    public function show(InquirySpecialSparePart $inquiry)
    {
        $inquiry->load('user', 'logs.user');
        return view('admin.inquiries.special_spare_parts.show', compact('inquiry'));
    }
}
