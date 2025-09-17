<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleVariant;
use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class VehicleVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicleVariants = VehicleVariant::with('model.brand')->ordered()->paginate(20);
        return view('admin.vehicle-variants.index', compact('vehicleVariants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vehicle-variants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'model_id' => 'required|exists:vehicle_models,id',
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_en' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        VehicleVariant::create($validated);

        return redirect()->route('admin.vehicle-variants.index')
            ->with('success', 'واریانت خودرو با موفقیت ایجاد شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(VehicleVariant $vehicleVariant)
    {
        $vehicleVariant->load(['model.brand', 'vehicles']);
        return view('admin.vehicle-variants.show', compact('vehicleVariant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VehicleVariant $vehicleVariant)
    {
        return view('admin.vehicle-variants.edit', compact('vehicleVariant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VehicleVariant $vehicleVariant)
    {
        $validated = $request->validate([
            'model_id' => 'required|exists:vehicle_models,id',
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_en' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        $vehicleVariant->update($validated);

        return redirect()->route('admin.vehicle-variants.index')
            ->with('success', 'واریانت خودرو با موفقیت به‌روزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleVariant $vehicleVariant)
    {
        // Check if variant has vehicles
        if ($vehicleVariant->vehicles()->count() > 0) {
            return back()->with('error', 'این واریانت قابل حذف نیست زیرا دارای خودرو است.');
        }

        $vehicleVariant->delete();

        return redirect()->route('admin.vehicle-variants.index')
            ->with('success', 'واریانت خودرو با موفقیت حذف شد.');
    }
}
