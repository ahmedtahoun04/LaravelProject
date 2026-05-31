@extends('layouts.app')

@section('title') Welcome @endsection

@section('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        color: white;
        padding: 120px 0;
        position: relative;
        overflow: hidden;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=1200') center/cover;
        opacity: 0.2;
    }
    .hero-section .container { position: relative; z-index: 1; }

    .category-card {
        transition: all 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
        position: relative;
        height: 200px;
    }
    .category-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .category-card:hover img { transform: scale(1.1); }
    .category-card .overlay {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.8));
        padding: 20px;
        color: white;
    }

    .sale-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #e63946;
        color: white;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        z-index: 1;
    }

    .stats-section {
        background: #1a1a2e;
        color: white;
        padding: 40px 0;
    }
</style>
@endsection

@section('content')

    {{-- Hero Section --}}
    <section class="hero-section text-center">
        <div class="container">
            <span class="badge bg-danger mb-3 px-3 py-2 fs-6">
                🔥 Summer Sale Up to 50% Off
            </span>
            <h1 class="display-3 fw-bold mb-4">
                Dress to <span style="color: #e63946;">Impress</span>
            </h1>
            <p class="lead mb-5 opacity-75">
                Discover the latest trends in fashion. <br>
                Shop Men, Women, Kids & Accessories.
            </p>
            <a href="/shop" class="btn btn-light btn-lg me-3 px-4">
                <i class="fas fa-shopping-bag me-2"></i>Shop Now
            </a>
            <a href="/shop?discount=true" class="btn btn-outline-light btn-lg px-4">
                🏷️ View Sale
            </a>
        </div>
    </section>

    {{-- Stats --}}
    <section class="stats-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-6 mb-3 mb-md-0">
                    <h3 class="fw-bold text-warning mb-0">500+</h3>
                    <small class="opacity-75">Products</small>
                </div>
                <div class="col-md-3 col-6 mb-3 mb-md-0">
                    <h3 class="fw-bold text-warning mb-0">50+</h3>
                    <small class="opacity-75">Brands</small>
                </div>
                <div class="col-md-3 col-6">
                    <h3 class="fw-bold text-warning mb-0">Free</h3>
                    <small class="opacity-75">Shipping</small>
                </div>
                <div class="col-md-3 col-6">
                    <h3 class="fw-bold text-warning mb-0">24/7</h3>
                    <small class="opacity-75">Support</small>
                </div>
            </div>
        </div>
    </section>

    {{-- Categories Section --}}
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Shop by Category</h2>
                <p class="text-muted">Find what you're looking for</p>
            </div>
            <div class="row g-4">
                <div class="col-md-3 col-6">
                    <a href="/shop?category=men" class="text-decoration-none">
                        <div class="category-card shadow">
                            <img src="https://images.unsplash.com/photo-1490578474895-699cd4e2cf59?w=400" alt="Men">
                            <div class="overlay">
                                <h5 class="fw-bold mb-0">Men</h5>
                                <small class="opacity-75">T-Shirts, Pants, Jackets</small>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="/shop?category=women" class="text-decoration-none">
                        <div class="category-card shadow">
                            <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?w=400" alt="Women">
                            <div class="overlay">
                                <h5 class="fw-bold mb-0">Women</h5>
                                <small class="opacity-75">Dresses, Tops, Skirts</small>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="/shop?category=kids" class="text-decoration-none">
                        <div class="category-card shadow">
                            <img src="https://images.unsplash.com/photo-1471286174890-9c112ffca5b4?w=400" alt="Kids">
                            <div class="overlay">
                                <h5 class="fw-bold mb-0">Kids</h5>
                                <small class="opacity-75">Boys, Girls, Baby</small>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="/shop?category=accessories" class="text-decoration-none">
                        <div class="category-card shadow">
                            <img src="https://images.unsplash.com/photo-1523779917675-b6ed3a42a561?w=400" alt="Accessories">
                            <div class="overlay">
                                <h5 class="fw-bold mb-0">Accessories</h5>
                                <small class="opacity-75">Bags, Watches, Belts</small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Sale Products --}}
    @php
        $saleProducts = $products->filter(fn($p) => $p->discount > 0)->take(4);
    @endphp

    @if($saleProducts->count() > 0)
    <section class="py-5" style="background: #fff5f5;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <div>
                    <h2 class="fw-bold mb-0">🔥 On Sale</h2>
                    <p class="text-muted mb-0">Limited time offers</p>
                </div>
                <a href="/shop" class="btn btn-outline-danger">View All</a>
            </div>
            <div class="row g-4">
                @foreach ($saleProducts as $product)
                <div class="col-md-3">
                    <div class="card product-card shadow-sm h-100">
                        <div class="position-relative">
                            <span class="sale-badge">-{{ $product->discount }}%</span>
                            <img src="{{ $product->image_url }}"
                                 class="card-img-top" alt="{{ $product->title }}">
                        </div>
                        <div class="card-body">
                            <small class="text-muted">{{ $product->category->title ?? '' }}</small>
                            <h6 class="fw-bold mt-1">{{ $product->title }}</h6>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div>
                                    <span class="text-muted text-decoration-line-through small">${{ $product->price }}</span>
                                    <span class="product-price ms-1">
                                        ${{ number_format($product->price * (1 - $product->discount / 100), 2) }}
                                    </span>
                                </div>
                                <a href="/shop/{{ $product->id }}" class="btn btn-danger btn-sm">View</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Featured Products --}}
    <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <div>
                    <h2 class="fw-bold mb-0">Featured Products</h2>
                    <p class="text-muted mb-0">Handpicked for you</p>
                </div>
                <a href="/shop" class="btn btn-outline-dark">View All</a>
            </div>
            <div class="row g-4">
                @forelse ($products->take(8) as $product)
                <div class="col-md-3 col-6">
                    <div class="card product-card shadow-sm h-100">
                        <div class="position-relative">
                            @if($product->discount > 0)
                                <span class="sale-badge">-{{ $product->discount }}%</span>
                            @endif
                            <img src="{{ $product->image_url }}"
                                 class="card-img-top" alt="{{ $product->title }}">
                        </div>
                        <div class="card-body">
                            <small class="text-muted">{{ $product->category->title ?? '' }}</small>
                            <h6 class="card-title fw-bold mt-1">{{ $product->title }}</h6>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <span class="product-price">${{ $product->price }}</span>
                                <a href="/shop/{{ $product->id }}" class="btn btn-dark btn-sm">View</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-muted py-5">No products yet.</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Newsletter --}}
    <section class="py-5" style="background: #1a1a2e; color: white;">
        <div class="container text-center">
            <h3 class="fw-bold mb-2">📧 Subscribe to Our Newsletter</h3>
            <p class="opacity-75 mb-4">Get the latest fashion news and exclusive offers</p>
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="input-group">
                        <input type="email" class="form-control form-control-lg"
                               placeholder="Enter your email...">
                        <button class="btn btn-danger px-4">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection