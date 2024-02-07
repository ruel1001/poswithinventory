<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\CustomerController;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
 //   return $request->user();
//});



Route::get('customers',function() {
    return 'this is costumer api';
});

//Route::middleware('auth:sanctum')->get('customers/get/{account_number}',[CustomerController::class,'show']);
//Auth

Route::prefix('v1/auth/')
    ->controller(AuthController::class)
    ->group(function () {
        Route::middleware(['api'])->post('register', 'register')->name('user-register');
        Route::middleware(['api'])->post('login', 'login')->name('user-login');
        Route::middleware(['api', 'auth:sanctum'])->post('logout', 'logout')->name('user-logout');
    });



//Customer
Route::middleware(['api', 'auth:sanctum'])
->group(function () {
Route::get('customers/getall',[CustomerController::class,'index']);
Route::post('customers/create',[CustomerController::class,'create']);
Route::post('customers/get',[CustomerController::class,'shows']);
Route::get('customers/get/{account_number}/edit',[CustomerController::class,'edit']);
Route::post('customers/get/{account_number}/update',[CustomerController::class,'update']);
Route::post('customers/update',[CustomerController::class,'update']);
Route::delete('customers/get/{account_number}/delete',[CustomerController::class,'destroy']);
Route::post('customers/delete',[CustomerController::class,'delete']);
});
Auth::routes();


//Payment
Route::middleware(['api', 'auth:sanctum'])
->group(function () {
Route::get('payment/getall',[PaymentController::class,'index']);
Route::post('payment/transaction',[PaymentController::class,'show']);
Route::post('payment/create',[PaymentController::class,'create_payment']);
Route::post('payment/update',[PaymentController::class,'update_payment']);
Route::post('customers/get',[CustomerController::class,'shows']);
Route::post('payment/get',[PaymentController::class,'filter']);
Route::get('payment/get/{account_number}/edit',[PaymentController::class,'edit']);
Route::put('payment/get/{account_number}/update',[PaymentController::class,'update']);
Route::delete('payment/get/{account_number}/delete',[PaymentController::class,'destroy']);
Route::post('payment/delete',[PaymentController::class,'delete']);
});
Auth::routes();
