<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\InquiryForm;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index(Request $request)
    {
        $query = Article::with(['translations.language', 'category.translations', 'user'])
            ->published()
            ->services() // Only services
            ->latest();

        // Filter by category
        if ($request->has('category') && $request->category !== '') {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Filter by featured
        if ($request->has('featured') && $request->featured !== '') {
            if ($request->featured === '1') {
                $query->featured();
            } else {
                $query->where('is_featured', false);
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

        $services = $query->paginate(12);
        $categories = Category::active()->ordered()->get();
        $featuredServices = Article::with(['translations.language', 'category.translations'])
            ->published()
            ->services() // Only services
            ->featured()
            ->latest()
            ->take(6)
            ->get();

        // Get active inquiry forms for sidebar
        $inquiryForms = InquiryForm::active()->ordered()->get();

        return view('services.index', compact('services', 'categories', 'featuredServices', 'inquiryForms'));
    }

    /**
     * Display the specified service.
     */
    public function show($slug)
    {
        $service = Article::with([
            'translations.language',
            'category.translations',
            'user',
            'gallery',
            'approvedComments.user',
            'approvedComments.replies.user'
        ])
        ->where('slug', $slug)
        ->published()
        ->services() // Only services
        ->firstOrFail();

        // Increment views count
        $service->incrementViews();

        // Get related services
        $relatedServices = Article::with(['translations.language', 'category.translations'])
            ->published()
            ->services() // Only services
            ->where('id', '!=', $service->id)
            ->where('category_id', $service->category_id)
            ->latest()
            ->take(3)
            ->get();

        // Get popular services
        $popularServices = Article::with(['translations.language', 'category.translations'])
            ->published()
            ->services() // Only services
            ->where('id', '!=', $service->id)
            ->popular()
            ->take(5)
            ->get();

        return view('services.show', compact('service', 'relatedServices', 'popularServices'));
    }
}
