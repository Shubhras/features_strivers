<!-- <link rel="icon" type="image/png" href="../assets/images/favicon.png"> -->

<!-- Favicon Icon -->
@extends('layouts.master_new')
@section('content')
<style>
    * {
        box-sizing: border-box;
    }

    /* 
body {
    background-color: #f1f1f1;
    padding: 20px;
    font-family: Arial; */
    /* } */

    /* Center website */
    .main {
        max-width: 1000px;
        margin: auto;
    }

    h1 {
        font-size: 50px;
        word-break: break-all;
    }

    .row {
        margin: -13px -16px;
    }

    /* Add padding BETWEEN each column */
    .column {
        padding: 8px;
    }

    /* Create three equal columns that floats next to each other */
    .column {
        float: left;
        width: 33.33%;
        display: none;
        /* Hide all elements by default */
    }

    /* Clear floats after rows */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    /* Content */
    .content {
        background-color: white;
        padding: 10px;
    }

    /* The "show" class is added to the filtered elements */
    .show {
        display: block;
    }

    /* Style the buttons */
    .btn {
        border: none;
        outline: none;
        padding: 12px 16px;
        background-color: white;
        cursor: pointer;
        font-size: 20px;
    }

    .btn:hover {
        background-color: #ddd;
        color: blue;
    }

    .btn.active {
        background-color: #666;
        color: white;
    }
</style>
<section class="page-banner" style="background-image: url(../assets/images/home/cta-bg.jpg);">
    <div class="hi">

    </div>

</section>


<div class="container search-category-find">
    <div class="row height d-flex justify-content-center align-items-center">
        <div class="col-md-2">

        </div>


        <center>
            <div class=" col-lg-8 col-md-8 searchp ">

                <form action="{{ url('/findtopcoach') }}" method="post">

                    <div class="input-group wi">
                        <div class="form-outline search-box-fix1">
                            <input type="search" name="search" id="form1" class="form-control search-box-for-main search-box-font" placeholder=" Search for Coach, Industry, Location and more..." />

                        </div>
                        <button type="submit" class="btn btn87 btn-primary btn_class btn_class_coaches12 search-button-icon-width">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

            </div>
        </center>

        <div class="col-md-2">

        </div>
    </div>
</div>



