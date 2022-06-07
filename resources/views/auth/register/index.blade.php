@extends('layouts.master_new')

@section('content')


<!-- <section class="page-banner01" style="background-image: url(../assets/images/home/cta-bg.jpg);">

</section> -->
<section class="page-banner01">

</section>

<section class=" coursepage-section-2 coach-register-pages">
    <div class="container">
        <center>

            <div class=" col-sm-10 main-section-new1 join">
                <div class="row">
                    <div class=" col-sm-6  ">
                        <div class="ab-thumb">
                            <img src="assets/images/edu_1.png" alt="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="ab-content">
                            <h3 class="fwhite">Join us as Coach or Strivre</h3>
                            <a class="bisylms-btn-pink mbtn" onclick="openCity('coaches')" href="{{url('/coach') }}">Coach Sign up</a><br>
                            <br>
                            <a class="bisylms-btn-pink mbtn" onclick="openCity('Strivers')" href="{{url('/Strivers') }}">Strivre Sign up</a>

                        </div>
                    </div>

                </div>



            </div>
        </center>
    </div>
    </div>

    <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD&disable-funding=card&intent=authorize"></script>

    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({

            style: {
                layout: 'vertical',
                color: 'gold',
                shape: 'pill',
                label: 'pay',
            }

        }).render('#paypal-button-container');
    </script>


</section>
<!-- Course Section End -->

<!-- Footer Section Start -->

<!-- Footer Section End -->

<!-- Back To Top -->

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

@endsection

@section('after_styles')

@if (config('lang.direction') == 'rtl')
<!-- <link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet"> -->
@endif



@endsection

@section('after_scripts')