<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vehicle;

class SpotlightCarousel extends Component
{
    public $currentSlide = 0;
    public $autoPlay = true;
    public $autoPlayInterval = 3000; // 3 seconds
    public $spotlightVehicles = [];

    public function mount()
    {
        $this->loadSpotlightVehicles();
        // Start auto-play when component mounts
        $this->startAutoPlay();
    }

    public function loadSpotlightVehicles()
    {
        $vehicles = Vehicle::with(['brand', 'model', 'gallery'])
            ->published()
            ->available()
            ->featured()
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        // Transform vehicles to match the expected format
        $this->spotlightVehicles = $vehicles->map(function ($vehicle) {
            return [
                'id' => $vehicle->id,
                'name' => $vehicle->full_name,
                'price' => $vehicle->price,
                'original_price' => $vehicle->price * 1.15, // 15% markup for original price
                'badge' => $this->getBadgeText($vehicle),
                'badge_color' => $this->getBadgeColor($vehicle),
                'image' => $vehicle->featured_image ? asset('storage/' . $vehicle->featured_image) : 'https://images.unsplash.com/photo-1555215695-3004980ad54e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'description' => $vehicle->description ?: 'خودروی لوکس با امکانات کامل و قیمت استثنایی',
                'slug' => $vehicle->slug,
            ];
        })->toArray();
    }

    private function getBadgeText($vehicle)
    {
        // Determine badge text based on vehicle properties
        if ($vehicle->created_at->diffInDays(now()) <= 7) {
            return 'جدید';
        } elseif ($vehicle->is_featured) {
            return 'پیشنهاد ویژه';
        } else {
            return 'تخفیف 15%';
        }
    }

    private function getBadgeColor($vehicle)
    {
        // Determine badge color based on vehicle properties
        if ($vehicle->created_at->diffInDays(now()) <= 7) {
            return 'bg-blue-500';
        } elseif ($vehicle->is_featured) {
            return 'bg-red-500';
        } else {
            return 'bg-green-500';
        }
    }

    public function startAutoPlay()
    {
        if ($this->autoPlay) {
            $this->dispatch('startAutoPlay', interval: $this->autoPlayInterval);
        }
    }

    public function stopAutoPlay()
    {
        $this->autoPlay = false;
        $this->dispatch('stopAutoPlay');
    }

    public function nextSlide()
    {
        if (count($this->spotlightVehicles) > 0) {
            $this->currentSlide = ($this->currentSlide + 1) % count($this->spotlightVehicles);
        }
    }

    public function prevSlide()
    {
        if (count($this->spotlightVehicles) > 0) {
            $this->currentSlide = $this->currentSlide === 0 ? count($this->spotlightVehicles) - 1 : $this->currentSlide - 1;
        }
    }

    public function goToSlide($index)
    {
        if ($index >= 0 && $index < count($this->spotlightVehicles)) {
            $this->currentSlide = $index;
            // Restart auto-play when user manually changes slide
            $this->startAutoPlay();
        }
    }

    public function render()
    {
        return view('livewire.spotlight-carousel');
    }
}
