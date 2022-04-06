{{--
 * LaraClassifier - Classified Ads Web Application
 * Copyright (c) BeDigit. All Rights Reserved
 *
 * Website: https://laraclassifier.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from CodeCanyon,
 * Please read the full License from here - http://codecanyon.net/licenses/standard
--}}

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

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





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css" />

<!-- <section class="page-banner01" style="background-image: url(../assets/images/home/cta-bg.jpg);"> -->
    @extends('layouts.master_new')
    @section('content')


    <section class="page-banner01" style="background-image: url(../assets/images/home/cta-bg.jpg);">
    </section>


    <?php


	?>
    <center>
        <h2  class="sec-title " style="text-align: center; margin-top: 61px;">Consultation Detail</h2>
    </center>
    <section class="blog-section64">


        <div class="container ">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-center">{{$coach_course->course_name}}</h2> <br>

                </div>
            </div>
            <div class="row">
            <div class="col-lg-6">
                <div class="col-lg-8 imgb">
                    <center> <img src="{{ url('storage/'.$coach_course->photo) }}"
                            class="lazyload img-fluid images_height" ></center>

                </div>
</div>
                <div class="col-lg-6 box">
                    <div class="row">

                        <div class="line_bottom">
                            <p> Total Consultation: {{$coach_course->total_consultation_fee}} / $ Fees
                            </p>
                            <p> Consultation_fee_per_hour: {{$coach_course->consultation_fee_per_hour}}
                            </p>
                            <p> Creadit_required: {{$coach_course->creadit_required}}
                            </p>
                            <p> Dated: {{$coach_course->dated}}
                            </p>
                            <p> Coach Name: {{$coach_course->name}}
                            </p>
                           
                        </div>

                    </div>
                    <div class="row" style="margin-left: -33px;">
                
                    <h3 style="font-weight: 700; color: #fff;">Discription:</h3>
                    <?php
					$descriptions = strip_tags($coach_course->description)

					 ?>
                    <p style="font-size: 16px; font-family: 'Montserrat', sans-serif; "> {{$descriptions}}
                    </p>
</div>
                
            </div>

        </div>

        <br><br>
        <!-- </section>     -->


        <div class="container">



            <!-- <div class="row">
                <div class="col-lg-12">
                    <h2 style="font-weight: 700;  margin: 0px 191px 15px;">Discription:</h2>
                    <?php
					$descriptions = strip_tags($coach_course->description)

					 ?>
                    <p style="font-size: 16px; text-align:center; font-family: 'Montserrat', sans-serif; margin: 0px 191px 15px;"> {{$descriptions}}
                    </p>
                </div>
            </div> -->

        </div>
    </section>


    @includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.footer', 'layouts.inc.footer'])

    <a href="#" id="back-to-top">
        <i class="fal fa-angle-double-up"></i>
    </a>
    <!-- Back To Top -->

    <!-- Start Include All JS -->
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
    <!-- End Include All JS -->
    <style>
    .line_bottom {
        font-size: 16px !important;
        outline: 20px;
        float: left;
        font-weight: 600;
        letter-spacing: 0;
        margin: 1px -20px 9px;
        line-height: 1.8;
        flex: 0 0 50%;
    }

    h2 {

        font-weight: 700px;
    }
	.img-fluid{
			height: 341px;
			 width: 672px;

	}
	/* @media screen and (min-width: 1024px) {
		.line_bottom {
		font-size: 23px !important;
		outline: 20px;
		float: left;
		font-weight: 700;
		letter-spacing: 0;
		margin: 1px 9px 9px;
		line-height: 1.2;
		flex: 0 0 50%;
    	}
		.images_height{
			height: 414px;
			 width: 900px;

		 }
            
    } */

	   
    </style>
    <style>
    .scroll-top-footer {
        line-height: 2 !important;
    }
    </style>

    @endsection

    @section('after_styles')

    @if (config('lang.direction') == 'rtl')
    <!-- <link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet"> -->
    @endif



    @endsection

    @section('after_scripts')