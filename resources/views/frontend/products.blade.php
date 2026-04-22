@extends('layouts.app')

@section('title', 'Products - Royal Furniture')

@section('content')
<div class="py-5 bg-light">
    <div class="container">
        <h1 class="font-display mb-4">Our Products</h1>
        
        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Categories</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="{{ route('products') }}" class="list-group-item list-group-item-action {{ !request('category') ? 'active' : '' }}">
                                All Categories
                            </a>
                            @foreach($categories as $category)
                            <a href="{{ route('products', ['category' => $category->slug]) }}" 
                               class="list-group-item list-group-item-action {{ request('category') == $category->slug ? 'active' : '' }}">
                                {{ $category->name }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0">Search</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products') }}" method="GET">
                            @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <p class="mb-0">Showing {{ $products->count() }} products</p>
                    <form action="{{ route('products') }}" method="GET" class="d-flex">
                        @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        <select name="sort" class="form-select" onchange="this.form.submit()">
                            <option value="">Sort by</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        </select>
                    </form>
                </div>
                
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
                
                <div class="row g-4">
                    @forelse($products as $product)
                    <div class="col-md-6 col-lg-4">
                        <div class="product-card card h-100">
                            @php
                            $imgUrl = null;
                            $firstImage = $product->images->first();
                            if ($firstImage) {
                                $imgUrl = $firstImage->url;
                            }
                            @endphp
                            @if($imgUrl)
                            <img src="{{ $imgUrl }}" class="card-img-top" alt="{{ $product->name }}">
                            @else
                            <img src="https://placehold.co/400x250/0d9488/ffffff?text={{ urlencode($product->name) }}" class="card-img-top" alt="{{ $product->name }}">
                            @endif
                            <div class="card-body">
                                <span class="category-badge badge mb-2">{{ $product->category->name ?? 'Uncategorized' }}</span>
                                <h5 class="card-title font-display">{{ $product->name }}</h5>
                                <p class="card-text text-muted small">{{ \Str::limit($product->description, 50) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="price-tag">${{ number_format($product->price, 2) }}</span>
                                    <div>
                                        <a href="{{ route('product.detail', $product->slug) }}" class="btn btn-sm btn-outline-primary">View</a>
                                        <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="fas fa-cart-plus"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-info">No products found.</div>
                    </div>
                    @endforelse
                </div>
                
                <div class="mt-4">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection