@extends('layouts.front')
@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(front/assets/img/bg-img/breadcumb4.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Kontak</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Contact Information Area Start ##### -->
    <div class="contact-information-area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="logo mb-80">
                        <img src="img/core-img/logo.png" alt="">
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Contact Text -->
                <div class="col-12 col-lg-5">
                    <div class="contact-text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec varius dui. Suspendisse
                            potenti. Vestibulum ac pellentesque tortor. Aenean congue sed metus in iaculis. Cras a tortor
                            enim. Phasellus posuere vestibulum ipsum, eget lobortis purus.</p>
                        <p>Orci varius natoque penatibus et magnis dis ac pellentesque tortor. Aenean congue parturient
                            montes, nascetur ridiculus mus.</p>
                    </div>
                </div>

                <div class="col-12 col-lg-3">
                    <!-- Single Contact Information -->
                    <div class="single-contact-information mb-30">
                        <h6>Address:</h6>
                        <p>481 Creekside Lane Avila <br>Beach, CA 93424</p>
                    </div>
                    <!-- Single Contact Information -->
                    <div class="single-contact-information mb-30">
                        <h6>Phone:</h6>
                        <p>+53 345 7953 32453 <br>+53 345 7557 822112</p>
                    </div>
                    <!-- Single Contact Information -->
                    <div class="single-contact-information mb-30">
                        <h6>Email:</h6>
                        <p>yourmail@gmail.com</p>
                    </div>
                </div>

                <!-- Newsletter Area -->
                <div class="col-12 col-lg-4">
                    <div class="newsletter-form bg-img bg-overlay" style="background-image: url(img/bg-img/bg1.jpg);">
                        <form action="#" method="post">
                            <input type="email" name="email" placeholder="Subscribe to newsletter">
                            <button type="submit" class="btn delicious-btn w-100">Subscribe</button>
                        </form>
                        <p>Fusce nec ante vitae lacus aliquet vulputate. Donec sceleri sque accumsan molestie.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Contact Information Area End ##### -->
@endsection
