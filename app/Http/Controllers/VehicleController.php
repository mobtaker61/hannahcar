<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleBrand;
use App\Models\VehicleModel;
use App\Models\VehicleVariant;
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

        $vehicles = $query->paginate(23);
        $brands = VehicleBrand::active()->ordered()->get();
        $vehicleVariants = VehicleVariant::active()->ordered()->get();
        $bodyTypes = BodyType::active()->ordered()->get();
        $fuelTypes = FuelType::active()->ordered()->get();

        return view('vehicles.index', compact('vehicles', 'brands', 'vehicleVariants', 'bodyTypes', 'fuelTypes'));
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

        // جداسازی URL های 360 از features
        $view360Url = null;
        $filteredFeatures = [];

        if ($vehicle->features && is_array($vehicle->features)) {
            foreach ($vehicle->features as $feature) {
                if (is_string($feature) && filter_var($feature, FILTER_VALIDATE_URL)) {
                    // بررسی اینکه آیا URL مربوط به 360 view است
                    if (str_contains($feature, 'photo-motion.com') ||
                        str_contains($feature, '360') ||
                        str_contains($feature, 'spinner')) {
                        $view360Url = $feature;
                    } else {
                        // URL های دیگر را در features نگه می‌داریم
                        $filteredFeatures[] = $feature;
                    }
                } else {
                    // مقادیر غیر URL را نگه می‌داریم
                    $filteredFeatures[] = $feature;
                }
            }
        }

        // Get related vehicles
        $relatedVehicles = Vehicle::with(['brand', 'model', 'gallery'])
            ->where('publish_status', 'published')
            ->where('is_available', true)
            ->where('id', '!=', $vehicle->id)
            ->where(function ($query) use ($vehicle) {
                $query->where('brand_id', $vehicle->brand_id)
                    ->orWhere('model_id', $vehicle->model_id)
                    ->orWhere('year', $vehicle->id);
            })
            ->limit(6)
            ->get();

        return view('vehicles.show', compact('vehicle', 'relatedVehicles', 'view360Url', 'filteredFeatures'));
    }

    /**
     * جستجوی برندهای خودرو برای Select2
     */
    public function searchBrands(Request $request)
    {
        $search = $request->get('search', '');
        $page = $request->get('page', 1);

        $query = VehicleBrand::active()->ordered();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $brands = $query->paginate(20, ['*'], 'page', $page);

        return response()->json([
            'data' => $brands->items(),
            'next_page_url' => $brands->nextPageUrl(),
            'prev_page_url' => $brands->previousPageUrl(),
            'current_page' => $brands->currentPage(),
            'last_page' => $brands->lastPage(),
            'total' => $brands->total()
        ]);
    }

    /**
     * جستجوی مدل‌های خودرو برای Select2
     */
    public function searchModels(Request $request)
    {
        $search = $request->get('search', '');
        $brandId = $request->get('brand_id');
        $page = $request->get('page', 1);

        $query = VehicleModel::active()->ordered();

        if ($brandId) {
            $query->where('brand_id', $brandId);
        }

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $models = $query->paginate(20, ['*'], 'page', $page);

        return response()->json([
            'data' => $models->items(),
            'next_page_url' => $models->nextPageUrl(),
            'prev_page_url' => $models->previousPageUrl(),
            'current_page' => $models->currentPage(),
            'last_page' => $models->lastPage(),
            'total' => $models->total()
        ]);
    }
}
