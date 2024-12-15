<?php

use App\Http\Controllers\Admin\AdminController as AdminAdminController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => ''], function () {
    Route::middleware(['auth', 'role:user'])->group(function () {
        Route::get('dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    });
});

Route::group(['prefix' => 'admin'], function () {
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('dashboard', [AdminAdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('products', AdminProductController::class);
    });
});
