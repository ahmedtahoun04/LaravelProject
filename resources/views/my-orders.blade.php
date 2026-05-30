@extends('layouts.app')

@section('title') My Orders @endsection

@section('content')

<div class="container py-5">
    <h2 class="fw-bold mb-4">
        <i class="fas fa-box me-2"></i>My Orders
    </h2>

    @if($orders->count() > 0)
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Order #</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td class="fw-bold">#{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                            <td>{{ $order->items->count() }} items</td>
                            <td class="fw-bold text-danger">
                                ${{ number_format($order->total, 2) }}
                            </td>
                            <td>
                                @php
                                    $statusColors = [
                                        'pending'    => 'warning',
                                        'processing' => 'info',
                                        'shipped'    => 'primary',
                                        'delivered'  => 'success',
                                        'cancelled'  => 'danger',
                                    ];
                                    $color = $statusColors[$order->status] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $color }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}"
                                   class="btn btn-sm btn-dark">
                                    <i class="fas fa-eye me-1"></i>View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-box-open fa-5x text-muted mb-4"></i>
            <h4 class="text-muted">No orders yet!</h4>
            <a href="/shop" class="btn btn-dark btn-lg mt-3">
                <i class="fas fa-shopping-bag me-2"></i>Start Shopping
            </a>
        </div>
    @endif
</div>

@endsection