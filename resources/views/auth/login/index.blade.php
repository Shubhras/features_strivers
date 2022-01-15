@extends('layouts.master')
<!DOCTYPE html>
<html lang="en">

<head>
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
</head>

<body>

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
    <section class="contact-section">
        <div class="container">
		@if (isset($errors) && $errors->any())
					<div class="col-12">
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ t('Close') }}"></button>
							<ul class="list list-check">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					</div>
				@endif
				@if (session()->has('flash_notification'))
					<div class="col-12">
						@include('flash::message')
					</div>
				@endif
            <div class="col-md-8 d-flex justify-content-center">
                <div class="contact-form dform">
                    <center><h4>Login</h4></center>
					<?php $mtAuth = !socialLoginIsEnabled() ? ' mt-2' : ' mt-1'; ?>
                    <form id="loginForm" role="form" method="POST" action="{{ url()->current() }}"class="row">
					{!! csrf_field() !!}
                        <div class="col-md-12">
						<?php
									$loginValue = (session()->has('login')) ? session('login') : old('login');
									$loginField = getLoginField($loginValue);
									if ($loginField == 'phone') {
										$loginValue = phoneFormat($loginValue, old('country', config('country.code')));
									}
								?>
								{{-- login --}}
								<?php $loginError = (isset($errors) && $errors->has('login')) ? ' is-invalid' : ''; ?>
								<label for="login" class="col-form-label">{{ t('login') . ' (' . getLoginLabel() . ')' }}:</label>
									<div class="input-group">
										
										<input id="login" name="login" type="text" placeholder="{{ getLoginLabel() }}" class="form-control{{ $loginError }}" value="{{ $loginValue }}">
									</div>
                        </div>
						{{-- password --}}
                        <div class="col-md-12">
					
								<?php $passwordError = (isset($errors) && $errors->has('password')) ? ' is-invalid' : ''; ?>
								<label for="password" class="col-form-label">{{ t('password') }}:</label>
									<div class="input-group show-pwd-group">
										
										<input id="password" name="password" type="password" class="form-control{{ $passwordError }}" placeholder="{{ t('password') }}" autocomplete="off">
										
									</div>
                        </div>
                        <div class="col-md-6">
						<label class="checkbox float-start mt-2 mb-2">
						<label for="vehicle1">
									<input type="checkbox" value="1" name="remember" id="remember">
									Remember me</label>
									
								</label>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="check">
                                <label><a href="{{ url('password/reset') }}">Forgot Password</a><a href="{{ \App\Helpers\UrlGen::register() }}">/Sign Up </a> 
								    
                                    </label>
                            </div>
                        </div>
                        <br>
                        <br>
                            <div class="col-md-6 text-right">
                                <a class="b-btn bisylms-btn"  type="reset" href="">Cancel</a>
                            </div>
                            <div class="col-md-6 text-left">
							<button id="loginBtn" class="b-btn bisylms-btn"> {{ t('log_in') }} </button>
                            </div>
                            <div class="col-sm-12">
                                <center><button class="loginBtn loginBtn--google btn-primary1">
                                Login with Google
                              </button>  </center>
                              </div>
                              <br>
                              <br>
                              <div class="col-sm-12">
                              <center><button class="loginBtn loginBtn--facebook btn-primary1">
                                    Login with Facebook
                                  </button>
                                </center>
                                </div>
                        <!-- <center>
                            <div class="col-md-12>
                        <div class="col-md-3">
                            <input type="submit" name="submit" value="Send Message">
                        </div> -->
                    </form>
                </div>
            </div>
                    </div>


            
        
    </section>
	<script>
		$(document).ready(function () {
			$("#loginBtn").click(function () {
				$("#loginForm").submit();
				return false;
			});
		});
	</script>
    <!-- Course Section End -->

    <!-- Footer Section Start -->
   
    <!-- Footer Section End -->

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

</body>

</html>