<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InquirySpecialCarPurchase;
use App\Models\InquirySpecialSparePart;
use App\Models\InquiryVinCheck;
use App\Models\InquiryForm;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
        public function index(Request $request)
    {
        // Get user's inquiries
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Get all inquiry forms
        $inquiryForms = InquiryForm::active()->ordered()->get();

        // Get user's inquiries from all forms
        $inquiries = collect();

        foreach ($inquiryForms as $form) {
            $modelClass = $form->model;
            if (class_exists($modelClass)) {
                $userInquiries = $modelClass::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->get()
                    ->map(function ($inquiry) use ($form) {
                        $inquiry->form_type = $form->slug;
                        $inquiry->form_title = $form->title;
                        $inquiry->form = $form;
                        return $inquiry;
                    });

                $inquiries = $inquiries->concat($userInquiries);
            }
        }

        // Sort by date
        $inquiries = $inquiries->sortByDesc('created_at');

        return view('inquiries.index', compact('inquiries', 'inquiryForms'));
    }

    public function show($type, $id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $inquiry = null;
        $formTitle = '';

        switch ($type) {
            case 'special_car_purchase':
                $inquiry = InquirySpecialCarPurchase::where('id', $id)
                    ->where('user_id', $user->id)
                    ->first();
                $formTitle = 'درخواست خرید خودرو ویژه';
                break;
            case 'special_spare_part':
                $inquiry = InquirySpecialSparePart::where('id', $id)
                    ->where('user_id', $user->id)
                    ->first();
                $formTitle = 'درخواست قطعه یدکی ویژه';
                break;
            case 'vin_check':
                $inquiry = InquiryVinCheck::where('id', $id)
                    ->where('user_id', $user->id)
                    ->first();
                $formTitle = 'بررسی VIN';
                break;
        }

        if (!$inquiry) {
            abort(404);
        }

        return view('inquiries.show', compact('inquiry', 'formTitle', 'type'));
    }
}
