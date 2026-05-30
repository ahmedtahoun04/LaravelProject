@extends('layouts.app')

@section('title') Shop @endsection

@section('content')

<div class="container py-5">
    <div class="row">

        {{-- Sidebar (Categories Filter) --}}
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-filter me-2"></i>Categories
                    </h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="/shop"
                               class="text-decoration-none {{ !request('category') ? 'fw-bold text-dark' : 'text-muted' }}">
                                All Products
                            </a>
                        </li>
                        @foreach ($categories as $category)
                        <li class="mb-2">
                            <a href="/shop?category={{ $category->slug }}"
                               class="text-decoration-none {{ request('category') == $category->slug ? 'fw-bold text-dark' : 'text-muted' }}">
                                {{ $category->title }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- Products Grid --}}
        <div class="col-md-9">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">
                    {{ request('search') ? 'Search: "' . request('search') . '"' : 'All Products' }}
                </h4>
                <span class="text-muted">{{ $products->count() }} products</span>
            </div>

            {{-- Products --}}
            <div class="row g-4">
                @forelse ($products as $product)
                <div class="col-md-4">
                    <div class="card product-card shadow-sm h-100">
                        {{-- Image --}}
                        <a href="/shop/{{ $product->id }}">
                            <img src="{{ $product->image_url }}"
                                 class="card-img-top" alt="{{ $product->title }}">
                        </a>

                        <div class="card-body">
                            <small class="text-muted">{{ $product->category->title ?? '' }}</small>
                            <h6 class="fw-bold mt-1">{{ $product->title }}</h6>

                            {{-- Price --}}
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
                <div class="col-12 text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No products found.</h5>
                    <a href="/shop" class="btn btn-dark mt-3">View All Products</a>
                </div>
                @endforelse
            </div>

        </div>
    </div>
</div>

@endsection