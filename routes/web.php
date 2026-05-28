<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

// Home Page
Route::get('/', function () {
    return view('welcome');
});

// ============================================
// ADMIN ROUTES
// ============================================
Route::prefix('admin')->name('admin.')->group(function () {

    // Category Routes
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);

});