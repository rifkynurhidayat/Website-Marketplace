<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>
    @stack ('prepend-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="/style/main.css" rel="stylesheet" />
    @stack('addon-style')
</head>

<body>
    <div class="page-dashboard">
        <div class="d-flex" data-aos="fade-right" id="wrapper">
            <!--Sidebar-->
            <div class="border-right" id="sidebar-wrapper">
                <div class="sidebar-heading text-center">
                    <img src="/images/dahsboard-logo.svg" class="my-4" alt="" />
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('dashboard') }}"
                        class="list-group-item list-group-item-action {{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a>
                    <a href={{ route('dashboard-products') }}
                        class="list-group-item list-group-item-action {{ request()->is('dashboard/products*') ? 'active' : '' }}">My
                        Products</a>
                    <a href="{{ route('dashboard-transaction') }}"
                        class="list-group-item list-group-item-action {{ request()->is('dashboard/transaction*') ? 'active' : '' }}">Transactions</a>
                    <a href="{{ route('dashboard-setting') }}"
                        class="list-group-item list-group-item-action {{ request()->is('dashboard/setting*') ? 'active' : '' }}">Store
                        Settings</a>
                    <a href="{{ route('dashboard-account') }}"
                        class="list-group-item list-group-item-action {{ request()->is('dashboard/account') ? 'active' : '' }}">My
                        Account</a>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                        class="list-group-item list-group-item-action">Sign Out</a>
                </div>
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <!--page content-->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top" data-aos="fade-down">
                    <div class="container-fluid">
                        <button class="btn btn-outline-secondary d-md-none mr-auto mr-2" id="menu-toggle">&laquo;
                            Menu</button>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <!-- Desktop Menu-->
                            <ul class="navbar-nav d-none d-lg-flex ml-auto">
                                <li class="nav-item dropdown">
                                    <a href="" class="nav-link" id="navbarDropdown" role="button"
                                        data-toggle="dropdown">
                                        <img src="/images/icon_user.png" alt=""
                                            class="rounded-circle mr-2 profile-picture" />
                                        Hi, {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('dashboard') }}" class="dropdown-item">Dasboard</a>
                                        <a href="/dashboard-account.html" class="dropdown-item">Settings</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                                        class="list-group-item list-group-item-action">Log Out</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    @php
                                        $keranjang = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
                                    @endphp
                                    <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2 ">
                                        @if ($keranjang > 0)
                                            <img src="/images/icon-keranjang.svg" alt="Keranjang" class="">
                                            <div class="card-badge">{{ $keranjang }}</div>
                                        @else
                                            <img src="/images/icon_empty.svg" alt="Keranjang Kosong" class="">
                                        @endif
                                    </a>
                                </li>
                            </ul>
                            <!-- Mobile menu-->
                            <ul class="navbar-nav d-block d-lg-none">
                                <li class="nav-item">
                                    <a href="" class="nav-link"> Hi, {{ Auth::user()->name }} </a>
                                </li>
                                <li class="nav-item">
                                    @php
                                        $keranjang = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
                                    @endphp
                                    <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2 ">
                                        @if ($keranjang > 0)
                                            <img src="/images/icon-keranjang.svg" alt="Keranjang" class="">
                                            <div class="card-badge">{{ $keranjang }}</div>
                                        @else
                                            <img src="/images/icon_empty.svg" alt="Keranjang Kosong" class="">
                                        @endif
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                {{-- content --}}
                @yield('content')
            </div>
        </div>
    </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    @stack ('prepend-script')

    <script src="/vendor/jquery/jquery.slim.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    @stack('addon-script')
</body>

</html>
