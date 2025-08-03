<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticleTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'language_id',
        'title',
        'content',
        'excerpt',
        'meta_title',
        'meta_description',
        'featured_image',
        'tags',
        'author_name',
        'source_url',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    /**
     * Get the article that owns the translation.
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Get the language that owns the translation.
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
