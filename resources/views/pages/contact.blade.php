
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
        </div> -->
    <!-- </div> -->
    <!-- Preloader Icon -->

    <!-- Header Start -->
  
    <!-- Header End -->

    <!-- Banner Start -->
	@if (isset($errors) && $errors->any())
					<div class="col-xl-12">
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ t('Close') }}"></button>
							<h5><strong>{{ t('oops_an_error_has_occurred') }}</strong></h5>
							<ul class="list list-check">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					</div>
				@endif
    
    <section class="page-banner" style="background-image: url(assets/images/home/cta-bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="banner-title">Contact Us</h2>
                    <!-- <div class="bread-crumbs">
                        <a href="index.html">Home</a> <span></span> Contact Us
                    </div> -->
                </div>
            </div>
        </div>
    </section>
    <!-- Banner End -->

    <!-- Contact Start -->
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="contact--info-area">
                        <h3 class="font-text-size-30px">Get in touch</h3>
                        <p class="font-text-size-16px">
                            Looking for help? Fill the form and start a new adventure.
                        </p>
                        <div class="single-info">
                            <h5>Headquaters</h5>
                            <p class="font-text-size-16px">
                                <i class="fas fa-home"></i> 744 New York Ave, Brooklyn, Kings,<br> New York 10224
                            </p>
                        </div>
                        <div class="single-info">
                            <h5>Phone</h5>
                            <p class="font-text-size-16px">
                                <i class="fas fa-phone-alt"></i> (+642) 245 356 432<br> (+420) 336 476 328
                            </p>
                        </div>
                        <div class="single-info">
                            <h5>Support</h5>
                            <p class="font-text-size-16px">
                                <i class="far fa-envelope"></i> bisy@support.com
                                <br> help@education.com
                            </p>
                        </div>
                        <div class="ab-social">
                            <h5>Follow Us</h5>
                            <a class="fac" href="#"><i class="fab fa-facebook-f line-height-text-3"></i></a>
                            <a class="twi" href="#"><i class="fab fa-twitter line-height-text-3"></i></a>
                            <a class="you" href="#"><i class="fab fa-youtube line-height-text-3"></i></a>
                            <a class="lin" href="#"><i class="fab fa-linkedin line-height-text-3"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="contact-form">
                        <h4>Let’s Connect</h4>
                        <p class="font-text-size-16px">Integer at lorem eget diam facilisis lacinia ac id massa.</p>
                        <form  method="post" class="row" action="{{ \App\Helpers\UrlGen::contact() }}">
                            <div class="col-md-6">
							<?php $firstNameError = (isset($errors) and $errors->has('first_name')) ? ' is-invalid' : ''; ?>
							<label for="first_name">{{ t('first_name') }}</label>
							<input id="first_name" name="first_name" type="text" placeholder="{{ t('first_name') }}"
												   class="form-control{{ $firstNameError }}" value="{{ old('first_name') }}">
											      
                            </div>
                            <div class="col-md-6">
							<?php $lastNameError = (isset($errors) and $errors->has('last_name')) ? ' is-invalid' : ''; ?>
							<label for="last_name">{{ t('last_name') }}</label>
							<input id="last_name" name="last_name" type="text" placeholder="{{ t('last_name') }}"
												   class="form-control{{ $lastNameError }}" value="{{ old('last_name') }}">
											
                            </div>
                            <div class="col-md-6">
							<?php $emailError = (isset($errors) and $errors->has('email')) ? ' is-invalid' : ''; ?>
							<label for="email">{{ t('email_address') }}</label>
							<input id="email" name="email" type="text" placeholder="{{ t('email_address') }}" class="form-control{{ $emailError }}"
												   value="{{ old('email') }}">
											
                            </div>
                            <div class="col-md-6">
							<label for="email">{{ ('Phone Number') }}</label>
                                <input type="number" name="phone" placeholder="Phone Number">
                            </div>
                            <div class="col-md-12">
						
                                <input type="text" name="suject" placeholder="Subject">
                            </div>
                            <div class="col-md-12">
							<?php $messageError = (isset($errors) and $errors->has('message')) ? ' is-invalid' : ''; ?>
							<label for="message">{{ t('Message') }}</label>
							<textarea class="form-control{{ $messageError }}" id="message" name="message" placeholder="{{ t('Message') }}"
													  rows="7" style="height: 150px">{{ old('message') }}</textarea>
											
                            </div>
                            <div class="col-md-6">
                                <!-- <div class="condition-check">
                                    <input id="terms-conditions" type="checkbox">
                                    <label for="terms-conditions">
                                            I agree to the <a href="#">Terms & Conditions</a>      
                                        </label>
                                </div> -->
                            </div>
                            <div class="col-md-6 text-right">
                                <input type="submit" name="submit" value="Send Message" class="contact-send-message">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact End -->

    <!-- Gamps Start -->
    <div class="bisylms-map">
        <iframe src="https://maps.google.com/maps?width=720&amp;height=600&amp;hl=en&amp;coord=39.966528,-75.158284&amp;q=1%20Grafton%20Street%2C%20Dublin%2C%20Ireland+(My%20Business%20Name)&amp;ie=UTF8&amp;t=p&amp;z=16&amp;iwloc=B&amp;output=embed"></iframe>
    </div>
    <!-- Gamps Start -->

    <!-- Footer Section Start -->
   
    <!-- Footer Section End -->

    <!-- Back To Top -->

    @includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.footer1', 'layouts.inc.footer1'])
    
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

@endsection

@section('after_styles')

@if (config('lang.direction') == 'rtl')
<!-- <link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet"> -->
@endif



@endsection

@section('after_scripts')