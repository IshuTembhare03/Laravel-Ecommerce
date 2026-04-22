@extends('layouts.app')

@section('title', 'Home - Royal Furniture')

@section('content')
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-3 font-display mb-4">Welcome to Royal Furniture</h1>
        <p class="lead mb-4">Discover the finest collection of luxury furniture for your home</p>
        <a href="{{ route('products') }}" class="btn btn-accent btn-lg px-5">Shop Now</a>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h2 class="text-center section-title font-display">Our Categories</h2>
        <div class="row g-4">
            @foreach($categories as $category)
            <div class="col-md-4 col-sm-6">
                <div class="category-card card h-100">
                    @php
                    $catImg = null;
                    if ($category->image) {
                        $catImg = $category->url;
                    }
                    @endphp
                    @if($catImg)
                    <img src="{{ $catImg }}" class="card-img-top" alt="{{ $category->name }}" style="height: 200px; object-fit: cover;">
                    @else
                    <img src="https://placehold.co/400x200/0d9488/ffffff?text={{ urlencode($category->name) }}" class="card-img-top" alt="{{ $category->name }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body text-center">
                        <h5 class="card-title font-display">{{ $category->name }}</h5>
                        <p class="card-text text-muted">{{ \Str::limit($category->description, 80) }}</p>
                        <a href="{{ route('products', ['category' => $category->slug]) }}" class="btn btn-outline-primary">View Products</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center section-title font-display">Featured Products</h2>
        <div class="row g-4">
            @forelse($featuredProducts as $product)
            <div class="col-md-4 col-sm-6">
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
                        <p class="card-text text-muted">{{ \Str::limit($product->description, 60) }}</p>
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
                <p class="text-center text-muted">No featured products available at the moment.</p>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('products') }}" class="btn btn-primary btn-lg">View All Products</a>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <img src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=600" alt="About Us" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h2 class="font-display mb-4">Crafted with Excellence</h2>
                <p class="lead">At Royal Furniture, we believe that every piece of furniture tells a story of craftsmanship and luxury.</p>
                <p>Our collection features meticulously crafted pieces from the finest materials, designed to bring elegance and comfort to your living space. With decades of experience in the furniture industry, we pride ourselves on delivering exceptional quality and timeless designs.</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Premium Quality Materials</li>
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Expert Craftsmanship</li>
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Free Shipping on Orders Over $500</li>
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>30-Day Return Policy</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection