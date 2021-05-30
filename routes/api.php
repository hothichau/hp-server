<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Auth\LoginController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//---------------------------Admin----------------------------//
Route::get('/admins', [AdminController::class,'index']);
Route::post('/admin/create', [AdminController::class,'store']);
Route::get('/admin/detail/{user_id}', [AdminController::class,'detail']);
Route::put('/admin/edit/{id}',[AdminController::class,'update']);
Route::delete('/admin/delete/{user_id}', [AdminController::class,'destroy']);
Route::get('/admins/count', [AdminController::class,'count']);
Route::get('/admins/search', [AdminController::class,'search']);// not
Route::post('/admin/upload_image', [AdminController::class, 'uploadAvatar']);
//---------------------------Customer----------------------------//
Route::get('/customers', [CustomerController::class,'index']);
Route::get('/customers/count', [CustomerController::class,'count']);
Route::get('/customers/search', [CustomerController::class,'search']); //not
Route::post('/customer/create', [CustomerController::class,'store']);
Route::put('/customer/edit/{id}',[CustomerController::class,'update']);
Route::get('/customer/detail/{user_id}', [CustomerController::class,'detail']);
Route::delete('/customer/delete/{user_id}', [CustomerController::class,'destroy']);
Route::get('/customer_service', [CustomerController::class,'countCustomerService']);
//---------------------------User----------------------------//
Route::get('/users', [UserController::class,'index']);
Route::get('/users/count', [UserController::class,'count']);
Route::get('/users/search/{key}', [UserController::class,'search']); //not
//---------------------------Service-------------------------//
Route::get('/services', [ServiceController::class,'index']);
Route::post('/service/create', [ServiceController::class,'store']);
Route::get('/service/detail/{id}', [ServiceController::class,'show']);
Route::put('/service/edit/{id}', [ServiceController::class,'update']);
Route::delete('/service/delete/{id}', [ServiceController::class,'destroy']);
Route::get('/service/customer/{id}', [ServiceController::class,'getCustomer']);
Route::get('/service/statictical', [ServiceController::class,'statistiService']);
//---------------------------Authentication-------------------------//
Route::post('/login', [LoginController::class,'login']);
//---------------------------Logout-------------------------//
Route::post('/logout', [AdminController::class,'logout']);
