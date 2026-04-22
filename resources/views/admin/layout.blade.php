<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Royal Furniture')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            --darker-bg: #0f172a;
            --light-bg: #f8fafc;
            --text-dark: #1e293b;
            --text-light: #f1f5f9;
            --success: #10b981;
            --danger: #ef4444;
            --info: #3b82f6;
            --border-color: #334155;
        }
        
        body {
            font-family: 'Lato', sans-serif;
            background-color: var(--darker-bg);
            color: var(--text-light);
        }
        
        h1, h2, h3, h4, h5, h6, .font-display {
            font-family: 'Playfair Display', serif;
        }
        
        .sidebar {
            background-color: var(--dark-bg);
            min-height: 100vh;
            border-right: 1px solid var(--border-color);
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.7);
            padding: 12px 20px;
            border-radius: 8px;
            margin: 2px 8px;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: var(--primary-color);
            color: #fff;
        }
        
        .sidebar .nav-link i {
            width: 25px;
        }
        
        .main-content {
            background-color: var(--darker-bg);
            min-height: 100vh;
        }
        
        .top-bar {
            background-color: var(--dark-bg);
            border-bottom: 1px solid var(--border-color);
        }
        
        .card {
            background-color: var(--dark-bg);
            border: 1px solid var(--border-color);
        }
        
        .card-header {
            background-color: var(--darker-bg);
            border-bottom: 1px solid var(--border-color);
        }
        
        .table {
            color: var(--text-light);
        }
        
        .table > :not(caption) > * > * {
            background-color: transparent;
            border-bottom-color: var(--border-color);
        }
        
        .table thead {
            background-color: var(--darker-bg);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #6B3410;
            border-color: #6B3410;
        }
        
        .btn-accent {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: #fff;
        }
        
        .form-control, .form-select {
            background-color: var(--darker-bg);
            border-color: var(--border-color);
            color: var(--text-light);
        }
        
        .form-control:focus, .form-select:focus {
            background-color: var(--darker-bg);
            border-color: var(--primary-color);
            color: var(--text-light);
        }
        
        .form-label {
            color: var(--text-light);
        }
        
        .alert-success {
            background-color: rgba(46, 125, 50, 0.2);
            border-color: var(--success);
            color: var(--success);
        }
        
        .alert-danger {
            background-color: rgba(198, 40, 40, 0.2);
            border-color: var(--danger);
            color: #ff6b6b;
        }
        
        .alert-info {
            background-color: rgba(21, 101, 192, 0.2);
            border-color: var(--info);
            color: #64b5f6;
        }
        
        .pagination .page-link {
            background-color: var(--dark-bg);
            border-color: var(--border-color);
            color: var(--text-light);
        }
        
        .pagination .page-link:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: #fff;
        }
        
        .dropdown-menu {
            background-color: var(--dark-bg);
            border-color: var(--border-color);
        }
        
        .dropdown-item {
            color: var(--text-light);
        }
        
        .dropdown-item:hover {
            background-color: var(--primary-color);
            color: #fff;
        }
        
        .stat-card {
            background: linear-gradient(135deg, var(--dark-bg), var(--darker-bg));
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 20px;
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color);
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        
        .badge-active {
            background-color: rgba(46, 125, 50, 0.2);
            color: var(--success);
        }
        
        .badge-inactive {
            background-color: rgba(198, 40, 40, 0.2);
            color: var(--danger);
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-0">
                <div class="p-3 text-center border-bottom" style="border-color: var(--border-color) !important;">
                    <a href="{{ route('home') }}" class="text-decoration-none">
                        <h4 class="font-display text-warning mb-0">
                            <i class="fas fa-crown me-2"></i>Royal
                        </h4>
                        <small class="text-muted">Admin Panel</small>
                    </a>
                </div>
                
                <nav class="nav flex-column mt-3">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <i class="fas fa-box"></i> Products
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="fas fa-tags"></i> Categories
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <i class="fas fa-shopping-cart"></i> Orders
                    </a>
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="fas fa-store"></i> View Site
                    </a>
                </nav>
            </div>
            
            <div class="col-md-10 main-content">
                <nav class="navbar navbar-expand top-bar px-4">
                    <div class="container-fluid">
                        <span class="navbar-brand mb-0 h1 font-display">@yield('page-title', 'Dashboard')</span>
                        <div class="d-flex align-items-center">
                            <span class="text-muted me-3">{{ Auth::user()->name }}</span>
                            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-light">
                                <i class="fas fa-external-link-alt me-1"></i> View Site
                            </a>
                        </div>
                    </div>
                </nav>
                
                <main class="p-4">
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
                    
                    @yield('admin-content')
                </main>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>