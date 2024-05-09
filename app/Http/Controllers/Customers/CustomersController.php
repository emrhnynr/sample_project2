<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\Customers\Customer as PageModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    /*public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->type != 'admin'){ return redirect()->intended(RouteServiceProvider::HOME); }
            return $next($request);
        });
    }*/

    public function index()
    {
        try {
            $customers = PageModel::all();
            return response()->json([
                'status' => true,
                'message' => 'success',
                'records' => $customers
            ],200);
        } catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function store(Request $request)
    {
        try {

            $validate = Validator::make($request->all(),
                [
                    'name' => ['required', 'max:255']
                ]);
            if ($validate->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Error',
                    'errors' =>  $validate->errors()
                ],401);
            }

            $customer = new PageModel();
            $customer->name = $request->name;
            $customer->collection_id = 111;
            $customer->save();

            return response()->json([
                'status' => true,
                'message' => 'Customer has been created.'
            ],200);

        } catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function update(PageModel $customer, Request $request)
    {
        try {

            $validate = Validator::make($request->all(),
                [
                    'name' => ['required', 'max:255']
                ]);
            if ($validate->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Error',
                    'errors' =>  $validate->errors()
                ],401);
            }
            $customer->name = $request->name;
            $customer->save();
            return response()->json([
                'status' => true,
                'message' => 'Customer has been updated.'
            ],200);

        } catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function delete(PageModel $customer)
    {
        try {
            $customer->delete();
            return response()->json([
                'status' => true,
                'message' => 'Customer has been deleted.'
            ],200);
        } catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function details(PageModel $customer)
    {
        return $customer;
    }
}
