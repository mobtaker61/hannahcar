<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class VehicleBrandController extends Controller
{
    public function index()
    {
        $brands = VehicleBrand::withCount('vehicles')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(20);

        return view('admin.vehicle-brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.vehicle-brands.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:vehicle_brands,name',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('brands/logos', 'public');
            $validated['logo'] = $logoPath;
        }

        VehicleBrand::create($validated);

        return redirect()->route('admin.vehicle-brands.index')
            ->with('success', 'Brand created successfully.');
    }

    public function show(VehicleBrand $brand)
    {
        $brand->load(['models', 'vehicles' => function ($query) {
            $query->latest()->take(10);
        }]);

        return view('admin.vehicle-brands.show', compact('brand'));
    }

    public function edit(VehicleBrand $brand)
    {
        return view('admin.vehicle-brands.edit', compact('brand'));
    }

    public function update(Request $request, VehicleBrand $brand)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:vehicle_brands,name,' . $brand->id,
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($brand->logo) {
                Storage::disk('public')->delete($brand->logo);
            }
            $logoPath = $request->file('logo')->store('brands/logos', 'public');
            $validated['logo'] = $logoPath;
        }

        $brand->update($validated);

        return redirect()->route('admin.vehicle-brands.index')
            ->with('success', 'Brand updated successfully.');
    }

    public function destroy(VehicleBrand $brand)
    {
        // Check if brand has vehicles
        if ($brand->vehicles()->count() > 0) {
            return redirect()->route('admin.vehicle-brands.index')
                ->with('error', 'Cannot delete brand with existing vehicles.');
        }

        // Delete logo
        if ($brand->logo) {
            Storage::disk('public')->delete($brand->logo);
        }

        $brand->delete();

        return redirect()->route('admin.vehicle-brands.index')
            ->with('success', 'Brand deleted successfully.');
    }
}
