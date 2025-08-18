<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehicle::with(['brand', 'model', 'regionalSpec', 'bodyType', 'fuelType'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by publish status
        if ($request->filled('publish_status')) {
            $query->where('publish_status', $request->publish_status);
        }

        // Filter by brand
        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        // Filter by featured
        if ($request->filled('is_featured')) {
            $query->where('is_featured', $request->is_featured);
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

        $vehicles = $query->paginate(20);
        $brands = VehicleBrand::active()->ordered()->get();

        return view('admin.vehicles.index', compact('vehicles', 'brands'));
    }

    public function create()
    {
        $brands = VehicleBrand::active()->ordered()->get();
        $regionalSpecs = RegionalSpec::active()->ordered()->get();
        $bodyTypes = BodyType::active()->ordered()->get();
        $seatsCounts = SeatsCount::active()->ordered()->get();
        $fuelTypes = FuelType::active()->ordered()->get();
        $transmissionTypes = TransmissionType::active()->ordered()->get();
        $engineCapacityRanges = EngineCapacityRange::active()->ordered()->get();
        $horsepowerRanges = HorsepowerRange::active()->ordered()->get();
        $cylindersCounts = CylindersCount::active()->ordered()->get();
        $steeringSides = SteeringSide::active()->ordered()->get();
        $exteriorColors = ExteriorColor::active()->ordered()->get();
        $interiorColors = InteriorColor::active()->ordered()->get();

        return view('admin.vehicles.create', compact(
            'brands',
            'regionalSpecs',
            'bodyTypes',
            'seatsCounts',
            'fuelTypes',
            'transmissionTypes',
            'engineCapacityRanges',
            'horsepowerRanges',
            'cylindersCounts',
            'steeringSides',
            'exteriorColors',
            'interiorColors'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_id' => 'required|exists:vehicle_brands,id',
            'model_id' => 'required|exists:vehicle_models,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'mileage' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:new,used,export',
            'publish_status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'is_available' => 'boolean',
            'regional_spec_id' => 'nullable|exists:regional_specs,id',
            'body_type_id' => 'nullable|exists:body_types,id',
            'seats_count_id' => 'nullable|exists:seats_counts,id',
            'fuel_type_id' => 'nullable|exists:fuel_types,id',
            'transmission_type_id' => 'nullable|exists:transmission_types,id',
            'engine_capacity_range_id' => 'nullable|exists:engine_capacity_ranges,id',
            'horsepower_range_id' => 'nullable|exists:horsepower_ranges,id',
            'cylinders_count_id' => 'nullable|exists:cylinders_counts,id',
            'steering_side_id' => 'nullable|exists:steering_sides,id',
            'exterior_color_id' => 'nullable|exists:exterior_colors,id',
            'interior_color_id' => 'nullable|exists:interior_colors,id',
            'vin_number' => 'nullable|string|unique:vehicles,vin_number',
            'features' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'purchase_date' => 'nullable|date',
            'warranty_expiry' => 'nullable|date',
            'insurance_expiry' => 'nullable|date',
            'registration_number' => 'nullable|string|max:20',
            'engine_number' => 'nullable|string|max:30',
            'chassis_number' => 'nullable|string|max:30',
            'doors_count' => 'nullable|in:2,3,4,5',
            'air_conditioning' => 'nullable|in:manual,automatic,dual_zone,none',
            'location_city' => 'nullable|string|max:100',
            'location_country' => 'nullable|string|max:100',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'priority_order' => 'nullable|integer|min:0|max:999',
        ]);

        // Generate slug
        $brand = VehicleBrand::find($validated['brand_id']);
        $model = VehicleModel::find($validated['model_id']);
        $slug = Str::slug($brand->name . ' ' . $model->name . ' ' . $validated['year']);

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            $featuredImagePath = $request->file('featured_image')->store('vehicles/featured', 'public');
            $validated['featured_image'] = $featuredImagePath;
        }

        // Set publish date if publishing
        if ($validated['publish_status'] === 'published') {
            $validated['published_at'] = now();
        }

        // Convert features string to array
        if (isset($validated['features']) && is_string($validated['features'])) {
            $validated['features'] = array_map('trim', explode(',', $validated['features']));
        }

        // Handle boolean fields
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_available'] = $request->has('is_available');
        $validated['is_negotiable'] = $request->has('is_negotiable');
        $validated['is_imported'] = $request->has('is_imported');

        // Create vehicle
        $vehicle = Vehicle::create(array_merge($validated, [
            'slug' => $slug,
            'user_id' => Auth::user()->id,
        ]));

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $imagePath = $image->store('vehicles/gallery', 'public');
                $vehicle->gallery()->create([
                    'image_path' => $imagePath,
                    'sort_order' => $vehicle->gallery()->count() + 1,
                ]);
            }
        }

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Vehicle created successfully.');
    }

    public function show(Vehicle $vehicle)
    {
        $vehicle->load([
            'brand', 'model', 'regionalSpec', 'bodyType', 'seatsCount',
            'fuelType', 'transmissionType', 'engineCapacityRange', 'horsepowerRange',
            'cylindersCount', 'steeringSide', 'exteriorColor', 'interiorColor',
            'gallery', 'user'
        ]);

        return view('admin.vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        $brands = VehicleBrand::active()->ordered()->get();
        $models = VehicleModel::where('brand_id', $vehicle->brand_id)->active()->ordered()->get();
        $regionalSpecs = RegionalSpec::active()->ordered()->get();
        $bodyTypes = BodyType::active()->ordered()->get();
        $seatsCounts = SeatsCount::active()->ordered()->get();
        $fuelTypes = FuelType::active()->ordered()->get();
        $transmissionTypes = TransmissionType::active()->ordered()->get();
        $engineCapacityRanges = EngineCapacityRange::active()->ordered()->get();
        $horsepowerRanges = HorsepowerRange::active()->ordered()->get();
        $cylindersCounts = CylindersCount::active()->ordered()->get();
        $steeringSides = SteeringSide::active()->ordered()->get();
        $exteriorColors = ExteriorColor::active()->ordered()->get();
        $interiorColors = InteriorColor::active()->ordered()->get();

        return view('admin.vehicles.edit', compact(
            'vehicle',
            'brands',
            'models',
            'regionalSpecs',
            'bodyTypes',
            'seatsCounts',
            'fuelTypes',
            'transmissionTypes',
            'engineCapacityRanges',
            'horsepowerRanges',
            'cylindersCounts',
            'steeringSides',
            'exteriorColors',
            'interiorColors'
        ));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'brand_id' => 'required|exists:vehicle_brands,id',
            'model_id' => 'required|exists:vehicle_models,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'mileage' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:new,used,export',
            'publish_status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'is_available' => 'boolean',
            'is_negotiable' => 'boolean',
            'is_imported' => 'boolean',
            'regional_spec_id' => 'nullable|exists:regional_specs,id',
            'body_type_id' => 'nullable|exists:body_types,id',
            'seats_count_id' => 'nullable|exists:seats_counts,id',
            'fuel_type_id' => 'nullable|exists:fuel_types,id',
            'transmission_type_id' => 'nullable|exists:transmission_types,id',
            'engine_capacity_range_id' => 'nullable|exists:engine_capacity_ranges,id',
            'horsepower_range_id' => 'nullable|exists:horsepower_ranges,id',
            'cylinders_count_id' => 'nullable|exists:cylinders_counts,id',
            'steering_side_id' => 'nullable|exists:steering_sides,id',
            'exterior_color_id' => 'nullable|exists:exterior_colors,id',
            'interior_color_id' => 'nullable|exists:interior_colors,id',
            'vin_number' => 'nullable|string|unique:vehicles,vin_number,' . $vehicle->id,
            'features' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'purchase_date' => 'nullable|date',
            'warranty_expiry' => 'nullable|date',
            'insurance_expiry' => 'nullable|date',
            'registration_number' => 'nullable|string|max:20',
            'engine_number' => 'nullable|string|max:30',
            'chassis_number' => 'nullable|string|max:30',
            'doors_count' => 'nullable|in:2,3,4,5',
            'air_conditioning' => 'nullable|in:manual,automatic,dual_zone,none',
            'location_city' => 'nullable|string|max:100',
            'location_country' => 'nullable|string|max:100',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'priority_order' => 'nullable|integer|min:0|max:999',
        ]);

        // Generate new slug if brand/model/year changed
        if ($vehicle->brand_id != $validated['brand_id'] ||
            $vehicle->model_id != $validated['model_id'] ||
            $vehicle->year != $validated['year']) {
            $brand = VehicleBrand::find($validated['brand_id']);
            $model = VehicleModel::find($validated['model_id']);
            $validated['slug'] = Str::slug($brand->name . ' ' . $model->name . ' ' . $validated['year']);
        }

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($vehicle->featured_image) {
                Storage::disk('public')->delete($vehicle->featured_image);
            }
            $featuredImagePath = $request->file('featured_image')->store('vehicles/featured', 'public');
            $validated['featured_image'] = $featuredImagePath;
        }

        // Convert features string to array
        if (isset($validated['features']) && is_string($validated['features'])) {
            $validated['features'] = array_map('trim', explode(',', $validated['features']));
        }

        // Handle boolean fields
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_available'] = $request->has('is_available');
        $validated['is_negotiable'] = $request->has('is_negotiable');
        $validated['is_imported'] = $request->has('is_imported');

        // Set publish date if publishing
        if ($validated['publish_status'] === 'published' && $vehicle->publish_status !== 'published') {
            $validated['published_at'] = now();
        }

        // Update vehicle
        $vehicle->update($validated);

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $imagePath = $image->store('vehicles/gallery', 'public');
                $vehicle->gallery()->create([
                    'image_path' => $imagePath,
                    'sort_order' => $vehicle->gallery()->count() + 1,
                ]);
            }
        }

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        // Delete featured image
        if ($vehicle->featured_image) {
            Storage::disk('public')->delete($vehicle->featured_image);
        }

        // Delete gallery images
        foreach ($vehicle->gallery as $galleryImage) {
            Storage::disk('public')->delete($galleryImage->image_path);
        }

        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Vehicle deleted successfully.');
    }

    public function getModels(Request $request)
    {
        $models = VehicleModel::where('brand_id', $request->brand_id)
            ->active()
            ->ordered()
            ->get(['id', 'name']);

        return response()->json($models);
    }

    public function searchBrands(Request $request)
    {
        $search = $request->get('search', '');

        $brands = VehicleBrand::where('name', 'like', "%{$search}%")
            ->active()
            ->ordered()
            ->limit(20)
            ->get(['id', 'name']);

        return response()->json($brands);
    }

    public function toggleFeatured(Vehicle $vehicle)
    {
        $vehicle->update(['is_featured' => !$vehicle->is_featured]);

        return response()->json([
            'success' => true,
            'is_featured' => $vehicle->is_featured,
            'message' => $vehicle->is_featured ? 'Vehicle marked as featured.' : 'Vehicle unmarked as featured.'
        ]);
    }

    public function toggleAvailable(Vehicle $vehicle)
    {
        $vehicle->update(['is_available' => !$vehicle->is_available]);

        return response()->json([
            'success' => true,
            'is_available' => $vehicle->is_available,
            'message' => $vehicle->is_available ? 'Vehicle marked as available.' : 'Vehicle marked as unavailable.'
        ]);
    }
}
