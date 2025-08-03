<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'type',
        'group',
        'description',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    // Relationships
    public function translations()
    {
        return $this->hasMany(SettingTranslation::class);
    }

    public function translation($languageId = null)
    {
        if (!$languageId) {
            $languageId = app()->getLocale() === 'fa' ? 1 : (app()->getLocale() === 'en' ? 2 : 3);
        }

        return $this->translations()->where('language_id', $languageId)->first();
    }

    // Scopes
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function scopeByGroup($query, $group)
    {
        return $query->where('group', $group);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Methods
    public function getValueAttribute()
    {
        $translation = $this->translation();
        return $translation ? $translation->value : '';
    }

    public static function getByKey($key, $languageId = null)
    {
        $setting = static::where('key', $key)->first();
        if ($setting) {
            return $setting->translation($languageId);
        }
        return null;
    }

    public static function getValue($key, $languageId = null)
    {
        $translation = static::getByKey($key, $languageId);
        return $translation ? $translation->value : null;
    }
}
