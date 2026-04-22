@extends('admin.layout')

@section('title', 'Orders - Admin')
@section('page-title', 'Orders')

@section('admin-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>All Orders</h2>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td><strong>{{ $order->order_number }}</strong></td>
                        <td>
                            <div>{{ $order->name }}</div>
                            <small class="text-muted">{{ $order->email }}</small>
                        </td>
                        <td>${{ number_format($order->total, 2) }}</td>
                        <td>
                            @switch($order->status)
                            @case('pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                            @break
                            @case('processing')
                            <span class="badge bg-info">Processing</span>
                            @break
                            @case('completed')
                            <span class="badge bg-success">Completed</span>
                            @break
                            @case('cancelled')
                            <span class="badge bg-danger">Cancelled</span>
                            @break
                            @endswitch
                        </td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No orders found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4">
    {{ $orders->links() }}
</div>
@endsection