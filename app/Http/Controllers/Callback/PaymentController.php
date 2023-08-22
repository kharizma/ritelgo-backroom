<?php

namespace App\Http\Controllers\Callback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Subscription;
use App\Models\SubscriptionCallback;
use App\Models\PackageSubscription;
use App\Models\PackageSubscriptionDetail;
use App\Models\UserSubscription;

class PaymentController extends Controller
{
    public function __invoke(Request $request, $type)
    {
        if($type == 'xendit'){
            if($request->header('x-callback-token') === config('xendit.token_verify')){
                $subscription = Subscription::findOrFail($request->external_id);

                Subscription::where('id',$request->external_id)->update([
                    'bank_code' => $request->bank_code,
                    'status'    => strtolower($request->status),
                ]);

                // SubscriptionCallback::create([
                //     'id'                                    => Str::uuid(),
                //     'subscription_id'                       => $request->external_id,
                //     'xendit_notification'                   => json_encode($request->all()),
                //     'xendit_callback_id'                    => $request->id,
                //     'xendit_external_id'                    => $request->external_id,
                //     'xendit_user_id'                        => $request->user_id,
                //     'xendit_is_high'                        => $request->is_high,
                //     'xendit_status'                         => $request->status,
                //     'xendit_merchant_name'                  => $request->merchant_name,
                //     'xendit_merchant_profile_picture_url'   => $request->merchant_profile_picture_url ? $request->merchant_profile_picture_url : NULL,
                //     'xendit_amount'                         => $request->amount,
                //     'xendit_paid_amount'                    => $request->paid_amount,
                //     'xendit_bank_code'                      => $request->bank_code,
                //     'xendit_paid_at'                        => $request->paid_at,
                //     'xendit_payer_email'                    => $request->payer_email,
                //     'xendit_description'                    => $request->description,
                //     'xendit_expiry_date'                    => $request->expiry_date ? $request->expiry_date : NULL,
                //     'xendit_created'                        => $request->created,
                //     'xendit_updated'                        => $request->updated,
                //     'xendit_mid_label'                      => $request->mid_label ? $request->mid_label : NULL,
                //     'xendit_currency'                       => $request->currency,
                //     'xendit_payment_method'                 => $request->payment_method,
                //     'xendit_payment_channel'                => $request->payment_channel,
                //     'xendit_payment_destination'            => $request->payment_destination,
                //     'xendit_success_redirect_url'           => $request->success_redirect_url,
                //     'xendit_failure_redirect_url'           => $request->failure_redirect_url,
                //     'xendit_fixed_va'                       => $request->fixed_va ? $request->fixed_va : NULL,
                //     'xendit_locale'                         => $request->locale ? $request->locale : NULL,
                //     'xendit_adjusted_received_amount'       => $request->adjusted_received_amount ? $request->adjusted_received_amount : NULL,
                //     'xendit_fees_paid_amount'               => $request->fees_paid_amount ? $request->fees_paid_amount : NULL,
                // ]);

                $user = User::where('email',$request->payer_email)->first();

                $carbon = Carbon::createFromFormat('Y-m-d H:i:s',$user->valid_until.' 00:00:00');
                

                if($subscription->price_type == 'monthly'){
                    $valid_until = $carbon->addMonth();
                }elseif($subscription->price_type == 'annually'){
                    $valid_until = $carbon->addYear();
                }else{
                    $valid_until = $user->valid_until;
                }

                User::where('id',$user->id)->update([
                    'package_subscription_id'   => $subscription->package_subscription_id,
                    'package_subscription_name' => $subscription->package_subscription_name,
                    'valid_until'               => $valid_until,
                    'last_payment_date'         => date('Y-m-d',strtotime($request->updated))
                ]);

                $package_subs_detail = PackageSubscriptionDetail::where('package_subscription_id',$subscription->package_subscription_id)->first();

                if($package_subs_detail){
                    UserSubscription::create([
                        'subscription_id'                   => $request->external_id,
                        'valid_date'                        => $valid_until,
                        'user_id'                           => $user->id,
                        'package_subscription_detail_id'    => $package_subs_detail->id,
                        'custom_name'                       => $package_subs_detail->custom_name,
                        'default_name'                      => $package_subs_detail->default_name,
                        'variable'                          => $package_subs_detail->variable,
                        'is_technical'                      => $package_subs_detail->is_technical,
                        'value_type'                        => $package_subs_detail->value_type,
                        'value'                             => $package_subs_detail->value
                    ]);
                }

                return response()->json(['status' => 'OK'], 200);
            }else{
                return response()->json(['status' => 'Not OK'], 401);
            }
        }
    }
}