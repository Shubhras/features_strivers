<title>Strivre</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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


<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />


<link rel="stylesheet" href="../assets/css/master.css">

<!-- End Include All CSS -->

<!-- Favicon Icon -->
<link rel="icon" type="image/png" href="../assets/images/favicon.png">
<!-- Favicon Icon -->
@extends('layouts.master_new')
@section('content')

<section class="page-banner" style="background-image: url(../assets/images/home/cta-bg.jpg);">
    <!-- shape -->



    <!-- shape -->


</section>

<div class="container" style="margin-top: -190px;">
    <div class="row height d-flex justify-content-center align-items-center">
        <div class="col-md-8">

            <div class="input-group">
                <div class="form-outline search-box-fix1">
                    <input type="text" id="form1" class="form-control search-box-for-main search-box-font" placeholder=" Search for Coach, Industry, Location and more..." />

                </div>
                <button type="button" class="btn btn-primary btn_class_coaches search-box-font">
                    <i class="fas fa-search"></i>
                </button>
            </div>

        </div>
    </div>
</div>

<!-- Banner End -->

<div class="elementor-widget-container mt-120">
    <div class="main-section">
        <div class="container">
            <h2 class="sec-title-cat">
                Project Management

            </h2>

            <div class="row inner-box default-inner-box">
                <div class="col-md-3">

                    <div class="row">

                        <ul style="list-style: none;">

                            @foreach($categories as $key => $cat)
                            <li class="subject-title-name" id="cat_id_<?php echo $cat->id ?>">
                                <a href="{{url('/coach_list_category_all') }}">
                                    <a href="{{url('/coach_list/'.$cat->id) }}">
                                        <?php
                                        $name = json_decode($cat->name);
                                        $ss = array();
                                        foreach ($name as $key => $sub) {
                                            $ss[$key] = $sub;
                                        }
                                        ?>

                                        {{ $ss['en'] }}

                                        <?php
                                        if (!empty($request_cat_id == $cat->id)) { ?>

                                            <ul id="subcategory_data_cat_id_<?php echo $cat->id ?>">

                                                <?php
                                                $sub_categories = Illuminate\Support\Facades\DB::table('categories')->select('categories.name', 'categories.id')->orderBy('categories.name', 'asc')->where('categories.parent_id', $cat->id)->get();


                                                ?>
                                                @foreach($sub_categories as $key => $sub_cat)

                                                <?php

                                                $name = json_decode($sub_cat->name);
                                                $sub_cat_id = ($sub_cat->id);
                                                $ss = array();
                                                foreach ($name as $key => $sub) {
                                                    $ss[$key] = $sub;
                                                }

                                                ?>

                                                <label class="subject-title-name"> <a href="{{url('/coach_list/'.$sub_cat->id) }}" id="sub_id_<?= $sub_cat->id ?>" value="<?= $sub_cat->id ?>" class="sub-cat-name"><b> {{ $ss['en'] }}</b>
                                                    </a>
                                                </label>

                                                @endforeach
                                            </ul>

                                        <?php }
                                        ?>
                                    </a>
                            </li>

                            @endforeach
                        </ul>

                    </div>
                </div>


                <div class="col-md-8">

                    <div class="row">

                        <h3 class="categories_list_by_coach">Coach List </h3>

                        <?php if (!empty($user)) {


                        ?>


                            <?php foreach ($user as $coach_list) { ?>

                               


                                <div class="col-lg-3 col-md-6">
                                    <div class="teacher-item">

                                        <div class="teacher-thumb coach-img-wrapper">
                                            <img src="{{ imgUrl($coach_list->photo, '') }}" class="lazyload img-fluid" alt="{{ $coach_list->name }}">


                                            <div class="teacher-social">
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
                                            </div>
                                        </div>

                                        <div class="teacher-meta" id="coach_id_{{$coach_list->id }}">

                                            <a type="button" href="{{url('/coachall_detail/'.$coach_list->id) }}" data-toggle="modal" data-target=".bd-example-modal-lg_{{$coach_list->id }}" id="coach_id_{{$coach_list->id }}">

                                                <h5>
                                                    {{ $coach_list->name }}
                                                </h5>
                                            </a>
                                            <p>Illustrator
                                            </p>


                                            <div class="modal fade bd-example-modal-lg_{{$coach_list->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="coach_id_{{$coach_list->id }}">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content p-5">

                                                        <img src="{{ imgUrl($coach_list->photo, '') }}" class="img-coches-main" alt="{{ $coach_list->name }}">
                                                        <h3 class=" text-center mt-5">{{$coach_list->name}}</h3>
                                                        <h4 class=" text-center">

                                                            Teaches Adventure Photography
                                                        </h4>
                                                        <p class=" text-center">
                                                            National Geographic photographer teaches his techniques for planning, capturing, and editing breathtaking photos.
                                                        </p>
                                                        <h5 class="coches-description text-center mt-5">{{$coach_list->name}} has built his career taking photos at the top of the world, earning him the cover of National Geographic and multiple awards. Now he’s taking you on location to teach you techniques for capturing
                                                            breathtaking shots. In his photography class, learn different creative approaches for commercial shoots, editorial spreads, and passion projects. Gather the gear—and the perspective—to bring your
                                                            photography to new heights.</h5>
                                                        <div class="row center-button-modal">

                                                            <div class="col-lg-2">
                                                                <a href="{{url('/coachall_detail/'.$coach_list->id) }}" class="bisylms-btn">Know more</a>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <a href="{{url('/pricing') }}" class="bisylms-btn">Get Started</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            <?php } ?>
                            









                            <?php } else {
                            foreach ($my_coaches as $coach_list) { ?>


                                <div class="col-lg-3 col-md-6">
                                    <div class="teacher-item">

                                        <div class="teacher-thumb coach-img-wrapper">
                                            <img src="{{ imgUrl($coach_list->photo, '') }}" class="lazyload img-fluid" alt="{{ $coach_list->name }}">


                                            <div class="teacher-social">
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
                                            </div>
                                        </div>

                                        <div class="teacher-meta" id="coach_id_{{$coach_list->id }}">

                                            <a type="button" href="{{url('/coachall_detail/'.$coach_list->id) }}" data-toggle="modal" data-target=".bd-example-modal-lg_{{$coach_list->id }}" id="coach_id_{{$coach_list->id }}">

                                                <h5>
                                                    {{ $coach_list->name }}
                                                </h5>
                                            </a>
                                            <p>Illustrator
                                            </p>
                                            <div class="modal fade bd-example-modal-lg_{{$coach_list->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="coach_id_{{$coach_list->id }}">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content p-5">

                                                        <img src="{{ imgUrl($coach_list->photo, '') }}" class="img-coches-main" alt="{{ $coach_list->name }}">
                                                        <h3 class=" text-center mt-5">{{$coach_list->name}}</h3>
                                                        <h4 class=" text-center">

                                                            Teaches Adventure Photography
                                                        </h4>
                                                        <p class=" text-center">
                                                            National Geographic photographer teaches his techniques for planning, capturing, and editing breathtaking photos.
                                                        </p>
                                                        <h5 class="coches-description text-center mt-5">{{$coach_list->name}} has built his career taking photos at the top of the world, earning him the cover of National Geographic and multiple awards. Now he’s taking you on location to teach you techniques for capturing
                                                            breathtaking shots. In his photography class, learn different creative approaches for commercial shoots, editorial spreads, and passion projects. Gather the gear—and the perspective—to bring your
                                                            photography to new heights.</h5>
                                                        <div class="row center-button-modal">

                                                            <div class="col-lg-2">
                                                                <a href="{{url('/coachall_detail/'.$coach_list->id) }}" class="bisylms-btn">Know more</a>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <a href="{{url('/pricing') }}" class="bisylms-btn">Get Started</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php } ?>


                        <?php } ?>

                    </div>

                </div>
                <center>
                    <a class="bisylms-btn" href="#">Explore Top Course </a>
                </center>
            </div>




        </div>
    </div>