<div class="elementor-widget-container">


    <!-- <div class="main-section"> -->

    <div class="container project-manage">

        <h2 class="sec-title">
            <!-- Project Management -->
            @if(!empty($search_key))


            Search Result for: {{$search_key}}
            @else
            Top Coaches for You
            @endif

        </h2>

        <!-- <div class="row"> -->
        <!-- <div class="col-md-3">

                    <div class="row">

                        <ul style="list-style: none;">

                            @foreach($categories as $key => $cat)
                            <li class="subject-title-name-cat" data-id="{{ $cat->id }}" uid="{{ $cat->id }}" id="cat_id_<?php echo $cat->id ?>" onclick="filterSelection('all')"" value="<?php echo $cat->id ?>"><i class="fa fa-angle-up" id="donar" style="float: right;"></i>
                            
                            
                                <?php
                                $name = json_decode($cat->name);
                                $ss = array();
                                foreach ($name as $key => $sub) {
                                    $ss[$key] = $sub;
                                }
                                ?>

                                {{ $ss['en'] }}



                                <ul  id="subcategory_data_cat_id_<?php echo $cat->id ?>">

                                </ul>
                            </li>

                            @endforeach
                        </ul>

                    </div>
                </div> -->


        <!-- <div class="col-md-8"> -->

        <!-- <div class="row">

                        <?php


                        // if ($request_cat_id != null) {

                        foreach ($user as $coach_list) {


                        ?>




                            <div class="col-lg-3 col-md-6 top-coaches-by-category">

                                <div class="teacher-item">

                                    <div class="teacher-thumb coach-img-wrapper">
                                        <img src="{{ url('storage/'.$coach_list->photo) }}" class="lazyload img-fluid" alt="{{ $coach_list->name }}">


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

                                            <h5 class="coach-cat-name12">
                                                {{ $coach_list->name }}
                                            </h5>
                                        </a>
                                        <p>Illustrator
                                        </p>


                                        <div class="modal fade bd-example-modal-lg_{{$coach_list->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="coach_id_{{$coach_list->id }}">
                                            <div class="modal-dialog modal-xl">

                                                <div class="modal-header">
                                                    <h4 class="modal-title">Top Coach Details</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-content p-5">


                                                    <img src="{{ url('storage/'.$coach_list->photo) }}" class="img-coches-main" alt="{{ $coach_list->name }}">
                                                    <p class="coach-details-name">{{$coach_list->name}}</p>
                                                    <h4 class=" text-center">
                                                        Teaches Adventure Photography
                                                    </h4>
                                                    <p class="text-center"><b>
                                                            National Geographic photographer teaches his techniques for planning, capturing, and editing breathtaking photos.</b>
                                                    </p> <br>
                                                    <label>{{$coach_list->name}} has built his career taking photos at the top of the world, earning him the cover of National Geographic and multiple awards. Now he’s taking you on location to teach you techniques for capturing
                                                        breathtaking shots. In his photography class, learn different creative approaches for commercial shoots, editorial spreads, and passion projects. Gather the gear—and the perspective—to bring your
                                                        photography to new heights.</label>
                                                    <br>
                                                    <div class="row center-button-modal">

                                                        <div class="col-lg-2">
                                                            <a href="{{url('/coachall_detail/'.$coach_list->id) }}" class="bisylms-btn" style="color: aliceblue!important;">Know more</a>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <a href="{{url('/pricing') }}" class="bisylms-btn" style="color: aliceblue!important;">Get Started</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <?php }
                        // } 
                            ?>
                       


                </div> -->

        <div class="row">
            <div class="col-md-4">

                <!-- <div  id="myBtnContainer" class="subject-title-name-cat" onclick="filterSelection('0')">
    </div> -->
                <div class="accordion" id="accordionExample" onclick="subCatListCoach('{{ $cat->id }}')">
                    @foreach($categories as $key => $cat)
                    <?php
                    $name = json_decode($cat->name);
                    $ss = array();
                    foreach ($name as $key => $sub) {
                        $ss[$key] = $sub;
                    }
                    ?>
                    <div>
                        <!-- <div class="subject-title-name-cat" id="heading{{ $cat->id }}"> -->
                        <h5 class="mb-0 subject-title-name-cat tab1 ">
                            <button class="btn btn-link tab " id="heading{{ $cat->id }}" type="button" data-toggle="collapse" data-target="#collapse{{ $cat->id }}" aria-expanded="true" aria-controls="collapse{{ $cat->id }}" style="color: #000000!important">
                                {{ $ss['en'] }}
                            </button>
                            <i class="fa arrow-down btn-link" id="heading{{ $cat->id }}" data-toggle="collapse" data-target="#collapse{{ $cat->id }}" aria-expanded="true" aria-controls="collapse{{ $cat->id }}" style="color: #000000!important; float: right;" onclick="this.classList.toggle('active')"></i>
                        </h5>
                        <!-- </div> -->
                        <div id="collapse{{ $cat->id }}" class="collapse" aria-labelledby="heading{{ $cat->id }}" data-parent="#accordionExample">
                            <!-- <div class="card-body"> -->
                            <!-- <ul> -->
                            @foreach($sub_categories as $key => $sub_cat)
                            @if($sub_cat->parent_id == $cat->id)
                            <?php
                            $name = json_decode($sub_cat->name);
                            $ss = array();
                            foreach ($name as $key => $sub) {
                                $ss[$key] = $sub;
                            }
                            ?>

                            <h5 class=" mb-0 subject-title-name-cat">

                                <button style="margin-left: 5px; border-bottom: 1px;" class="btn sub-categorry subject-title-name-cat-sub" onclick="filterSelection('{{$sub_cat->slug}}')">{{ $ss['en'] }}
                                </button>
                            </h5>

                            @endif
                            @endforeach
                            <!-- </ul> -->
                            <!-- </div> -->
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
            <div class="col-md-8">


                <div class="row">
                    <?php
                    foreach ($user as $coach_list) {
                    ?>
                        <div class="column {{$coach_list->slug_name}}">
                            <a type="button" href="{{url('/coachall_detail/'.$coach_list->id) }}" data-toggle="modal" data-target=".bd-example-modal-lg_{{$coach_list->id }}" id="coach_id_{{$coach_list->id }}">

                                <div class="teacher-thumb coach-img-wrapper">

                                    <?php if ($coach_list->photo != null) { ?>
                                        <img src="{{ url('storage/'.$coach_list->photo) }}" alt="Mountains" style="width:100%" alt="{{ $coach_list->name }}">

                                    <?php } else { ?>

                                        <img src="../images/user_default.jpg" alt="Basic" style="width:100%">

                                    <?php } ?>

                                    <div class="teacher-social">
                                        <!-- <a href="#">
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
                                    </a> -->
                                    </div>
                                </div>
                                <!-- <a type="button" href="{{url('/coachall_detail/'.$coach_list->id) }}" data-toggle="modal"
                                data-target=".bd-example-modal-lg_{{$coach_list->id }}"
                                id="coach_id_{{$coach_list->id }}"> -->
                                <br>
                                <h5 class="coach-cat-name12">
                                    {{ $coach_list->name }}
                                </h5>

                                <!-- <p>Stylist &amp; Author
                            </p> -->

                                <?php

                                if (!empty($coach_list->slug)) {


                                    $name = json_decode($coach_list->slug);
                                    $ss = array();
                                    foreach ($name as $key => $sub) {
                                        $ss[$key] = $sub;
                                    }

                                ?>
                                    <p class="lh">{{$ss['en']}}
                                    </p>
                                <?php  } else {
                                ?>
                                    <p class=" text-center" style="float: left;">Others
                                    </p>
                                <?php } ?>
                            </a>

                        </div>
                    <?php } ?>
                </div>

                <script>
                    filterSelection("0")
                    subCatListCoach('{{ $cat->id }}')

                    function filterSelection(c) {
                        var x, i;
                        x = document.getElementsByClassName("column");
                        if (c == "0") c = "";
                        for (i = 0; i < x.length; i++) {
                            w3RemoveClass(x[i], "show");
                            if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
                        }
                    }

                    function w3AddClass(element, name) {
                        // console.log(name);
                        var i, arr1, arr2;
                        arr1 = element.className.split(" ");
                        arr2 = name.split(" ");
                        for (i = 0; i < arr2.length; i++) {
                            if (arr1.indexOf(arr2[i]) == -1) {
                                element.className += " " + arr2[i];
                            }
                        }
                    }

                    function w3RemoveClass(element, name) {
                        var i, arr1, arr2;
                        arr1 = element.className.split(" ");
                        arr2 = name.split(" ");
                        for (i = 0; i < arr2.length; i++) {
                            while (arr1.indexOf(arr2[i]) > -1) {
                                arr1.splice(arr1.indexOf(arr2[i]), 1);
                            }
                        }
                        element.className = arr1.join(" ");
                    }


                    // Add active class to the current button (highlight it)
                    var btnContainer = document.getElementById("myBtnContainer");
                    var btns = btnContainer.getElementsByClassName("btn");
                    for (var i = 0; i < btns.length; i++) {
                        btns[i].addEventListener("click", function() {
                            var current = document.getElementsByClassName("active");
                            current[0].className = current[0].className.replace(" active", "");
                            this.className += " active";
                        });
                    }
                </script>
            </div>
            <center>
                <a class="bisylms-btn" href="#">Explore Top Course </a>
            </center>
        </div>





    </div>
    <!-- </div> -->
