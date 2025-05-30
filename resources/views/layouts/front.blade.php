<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Resepku</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('front/assets/img/core-img/resep.png') }}">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/classy-nav.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/custom-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/scss/_fonts.scss') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/scss/_mixin.scss') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/scss/_responsive.scss') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/scss/_theme_color.scss') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/scss/style.scss') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <i class="circle-preloader"></i>
        <img src="{{ asset('front/assets/img/core-img/resep-removebg-preview.png') }}" alt=""
            style="width: 70px">
    </div>

    <!-- ##### Header Area Start ##### -->
    @include('layouts.front.nav')
    <!-- ##### Header Area End ##### -->

    {{-- main area start --}}

    <main>
        @yield('content')
    </main>

    {{-- main area end --}}

    <!-- ##### Footer Area Start ##### -->
    @include('layouts.front.footer')
    <!-- ##### Footer Area Start ##### -->

    <!-- ##### All Javascript Files ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="{{ asset('front/assets/js/jquery/jquery-2.2.4.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('front/assets/js/bootstrap/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('front/assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <!-- All Plugins js -->
    <script src="{{ asset('front/assets/js/plugins/plugins.js') }}"></script>
    <!-- Active js -->
    <script src="{{ asset('front/assets/js/active.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('script')
</body>

</html>
