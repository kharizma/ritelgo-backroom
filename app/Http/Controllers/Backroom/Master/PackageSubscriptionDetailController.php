<?php

namespace App\Http\Controllers\Backroom\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Master\PackageSubscriptionDetail\StoreRequest;
use App\Http\Requests\Master\PackageSubscriptionDetail\UpdateRequest;
use App\Models\PackageSubscription;
use App\Models\PackageSubscriptionDetail;
use App\Models\Feature;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PackageSubscriptionDetailController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $package    = PackageSubscription::findOrFail($id);
        $details    = PackageSubscriptionDetail::join('features','package_subscription_details.default_name','features.name')->where('package_subscription_details.package_subscription_id',$id)
            ->select('package_subscription_details.*','features.id as feature_id')
            ->get();
        $features   = Feature::get();
        $i          = 1;

        return view('backroom.master.package-subscriptions.detail',compact('package','details','features','i'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $feature = Feature::where('id',$request->feature_id)
            ->select('name','variable','is_technical','value_type')
            ->first();

        $request->merge([
            'default_name'  => $feature->name,
            'variable'      => $feature->variable,
            'is_technical'  => $feature->is_technical,
            'value_type'    => $feature->value_type,
        ]);

        \Log::debug($request->all());

        PackageSubscriptionDetail::create($request->all());

        return redirect()->route('master.package-subscription-details.show',$request->package_subscription_id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): RedirectResponse
    {
        $feature = Feature::where('id',$request->feature_id)->select('name','variable','is_technical','value_type')->first();

        $request->merge([
            'default_name'  => $feature->name,
            'variable'      => $feature->variable,
            'is_technical'  => $feature->is_technical,
            'value_type'    => $feature->value_type,
        ]);

        $request->request->remove('_method');
        $request->request->remove('_token');
        $request->request->remove('feature_id');

        PackageSubscriptionDetail::where('id',$id)->update($request->all());

        return redirect()->route('master.package-subscription-details.show',$request->package_subscription_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PackageSubscriptionDetail::findOrFail($id);

        PackageSubscriptionDetail::where('id',$id)->delete();

        return response()->json(200);
    }
}
