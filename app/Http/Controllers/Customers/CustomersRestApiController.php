<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Customers\Customer;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class CustomersRestApiController extends Controller
{
    public function index()
    {
        return 'Ok';
    }

    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->collection_id = $request->collection_id;
        if ($customer->save())
        {
            return 'success';
        } else {
            return 'error';
        }
    }

    public function login(LoginRequest $request)
    {
        $request->authenticate();
        //$request->session()->regenerate();
        //return redirect()->intended(RouteServiceProvider::HOME);
    }
}
