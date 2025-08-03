<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'type',
        'category_id',
        'user_id',
        'status',
        'is_featured',
        'allow_comments',
        'views_count',
        'icon',
        'featured_image',
        'published_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'allow_comments' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Get the category that owns the article.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the user that owns the article.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the translations for the article.
     */
    public function translations(): HasMany
    {
        return $this->hasMany(ArticleTranslation::class);
    }

    /**
     * Get the gallery images for the article.
     */
    public function gallery(): HasMany
    {
        return $this->hasMany(ArticleGallery::class);
    }

    /**
     * Get the comments for the article.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(ArticleComment::class);
    }

    /**
     * Get the approved comments for the article.
     */
    public function approvedComments(): HasMany
    {
        return $this->comments()->where('status', 'approved');
    }

    /**
     * Get the likes for the article.
     */
    public function likes(): HasMany
    {
        return $this->hasMany(ArticleLike::class);
    }

    /**
     * Get the shares for the article.
     */
    public function shares(): HasMany
    {
        return $this->hasMany(ArticleShare::class);
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
     * Scope a query to only include published articles.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    /**
     * Scope a query to only include featured articles.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to only include articles with comments allowed.
     */
    public function scopeCommentsAllowed($query)
    {
        return $query->where('allow_comments', true);
    }

    /**
     * Scope a query to order by published date.
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    /**
     * Scope a query to order by views count.
     */
    public function scopePopular($query)
    {
        return $query->orderBy('views_count', 'desc');
    }

    /**
     * Scope a query to only include articles (not news or services).
     */
    public function scopeArticles($query)
    {
        return $query->where('type', 'article');
    }

    /**
     * Scope a query to only include news.
     */
    public function scopeNews($query)
    {
        return $query->where('type', 'news');
    }

    /**
     * Scope a query to only include services.
     */
    public function scopeServices($query)
    {
        return $query->where('type', 'service');
    }

    /**
     * Scope a query to only include articles and news (exclude services).
     */
    public function scopeArticlesAndNews($query)
    {
        return $query->whereIn('type', ['article', 'news']);
    }

    /**
     * Increment the views count.
     */
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    /**
     * Get the title attribute.
     */
    public function getTitleAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->title : $this->slug;
    }

    /**
     * Get the content attribute.
     */
    public function getContentAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->content : null;
    }

    /**
     * Get the excerpt attribute.
     */
    public function getExcerptAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->excerpt : null;
    }

    /**
     * Get the meta title attribute.
     */
    public function getMetaTitleAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->meta_title : $this->title;
    }

    /**
     * Get the meta description attribute.
     */
    public function getMetaDescriptionAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->meta_description : $this->excerpt;
    }

    /**
     * Get the tags attribute.
     */
    public function getTagsAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->tags : [];
    }

    /**
     * Get the author name attribute.
     */
    public function getAuthorNameAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->author_name : ($this->user ? $this->user->name : null);
    }

    /**
     * Get the source url attribute.
     */
    public function getSourceUrlAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->source_url : null;
    }

    /**
     * Check if the article is published.
     */
    public function isPublished()
    {
        return $this->status === 'published' && $this->published_at && $this->published_at <= now();
    }

    /**
     * Check if the article can be commented on.
     */
    public function canComment()
    {
        return $this->allow_comments && $this->isPublished();
    }

    /**
     * Get the likes count.
     */
    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    /**
     * Get the comments count.
     */
    public function getCommentsCountAttribute()
    {
        return $this->approvedComments()->count();
    }

    /**
     * Get the shares count.
     */
    public function getSharesCountAttribute()
    {
        return $this->shares()->count();
    }
}
