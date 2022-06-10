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


<section class="page-banner01">
</section>


<?php


?>
<center>


               
    <h2 class="sec-title " style="text-align: center; margin-top: 61px; margin-bottom: 11px;">Consultation Detail</h2>
</center>
<section class="blog-section64">
    <div class="container ">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-center">{{$coach_course->course_name}}</h3> <br>

            </div>
        </div>


        <br>

        <div class="row">

        <div class="col-sm-12 form-group">
                  <!-- @if(Session::has('message'))
                  <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
                  @endif -->
                  @if(Session::has('loginerror'))
                  <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('loginerror') }} <a href="{{url('/pricing') }}" style="color: red;" target="_blank"><b> Click here to subscribe and get credits.</b></a></p>
                  @endif


              @if(Session::has('loginerrorenroll'))
                  <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('loginerrorenroll') }} <a href="{{url('/') }}" style="color: red;" target="_blank"><b> Back to home.</b></a></p>
                  @endif

                  
               </div>
                


            <div class="col-lg-6 pleft ">
                <div class="col-lg-12 imgb">
                    <center> <img src="{{ url('storage/'.$coach_course->image) }}" class="lazyload img-fluid1 images_height" style="width: 100%;"></center>

                </div>
            </div>


            <div class="col-lg-6  box ">
                <div class="row">

                    <div class="line_bottom">
                        <p> Total Consultation Fees:<span class="boxfont"> $ {{$coach_course->total_consultation_fee}} </span>
                        </p>
                        <!-- <p> Consultation Fees Per Hour:<span class="boxfont"> $ {{$coach_course->consultation_fee_per_hour}}</span> -->
                        </p>
                        <p> Credits Required:<span class="boxfont"> {{$coach_course->creadit_required}}</span>
                        </p>
                        <p> Date:<span class="boxfont"> {{$coach_course->dated}}</span>
                        </p>
                        <p> Coach:<span class="boxfont"> {{$coach_course->name}}</span>
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


        <br>


        <div class="row">

        
            
            <div class="col-lg-3 col-md-6">
                <form action="{{ url('/account/enroll_course') }}" method="post">
                    <input type="hidden" name="creadit_required" id="creadit_required" value="{{$coach_course->creadit_required}}">
                    <input type="hidden" name="user_id" id="user_id" value="{{$auth_id}}" class="form-control">
                    <input type="hidden" name="coach_id" id="coach_id" value="{{$coach_course->coach_id}}" class="form-control">
                    <input type="hidden" name="course_id" id="course_id" value="{{$coach_course->id}}" class="form-control">

                    <button type="submit" class="bisylms-btn " style="float:right;" onclick="customSession()">
                    Enroll Now
                    </button>
                </form>
            </div>

            <div class=" col-md-6 col-lg-3 enroll-course-strivre">


            <form action="{{ url('/pricingCourse') }}" method="post">
                    <!-- <input type="hidden" name="creadit_required" id="creadit_required" value="{{$coach_course->creadit_required}}">
                    <input type="hidden" name="user_id" id="user_id" value="{{$auth_id}}" class="form-control">
                    <input type="hidden" name="coach_id" id="coach_id" value="{{$coach_course->coach_id}}" class="form-control"> -->
                    <input type="hidden" name="course_id" id="course_id" value="{{$coach_course->id}}" class="form-control">

                    <button type="submit" class="bisylms-btn">
                    Buy Credits
                    </button>
                </form>



                <!-- <a href="{{url('/pricingCourse/'.$coach_course->id)}}" class="bisylms-btn">

                    Buy Credits
                </a> -->
                
            </div>
            <!-- <div class="col-md-4">

</div> -->
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

    <div class="main-section">
                    <div class="container">

                        <div class="row">

                            <h2 class="sec-title" style="font-weight: 700;">
                                Suggested Consultation

                            </h2>

                            <?php
                            foreach ($coach_striver as  $coaches_corsee) {
                            ?>
                                <div class="col-lg-3 col-md-6">
                                    <div class="feature-course-item-4">
                                        <div class="fcf-thumb">
                                            <img src="{{ url('storage/'.$coaches_corsee->image) }}" alt="" style="height: 244px;">
                                            <a class="enroll" href="{{url('../get_coach_course/'.$coaches_corsee->id)}}" onclick="customSession()">View Package</a>
                                        </div>
                                        <div class="fci-details">
                                            <a href="{{url('../get_coach_course/'.$coaches_corsee->id)}}" class="c-cate sort_name"><i class="fas fa-tags"></i>{{$coaches_corsee->course_name}}</a>
                                            <h4><a href="{{url('../get_coach_course/'.$coaches_corsee->id)}}">Using Creative Problem Solving</a></h4>
                                            <div class="author">
                                                <img src="{{ url('storage/'.$coaches_corsee->photo) }}" alt="">
                                                <a href="{{url('../get_coach_course/'.$coaches_corsee->id)}}">{{$coaches_corsee->name}}</a>
                                            </div>


                                            <div class="price-rate">
                                                <div class="course-price">

                                                    @if($coaches_corsee->total_consultation_fee != null)

                                                    <a>
                                                        <!-- {{$coaches_corsee->total_consultation_fee}}$ Credits -->

                                                        {{$coaches_corsee->creadit_required}}$ Credits
                                                    </a>
                                                    @else
                                                    0 $ Credits
                                                    @endif
                                                </div>

                                            </div>



                                        </div>
                                    </div>

                                </div>
                            <?php } ?>
                        </div>
                        <br>

                       
                    </div>
                </div>


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
        font-weight: 400;
        letter-spacing: 0;
        margin: 1px -20px 9px;
        line-height: 1.8;
        /* flex: 0 0 50%; */
    }

    h2 {

        font-weight: 700px;
    }

    .img-fluid1 {
        height: 454px;
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