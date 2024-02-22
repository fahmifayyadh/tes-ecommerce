<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin', 'as' =>'admin.'], function (){
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'admin'])->name('dashboard');
    Route::resource('bank',\App\Http\Controllers\BankController::class);
    Route::resource('product', \App\Http\Controllers\ProductController::class);
    Route::resource('transaction', \App\Http\Controllers\TransactionController::class);
    Route::post('transaction/{id}/approve', [\App\Http\Controllers\TransactionController::class, 'approve'])->name('transaction.approve');
    Route::post('transaction/{id}/decline', [\App\Http\Controllers\TransactionController::class, 'decline'])->name('transaction.decline');
});
Route::group(['middleware' => ['auth', 'role:user'], 'prefix' => 'user', 'as' =>'user.'], function (){
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'user'])->name('dashboard');
    Route::get('checkout/{slug}', [\App\Http\Controllers\ProductController::class, 'detail'])->name('product.checkout');
    Route::post('checkout/{slug}/buy', [\App\Http\Controllers\ProductController::class, 'buy'])->name('product.checkout.buy');
    Route::get('transaction', [\App\Http\Controllers\TransactionController::class,'index'])->name('transaction.index');
    Route::get('transaction/{id}', [\App\Http\Controllers\TransactionController::class,'show'])->name('transaction.show');
    Route::put('transaction/{id}/proof', [\App\Http\Controllers\TransactionController::class,'update'])->name('transaction.proof');
});
