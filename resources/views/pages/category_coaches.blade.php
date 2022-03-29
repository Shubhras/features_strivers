<!-- <link rel="icon" type="image/png" href="../assets/images/favicon.png"> -->

<!-- Favicon Icon -->
@extends('layouts.master_new')
@section('content')

<section class="page-banner" style="background-image: url(../assets/images/home/cta-bg.jpg);">


</section>


<div class="container search-category-find">
    <div class="row height d-flex justify-content-center align-items-center">
        <div class="col-md-2">

        </div>
        <div class=" col-lg-8 col-md-8 ">

            <div class="input-group">
                <div class="form-outline search-box-fix1">
                    <input type="text" id="form1" class="form-control search-box-for-main search-box-font" placeholder=" Search for Coach, Industry, Location and more..." />

                </div>
                <button type="button" class="btn btn87 btn-primary btn_class btn_class_coaches12 search-button-icon-width">
                    <i class="fas fa-search"></i>
                </button>
            </div>

        </div>
        <div class="col-md-2">

        </div>
    </div>
</div>



<div class="elementor-widget-container">


    <div class="main-section">

        <div class="container project-manage">

            <h2 class="sec-title">
                Project Management

            </h2>

            <div class="row">
                <div class="col-md-3">

                    <div class="row">

                        <ul style="list-style: none;">

                            @foreach($categories as $key => $cat)
                            <li class="subject-title-name-cat" data-id="{{ $cat->id }}" uid="{{ $cat->id }}" id="cat_id_<?php echo $cat->id ?>" onClick="subCatListCoach(<?php echo $cat->id ?>);" value="<?php echo $cat->id ?>"><i class="fa fa-angle-up" id="donar" style="float: right;"></i>

                                <?php
                                $name = json_decode($cat->name);
                                $ss = array();
                                foreach ($name as $key => $sub) {
                                    $ss[$key] = $sub;
                                }
                                ?>

                                {{ $ss['en'] }}



                                <ul id="subcategory_data_cat_id_<?php echo $cat->id ?>">

                                </ul>
                            </li>

                            @endforeach
                        </ul>

                    </div>
                </div>


                <div class="col-md-8">

                    <div class="row">

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









                    </div>


                    <div class="row" id="my_coach_list">

                        <!-- <div class="col-lg-3 col-md-6" >
                        </div> -->

                    </div>


                </div>
                <center>
                    <a class="bisylms-btn" href="#">Explore Top Course </a>
                </center>
            </div>




        </div>
    </div>
</div>

<!-- </div> -->
<!-- </div> -->

<!-- <div class="main-section"> -->

<br><br>
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

                        <img src="{{ url('storage/'.$coach_list->photo) }}" alt="Jim Séchen">

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

                            <h5 class="coach-cat-name12">
                                {{ $coach_list->name }}
                            </h5>
                        </a>
                        <p>Stylist &amp; Author
                        </p>


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
                    <!-- </div>
            </div>
                </div> -->
                </div>
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
@endsection

@section('after_styles')

@if (config('lang.direction') == 'rtl')
<!-- <link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet"> -->
@endif



@endsection

@section('after_scripts')



