<header class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="{{ url('/') }}"><img width="250" height="100" src="/images/logo1.png"
                    alt="#" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('products') }}">Products</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('show_cart') }}"><i class="ri-shopping-cart-fill"></i>
                            @if (session('cartCount'))
                                <span class="badge badge-success">{{ session('cartCount') }}</span>
                            @endif
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('show_order') }}"></i>
                            Order(s)
                        </a>
                    </li>

                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <x-app-layout>

                                </x-app-layout>
                            </li>
                        @else
                            <li class="nav-item">
                                <h5><a class="btn btn-secondary" id="logincss" href="{{ route('login') }}">Login</a></h5>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-danger" href="{{ route('register') }}">Register</a>
                            </li>
                        @endauth
                    @endif
                </ul>
            </div>
        </nav>
    </div>

    <style>
        .navbar {
            background-color: black;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            padding-left: 20px;
            padding-right: 20px;
            color: white;
            z-index: 100;
            height: 100px;
        }

        .nav-item {
            color: white;
        }
    </style>
</header>
