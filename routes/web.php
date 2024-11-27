<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [LoginController::class, 'index'])->name('account.login');
    Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');
    Route::get('/register', [RegisterController::class, 'index'])->name('account.register');
    Route::post('/register', [RegisterController::class, 'store'])->name('account.register.store');
});


Route::group(['middleware' => 'auth'], function () {
    // dashboard route
    Route::get('/welcome', [HomeController::class, 'index'])->name('account.dashboard');
    // logout route
    Route::get('/logout', [LoginController::class, 'logout'])->name('account.logout');

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/{id}/update', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/{id}/delete', [CategoryController::class, 'delete'])->name('category.delete');
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/{id}/update', [ProductController::class, 'update'])->name('product.update');
        Route::get('/{id}/delete/', [ProductController::class, 'delete'])->name('product.delete');
        Route::get('/{slug}', [ProductController::class, 'slug'])->name('product.slug');
    });

    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/store', [CartController::class, 'store'])->name('cart.store');
        Route::get('/{id}/delete/', [CartController::class, 'delete'])->name('cart.delete');
    });

    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::post('/store', [OrderController::class, 'store'])->name('orders.store');
    });

    Route::group(['prefix' => 'checkout'], function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/store', [CheckoutController::class, 'store'])->name('checkout.store');
    });
});
