<title>Strivre - Your Course To Success</title>

<!-- <link rel="icon" type="image/png" href="../assets/images/favicon.png"> -->
<!-- Favicon Icon -->

@extends('layouts.master')
@section('content')
<!-- @includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer']) -->
<!-- <section class="hero-banner-1 main" style="background-image: url(../assets/images/home/banner.png); "> -->
    <?php if(empty($home_section_banner_text->picture)){?>

        <section class="hero-banner-1 main" style="background-image: url(../assets/images/home/banner.png); ">

<?php }{?>
    <section class="hero-banner-1 main" style="background-image: url(<?php echo'storage/'.$home_section_banner_text->picture ?>);">
   
    <?php }?>

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


        <div class="col-lg-8 col-md-6 title-box-fix">
            <div class="hero-content">

                <!-- <p class="text_font_size_index232">Your Course To <br>Success</p> -->


                <p class="text_font_size_index232 content_width">{!! $home_section_banner_text->home_page_section_banner_text !!}</p>
                <?php $id = '0'; ?>

                  <!-- <form action="{{ url('/coach_list_category_all/'.$id) }}" method="GET" class="row mt-5 box_filter2 search-box_filter2"> -->

                <form action="{{ url('/findtopcoach') }}" method="post" class="row mt-5 box_filter2 search-box_filter2">

                    <div class="input-group">

                        <div class="input-group">
                            <div class="row">

                                <div class="location-search-coach-text col-md-10 search-box-text">
                                    <input type="search" name="search" id="form1" class="form-control search_box_filterss search-box-for-main search-box-font" placeholder=" Search for Coach, Industry, Location and more" title="{{ t('Enter a city name OR a state name with the prefix', ['prefix' => t('area')]) . t('State Name') }}" />
                                </div>

                                <button type="submit" class="btn btn87 btn-primary btn_class search-button-icon-width btn_class_320">


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
                <!-- <img src="../assets/images/home/layer.png" alt=""> -->
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
$userd = array();

