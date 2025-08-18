<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Vehicle;
use App\Models\VehicleBrand;
use App\Models\VehicleModel;

class VehicleSearch extends Component
{
    public $searchQuery = '';
    public $activeTab = 'all'; // تغییر از 'new' به 'all'
    public $vehicles = [];
    public $selectedBrand = '';
    public $selectedModel = '';
    public $brands = [];
    public $models = [];

    public function mount()
    {
        $this->loadVehicles();
        $this->loadBrands();
    }

    public function loadBrands()
    {
        $this->brands = VehicleBrand::active()
            ->ordered()
            ->limit(20)
            ->get(['id', 'name']);
    }

    public function loadModels()
    {
        if ($this->selectedBrand) {
            $this->models = VehicleModel::where('brand_id', $this->selectedBrand)
                ->active()
                ->ordered()
                ->get(['id', 'name']);
        } else {
            $this->models = collect();
        }
    }

    public function updatedSelectedBrand()
    {
        $this->selectedModel = '';
        $this->loadModels();
        $this->loadVehicles();
    }

    public function updatedSelectedModel()
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
            case 'all':
                // نمایش همه خودروها (10 خودروی آخر)
                $query->limit(10);
                break;
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

        // Filter by brand
        if ($this->selectedBrand) {
            $query->where('brand_id', $this->selectedBrand);
        }

        // Filter by model
        if ($this->selectedModel) {
            $query->where('model_id', $this->selectedModel);
        }

        // Filter by search query
        if ($this->searchQuery) {
            $query->where(function ($q) {
                $q->whereHas('brand', function ($q) {
                    $q->where('name', 'like', "%{$this->searchQuery}%");
                })
                ->orWhereHas('model', function ($q) {
                    $q->where('name', 'like', "%{$this->searchQuery}%");
                })
                ->orWhere('year', 'like', "%{$this->searchQuery}%")
                ->orWhere('description', 'like', "%{$this->searchQuery}%");
            });
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
        $this->loadVehicles();
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
