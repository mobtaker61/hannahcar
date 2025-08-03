<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'brand_id',
        'model_id',
        'year',
        'price',
        'currency',
        'mileage',
        'description',
        'status',
        'publish_status',
        'is_featured',
        'is_available',
        'regional_spec_id',
        'body_type_id',
        'seats_count_id',
        'fuel_type_id',
        'transmission_type_id',
        'engine_capacity_range_id',
        'horsepower_range_id',
        'cylinders_count_id',
        'steering_side_id',
        'exterior_color_id',
        'interior_color_id',
        'vin_number',
        'features',
        'featured_image',
        'views_count',
        'user_id',
        'published_at',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'features' => 'array',
        'is_featured' => 'boolean',
        'is_available' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Relationships
    public function brand(): BelongsTo
    {
        return $this->belongsTo(VehicleBrand::class, 'brand_id');
    }

    public function model(): BelongsTo
    {
        return $this->belongsTo(VehicleModel::class, 'model_id');
    }

    public function regionalSpec(): BelongsTo
    {
        return $this->belongsTo(RegionalSpec::class, 'regional_spec_id');
    }

    public function bodyType(): BelongsTo
    {
        return $this->belongsTo(BodyType::class, 'body_type_id');
    }

    public function seatsCount(): BelongsTo
    {
        return $this->belongsTo(SeatsCount::class, 'seats_count_id');
    }

    public function fuelType(): BelongsTo
    {
        return $this->belongsTo(FuelType::class, 'fuel_type_id');
    }

    public function transmissionType(): BelongsTo
    {
        return $this->belongsTo(TransmissionType::class, 'transmission_type_id');
    }

    public function engineCapacityRange(): BelongsTo
    {
        return $this->belongsTo(EngineCapacityRange::class, 'engine_capacity_range_id');
    }

    public function horsepowerRange(): BelongsTo
    {
        return $this->belongsTo(HorsepowerRange::class, 'horsepower_range_id');
    }

    public function cylindersCount(): BelongsTo
    {
        return $this->belongsTo(CylindersCount::class, 'cylinders_count_id');
    }

    public function steeringSide(): BelongsTo
    {
        return $this->belongsTo(SteeringSide::class, 'steering_side_id');
    }

    public function exteriorColor(): BelongsTo
    {
        return $this->belongsTo(ExteriorColor::class, 'exterior_color_id');
    }

    public function interiorColor(): BelongsTo
    {
        return $this->belongsTo(InteriorColor::class, 'interior_color_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function gallery(): HasMany
    {
        return $this->hasMany(VehicleGallery::class);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('publish_status', 'published')
                    ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeUsed($query)
    {
        return $query->where('status', 'used');
    }

    public function scopeExport($query)
    {
        return $query->where('status', 'export');
    }

    public function scopeByBrand($query, $brandId)
    {
        return $query->where('brand_id', $brandId);
    }

    public function scopeByModel($query, $modelId)
    {
        return $query->where('model_id', $modelId);
    }

    public function scopeByYear($query, $year)
    {
        return $query->where('year', $year);
    }

    public function scopeByPriceRange($query, $minPrice, $maxPrice)
    {
        return $query->whereBetween('price', [$minPrice, $maxPrice]);
    }

    public function scopeByMileageRange($query, $minMileage, $maxMileage)
    {
        return $query->whereBetween('mileage', [$minMileage, $maxMileage]);
    }

    // Accessors
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price) . ' ' . $this->currency;
    }

    public function getFormattedMileageAttribute()
    {
        if (!$this->mileage) return null;
        return number_format($this->mileage) . ' km';
    }

    public function getFullNameAttribute()
    {
        return $this->brand->name . ' ' . $this->model->name . ' ' . $this->year;
    }

    // Methods
    public function incrementViews()
    {
        $this->increment('views_count');
    }
}
