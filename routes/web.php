<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
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


Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->middleware('auth');
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

    // Product
    Route::post('product/photo-upload', [ProductController::class, 'photo_upload'])->name('product.photo_upload');
    Route::resource('product', ProductController::class);

    // Product Category
    Route::resource('product-category', ProductCategoryController::class);
});
