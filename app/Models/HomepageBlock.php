<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationships
    public function translations()
    {
        return $this->hasMany(HomepageBlockTranslation::class);
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
}
