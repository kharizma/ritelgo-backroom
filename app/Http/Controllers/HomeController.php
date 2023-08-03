<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Subscription;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $owner_verified     = User::countOwnerVerified();
        $owner_unverified   = User::countOwnerUnverified();
        $bruto_income       = Subscription::totalPaidAmount();

        return view('backroom.home',compact('owner_verified','owner_unverified','bruto_income'));
    }
}
