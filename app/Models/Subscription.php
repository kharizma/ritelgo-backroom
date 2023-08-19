<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    
    public const PAYMENT_STATUS_CHECKOUT    = 'checkout';
    public const PAYMENT_STATUS_UNPAID      = 'unpaid';
    public const PAYMENT_STATUS_PENDING     = 'pending';
    public const PAYMENT_STATUS_PAID        = 'paid';
    public const PAYMENT_STATUS_EXPIRED     = 'expired';

    public const PAYMENT_STATUSES = [
        self::PAYMENT_STATUS_CHECKOUT,
        self::PAYMENT_STATUS_UNPAID,
        self::PAYMENT_STATUS_PENDING,
        self::PAYMENT_STATUS_PAID,
        self::PAYMENT_STATUS_EXPIRED,
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public static function totalPaidAmount(): int
    {
        return static::query()->where('status','paid')
            ->sum('total_amount');
    }
}
