<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Fashion Store</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Custom CSS --}}
    <style>
        body { font-family: 'Segoe UI', sans-serif; }

        /* Navbar */
        .navbar-brand { font-size: 1.5rem; font-weight: 700; }
        .navbar { box-shadow: 0 2px 10px rgba(0,0,0,0.1); }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            color: white;
            padding: 100px 0;
        }

        /* Product Card */
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 12px;
            overflow: hidden;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        .product-card img {
            height: 250px;
            object-fit: cover;
        }
        .product-price {
            color: #e63946;
            font-weight: 700;
            font-size: 1.2rem;
        }

        /* Footer */
        .footer {
            background: #1a1a2e;
            color: #aaa;
        }
        .footer a { color: #aaa; text-decoration: none; }
        .footer a:hover { color: white; }

        /* Cart Badge */
        .cart-badge {
            position: relative;
        }
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #e63946;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    @yield('styles')
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">

            {{-- Brand --}}
            <a class="navbar-brand" href="/">
                <i class="fas fa-store me-2"></i>Fashion Store
            </a>

            {{-- Toggle --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Nav Links --}}
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('shop*') ? 'active' : '' }}" href="/shop">
                            Shop
                        </a>
                    </li>
                </ul>

                {{-- Search --}}
                <form class="d-flex me-3" action="/shop" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                               placeholder="Search products..."
                               value="{{ request('search') }}">
                        <button class="btn btn-outline-light" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                {{-- Cart & Auth --}}
                <ul class="navbar-nav">
                    <li class="nav-item me-2">
                        <a class="nav-link cart-badge" href="/cart">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                            <span class="cart-count">{{ count(session()->get('cart', [])) }}</span>
                        </a>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i>{{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="/my-orders">
                                        <i class="fas fa-box me-2"></i>My Orders
                                    </a>
                                </li>
                                @if(auth()->user()->hasRole('admin'))
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            <i class="fas fa-cog me-2"></i>Admin Panel
                                        </a>
                                    </li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/login">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary btn-sm ms-2 mt-1" href="/register">
                                Register
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>

        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-0 rounded-0">
            <div class="container">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    {{-- Page Content --}}
    @yield('content')

    {{-- Footer --}}
    <footer class="footer py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="text-white mb-3">
                        <i class="fas fa-store me-2"></i>Fashion Store
                    </h5>
                    <p>Your one-stop destination for the latest fashion trends.</p>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="text-white mb-3">Shop</h6>
                    <ul class="list-unstyled">
                        <li><a href="/shop">All Products</a></li>
                        <li><a href="/shop?category=men">Men</a></li>
                        <li><a href="/shop?category=women">Women</a></li>
                        <li><a href="/shop?category=kids">Kids</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="text-white mb-3">Account</h6>
                    <ul class="list-unstyled">
                        <li><a href="/login">Login</a></li>
                        <li><a href="/register">Register</a></li>
                        <li><a href="/my-orders">My Orders</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h6 class="text-white mb-3">Contact</h6>
                    <p><i class="fas fa-envelope me-2"></i>info@fashionstore.com</p>
                    <p><i class="fas fa-phone me-2"></i>+1 234 567 890</p>
                    <div class="mt-3">
                        <a href="#" class="me-3 fs-5"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="me-3 fs-5"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="me-3 fs-5"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <hr style="border-color: #333;">
            <div class="text-center">
                <small>&copy; 2026 Fashion Store. All rights reserved.</small>
            </div>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>
</html>