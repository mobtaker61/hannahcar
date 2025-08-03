<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

class VehicleSpecificationsController extends Controller
{
    public function index()
    {
        // Load all specifications data
        $regionalSpecs = RegionalSpec::withCount('vehicles')->ordered()->get();
        $bodyTypes = BodyType::withCount('vehicles')->ordered()->get();
        $seatsCounts = SeatsCount::withCount('vehicles')->ordered()->get();
        $fuelTypes = FuelType::withCount('vehicles')->ordered()->get();
        $transmissionTypes = TransmissionType::withCount('vehicles')->ordered()->get();
        $engineCapacityRanges = EngineCapacityRange::withCount('vehicles')->ordered()->get();
        $horsepowerRanges = HorsepowerRange::withCount('vehicles')->ordered()->get();
        $cylindersCounts = CylindersCount::withCount('vehicles')->ordered()->get();
        $steeringSides = SteeringSide::withCount('vehicles')->ordered()->get();
        $exteriorColors = ExteriorColor::withCount('vehicles')->ordered()->get();
        $interiorColors = InteriorColor::withCount('vehicles')->ordered()->get();

        return view('admin.vehicle-specifications.index', compact(
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

    // Regional Specs
    public function storeRegionalSpec(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:regional_specs,name',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        RegionalSpec::create($validated);

        return response()->json(['success' => true, 'message' => 'Regional spec created successfully.']);
    }

    public function editRegionalSpec(RegionalSpec $regionalSpec)
    {
        return response()->json($regionalSpec);
    }

    public function updateRegionalSpec(Request $request, RegionalSpec $regionalSpec)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:regional_specs,name,' . $regionalSpec->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $regionalSpec->update($validated);

        return response()->json(['success' => true, 'message' => 'Regional spec updated successfully.']);
    }

    public function destroyRegionalSpec(RegionalSpec $regionalSpec)
    {
        if ($regionalSpec->vehicles()->count() > 0) {
            return response()->json(['success' => false, 'message' => 'Cannot delete regional spec with existing vehicles.'], 422);
        }

        $regionalSpec->delete();
        return response()->json(['success' => true, 'message' => 'Regional spec deleted successfully.']);
    }

    // Body Types
    public function storeBodyType(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:body_types,name',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        BodyType::create($validated);

        return response()->json(['success' => true, 'message' => 'Body type created successfully.']);
    }

    public function editBodyType(BodyType $bodyType)
    {
        return response()->json($bodyType);
    }

    public function updateBodyType(Request $request, BodyType $bodyType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:body_types,name,' . $bodyType->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $bodyType->update($validated);

        return response()->json(['success' => true, 'message' => 'Body type updated successfully.']);
    }

    public function destroyBodyType(BodyType $bodyType)
    {
        if ($bodyType->vehicles()->count() > 0) {
            return response()->json(['success' => false, 'message' => 'Cannot delete body type with existing vehicles.'], 422);
        }

        $bodyType->delete();
        return response()->json(['success' => true, 'message' => 'Body type deleted successfully.']);
    }

    // Seats Counts
    public function storeSeatsCount(Request $request)
    {
        $validated = $request->validate([
            'count' => 'required|integer|min:1|max:20|unique:seats_counts,count',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['count'] . '-seats');
        SeatsCount::create($validated);

        return response()->json(['success' => true, 'message' => 'Seats count created successfully.']);
    }

    public function editSeatsCount(SeatsCount $seatsCount)
    {
        return response()->json($seatsCount);
    }

    public function updateSeatsCount(Request $request, SeatsCount $seatsCount)
    {
        $validated = $request->validate([
            'count' => 'required|integer|min:1|max:20|unique:seats_counts,count,' . $seatsCount->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['count'] . '-seats');
        $seatsCount->update($validated);

        return response()->json(['success' => true, 'message' => 'Seats count updated successfully.']);
    }

    public function destroySeatsCount(SeatsCount $seatsCount)
    {
        if ($seatsCount->vehicles()->count() > 0) {
            return response()->json(['success' => false, 'message' => 'Cannot delete seats count with existing vehicles.'], 422);
        }

        $seatsCount->delete();
        return response()->json(['success' => true, 'message' => 'Seats count deleted successfully.']);
    }

    // Fuel Types
    public function storeFuelType(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:fuel_types,name',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        FuelType::create($validated);

        return response()->json(['success' => true, 'message' => 'Fuel type created successfully.']);
    }

    public function editFuelType(FuelType $fuelType)
    {
        return response()->json($fuelType);
    }

    public function updateFuelType(Request $request, FuelType $fuelType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:fuel_types,name,' . $fuelType->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $fuelType->update($validated);

        return response()->json(['success' => true, 'message' => 'Fuel type updated successfully.']);
    }

    public function destroyFuelType(FuelType $fuelType)
    {
        if ($fuelType->vehicles()->count() > 0) {
            return response()->json(['success' => false, 'message' => 'Cannot delete fuel type with existing vehicles.'], 422);
        }

        $fuelType->delete();
        return response()->json(['success' => true, 'message' => 'Fuel type deleted successfully.']);
    }

    // Transmission Types
    public function storeTransmissionType(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:transmission_types,name',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        TransmissionType::create($validated);

        return response()->json(['success' => true, 'message' => 'Transmission type created successfully.']);
    }

    public function editTransmissionType(TransmissionType $transmissionType)
    {
        return response()->json($transmissionType);
    }

    public function updateTransmissionType(Request $request, TransmissionType $transmissionType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:transmission_types,name,' . $transmissionType->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $transmissionType->update($validated);

        return response()->json(['success' => true, 'message' => 'Transmission type updated successfully.']);
    }

    public function destroyTransmissionType(TransmissionType $transmissionType)
    {
        if ($transmissionType->vehicles()->count() > 0) {
            return response()->json(['success' => false, 'message' => 'Cannot delete transmission type with existing vehicles.'], 422);
        }

        $transmissionType->delete();
        return response()->json(['success' => true, 'message' => 'Transmission type deleted successfully.']);
    }

    // Engine Capacity Ranges
    public function storeEngineCapacityRange(Request $request)
    {
        $validated = $request->validate([
            'min_capacity' => 'required|integer|min:0',
            'max_capacity' => 'required|integer|min:0|gte:min_capacity',
            'display_name' => 'required|string|max:255|unique:engine_capacity_ranges,display_name',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['display_name']);
        EngineCapacityRange::create($validated);

        return response()->json(['success' => true, 'message' => 'Engine capacity range created successfully.']);
    }

    public function editEngineCapacityRange(EngineCapacityRange $engineCapacityRange)
    {
        return response()->json($engineCapacityRange);
    }

    public function updateEngineCapacityRange(Request $request, EngineCapacityRange $engineCapacityRange)
    {
        $validated = $request->validate([
            'min_capacity' => 'required|integer|min:0',
            'max_capacity' => 'required|integer|min:0|gte:min_capacity',
            'display_name' => 'required|string|max:255|unique:engine_capacity_ranges,display_name,' . $engineCapacityRange->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['display_name']);
        $engineCapacityRange->update($validated);

        return response()->json(['success' => true, 'message' => 'Engine capacity range updated successfully.']);
    }

    public function destroyEngineCapacityRange(EngineCapacityRange $engineCapacityRange)
    {
        if ($engineCapacityRange->vehicles()->count() > 0) {
            return response()->json(['success' => false, 'message' => 'Cannot delete engine capacity range with existing vehicles.'], 422);
        }

        $engineCapacityRange->delete();
        return response()->json(['success' => true, 'message' => 'Engine capacity range deleted successfully.']);
    }

    // Horsepower Ranges
    public function storeHorsepowerRange(Request $request)
    {
        $validated = $request->validate([
            'min_horsepower' => 'required|integer|min:0',
            'max_horsepower' => 'required|integer|min:0|gte:min_horsepower',
            'display_name' => 'required|string|max:255|unique:horsepower_ranges,display_name',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['display_name']);
        HorsepowerRange::create($validated);

        return response()->json(['success' => true, 'message' => 'Horsepower range created successfully.']);
    }

    public function editHorsepowerRange(HorsepowerRange $horsepowerRange)
    {
        return response()->json($horsepowerRange);
    }

    public function updateHorsepowerRange(Request $request, HorsepowerRange $horsepowerRange)
    {
        $validated = $request->validate([
            'min_horsepower' => 'required|integer|min:0',
            'max_horsepower' => 'required|integer|min:0|gte:min_horsepower',
            'display_name' => 'required|string|max:255|unique:horsepower_ranges,display_name,' . $horsepowerRange->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['display_name']);
        $horsepowerRange->update($validated);

        return response()->json(['success' => true, 'message' => 'Horsepower range updated successfully.']);
    }

    public function destroyHorsepowerRange(HorsepowerRange $horsepowerRange)
    {
        if ($horsepowerRange->vehicles()->count() > 0) {
            return response()->json(['success' => false, 'message' => 'Cannot delete horsepower range with existing vehicles.'], 422);
        }

        $horsepowerRange->delete();
        return response()->json(['success' => true, 'message' => 'Horsepower range deleted successfully.']);
    }

    // Cylinders Counts
    public function storeCylindersCount(Request $request)
    {
        $validated = $request->validate([
            'count' => 'required|integer|min:1|max:16|unique:cylinders_counts,count',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['count'] . '-cylinders');
        CylindersCount::create($validated);

        return response()->json(['success' => true, 'message' => 'Cylinders count created successfully.']);
    }

    public function editCylindersCount(CylindersCount $cylindersCount)
    {
        return response()->json($cylindersCount);
    }

    public function updateCylindersCount(Request $request, CylindersCount $cylindersCount)
    {
        $validated = $request->validate([
            'count' => 'required|integer|min:1|max:16|unique:cylinders_counts,count,' . $cylindersCount->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['count'] . '-cylinders');
        $cylindersCount->update($validated);

        return response()->json(['success' => true, 'message' => 'Cylinders count updated successfully.']);
    }

    public function destroyCylindersCount(CylindersCount $cylindersCount)
    {
        if ($cylindersCount->vehicles()->count() > 0) {
            return response()->json(['success' => false, 'message' => 'Cannot delete cylinders count with existing vehicles.'], 422);
        }

        $cylindersCount->delete();
        return response()->json(['success' => true, 'message' => 'Cylinders count deleted successfully.']);
    }

    // Steering Sides
    public function storeSteeringSide(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:steering_sides,name',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        SteeringSide::create($validated);

        return response()->json(['success' => true, 'message' => 'Steering side created successfully.']);
    }

    public function editSteeringSide(SteeringSide $steeringSide)
    {
        return response()->json($steeringSide);
    }

    public function updateSteeringSide(Request $request, SteeringSide $steeringSide)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:steering_sides,name,' . $steeringSide->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $steeringSide->update($validated);

        return response()->json(['success' => true, 'message' => 'Steering side updated successfully.']);
    }

    public function destroySteeringSide(SteeringSide $steeringSide)
    {
        if ($steeringSide->vehicles()->count() > 0) {
            return response()->json(['success' => false, 'message' => 'Cannot delete steering side with existing vehicles.'], 422);
        }

        $steeringSide->delete();
        return response()->json(['success' => true, 'message' => 'Steering side deleted successfully.']);
    }

    // Exterior Colors
    public function storeExteriorColor(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:exterior_colors,name',
            'hex_code' => 'nullable|string|max:7',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        ExteriorColor::create($validated);

        return response()->json(['success' => true, 'message' => 'Exterior color created successfully.']);
    }

    public function editExteriorColor(ExteriorColor $exteriorColor)
    {
        return response()->json($exteriorColor);
    }

    public function updateExteriorColor(Request $request, ExteriorColor $exteriorColor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:exterior_colors,name,' . $exteriorColor->id,
            'hex_code' => 'nullable|string|max:7',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $exteriorColor->update($validated);

        return response()->json(['success' => true, 'message' => 'Exterior color updated successfully.']);
    }

    public function destroyExteriorColor(ExteriorColor $exteriorColor)
    {
        if ($exteriorColor->vehicles()->count() > 0) {
            return response()->json(['success' => false, 'message' => 'Cannot delete exterior color with existing vehicles.'], 422);
        }

        $exteriorColor->delete();
        return response()->json(['success' => true, 'message' => 'Exterior color deleted successfully.']);
    }

    // Interior Colors
    public function storeInteriorColor(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:interior_colors,name',
            'hex_code' => 'nullable|string|max:7',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        InteriorColor::create($validated);

        return response()->json(['success' => true, 'message' => 'Interior color created successfully.']);
    }

    public function editInteriorColor(InteriorColor $interiorColor)
    {
        return response()->json($interiorColor);
    }

    public function updateInteriorColor(Request $request, InteriorColor $interiorColor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:interior_colors,name,' . $interiorColor->id,
            'hex_code' => 'nullable|string|max:7',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $interiorColor->update($validated);

        return response()->json(['success' => true, 'message' => 'Interior color updated successfully.']);
    }

    public function destroyInteriorColor(InteriorColor $interiorColor)
    {
        if ($interiorColor->vehicles()->count() > 0) {
            return response()->json(['success' => false, 'message' => 'Cannot delete interior color with existing vehicles.'], 422);
        }

        $interiorColor->delete();
        return response()->json(['success' => true, 'message' => 'Interior color deleted successfully.']);
    }
}
