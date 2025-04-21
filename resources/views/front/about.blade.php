@extends('layouts.front')
@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(front/assets/img/bg-img/breadcumb1.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Tentang Resepku</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <section class="about-area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>Siapakah kami dan apa yang kami lakukan?</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <h6 class="sub-heading pb-5">Resepku adalah platform berbagi resep makanan yang dirancang untuk
                        memudahkan siapa saja menemukan, menyimpan, dan menikmati berbagai inspirasi masakan. Di sini, kamu
                        bisa menjelajahi aneka resep, menambahkannya ke daftar favorit, serta berbagi komentar dan
                        pengalaman dengan pengguna lain.
                    </h6>

                    <p class="text-center">Kamu juga dapat mengajukan resep buatanmu sendiri agar bisa dilihat lebih banyak
                        orang. Dengan tampilan yang sederhana dan fitur yang praktis, Resepku hadir untuk menjadikan
                        kegiatan memasak lebih menyenangkan dan penuh ide baru setiap hari.
                    </p>
                </div>
            </div>

            <div class="row align-items-center mt-70">
                <!-- Single Cool Fact -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-fact">
                        <img src="front/assets/img/core-img/hamburger.png" alt="">
                        <h3><span class="counter">{{$resepCount}}</span></h3>
                        <h6>Total Resep</h6>
                    </div>
                </div>

                <!-- Single Cool Fact -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-fact">
                        <img src="front/assets/img/core-img/salad.png" alt="">
                        <h3><span class="counter">25</span></h3>
                        <h6>Makanan Pembuka</h6>
                    </div>
                </div>

                <!-- Single Cool Fact -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-fact">
                        <img src="front/assets/img/core-img/rib.png" alt="">
                        <h3><span class="counter">471</span></h3>
                        <h6>Makanan Utama</h6>
                    </div>
                </div>

                <!-- Single Cool Fact -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-fact">
                        <img src="front/assets/img/core-img/pancake.png" alt="">
                        <h3><span class="counter">326</span></h3>
                        <h6>Makanan Penutup</h6>
                    </div>
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-12">
                    <img class="mb-70" src="img/bg-img/about.png" alt="">
                    <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec varius
                        dui. Suspendisse potenti. Vestibulum ac pellentesque tortor. Aenean congue sed metus in iaculis.
                        Cras a tortor enim. Phasellus posuere vestibulum ipsum, eget lobortis purus. Orci varius natoque
                        penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin malesuada et mauris ut
                        lobortis. Sed eu iaculis sapien, eget luctus quam. Aenean hendrerit varius massa quis laoreet. Donec
                        quis metus ac arcu luctus accumsan. Nunc in justo tincidunt, sodales nunc id, finibus nibh. Class
                        aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
                </div>
            </div> --}}
        </div>
    </section>
@endsection
