<title>Strivre - Your Course To Success</title>

<!-- <link rel="icon" type="image/png" href="../assets/images/favicon.png"> -->
<!-- Favicon Icon -->

@extends('layouts.master')
@section('content')
<!-- @includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer']) -->
<section class="hero-banner-1 main" style="background-image: url(../assets/images/home/banner.png); ">

    <div class="shape-wrap">
        <div class="b-shape-1">
            <img src="../assets/images/home/shape-1.png" alt="">
        </div>
        <div class="b-shape-2">
            <img src="../assets/images/home/shape-2.png" alt="">
        </div>
        <div class="b-shape-3">
            <img src="../assets/images/home/shape-3.png" alt="">
        </div>
        <div class="b-shape-4">
            <img src="../assets/images/home/shape-4.png" alt="">
        </div>
    </div>
</section>

<div class="container hero-menu-login-u32 index-image-768">

    <div class="row">


        <div class="col-lg-5 col-md-5 title-box-fix">
            <div class="hero-content">

                <p class="text_font_size_index232">Your Course To Success</p>

                <form action="{{ \App\Helpers\UrlGen::search() }}" method="GET" class="row mt-5 box_filter2 search-box_filter2">

                    <div class="input-group">


                        <div class="location-search-coach-text col-md-11 search-box-text">
                            <input type="search" id="form1" class="form-control search_box_filterss search-box-for-main search-box-font" placeholder=" Search for Coach, Industry, Location and more..." title="{{ t('Enter a city name OR a state name with the prefix', ['prefix' => t('area')]) . t('State Name') }}" />


                        </div>

                        <button type="submit" class="btn btn87 btn-primary btn_class search-button-icon-width">
                           

                            <i class="fas fa-search" alt="{{ ('find') }}"></i>
                          
                        </button>
                    </div>

                </form>
                <br>
                <a href="{{'/register'}}" class="bisylms-btn">Ready to Get Started?</a>
            </div>
        </div>

        <div class="col-lg-7 col-md-7">
            <div class="banner-thumb">
                <img src="../assets/images/home/layer.png" alt="">
            </div>
        </div>
    </div>


</div>
<br><br><br><br><br>

<!-- Banner End -->

