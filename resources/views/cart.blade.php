@extends('layouts.app')

@section('title') Shopping Cart @endsection

@section('content')

<div class="container py-5">
    <h2 class="fw-bold mb-4">
        <i class="fas fa-shopping-cart me-2"></i>Shopping Cart
    </h2>

    @if(count($cart) > 0)
    <div class="row">

        {{-- Cart Items --}}
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $id => $item)
                            <tr>
                                {{-- Product --}}
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ $item['image_url'] }}"
                                             width="60" height="60"
                                             style="object-fit: cover"
                                             class="rounded">
                                        <span class="fw-bold">{{ $item['title'] }}</span>
                                    </div>
                                </td>

                                {{-- Price --}}
                                <td class="align-middle">${{ $item['price'] }}</td>

                                {{-- Quantity --}}
                                <td class="align-middle">
                                    <form action="{{ route('cart.update', $id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group" style="width: 120px">
                                            <input type="number"
                                                   name="quantity"
                                                   value="{{ $item['quantity'] }}"
                                                   min="1"
                                                   class="form-control text-center"
                                                   onchange="this.form.submit()">
                                        </div>
                                    </form>
                                </td>

                                {{-- Subtotal --}}
                                <td class="align-middle fw-bold text-danger">
                                    ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                </td>

                                {{-- Remove --}}
                                <td class="align-middle">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Clear Cart --}}
            <form action="{{ route('cart.clear') }}" method="POST" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm"
                        onclick="return confirm('Clear all items?')">
                    <i class="fas fa-trash me-1"></i>Clear Cart
                </button>
            </form>
        </div>

        {{-- Order Summary --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">Order Summary</h5>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Items ({{ count($cart) }})</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Shipping</span>
                        <span class="text-success">Free</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total</span>
                        <span class="text-danger">${{ number_format($total, 2) }}</span>
                    </div>

                    <a href="/checkout" class="btn btn-dark w-100 mt-4">
                        <i class="fas fa-credit-card me-2"></i>Proceed to Checkout
                    </a>
                    <a href="/shop" class="btn btn-outline-dark w-100 mt-2">
                        <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                    </a>
                </div>
            </div>
        </div>

    </div>
    @else
    {{-- Empty Cart --}}
    <div class="text-center py-5">
        <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
        <h4 class="text-muted">Your cart is empty!</h4>
        <p class="text-muted">Add some products to your cart.</p>
        <a href="/shop" class="btn btn-dark btn-lg mt-3">
            <i class="fas fa-shopping-bag me-2"></i>Start Shopping
        </a>
    </div>
    @endif
</div>

@endsection