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
    Route::post('/user/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('user-delete');

    //Route for Item
    
    // Route::get('/item/list', function () {
    //     return 'abc';
    // })->name('items');
    Route::get('/item/list', [App\Http\Controllers\ItemController::class, 'index'])->name('items');
    Route::get('/item/create', [App\Http\Controllers\ItemController::class, 'create'])->name('create-item');
    Route::post('/item/store', [App\Http\Controllers\ItemController::class, 'store'])->name('item-store');
    Route::get('/item/status/change/{id}', [App\Http\Controllers\ItemController::class, 'statusChange'])->name('item-status-change');
    Route::get('/item/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit'])->name('item-edit');
    Route::post('/item/update', [App\Http\Controllers\ItemController::class, 'update'])->name('item-update');
    Route::get('/item/price/{id}', [App\Http\Controllers\ItemController::class, 'item_price'])->name('item-view-price');
    Route::post('/item/price/save', [App\Http\Controllers\ItemController::class, 'save_item_price'])->name('save-item-price');
    Route::get('item/price/status/change/{id}', [App\Http\Controllers\ItemController::class, 'statusChangeItemPrice'])->name('item-price-status-change');
    Route::post('/item/price/update', [App\Http\Controllers\ItemController::class, 'update_item_price'])->name('update-item-price');
    

    // Route for Stock
    Route::get('/stock/list', [App\Http\Controllers\StockController::class, 'index'])->name('stocks');
    Route::get('/stock/create', [App\Http\Controllers\StockController::class, 'create'])->name('create-stock');
    Route::post('/stock/store', [App\Http\Controllers\StockController::class, 'store'])->name('stock-store');
    Route::post('/stock/mrp-wise-detail', [App\Http\Controllers\StockController::class, 'mrpWiseDetail'])->name('mrp-wise-detail');
    
    //PURCHASE ORDER ROUTES
    Route::get('/user/purchase-order', [App\Http\Controllers\PurchaseOrderController::class, 'index'])->name('items');
    
});
