<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\AuthUserController;
use App\Http\Controllers\User\GuestUserController;
use App\Http\Controllers\Customers\CustomersController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Categories\CategoriesController;
use App\Http\Controllers\SubCategories\SubCategoriesController;
use App\Http\Controllers\Products\ProductsController;
use App\Http\Controllers\Customers\CustomersRestApiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {

    Route::prefix('dashboard')->as('dashboard.')->namespace('Dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('home');
        Route::get('/logout', [AuthUserController::class, 'logout'])->name('logout');
    });

});

Route::middleware(['guest'])->group(function (){

    Route::get('/', [GuestUserController::class, 'index'])->name('index');
    Route::get('/login', [GuestUserController::class, 'login'])->name('login');
    Route::get('/register', [GuestUserController::class, 'register'])->name('register');

});


