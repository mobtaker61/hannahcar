<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSliderTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_slider_id',
        'language_id',
        'title',
        'subtitle',
        'description',
        'button_text',
        'badge_text',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationships
    public function heroSlider()
    {
        return $this->belongsTo(HeroSlider::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByLanguage($query, $languageId)
    {
        return $query->where('language_id', $languageId);
    }
}