foreach($categories_list_coach187 as $userCatMulti){

    
    // $category_name = json_decode($userCatMulti->category);
    $conditions = $userCatMulti->category;
				$x = explode(",", $conditions);
				$catss =  json_encode($x);
				$category_name = json_decode($catss);

                        // foreach($category_name as $key => $val) {

                           
                            $keyss  = DB::table('categories')->select('categories.slug', 'categories.id', 'categories.name', 'categories.picture', 'categories.icon_class')->where('categories.parent_id', null)
                            ->where('categories.id', $category_name)->groupBy('categories.id')->orderBy('categories.slug', 'asc')->get();
                            // print_r($keyss);die;
        // $data['categories_list_coach4'] = $categories_list_coach23;
        
        foreach($keyss as $value){
            //
       
      
                        ?>
                            <div class="latest-course1 ppt">

                                <?php if (!empty($value->picture)) { ?>
                                    <a class="index-34" href="{{url('/coach_list_category_all/'.$value->id) }}" id="sub_id_<?= $value->id ?>" value="<?= $value->id ?>"><img src="{{ url('storage/'.$value->picture) }}"></a>
                                <?php } else { ?>
                                    <a class="index-34" href="{{url('/coach_list_category_all/'.$value->id) }}" id="sub_id_<?= $value->id ?>" value="<?= $value->id ?>"><img src="../assets/images/home/desktop1-image.png" alt=""></a>
                                <?php
                                }

                                
                                $name = json_decode($value->name);

                               
                                $ss = array();
                                foreach ($name as $key => $sub) {
                                    
                                    $ss[$key] = $sub;
                                }
                               
                                ?>


                                <label class="f-17 find-letest-news">
                                    <a class="index-34" href="{{url('/coach_list_category_all/'.$value->id) }}" id="sub_id_<?= $value->id ?>" value="<?= $value->id ?>">
                                        {{$ss['en']}}
                                    </a>
                                </label>



                            </div>
                        <?php 
                         

                        }
                    } ?>
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
                        <div class="latest-course ppt">

                            <?php
                            $title = json_decode($news->title);
                            $ss = array();
                            foreach ($title as $key => $sub) {
                                $ss[$key] = $sub;
                            }


                            ?>

                            @if(!empty($news->picture))

                            <div class="strivre-img-wrapper">

                                <a href="{{url('/latest_news/'.$news->slug) }}" target="_blank">
                                    <img src="{{ url('storage/'.$news->picture) }}" alt="{{ $news->name }}">
                                </a>

                                <label class="f-17 sort_name find-letest-news1">
                                    <a class="index-34" href="{{url('/latest_news/'.$news->slug) }}" target="_blank">{{$ss['en']}}
                                    </a>
                                </label>

                            </div>
                            @endif
                            @if(empty($news->picture))

                            <div class="strivre-img-wrapper">
                                <a href="{{url('/latest_news/'.$news->slug) }}" target="_blank">
                                    <img src="../assets/images/course/1.jpg" alt="">
                                </a>
                                <label class="f-17 sort_name find-letest-news1">
                                    <a class="index-34" href="{{url('/latest_news/'.$news->slug)}}" target="_blank">{{$ss['en']}}
                                    </a>
                                </label>


                            </div>
                            @endif
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-4">
                <h2 class="sec-title">
                    TOP COACHES
                </h2>

                <div class="row">

                    @if (isset($categories) and $categories->count() > 0)


                    @foreach($user as $key => $coach)

                    <div class="col-lg-4 col-md-6">

                        <!-- <a type="button" href="{{url('/top_coach_detail/'.$coach->id) }}" id="coach_id_{{$coach->id }}"> -->

                        <a type="button" href="{{url('/coachall_detail/'.$coach->id) }}" data-toggle="modal" data-target=".bd-example-modal-lg_{{$coach->id }}" id="coach_id_{{$coach->id }}">

                            <div class="teacher-item">
                                <div class="teacher-thumb coach-img-wrapper1 coach-img-fix-height">
                                    <!-- <a href="{{url('/coach_details/'.$coach->id) }}"> -->
                                    <?php if (!empty($coach->photo)) { ?>
                                        <img src="{{ url('storage/'.$coach->photo) }}" alt="{{ $coach->name }}" class="lazyload img-fluid">

                                    <?php } else { ?>

                                        <img src="../assets/images/course/1.jpg" alt="{{ $coach->name }}" class="lazyload img-fluid">
                                    <?php } ?>
                                </div>
                                <div class="teacher-meta">
                                    <a type="button" href="{{url('/coachall_detail/'.$coach->id) }}" data-toggle="modal" data-target=".bd-example-modal-lg_{{$coach->id }}" id="coach_id_{{$coach->id }}">
                                        <p class="top-coaches-name-list coach-cat-name12 ">{{$coach->name}} </p>

                                    </a>
                                    <?php
                                     $conditions = $coach->category;
                                     $x = explode(",", $conditions);
                                     $catss =  json_encode($x);
                                     $catUser = json_decode($catss);
                                    // $conditions = json_decode($coach->category);



                                    if (!empty($catUser)) {
                                        foreach ($catUser as $val) {
                                            $q1 = DB::table('categories')->select('categories.name as categories_slug')->where('categories.id', $val)->first();


                                            // print_r($q1);die;

                                            $name = json_decode($q1->categories_slug);
                                            $ss = array();
                                            foreach ($name as $key => $sub) {
                                                $ss[$key] = $sub;
                                            }


                                    ?>

                                            <p class="lh">{{$ss['en']}}
                                            </p>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <p class=" text-center">Others
                                        </p>
                                    <?php } ?>
                                    <!-- <img src="../assets/images/course/1.jpg" alt=""> -->

                                    <span class="top-coaches-name-list1 "> <?php if ($coach->year_of_experience != '') { ?>
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
                                                    {{$ss['en']}}
                                                </h4>
                                                <p class="text-center"><b>
                                                    </b>
                                                </p> <br>
                                                <label>{{$coach->coach_summary}}</label>
                                                <br>
                                                <div class="row center-button-modal">

                                                    <div class="col-lg-2">
                                                        <a href="{{url('/top_coach_detail/'.$coach->id) }}" class="bisylms-btn" style="color: aliceblue!important;">Know more</a>
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
                        </a>
                    </div>
                    @endforeach
                    @endif
                </div>

            </div>

            <!-- letest-offering-home -->

            <div class="col-lg-3 col-md-4 newmt123 ">

                <div class="course-sidebar1 navbar-expand-md navbar-light  dashboard-nav mb-3 mb-lg-0 ">
                    <div class="top-coach-widget letest-offering-data2">

                        <!-- <div class="course-sidebar1">
                    <nav class="navbar navbar-expand-md navbar-light  dashboard-nav mb-3 mb-lg-0 ">
                        <aside class="widget ppt"> -->
                        <h5 class="mb-1 tm">LATEST OFFERING</h5>
                        <?php
                        foreach ($user_course as $key => $value) {
                            # code...

                        ?>
                            <div class="latest-course">
                                <a class="index-34" href="{{url('../get_coach_course/'.$value->id)}}" alt="#">
                                    <div class="strivre-img-wrapper">

                                        <img src="../assets/images/course/1.jpg" alt="">

                                    </div>

                                    <label class="f-17 sort_name index-34 find-letest-news">{{$value->course_name}}</label>
                                    <div class="course-price">
                                        {{$value->creadit_required}} Credits
                                    </div>
                                </a>
                            </div>
                        <?php } ?>

                        <!-- </aside>
                    </nav> -->
                    </div>
                    <br>

                </div>

                <div class="course-sidebar1 letest-offering-data">
                    <nav class="navbar navbar-expand-md navbar-light  dashboard-nav mb-3 mb-lg-0 ">
                        <aside class="widget h-75 d-inline-block">
                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="../assets/images/home/2.png" src="..." alt="" class="carousel-inner-img">
                                        <P class="carousel-inner2">440 Strivres are
                                            making career</P>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../assets/images/home/11.png" src="..." alt="" class="carousel-inner-img">
                                        <P class="carousel-inner2">440 Strivres are
                                            making career</P>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../assets/images/home/12.png" src="..." alt="" class="carousel-inner-img">
                                        <P class="carousel-inner2">440 Strivres are
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

            <?php

            foreach ($categories_list_coach1 as $key => $value) {

                // print_r($value);die;

            }

            ?>

            <div class="row p-5 text-center">
                <div class="row">
                    <!-- <div class="col-lg-12"> -->

                    @foreach($categories as $key => $cat)
                    <?php
                    $name = json_decode($cat->name);
                    $ss = array();
                    foreach ($name as $key => $sub) {
                        $ss[$key] = $sub;
                    }
                    ?>
                    <div class="col-md-3 course-wrapper">


                        <a href="{{url('/coach_list_category_all/'.$cat->id) }}">

                            <div class="course-item-0123 text-center">
                                <defs>
                                    <style>
                                        .cls-1 {
                                            fill: url(#pattern);
                                        }
                                    </style>
                                    <pattern id="pattern" preserveAspectRatio="xMidYMid slice" width="100%" height="100%" viewBox="0 0 74 60">

                                        <img src="{{ url('storage/'.$cat->picture) }}" width="34" height="34" style="margin-top: 10px;">

                                    </pattern>


                                </defs>
                                <!-- <path id="desktop1" class="cls-1" d="M0,0H74V60H0Z" />
                                

                                <h4> {{ $ss['en'] }}

                                </h4> -->
                                <path id="desktop1" class="cls-1" d="M0,0H74V60H0Z" />

                                <h4> {{ $ss['en'] }} 

                                </h4>

                            </div>

                        </a>

                    </div>
                    @endforeach
                    <!-- </div> -->


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

<div style="background: #012245; width: 100%!important;">
    <section class="main-section-new">
        <div class="container">

            <div class="mt-120">
                <center>
                    <!-- <h2 class="fwhite home-banner-page-text"> GET YOUR DREAM COURSE WITH BEST INSTRUCTOR 
                    </h2>  -->

                    <h2 class="fwhite home-banner-page-text"> {{$home_page_section_two__banner->home_page_section_banner_text_top_heading}}
                    </h2> 
                </center>
                <div class="row">
                    <div class="col-lg-5 col-md-6">


                        <div class="ab-content">
                            <!-- <h3 class="fwhite">CONNECT WITH COACHES/ STRIVRES AROUND THE WORLD</h3> -->
                            <h3 class="fwhite">{{$home_page_section_two__banner->home_page_section_banner_tex_heading}}</h3>
                            <!-- <p style="color: #ffffff;">Strivre is great for teams because its easy to get set up and the offerings touch on a vast array of soft skill focus areas, which not only build role-related talents but also enable team members to grow their whole selves beyond
                                work.
                            </p> -->
                            <p style="color: #ffffff;">{!! $home_page_section_two__banner->home_page_section_banner_text_two !!}
                            </p>
                            <a class="bisylms-btn-pink" href="{{url('/register') }}">Sign Up </a>
                        
                        </div>
                        <br>
                    </div>
                    <div class=" col-lg-7 col-md-6">

                        <div class="">
                            <!-- <img src="assets/images/edu_2.png" alt=""> -->
                            <img src="{{ url('storage/'.$home_page_section_two__banner->picture) }}" alt="" style="height:98%">
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<section class="main-section topp" style="margin-top: 0px!important; ">
    <div class="container">

        <div class="row mt-120">
            <div class="col-lg-7 col-md-6">
                <div class="ab-thumb">
                   
                    <!-- <img src="assets/images/edu_1.png" alt=""> -->
                    <img src="{{ url('storage/'.$home_page_section_three_banner->picture) }}" alt="">
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="ab-content">
                <!-- <h3 class="fblack">JOIN OUR LARGEST COACHING COMMUNITY.</h3> -->
                    <h3 class="fblack">{{$home_page_section_three_banner->home_page_section_banner_text_three_heading}}</h3>
                    <!-- <p class="fblack">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque facilisis ex consectetur viverra vehicula. Nullam mauris ante, condimentum ac mi eu, bibendum mollis elit. Duis pretium velit lobortis felis fermentum pellentesque.
                        Aliquam euismod, elit vel bibendum vestibulum, nisl nisl mollis tortor, a rhoncus mi augue eleifend justo. Sed sed ullamcorper massa, at pretium tortor. Integer nunc tellus, elementum eu malesuada eu, pellentesque a tellus.
                    </p> -->
                    <p class="fblack">
                    {!! $home_page_section_three_banner->home_page_section_banner_text_three !!}
                    </p>
                    <a class="bisylms-btn" href="{{url('/register') }}">Get Started</a>
                </div>
            </div>
        </div>
    </div>
</section>




<div style="background: #fafafb!important; width: 100%!important; border: none!important;">
    <section class="main-section-new-footer">


        @includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.footer2', 'layouts.inc.footer2'])

    </section>
</div>
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



<p id="demo"></p>

<script>
    function myFunction() {
        var txt;
        if (confirm("Press a button!")) {
            txt = "You pressed OK!";
        } else {
            txt = "You pressed Cancel!";
        }
        document.getElementById("demo").innerHTML = txt;
    }
</script>

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

    .index-34 {
        color: #888 !important;
        font-size: 14px !important;
        font-weight: 400 !important;

    }
</style>

<style>
    .sort_name {
        display: inline-block;
        width: 208px;
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