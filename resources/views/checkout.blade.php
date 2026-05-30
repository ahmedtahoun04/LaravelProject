@extends('layouts.app')

@section('title') Checkout @endsection

@section('content')

<div class="container py-5">
    <h2 class="fw-bold mb-4">
        <i class="fas fa-credit-card me-2"></i>Checkout
    </h2>

    <div class="row">

        {{-- Checkout Form --}}
        <div class="col-md-7">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Shipping Information</h5>

                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name *</label>
                                <input type="text" name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', auth()->user()->name) }}">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email', auth()->user()->email) }}">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone *</label>
                            <input type="text" name="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone') }}" placeholder="+1 234 567 890">
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address *</label>
                            <textarea name="address" rows="2"
                                      class="form-control @error('address') is-invalid @enderror"
                                      placeholder="Street address">{{ old('address') }}</textarea>
                            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">City *</label>
                            <input type="text" name="city"
                                   class="form-control @error('city') is-invalid @enderror"
                                   value="{{ old('city') }}">
                            @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Payment Method *</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"
                                           name="payment_method" value="cash"
                                           id="cash" checked>
                                    <label class="form-check-label" for="cash">
                                        <i class="fas fa-money-bill me-1"></i>Cash on Delivery
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"
                                           name="payment_method" value="card" id="card">
                                    <label class="form-check-label" for="card">
                                        <i class="fas fa-credit-card me-1"></i>Credit Card
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Notes (Optional)</label>
                            <textarea name="notes" rows="2"
                                      class="form-control"
                                      placeholder="Any special instructions?">{{ old('notes') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-dark btn-lg w-100">
                            <i class="fas fa-check-circle me-2"></i>Place Order
                        </button>

                    </form>
                </div>
            </div>
        </div>

        {{-- Order Summary --}}
        <div class="col-md-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Order Summary</h5>

                    @foreach ($cart as $id => $item)
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <img src="{{ $item['image_url'] }}"
                                 width="50" height="50"
                                 style="object-fit: cover"
                                 class="rounded">
                            <div>
                                <div class="fw-bold small">{{ $item['title'] }}</div>
                                <small class="text-muted">x{{ $item['quantity'] }}</small>
                            </div>
                        </div>
                        <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                    </div>
                    @endforeach

                    <hr>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
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
                </div>
            </div>
        </div>

    </div>
</div>

@endsection