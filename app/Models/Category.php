<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the translations for the category.
     */
    public function translations(): HasMany
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    /**
     * Get the articles for the category.
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Get the current language translation.
     */
    public function translation()
    {
        $currentLanguage = Language::where('code', app()->getLocale())->first();

        if (!$currentLanguage) {
            $currentLanguage = Language::where('is_default', true)->first();
        }

        if (!$currentLanguage) {
            $currentLanguage = Language::first();
        }

        return $this->translations()->where('language_id', $currentLanguage->id)->first();
    }

    /**
     * Scope a query to only include active categories.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /**
     * Get the name attribute.
     */
    public function getNameAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->name : $this->slug;
    }

    /**
     * Get the description attribute.
     */
    public function getDescriptionAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->description : null;
    }

    /**
     * Get the meta title attribute.
     */
    public function getMetaTitleAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->meta_title : $this->name;
    }

    /**
     * Get the meta description attribute.
     */
    public function getMetaDescriptionAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->meta_description : null;
    }

    /**
     * Get the featured image attribute.
     */
    public function getFeaturedImageAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->featured_image : null;
    }
}
