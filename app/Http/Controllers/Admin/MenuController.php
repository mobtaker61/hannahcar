<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Language;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::with(['translations.language', 'menuItems.translations.language'])
            ->orderBy('sort_order')
            ->get();

        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::active()->get();
        return view('admin.menus.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'position' => 'required|in:header,footer,sidebar,mobile',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
            'translations' => 'required|array',
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.name' => 'required|string|max:255',
            'translations.*.description' => 'nullable|string',
            'translations.*.is_active' => 'boolean',
        ]);

        $menu = Menu::create([
            'position' => $request->position,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        // Create translations
        foreach ($request->translations as $translation) {
            $menu->translations()->create($translation);
        }

        return redirect()->route('admin.menus.index')
            ->with('success', 'منو با موفقیت ایجاد شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        $menu->load(['translations.language', 'menuItems.translations.language', 'menuItems.parent', 'menuItems.children']);
        return view('admin.menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $languages = Language::active()->get();
        $menu->load('translations.language');
        return view('admin.menus.edit', compact('menu', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'position' => 'required|in:header,footer,sidebar,mobile',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
            'translations' => 'required|array',
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.name' => 'required|string|max:255',
            'translations.*.description' => 'nullable|string',
            'translations.*.is_active' => 'boolean',
        ]);

        $menu->update([
            'position' => $request->position,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        // Update translations
        foreach ($request->translations as $translation) {
            $menu->translations()->updateOrCreate(
                ['language_id' => $translation['language_id']],
                $translation
            );
        }

        return redirect()->route('admin.menus.index')
            ->with('success', 'منو با موفقیت به‌روزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('admin.menus.index')
            ->with('success', 'منو با موفقیت حذف شد.');
    }

    /**
     * Toggle menu status
     */
    public function toggleStatus(Menu $menu)
    {
        $menu->update(['is_active' => !$menu->is_active]);

        return redirect()->route('admin.menus.index')
            ->with('success', 'وضعیت منو تغییر کرد.');
    }
}
