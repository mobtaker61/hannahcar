<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InquiryForm;
use App\Models\InquirySpecialCarPurchase;
use App\Models\InquirySpecialSparePart;
use App\Models\InquiryVinCheck;
use Illuminate\Support\Facades\Auth;

class InquiryFormController extends Controller
{
    public function index()
    {
        $inquiryForms = InquiryForm::active()->ordered()->get();

        // Get user's inquiries if logged in
        $userInquiries = collect();
        if (Auth::check()) {
            $user = Auth::user();

            foreach ($inquiryForms as $form) {
                $modelClass = $form->model;
                if (class_exists($modelClass)) {
                    $inquiries = $modelClass::where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get()
                        ->map(function ($inquiry) use ($form) {
                            $inquiry->form_type = $form->slug;
                            $inquiry->form_title = $form->title;
                            $inquiry->form = $form;
                            return $inquiry;
                        });

                    $userInquiries = $userInquiries->concat($inquiries);
                }
            }

            // Sort by date and take latest 10
            $userInquiries = $userInquiries->sortByDesc('created_at')->take(10);
        }

        return view('inquiries.forms.index', compact('inquiryForms', 'userInquiries'));
    }

    public function show($slug)
    {
        $form = InquiryForm::where('slug', $slug)->active()->first();

        if (!$form) {
            abort(404);
        }

        return view('inquiries.forms.show', compact('form'));
    }
}
