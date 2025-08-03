<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticleLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'user_id',
        'ip_address',
        'user_agent',
    ];

    /**
     * Get the article that owns the like.
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Get the user that owns the like.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if a user has liked an article.
     */
    public static function hasLiked($articleId, $userId = null, $ipAddress = null)
    {
        $query = static::where('article_id', $articleId);

        if ($userId) {
            $query->where('user_id', $userId);
        } elseif ($ipAddress) {
            $query->where('ip_address', $ipAddress);
        }

        return $query->exists();
    }

    /**
     * Toggle like for an article.
     */
    public static function toggleLike($articleId, $userId = null, $ipAddress = null)
    {
        $existingLike = static::where('article_id', $articleId);

        if ($userId) {
            $existingLike->where('user_id', $userId);
        } elseif ($ipAddress) {
            $existingLike->where('ip_address', $ipAddress);
        }

        $existingLike = $existingLike->first();

        if ($existingLike) {
            $existingLike->delete();
            return false; // Unlike
        } else {
            static::create([
                'article_id' => $articleId,
                'user_id' => $userId,
                'ip_address' => $ipAddress,
                'user_agent' => request()->userAgent(),
            ]);
            return true; // Like
        }
    }
}
