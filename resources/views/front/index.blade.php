@extends('layouts.front')
@section('content')
    <!-- ##### Hero Area Start ##### -->
    <section class="hero-area">
        <div class="hero-slides owl-carousel">
            @foreach ($hero_resep as $data)
                <div class="single-hero-slide bg-img"
                    style="background-image: url('{{ asset('/gambars/resep/' . $data->gambar) }}');">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                                <div class="hero-slides-content" data-animation="fadeInUp" data-delay="100ms">
                                    <h2 data-animation="fadeInUp" data-delay="300ms">{{ $data->nama_resep }}</h2>
                                    <a href="{{ url('detail_resep/' . $data->id) }}" class="btn delicious-btn"
                                        data-animation="fadeInUp" data-delay="1000ms">Lihat Resep</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ##### Hero Area End ##### -->

    <!-- ##### Best Receipe Area Start ##### -->
    <section class="best-receipe-area section-padding section-border">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>Resep Paling Banyak Disukai❤️</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($resep_terbaru as $data)
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

    <section class="about-area section-padding section-border">
        <div class="container">
            <div class="row align-items-center mt-70">
                <!-- Single Cool Fact -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-fact">
                        <img src="front/assets/img/core-img/hamburger.png" alt="">
                        <h3><span class="counter">{{ $resepCount }}</span></h3>
                        <h6>Total Resep</h6>
                    </div>
                </div>

                @foreach ($kategoriCount as $kategori)
                    <!-- Single Cool Fact -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-cool-fact">
                            @php
                                // Menentukan gambar & label berdasarkan nama kategori
                                $img = 'salad.png';
                                $label = 'Makanan Pembuka';
                                if ($kategori->nama_kategori == 'Makanan Utama') {
                                    $img = 'rib.png';
                                    $label = 'Makanan Utama';
                                } elseif ($kategori->nama_kategori == 'Makanan Penutup') {
                                    $img = 'pancake.png';
                                    $label = 'Makanan Penutup';
                                }
                            @endphp
                            <img src="front/assets/img/core-img/{{ $img }}" alt="">
                            <h3><span class="counter">{{ $kategori->total }}</span></h3>
                            <h6>{{ $label }}</h6>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- ##### Small Receipe Area Start ##### -->
    <section class="small-receipe-area section-padding section-border">
        <div class="container">
            <div class="section-heading">
                <h3>Daftar Resep</h3>
            </div>
            <div class="row justify-content-center">
                @foreach ($resep_lain as $data)
                    <!-- Small Receipe Area -->
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-small-receipe-area d-flex">
                            <!-- Receipe Thumb -->
                            <div class="receipe-thumb">
                                <img src="{{ asset('/gambars/resep/' . $data->gambar) }}"
                                    style="width: 100px; height: 70px; object-fit: cover; border-radius: 10px;"
                                    alt="">
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
    <section class="quote-subscribe-adds section-padding section-border">
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
