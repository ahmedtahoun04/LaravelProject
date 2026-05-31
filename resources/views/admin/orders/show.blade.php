@extends('layouts.admin')

@section('title') Order #{{ $order->id }} @endsection

@section('content')

<div class="row">

    {{-- Order Items --}}
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-box mr-2"></i>Order Items</h5>
            </div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead class="thead-light">
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
                    <tfoot class="thead-light">
                        <tr>
                            <td colspan="3" class="text-right fw-bold">Total:</td>
                            <td class="fw-bold text-success">
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

        {{-- Update Status --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-edit mr-2"></i>Update Status</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                Processing
                            </option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>
                                Shipped
                            </option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                Delivered
                            </option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                Cancelled
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-2">
                        <i class="fas fa-save mr-1"></i> Update Status
                    </button>
                </form>
            </div>
        </div>

        {{-- Customer Info --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-user mr-2"></i>Customer Info</h5>
            </div>
            <div class="card-body">
                <p class="mb-1"><strong>{{ $order->name }}</strong></p>
                <p class="mb-1 text-muted">{{ $order->email }}</p>
                <p class="mb-1 text-muted">{{ $order->phone }}</p>
                <hr>
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

        {{-- Order Meta --}}
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-info-circle mr-2"></i>Order Info</h5>
            </div>
            <div class="card-body">
                <p class="mb-1">
                    <strong>Date:</strong>
                    {{ $order->created_at->format('M d, Y h:i A') }}
                </p>
                <p class="mb-1">
                    <strong>Payment:</strong>
                    {{ ucfirst($order->payment_method) }}
                </p>
                <p class="mb-0">
                    <strong>Status:</strong>
                    @php
                        $colors = [
                            'pending'    => 'warning',
                            'processing' => 'info',
                            'shipped'    => 'primary',
                            'delivered'  => 'success',
                            'cancelled'  => 'danger',
                        ];
                        $color = $colors[$order->status] ?? 'secondary';
                    @endphp
                    <span class="badge badge-{{ $color }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>
            </div>
        </div>

    </div>
</div>

@endsection