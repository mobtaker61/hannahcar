<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;
use App\Models\Language;

class NewsGrid extends Component
{
    public $news = [];
    public $articles = [];
    public $activeTab = 'news';
    public $limit = 4;

    public function mount()
    {
        $this->loadData();
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        $this->loadData();
    }

    public function loadData()
    {
        $currentLanguage = app()->getLocale();
        $language = Language::where('code', $currentLanguage)->first();

        if (!$language) {
            $language = Language::where('code', 'fa')->first(); // Fallback to Persian
        }

        // Load articles based on active tab
        $query = Article::with(['translations' => function($query) use ($language) {
                $query->where('language_id', $language->id);
            }, 'category.translations' => function($query) use ($language) {
                $query->where('language_id', $language->id);
            }])
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->limit($this->limit);

        if ($this->activeTab === 'news') {
            $query->where('type', 'news');
        } else {
            $query->where('type', 'article');
        }

        $articles = $query->get();

        $this->articles = $articles->map(function($article) use ($language) {
            $translation = $article->translations->first();
            $categoryTranslation = $article->category?->translations->first();

            return [
                'id' => $article->id,
                'title' => $translation?->title ?? 'بدون عنوان',
                'excerpt' => $translation?->excerpt ?? 'بدون خلاصه',
                'image' => $article->featured_image ? asset('storage/' . $article->featured_image) : 'https://images.unsplash.com/photo-1555215695-3004980ad54e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                'date' => $article->published_at?->format('Y-m-d') ?? $article->created_at->format('Y-m-d'),
                'category' => $categoryTranslation?->name ?? 'بدون دسته‌بندی',
                'link' => route('news.show', $article->slug),
                'is_featured' => $article->is_featured,
                'views_count' => $article->views_count,
                'comments_count' => $article->comments_count,
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.news-grid');
    }
}
