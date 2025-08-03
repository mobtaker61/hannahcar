<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with(['translations.language'])
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::active()->get();
        return view('admin.categories.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|string|unique:categories,slug|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
            'translations' => 'required|array',
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.name' => 'required|string|max:255',
            'translations.*.description' => 'nullable|string',
            'translations.*.meta_title' => 'nullable|string|max:255',
            'translations.*.meta_description' => 'nullable|string',
            'translations.*.featured_image' => 'nullable|string',
        ]);

        $category = Category::create([
            'slug' => $request->slug,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->input('sort_order', 0),
        ]);

        // Create translations
        foreach ($request->translations as $translationData) {
            $category->translations()->create($translationData);
        }

        return redirect()->route('admin.categories.index')
            ->with('success', 'دسته‌بندی با موفقیت ایجاد شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->load(['translations.language', 'articles.translations']);
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $languages = Language::active()->get();
        $category->load('translations');
        return view('admin.categories.edit', compact('category', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'slug' => 'required|string|unique:categories,slug,' . $category->id . '|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
            'translations' => 'required|array',
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.name' => 'required|string|max:255',
            'translations.*.description' => 'nullable|string',
            'translations.*.meta_title' => 'nullable|string|max:255',
            'translations.*.meta_description' => 'nullable|string',
            'translations.*.featured_image' => 'nullable|string',
        ]);

        $category->update([
            'slug' => $request->slug,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->input('sort_order', 0),
        ]);

        // Update translations
        foreach ($request->translations as $translationData) {
            $category->translations()->updateOrCreate(
                ['language_id' => $translationData['language_id']],
                $translationData
            );
        }

        return redirect()->route('admin.categories.index')
            ->with('success', 'دسته‌بندی با موفقیت به‌روزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Check if category has articles
        if ($category->articles()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'نمی‌توانید دسته‌بندی حاوی مقاله را حذف کنید.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'دسته‌بندی با موفقیت حذف شد.');
    }

    /**
     * Toggle category status.
     */
    public function toggleStatus(Category $category)
    {
        $category->update(['is_active' => !$category->is_active]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'وضعیت دسته‌بندی با موفقیت تغییر کرد.');
    }

    /**
     * Generate slug from name.
     */
    public function generateSlug(Request $request)
    {
        $name = $request->input('name');
        $slug = Str::slug($name);

        // Check if slug exists
        $count = Category::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        return response()->json(['slug' => $slug]);
    }
}
