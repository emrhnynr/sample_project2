<?php

namespace App\Http\Controllers\SubCategories;

use App\Http\Controllers\Controller;
use App\Models\Categories\Category;
use App\Models\Categories\SubCategory;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubCategoriesController extends Controller
{
    /*public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->type != 'admin'){ return redirect()->intended(RouteServiceProvider::HOME); }
            return $next($request);
        });
    }*/

    public function index(Category $category)
    {
        try {
            $records = $category->sub_categories;
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

    public function store(Request $request)
    {
        try {

            $validate = Validator::make($request->all(),
                [
                    'name' => ['required', 'max:255'],
                    'category_id' => ['int', 'required'],
                    'header_menu_display' => ['required']
                ]);
            if ($validate->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Error',
                    'errors' =>  $validate->errors()
                ],401);
            }

            $sub_category = new SubCategory();
            $sub_category->name = $request->name;
            $sub_category->category_id = $request->category_id;
            $sub_category->header_menu_display = $request->header_menu_display;
            $sub_category->save();

            return response()->json([
                'status' => true,
                'message' => 'Sub Category has been created.'
            ],200);

        } catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function delete(SubCategory $sub_category)
    {
        try {
            $sub_category->delete();
            return response()->json([
                'status' => true,
                'message' => 'Sub Category has been deleted.'
            ],200);
        } catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function update(Request $request, SubCategory $sub_category)
    {
        try {

            $validate = Validator::make($request->all(),
                [
                    'name' => ['required', 'max:255'],
                    'category_id' => ['int', 'required'],
                    'header_menu_display' => ['required']
                ]);
            if ($validate->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Error',
                    'errors' =>  $validate->errors()
                ],401);
            }

            $sub_category->name = $request->name;
            $sub_category->category_id = $request->category_id;
            $sub_category->header_menu_display = $request->header_menu_display;
            $sub_category->save();

            return response()->json([
                'status' => true,
                'message' => 'Sub Category has been updated.'
            ],200);

        } catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function details(SubCategory $sub_category)
    {
        return SubCategory::with('category')->find($sub_category->id);
    }

}
