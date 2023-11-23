<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReferalController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WithdrawController;
use App\Models\Pengunjung;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

// $ip = Request::ip();
// if ( !Pengunjung::where('ip_address', $ip)->get()->count() ) {
//     Pengunjung::create(['ip_address' => $ip]);
// }

Route::get('/', [PageController::class, 'index']);
Route::get('/search', [PageController::class, 'search']);

Route::middleware('guest')->group(function() {
    Route::get('/signin', [PageController::class, 'signin'])->name('login');
    Route::get('/signup', [PageController::class, 'signup']);
});

Route::group(['middleware' => 'guest', 'prefix' => 'auth'], function() {
    Route::post('/signin', [AuthController::class, 'signin']);
    Route::post('/signup', [AuthController::class, 'signup']);
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/referal', [ReferalController::class, 'index']);
});

Route::group(['middleware' => 'auth', 'prefix' => 'profile'], function() {
    Route::get('/', [UserController::class, 'profile']);
    Route::get('/edit', [UserController::class, 'edit']);
    Route::post('/edit', [UserController::class, 'update']);
    Route::post('/image', [UserController::class, 'image']);
    Route::get('/setting', [UserController::class, 'setting']);
    Route::post('/setting', [UserController::class, 'savesetting']);
});

Route::group(['middleware' => 'auth', 'prefix' => 'saldo'], function() {
    Route::get('/', [PageController::class, 'saldo']);
    Route::get('/deposit', [DepositController::class, 'create']);
    Route::post('/deposit', [DepositController::class, 'store']);
    Route::get('/withdraw', [WithdrawController::class, 'create']);
    Route::post('/withdraw', [WithdrawController::class, 'store']);
});

Route::group(['middleware' => 'auth', 'prefix' => 'transaction'], function() {
    Route::get('/history', [TransactionController::class, 'index']);
    Route::get('/{transaction:uuid}', [TransactionController::class, 'show']);
    Route::middleware('admin')->group(function() {
        Route::get('/{transaction:uuid}/delete', [TransactionController::class, 'destroy']);
        Route::get('/{transaction:uuid}/paid', [TransactionController::class, 'paid']);
        Route::get('/{transaction:uuid}/unpaid', [TransactionController::class, 'unpaid']);
    });
});

// Admin Auth
Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function() {
    Route::post('/', [AdminController::class, 'store']);
    Route::post('/{user}/edit', [AdminController::class, 'update']);
    Route::get('/{user}/delete', [AdminController::class, 'destroy']);
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/products', [AdminController::class, 'products']);
    Route::get('/users', [AdminController::class, 'users']);
    Route::get('/admins', [AdminController::class, 'admins']);
    Route::get('/settings', [AdminController::class, 'settings']);
    Route::post('/settings', [SettingController::class, 'update']);
    Route::get('/transactions', [AdminController::class, 'transactions']);
    Route::get('/withdraw', [AdminController::class, 'withdraw']);
    Route::get('/deposit', [AdminController::class, 'deposit']);
});

// Product
Route::middleware('auth')->group(function() {
    Route::get('/{product:uuid}', [PageController::class, 'checkout']);
    Route::get('/{product:uuid}/buy', [ProductController::class, 'buy']);
});

// Product Auth
Route::group(['middleware' => 'auth', 'prefix' => 'product'], function() {
    Route::post('/', [ProductController::class, 'store']);
    Route::post('/{product:uuid}/edit', [ProductController::class, 'update']);
    Route::get('/{product:uuid}/delete', [ProductController::class, 'destroy']);
});

// User Auth
Route::group(['middleware' => 'auth', 'prefix' => 'user'], function() {
    Route::post('/', [UserController::class, 'store']);
    Route::post('/{user}/edit', [UserController::class, 'update']);
    Route::get('/{user}/delete', [UserController::class, 'destroy']);
});