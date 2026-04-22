@extends('layouts.app')

@section('title', 'Shopping Cart - Royal Furniture')

@section('content')
<div class="py-5">
    <div class="container">
        <h1 class="font-display mb-4">Shopping Cart</h1>
        
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        @if($cartItems->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
            <h3 class="mb-4">Your cart is empty</h3>
            <a href="{{ route('products') }}" class="btn btn-primary btn-lg">Continue Shopping</a>
        </div>
        @else
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $cartTotal = 0; @endphp
                                @foreach($cartItems as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @php
                                            $cartImg = null;
                                            if ($item->product && $item->product->images->first()) {
                                                $cartImg = $item->product->images->first()->url;
                                            }
                                            @endphp
                                            @if($cartImg)
                                            <img src="{{ $cartImg }}" alt="{{ $item->product->name }}" style="width: 60px; height: 60px; object-fit: cover;" class="me-3 rounded">
                                            @else
                                            <img src="https://placehold.co/60x60/0d9488/ffffff?text=N" alt="No Image" style="width: 60px; height: 60px; object-fit: cover;" class="me-3 rounded">
                                            @endif
                                            <div>
                                                <a href="{{ route('product.detail', $item->product->slug ?? '#') }}" class="text-decoration-none text-dark">
                                                    <strong>{{ $item->product->name ?? 'Product' }}</strong>
                                                </a>
                                                <p class="mb-0 text-muted small">{{ $item->product->category->name ?? '' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>${{ number_format($item->product->price ?? 0, 2) }}</td>
                                    <td>
                                        @if(Auth::check())
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control" style="width: 70px;">
                                        </form>
                                        @else
                                        <span>{{ $item->quantity }}</span>
                                        @endif
                                    </td>
                                    <td>${{ number_format(($item->product->price ?? 0) * $item->quantity, 2) }}</td>
                                    <td>
                                        @if(Auth::check())
                                        <a href="{{ route('cart.remove', $item->id) }}" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        @else
                                        <a href="{{ route('cart.remove', $item->product_id) }}" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @php $cartTotal += ($item->product->price ?? 0) * $item->quantity; @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('products') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                    </a>
                    <a href="{{ route('cart.clear') }}" class="btn btn-outline-danger">
                        <i class="fas fa-trash me-2"></i>Clear Cart
                    </a>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>${{ number_format($cartTotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total</strong>
                            <strong class="price-tag">${{ number_format($cartTotal, 2) }}</strong>
                        </div>
                        @auth
                        <a href="{{ route('checkout') }}" class="btn btn-primary w-100 btn-lg">Proceed to Checkout</a>
                        @else
                        <div class="alert alert-info mb-3">
                            <a href="{{ route('login') }}">Login</a> to checkout or continue as guest.
                        </div>
                        <a href="{{ route('checkout') }}" class="btn btn-primary w-100 btn-lg">Checkout as Guest</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection