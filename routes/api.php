<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SalesController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ExpensesController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\MaintainanceController;

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
Route::post('customers/getall',[CustomerController::class,'index']);
Route::post('customers/search_by_name',[CustomerController::class,'search_customer_by_name']);
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
Route::post('payment/getall',[PaymentController::class,'all_payments']);
Route::post('payment/transaction',[PaymentController::class,'show']);
Route::post('payment/create',[PaymentController::class,'create_payment']);
Route::post('payment/update',[PaymentController::class,'update_payment']);
Route::post('payment/get',[PaymentController::class,'filter']);
Route::post('payment/delete',[PaymentController::class,'delete']);
});
Auth::routes();

//Maintainance
Route::middleware(['api', 'auth:sanctum'])
->group(function () {
Route::get('maintenance/getall',[MaintainanceController::class,'index']);
Route::post('maintenance/transaction',[MaintainanceController::class,'show']);
Route::post('maintenance/create',[MaintainanceController::class,'create_maintenance']);
Route::post('maintenance/update',[MaintainanceController::class,'update_maintenance']);
Route::post('maintenance/get',[MaintainanceController::class,'filter']);
Route::post('maintenance/delete',[MaintainanceController::class,'delete']);
});
Auth::routes();


Route::middleware(['api', 'auth:sanctum'])
->group(function () {
Route::post('expenses/getall',[ExpensesController::class,'index']);
Route::post('expenses/create',[ExpensesController::class,'create_expenses']);
Route::post('expenses/update',[ExpensesController::class,'update_expenses']);
Route::post('expenses/get',[ExpensesController::class,'filterEach']);
Route::post('expenses/delete',[ExpensesController::class,'delete']);
});
Auth::routes();


Route::middleware(['api', 'auth:sanctum'])
->group(function () {
Route::post('material/getall',[MaterialController::class,'index']);
Route::post('material/create',[MaterialController::class,'create_material']);
Route::post('material/update',[MaterialController::class,'update_material']);
Route::post('material/get',[MaterialController::class,'filterEach']);
Route::post('material/delete',[MaterialController::class,'delete']);
});
Auth::routes();

Route::middleware(['api', 'auth:sanctum'])
->group(function () {
Route::post('sales/getall',[SalesController::class,'index']);

});
Auth::routes();