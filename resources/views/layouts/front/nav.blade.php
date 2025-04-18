<!-- ##### Header Area Start ##### -->
<header class="header-area">

    <!-- Top Header Area -->
    {{-- <div class="top-header-area">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-between">
                <!-- Breaking News -->
                <div class="col-12 col-sm-6">
                    <div class="breaking-news">
                        <div id="breakingNewsTicker" class="ticker">
                            <ul>
                                <li><a href="#">Hello World!</a></li>
                                <li><a href="#">Welcome to Colorlib Family.</a></li>
                                <li><a href="#">Hello Delicious!</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="top-social-info text-right">
                    <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                </div>
                <!-- Top Social Info -->
                <div class="col-12 col-sm-6">
                    <div class="top-social-info text-right">
                        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Navbar Area -->
    <div class="delicious-main-menu">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <!-- Menu -->
                <nav class="classy-navbar fixed-top justify-content-between" id="deliciousNav">

                    <!-- Logo -->
                    <a class="nav-brand" href="{{ url('/') }}">
                        <img src="{{ asset('front/assets/img/core-img/resep-removebg-preview.png') }}" alt=""
                            style="width: 250px;">
                    </a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">

                        <!-- close btn -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul>
                                <li><a href="{{ url('/') }}">Beranda</a></li>
                                <li><a href="{{ url('resep') }}">Resep</a></li>
                                <li><a href="{{ url('tentang') }}">Tentang</a></li>
                                <li><a href="{{ url('kontak') }}">Hubungi Kami</a></li>

                                <!-- Login / Profile -->
                                @if (Auth::check())
                                    <!-- Jika sudah login, tampilkan dropdown dengan ikon profil -->
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                            id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fas fa-user-circle me-2"></i> <!-- Menambahkan ikon user -->
                                            <span class="d-none d-md-inline">{{ Auth::user()->username }}</span>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="{{ route('profile') }}">Profil</a></li>
                                            <li>
                                                <form action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">Logout</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                @else
                                    <!-- Jika belum login, tampilkan "Sign In" -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                                    </li>
                                @endif

                            </ul>

                            <!-- Newsletter Form -->
                            <input type="text" name="search" class="search-input" placeholder="Cari Resep..."
                                value="{{ request('search') }}">
                            <button type="submit" class="search-btn">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>

                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ##### Header Area End ##### -->
