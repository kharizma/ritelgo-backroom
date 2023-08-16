<?php

namespace App\Http\Controllers\Backroom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Subscription;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Subscription::query()->withCasts([
                'created_at' => 'date:d F Y H:i:s'
            ]);

            return DataTables::of($model)
                ->editColumn('status', function($item){
                    if($item->status == Subscription::PAYMENT_STATUS_PAID){
                        return '<span class="badge text-bg-success">'.ucwords($item->status).'</span>';
                    }elseif($item->status == Subscription::PAYMENT_STATUS_PENDING){
                        return '<span class="badge text-bg-secondary">'.ucwords($item->status).'</span>';
                    }elseif($item->status == Subscription::PAYMENT_STATUS_UNPAID){
                        return '<span class="badge text-bg-warning">'.ucwords($item->status).'</span>';
                    }elseif($item->status == Subscription::PAYMENT_STATUS_EXPIRED){
                        return '<span class="badge text-bg-danger">'.ucwords($item->status).'</span>';
                    }
                })
                ->rawColumns(['status'])
                ->make(true);
        }

        return view('backroom.invoices.index');
    }
}
