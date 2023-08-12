<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PackageSubscription extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'price',
        'price_annual',
        'is_show',
        'is_active',
    ];

    /**
     * Get the details for package subscription.
     */
    public function details(): HasMany
    {
        return $this->hasMany(PackageSubscriptionDetail::class);
    }
}
