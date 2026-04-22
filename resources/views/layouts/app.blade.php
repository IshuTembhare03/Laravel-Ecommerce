<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Royal Furniture')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0d9488;
            --primary-dark: #0f766e;
            --primary-light: #14b8a6;
            --secondary-color: #6366f1;
            --accent-color: #f59e0b;
            --dark-bg: #1e293b;
            --light-bg: #f8fafc;
            --text-dark: #1e293b;
            --text-light: #f1f5f9;
            --success: #10b981;
            --danger: #ef4444;
            --info: #3b82f6;
            --card-bg: #ffffff;
            --border-color: #e2e8f0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            line-height: 1.6;
        }
        
        h1, h2, h3, h4, h5, h6, .font-display {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            font-weight: 500;
            padding: 0.625rem 1.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 148, 136, 0.3);
        }
        
        .btn-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .btn-secondary:hover {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }
        
        .btn-accent {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: #fff;
        }
        
        .btn-accent:hover {
            background-color: #d97706;
            border-color: #d97706;
            color: #fff;
            transform: translateY(-2px);
        }
        
        .navbar {
            background-color: var(--card-bg);
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            padding: 1rem 0;
        }
        
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--primary-color) !important;
            font-size: 1.5rem;
        }
        
        .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
        }
        
        .nav-link:hover {
            color: var(--primary-color) !important;
            background-color: rgba(13, 148, 136, 0.08);
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 50%, var(--secondary-color) 100%);
            padding: 120px 0;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 60%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            transform: rotate(30deg);
        }
        
        .hero-section h1 {
            font-size: 3.5rem;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }
        
        .hero-section .lead {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }
        
        .category-card, .product-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        
        .category-card:hover, .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12);
            border-color: var(--primary-light);
        }
        
        .product-card .card-img-top {
            height: 260px;
            object-fit: cover;
        }
        
        .product-card .card-body {
            padding: 1.5rem;
        }
        
        .product-card .card-title {
            font-size: 1.125rem;
            margin-bottom: 0.5rem;
        }
        
        .product-card .card-text {
            color: #64748b;
            font-size: 0.875rem;
        }
        
        .price-tag {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.375rem;
        }
        
        .section-title {
            position: relative;
            padding-bottom: 1rem;
            margin-bottom: 3rem;
            font-size: 2rem;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }
        
        .category-badge {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: #fff;
            padding: 0.375rem 0.75rem;
            border-radius: 2rem;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .footer {
            background-color: var(--dark-bg);
            color: var(--text-light);
            padding: 80px 0 30px;
        }
        
        .footer h5 {
            color: #fff;
            margin-bottom: 1.25rem;
            font-weight: 600;
        }
        
        .footer a {
            color: #94a3b8;
            text-decoration: none;
            transition: all 0.2s ease;
            display: block;
            padding: 0.375rem 0;
        }
        
        .footer a:hover {
            color: var(--primary-light);
            transform: translateX(4px);
        }
        
        .footer hr {
            border-color: rgba(255,255,255,0.1);
            margin: 2rem 0;
        }
        
        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
        }
        
        .card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        
        .card-header {
            background: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
            padding: 1rem 1.5rem;
        }
        
        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            border-color: var(--success);
            color: var(--success);
            border-radius: 0.5rem;
        }
        
        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            border-color: var(--danger);
            color: var(--danger);
            border-radius: 0.5rem;
        }
        
        .alert-info {
            background-color: rgba(59, 130, 246, 0.1);
            border-color: var(--info);
            color: var(--info);
            border-radius: 0.5rem;
        }
        
        .badge {
            padding: 0.375rem 0.75rem;
            border-radius: 2rem;
            font-weight: 500;
        }
        
        .dropdown-menu {
            border: 1px solid var(--border-color);
            border-radius: 0.75rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            padding: 0.5rem;
        }
        
        .dropdown-item {
            border-radius: 0.5rem;
            padding: 0.625rem 1rem;
            transition: all 0.2s ease;
        }
        
        .dropdown-item:hover {
            background-color: rgba(13, 148, 136, 0.1);
            color: var(--primary-color);
        }
        
        @media (max-width: 768px) {
            .hero-section {
                padding: 80px 0;
            }
            
            .hero-section h1 {
                font-size: 2.5rem;
            }
            
            .product-card .card-img-top {
                height: 200px;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-crown me-2"></i>Royal Furniture
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart') }}">
                            <i class="fas fa-shopping-cart me-1"></i>Cart
                            @php
                                $cartCount = 0;
                                if(Auth::check()) {
                                    $cartCount = \App\Models\Cart::where('user_id', Auth::id())->sum('quantity');
                                } else {
                                    $cart = session('cart', []);
                                    foreach($cart as $item) $cartCount += $item['quantity'];
                                }
                            @endphp
                            @if($cartCount > 0)
                                <span class="badge bg-warning text-dark ms-1">{{ $cartCount }}</span>
                            @endif
                        </a>
                    </li>
                    @auth
                        <li class="nav-item dropdown ms-2">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                <div class="avatar-circle bg-primary text-white me-2">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                @if(Auth::user()->is_admin)
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-crown me-2 text-warning"></i>Admin Panel
                                    </a></li>
                                @endif
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item ms-2">
                            <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="font-display mb-3">
                        <i class="fas fa-crown me-2 text-primary"></i>Royal Furniture
                    </h5>
                    <p class="text-secondary">Discover the finest collection of luxury furniture for your home.</p>
                    <div class="d-flex gap-3">
                        <a href="#"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#"><i class="fab fa-pinterest fa-lg"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-6 mb-4">
                    <h6 class="mb-3 text-uppercase text-muted small">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('products') }}">Products</a></li>
                        <li><a href="{{ route('cart') }}">Cart</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 mb-4">
                    <h6 class="mb-3 text-uppercase text-muted small">Categories</h6>
                    <ul class="list-unstyled">
                        @foreach(\App\Models\Category::where('status', 1)->take(4)->get() as $category)
                            <li><a href="{{ route('products', ['category' => $category->slug]) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-4 mb-4">
                    <h6 class="mb-3 text-uppercase text-muted small">Contact Us</h6>
                    <p class="text-secondary mb-1"><i class="fas fa-map-marker-alt me-2 text-primary"></i>123 Royal Street, Luxury City</p>
                    <p class="text-secondary mb-1"><i class="fas fa-phone me-2 text-primary"></i>+1 234 567 890</p>
                    <p class="text-secondary mb-0"><i class="fas fa-envelope me-2 text-primary"></i>info@royalfurniture.com</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0 text-secondary">&copy; {{ date('Y') }} Royal Furniture. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <span class="text-secondary">Crafted with </span>
                    <i class="fas fa-heart text-danger"></i>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>