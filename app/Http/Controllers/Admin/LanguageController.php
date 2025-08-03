<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::orderBy('sort_order')->get();
        return view('admin.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:5|unique:languages',
            'name' => 'required|string|max:255',
            'native_name' => 'required|string|max:255',
            'direction' => 'required|in:rtl,ltr',
            'is_active' => 'boolean',
            'is_default' => 'boolean',
            'sort_order' => 'integer',
        ]);

        // If this is set as default, remove default from other languages
        if ($request->boolean('is_default')) {
            Language::where('is_default', true)->update(['is_default' => false]);
        }

        Language::create($request->all());

        return redirect()->route('admin.languages.index')
            ->with('success', 'زبان با موفقیت ایجاد شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Language $language)
    {
        return view('admin.languages.show', compact('language'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Language $language)
    {
        return view('admin.languages.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Language $language)
    {
        $request->validate([
            'code' => 'required|string|max:5|unique:languages,code,' . $language->id,
            'name' => 'required|string|max:255',
            'native_name' => 'required|string|max:255',
            'direction' => 'required|in:rtl,ltr',
            'is_active' => 'boolean',
            'is_default' => 'boolean',
            'sort_order' => 'integer',
        ]);

        // If this is set as default, remove default from other languages
        if ($request->boolean('is_default')) {
            Language::where('is_default', true)->where('id', '!=', $language->id)->update(['is_default' => false]);
        }

        $language->update($request->all());

        return redirect()->route('admin.languages.index')
            ->with('success', 'زبان با موفقیت به‌روزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    {
        // Prevent deletion of default language
        if ($language->is_default) {
            return redirect()->route('admin.languages.index')
                ->with('error', 'نمی‌توانید زبان پیش‌فرض را حذف کنید.');
        }

        $language->delete();

        return redirect()->route('admin.languages.index')
            ->with('success', 'زبان با موفقیت حذف شد.');
    }

    /**
     * Toggle language status
     */
    public function toggleStatus(Language $language)
    {
        $language->update(['is_active' => !$language->is_active]);

        return redirect()->route('admin.languages.index')
            ->with('success', 'وضعیت زبان تغییر کرد.');
    }

    /**
     * Set as default language
     */
    public function setDefault(Language $language)
    {
        Language::where('is_default', true)->update(['is_default' => false]);
        $language->update(['is_default' => true]);

        return redirect()->route('admin.languages.index')
            ->with('success', 'زبان پیش‌فرض تغییر کرد.');
    }
}
