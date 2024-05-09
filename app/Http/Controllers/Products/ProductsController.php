<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Products\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index(){
        try {
            $records = Product::with('gold_purities', 'mineral_colours', 'customer', 'category')->get();
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

    public function store(Request $request){

        try {
            $validate = Validator::make($request->all(),
                [
                    'name' => ['required', 'max:255'],
                    'slug' => ['required', 'max:255']
                ]);
            if ($validate->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Error',
                    'errors' =>  $validate->errors()
                ],401);
            }

            $product = new Product();
            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->glb_url = $request->glb_url;
            $product->thumbnail_url = $request->thumbnail_url;
            $product->weight = $request->weight;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->customer_id = $request->customer_id;
            $product->save();

            $product->gold_purities()->sync($request->gold_purities);
            $product->mineral_colours()->sync($request->mineral_colours);

            return response()->json([
                'status' => true,
                'message' => 'Product has been created.',
            ],200);

        } catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function update(Product $product, Request $request){

        try {
            $validate = Validator::make($request->all(),
                [
                    'name' => ['required', 'max:255'],
                    'slug' => ['required', 'max:255']
                ]);
            if ($validate->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Error',
                    'errors' =>  $validate->errors()
                ],401);
            }

            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->glb_url = $request->glb_url;
            $product->thumbnail_url = $request->thumbnail_url;
            $product->weight = $request->weight;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->customer_id = $request->customer_id;
            $product->save();

            $product->gold_purities()->sync($request->gold_purities);
            $product->mineral_colours()->sync($request->mineral_colours);

            return response()->json([
                'status' => true,
                'message' => 'Product has been updated.',
            ],200);

        } catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }

    }

    public function details(Product $product){
        return $product->with('gold_purities','mineral_colours','customer','category')->get();
    }

    public function delete(Product $product){
        try {
            $product->delete();
            $product->gold_purities()->sync([]);
            $product->mineral_colours()->sync([]);
            return response()->json([
                'status' => true,
                'message' => 'Product has been deleted.',
            ],200);
        } catch (\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }
}
