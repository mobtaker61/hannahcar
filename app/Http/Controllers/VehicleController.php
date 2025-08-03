<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleBrand;
use App\Models\VehicleModel;
use App\Models\RegionalSpec;
use App\Models\BodyType;
use App\Models\SeatsCount;
use App\Models\FuelType;
use App\Models\TransmissionType;
use App\Models\EngineCapacityRange;
use App\Models\HorsepowerRange;
use App\Models\CylindersCount;
use App\Models\SteeringSide;
use App\Models\ExteriorColor;
use App\Models\InteriorColor;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehicle::with(['brand', 'model', 'regionalSpec', 'bodyType', 'fuelType', 'gallery'])
            ->where('publish_status', 'published')
            ->where('is_available', true)
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by brand
        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by year
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('brand', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('model', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhere('year', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $vehicles = $query->paginate(12);
        $brands = VehicleBrand::active()->ordered()->get();
        $bodyTypes = BodyType::active()->ordered()->get();
        $fuelTypes = FuelType::active()->ordered()->get();

        return view('vehicles.index', compact('vehicles', 'brands', 'bodyTypes', 'fuelTypes'));
    }

    public function show(Vehicle $vehicle)
    {
        // Check if vehicle is published and available
        if ($vehicle->publish_status !== 'published' || !$vehicle->is_available) {
            abort(404);
        }

        $vehicle->load([
            'brand', 'model', 'regionalSpec', 'bodyType', 'seatsCount',
            'fuelType', 'transmissionType', 'engineCapacityRange', 'horsepowerRange',
            'cylindersCount', 'steeringSide', 'exteriorColor', 'interiorColor',
            'gallery', 'user'
        ]);

        // Get related vehicles
        $relatedVehicles = Vehicle::with(['brand', 'model', 'gallery'])
            ->where('publish_status', 'published')
            ->where('is_available', true)
            ->where('id', '!=', $vehicle->id)
            ->where(function ($query) use ($vehicle) {
                $query->where('brand_id', $vehicle->brand_id)
                    ->orWhere('model_id', $vehicle->model_id)
                    ->orWhere('year', $vehicle->year);
            })
            ->limit(6)
            ->get();

        return view('vehicles.show', compact('vehicle', 'relatedVehicles'));
    }
}
