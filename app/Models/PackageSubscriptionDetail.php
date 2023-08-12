<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackageSubscriptionDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'package_subscription_id',
        'default_name',
        'custom_name',
        'variable',
        'is_technical',
        'value_type',
        'value',
        'order',
    ];

    /**
     * Get the package subscription that owns the details.
     */
    public function package_subscription(): BelongsTo
    {
        return $this->belongsTo(PackageSubscription::class);
    }
}
