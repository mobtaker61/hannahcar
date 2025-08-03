<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\ArticleComment;
use App\Models\ArticleLike;
use App\Models\ArticleShare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of articles.
     */
    public function index(Request $request)
    {
        $query = Article::with(['translations.language', 'category.translations', 'user'])
            ->published()
            ->articlesAndNews() // Only articles and news, exclude services
            ->latest();

        // Filter by category
        if ($request->has('category') && $request->category !== '') {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Search
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->whereHas('translations', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        $articles = $query->paginate(12);
        $categories = Category::active()->ordered()->get();
        $featuredArticles = Article::with(['translations.language', 'category.translations'])
            ->published()
            ->articlesAndNews() // Only articles and news, exclude services
            ->featured()
            ->latest()
            ->take(5)
            ->get();

        return view('articles.index', compact('articles', 'categories', 'featuredArticles'));
    }

    /**
     * Display the specified article.
     */
    public function show($slug)
    {
        $article = Article::with([
            'translations.language',
            'category.translations',
            'user',
            'gallery.language',
            'approvedComments.user',
            'approvedComments.replies.user'
        ])
        ->where('slug', $slug)
        ->published()
        ->firstOrFail();

        // Increment views count
        $article->incrementViews();

        // Get related articles
        $relatedArticles = Article::with(['translations.language', 'category.translations'])
            ->published()
            ->articlesAndNews() // Only articles and news, exclude services
            ->where('id', '!=', $article->id)
            ->where('category_id', $article->category_id)
            ->latest()
            ->take(3)
            ->get();

        // Get popular articles
        $popularArticles = Article::with(['translations.language', 'category.translations'])
            ->published()
            ->articlesAndNews() // Only articles and news, exclude services
            ->where('id', '!=', $article->id)
            ->popular()
            ->take(5)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles', 'popularArticles'));
    }

    /**
     * Display articles by category.
     */
    public function category($slug)
    {
        $category = Category::with(['translations.language'])
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        $articles = Article::with(['translations.language', 'user'])
            ->published()
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(12);

        return view('articles.category', compact('category', 'articles'));
    }

    /**
     * Store a new comment.
     */
    public function storeComment(Request $request, Article $article)
    {
        if (!$article->canComment()) {
            return back()->with('error', 'نظرات برای این مقاله غیرفعال است.');
        }

        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:article_comments,id',
            'guest_name' => 'nullable|string|max:255',
            'guest_email' => 'nullable|email|max:255',
        ]);

        $commentData = [
            'article_id' => $article->id,
            'content' => $request->content,
            'parent_id' => $request->parent_id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ];

        // Add user info
        if (Auth::check()) {
            $commentData['user_id'] = Auth::id();
        } else {
            $commentData['guest_name'] = $request->guest_name;
            $commentData['guest_email'] = $request->guest_email;
        }

        // Set status based on settings
        $commentData['status'] = config('articles.auto_approve_comments', false) ? 'approved' : 'pending';

        ArticleComment::create($commentData);

        return back()->with('success', 'نظر شما با موفقیت ارسال شد و پس از تایید نمایش داده خواهد شد.');
    }

    /**
     * Toggle like for an article.
     */
    public function toggleLike(Request $request, Article $article)
    {
        if (!$article->isPublished()) {
            return response()->json(['error' => 'مقاله منتشر نشده است.'], 400);
        }

        $userId = Auth::id();
        $ipAddress = $request->ip();

        $liked = ArticleLike::toggleLike($article->id, $userId, $ipAddress);

        return response()->json([
            'liked' => $liked,
            'likes_count' => $article->fresh()->likes_count
        ]);
    }

    /**
     * Share an article.
     */
    public function share(Request $request, Article $article)
    {
        if (!$article->isPublished()) {
            return response()->json(['error' => 'مقاله منتشر نشده است.'], 400);
        }

        $request->validate([
            'platform' => 'required|in:facebook,twitter,linkedin,telegram,whatsapp,email,copy_link'
        ]);

        $userId = Auth::id();
        ArticleShare::recordShare($article->id, $request->platform, $userId);

        return response()->json([
            'success' => true,
            'shares_count' => $article->fresh()->shares_count
        ]);
    }

    /**
     * RSS feed for articles.
     */
    public function rss()
    {
        $articles = Article::with(['translations.language', 'category.translations'])
            ->published()
            ->latest()
            ->take(20)
            ->get();

        return response()->view('articles.rss', compact('articles'))
            ->header('Content-Type', 'application/xml');
    }
}
