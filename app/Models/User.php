<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * یافتن یا ساخت کاربر بر اساس شماره تلفن
     */
    public static function findOrCreateByPhone($phone, $firstName = null, $lastName = null)
    {
        $user = static::where('phone', $phone)->first();
        if ($user) {
            return $user;
        }
        $name = trim(($firstName ?? '') . ' ' . ($lastName ?? ''));
        return static::create([
            'phone' => $phone,
            'name' => $name ?: $phone,
            'email' => $phone.'@noemail.local',
            'password' => bcrypt(uniqid()),
        ]);
    }
}
