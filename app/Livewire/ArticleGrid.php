<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleGrid extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $sortBy = 'latest';
    public $perPage = 12;

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'sortBy' => ['except' => 'latest'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Article::with(['translations.language', 'category.translations', 'user'])
            ->published();

        // Filter by category
        if ($this->category) {
            $category = Category::where('slug', $this->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Search
        if ($this->search) {
            $query->whereHas('translations', function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                  ->orWhere('content', 'like', "%{$this->search}%")
                  ->orWhere('excerpt', 'like', "%{$this->search}%");
            });
        }

        // Sort
        switch ($this->sortBy) {
            case 'popular':
                $query->popular();
                break;
            case 'featured':
                $query->featured();
                break;
            default:
                $query->latest();
                break;
        }

        $articles = $query->paginate($this->perPage);
        $categories = Category::active()->ordered()->get();

        return view('livewire.article-grid', compact('articles', 'categories'));
    }
}
