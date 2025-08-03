<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'native_name',
        'direction',
        'is_active',
        'is_default',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
    ];

    // Relationships
    public function pageTranslations()
    {
        return $this->hasMany(PageTranslation::class);
    }

    public function heroSliderTranslations()
    {
        return $this->hasMany(HeroSliderTranslation::class);
    }

    public function homepageBlockTranslations()
    {
        return $this->hasMany(HomepageBlockTranslation::class);
    }

    public function menuItemTranslations()
    {
        return $this->hasMany(MenuItemTranslation::class);
    }

    public function settingTranslations()
    {
        return $this->hasMany(SettingTranslation::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    // Methods
    public static function getDefault()
    {
        return static::default()->first();
    }

    public static function getActive()
    {
        return static::active()->orderBy('sort_order')->get();
    }
}
