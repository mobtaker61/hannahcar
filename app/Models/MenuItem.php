<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'url',
        'target',
        'parent_id',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationships
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function translations()
    {
        return $this->hasMany(MenuItemTranslation::class);
    }

    public function translation($languageId = null)
    {
        if (!$languageId) {
            $languageId = app()->getLocale() === 'fa' ? 1 : (app()->getLocale() === 'en' ? 2 : 3);
        }

        return $this->translations()->where('language_id', $languageId)->first();
    }

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByMenu($query, $menuId)
    {
        return $query->where('menu_id', $menuId);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    // Methods
    public function getTitleAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->title : '';
    }

    public function hasChildren()
    {
        return $this->children()->count() > 0;
    }
}
