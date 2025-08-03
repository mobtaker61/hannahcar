<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSlider extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'button_url',
        'badge_color',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationships
    public function translations()
    {
        return $this->hasMany(HeroSliderTranslation::class);
    }

    public function translation($languageId = null)
    {
        if (!$languageId) {
            $languageId = app()->getLocale() === 'fa' ? 1 : (app()->getLocale() === 'en' ? 2 : 3);
        }

        return $this->translations()->where('language_id', $languageId)->first();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    // Methods
    public function getTitleAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->title : '';
    }

    public function getSubtitleAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->subtitle : '';
    }

    public function getDescriptionAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->description : '';
    }

    public function getButtonTextAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->button_text : '';
    }

    public function getBadgeTextAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->badge_text : '';
    }
}
