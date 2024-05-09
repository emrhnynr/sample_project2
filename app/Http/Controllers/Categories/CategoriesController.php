<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Categories\Category;
use App\Models\Customers\Customer;
use App\Models\Customers\Customer as PageModel;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
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
            $categories = Category::with('sub_categories')->get();
            return response()->json([
                'status' => true,
                'message' => 'success',
                'records' => $categories
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

            $category = new Category();
            $category->name = $request->name;
            $category->save();

            return response()->json([
                'status' => true,
                'message' => 'Category has been created.'
            ],200);

        } catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function delete(Category $category)
    {
        try {
            $category->sub_categories()->delete();
            $category->delete();
            return response()->json([
                'status' => true,
                'message' => 'Category has been deleted.'
            ],200);
        } catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function update(Request $request, Category $category)
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

            $category->name = $request->name;
            $category->save();

            return response()->json([
                'status' => true,
                'message' => 'Category has been updated.'
            ],200);

        } catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function details(Category $category)
    {
        return Category::with('sub_categories')->find($category->id);
    }
}
