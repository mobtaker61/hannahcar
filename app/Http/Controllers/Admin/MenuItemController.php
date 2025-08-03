<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Language;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Menu $menu)
    {
        $menu->load(['translations.language', 'menuItems.translations.language', 'menuItems.parent', 'menuItems.children']);
        $languages = Language::active()->get();

        return view('admin.menu-items.index', compact('menu', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Menu $menu)
    {
        $languages = Language::active()->get();
        $parentItems = $menu->menuItems()->whereNull('parent_id')->get();

        return view('admin.menu-items.create', compact('menu', 'languages', 'parentItems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Menu $menu)
    {
        $request->validate([
            'url' => 'required|string|max:255',
            'target' => 'required|in:_self,_blank,_parent,_top',
            'parent_id' => 'nullable|exists:menu_items,id',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
            'translations' => 'required|array',
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.is_active' => 'boolean',
        ]);

        $menuItem = $menu->menuItems()->create([
            'url' => $request->url,
            'target' => $request->target,
            'parent_id' => $request->parent_id,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        // Create translations
        foreach ($request->translations as $translation) {
            $menuItem->translations()->create($translation);
        }

        return redirect()->route('admin.menu-items.index', $menu)
            ->with('success', 'آیتم منو با موفقیت ایجاد شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu, MenuItem $menuItem)
    {
        $menuItem->load(['translations.language', 'parent', 'children.translations.language']);
        return view('admin.menu-items.show', compact('menu', 'menuItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu, MenuItem $menuItem)
    {
        $languages = Language::active()->get();
        $parentItems = $menu->menuItems()->whereNull('parent_id')->where('id', '!=', $menuItem->id)->get();
        $menuItem->load('translations.language');

        return view('admin.menu-items.edit', compact('menu', 'menuItem', 'languages', 'parentItems'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu, MenuItem $menuItem)
    {
        $request->validate([
            'url' => 'required|string|max:255',
            'target' => 'required|in:_self,_blank,_parent,_top',
            'parent_id' => 'nullable|exists:menu_items,id',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
            'translations' => 'required|array',
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.is_active' => 'boolean',
        ]);

        $menuItem->update([
            'url' => $request->url,
            'target' => $request->target,
            'parent_id' => $request->parent_id,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        // Update translations
        foreach ($request->translations as $translation) {
            $menuItem->translations()->updateOrCreate(
                ['language_id' => $translation['language_id']],
                $translation
            );
        }

        return redirect()->route('admin.menu-items.index', $menu)
            ->with('success', 'آیتم منو با موفقیت به‌روزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu, MenuItem $menuItem)
    {
        $menuItem->delete();

        return redirect()->route('admin.menu-items.index', $menu)
            ->with('success', 'آیتم منو با موفقیت حذف شد.');
    }

    /**
     * Toggle menu item status
     */
    public function toggleStatus(Menu $menu, MenuItem $menuItem)
    {
        $menuItem->update(['is_active' => !$menuItem->is_active]);

        return redirect()->route('admin.menu-items.index', $menu)
            ->with('success', 'وضعیت آیتم منو تغییر کرد.');
    }
}
