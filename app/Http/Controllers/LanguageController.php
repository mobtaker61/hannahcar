<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        // Validate locale
        if (!in_array($locale, ['en', 'fa', 'ar'])) {
            abort(400);
        }

        // Set locale in session
        session()->put('locale', $locale);

        // Redirect back to previous page
        return redirect()->back();
    }
}
