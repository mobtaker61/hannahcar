<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Vehicle;

class VehicleSearch extends Component
{
    public $searchQuery = '';
    public $activeTab = 'new';
    public $vehicles = [];

    public function mount()
    {
        $this->loadVehicles();
    }

    public function loadVehicles()
    {
        $query = Vehicle::with(['brand', 'model', 'gallery'])
            ->published()
            ->available()
            ->orderBy('created_at', 'desc')
            ->limit(12);

        // Filter by status based on active tab
        switch ($this->activeTab) {
            case 'new':
                $query->new();
                break;
            case 'used':
                $query->used();
                break;
            case 'export':
                $query->export();
                break;
        }

        $vehicles = $query->get();

        // Transform vehicles to match the expected format
        $this->vehicles = $vehicles->map(function ($vehicle) {
            return [
                'id' => $vehicle->id,
                'name' => $vehicle->full_name,
                'price' => $vehicle->price,
                'currency' => $vehicle->currency,
                'year' => $vehicle->year,
                'km' => $vehicle->formatted_mileage,
                'image' => $vehicle->featured_image ? asset('storage/' . $vehicle->featured_image) : 'https://images.unsplash.com/photo-1555215695-3004980ad54e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                'brand' => $vehicle->brand->name ?? '',
                'model' => $vehicle->model->name ?? '',
                'slug' => $vehicle->slug,
                'is_featured' => $vehicle->is_featured,
                'status' => $vehicle->status,
            ];
        })->toArray();
    }

    public function updatedSearchQuery()
    {
        // Debounce search - will be handled by Alpine.js
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        $this->loadVehicles();
    }

    public function render()
    {
        return view('livewire.vehicle-search');
    }
}
