<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\HeroSlider as HeroSliderModel;
use App\Models\Language;

class HeroSlider extends Component
{
    public $currentSlide = 0;
    public $autoSlide = true;
    public $slides = [];

    public function nextSlide()
    {
        if ($this->autoSlide && count($this->slides) > 0) {
            $this->currentSlide = ($this->currentSlide + 1) % count($this->slides);
        }
    }

    public function prevSlide()
    {
        if (count($this->slides) > 0) {
            $this->currentSlide = $this->currentSlide === 0 ? count($this->slides) - 1 : $this->currentSlide - 1;
        }
    }

    public function goToSlide($index)
    {
        if ($index >= 0 && $index < count($this->slides)) {
            $this->currentSlide = $index;
        }
    }

    public function toggleAutoSlide()
    {
        $this->autoSlide = !$this->autoSlide;
    }

    public function mount()
    {
        // Load slides from database
        $this->loadSlides();

        // Initialize with first slide
        $this->currentSlide = 0;
    }

    private function loadSlides()
    {
        // Get current language
        $currentLocale = app()->getLocale();
        $currentLanguage = Language::where('code', $currentLocale)->first();

        // Fallback to first available language if current language not found
        if (!$currentLanguage) {
            $currentLanguage = Language::first();
        }

        $heroSliders = HeroSliderModel::with(['translations.language'])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $this->slides = [];

        foreach ($heroSliders as $slider) {
            // Get translation for current language
            $translation = $slider->translations->where('language_id', $currentLanguage->id)->first();

            // Fallback to first available translation if current language translation not found
            if (!$translation) {
                $translation = $slider->translations->first();
            }

            if ($translation) {
                $this->slides[] = [
                    'id' => $slider->id,
                    'title' => $translation->title,
                    'subtitle' => $translation->subtitle,
                    'description' => $translation->description,
                    'image' => $slider->image,
                    'cta_text' => $translation->button_text,
                    'cta_link' => $slider->button_url,
                    'badge_text' => $translation->badge_text,
                    'badge_color' => $slider->badge_color,
                    'sort_order' => $slider->sort_order,
                ];
            }
        }
    }

    public function render()
    {
        return view('livewire.hero-slider');
    }
}
