@extends('layouts.front')
@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(front/assets/img/bg-img/breadcumb3.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Resep</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <div class="receipe-post-area section-padding-80">

        <!-- Receipe Post Search -->
        <div class="receipe-post-search mb-80">
            <div class="container">
                <form action="{{ route('front.resep') }}" method="GET">
                    <div class="row">
                        <div class="col-12 col-lg-3">
                            <select name="id_kategori" id="select1" onchange="this.form.submit()">
                                <option value="">Semua Kategori</option>
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}"
                                        {{ request('id_kategori') == $kat->id ? 'selected' : '' }}>
                                        {{ $kat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-lg-3">
                            <input type="search" name="search" placeholder="Search Receipies">
                        </div>
                        <div class="col-12 col-lg-3 text-right">
                            <button type="submit" class="btn delicious-btn">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Receipe Slider -->
        {{-- <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="receipe-slider owl-carousel">
                        <img src="{{asset('front/assets/img/bg-img/bg5.jpg')}}" alt="">
                        <img src="{{asset('front/assets/img/bg-img/bg5.jpg')}}" alt="">
                        <img src="{{asset('front/assets/img/bg-img/bg5.jpg')}}" alt="">
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Receipe Content Area -->
        <section class="best-receipe-area">
            <div class="container">
                {{-- <div class="row">
                    <div class="col-12">
                        <div class="section-heading">
                            <h3>The best Receipies</h3>
                        </div>
                    </div>
                </div> --}}

                <div class="row">
                    @foreach ($resep as $data)
                        <!-- Single Best Recipe Area -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="single-best-receipe-area mb-30">
                                <a href="{{ url('detail_resep') . '/' . $data->id }}">
                                    <img src="{{ asset('/gambars/resep/' . $data->gambar) }}" alt=""
                                        style="max-height: 250px; max-width:250px;">
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
    </div>

    <!-- ##### Follow Us Instagram Area Start ##### -->
    <div class="follow-us-instagram">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5>Follow Us Instagram</h5>
                </div>
            </div>
        </div>
        <!-- Instagram Feeds -->
        {{-- <div class="insta-feeds d-flex flex-wrap">
            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta1.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta2.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta3.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta4.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta5.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta6.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta7.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>
        </div> --}}
    </div>
    <!-- ##### Follow Us Instagram Area End ##### -->
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
