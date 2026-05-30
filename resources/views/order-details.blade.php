@extends('layouts.app')

@section('title') Order #{{ $order->id }} @endsection

@section('content')

<div class="container py-5">

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Order #{{ $order->id }}</h2>
        <a href="{{ route('orders.index') }}" class="btn btn-outline-dark">
            <i class="fas fa-arrow-left me-2"></i>My Orders
        </a>
    </div>

    <div class="row">

        {{-- Order Items --}}
        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-bold">
                    <i class="fas fa-box me-2"></i>Order Items
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>${{ $item->price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="fw-bold">
                                    ${{ number_format($item->price * $item->quantity, 2) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Total:</td>
                                <td class="fw-bold text-danger">
                                    ${{ number_format($order->total, 2) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        {{-- Order Info --}}
        <div class="col-md-4">

            {{-- Status --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Order Status</h6>
                    @php
                        $statusColors = [
                            'pending'   => 'warning',
                            'processing'=> 'info',
                            'shipped'   => 'primary',
                            'delivered' => 'success',
                            'cancelled' => 'danger',
                        ];
                        $color = $statusColors[$order->status] ?? 'secondary';
                    @endphp
                    <span class="badge bg-{{ $color }} fs-6">
                        {{ ucfirst($order->status) }}
                    </span>

                    <div class="mt-3">
                        <small class="text-muted d-block">
                            <i class="fas fa-calendar me-1"></i>
                            Ordered: {{ $order->created_at->format('M d, Y') }}
                        </small>
                        <small class="text-muted d-block mt-1">
                            <i class="fas fa-credit-card me-1"></i>
                            Payment: {{ ucfirst($order->payment_method) }}
                        </small>
                    </div>
                </div>
            </div>

            {{-- Shipping Info --}}
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Shipping Information</h6>
                    <p class="mb-1"><strong>{{ $order->name }}</strong></p>
                    <p class="mb-1 text-muted">{{ $order->email }}</p>
                    <p class="mb-1 text-muted">{{ $order->phone }}</p>
                    <p class="mb-1 text-muted">{{ $order->address }}</p>
                    <p class="mb-0 text-muted">{{ $order->city }}</p>
                    @if($order->notes)
                        <hr>
                        <p class="mb-0 text-muted">
                            <strong>Notes:</strong> {{ $order->notes }}
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@endsection