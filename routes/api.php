<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customers\CustomersRestApiController;
use App\Http\Controllers\Categories\CategoriesController;
use App\Http\Controllers\SubCategories\SubCategoriesController;
use App\Http\Controllers\User\GuestUserController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Customers\CustomersController;
use App\Http\Controllers\Products\ProductsController;
use App\Http\Controllers\User\AuthUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {

});

Route::middleware(['guest:sanctum'])->group(function () {

});



