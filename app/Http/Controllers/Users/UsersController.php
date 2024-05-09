<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Customers\Customer;
use App\Models\Customers\Customer as PageModel;
use App\Models\Invite;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /*public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->type != 'admin'){ return redirect()->intended(RouteServiceProvider::HOME); }
            return $next($request);
        });
    }*/

    public function index(){
        try {
            $records = Invite::with('user', 'customer')->get();
            return response()->json([
                'status' => true,
                'message' => 'success',
                'records' => $records
            ],200);
        } catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function storeInvite(Request $request){

        try {

            $validate = Validator::make($request->all(),
                [
                    'name' => ['required', 'max:255'],
                    'email' => ['email', 'max:255', 'min:6']
                ]);
            if ($validate->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Error',
                    'errors' =>  $validate->errors()
                ],401);
            }

            if ($request->type != 'admin' && $request->type != 'customer'){
                return response()->json([
                    'status' => false,
                    'message' => 'User type not selected.'
                ],401);
            } else if ($request->type == 'customer' && !$request->customer_id){
                return response()->json([
                    'status' => false,
                    'message' => 'Customer not selected.'
                ],401);
            } else if (Invite::where('email', trim($request->email))->first()){
                return response()->json([
                    'status' => false,
                    'message' => 'This email is already exist.'
                ],401);
            }

            $invite = new Invite();
            $invite->token = sha1(time());
            $invite->name = $request->name;
            $invite->email = trim($request->email);
            $invite->type = $request->type;
            $invite->customer_id = $request->customer_id ?: null;
            $invite->save();

            return response()->json([
                'status' => true,
                'message' => 'Invite has been sent.'
            ],200);

        } catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function updateInvite(Invite $invite, Request $request){

        try {

            $validate = Validator::make($request->all(),
                [
                    'name' => ['required', 'max:255'],
                    'email' => ['email', 'max:255', 'min:6']
                ]);
            if ($validate->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Error',
                    'errors' =>  $validate->errors()
                ],401);
            }

            if ($request->type != 'admin' && $request->type != 'customer'){
                return response()->json([
                    'status' => false,
                    'message' => 'Type not selected.'
                ],401);
            } else if ($request->type == 'customer' && !$request->customer_id){
                return response()->json([
                    'status' => false,
                    'message' => 'Customer not selected.'
                ],401);
            } else if (Invite::where('email', trim($request->email))->first() && $invite->email != trim($request->email)){
                return response()->json([
                    'status' => false,
                    'message' => 'This email is already exist.'
                ],401);
            }

            $invite->name = $request->name;
            $invite->email = trim($request->email);
            $invite->type = $request->type;
            $invite->customer_id = $request->customer_id ?: null;
            $invite->save();

            return response()->json([
                'status' => true,
                'message' => 'Invite has been updated.'
            ],200);

        } catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function deleteInvite(Invite $invite){
        try {
            $invite->delete();
            return response()->json([
                'status' => true,
                'message' => 'Invite has been deleted.'
            ],200);
        } catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function inviteDetails(Invite $invite){
        return Invite::with('user', 'customer')->find($invite->id);
    }

    public function update(User $user, Request $request){
        try {
            $validate = Validator::make($request->all(),
                [
                    'name' => ['required', 'max:255', 'string']
                ]);
            if ($validate->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Error',
                    'errors' =>  $validate->errors()
                ],401);
            }

            if ($request->type != 'admin' && $request->type != 'customer'){
                return response()->json([
                    'status' => false,
                    'message' => 'Select a user type.'
                ],401);
            } else if ($request->type == 'customer' && !$request->customer_id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Select a customer.'
                ],401);
            }

            $user->name = $request->name;
            $user->type = $request->type;
            $user->customer_id = $request->customer_id ?: null;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'User has been updated.'
            ],200);

        } catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function delete(User $user){
        try {
            $user->invite->delete();
            $user->delete();
            return response()->json([
                'status' => true,
                'message' => 'User has been deleted.'
            ],200);
        } catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function details(User $user){
        return $user;
    }
}
