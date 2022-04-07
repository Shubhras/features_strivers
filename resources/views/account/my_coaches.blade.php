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

<section class="page-banner01" style="background-image: url(../assets/images/home/cta-bg.jpg);">

</section>
@extends('layouts.master_new')
@section('content')
@includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'])

<section style="background-color: white;">
    <div class="main-container">
        <div class="container">

            <?php if ($user->user_type_id == 2) {

            ?>

 <h2>

<h2 class="sec-title">My Strivre</h2>
</h2>

	<div class="row" style="padding: 6px; margin-left: -4px;">
			
			
        <div class="col-md-12 user-profile-img-data default-inner-box">

                <img id="userImg" class="user-profile-images" src="{{ url('storage/'.$user->photo_url) }}" alt="user" width="50px;" height="50px;" border-radius=" 50%"> &nbsp; 
                <span style="font-size: 24px; font-weight: 700; color: #2c234d;">   <b> {{ $user->name }} </b> </span>
            

            <div class="row">
               
                <div class="col-md-12 col-sm-8 col-12">
                <span>

                
                    <div class="header-data text-center-xs">
                        {{-- Threads Stats --}}
                        <div class="hdata">
                        <a href="{{ url('account/messages') }}">

                            <div class="mcol-left">
                                <i class="fas fa-phone-alt ln-shadow"></i>
                            </div>
                            <div class="mcol-right">
                                {{-- Number of messages --}}
                                <p>
                                    
                                        {{ isset($countThreads) ? \App\Helpers\Number::short($countThreads) : 0 }}
                                       
                                        <em>{{ trans_choice('Call', getPlural($countThreads), [], config('app.locale')) }}</em>
                                   
                                </p>
                            </div>
                            </a>
                            <div class="clearfix"></div>
                        </div>

                        {{-- Traffic Stats --}}
                        <div class="hdata">
                        <a href="{{ url('account/chat') }}">
                            <div class="mcol-left">
                                <i class="fas fa-comments ln-shadow"></i>
                            </div>
                            <div class="mcol-right">
                                {{-- Number of visitors --}}
                                <p>
                                    
                                        <?php $totalPostsVisits = (isset($countPostsVisits) and $countPostsVisits->total_visits) ? $countPostsVisits->total_visits : 0 ?>
                                        {{ \App\Helpers\Number::short($totalPostsVisits) }}
                            
                                        <em>{{ trans_choice('Chat', getPlural($totalPostsVisits), [], config('app.locale')) }}</em>
                                   
                                </p>
                            </div>

                            </a>
                            <div class="clearfix"></div>
                        </div>

                       

                        {{-- Favorites Stats --}}
                        <div class="hdata" style="width: 151px!important;margin-left: -38px;">
                        <a href="{{ url('account/favourite') }}">
                            <div class="mcol-left" >
                                <i class="fas fa-bell ln-shadow" style="margin-left: 29px"></i>
                            </div>
                            <div class="mcol-right">
                                {{-- Number of favorites --}}
                                <p>
                                    
                                        {{ \App\Helpers\Number::short($countFavoritePosts) }}
                                        <em>{{ trans_choice('Notification', getPlural($countFavoritePosts), [], config('app.locale')) }} </em>
                                   
                                </p>
                            </div>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            
            </div>

          </div>
    </div>
                


                <div class="row">

                    <div class="col-md-3 page-sidebar ptop">
                        @includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar_coach', 'account.inc.sidebar_coach'])
                    </div>


                    <div class="col-md-9 page-content ptop">


                        <div class="row">

                            <?php foreach ($my_striver as $coach_list) { ?>


                                <div class="col-lg-4 col-md-6">
                                    <div class="teacher-item">
                                        <div class="teacher-thumb coach-img-wrapper">

                                            <img src="{{ url('storage/'.$coach_list->photo) }}" class="lazyload img-fluid" alt="{{ $coach_list->name }}">

                                            <!-- <img src="https://wp.quomodosoft.com/bisy/wp-content/uploads/2020/11/teacher_5.png" alt="Hugh Saturation"> -->

                                            <div class="madels">
                                                <img src="../assets/images/basic-1.svg" alt="Standard">

                                                <!-- <img src="{{ imgUrl($coach_list->photo, '') }}" class="lazyload img-fluid"  alt="{{ $coach_list->name }}">  -->


                                            </div>
                                            <!-- <div class="teacher-social">
                                                <a href="#">
                                                    <i aria-hidden="true" class="fab fa-facebook-f"></i>
                                                </a>
                                                <a href="#">
                                                    <i aria-hidden="true" class="fab fa-twitter"></i>
                                                </a>
                                                <a href="#">
                                                    <i aria-hidden="true" class="fab fa-pinterest-p"></i>
                                                </a>
                                                <a href="#">
                                                    <i aria-hidden="true" class="fab fa-vimeo-v"></i>
                                                </a>
                                            </div> -->
                                        </div>
                                        <div class="teacher-meta">
                                            <p class="top-coaches-name-list coach-cat-name12">
                                                <!-- Hugh Saturation -->
                                                {{ $coach_list->name }}

                            </p>
                                            <p class="lh">Photographer
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>



                        </div>
                        <!-- </div> -->


                    </div>
                    <!--/.page-content-->
                </div>



            <?php } else { ?>



                <!-- <div class="row ">
                    <div class="col-md-3 page-sidebar">
                        <div class="inner-box default-inner-box">
                            <h3 class="no-padding text-center-480 useradmin">
                                <a href="">
                                    <img id="userImg" class="userImg user_profile_img" src="{{ $user->photo_url }}" alt="user"> &nbsp;
                                    {{ $user->name }}
                                </a>
                            </h3>
                        </div>
                    </div>

                    <div class="col-md-9 page-content ">


                        <div class="inner-box default-inner-box edit-file-chat">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-12">
                                    <h3 class="no-padding text-center-480 useradmin">

                                        <b> My Coach </b>
                                    </h3>
                                </div>
                                <div class="col-md-8 col-sm-8 col-12">
                                    <div class="header-data text-center-xs">
                                        {{-- Threads Stats --}}
                                        <div class="hdata">
                                            <a href="{{ url('account/messages') }}">

                                                <div class="mcol-left">
                                                    <i class="fas fa-phone-alt ln-shadow"></i>
                                                </div>
                                                <div class="mcol-right">
                                                    {{-- Number of messages --}}
                                                    <p>

                                                        {{ isset($countThreads) ? \App\Helpers\Number::short($countThreads) : 0 }}

                                                        <em>{{ trans_choice('Call', getPlural($countThreads), [], config('app.locale')) }}</em>

                                                    </p>
                                                </div>
                                            </a>
                                            <div class="clearfix"></div>
                                        </div>

                                        {{-- Traffic Stats --}}
                                        <div class="hdata">
                                            <a href="{{ url('account/chat') }}">
                                                <div class="mcol-left">
                                                    <i class="fas fa-comments ln-shadow"></i>
                                                </div>
                                                <div class="mcol-right">
                                                    {{-- Number of visitors --}}
                                                    <p>

                                                        <?php $totalPostsVisits = (isset($countPostsVisits) and $countPostsVisits->total_visits) ? $countPostsVisits->total_visits : 0 ?>
                                                        {{ \App\Helpers\Number::short($totalPostsVisits) }}

                                                        <em>{{ trans_choice('Chat', getPlural($totalPostsVisits), [], config('app.locale')) }}</em>

                                                    </p>
                                                </div>

                                            </a>
                                            <div class="clearfix"></div>
                                        </div>



                                        {{-- Favorites Stats --}}
                                        <div class="hdata" style="width: 151px!important;margin-left: -38px;">
                                            <a href="{{ url('account/favourite') }}">
                                                <div class="mcol-left">
                                                    <i class="fas fa-bell ln-shadow" style="margin-left: 29px"></i>
                                                </div>
                                                <div class="mcol-right">
                                                    {{-- Number of favorites --}}
                                                    <p>

                                                        {{ \App\Helpers\Number::short($countFavoritePosts) }}
                                                        <em>{{ trans_choice('Notification', getPlural($countFavoritePosts), [], config('app.locale')) }} </em>

                                                    </p>
                                                </div>
                                            </a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div> -->

                <h2>

<h2 class="sec-title">My Coach</h2>
</h2>



                <div class="row" style="padding: 6px; margin-left: -4px;">
			
			
            <div class="col-md-12 user-profile-img-data default-inner-box">

                <img id="userImg" class="user-profile-images" src="{{ $user->photo_url }}" alt="user" width="50px;" height="50px;" border-radius=" 50%"> &nbsp; 
                <span style="font-size: 24px; font-weight: 700; color: #2c234d;">   <b> {{ $user->name }} </b> </span>
            

            <div class="row">
               
                <div class="col-md-12 col-sm-8 col-12">
                <span>

                
                    <div class="header-data text-center-xs">
                        {{-- Threads Stats --}}
                        <div class="hdata">
                        <a href="{{ url('account/messages') }}">

                            <div class="mcol-left">
                                <i class="fas fa-phone-alt ln-shadow"></i>
                            </div>
                            <div class="mcol-right">
                                {{-- Number of messages --}}
                                <p>
                                    
                                        {{ isset($countThreads) ? \App\Helpers\Number::short($countThreads) : 0 }}
                                       
                                        <em>{{ trans_choice('Call', getPlural($countThreads), [], config('app.locale')) }}</em>
                                   
                                </p>
                            </div>
                            </a>
                            <div class="clearfix"></div>
                        </div>

                        {{-- Traffic Stats --}}
                        <div class="hdata">
                        <a href="{{ url('account/chat') }}">
                            <div class="mcol-left">
                                <i class="fas fa-comments ln-shadow"></i>
                            </div>
                            <div class="mcol-right">
                                {{-- Number of visitors --}}
                                <p>
                                    
                                        <?php $totalPostsVisits = (isset($countPostsVisits) and $countPostsVisits->total_visits) ? $countPostsVisits->total_visits : 0 ?>
                                        {{ \App\Helpers\Number::short($totalPostsVisits) }}
                            
                                        <em>{{ trans_choice('Chat', getPlural($totalPostsVisits), [], config('app.locale')) }}</em>
                                   
                                </p>
                            </div>

                            </a>
                            <div class="clearfix"></div>
                        </div>

                       

                        {{-- Favorites Stats --}}
                        <div class="hdata" style="width: 151px!important;margin-left: -38px;">
                        <a href="{{ url('account/favourite') }}">
                            <div class="mcol-left" >
                                <i class="fas fa-bell ln-shadow" style="margin-left: 29px"></i>
                            </div>
                            <div class="mcol-right">
                                {{-- Number of favorites --}}
                                <p>
                                    
                                        {{ \App\Helpers\Number::short($countFavoritePosts) }}
                                        <em>{{ trans_choice('Notification', getPlural($countFavoritePosts), [], config('app.locale')) }} </em>
                                   
                                </p>
                            </div>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            
            </div>

          </div>
    </div>


                <div class="row">

                    <div class="col-md-3 page-sidebar ptop">
                        @includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar', 'account.inc.sidebar'])
                    </div>

                    <div class="col-md-9 page-content ptop">



                        <div class="row">

                            <?php foreach ($my_coaches as $coach_list) { ?>


                                <div class="col-lg-4 col-md-6">
                                    <div class="teacher-item">
                                        <div class="teacher-thumb coach-img-wrapper">

                                            <img src="{{ url('storage/'.$coach_list->photo) }}" class="lazyload img-fluid" alt="{{ $coach_list->name }}">

                                            <!-- <img src="https://wp.quomodosoft.com/bisy/wp-content/uploads/2020/11/teacher_5.png" alt="Hugh Saturation"> -->

                                            <div class="madels">
                                                <img src="../assets/images/basic-1.svg" alt="Standard">

                                                <!-- <img src="{{ imgUrl($coach_list->photo, '') }}" class="lazyload img-fluid"  alt="{{ $coach_list->name }}">  -->


                                            </div>
                                            <!-- <div class="teacher-social">
                                                <a href="#">
                                                    <i aria-hidden="true" class="fab fa-facebook-f"></i>
                                                </a>
                                                <a href="#">
                                                    <i aria-hidden="true" class="fab fa-twitter"></i>
                                                </a>
                                                <a href="#">
                                                    <i aria-hidden="true" class="fab fa-pinterest-p"></i>
                                                </a>
                                                <a href="#">
                                                    <i aria-hidden="true" class="fab fa-vimeo-v"></i>
                                                </a>
                                            </div> -->
                                        </div>
                                        <div class="teacher-meta">
                                            <p class="top-coaches-name-list coach-cat-name12">
                                                <!-- Hugh Saturation -->
                                                {{ $coach_list->name }}

                            </p>
                                            <p>Photographer
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>



                        </div>
                        <!-- </div> -->
                    </div>

                </div>
            <?php } ?>

            <!--/.row-->
        </div>
        <!--/.container-->
    </div>

    @includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.footer1', 'layouts.inc.footer1'])
    <!-- /.main-container -->


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

    @endsection

    @section('after_styles')
    <link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet">
    @if (config('lang.direction') == 'rtl')
    <link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet">
    @endif
    <style>
        .krajee-default.file-preview-frame:hover:not(.file-preview-error) {
            box-shadow: 0 0 5px 0 #666666;
        }

        .file-loading:before {
            content: " {{ t('Loading') }}...";
        }
    </style>
    <style>
        /* Avatar Upload */
        .photo-field {
            display: inline-block;
            vertical-align: middle;
        }

        .photo-field .krajee-default.file-preview-frame,
        .photo-field .krajee-default.file-preview-frame:hover {
            margin: 0;
            padding: 0;
            border: none;
            box-shadow: none;
            text-align: center;
        }

        .photo-field .file-input {
            display: table-cell;
            width: 150px;
        }

        .photo-field .krajee-default.file-preview-frame .kv-file-content {
            width: 150px;
            height: 160px;
        }

        .kv-reqd {
            color: red;
            font-family: monospace;
            font-weight: normal;
        }

        .file-preview {
            padding: 2px;
        }

        .file-drop-zone {
            margin: 2px;
            min-height: 100px;
        }

        .file-drop-zone .file-preview-thumbnails {
            cursor: pointer;
        }

        .krajee-default.file-preview-frame .file-thumbnail-footer {
            height: 30px;
        }

        /* Allow clickable uploaded photos (Not possible) */
        .file-drop-zone {
            padding: 20px;
        }

        .file-drop-zone .kv-file-content {
            padding: 0
        }

        .madels {
            width: 48px;
            height: 50px;
            border-radius: 50%;
            text-align: center;
            display: inline-block;
            position: absolute;
            right: 25px;
            top: 0;
            /* bottom: 337px; */
            margin: auto;
        }





        .teacher-thumb {
            position: relative;
            overflow: hidden;
            border-radius: 5px;
            -webkit-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
            /* background-image: linear-gradient(to right top, #E92AA4, #d95566, #a33e6d, #673065, #2c234d); */
        }



        .teacher-item {
            position: relative;
            text-align: center;
            margin: 0 0 51px;
            -webkit-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }

        .coach-img-wrapper img {
            filter: grayscale(100%) contrast(1) blur(var(--blur));
            mix-blend-mode: var(--bg-blend);
            object-fit: cover;
            opacity: var(--opacity);
            position: relative;
            width: 100%;
            height: 300px!important;
        }


        .teacher-thumb img,
        .teachers-slider.owl-carousel .teacher-thumb img {
            width: 100%;
            height: auto;
            -webkit-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }


        .teacher-item:hover .teacher-social {
            transform: scale(1);
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
        }


        .teacher-social {
            position: absolute;
            left: 0;
            bottom: 20px;
            z-index: 4;
            right: 0;
            margin: 0 auto;
            text-align: center;
            -webkit-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
            transform: scale(0);
            -webkit-transform: scale(0);
            -moz-transform: scale(0);
        }

        .teacher-social a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: transparent;
            border-radius: 50%;
            text-align: center;
            font-size: 14px;
            line-height: 43px;
            margin: 0 5px;
            color: #fff;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        .teacher-item:hover .teacher-thumb {
            -webkit-box-shadow: 0px 20px 30px 0px rgb(56 15 2 / 16%);
            -moz-box-shadow: 0px 20px 30px 0px rgba(56, 15, 2, 0.16);
            box-shadow: 0px 20px 30px 0px rgb(56 15 2 / 16%);
        }

        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .coach-img-wrapper img {
            filter: grayscale(100%) contrast(1) blur(var(--blur));
            mix-blend-mode: var(--bg-blend);
            object-fit: cover;
            opacity: var(--opacity);
            position: relative;
            width: 100%;
        }

        .coach-img-wrapper::before {
            background-color: var(--foreground);
            bottom: 0;
            content: '';
            height: 100%;
            left: 0;
            mix-blend-mode: var(--fg-blend);
            position: absolute;
            right: 0;
            top: 0;
            width: 100%;
            z-index: 1;
        }
    </style>
    @endsection