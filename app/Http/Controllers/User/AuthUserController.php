<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Invite;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthUserController extends Controller
{
    public function logout()
    {
        return DB::transaction(function (){
            Auth::logout();
            return redirect()->route('login');
        });
    }

    public function changePasswordPost(Request $request)
    {
        if (!Hash::check($request->current_password, User::find(Auth::user()->id)->password)){
            return redirect()->back()->withErrors(['incorrectPassword' => 'Current password is incorrect.']);
        }

        $request->validate([
            'password' => ['required', 'confirmed', 'max:255', 'min:6'],
        ]);

        User::find(Auth::user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('success', 'Password has been changed.');
    }
}
