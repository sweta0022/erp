<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/dashboard');
});


Route::get('/dashboard', function () {
    return view('admin.index');
});

// Auth::routes();
Auth::routes(['register' => false]);



Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/user/list', [App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('create-user');
    Route::get('get-cities', [App\Http\Controllers\UserController::class, 'getCities'])->name('getCities');
    Route::get('get-zones', [App\Http\Controllers\UserController::class, 'getZones'])->name('getZones');
    Route::get('get-Seniors', [App\Http\Controllers\UserController::class, 'getSeniors'])->name('getSeniors');
    Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])->name('user-store');
    Route::get('/user/status/change/{id}', [App\Http\Controllers\UserController::class, 'statusChange'])->name('user-status-change');
    Route::get('/user/search', [App\Http\Controllers\UserController::class, 'search'])->name('user-search');
    Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user-edit');
    Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user-update');
});
