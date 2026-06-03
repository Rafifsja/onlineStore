<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name("home.index");
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name("home.about");
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name("product.index");
Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name("product.show");
Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name("cart.index");
    Route::post('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'add'])->name("cart.add");
    Route::get('/cart/delete', [App\Http\Controllers\CartController::class, 'delete'])->name("cart.delete");
    Route::get('/cart/purchase', [App\Http\Controllers\CartController::class, 'purchase'])->name("cart.purchase");
    Route::get('/my-account/orders', [App\Http\Controllers\MyAccountController::class, 'orders'])->name("myaccount.orders");
});

Route::middleware('admin')->group(function () {
    Route::get('/admin', [App\Http\Controllers\Admin\AdminHomeController::class, 'index'])->name("admin.home.index");
    Route::get('/admin/products', [App\Http\Controllers\Admin\AdminProductController::class, 'index'])->name("admin.product.index");
    Route::post('/admin/products/store', [App\Http\Controllers\Admin\AdminProductController::class, 'store'])->name("admin.product.store");
    Route::delete('/admin/products/{id}/delete', [App\Http\Controllers\Admin\AdminProductController::class, 'delete'])->name("admin.product.delete");
    Route::get('/admin/products/{id}/edit', [App\Http\Controllers\Admin\AdminProductController::class, 'edit'])->name("admin.product.edit");
    Route::put('/admin/products/{id}/update', [App\Http\Controllers\Admin\AdminProductController::class, 'update'])->name("admin.product.update");
});