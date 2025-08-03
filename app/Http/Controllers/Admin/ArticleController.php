<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Article::with(['translations.language', 'category.translations', 'user'])
            ->articlesAndNews(); // Only articles and news, exclude services

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by type
        if ($request->has('type') && $request->type !== '') {
            $query->where('type', $request->type);
        }

        // Filter by category
        if ($request->has('category_id') && $request->category_id !== '') {
            $query->where('category_id', $request->category_id);
        }

        // Filter by featured
        if ($request->has('featured') && $request->featured !== '') {
            $query->where('is_featured', $request->boolean('featured'));
        }

        // Search
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->whereHas('translations', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $articles = $query->latest()->paginate(20);
        $categories = Category::active()->ordered()->get();

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::active()->get();
        $categories = Category::active()->ordered()->get();
        return view('admin.articles.create', compact('languages', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|string|unique:articles,slug|max:255',
            'type' => 'required|in:article,news',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'allow_comments' => 'boolean',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'translations' => 'required|array',
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.content' => 'required|string',
            'translations.*.excerpt' => 'nullable|string',
            'translations.*.meta_title' => 'nullable|string|max:255',
            'translations.*.meta_description' => 'nullable|string',
            'translations.*.tags' => 'nullable|string',
            'translations.*.author_name' => 'nullable|string|max:255',
            'translations.*.source_url' => 'nullable|url',
            'gallery' => 'nullable|array',
            'gallery.*.language_id' => 'required|exists:languages,id',
            'gallery.*.image_path' => 'required|string',
            'gallery.*.alt_text' => 'nullable|string|max:255',
            'gallery.*.caption' => 'nullable|string',
            'gallery.*.sort_order' => 'nullable|integer|min:0',
        ]);

        // Handle featured image upload
        $featuredImagePath = null;
        if ($request->hasFile('featured_image')) {
            $featuredImagePath = $request->file('featured_image')->store('articles/featured', 'public');
        }

        $article = Article::create([
            'slug' => $request->slug,
            'type' => $request->type,
            'category_id' => $request->category_id,
            'user_id' => auth()->id,
            'status' => $request->status,
            'is_featured' => $request->boolean('is_featured', false),
            'allow_comments' => $request->boolean('allow_comments', true),
            'published_at' => $request->published_at,
            'featured_image' => $featuredImagePath,
        ]);

        // Create translations
        foreach ($request->translations as $translationData) {
            // Convert tags string to array if provided
            if (isset($translationData['tags']) && is_string($translationData['tags'])) {
                $translationData['tags'] = array_filter(array_map('trim', explode(',', $translationData['tags'])));
            }
            $article->translations()->create($translationData);
        }

        // Create gallery images
        if ($request->has('gallery')) {
            foreach ($request->gallery as $galleryData) {
                $article->gallery()->create($galleryData);
            }
        }

        return redirect()->route('admin.articles.index')
            ->with('success', 'مقاله با موفقیت ایجاد شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $article->load([
            'translations.language',
            'category.translations',
            'user',
            'gallery.language',
            'comments.user',
            'likes',
            'shares'
        ]);

        return view('admin.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $languages = Language::active()->get();
        $categories = Category::active()->ordered()->get();
        $article->load(['translations', 'gallery']);

        return view('admin.articles.edit', compact('article', 'languages', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'slug' => 'required|string|unique:articles,slug,' . $article->id . '|max:255',
            'type' => 'required|in:article,news',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'allow_comments' => 'boolean',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'translations' => 'required|array',
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.content' => 'required|string',
            'translations.*.excerpt' => 'nullable|string',
            'translations.*.meta_title' => 'nullable|string|max:255',
            'translations.*.meta_description' => 'nullable|string',
            'translations.*.tags' => 'nullable|string',
            'translations.*.author_name' => 'nullable|string|max:255',
            'translations.*.source_url' => 'nullable|url',
            'gallery' => 'nullable|array',
            'gallery.*.language_id' => 'required|exists:languages,id',
            'gallery.*.image_path' => 'required|string',
            'gallery.*.alt_text' => 'nullable|string|max:255',
            'gallery.*.caption' => 'nullable|string',
            'gallery.*.sort_order' => 'nullable|integer|min:0',
        ]);

        // Handle featured image upload
        $featuredImagePath = $article->featured_image;
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($article->featured_image) {
                Storage::disk('public')->delete($article->featured_image);
            }
            $featuredImagePath = $request->file('featured_image')->store('articles/featured', 'public');
        }

        $article->update([
            'slug' => $request->slug,
            'type' => $request->type,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'is_featured' => $request->boolean('is_featured', false),
            'allow_comments' => $request->boolean('allow_comments', true),
            'published_at' => $request->published_at,
            'featured_image' => $featuredImagePath,
        ]);

        // Update translations
        foreach ($request->translations as $translationData) {
            // Convert tags string to array if provided
            if (isset($translationData['tags']) && is_string($translationData['tags'])) {
                $translationData['tags'] = array_filter(array_map('trim', explode(',', $translationData['tags'])));
            }
            $article->translations()->updateOrCreate(
                ['language_id' => $translationData['language_id']],
                $translationData
            );
        }

        // Update gallery images
        if ($request->has('gallery')) {
            // Delete existing gallery images
            $article->gallery()->delete();

            // Create new gallery images
            foreach ($request->gallery as $galleryData) {
                $article->gallery()->create($galleryData);
            }
        }

        return redirect()->route('admin.articles.index')
            ->with('success', 'مقاله با موفقیت به‌روزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // Delete gallery images from storage
        foreach ($article->gallery as $galleryImage) {
            if (Storage::exists($galleryImage->image_path)) {
                Storage::delete($galleryImage->image_path);
            }
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'مقاله با موفقیت حذف شد.');
    }

    /**
     * Toggle article status.
     */
    public function toggleStatus(Article $article)
    {
        $newStatus = $article->status === 'published' ? 'draft' : 'published';
        $article->update(['status' => $newStatus]);

        return redirect()->route('admin.articles.index')
            ->with('success', 'وضعیت مقاله با موفقیت تغییر کرد.');
    }

    /**
     * Toggle article featured status.
     */
    public function toggleFeatured(Article $article)
    {
        $article->update(['is_featured' => !$article->is_featured]);

        return redirect()->route('admin.articles.index')
            ->with('success', 'وضعیت ویژه مقاله با موفقیت تغییر کرد.');
    }

    /**
     * Generate slug from title.
     */
    public function generateSlug(Request $request)
    {
        $title = $request->input('title');
        $slug = Str::slug($title);

        // Check if slug exists
        $count = Article::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        return response()->json(['slug' => $slug]);
    }

    /**
     * Upload image for article.
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $path = $request->file('image')->store('articles', 'public');

        return response()->json([
            'url' => Storage::url($path),
            'path' => $path
        ]);
    }
}
