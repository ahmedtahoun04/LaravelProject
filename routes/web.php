<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// Home Page
Route::get('/', function () {
    $products = \App\Models\Product::with('category')
                                   ->where('status', true)
                                   ->latest()
                                   ->take(8)
                                   ->get();
    return view('home', compact('products'));
});

// Shop Page
Route::get('/shop', function () {
    $categories = \App\Models\Category::whereNull('parent_id')->get();

    $query = \App\Models\Product::with('category')->where('status', true);

    // Filter by search
    if (request('search')) {
        $query->where('title', 'like', '%' . request('search') . '%');
    }

    // Filter by category
    if (request('category')) {
        $query->whereHas('category', function($q) {
            $q->where('slug', request('category'));
        });
    }

    $products = $query->latest()->get();

    return view('shop', compact('products', 'categories'));
});

// Product Details
Route::get('/shop/{id}', function ($id) {
    $product = \App\Models\Product::with(['category', 'reviews.user'])->findOrFail($id);
    return view('product', compact('product'));
});

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Order Routes (requires login)
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.index');
    Route::get('/my-orders/{id}', [OrderController::class, 'show'])->name('orders.show');

    // Review Routes
    Route::post('/reviews/{productId}', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
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