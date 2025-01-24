<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Resepku</title>

    <!-- Favicon -->
    <link rel="icon" href="{{asset('front/assets/img/core-img/logoresepku.png')}}">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{asset('front/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/css/classy-nav.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/css/custom-icon.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/css/nice-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/scss/_fonts.scss')}}">
    <link rel="stylesheet" href="{{asset('front/assets/scss/_mixin.scss')}}">
    <link rel="stylesheet" href="{{asset('front/assets/scss/_responsive.scss')}}">
    <link rel="stylesheet" href="{{asset('front/assets/scss/_theme_color.scss')}}">
    <link rel="stylesheet" href="{{asset('front/assets/scss/style.scss')}}">

</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <i class="circle-preloader"></i>
        <img src="{{asset('front/assets/img/core-img/logoresepku.png')}}" alt="">
    </div>

    <!-- Search Wrapper -->
    <div class="search-wrapper">
        <!-- Close Btn -->
        <div class="close-btn"><i class="fa fa-times" aria-hidden="true"></i></div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="#" method="post">
                        <input type="search" name="search" placeholder="Type any keywords...">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </div>
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
    <script src="{{asset('front/assets/js/jquery/jquery-2.2.4.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('front/assets/js/bootstrap/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('front/assets/js/bootstrap/bootstrap.min.js')}}"></script>
    <!-- All Plugins js -->
    <script src="{{asset('front/assets/js/plugins/plugins.js')}}"></script>
    <!-- Active js -->
    <script src="{{asset('front/assets/js/active.js')}}"></script>
</body>

</html>
