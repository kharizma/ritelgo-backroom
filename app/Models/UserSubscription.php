<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'subscription_id',
        'valid_date',
        'user_id',
        'package_subscription_id',
        'default_name',
        'custom_name',
        'variable',
        'is_technical',
        'value_type',
        'value',
        'order',
    ];
}