</div>
</div>

<!-- <div class="main-section"> -->
<div class="container">

    <h2 class="sec-title-cat">
        Suggested Coaches

    </h2>

    <div class="row">


        <?php foreach ($suggested_coaches as $coach_list) { ?>

            <div class="col-lg-3 col-md-6">
                <div class="teacher-item">
                    <div class="teacher-thumb coach-img-wrapper">

                        <!-- <img src="assets/images/home/f1.jpg" alt="Jim Séchen"> -->

                        <img src="{{ imgUrl($coach_list->photo, '') }}" alt="Jim Séchen">

                        <div class="teacher-social">
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
                        </div>
                    </div>
                    <div class="teacher-meta">

                    <a type="button" href="{{url('/coachall_detail/'.$coach_list->id) }}" data-toggle="modal" data-target=".bd-example-modal-lg_{{$coach_list->id }}" id="coach_id_{{$coach_list->id }}">

                        <h5 style="font-weight: 700;">
                            {{ $coach_list->name }}
                        </h5>
                    </a>
                        <p>Stylist &amp; Author
                        </p>


                        <div class="modal fade bd-example-modal-lg_{{$coach_list->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="coach_id_{{$coach_list->id }}">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content p-5">

                                                        <img src="{{ imgUrl($coach_list->photo, '') }}" class="img-coches-main" alt="{{ $coach_list->name }}">
                                                        <h3 class=" text-center mt-5">{{$coach_list->name}}</h3>
                                                        <h4 class=" text-center">

                                                            Teaches Adventure Photography
                                                        </h4>
                                                        <p class=" text-center">
                                                            National Geographic photographer teaches his techniques for planning, capturing, and editing breathtaking photos.
                                                        </p>
                                                        <h5 class="coches-description text-center mt-5">{{$coach_list->name}} has built his career taking photos at the top of the world, earning him the cover of National Geographic and multiple awards. Now he’s taking you on location to teach you techniques for capturing
                                                            breathtaking shots. In his photography class, learn different creative approaches for commercial shoots, editorial spreads, and passion projects. Gather the gear—and the perspective—to bring your
                                                            photography to new heights.</h5>
                                                        <div class="row center-button-modal">

                                                            <div class="col-lg-2">
                                                                <a href="{{url('/coachall_detail/'.$coach_list->id) }}" class="bisylms-btn">Know more</a>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <a href="{{url('/pricing') }}" class="bisylms-btn">Get Started</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>
<!-- </div> -->


<!-- </div> -->
<!-- Footer Section Start -->

<!-- Footer Section End -->
@includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.footer1', 'layouts.inc.footer1'])

<!-- Back To Top -->
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


<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }


    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<style>
    .btn i {

        top: -7px !important;
    }

    .sub-cat-name {
        color: blue !important;
    }
</style>
@endsection

@section('after_styles')

@if (config('lang.direction') == 'rtl')
<!-- <link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet"> -->
@endif



@endsection

@section('after_scripts')