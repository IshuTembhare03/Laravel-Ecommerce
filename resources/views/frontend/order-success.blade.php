@extends('layouts.app')

@section('title', 'Order Success - Royal Furniture')

@section('content')
<div class="py-5">
    <div class="container text-center">
        <div class="mb-4">
            <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
        </div>
        <h1 class="font-display mb-4">Thank You for Your Order!</h1>
        
        @if(session('success'))
        <p class="lead mb-4">{{ session('success') }}</p>
        @endif
        
        <p class="mb-4">Your order has been placed successfully. We will process it shortly and send you a confirmation email.</p>
        
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('home') }}" class="btn btn-primary">Continue Shopping</a>
            <a href="{{ route('products') }}" class="btn btn-outline-secondary">View More Products</a>
        </div>
    </div>
</div>
@endsection