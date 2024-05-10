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
}
