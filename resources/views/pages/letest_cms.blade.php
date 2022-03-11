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
<div class="main-container inner-page">
    <div class="container">
        <div class="section-content">

            <h3 class="text-center">{{ $page->title }}</h3>

            <div class="row">



                <div class="col-md-12 page-content" style="padding: 20px;">
                    <div class="inner-box relative">
                        <div class="row">



                            <div class="col-sm-12 page-content">
                                @if (empty($page->picture))
                                <!-- <h3 class="text-center" style="color: {!! $page->title_color !!};">{{ $page->title }}</h3> -->

                                <div class="text-content">
                                    <center>
                                        <!-- <h3 class="text-center" style="color: {!! $page->title_color !!};">{{ $page->title }}</h3> -->

                                        <!-- <img src="url('../assets/images/avtar_imag_default.jpg')" alt="{{ $page->name }}" style="height: 400px; width: 9000px;"> -->

                                        <section class="page-banner01" style="background-image: url(../assets/images/avtar_imag_default.jpg); position: relative; background-size: cover; background-repeat: no-repeat; background-position: center center; height: 500px;" alt="{{ $page->name }}">

                                        </section>

                                    </center>
                                </div>

                                @endif

                                @if (!empty($page->picture))
                                <div class="text-content">
                                    <center>
                                        <img src="{{ url('storage/'.$page->picture) }}" alt="{{ $page->name }}" style="height: 200px; width: 5000px;">
                                    </center>
                                </div>
                                @endif
                                <br>
                                <div class="text-content text-start from-wysiwyg">
                                    {!! $page->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            @includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.social.horizontal', 'layouts.inc.social.horizontal'])

        </div>
    </div>
</div>

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

    ::-webkit-scrollbar {
        width: 4px;
    }

    ::-webkit-scrollbar-thumb {
        background: red;
        border-radius: 5px;
    }
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