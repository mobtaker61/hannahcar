<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InquiryForm;
use Illuminate\Http\Request;

class InquiryFormController extends Controller
{
    public function index()
    {
        $inquiryForms = InquiryForm::ordered()->get();

        return view('admin.inquiry-forms.index', compact('inquiryForms'));
    }

    public function create()
    {
        return view('admin.inquiry-forms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|string|max:100|unique:inquiry_forms',
            'name' => 'required|string|max:100',
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'route_name' => 'required|string|max:100',
            'controller' => 'required|string|max:200',
            'model' => 'required|string|max:200',
            'icon' => 'nullable|string|max:50',
            'color' => 'required|string|max:20',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
            'fields' => 'nullable|array',
        ]);

        InquiryForm::create($request->all());

        return redirect()->route('admin.inquiry-forms.index')
            ->with('success', 'فرم استعلام با موفقیت ایجاد شد.');
    }

    public function show(InquiryForm $inquiryForm)
    {
        return view('admin.inquiry-forms.show', compact('inquiryForm'));
    }

    public function edit(InquiryForm $inquiryForm)
    {
        return view('admin.inquiry-forms.edit', compact('inquiryForm'));
    }

    public function update(Request $request, InquiryForm $inquiryForm)
    {
        $request->validate([
            'slug' => 'required|string|max:100|unique:inquiry_forms,slug,' . $inquiryForm->id,
            'name' => 'required|string|max:100',
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'route_name' => 'required|string|max:100',
            'controller' => 'required|string|max:200',
            'model' => 'required|string|max:200',
            'icon' => 'nullable|string|max:50',
            'color' => 'required|string|max:20',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
            'fields' => 'nullable|array',
        ]);

        $inquiryForm->update($request->all());

        return redirect()->route('admin.inquiry-forms.index')
            ->with('success', 'فرم استعلام با موفقیت به‌روزرسانی شد.');
    }

    public function destroy(InquiryForm $inquiryForm)
    {
        $inquiryForm->delete();

        return redirect()->route('admin.inquiry-forms.index')
            ->with('success', 'فرم استعلام با موفقیت حذف شد.');
    }

    public function toggleActive(InquiryForm $inquiryForm)
    {
        $inquiryForm->update(['is_active' => !$inquiryForm->is_active]);

        return redirect()->route('admin.inquiry-forms.index')
            ->with('success', 'وضعیت فرم با موفقیت تغییر کرد.');
    }
}
