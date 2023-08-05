<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ROLE_SUPERADMIN    = 'superadmin';
    public const ROLE_OWNER         = 'owner';
    public const ROLE_MANAGER       = 'manager';
    public const ROLE_CASHIER       = 'cashier';

    public const STATUS_ACTIVE      = 'active';
    public const STATUS_NONACTIVE   = 'non-active';
    public const STATUS_SUSPEND     = 'suspend';
    public const STATUS_BLOCK       = 'block';

    public const STATUSES = [
        self::ROLE_SUPERADMIN,
        self::ROLE_OWNER,
        self::ROLE_MANAGER,
        self::ROLE_CASHIER,
        
        self::STATUS_ACTIVE,
        self::STATUS_NONACTIVE,
        self::STATUS_SUSPEND,
        self::STATUS_BLOCK,
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'role',
        'name',
        'initial_name',
        'email',
        'password',
        'mobile_phone',
        'package_subscription_id',
        'package_subscription_name',
        'valid_until',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'mobile_phone_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function countOwnerVerified(): int
    {
        return static::query()->where('role','owner')
            ->where('email_verified_at','!=',NULL)
            ->count();
    }

    public static function countOwnerUnverified(): int
    {
        return static::query()->where('role','owner')
            ->where('email_verified_at',NULL)
            ->count();
    }
}
