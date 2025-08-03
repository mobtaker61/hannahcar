<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageBlockTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'homepage_block_id',
        'language_id',
        'title',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationships
    public function homepageBlock()
    {
        return $this->belongsTo(HomepageBlock::class);
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
