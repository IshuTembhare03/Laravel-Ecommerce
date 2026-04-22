@extends('layouts.app')

@section('title', $product->name . ' - Royal Furniture')

@section('content')
<div class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products') }}">Products</a></li>
                @if($product->category)
                <li class="breadcrumb-item"><a href="{{ route('products', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a></li>
                @endif
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            </ol>
        </nav>
        
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="row">
                    <div class="col-12 mb-3">
                        @php
                        $mainImg = null;
                        $firstImage = $product->images->first();
                        if ($firstImage) {
                            $mainImg = $firstImage->url;
                        }
                        @endphp
                        @if($mainImg)
                        <img src="{{ $mainImg }}" alt="{{ $product->name }}" class="img-fluid w-100" id="mainImage" style="height: 400px; object-fit: cover;">
                        @else
                        <img src="https://placehold.co/600x400/0d9488/ffffff?text={{ urlencode($product->name) }}" alt="{{ $product->name }}" class="img-fluid w-100" id="mainImage" style="height: 400px; object-fit: cover;">
                        @endif
                    </div>
                    <div class="col-12">
                        <div class="d-flex gap-2">
                            @foreach($product->images as $image)
                            @php
                            $thumbUrl = $image->url;
                            @endphp
                            @if($thumbUrl)
                            <img src="{{ $thumbUrl }}" alt="{{ $product->name }}" 
                                 class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;"
                                 onclick="document.getElementById('mainImage').src='{{ $thumbUrl }}'">
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <span class="category-badge badge mb-2">{{ $product->category->name ?? 'Uncategorized' }}</span>
                <h1 class="font-display mb-3">{{ $product->name }}</h1>
                <h2 class="price-tag mb-4">${{ number_format($product->price, 2) }}</h2>
                
                <p class="mb-4">{{ $product->description }}</p>
                
                <div class="mb-4">
                    <p class="mb-2"><strong>Availability:</strong> 
                        @if($product->quantity > 0)
                        <span class="text-success"><i class="fas fa-check-circle"></i> In Stock ({{ $product->quantity }} available)</span>
                        @else
                        <span class="text-danger"><i class="fas fa-times-circle"></i> Out of Stock</span>
                        @endif
                    </p>
                </div>
                
                @if($product->quantity > 0)
                <form action="{{ route('cart.add') }}" method="POST" class="mb-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label class="col-form-label">Quantity:</label>
                        </div>
                        <div class="col-auto">
                            <input type="number" name="quantity" class="form-control" value="1" min="1" max="{{ $product->quantity }}" style="width: 100px;">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-cart-plus me-2"></i>Add to Cart
                            </button>
                        </div>
                    </div>
                </form>
                @endif
                
                <div class="d-flex gap-3">
                    <a href="{{ route('products') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Products
                    </a>
                    <a href="{{ route('cart') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-shopping-cart me-2"></i>View Cart
                    </a>
                </div>
            </div>
        </div>
        
        @if($relatedProducts->count() > 0)
        <div class="mt-5">
            <h3 class="font-display mb-4">Related Products</h3>
            <div class="row g-4">
@foreach($relatedProducts as $related)
                <div class="col-md-3 col-sm-6">
                    <div class="product-card card h-100">
                        @php
                        $relImg = null;
                        if ($related->images->first()) {
                            $relImg = $related->images->first()->url;
                        }
                        @endphp
                        @if($relImg)
                        <img src="{{ $relImg }}" class="card-img-top" alt="{{ $related->name }}">
                        @else
                        <img src="https://placehold.co/400x250/0d9488/ffffff?text={{ urlencode($related->name) }}" class="card-img-top" alt="{{ $related->name }}">
                        @endif
                        <div class="card-body">
                            <h6 class="card-title">{{ $related->name }}</h6>
                            <p class="price-tag mb-2">${{ number_format($related->price, 2) }}</p>
                            <a href="{{ route('product.detail', $related->slug) }}" class="btn btn-sm btn-outline-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection