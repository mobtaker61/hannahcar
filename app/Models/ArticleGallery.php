<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticleGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'image_path',
        'alt_text',
        'caption',
        'sort_order',
    ];

    /**
     * Get the article that owns the gallery image.
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }



    /**
     * Scope a query to order by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