<div class="main-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="course-sidebar1 navbar-expand-md navbar-light  dashboard-nav mb-3 mb-lg-0 ">
                    <!--<nav class="navbar navbar-expand-md navbar-light  dashboard-nav mb-3 mb-lg-0 ">

                        <aside class="widget ttr "> -->
                    <!-- <aside class="widget ttr ">  -->
                    <div class="top-coach-widget">


                        <h5 class="mb-1 tm">FIND INTERESTING</h5>
                        <?php
                        // print_r($categories_list_coach1);die;
                        foreach ($categories_list_coach1 as $key => $value) {
                            // print_r(url('storage/'.$value->picture));die;
                            
                        ?>
                            <div class="latest-course1 ppt">
                                <!-- <a href="single-course.html"><img src="../assets/images/home/desktop1-image.png" alt=""></a> -->
                                <?php if(!empty($value->picture)){?>

                                <a href="{{url('/coach_list/'.$value->id) }}" id="sub_id_<?= $value->id ?>" value="<?= $value->id ?>">

                                <img src="{{ url('storage/'.$value->picture) }}" ></a>
                                    <?php }else{?>
                                        <a href="{{url('/coach_list/'.$value->id) }}" id="sub_id_<?= $value->id ?>" value="<?= $value->id ?>"><img src="../assets/images/home/desktop1-image.png" alt=""></a>
                                <?php
                                    }
                                $name = json_decode($value->name);
                                $ss = array();
                                foreach ($name as $key => $sub) {
                                    $ss[$key] = $sub;
                                }

                                ?>


                                <label class="f-17">
                                    <a href="{{url('/coach_list/'.$value->id) }}" id="sub_id_<?= $value->id ?>" value="<?= $value->id ?>">
                                        {{$ss['en']}}
                                    </a>
                                </label>



                            </div>
                        <?php } ?>
                        <!-- </aside> -->
                        <!-- </aside>
                    </nav> -->
                    </div>
                </div>
                <br>
                <div class="course-sidebar1 navbar-expand-md navbar-light  dashboard-nav mb-3 mb-lg-0 ">
                    <div class="top-coach-widget">
                        <!-- <div class="course-sidebar1 "> -->
                        <!-- <nav class="navbar navbar-expand-md navbar-light  dashboard-nav mb-3 mb-lg-0 ">
                        <aside class="widget h-75 d-inline-block">
                            <aside class="widget ttr "> -->

                        <h5 class="mb-1 tm">LATEST NEWS</h5>

                        @foreach($letest_news as $news)
                        <div class="latest-course10 ppt">

                            <?php
                            $title = json_decode($news->title);
                            $ss = array();
                            foreach ($title as $key => $sub) {
                                $ss[$key] = $sub;
                            }


                            ?>

                            @if(!empty($news->picture))

                            <div class="strivre-img-wrapper">


                                <img src="{{ url('storage/'.$news->picture) }}" alt="{{ $news->name }}">

                                <label class="f-17 sort_name">
                                    <a href="{{url('/letest_news/'.$news->slug) }}" target="_blank">
                                        {{$ss['en']}}
                                    </a>
                                </label>

                            </div>
                            @endif
                            @if(empty($news->picture))

                            <div class="strivre-img-wrapper">
                                <img src="../assets/images/course/1.jpg" alt="">
                                <label class="f-17 sort_name">
                                    <a href="{{url('/letest_news/'.$news->slug) }}" target="_blank">
                                        {{$ss['en']}}
                                    </a>
                                </label>


                            </div>
                            @endif
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-8">
                <h2 class="sec-title">
                    TOP COACHES
                </h2>

                <div class="row">

                    @if (isset($categories) and $categories->count() > 0)


                    @foreach($user as $key => $coach)

                    <div class="col-lg-4 col-md-6">
                        <div class="teacher-item">
                            <div class="teacher-thumb coach-img-wrapper coach-img-fix-height">
                                <!-- <a href="{{url('/coach_details/'.$coach->id) }}"> -->
                                <?php if (!empty($coach->photo)) { ?>
                                    <img src="{{ url('storage/'.$coach->photo) }}" alt="{{ $coach->name }}" class="lazyload img-fluid">

                                <?php } else { ?>

                                    <img src="../assets/images/course/1.jpg" alt="{{ $coach->name }}" class="lazyload img-fluid">
                                <?php } ?>
                            </div>
                            <div class="teacher-meta">
                                <a type="button" href="{{url('/coachall_detail/'.$coach->id) }}" data-toggle="modal" data-target=".bd-example-modal-lg_{{$coach->id }}" id="coach_id_{{$coach->id }}">
                                    <p class="top-coaches-name-list coach-cat-name12">{{$coach->name}} </p>

                                </a>
                                <p>Photographer
                                </p>
                                <!-- <img src="../assets/images/course/1.jpg" alt=""> -->

                                <span class="top-coaches-name-list1"> <?php if ($coach->year_of_experience != '') { ?>
                                        {{ $coach->year_of_experience }} years Experience
                                    <?php
                                                                        } else { ?>
                                        No Experience

                                    <?php } ?>
                                </span>


                                <div class="modal fade bd-example-modal-lg_{{$coach->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="coach_id_{{$coach->id }}">
                                    <div class="modal-dialog modal-xl">

                                        <div class="modal-header">
                                            <h4 class="modal-title">Top Coach Details</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-content p-5">


                                            <img src="{{ url('storage/'.$coach->photo) }}" class="img-coches-main" alt="{{ $coach->name }}">
                                            <p class="coach-details-name">{{$coach->name}}</p>
                                            <h4 class=" text-center">
                                                Teaches Adventure Photography
                                            </h4>
                                            <p class="text-center"><b>
                                                    National Geographic photographer teaches his techniques for planning, capturing, and editing breathtaking photos.</b>
                                            </p> <br>
                                            <label>{{$coach->name}} has built his career taking photos at the top of the world, earning him the cover of National Geographic and multiple awards. Now he’s taking you on location to teach you techniques for capturing
                                                breathtaking shots. In his photography class, learn different creative approaches for commercial shoots, editorial spreads, and passion projects. Gather the gear—and the perspective—to bring your
                                                photography to new heights.</label>
                                            <br>
                                            <div class="row center-button-modal">

                                                <div class="col-lg-2">
                                                    <a href="{{url('/coachall_detail/'.$coach->id) }}" class="bisylms-btn" style="color: aliceblue!important;">Know more</a>
                                                </div>
                                                <div class="col-lg-2">
                                                    <a href="{{url('/register') }}" class="bisylms-btn" style="color: aliceblue!important;">Get Started</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- </div> -->
                            </div>

                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>

            </div>



            <div class="col-lg-3 col-md-4 newmt123 letest-offering-home">

                <div class="course-sidebar1 navbar-expand-md navbar-light  dashboard-nav mb-3 mb-lg-0 ">
                    <div class="top-coach-widget">

                        <!-- <div class="course-sidebar1">
                    <nav class="navbar navbar-expand-md navbar-light  dashboard-nav mb-3 mb-lg-0 ">
                        <aside class="widget ppt"> -->
                        <h5 class="mb-1 tm">LATEST OFFERING</h5>
                        <?php
                        foreach ($user_course as $key => $value) {
                            # code...

                        ?>
                            <div class="latest-course">

                                <div class="strivre-img-wrapper">

                                    <a href="single-course.html"><img src="../assets/images/course/1.jpg" alt=""></a>

                                </div>
                                <label class="f-17 sort_name">{{$value->course_name}}</label>
                                <div class="course-price">
                                    {{$value->course_hourse}} Hourse
                                </div>
                            </div>
                        <?php } ?>

                        <!-- </aside>
                    </nav> -->
                    </div>
                </div>
                <br>
                <div class="course-sidebar1">
                    <nav class="navbar navbar-expand-md navbar-light  dashboard-nav mb-3 mb-lg-0 ">
                        <aside class="widget h-75 d-inline-block">
                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="../assets/images/home/2.png" src="..." alt="">
                                        <P>440 Strivres are
                                            making career</P>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../assets/images/home/11.png" src="..." alt="">
                                        <P>440 Strivres are
                                            making career</P>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../assets/images/home/12.png" src="..." alt="">
                                        <P>440 Strivres are
                                            making career</P>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </nav>

                </div>

            </div>
        </div>

        <center>
            <button type="button" class="bisylms-btn" data-toggle="modal" data-target=".bd-example-modal-lg">Explore Your
                Interest </button>
        </center>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-contents">

            <div class="modal-header">
                <h5 class="modal-title">What topics do you find interesting?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>



            <div class="row p-5 text-center">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="course-wrapper">
                            <div class="course-item-01 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="50" height="50" viewBox="0 0 74 60">
                                    <defs>
                                        <style>
                                            .cls-1 {
                                                fill: url(#pattern);
                                            }
                                        </style>
                                        <pattern id="pattern" preserveAspectRatio="xMidYMid slice" width="100%" height="100%" viewBox="0 0 74 60">
                                            <image width="74" height="60" xlink:href="../assets/images/home/desktop1-image.png" />
                                        </pattern>
                                    </defs>
                                    <path id="desktop1" class="cls-1" d="M0,0H74V60H0Z" />
                                </svg>
                                <h4><a href="#">Computer Science</a></h4>
                                <input type="checkbox" style="width: 22px;">
                            </div>
                            <div class="course-item-01 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="50" height="50" viewBox="0 0 64 64">
                                    <image id="data" width="64" height="64" xlink:href="../assets/images/home/data-image.png" />
                                </svg>
                                <h4><a href="#">Data Analysis & Statistics</a></h4>
                                <input type="checkbox" style="width: 22px;">
                            </div>
                            <div class="course-item-01 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="50" height="50" viewBox="0 0 74 70">
                                    <image id="proposal" width="74" height="70" xlink:href="../assets/images/home/proposal-image.png" />
                                </svg>
                                <h4><a href="#">Business & Management</a></h4>
                                <input type="checkbox" style="width: 22px;">
                            </div>
                            <div class="course-item-01 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="50" height="50" viewBox="0 0 80 67">
                                    <image id="chat" width="80" height="67" xlink:href="../assets/images/home/chat-image.png" />
                                </svg>
                                <h4><a href="#">Social Sciences</a></h4>
                                <input type="checkbox" style="width: 22px;">
                            </div>
                            <div class="course-item-01 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="50" height="50" viewBox="0 0 58 73">
                                    <image id="mind" width="50" height="50" xlink:href="../assets/images/home/mind-image.png" />
                                </svg>
                                <h4><a href="#">Biology & Life Sciences</a></h4>
                                <input type="checkbox" style="width: 22px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="course-wrapper">
                            <div class="course-item-01 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="50" height="50" viewBox="0 0 74 60">
                                    <defs>
                                        <style>
                                            .cls-1 {
                                                fill: url(#pattern);
                                            }
                                        </style>
                                        <pattern id="pattern" preserveAspectRatio="xMidYMid slice" width="100%" height="100%" viewBox="0 0 74 60">
                                            <image width="74" height="60" xlink:href="../assets/images/home/desktop1-image.png" />
                                        </pattern>
                                    </defs>
                                    <path id="desktop1" class="cls-1" d="M0,0H74V60H0Z" />
                                </svg>
                                <h4><a href="">Al & Machine Learning
                                    </a></h4>
                                <input type="checkbox" style="width: 22px;">
                            </div>
                            <div class="course-item-01 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="50" height="50" viewBox="0 0 64 64">
                                    <image id="data" width="64" height="64" xlink:href="../assets/images/home/data-image.png" />
                                </svg>
                                <h4><a href="">Project Management
                                    </a></h4>
                                <input type="checkbox" style="width: 22px;">
                            </div>
                            <div class="course-item-01 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="50" height="50" viewBox="0 0 74 70">
                                    <image id="proposal" width="74" height="70" xlink:href="../assets/images/home/proposal-image.png" />
                                </svg>
                                <h4><a href="">Cyber Courses
                                    </a></h4>
                                <input type="checkbox" style="width: 22px;">
                            </div>
                            <div class="course-item-01 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="50" height="50" viewBox="0 0 80 67">
                                    <image id="chat" width="80" height="67" xlink:href="../assets/images/home/chat-image.png" />
                                </svg>
                                <h4><a href="">Cloud Computing
                                    </a></h4>
                                <input type="checkbox" style="width: 22px;">
                            </div>
                            <div class="course-item-01 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="50" height="50" viewBox="0 0 58 73">
                                    <image id="mind" width="50" height="50" xlink:href="../assets/images/home/mind-image.png" />
                                </svg>
                                <h4><a href="">DevOps</a></h4>
                                <input type="checkbox" style="width: 22px;">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12">
                    <button type="button" class="bisylms-btn" data-toggle="modal" data-target=".bd-example-modal-lg">
                        Submit Your Interest
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="main-section-new">
    <div class="container">

        <div class="mt-120">
            <center>
                <h2 class="fwhite home-banner-page-text">GET YOUR DREAM COURSE WITH BEST INSTRUCTOR
                </h2>
            </center>
            <div class="row">
                <div class="col-lg-5 col-md-6">


                    <div class="ab-content">
                        <h3 class="fwhite">CONNECT WITH COACHES/ STRIVRES AROUND THE WORLD</h3>
                        <p style="color: #ffffff;">Strivre is great for teams because its easy to get set up and the offerings touch on a vast array of soft skill focus areas, which not only build role-related talents but also enable team members to grow their whole selves beyond
                            work.
                        </p>
                        <a class="bisylms-btn-pink" href="{{url('/register') }}">Sign Up </a>
                    </div>
                </div>
                <div class=" col-lg-7 col-md-6">

                    <div class="">
                        <img src="assets/images/edu_2.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="main-section">
    <div class="container">

        <div class="row mt-120">
            <div class="col-lg-7 col-md-6">
                <div class="ab-thumb">
                    <img src="assets/images/edu_1.png" alt="">
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="ab-content">
                    <p class="text_font_size_index234">JOIN OUR LARGEST COACHING COMMUNITY.</p>
                    <p class="ab-content34">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque facilisis ex consectetur viverra vehicula. Nullam mauris ante, condimentum ac mi eu, bibendum mollis elit. Duis pretium velit lobortis felis fermentum pellentesque.
                        Aliquam euismod, elit vel bibendum vestibulum, nisl nisl mollis tortor, a rhoncus mi augue eleifend justo. Sed sed ullamcorper massa, at pretium tortor. Integer nunc tellus, elementum eu malesuada eu, pellentesque a tellus.
                    </p>
                    <a class="bisylms-btn" href="{{url('/register') }}">Get Started</a>
                </div>
            </div>
        </div>
    </div>
</section>

@includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.footer1', 'layouts.inc.footer1'])
<a href="#" id="back-to-top">
    <i class="fal fa-angle-double-up scroll-top-footer"></i>
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

<style>
    .scroll-top-footer {
        line-height: 2 !important;
    }
</style>

<style>
    aside.ttr {

        height: 350px;

        overflow: scroll;
    }

    aside.ppt {
        height: 350px;
        overflow: scroll;

    }

    /* h2 {
        font-size: 40px !important;
    }
    */

    /* h1 {
        color: #1D1D1F !important;
        margin: 20px 0 10px 0;
        font-style: normal;
        font-family: 'Montserrat', sans-serif;
        font-size: 49px!important;
        line-height: 55px!important;
    }  */

    /* ::-webkit-scrollbar {
        width: 4px;
    }

    ::-webkit-scrollbar-thumb {
        background: red;
        border-radius: 5px;
    } */
</style>

<style>
    .sort_name {
        display: inline-block;
        width: 120px;
        white-space: nowrap;
        overflow: hidden !important;
        text-overflow: ellipsis;
        font-weight: 500;
    }


    @media only screen and (max-width: 1440px) {
        .sort_name {
            display: inline-block;
            width: 106px;
            white-space: nowrap;
            overflow: hidden !important;
            text-overflow: ellipsis;
            font-weight: 500;
        }
    }


    @media only screen and (max-width: 1024px) {
        .sort_name {
            display: inline-block;
            width: 85px;
            white-space: nowrap;
            overflow: hidden !important;
            text-overflow: ellipsis;
            font-weight: 500;
        }
    }
</style>


@endsection

@section('after_styles')

@if (config('lang.direction') == 'rtl')
@endif



@endsection

@section('after_scripts')