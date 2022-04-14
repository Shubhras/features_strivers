<style>
	.alert {
		display: none;
	}
</style>

<link rel="icon" type="image/png" href="../assets/images/favicon.png">
<!-- Favicon Icon -->
@extends('layouts.master_new')
@section('content')


<section class="page-banner01" style="background-image: url(assets/images/home/cta-bg.jpg);">
 </section>

<section class="blog-section64">
<br><br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="hero-content_h2 font-text-size-43px"> A global learning platform for all</h2> <br>
				<div>
					<!-- <a href=""> A global learning platform for all </a> -->
					<p class="global_page font-text-size-16px">
						Unlimited access to 6,000+ top courses selected – anytime, on any device Fresh content taught by global instructors – for any learning style
						Actionable learning insights and admin functionality
					</p>
				</div>
			</div>
		</div>
	</div>
     <br><br>
	<!-- </section>     -->
	<div class="main-section-new_pricing">

		<div class="container">



			<section class="elementor-section elementor-inner-section elementor-element elementor-element-5f6ccbf elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="5f6ccbf" data-element_type="section">
				<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-row">
						<br>

						<h2 class="h22 font-text-size-30px"> Choose a plan for after your 7-day Free trial</h2><br><br>


						<div class="row">

							@if ($packages->count() > 0)
							@foreach($packages as $package)

							@if($package->id == 1)
							<div class="col-md-4">
								<div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-ce12637" data-id="ce12637" data-element_type="column">
									<div class="elementor-column-wrap elementor-element-populated">
										<div class="elementor-widget-wrap">
											<div class="elementor-element elementor-element-0d16013 elementor-widget elementor-widget-bisy-pricing" data-id="0d16013" data-element_type="widget" data-widget_type="bisy-pricing.default">
												<div class="elementor-widget-container">





													<div class="pricing-item">
														<h4>{{ $package->short_name}}</h4>
														<img src="../assets/images/basic-1.svg" alt="Basic">
														<div class="p-price">
															<sup> $ </sup> {{$package->price}} <span>GET {{$package->duration}} CREDITS </span>
														</div>
														<ul>

															<li><i class="icon_check"></i> Access to 25 courses
															</li>

															<li><i class="icon_check"></i> Course Discussions </li>

															<li class="disable"><i class="icon_check"></i> Offline Viewing </li>

															<li class="disable"><i class="icon_check"></i> Certificate after completion </li>

															<li class="disable"><i class="icon_check"></i> Private sessions </li>


														</ul>
														<?php
														$pricingUrl = '';
														if (\Illuminate\Support\Str::startsWith($addListingUrl, '#')) {
															$pricingUrl = '' . $addListingUrl;
														} else {
															$pricingUrl = $addListingUrl . '?package=' . $package->id;
														}
														?>

														<?php
														$price_total = $package->price;
														$subscriptionPlan = $package->id;
														$totalHours = $package->duration;

														// $var = $price_total;
														// $var = (int)$var;

														// print_r($var);
														?>
														<form action="payment" method="POST">
															@csrf
															<input type="hidden" value={{$price_total}} name="price">
															<input type="hidden" value={{$subscriptionPlan}} name="subscriptionPlan">
															<input type="hidden" value={{$totalHours}} name="totalHours">

															<?php if(!empty($courseId)){?>
															<input type="hidden" value={{$courseId}} name="courseId">

															<?php }?>

															

															<!-- <input type="hidden" value="redirect to plan" name="loginRedirect"> -->
															<button type='submit' onclick="customSession()" class="bisylms-btn-2">{{ t('get_started') }}</button>

														</form>
														<!-- <a href="strivre-sign-up.html" type='submit' class="bisylms-btn-2" onclick = "customSession()"> Get Started </a> -->
													</div>

												</div>
											</div>

										</div>
									</div>
								</div>


							</div>
							@endif
							@if($package->id == 2)
							<div class="col-md-4">

								<div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-420f690" data-id="420f690" data-element_type="column">
									<div class="elementor-column-wrap elementor-element-populated">
										<div class="elementor-widget-wrap">
											<div class="elementor-element elementor-element-2ed0c0c elementor-widget elementor-widget-bisy-pricing" data-id="2ed0c0c" data-element_type="widget" data-widget_type="bisy-pricing.default">
												<div class="elementor-widget-container">



													<div class="pricing-item">
														<h4>{{ $package->short_name}}</h4>
														<img src="../assets/images/Standerd-3.svg" alt="Standard">
														<div class="p-price">
															<sup> $ </sup> {{$package->price}}
															<span> GET {{$package->duration}} CREDITS </span>
														</div>
														<ul>

															<li><i class="icon_check"></i> Access to 45 courses
															</li>

															<li><i class="icon_check"></i> Course Discussions </li>

															<li><i class="icon_check"></i> Offline Viewing </li>

															<li class="disable"><i class="icon_check"></i> Certificate after completion </li>

															<li class="disable"><i class="icon_check"></i> Private sessions </li>


														</ul>
														<?php
														$pricingUrl = '';
														if (\Illuminate\Support\Str::startsWith($addListingUrl, '#')) {
															$pricingUrl = '' . $addListingUrl;
														} else {
															$pricingUrl = $addListingUrl . '?package=' . $package->id;
														}
														?>

														<?php
														$price_total = $package->price;
														$subscriptionPlan = $package->id;
														$totalHours = $package->duration;

														// $var = $price_total;
														// $var = (int)$var;

														// print_r($var);
														?>
														<form action="payment" method="POST">
															@csrf
															<input type="hidden" value={{$price_total}} name="price">
															<input type="hidden" value={{$subscriptionPlan}} name="subscriptionPlan">
															<input type="hidden" value={{$totalHours}} name="totalHours">

															<?php if(!empty($courseId)){?>
															<input type="hidden" value={{$courseId}} name="courseId">

															<?php }?>
															<!-- <input type="hidden" value="redirect to plan" name="loginRedirect"> -->
															<button type='submit' onclick="customSession()" class="bisylms-btn-2">{{ t('get_started') }}</button>

														</form>

														<!-- <a href="strivre-sign-up.html" class="bisylms-btn-2"> Get Started </a> -->
													</div>
												</div>

											</div>

										</div>
									</div>
								</div>



							</div>
							@endif
							@if($package->id == 3)
							<div class="col-md-4">

								<div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-d939cb6 elementor-hidden-tablet" data-id="d939cb6" data-element_type="column">
									<div class="elementor-column-wrap elementor-element-populated">
										<div class="elementor-widget-wrap">
											<div class="elementor-element elementor-element-f49e080 elementor-widget elementor-widget-bisy-pricing" data-id="f49e080" data-element_type="widget" data-widget_type="bisy-pricing.default">
												<div class="elementor-widget-container">



													<div class="pricing-item">
														<h4>{{$package->short_name}}</h4>
														<img src="../assets/images/Premium-2.svg" alt="Platinum">
														<div class="p-price">
															<sup> $ </sup> {{$package->price}}
															<span> GET {{$package->duration}} CREDITS </span>
														</div>
														<ul>

															<li><i class="icon_check"></i> Access to all courses
															</li>

															<li><i class="icon_check"></i> Course Discussions </li>

															<li><i class="icon_check"></i> Offline Viewing </li>

															<li><i class="icon_check"></i> Certificate after completion
															</li>

															<li><i class="icon_check"></i> Private sessions </li>


														</ul>
														<?php
														$pricingUrl = '';
														if (\Illuminate\Support\Str::startsWith($addListingUrl, '#')) {
															$pricingUrl = '' . $addListingUrl;
														} else {
															$pricingUrl = $addListingUrl . '?package=' . $package->id;
														}
														?>

														<?php
														$price_total = $package->price;
														$subscriptionPlan = $package->id;
														$totalHours = $package->duration;

														// $var = $price_total;
														// $var = (int)$var;

														// print_r($var);
														?>
														<form action="payment" method="POST">
															@csrf
															<input type="hidden" value={{$price_total}} name="price">
															<input type="hidden" value={{$subscriptionPlan}} name="subscriptionPlan">
															<input type="hidden" value={{$totalHours}} name="totalHours">
															<?php if(!empty($courseId)){?>
															<input type="hidden" value={{$courseId}} name="courseId">

															<?php }?>
															<!-- <input type="hidden" value="redirect to plan" name="loginRedirect"> -->
															<button type='submit' onclick="customSession()" class="bisylms-btn-2">{{ t('get_started') }}</button>

														</form>
														<!-- <a href="strivre-sign-up.html" class="bisylms-btn-2"> Get Started </a> -->
													</div>
												</div>

											</div>

										</div>
									</div>
								</div>

							</div>
							@endif
							@endforeach
							@endif

						</div>

			</section>
		</div>
	</div>
</section>


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
<style>
	.h22 {
		color: white !important;
		text-align: center;
		font-size: 25px;
		/* padding: -32px!important; */
	}
</style>

<style>
	.fa,
	.fab,
	.fad,
	.fal,
	.far,
	.fas {
		-moz-osx-font-smoothing: grayscale;
		-webkit-font-smoothing: antialiased;
		display: inline-block;
		font-style: normal;
		font-variant: normal;
		text-rendering: auto;
		line-height: 3;
	}

	.fab {
		font-family: "Font Awesome 5 Brands";
	}

	.fab,
	.far {
		font-weight: 400;
	}
</style>
@endsection

@section('after_styles')

@if (config('lang.direction') == 'rtl')
<!-- <link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet"> -->
@endif



@endsection

@section('after_scripts')