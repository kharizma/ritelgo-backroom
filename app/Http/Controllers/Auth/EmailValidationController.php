<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use App\Models\User;

class EmailValidationController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::find($request->route('id'));

        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException;
        }
    
        if ($user->markEmailAsVerified())
            event(new Verified($user));

        User::where('id',$user->id)->update([
            'status' => User::STATUS_ACTIVE
        ]);
        
        return redirect()->route('login');
    }
}
