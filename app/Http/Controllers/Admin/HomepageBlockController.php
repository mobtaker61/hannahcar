<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageBlock;
use App\Models\Language;
use Illuminate\Http\Request;

class HomepageBlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blocks = HomepageBlock::with('translations.language')->orderBy('sort_order')->get();
        return view('admin.homepage-blocks.index', compact('blocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::active()->get();
        return view('admin.homepage-blocks.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:homepage_blocks',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'translations' => 'required|array',
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.is_active' => 'boolean',
        ]);

        $block = HomepageBlock::create([
            'name' => $request->name,
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        // Create translations
        foreach ($request->translations as $translation) {
            $block->translations()->create($translation);
        }

        return redirect()->route('admin.homepage-blocks.index')
            ->with('success', 'بلوک با موفقیت ایجاد شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(HomepageBlock $homepageBlock)
    {
        $homepageBlock->load('translations.language');
        return view('admin.homepage-blocks.show', compact('homepageBlock'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomepageBlock $homepageBlock)
    {
        $languages = Language::active()->get();
        $homepageBlock->load('translations.language');
        return view('admin.homepage-blocks.edit', compact('homepageBlock', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HomepageBlock $homepageBlock)
    {
        $request->validate([
            'name' => 'required|string|unique:homepage_blocks,name,' . $homepageBlock->id,
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'translations' => 'required|array',
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.is_active' => 'boolean',
        ]);

        $homepageBlock->update([
            'name' => $request->name,
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        // Update translations
        foreach ($request->translations as $translation) {
            $homepageBlock->translations()->updateOrCreate(
                ['language_id' => $translation['language_id']],
                $translation
            );
        }

        return redirect()->route('admin.homepage-blocks.index')
            ->with('success', 'بلوک با موفقیت به‌روزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomepageBlock $homepageBlock)
    {
        $homepageBlock->delete();

        return redirect()->route('admin.homepage-blocks.index')
            ->with('success', 'بلوک با موفقیت حذف شد.');
    }

    /**
     * Toggle block status
     */
    public function toggleStatus(HomepageBlock $homepageBlock)
    {
        $homepageBlock->update(['is_active' => !$homepageBlock->is_active]);

        return redirect()->route('admin.homepage-blocks.index')
            ->with('success', 'وضعیت بلوک تغییر کرد.');
    }
}
