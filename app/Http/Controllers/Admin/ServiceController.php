<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index()
    {
        $services = Article::with(['translations.language', 'category.translations', 'user'])
            ->services() // Only services
            ->latest()
            ->paginate(15);

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        $categories = Category::active()->ordered()->get();
        $languages = Language::active()->ordered()->get();

        return view('admin.services.create', compact('categories', 'languages'));
    }

    /**
     * Store a newly created service.
     */
    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|string|max:255|unique:articles,slug',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'allow_comments' => 'boolean',
            'published_at' => 'nullable|date',
            'icon' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'translations' => 'required|array',
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.excerpt' => 'nullable|string',
            'translations.*.content' => 'nullable|string',
            'translations.*.meta_title' => 'nullable|string|max:255',
            'translations.*.meta_description' => 'nullable|string',
            'translations.*.author_name' => 'nullable|string|max:255',
            'translations.*.tags' => 'nullable|array',
        ]);

        // Handle featured image upload
        $featuredImagePath = null;
        if ($request->hasFile('featured_image')) {
            $featuredImagePath = $request->file('featured_image')->store('articles/featured', 'public');
        }

        $service = Article::create([
            'slug' => $request->slug,
            'type' => 'service', // Always service type
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
            'status' => $request->status,
            'is_featured' => $request->has('is_featured'),
            'allow_comments' => $request->has('allow_comments'),
            'published_at' => $request->published_at,
            'icon' => $request->icon,
            'featured_image' => $featuredImagePath,
        ]);

        // Create translations
        foreach ($request->translations as $translation) {
            $service->translations()->create([
                'language_id' => $translation['language_id'],
                'title' => $translation['title'],
                'excerpt' => $translation['excerpt'] ?? null,
                'content' => $translation['content'] ?? null,
                'meta_title' => $translation['meta_title'] ?? null,
                'meta_description' => $translation['meta_description'] ?? null,
                'author_name' => $translation['author_name'] ?? null,
                'tags' => $translation['tags'] ?? [],
            ]);
        }

        return redirect()->route('admin.services.index')
            ->with('success', 'خدمت با موفقیت ایجاد شد.');
    }

    /**
     * Display the specified service.
     */
    public function show(Article $article)
    {
        $article->load(['translations.language', 'category.translations', 'user', 'gallery.language']);

        return view('admin.services.show', compact('article'));
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Article $article)
    {
        $article->load(['translations.language']);
        $categories = Category::active()->ordered()->get();
        $languages = Language::active()->ordered()->get();

        return view('admin.services.edit', compact('article', 'categories', 'languages'));
    }

    /**
     * Update the specified service.
     */
    public function update(Request $request, Article $article)
    {
        // Debug logging
        Log::info('Service update started', [
            'article_id' => $article->id,
            'request_method' => $request->method(),
            'request_data' => $request->all()
        ]);

        try {
            $request->validate([
                'slug' => 'required|string|max:255|unique:articles,slug,' . $article->id,
                'category_id' => 'nullable|exists:categories,id',
                'status' => 'required|in:draft,published,archived',
                'published_at' => 'nullable|date',
                'icon' => 'nullable|string|max:255',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'translations' => 'required|array',
                'translations.*.language_id' => 'required|exists:languages,id',
                'translations.*.title' => 'required|string|max:255',
                'translations.*.excerpt' => 'nullable|string',
                'translations.*.content' => 'nullable|string',
                'translations.*.meta_title' => 'nullable|string|max:255',
                'translations.*.meta_description' => 'nullable|string',
                'translations.*.author_name' => 'nullable|string|max:255',
                'translations.*.tags' => 'nullable|string',
            ]);

            Log::info('Validation passed');

            // Handle featured image upload
            $featuredImagePath = $article->featured_image;
            if ($request->hasFile('featured_image')) {
                // Delete old image if exists
                if ($article->featured_image) {
                    Storage::disk('public')->delete($article->featured_image);
                }
                $featuredImagePath = $request->file('featured_image')->store('articles/featured', 'public');
            }

            // Update article
            $article->update([
                'slug' => $request->slug,
                'type' => 'service',
                'category_id' => $request->category_id,
                'status' => $request->status,
                'is_featured' => $request->has('is_featured'),
                'allow_comments' => $request->has('allow_comments'),
                'published_at' => $request->published_at,
                'icon' => $request->icon,
                'featured_image' => $featuredImagePath,
            ]);

            Log::info('Article updated successfully');

            // Update translations
            foreach ($request->translations as $translation) {
                // Convert tags string to array
                $tags = [];
                if (!empty($translation['tags'])) {
                    $tags = array_filter(array_map('trim', explode(',', $translation['tags'])));
                }

                $article->translations()->updateOrCreate(
                    ['language_id' => $translation['language_id']],
                    [
                        'title' => $translation['title'],
                        'excerpt' => $translation['excerpt'] ?? null,
                        'content' => $translation['content'] ?? null,
                        'meta_title' => $translation['meta_title'] ?? null,
                        'meta_description' => $translation['meta_description'] ?? null,
                        'author_name' => $translation['author_name'] ?? null,
                        'tags' => $tags,
                    ]
                );
            }

            Log::info('Translations updated successfully');

            return redirect()->route('admin.services.index')
                ->with('success', 'خدمت با موفقیت به‌روزرسانی شد.');

        } catch (\Exception $e) {
            Log::error('Service update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withInput()->withErrors(['error' => 'خطا در به‌روزرسانی خدمت: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified service.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'خدمت با موفقیت حذف شد.');
    }
}
