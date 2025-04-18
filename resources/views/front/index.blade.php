@extends('layouts.front')
@section('content')
    <!-- ##### Hero Area Start ##### -->
    <section class="hero-area">
        <div class="hero-slides owl-carousel">
            <!-- Single Hero Slide -->
            <div class="single-hero-slide bg-img" style="background-image: url(front/assets/img/bg-img/bg1.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="hero-slides-content" data-animation="fadeInUp" data-delay="100ms">
                                <h2 data-animation="fadeInUp" data-delay="300ms">Delicios Homemade Burger</h2>
                                <p data-animation="fadeInUp" data-delay="700ms">Lorem ipsum dolor sit amet, consectetur
                                    adipiscing elit. Cras tristique nisl vitae luctus sollicitudin. Fusce consectetur sem
                                    eget dui tristique, ac posuere arcu varius.</p>
                                <a href="#" class="btn delicious-btn" data-animation="fadeInUp"
                                    data-delay="1000ms">See Receipe</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Hero Slide -->
            <div class="single-hero-slide bg-img" style="background-image: url(front/assets/img/bg-img/bg6.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="hero-slides-content" data-animation="fadeInUp" data-delay="100ms">
                                <h2 data-animation="fadeInUp" data-delay="300ms">Delicios Homemade Burger</h2>
                                <p data-animation="fadeInUp" data-delay="700ms">Lorem ipsum dolor sit amet, consectetur
                                    adipiscing elit. Cras tristique nisl vitae luctus sollicitudin. Fusce consectetur sem
                                    eget dui tristique, ac posuere arcu varius.</p>
                                <a href="#" class="btn delicious-btn" data-animation="fadeInUp"
                                    data-delay="1000ms">See Receipe</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Hero Slide -->
            <div class="single-hero-slide bg-img" style="background-image: url(front/assets/img/bg-img/bg7.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="hero-slides-content" data-animation="fadeInUp" data-delay="100ms">
                                <h2 data-animation="fadeInUp" data-delay="300ms">Delicios Homemade Burger</h2>
                                <p data-animation="fadeInUp" data-delay="700ms">Lorem ipsum dolor sit amet, consectetur
                                    adipiscing elit. Cras tristique nisl vitae luctus sollicitudin. Fusce consectetur sem
                                    eget dui tristique, ac posuere arcu varius.</p>
                                <a href="#" class="btn delicious-btn" data-animation="fadeInUp"
                                    data-delay="1000ms">See Receipe</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Hero Area End ##### -->

    <!-- ##### Top Catagory Area Start ##### -->
    <section class="top-catagory-area section-padding-80-0">
        <div class="container">
            <div class="row">
                <!-- Top Catagory Area -->
                <div class="col-12 col-lg-6">
                    <div class="single-top-catagory">
                        <img src="front/assets/img/bg-img/bg2.jpg" alt="">
                        <!-- Content -->
                        <div class="top-cta-content">
                            <h3>Strawberry Cake</h3>
                            <h6>Simple &amp; Delicios</h6>
                            <a href="receipe-post.html" class="btn delicious-btn">See Full Receipe</a>
                        </div>
                    </div>
                </div>
                <!-- Top Catagory Area -->
                <div class="col-12 col-lg-6">
                    <div class="single-top-catagory">
                        <img src="front/assets/img/bg-img/bg3.jpg" alt="">
                        <!-- Content -->
                        <div class="top-cta-content">
                            <h3>Chinesse Noodles</h3>
                            <h6>Simple &amp; Delicios</h6>
                            <a href="receipe-post.html" class="btn delicious-btn">See Full Receipe</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Top Catagory Area End ##### -->

    <!-- ##### Best Receipe Area Start ##### -->
    <section class="best-receipe-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>The best Receipies</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($resep as $data)
                    <!-- Single Best Recipe Area -->
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-best-receipe-area mb-30">
                            <a href="{{ url('detail_resep') . '/' . $data->id }}">
                                <img src="{{ asset('/gambars/resep/' . $data->gambar) }}" alt=""
                                    style="width: 250px; height: 250px; object-fit: cover; border-radius: 10px;">
                            </a>
                            <div class="receipe-content d-flex justify-content-between align-items-center gap-2">
                                <h5 class="mb-0" style="flex-grow: 1;">{{ $data->nama_resep }}</h5>

                                @php
                                    $liked = $data->likes && $data->likes->contains('id_user', auth()->id());
                                @endphp

                                <button type="button" class="like-btn" data-resep-id="{{ $data->id }}"
                                    data-liked="{{ $liked ? 'true' : 'false' }}"
                                    style="background: none; border: none; cursor: pointer; outline: none">
                                    <i class="{{ $liked ? 'fas fa-heart text-danger' : 'far fa-heart text-secondary' }}"
                                        style="font-size: 20px;"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ##### Best Receipe Area End ##### -->

    <!-- ##### CTA Area Start ##### -->
    <section class="cta-area bg-img bg-overlay" style="background-image: url(front/assets/img/bg-img/bg4.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <!-- Cta Content -->
                    <div class="cta-content text-center">
                        <h2>Gluten Free Receipies</h2>
                        <p>Fusce nec ante vitae lacus aliquet vulputate. Donec scelerisque accumsan molestie. Vestibulum
                            ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Cras sed accumsan
                            neque. Ut vulputate, lectus vel aliquam congue, risus leo elementum nibh</p>
                        <a href="#" class="btn delicious-btn">Discover all the receipies</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### CTA Area End ##### -->

    <!-- ##### Small Receipe Area Start ##### -->
    <section class="small-receipe-area section-padding-80-0">
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($resep as $data)
                    <!-- Small Receipe Area -->
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-small-receipe-area d-flex">
                            <!-- Receipe Thumb -->
                            <div class="receipe-thumb">
                                <img src="{{ asset('/gambars/resep/' . $data->gambar) }}" alt="">
                            </div>
                            <!-- Receipe Content -->
                            <div class="receipe-content">
                                <span>{{ $data->created_at }}</span>
                                <a href="{{ url('detail_resep') . '/' . $data->id }}">
                                    <h5>{{ $data->nama_resep }}</h5>
                                </a>
                                <h6 style="color: gray;">{{ $data->kategori->nama_kategori }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ##### Small Receipe Area End ##### -->

    <!-- ##### Quote Area Start ##### -->
    <section class="quote-subscribe-adds">
        <div class="container ">
            <div class="row align-content-center justify-content-center">
                <!-- Quote -->
                <div class="col-12 col-lg-4">
                    <div class="quote-area text-center">
                        <span>"</span>
                        <h4>Resep tidak memiliki jiwa. Anda, sebagai juru masak, harus memberikan jiwa pada resep tersebut.
                        </h4>
                        <p>Thomas Keller</p>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="quote-area text-center">
                        <span>"</span>
                        <h4>Memasak adalah kisah cinta. Anda harus jatuh cinta pada bahan-bahan dan orang yang memasaknya.
                        </h4>
                        <p>Alain Ducasse</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Quote Area End ##### -->
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".like-btn").click(function() {
            let button = $(this);
            let resepId = button.data("resep-id");
            let isLiked = button.data("liked") === "true";

            $.ajax({
                url: "{{ route('toggle-like') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id_resep: resepId
                },
                success: function(response) {
                    // Toggle class heart icon
                    if (isLiked) {
                        button.find("i").removeClass("fas fa-heart text-danger").addClass(
                            "far fa-heart text-secondary");
                        button.data("liked", "false");
                    } else {
                        button.find("i").removeClass("far fa-heart text-secondary")
                            .addClass("fas fa-heart text-danger");
                        button.data("liked", "true");
                    }
                },
                error: function(xhr) {
                    console.error("Error:", xhr.responseText);
                }
            });
        });
    });
</script>
