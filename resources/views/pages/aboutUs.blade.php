<title>Strivre</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">

<!-- Start Include All CSS -->
<link rel="stylesheet" href="../assets/css/bootstrap.css" />
<link rel="stylesheet" href="../assets/css/font-awesome.min.css" />
<link rel="stylesheet" href="../assets/css/elegant-icons.css" />
<link rel="stylesheet" href="../assets/css/themify-icons.css" />
<link rel="stylesheet" href="../assets/css/animate.css" />
<link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
<link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
<link rel="stylesheet" href="../assets/css/slick.css">
<link rel="stylesheet" href="../assets/css/nice-select.css">
<link rel="stylesheet" href="../assets/css/swiper-bundle.min.css">
<link rel="stylesheet" href="../assets/css/lightcase.css">
<link rel="stylesheet" href="../assets/css/preset.css" />
<link rel="stylesheet" href="../assets/css/theme.css" />
<link rel="stylesheet" href="../assets/css/responsive.css" />
<!-- End Include All CSS -->

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<!-- Favicon Icon -->
<link rel="icon" type="image/png" href="../assets/images/favicon.png">
<!-- Favicon Icon -->
@extends('layouts.master_new')
@section('content')



<section class="cta-section" style="background-image: url(../assets/images/home/cta-bg.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="sec-title title-padding font-text-size-36px"> Get unlimited consultation across industries. </h2>
                <!-- <p>
                        So I said codswallop car boot cheers mufty I don't want no agro are you taking the<br> piss cheeky my lady gutted mate excuse my french.
                    </p> -->
                <a href="{{url('/register') }}" class="bisylms-btn">
                    Get Started </a>
            </div>
        </div>
    </div>
</section>
<div class="video-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="video-banner" style="background-image: url(../assets/images/home/video-bg.jpg);">
                    <a class="popup-video" href="#" data-rel="lightcase"><i class="fas fa-play fass"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="funfact-section">
    <div class="container">
        <center>
            <div class="row">
                <div class="col-md-12">
                    <h2 class="sec-title font-text-size-34px">Our Global Community</h2>
                    <p class="sec-desc font-text-size-16px">
                        GET YOUR DREAM COURSE WITH BEST INSTRUCTOR
                    </p>
                </div>
            </div>
        </center>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="funfact-item-3">
                    <img src="assets/images/home3/f3.png" alt="">
                    <h2><span data-counter="27" class="timer">27</span></h2>
                    <p class="font-text-size-16px">Million Learners</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="funfact-item-3 ml-15">
                    <img src="../assets/images/home3/f4.png" alt="">
                    <h2><span data-counter="4" class="timer">4</span>.6</h2>
                    <p class="font-text-size-16px">Million Graduates</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="funfact-item-3 ml-40">
                    <img src="../assets/images/home3/f5.png" alt="">
                    <h2><span data-counter="1400" class="timer">1<span>,</span>400</span>+</h2>
                    <p class="font-text-size-16px">Online Courses</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="funfact-item-3 righ-align">
                    <img src="assets/images/home3/f7.png" alt="">
                    <h2><span data-counter="175" class="timer">175</span></h2>
                    <p class="font-text-size-16px">Countries</p>
                </div>
            </div>
        </div>
    </div>

</section>
<section class="funfact-section-blue">
    <div class="container">
        <p class="global_page_white font-text-size-20px"> “ Strivre is great for teams because it’s easy to get set up and the oferings touch on a<br>
            vast array of soft skill focus areas, which not only build role-related talents but also<br>
            enable team members to grow their whole selves beyond work.”</p>

    </div>
</section>
</div>


@includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.footer1', 'layouts.inc.footer1'])
<!-- Back To Top -->
<a href="#" id="back-to-top">
    <i class="fal fa-angle-double-up"></i>
</a>
<!-- Back To Top -->

<!-- Start Include All JS -->
<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/jquery.appear.js"></script>
<script src="../assets/js/owl.carousel.min.js"></script>
<script src="../assets/js/slick.js"></script>
<script src="../assets/js/jquery.nice-select.min.js"></script>
<script src="../assets/js/swiper-bundle.min.js"></script>
<script src="../assets/js/TweenMax.min.js"></script>
<script src="../assets/js/lightcase.js"></script>
<script src="../assets/js/jquery.plugin.min.js"></script>
<script src="../assets/js/jquery.countdown.min.js"></script>
<script src="../assets/js/jquery.easing.1.3.js"></script>
<script src="../assets/js/jquery.shuffle.min.js"></script>

<script src="../assets/js/theme.js"></script>
<style>
    .fass {
    
    line-height: 6!important;
}
</style>
<!-- End Include All JS -->

@endsection

@section('after_styles')

@if (config('lang.direction') == 'rtl')
<!-- <link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet"> -->
@endif



@endsection

@section('after_scripts')