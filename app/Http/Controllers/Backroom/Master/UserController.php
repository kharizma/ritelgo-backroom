<?php

namespace App\Http\Controllers\Backroom\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Master\Users\StoreRequest as UserStoreRequest;
use App\Http\Requests\Master\Users\UpdateRequest as UserUpdateRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService) 
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = User::query()->withCasts([
                'created_at' => 'date:d F Y H:i:s'
            ]);

            return DataTables::of($model)
                ->editColumn('status', function($item){
                    if($item->status == User::STATUS_ACTIVE){
                        return '<span class="badge text-bg-success">'.ucwords($item->status).'</span>';
                    }elseif($item->status == User::STATUS_NONACTIVE){
                        return '<span class="badge text-bg-secondary">'.ucwords($item->status).'</span>';
                    }elseif($item->status == User::STATUS_SUSPEND){
                        return '<span class="badge text-bg-warning">'.ucwords($item->status).'</span>';
                    }elseif($item->status == User::STATUS_BLOCK){
                        return '<span class="badge text-bg-danger">'.ucwords($item->status).'</span>';
                    }
                })
                ->addColumn('action', function($item){
                    if(($item->role == User::ROLE_SUPERADMIN OR $item->role == User::ROLE_OWNER) AND $item->id != Auth::user()->id){
                        if($item->status == User::STATUS_ACTIVE){
                            return '
                                <div class="dropdown">
                                    <button class="btn" type="button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="lni lni-more-alt fw-bold"></i>
                                    </button>
                                    <ul class="dropdown-menu" style="background-color: #EAEAEA">
                                        <li><a class="dropdown-item text-center" href="'.route('master.users.edit',$item->id).'">Ubah</a></li>
                                        <li><a class="dropdown-item text-center" onclick="btnDeactive(\''.$item->id.'\')">Non-aktifkan</a></li>
                                        <li><a class="dropdown-item text-center" onclick="btnDelete(\''.$item->id.'\')">Hapus</a></li>
                                    </ul>
                                </div>
                            ';
                        }elseif($item->status == User::STATUS_NONACTIVE){
                            return '
                                <div class="dropdown">
                                    <button class="btn" type="button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="lni lni-more-alt fw-bold"></i>
                                    </button>
                                    <ul class="dropdown-menu" style="background-color: #EAEAEA">
                                        <li><a class="dropdown-item text-center" href="'.route('master.users.edit',$item->id).'">Ubah</a></li>
                                        <li><a class="dropdown-item text-center" onclick="btnActive(\''.$item->id.'\')">Aktifkan</a></li>
                                        <li><a class="dropdown-item text-center" onclick="btnDelete(\''.$item->id.'\')">Hapus</a></li>
                                    </ul>
                                </div>
                            ';
                        }
                    }else{
                        return '
                            <div class="dropdown">
                                <button class="btn" type="button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="lni lni-more-alt fw-bold"></i>
                                </button>
                                <ul class="dropdown-menu" style="background-color: #EAEAEA">
                                    <li><a class="dropdown-item text-center" href="'.route('master.users.edit',$item->id).'">Ubah</a></li>
                                </ul>
                            </div>
                        ';
                    }
                    
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }

        return view('backroom.master.users.index');
    }

    public function create(): View
    {
        return view('backroom.master.users.create');
    }

    public function store(UserStoreRequest $request): View
    {
        $this->userService->store($request->validated());

        return view('backroom.master.users.index');
    }

    public function edit($id): View
    {
        $user = User::findOrFail($id);

        return view('backroom.master.users.edit',compact('user'));
    }

    public function update(UserUpdateRequest $request,$id): RedirectResponse
    {
        $this->userService->update($request->validated(),$id);

        return redirect()->route('master.users.index');
    }

    public function delete($id)
    {
        User::findOrFail($id);

        User::where('id',$id)->delete();

        return response()->json(200);
    }

    public function activate($id)
    {
        User::findOrFail($id);

        User::where('id',$id)->update([
            'status' => User::STATUS_ACTIVE
        ]);

        return response()->json(200);
    }

    public function deactivate($id)
    {
        User::findOrFail($id);

        User::where('id',$id)->update([
            'status' => User::STATUS_NONACTIVE
        ]);

        return response()->json(200);
    }
}
