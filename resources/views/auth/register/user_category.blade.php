<title>Strivre</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">

<!-- Start Include All CSS -->
<link rel="stylesheet" href="assets/css/bootstrap.css" />
<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
<link rel="stylesheet" href="assets/css/elegant-icons.css" />
<link rel="stylesheet" href="assets/css/themify-icons.css" />
<link rel="stylesheet" href="assets/css/animate.css" />
<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
<link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
<link rel="stylesheet" href="assets/css/slick.css">
<link rel="stylesheet" href="assets/css/nice-select.css">
<link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
<link rel="stylesheet" href="assets/css/lightcase.css">
<link rel="stylesheet" href="assets/css/preset.css" />
<link rel="stylesheet" href="assets/css/theme.css" />
<link rel="stylesheet" href="assets/css/responsive.css" />
<!-- End Include All CSS -->
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

<!-- Favicon Icon -->
<link rel="icon" type="image/png" href="assets/images/favicon.png">



<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.appear.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/slick.js"></script>
<script src="assets/js/jquery.nice-select.min.js"></script>
<script src="assets/js/swiper-bundle.min.js"></script>
<script src="assets/js/TweenMax.min.js"></script>
<script src="assets/js/lightcase.js"></script>
<script src="assets/js/jquery.plugin.min.js"></script>
<script src="assets/js/jquery.countdown.min.js"></script>
<script src="assets/js/jquery.easing.1.3.js"></script>
<script src="assets/js/jquery.shuffle.min.js"></script>

<script src="assets/js/theme.js"></script>
<!-- Favicon Icon -->
@extends('layouts.master_new')

@section('content')

<!-- Preloader Icon -->
<!-- <div class="preloader">
        <div class="loaderInner">
            <div id="top" class="mask">
                <div class="plane"></div>
            </div>
            <div id="middle" class="mask">
                <div class="plane"></div>
            </div>
            <div id="bottom" class="mask">
                <div class="plane"></div>
            </div>
            <p>LOADING...</p>
        </div>
    </div> -->
<!-- Preloader Icon -->

<!-- Header Start -->

<!-- Header End -->

<!-- Banner Start -->
<section class="page-banner01" style="background-image: url(assets/images/home/cta-bg.jpg);">
    <!-- <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="banner-title">Edit Profile</h2>
                    <div class="bread-crumbs">
                        <a href="index.html">Home</a> <span></span> Edit Profile
                    </div>
                </div>
            </div>
        </div> -->
</section>
<!-- Banner End -->

<!-- Course Section Start -->
<section class="contact-section ">



    <div class="col-md-8 d-flex justify-content-center">
        @if (isset($errors) && $errors->any())
        @foreach ($errors as $error)
        <li>{{ $error }}</li>
        @endforeach
        @endif
        <div class="contact-form dform" id="Strivers">



            <center>
                <h4></h4>
            </center><br>

            <form role="form" method="POST" action="{{ url('/updateUserCategory') }}" class="row">

                {!! csrf_field() !!}



                <div class="col-md-12">

                    <input id="user_id" name="user_id" type="hidden" class="form-control" value="{{$user_auth_id}}">
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="password">Please select category
                    </label>
                    <select name="category" id="category" class="form-control large-data-selecter">

                        @foreach ($categories as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->slug }}
                        </option>
                        @endforeach
                    </select>
                </div>


                <div class="col-md-12">

                    <center><button class="btn01  btn-primary1 register-btn-primary" type="submit" id="signupBtn">

                            Submit </button></center>

                </div>




                <div class="modal fade bd-example-modal-lgss" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="coach_id_{{$user_auth_id }}">
        <div class="modal-dialog modal-xl">

            <div class="modal-header">
                <h4 class="modal-title">Top Coach Details</h4>
                <button type="button" class="close" data-dismiss="modal_category">&times;</button>
            </div>

            <div class="modal-content p-5">


                
                
                <p class="text-center"><b>
                    </b>
                </p> <br>
                
                <br>
                <div class="row center-button-modal">

                    <div class="col-lg-2">
                      
                    </div>
                    <div class="col-lg-2">
                        <a href="{{url('/register') }}" class="bisylms-btn" style="color: aliceblue!important;">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
            </form>



        </div>
    </div>

    </div>


    



</section>
<!-- Course Section End -->

<!-- Footer Section Start -->

<!-- Footer Section End -->

<!-- Back To Top -->
<a href="#" id="back-to-top">
    <i class="fal fa-angle-double-up"></i>
</a>
<!-- Back To Top -->

<!-- Start Include All JS -->

<!-- End Include All JS -->

@includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.footer1', 'layouts.inc.footer1'])

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
<!-- End Include All JS -->

@endsection

@section('after_styles')

@if (config('lang.direction') == 'rtl')
<!-- <link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet"> -->
@endif



@endsection

@section('after_scripts')
@endsection

@section('after_styles')

@if (config('lang.direction') == 'rtl')
<!-- <link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet"> -->
@endif



@endsection

@section('after_scripts')