<script>
    function subCatListCoach(uid) {
        // var uid= $('#uid').this();
        var id = $('#cat_id_' + uid).val();



        console.log('category id ', id);
        $.ajax({
            type: 'GET',
            dataType: 'Json',
            url: "{{ url('coach_list') }}/" + id,
            cache: false,
            data: {
                '_token': '{{ csrf_token() }}',
                id: id,

            },
            // console.log('resend',Response);
            success: function(Response) {

                console.log('resend', Response);

                var html = "";
                var html2 = "";
                var request_cat_id = "";
                $.each(Response, function(key, value) {
                    console.log('cat_id_114', value.request_cat_id);

                    $request_cat_id = value.request_cat_id;
                    // html += "<li><a href=''>" + value.sub_cat_id + "</a></li>";
                    if (value.sub_cat_id.length > 0) {

                        $.each(value.sub_cat_id, function(key, subValue) {

                            console.log(JSON.stringify(subValue));

                            html += "<li class='subject-title-name-cat-sub'><a class='subject-name-cat-sub' href='" + subValue.id + "'>" + subValue.slug + "</a></li>";


                        });
                    }

                   

                    if (value.user.length > 0) {

                        $.each(value.user, function(key, subValue) {

                            console.log(JSON.stringify(subValue));
                            // html2 += subValue.id ;

                            // html2 += '<div>' + key + ':' + subValue.id + '</div>';
                            // html2 += '<div>' + key + ':' + subValue.name + '</div>';
                            // html2 += '<div>' + key + ':' + subValue.photo + '</div>';
                            // html2 += '<div>' + key + ':' + subValue.email + '</div>';
                            // html2 += '<div>' + key + ':' + subValue.category + '</div>';
                            // html2 += '<div>' + key + ':' + subValue.phone + '</div>';
                            // html2 += '<div>' + key + ':' + subValue.subscription_name + '</div>';




                            html2 +=  '<div class="col-lg-3 col-md-6 top-coaches-by-category">';
                            html2 += '<div class = "teacher-item">';
                            html2 += ' <div class ="teacher-thumb coach-img-wrapper">';
                            html2 += ' <img src = "storage/' + subValue.photo+ '"  class = "lazyload img-fluid" alt = "' + subValue.name + '" >';
                            html2 += '<div class = "teacher-social" >';
                            html2 += '<a href = "#" ><i aria-hidden = "true" class = "fab fa-facebook-f"> </i> </a>';
                            html2 += '<a href = "#" ><i aria-hidden = "true" class = "fab fa-twitter"> </i> </a> ';
                            html2 += '<a href = "#" ><i aria-hidden = "true" class = "fab fa-pinterest-p"> </i> </a> ';
                            html2 += '<a href = "#" ><i aria-hidden = "true" class = "fab fa-vimeo-v"> </i> </a> ';
                            html2 += '</div> ';
                            html2 += '</div>';
                            html2 += '<div class = "teacher-meta" id ="coach_id_'+ subValue.id + '"> ';
                            html2 += ' <a type = "button" href = "coachall_detail/' + subValue.id + '" data-toggle = "modal" data-target = ".bd-example-modal-lg_' + subValue.id + '"  id = "coach_id_' + subValue.id + '" >';
                            html2 +=  ' <h5 class = "coach-cat-name12" > ' + subValue.name +'</h5></a> <p > Illustrator </p>';
                        
                            html2 += '<div class = "modal fade bd-example-modal-lg_' + subValue.id + '" tabindex = "-1" role = "dialog"  aria - labelledby = "myLargeModalLabel" aria - hidden = "true" id = "coach_id_' + subValue.id + '" >';
                            html2 += ' <div class = "modal-dialog modal-xl" >';
                            html2 += '<div class = "modal-header" >';
                            html2 += '<h4 class = "modal-title" > Top Coach Details < /h4> ';
                            html2 += '<button type = "button" class = "close" data - dismiss = "modal" > & times; < /button> </div>';
                            html2 += '< div class = "modal-content p-5" >';
                            html2 += '<img src = "storage/' + subValue.photo + '" class = "img-coches-main" alt = "' + subValue.name + '" >';
                            html2 += '<p class = "coach-details-name" >' + subValue.name + '< /p> ';
                            html2 += '<h4 class = " text-center" > Teaches Adventure Photography <h4> ';
                            html2 += ' < p class = "text-center" > < b >National Geographic photographer teaches his techniques for planning, capturing, and editing breathtaking photos. < /b> </p> <br> ';
                            html2 += '<label >' + subValue.name + 'has built his career taking photos at the top of the world, earning him the cover of National Geographic and multiple awards.Now he’ s taking you on location to teach you techniques for capturing breathtaking shots.In his photography class, learn different creative approaches for commercial shoots, editorial spreads, and passion projects.Gather the gear— and the perspective— to bring your photography to new heights. < /label> <br >';
                            html2 += '<div class = "row center-button-modal" >';

                            html2 += '<div class = "col-lg-2" >';
                            html2 += '<a href = "coachall_detail/' + subValue.id + '" class = "bisylms-btn" style = "color: aliceblue!important;" > Know more < /a> </div> ';
                            html2 += ' <div class = "col-lg-2" ><a href = "/pricing" class= "bisylms-btn" style = "color: aliceblue!important;" > Get Started < /a> </div> ';
                            html2 += '</div>';
                            html2 += ' </div> ';
                            


                        });
                    }
                });



                // console.log('html', html2);
                console.log('request_cat_id', html2);
                $("#subcategory_data_cat_id_" + uid).html(html);

                // $("#my_coach_list").val(request_cat_id);
                $("#my_coach_list").append(html2);

                // $("#my_coach_list").attr("id",b).html(html2);



            },
            error: function() {
                alert(" Subcategory not found !");
                console.log('resend', Response);
            }
        });
    }
</script>

<!-- <script>
    $('#uid ul').hide();
    $("#uid a").click(function() {
        $(this).parent(".sub-menu").children("ul").slideToggle("100");
        $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
    });
</script> -->

<script>
    $('#uid').on("click", function() {
        $('.downArrow, .upArrow').toggle();
        $('.dropdown').slideToggle();
    });
</script>