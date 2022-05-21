<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\UserProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::post('/product', [ProductController::class, 'create'])->name('product.create');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('product.show');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/products/{product}', [ProductController::class, 'delete'])->name('product.delete');

Route::put('/product/{product}/image', [ProductImageController::class, 'update'])->name('product.image.update');

Route::get('/users/products', [UserProductController::class, 'index'])->name('user.product.index');
Route::post('/users/products/{product}', [UserProductController::class, 'create'])->name('user.product.add');
Route::delete('/users/products/{product}', [UserProductController::class, 'delete'])->name('user.product.remove');
