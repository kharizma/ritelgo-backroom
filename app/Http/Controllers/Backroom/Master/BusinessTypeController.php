<?php

namespace App\Http\Controllers\Backroom\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Master\BusinessTypes\StoreRequest;
use App\Http\Requests\Master\BusinessTypes\UpdateRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Models\BusinessType;
use Illuminate\Http\RedirectResponse;

class BusinessTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $model = BusinessType::query()->withCasts([
            'created_at' => 'date:d F Y H:i:s'
        ]);

        if ($request->ajax()) {
            $model = BusinessType::query()->withCasts([
                'created_at' => 'date:d F Y H:i:s'
            ]);

            return DataTables::of($model)
                ->addColumn('action', function($item){
                    return '
                        <div class="dropdown">
                            <button class="btn" type="button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="lni lni-more-alt fw-bold"></i>
                            </button>
                            <ul class="dropdown-menu" style="background-color: #EAEAEA">
                                <li><a class="dropdown-item text-center" data-bs-toggle="modal" data-bs-target="#editModal" data-id="'.$item->id.'">Ubah</a></li>
                            </ul>
                        </div>
                    ';
                })
                ->rawColumns(['action'])
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

        BusinessType::where('id',$id)->update($request->validated());

        return redirect()->route('master.business-types.index');
    }
}
