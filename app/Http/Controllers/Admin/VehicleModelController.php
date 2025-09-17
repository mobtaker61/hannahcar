<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleModel;
use App\Models\VehicleBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VehicleModelController extends Controller
{
    public function index(Request $request)
    {
        $query = VehicleModel::with(['brand'])
            ->orderBy('sort_order')
            ->orderBy('name');

        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        $models = $query->paginate(20);

        return view('admin.vehicle-models.index', compact('models'));
    }

    public function create()
    {
        return view('admin.vehicle-models.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_id' => 'required|exists:vehicle_brands,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        VehicleModel::create($validated);

        return redirect()->route('admin.vehicle-models.index')
            ->with('success', 'Model created successfully.');
    }

    public function show(VehicleModel $vehicleModel)
    {
        $vehicleModel->load(['brand', 'vehicles' => function ($query) {
            $query->latest()->take(10);
        }, 'variants' => function ($query) {
            $query->latest()->take(10);
        }]);

        return view('admin.vehicle-models.show', compact('vehicleModel'));
    }

    public function edit(VehicleModel $vehicleModel)
    {
        return view('admin.vehicle-models.edit', compact('vehicleModel'));
    }

    public function update(Request $request, VehicleModel $vehicleModel)
    {
        $validated = $request->validate([
            'brand_id' => 'required|exists:vehicle_brands,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $vehicleModel->update($validated);

        return redirect()->route('admin.vehicle-models.index')
            ->with('success', 'Model updated successfully.');
    }

    public function destroy(VehicleModel $vehicleModel)
    {
        // Check if model has vehicles
        if ($vehicleModel->vehicles()->count() > 0) {
            return redirect()->route('admin.vehicle-models.index')
                ->with('error', 'Cannot delete model with existing vehicles.');
        }

        $vehicleModel->delete();

        return redirect()->route('admin.vehicle-models.index')
            ->with('success', 'Model deleted successfully.');
    }

    public function select(Request $request)
    {
        $search = $request->get('q', '');
        $brandId = $request->get('brand_id');

        $query = VehicleModel::where('is_active', true);

        if ($brandId) {
            $query->where('brand_id', $brandId);
        }

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $models = $query->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(10);

        $formattedModels = $models->map(function ($model) {
            return [
                'id' => $model->id,
                'text' => $model->name
            ];
        });

        return response()->json([
            'data' => $formattedModels,
            'total' => $models->total()
        ]);
    }

    public function toggleStatus(VehicleModel $vehicleModel)
    {
        $vehicleModel->update(['is_active' => !$vehicleModel->is_active]);

        return response()->json([
            'success' => true,
            'is_active' => $vehicleModel->is_active,
            'message' => $vehicleModel->is_active ? 'Model activated successfully.' : 'Model deactivated successfully.'
        ]);
    }

    public function getByBrand(VehicleBrand $brand)
    {
        $models = VehicleModel::where('brand_id', $brand->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json([
            'models' => $models
        ]);
    }
}
