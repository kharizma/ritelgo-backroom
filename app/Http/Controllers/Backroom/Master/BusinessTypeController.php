<?php

namespace App\Http\Controllers\Backroom\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Master\BusinessTypes\StoreRequest;
use App\Http\Requests\Master\BusinessTypes\UpdateRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\RedirectResponse;
use App\Models\BusinessType;
use App\Models\UserBusiness;

class BusinessTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = BusinessType::query()->withCasts([
                'created_at' => 'date:d F Y H:i:s'
            ]);

            return DataTables::of($model)
                ->editColumn('is_active', function($item){
                    if($item->is_active){
                        return '<span class="badge text-bg-success">Aktif</span>';
                    }else{
                        return '<span class="badge text-bg-secondary">Tidak Aktif</span>';
                    }
                })
                ->addColumn('action', function($item){
                    return '
                        <div class="dropdown">
                            <button class="btn" type="button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="lni lni-more-alt fw-bold"></i>
                            </button>
                            <ul class="dropdown-menu" style="background-color: #EAEAEA">
                                <li><a class="dropdown-item text-center" data-bs-toggle="modal" data-bs-target="#editModal" data-id="'.$item->id.'" data-is_active="'.$item->is_active.'">Ubah</a></li>
                                <li><a class="dropdown-item text-center" onclick="btnDelete(\''.$item->id.'\')">Hapus</a></li>
                            </ul>
                        </div>
                    ';
                })
                ->rawColumns(['is_active','action'])
                ->make(true);
        }

        return view('backroom.master.business-types.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        BusinessType::create($request->validated());

        return redirect()->route('master.business-types.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): RedirectResponse
    {
        BusinessType::findOrFail($id);

        $request->is_active == 'yes' ? $is_active = true : $is_active = false;

        $request->merge([
            'is_active'  => $is_active,
        ]);

        $request->request->remove('_method');
        $request->request->remove('_token');

        BusinessType::where('id',$id)->update($request->all());

        return redirect()->route('master.business-types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        BusinessType::findOrFail($id);

        $validate = UserBusiness::where('business_type_id',$id)->count();

        if($validate == 0){
            BusinessType::where('id',$id)->delete();
        }

        return response()->json(200);
    }
}
