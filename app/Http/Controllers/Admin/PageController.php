<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Language;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::with('translations.language')->orderBy('sort_order')->get();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::active()->get();
        return view('admin.pages.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|string|unique:pages',
            'template' => 'required|in:simple,sidebar',
            'status' => 'required|in:published,draft',
            'sort_order' => 'integer',
            'translations' => 'required|array',
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.content' => 'nullable|string',
            'translations.*.meta_title' => 'nullable|string|max:255',
            'translations.*.meta_description' => 'nullable|string',
            'translations.*.meta_keywords' => 'nullable|string',
            'translations.*.is_active' => 'boolean',
        ]);

        $page = Page::create([
            'slug' => $request->slug,
            'template' => $request->template,
            'status' => $request->status,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        // Create translations
        foreach ($request->translations as $translation) {
            $page->translations()->create($translation);
        }

        return redirect()->route('admin.pages.index')
            ->with('success', 'صفحه با موفقیت ایجاد شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        $page->load('translations.language');
        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        $languages = Language::active()->get();
        $page->load('translations.language');
        return view('admin.pages.edit', compact('page', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'slug' => 'required|string|unique:pages,slug,' . $page->id,
            'template' => 'required|in:simple,sidebar',
            'status' => 'required|in:published,draft',
            'sort_order' => 'integer',
            'translations' => 'required|array',
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.content' => 'nullable|string',
            'translations.*.meta_title' => 'nullable|string|max:255',
            'translations.*.meta_description' => 'nullable|string',
            'translations.*.meta_keywords' => 'nullable|string',
            'translations.*.is_active' => 'boolean',
        ]);

        $page->update([
            'slug' => $request->slug,
            'template' => $request->template,
            'status' => $request->status,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        // Update translations
        foreach ($request->translations as $translation) {
            $page->translations()->updateOrCreate(
                ['language_id' => $translation['language_id']],
                $translation
            );
        }

        return redirect()->route('admin.pages.index')
            ->with('success', 'صفحه با موفقیت به‌روزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'صفحه با موفقیت حذف شد.');
    }

    /**
     * Toggle page status
     */
    public function toggleStatus(Page $page)
    {
        $page->update(['status' => $page->status === 'published' ? 'draft' : 'published']);

        return redirect()->route('admin.pages.index')
            ->with('success', 'وضعیت صفحه تغییر کرد.');
    }
}
