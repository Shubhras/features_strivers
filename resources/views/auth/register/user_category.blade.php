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
        <div class="" id="Strivers">


            <form role="form" method="POST" action="{{ url('/updateUserCategory') }}" class="row" name=form1>

                {!! csrf_field() !!}



                <!-- <div class="col-md-12">

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

                </div> -->

                <!-- modal fade bd-example-modal-lg -->


 <div class="" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-contents">

            <div class="modal-header">
                <h5 class="modal-title">What topics do you find interesting?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span> -->
                </button>
            </div>
            <?php //print_r($categories);die; ?>
                            <?php
 
                        foreach ($categories as $key => $value) {

                            // print_r($value);die;

                             }
                
                ?>

            <div class="row p-5 text-center">
                <div class="row">
                    <!-- <div class="col-lg-12"> -->
                  <?php  $counter=0; ?>
                    @foreach($categories as $key => $cat)
                    <?php
                   
                    $name = json_decode($cat->name);
                    $ss = array();

                   

                    $counter=$counter+1;
                    foreach ($name as $key => $sub) {
                        $ss[$key] = $sub;
                    }
                    ?>
                    <div class="col-md-3 course-wrapper">


                        <!-- <a href="{{url('/updateUserCategory/'.$cat->id) }}"> -->

                            <div class="course-item-01 text-center">
                                <defs>
                                    <style>
                                        .cls-1 {
                                            fill: url(#pattern);
                                        }
                                    </style>
                                    <pattern id="pattern" preserveAspectRatio="xMidYMid slice" width="100%" height="100%" viewBox="0 0 74 60">

                                        <img src="{{ url('storage/'.$cat->picture) }}" width="74" height="60" class="category_imagrs">

                                    </pattern>

                                </defs>
                                <path id="desktop1" class="cls-1" d="M0,0H74V60H0Z" />

                                <h4> {{ $ss['en'] }} 

                                </h4>
                                <input type="checkbox" name="category_id[]" id="category_id_' .$cat->id. '" value="{{$cat->id}}" style="width: 15px;" class="someclass">  
                            </div>

                        <!-- </a> -->

                    </div>
                    @endforeach
                    <!-- </div> -->
                </div>
                                        
                <div class="col-lg-12">
                    <button type="submit" class="bisylms-btn" data-toggle="modal" data-target=".bd-example-modal-lg">
                        Submit Your Interest
                    </button>
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

<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function () {
    $('#category_id').click(function() {

      checked = $("input[type=checkbox]:checked").length;

      alert(checked);
      

      if(checked< 3) {
        // alert("You must check at least one checkbox.");
        // return false;
      }else if(checked > 3){

        alert("You must check at least one checkbox.");
        return false;
      }

    });
});

</script> -->




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

<script>
    $(".someclass").change(function() {
        var count = $(".someclass:checked").length; //get count of checked checkboxes

        if (count > 3) {
            alert("Only 3 options allowed..!");
            $(this).prop('checked', false); // turn this one off
        }
    });
</script>