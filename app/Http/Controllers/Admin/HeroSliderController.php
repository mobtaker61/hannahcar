<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use App\Models\Language;
use Illuminate\Http\Request;

class HeroSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = HeroSlider::with('translations.language')->orderBy('sort_order')->get();
        return view('admin.hero-sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::active()->get();
        return view('admin.hero-sliders.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|string',
            'button_url' => 'nullable|string',
            'badge_color' => 'required|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
            'translations' => 'required|array',
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.subtitle' => 'nullable|string|max:255',
            'translations.*.description' => 'nullable|string',
            'translations.*.button_text' => 'nullable|string|max:255',
            'translations.*.badge_text' => 'nullable|string|max:255',
            'translations.*.is_active' => 'boolean',
        ]);

        $slider = HeroSlider::create([
            'image' => $request->image,
            'button_url' => $request->button_url,
            'badge_color' => $request->badge_color,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        // Create translations
        foreach ($request->translations as $translation) {
            $slider->translations()->create($translation);
        }

        return redirect()->route('admin.hero-sliders.index')
            ->with('success', 'اسلایدر با موفقیت ایجاد شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(HeroSlider $heroSlider)
    {
        $heroSlider->load('translations.language');
        return view('admin.hero-sliders.show', compact('heroSlider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HeroSlider $heroSlider)
    {
        $languages = Language::active()->get();
        $heroSlider->load('translations.language');
        return view('admin.hero-sliders.edit', compact('heroSlider', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HeroSlider $heroSlider)
    {
        $request->validate([
            'image' => 'required|string',
            'button_url' => 'nullable|string',
            'badge_color' => 'required|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
            'translations' => 'required|array',
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.subtitle' => 'nullable|string|max:255',
            'translations.*.description' => 'nullable|string',
            'translations.*.button_text' => 'nullable|string|max:255',
            'translations.*.badge_text' => 'nullable|string|max:255',
            'translations.*.is_active' => 'boolean',
        ]);

        $heroSlider->update([
            'image' => $request->image,
            'button_url' => $request->button_url,
            'badge_color' => $request->badge_color,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        // Update translations
        foreach ($request->translations as $translation) {
            $heroSlider->translations()->updateOrCreate(
                ['language_id' => $translation['language_id']],
                $translation
            );
        }

        return redirect()->route('admin.hero-sliders.index')
            ->with('success', 'اسلایدر با موفقیت به‌روزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeroSlider $heroSlider)
    {
        $heroSlider->delete();

        return redirect()->route('admin.hero-sliders.index')
            ->with('success', 'اسلایدر با موفقیت حذف شد.');
    }

    /**
     * Toggle slider status
     */
    public function toggleStatus(HeroSlider $heroSlider)
    {
        $heroSlider->update(['is_active' => !$heroSlider->is_active]);

        return redirect()->route('admin.hero-sliders.index')
            ->with('success', 'وضعیت اسلایدر تغییر کرد.');
    }
}
