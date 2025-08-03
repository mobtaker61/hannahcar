<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticleShare extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'user_id',
        'platform',
        'ip_address',
        'user_agent',
    ];

    /**
     * Get the article that owns the share.
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Get the user that owns the share.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the platform name.
     */
    public function getPlatformNameAttribute()
    {
        $platforms = [
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'linkedin' => 'LinkedIn',
            'telegram' => 'Telegram',
            'whatsapp' => 'WhatsApp',
            'email' => 'Email',
            'copy_link' => 'Copy Link',
        ];

        return $platforms[$this->platform] ?? $this->platform;
    }

    /**
     * Get the platform icon.
     */
    public function getPlatformIconAttribute()
    {
        $icons = [
            'facebook' => 'fab fa-facebook',
            'twitter' => 'fab fa-twitter',
            'linkedin' => 'fab fa-linkedin',
            'telegram' => 'fab fa-telegram',
            'whatsapp' => 'fab fa-whatsapp',
            'email' => 'fas fa-envelope',
            'copy_link' => 'fas fa-link',
        ];

        return $icons[$this->platform] ?? 'fas fa-share';
    }

    /**
     * Get the platform color.
     */
    public function getPlatformColorAttribute()
    {
        $colors = [
            'facebook' => '#1877f2',
            'twitter' => '#1da1f2',
            'linkedin' => '#0077b5',
            'telegram' => '#0088cc',
            'whatsapp' => '#25d366',
            'email' => '#ea4335',
            'copy_link' => '#6c757d',
        ];

        return $colors[$this->platform] ?? '#6c757d';
    }

    /**
     * Record a share.
     */
    public static function recordShare($articleId, $platform, $userId = null)
    {
        return static::create([
            'article_id' => $articleId,
            'user_id' => $userId,
            'platform' => $platform,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    /**
     * Get shares count by platform.
     */
    public static function getSharesCountByPlatform($articleId)
    {
        return static::where('article_id', $articleId)
            ->selectRaw('platform, COUNT(*) as count')
            ->groupBy('platform')
            ->pluck('count', 'platform')
            ->toArray();
    }
}
