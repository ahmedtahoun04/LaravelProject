@extends('layouts.app')

@section('title') Welcome @endsection

@section('content')

    {{-- Hero Section --}}
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">
                Welcome to Fashion Store 🛍️
            </h1>
            <p class="lead mb-5">
                Discover the latest trends in fashion. <br>
                Shop Men, Women, Kids & Accessories.
            </p>
            <a href="/shop" class="btn btn-light btn-lg me-3">
                <i class="fas fa-shopping-bag me-2"></i>Shop Now
            </a>
            <a href="/shop?category=new" class="btn btn-outline-light btn-lg">
                New Arrivals
            </a>
        </div>
    </section>

    {{-- Categories Section --}}
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Shop by Category</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <a href="/shop?category=men" class="text-decoration-none">
                        <div class="card border-0 shadow-sm text-center p-4 h-100">
                            <i class="fas fa-male fa-3x text-primary mb-3"></i>
                            <h5 class="fw-bold text-dark">Men</h5>
                            <p class="text-muted small">T-Shirts, Pants, Jackets</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="/shop?category=women" class="text-decoration-none">
                        <div class="card border-0 shadow-sm text-center p-4 h-100">
                            <i class="fas fa-female fa-3x text-danger mb-3"></i>
                            <h5 class="fw-bold text-dark">Women</h5>
                            <p class="text-muted small">Dresses, Tops, Skirts</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="/shop?category=kids" class="text-decoration-none">
                        <div class="card border-0 shadow-sm text-center p-4 h-100">
                            <i class="fas fa-child fa-3x text-success mb-3"></i>
                            <h5 class="fw-bold text-dark">Kids</h5>
                            <p class="text-muted small">Boys, Girls, Baby</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="/shop?category=accessories" class="text-decoration-none">
                        <div class="card border-0 shadow-sm text-center p-4 h-100">
                            <i class="fas fa-glasses fa-3x text-warning mb-3"></i>
                            <h5 class="fw-bold text-dark">Accessories</h5>
                            <p class="text-muted small">Bags, Watches, Belts</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Featured Products --}}
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Featured Products</h2>
            <div class="row g-4">
                @forelse ($products as $product)
                <div class="col-md-3">
                    <div class="card product-card shadow-sm h-100">
                        {{-- Image --}}
                        <img src="{{ $product->image_url }}"
                             class="card-img-top" alt="{{ $product->title }}">

                        <div class="card-body">
                            <small class="text-muted">{{ $product->category->title ?? '' }}</small>
                            <h6 class="card-title fw-bold mt-1">{{ $product->title }}</h6>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="product-price">${{ $product->price }}</span>
                                <a href="/shop/{{ $product->id }}" class="btn btn-dark btn-sm">
                                    View
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-muted py-5">
                    No products yet.
                </div>
                @endforelse
            </div>

            <div class="text-center mt-5">
                <a href="/shop" class="btn btn-dark btn-lg">
                    View All Products <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

@endsection