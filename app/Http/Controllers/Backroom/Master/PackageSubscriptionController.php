<?php

namespace App\Http\Controllers\Backroom\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Master\PackageSubscription\StoreRequest;
use App\Http\Requests\Master\PackageSubscription\UpdateRequest;
use Illuminate\View\View;
use App\Models\PackageSubscription;

class PackageSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = PackageSubscription::with('details')->get();

            return DataTables::of($model)
                ->editColumn('price', function($item){
                    return 'Rp '.number_format($item->price);
                })
                ->editColumn('price_annual', function($item){
                    return 'Rp '.number_format($item->price_annual);
                })
                ->editColumn('is_show', function($item){
                    if($item->is_show){
                        return '<div>
                            <i class="mdi mdi-circle text-success"></i>
                            <span>Tampil</span>
                        </div>';
                    }else{
                        return '<div>
                            <i class="mdi mdi-circle text-secondary"></i>
                            <span>Sembunyikan</span>
                        </div>';
                    }
                })
                ->editColumn('is_active', function($item){
                    if($item->is_active){
                        return '<div>
                            <i class="mdi mdi-circle text-success"></i>
                            <span>Aktif</span>
                        </div>';
                    }else{
                        return '<div>
                            <i class="mdi mdi-circle text-secondary"></i>
                            <span>Non-Aktif</span>
                        </div>';
                    }
                })
                ->addColumn('action', function($item){
                    return '
                        <div class="dropdown">
                            <button class="btn" type="button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="lni lni-more-alt fw-bold"></i>
                            </button>
                            <ul class="dropdown-menu" style="background-color: #EAEAEA">
                                <li><a class="dropdown-item text-center" data-bs-toggle="modal" data-bs-target="#editModal" data-id="'.$item->id.'" data-name="'.$item->name.'" data-price="'.$item->price.'" data-price_annual="'.$item->price_annual.'" data-is_show="'.$item->is_show.'" data-is_active="'.$item->is_active.'" >Ubah</a></li>
                                <li><a href="'.route('master.package-subscription-details.show',$item->id).'" class="dropdown-item text-center">Detail</a></li>
                            </ul>
                        </div>
                    ';
                })
                ->rawColumns(['price','price_annual','is_show','is_active','action'])
                ->make(true);
        }

        return view('backroom.master.package-subscriptions.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $request->is_show   == 'yes' ? $is_show = true : $is_show = false;
        $request->is_active == 'yes' ? $is_active = true : $is_active = false;

        $request->merge([
            'is_show'   => $is_show,
            'is_active' => $is_active,
        ]);

        PackageSubscription::create($request->all());

        return redirect()->route('master.package-subscriptions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {   
        PackageSubscription::findOrFail($id);

        $request->is_show   == 'yes' ? $is_show = true : $is_show = false;
        $request->is_active == 'yes' ? $is_active = true : $is_active = false;

        $request->merge([
            'is_show'   => $is_show,
            'is_active' => $is_active,
        ]);

        $request->request->remove('_method');
        $request->request->remove('_token');

        PackageSubscription::where('id',$id)->update($request->all());

        return redirect()->route('master.package-subscriptions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
