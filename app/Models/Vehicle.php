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
        'external_id',
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
        'is_negotiable',
        'is_imported',
        'purchase_date',
        'warranty_expiry',
        'insurance_expiry',
        'registration_number',
        'engine_number',
        'chassis_number',
        'doors_count',
        'air_conditioning',
        'location_city',
        'location_country',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'priority_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'features' => 'array',
        'is_featured' => 'boolean',
        'is_available' => 'boolean',
        'is_negotiable' => 'boolean',
        'is_imported' => 'boolean',
        'published_at' => 'datetime',
        'purchase_date' => 'date',
        'warranty_expiry' => 'date',
        'insurance_expiry' => 'date',
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
        if (!$this->price) return '';
        $currency = $this->currency ?: '';
        return number_format($this->price) . ' ' . $currency;
    }

    public function getFormattedMileageAttribute()
    {
        if (!$this->mileage) return '';
        return number_format($this->mileage) . ' km';
    }

    public function getFullNameAttribute()
    {
        $brandName = $this->brand ? $this->brand->name : '';
        $modelName = $this->model ? $this->model->name : '';
        $year = $this->year ?: '';

        $parts = array_filter([$brandName, $modelName, $year]);
        return implode(' ', $parts);
    }

    public function getFeaturesTextAttribute()
    {
        if (is_array($this->features) && !empty($this->features)) {
            return implode(', ', $this->features);
        }
        return '';
    }

    public function getFeaturesArrayAttribute()
    {
        if (is_array($this->features)) {
            return $this->features;
        }
        return [];
    }

    // Methods
    public function incrementViews()
    {
        $this->increment('views_count');
    }
}
