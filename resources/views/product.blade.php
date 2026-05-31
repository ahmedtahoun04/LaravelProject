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

            {{-- Rating --}}
            <div class="mb-2">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= round($product->average_rating))
                        <i class="fas fa-star text-warning"></i>
                    @else
                        <i class="far fa-star text-warning"></i>
                    @endif
                @endfor
                <small class="text-muted ms-1">
                    ({{ $product->reviews->count() }} reviews)
                </small>
            </div>

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

    {{-- Reviews Section --}}
    <div class="row mt-5">
        <div class="col-12">
            <h4 class="fw-bold mb-4">
                <i class="fas fa-star me-2 text-warning"></i>
                Customer Reviews ({{ $product->reviews->count() }})
            </h4>
        </div>

        {{-- Add Review Form --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Write a Review</h5>

                    @auth
                        <form action="{{ route('reviews.store', $product->id) }}" method="POST">
                            @csrf

                            {{-- Rating --}}
                            <div class="mb-3">
                                <label class="form-label">Rating *</label>
                                <select name="rating" class="form-select">
                                    <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                                    <option value="4">⭐⭐⭐⭐ Good</option>
                                    <option value="3">⭐⭐⭐ Average</option>
                                    <option value="2">⭐⭐ Poor</option>
                                    <option value="1">⭐ Terrible</option>
                                </select>
                            </div>

                            {{-- Title --}}
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title"
                                       class="form-control"
                                       placeholder="Review title...">
                            </div>

                            {{-- Body --}}
                            <div class="mb-3">
                                <label class="form-label">Review</label>
                                <textarea name="body" class="form-control" rows="3"
                                          placeholder="Share your experience..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-dark w-100">
                                <i class="fas fa-paper-plane me-2"></i>Submit Review
                            </button>
                        </form>
                    @else
                        <div class="text-center py-3">
                            <p class="text-muted">Login to write a review</p>
                            <a href="/login" class="btn btn-dark">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>

        {{-- Reviews List --}}
        <div class="col-md-8">
            @forelse ($product->reviews as $review)
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <strong>{{ $review->user->name }}</strong>
                            <div class="my-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        <i class="fas fa-star text-warning small"></i>
                                    @else
                                        <i class="far fa-star text-warning small"></i>
                                    @endif
                                @endfor
                            </div>
                            @if ($review->title)
                                <p class="fw-bold mb-1">{{ $review->title }}</p>
                            @endif
                            @if ($review->body)
                                <p class="text-muted mb-0">{{ $review->body }}</p>
                            @endif
                        </div>
                        <div class="text-end">
                            <small class="text-muted">
                                {{ $review->created_at->format('M d, Y') }}
                            </small>
                            @auth
                                @if (auth()->id() === $review->user_id)
                                    <form action="{{ route('reviews.destroy', $review->id) }}"
                                          method="POST" class="mt-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-4 text-muted">
                <i class="fas fa-star fa-3x mb-3"></i>
                <p>No reviews yet. Be the first to review!</p>
            </div>
            @endforelse
        </div>
    </div>

</div>

@endsection