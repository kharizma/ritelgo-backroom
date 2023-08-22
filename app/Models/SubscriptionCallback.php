<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionCallback extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'subscription_id',
        'xendit_notification',
        'xendit_callback_id',
        'xendit_external_id',
        'xendit_user_id',
        'xendit_is_high',
        'xendit_status',
        'xendit_merchant_name',
        'xendit_merchant_profile_picture',
        'xendit_amount',
        'xendit_paid_amount',
        'xendit_bank_code',
        'xendit_paid_at',
        'xendit_payer_email',
        'xendit_description',
        'xendit_expiry_date',
        'xendit_created',
        'xendit_updated',
        'xendit_mid_label',
        'xendit_currency',
        'xendit_payment_method',
        'xendit_payment_channel',
        'xendit_payment_destination',
        'xendit_success_redirect_url',
        'xendit_failure_redirect_url',
        'xendit_fixed_va',
        'xendit_locale',
        'xendit_adjusted_received_amount',
        'xendit_fees_paid_amount'
    ];
}