</div>



<br><br>
<br><br>
<div class="container">

    <h2 class="sec-title-cat">
        Suggested Coaches
    </h2>

    <div class="row">
        <?php


        foreach ($suggested_coaches as $coach_list) { ?>

            <div class="col-lg-3 col-md-6">

                <a type="button" href="{{url('/top_coach_detail/'.$coach_list->id) }}" id="coach_id_{{$coach_list->id }}">

                    <div class="teacher-item">
                        <div class="teacher-thumb coach-img-wrapper">

                            <!-- <img src="assets/images/home/f1.jpg" alt="Jim Séchen"> -->

                            <?php if ($coach_list->photo != null) { ?>



                                <img src="{{ url('storage/'.$coach_list->photo) }}" alt="Mountains" style="width:100%" alt="{{ $coach_list->name }}">

                            <?php } else { ?>

                                <img src="../images/user_default.jpg" alt="Basic" style="width:100%">

                            <?php } ?>


                        </div>
                        <div class="teacher-meta">

                            <!-- <a type="button" href="{{url('/top_coach_detail/'.$coach_list->id) }}" data-toggle="modal" data-target=".bd-example-modal-lg_{{$coach_list->id }}" id="coach_id_{{$coach_list->id }}"> -->

                            <p class=" top-coaches-name-list coach-cat-name12">
                                {{ $coach_list->name }}
                            </p>



                            <?php

                            if (!empty($coach_list->slug)) {


                                $name = json_decode($coach_list->slug);
                                $ss = array();
                                foreach ($name as $key => $sub) {
                                    $ss[$key] = $sub;
                                }

                            ?>

                                <p class="text-center">{{$ss['en']}}
                                </p>
                            <?php  } else {
                            ?>
                                <p class=" text-center">Others
                                </p>
                            <?php } ?>

                </a>

                <!-- <div class="modal fade bd-example-modal-lg_{{$coach_list->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="coach_id_{{$coach_list->id }}">
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
                                     </div> -->

                <div class="modal fade bd-example-modal-lg_{{$coach_list->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="coach_id_{{$coach_list->id }}">
                    <div class="modal-dialog modal-xl">

                        <div class="modal-header">
                            <h4 class="modal-title">Top Coach Details</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-content p-5">

                            <?php if ($coach_list->photo != null) { ?>



                                <img src="{{ url('storage/'.$coach_list->photo) }}" class="img-coches-main" alt="{{ $coach_list->name }}">

                            <?php } else { ?>

                                <img src="../images/user_default.jpg" alt="Basic" class="img-coches-main">

                            <?php } ?>


                            <p class="coach-details-name">{{$coach_list->name}}</p>
                            <h4 class=" text-center">

                                <?php

                                if (!empty($coach_list->slug)) {


                                    $name = json_decode($coach_list->slug);
                                    $ss = array();
                                    foreach ($name as $key => $sub) {
                                        $ss[$key] = $sub;
                                    }

                                ?>

                                    <p class="text-center">{{$ss['en']}}
                                    </p>
                                <?php  } else {
                                ?>
                                    <p class=" text-center">Others
                                    </p>
                                <?php } ?>
                                <!-- Teaches Adventure Photography -->
                            </h4>
                            <p class="text-center"><b>
                                    National Geographic photographer teaches his techniques for planning, capturing,
                                    and editing breathtaking photos.</b>
                            </p> <br>
                            <?php if (!empty($coach_list->coach_summary)) { ?>
                                <label>{{$coach_list->coach_summary}} </label>
                            <?php } else { ?>
                                <label>No Summary </label>
                            <?php } ?>
                            <br>
                            <div class="row center-button-modal">

                                <div class="col-lg-2">
                                    <a href="{{url('/top_coach_detail/'.$coach_list->id) }}" class="bisylms-btn" style="color: aliceblue!important;">Know more</a>
                                </div>
                                <div class="col-lg-2">
                                    <a href="{{url('/pricing') }}" class="bisylms-btn" style="color: aliceblue!important;">Get Started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    </a>
</div>
<?php } ?>
</div>
</div>
<br><br><br>
<!-- </div> -->


<!-- </div> -->
<!-- Footer Section Start -->

<!-- Footer Section End -->
@includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.footer', 'layouts.inc.footer'])

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

        top: 0px !important;
    }

    .sub-cat-name {
        color: blue !important;
    }
</style>

<style>
    .arrow-down {
        width: 20px;
        height: 20px;
        /* background: red; */
        color: #000000;
        position: relative;
    }

    .arrow-down.active {
        /* background: blue; */
    }

    .arrow-down:before,
    .arrow-down:after {
        content: "";
        display: block;
        width: 9px;
        height: 3px;
        background: #100f0f;
        position: absolute;
        top: 7px;
        transition: transform .5s;
    }

    .arrow-down:before {
        right: 14px;
        border-top-left-radius: 2px;
        border-bottom-left-radius: 5px;
        transform: rotate(45deg);
    }

    .arrow-down:after {
        right: 10px;
        transform: rotate(-45deg);
    }

    .arrow-down.active:before {
        transform: rotate(-45deg);
    }

    .arrow-down.active:after {
        transform: rotate(45deg);
    }
</style>
@endsection

@section('after_styles')

@if (config('lang.direction') == 'rtl')
<!-- <link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet"> -->
@endif



@endsection

@section('after_scripts')