<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

// Home Page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (Breeze default) - Redirect to Admin Dashboard
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ============================================
// ADMIN ROUTES
// ============================================
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        // Dashboard
        Route::get('/', function () {
            $categoriesCount = \App\Models\Category::count();
            $productsCount   = \App\Models\Product::count();

            $latestProducts = \App\Models\Product::with('category')
                                                 ->latest()
                                                 ->take(5)
                                                 ->get();

            return view('admin.dashboard', compact(
                'categoriesCount',
                'productsCount',
                'latestProducts'
            ));
        })->name('dashboard');

        // Categories
        Route::resource('categories', CategoryController::class);

        // Products
        Route::resource('products', ProductController::class);

    });

require __DIR__.'/auth.php';