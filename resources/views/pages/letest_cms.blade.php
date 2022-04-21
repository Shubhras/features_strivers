<style>
    .alert {
        display: none;
    }
</style>

<title>Strivre</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">

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
<!-- End Include All CSS -->

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<!-- Favicon Icon -->
<link rel="icon" type="image/png" href="../assets/images/favicon.png">
<!-- Favicon Icon -->

<section class="page-banner01" style="background-image: url(../assets/images/home/cta-bg.jpg);">

</section>

<!-- Banner Start -->

@extends('layouts.master_new')

@section('content')
@includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'])






<section class="blog-section64">
  <div class="container ">
            <div class="row">

            <h2 class="sec-title text-center"  style="margin-top: 61px;font-size: 40px;">{{ $page->title }}</h2>
            <div class="col-lg-6">

            @if (!empty($page->picture))
                <div class="col-lg-12 imgb">
                    <center> <img src="{{ url('storage/'.$page->picture) }}" class="lazyload img-fluid1 images_height" style="width: 100%;"></center>

                </div>
                @else

                <div class="col-lg-12 imgb">
                    <center> <img src="url(../assets/images/avtar_imag_default.jpg)" class="lazyload img-fluid1 images_height" style="width: 100%;"></center>

                </div>



                @endif
                
</div>
                <div class="col-lg-6">
                    <div class="row">

                        <div class="line_bottom newm">
                            <!-- <p> Total Consultation Fees:<span class="boxfont"> $  </span>
                </p>
                            <p> Consultation Fees Per Hour:<span class="boxfont"> $ </span>
                            </p>
                            <p> Credits Required:<span class="boxfont"> </span>
                            </p>
                            <p> Date:<span class="boxfont"> 0000-00-00</span>
                            </p>
                            <p> Coach:<span class="boxfont"> Coaches343</span>
                            </p>
                            -->
                            {!! $page->content !!}
                        </div>

                    </div>
                   
                
            </div>

        </div>

        <br><br>
        
    </div></section>

<!-- @includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.footer1', 'layouts.inc.footer1'])
<a href="#" id="back-to-top">
    <i class="fal fa-angle-double-up"></i>
</a> -->
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

</body>

</html>
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

    h1 {
        color: #1D1D1F !important;
        margin: 20px 0 10px 0;
        font-style: normal;
        font-family: 'Montserrat', sans-serif;
    } */

    /* ::-webkit-scrollbar {
        width: 4px;
    } */

    /* ::-webkit-scrollbar-thumb {
        background: red;
        border-radius: 5px;
    } */
</style>

@endsection

@section('info')
@endsection




@section('after_styles')

@if (config('lang.direction') == 'rtl')
<!-- <link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet"> -->
@endif



@endsection

@section('after_scripts')