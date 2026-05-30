@extends('layouts.app')

@section('title') {{ $product->title }} @endsection

@section('content')

<div class="container py-5">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/shop">Shop</a></li>
            <li class="breadcrumb-item">{{ $product->category->title ?? '' }}</li>
            <li class="breadcrumb-item active">{{ $product->title }}</li>
        </ol>
    </nav>

    <div class="row g-5">

        {{-- Product Image --}}
        <div class="col-md-6">
            <img src="{{ $product->image_url }}"
                 class="img-fluid rounded shadow" alt="{{ $product->title }}">
        </div>

        {{-- Product Info --}}
        <div class="col-md-6">
            <small class="text-muted text-uppercase">
                {{ $product->category->title ?? '' }}
            </small>
            <h2 class="fw-bold mt-2">{{ $product->title }}</h2>

            {{-- Price --}}
            <div class="my-4">
                @if ($product->discount > 0)
                    <span class="text-muted text-decoration-line-through me-2">
                        ${{ $product->price }}
                    </span>
                    <span class="product-price fs-3">
                        ${{ number_format($product->price * (1 - $product->discount / 100), 2) }}
                    </span>
                    <span class="badge bg-danger ms-2">{{ $product->discount }}% OFF</span>
                @else
                    <span class="product-price fs-3">${{ $product->price }}</span>
                @endif
            </div>

            {{-- Description --}}
            @if ($product->description)
                <p class="text-muted">{{ $product->description }}</p>
            @endif

            {{-- Stock --}}
            <div class="mb-4">
                @if ($product->stock > 0)
                    <span class="badge bg-success">
                        <i class="fas fa-check me-1"></i>In Stock ({{ $product->stock }} available)
                    </span>
                @else
                    <span class="badge bg-danger">Out of Stock</span>
                @endif
            </div>

            {{-- Add to Cart --}}
            <div class="d-flex gap-3">
                <div class="input-group" style="width: 130px">
                    <button class="btn btn-outline-secondary" type="button">-</button>
                    <input type="number" class="form-control text-center" value="1" min="1">
                    <button class="btn btn-outline-secondary" type="button">+</button>
                </div>
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-grow-1">
                    @csrf
                    <button type="submit" class="btn btn-dark btn-lg w-100">
                        <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                    </button>
                </form>
            </div>

            {{-- Meta --}}
            <div class="mt-4 pt-4 border-top">
                <small class="text-muted">
                    <i class="fas fa-tag me-2"></i>
                    Category: {{ $product->category->title ?? 'N/A' }}
                </small>
            </div>
        </div>
    </div>
</div>

@endsection