@extends('admin.layout')

@section('title', 'Dashboard - Admin')
@section('page-title', 'Dashboard')

@section('admin-content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted mb-1">Total Products</p>
                    <h2 class="mb-0 font-display">{{ $productsCount }}</h2>
                </div>
                <div class="stat-icon" style="background-color: rgba(139, 69, 19, 0.2); color: #D4A574;">
                    <i class="fas fa-box"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted mb-1">Total Orders</p>
                    <h2 class="mb-0 font-display">{{ $ordersCount }}</h2>
                </div>
                <div class="stat-icon" style="background-color: rgba(46, 125, 50, 0.2); color: var(--success);">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted mb-1">Total Revenue</p>
                    <h2 class="mb-0 font-display">${{ number_format($revenue, 2) }}</h2>
                </div>
                <div class="stat-icon" style="background-color: rgba(201, 162, 39, 0.2); color: var(--accent-color);">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Recent Orders</h5>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary">View All</a>
    </div>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->name }}</td>
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
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No orders yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection