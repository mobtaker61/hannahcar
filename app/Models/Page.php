<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'template',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    // Relationships
    public function translations()
    {
        return $this->hasMany(PageTranslation::class);
    }

    public function translation($languageId = null)
    {
        if (!$languageId) {
            $languageId = app()->getLocale() === 'fa' ? 1 : (app()->getLocale() === 'en' ? 2 : 3);
        }

        return $this->translations()->where('language_id', $languageId)->first();
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeByTemplate($query, $template)
    {
        return $query->where('template', $template);
    }

    // Methods
    public function getTitleAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->title : '';
    }

    public function getContentAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->content : '';
    }

    public function getMetaTitleAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->meta_title : '';
    }

    public function getMetaDescriptionAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->meta_description : '';
    }

    public function getMetaKeywordsAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->meta_keywords : '';
    }
}
