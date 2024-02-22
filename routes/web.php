<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\WEB\PaymentController;
use App\Http\Controllers\WEB\CustomerController;
use App\Http\Controllers\WEB\ExpensesController;
use App\Http\Controllers\WEB\MaterialController;
use App\Http\Controllers\WEB\DashboardController;
use App\Http\Controllers\WEB\MaintenanceController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::get('loves',function() {
    return 'this is costumer api';
});
Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'process']);


// route dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::resource('/customer', CustomerController::class);
Route::resource('/customer', CustomerController::class);

Route::resource('/payment', PaymentController::class);
Route::post('/payment/pay', [PaymentController::class, 'pay']);
Route::get('/payment/{account_number}/addpayment', [PaymentController::class, 'addpayment'])->middleware('auth');

//Maintenance
Route::resource('/maintenance', MaintenanceController::class);
Route::post('/maintenance/newmaintenance', [MaintenanceController::class, 'newmaintenance']);
Route::get('/maintenance/{account_number}/addmaintenance', [MaintenanceController::class, 'addmaintenance'])->middleware('auth');


Route::get('/material-list', [MaterialController    ::class, 'getmaterial']);
//expenses
Route::resource('/expenses', ExpensesController::class);

//material
Route::resource('/material', MaterialController::class);
