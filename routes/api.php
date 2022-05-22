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

Route::post('/product', [ProductController::class, 'create'])->name('api.product.create');
Route::get('/products', [ProductController::class, 'index'])->name('api.product.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('api.product.show');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('api.product.update');
Route::delete('/products/{product}', [ProductController::class, 'delete'])->name('api.product.delete');

Route::put('/product/{product}/image', [ProductImageController::class, 'update'])->name('api.product.image.update');

Route::get('/users/products', [UserProductController::class, 'index'])->name('api.user.product.index');
Route::post('/users/products/{product}', [UserProductController::class, 'create'])->name('api.user.product.add');
Route::delete('/users/products/{product}', [UserProductController::class, 'delete'])->name('api.user.product.remove');
