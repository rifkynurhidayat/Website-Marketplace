<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{ asset('images/logo.svg') }}" alt="logo" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Rewards</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categories') }}">Categories</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-success px-4 text-white" href="{{ route('login') }}">Sign In</a>
                    </li>
                @endguest
            </ul>

            @auth
                <!-- Desktop Menu-->
                <ul class="navbar-nav d-none d-lg-flex">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                            <img src="/images/icon_user.png" alt="" class="rounded-circle mr-2 profile-picture" />
                            Hi, {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            @if (Auth::user()->store_name)
                                <a href="{{ route('dashboard') }}" class="dropdown-item">Dasboard</a>
                                <a href="{{ route('dashboard-account') }}" class="dropdown-item">Settings</a>
                            @else
                                <a href="{{ route('dashboard-account') }}" class="dropdown-item">Pengaturan</a>
                            @endif

                            <div class="dropdown-divider"></div>
                            <!-- Form Logout -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            <!-- Tautan Logout -->
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"
                                class="dropdown-item">
                                Logout
                            </a>
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
                        <a href="" class="nav-link"> Hi, Rifky </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link"> Cart </a>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>
