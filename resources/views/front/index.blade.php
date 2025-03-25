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
            <div class="row">
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

    <!-- ##### Quote Subscribe Area Start ##### -->
    <section class="quote-subscribe-adds">
        <div class="container">
            <div class="row align-items-end">
                <!-- Quote -->
                <div class="col-12 col-lg-4">
                    <div class="quote-area text-center">
                        <span>"</span>
                        <h4>Nothing is better than going home to family and eating good food and relaxing</h4>
                        <p>John Smith</p>
                        <div class="date-comments d-flex justify-content-between">
                            <div class="date">January 04, 2018</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Quote Subscribe Area End ##### -->

    <!-- ##### Follow Us Instagram Area Start ##### -->
    {{-- <div class="follow-us-instagram">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5>Follow Us Instragram</h5>
                </div>
            </div>
        </div>
        <!-- Instagram Feeds -->
        <div class="insta-feeds d-flex flex-wrap">
            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="{{ asset('front/assets/img/bg-img/insta1.jpg') }}" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="{{ asset('front/assets/img/bg-img/insta2.jpg') }}" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="{{ asset('front/assets/img/bg-img/insta3.jpg') }}" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="{{ asset('front/assets/img/bg-img/insta4.jpg') }}" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="{{ asset('front/assets/img/bg-img/insta5.jpg') }}" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="{{ asset('front/assets/img/bg-img/insta6.jpg') }}" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="{{ asset('front/assets/img/bg-img/insta7.jpg') }}" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- ##### Follow Us Instagram Area End ##### -->
@endsection

{{-- @section('script')
    <script>
        // return;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const baseUrl = $('input[type=hidden][name="base_url"]').val()
        console.log(baseUrl)

        $('.like-btn').on('click', async function(e) {
            e.preventDefault();

            const resepId = $(this).data('resep-id')
            const userId = $(this).data('user-id')
            console.log(userId)

            await onClickLikeBtn(resepId, $(this))
        })

        async function onClickLikeBtn(resepId = null, el) {
            try {
                const requestParams = {
                    id_resep: resepId
                }
                const response = await ajaxRequest('toggle-like', 'POST', requestParams)

                if (response?.liked) {
                    el?.addClass('liked'); // Tambahkan class untuk menandakan like
                } else {
                    el?.removeClass('liked'); // Hapus class jika unlike
                }
            } catch (e) {
                console.error(e)
            } finally {
                console.log(el)
            }
        }

        const ajaxRequest = async (url, method = 'GET', data = {}) => {
            await $.ajax({
                url: `${baseUrl}/${url}`,
                method: method,
                dataType: 'application/json',
                data: data,
            })
        }
    </script>
@endsection --}}

<!-- JavaScript untuk menghandle Like AJAX -->
{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".like-btn").forEach(button => {
            button.addEventListener("click", function() {
                let resepId = this.getAttribute("data-resep-id");
                let isLiked = this.getAttribute("data-liked") === "true"; // Ambil status like

                // Kirim request ke backend menggunakan Fetch API
                fetch("{{ route('toggle-like') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            id_resep: resepId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            let icon = this.querySelector("i");
                            if (isLiked) {
                                icon.classList.remove("fas",
                                "text-danger"); // Hapus heart merah
                                icon.classList.add("far",
                                "text-secondary"); // Tambah heart kosong abu-abu
                            } else {
                                icon.classList.remove("far", "text-secondary");
                                icon.classList.add("fas", "text-danger");
                            }
                            this.setAttribute("data-liked", !isLiked); // Update status like
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });
        });
    });
</script> --}}

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
