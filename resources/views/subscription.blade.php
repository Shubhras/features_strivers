{{--
 * LaraClassifier - Classified Ads Web Application
 * Copyright (c) BeDigit. All Rights Reserved
 *
 * Website: https://laraclassifier.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from CodeCanyon,
 * Please read the full License from here - http://codecanyon.net/licenses/standard
--}}
@extends('layouts.master')
<style>
    .alert {
    display:none;
}
.card-header > p {
    max-width: 800px;
    text-align: center;
    margin: auto;
    line-height: 2.8;
}
</style>

@section('content')
<div class="main-container">


	<div class="container">
    <div class="inner-box default-inner-box1" style="height: 150px; background-color:9FC5F8;">
        <h2 style="text-align:center;">A global learning platform for all</h2>
    </div>
                        <div class="card card-default">
                            <div class="card-header">
								<p style="font-family: Times New Roman;">unlimited access to 6000+ top courses selected-any time,on any device</p><p>Fresh contant tought by global instructor- for any learning style</p><p>Actionable learning insight and functionalty </p>
                            </div>
                        </div>
		
	</div>
    
</div>

	

<!-- pricing section  -->


   
   <?php
	$addListingUrl = (isset($addListingUrl)) ? $addListingUrl : \App\Helpers\UrlGen::addPost();
	$addListingAttr = '';
	if (!auth()->check()) {
		if (config('settings.single.guests_can_post_ads') != '1') {
			$addListingUrl = '#quickLogin';
			$addListingAttr = ' data-bs-toggle="modal"';
		}
	}
?>
	@includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'])
	<div class="main-container inner-page">
		<div class="container" id="pricing">
			
			<h1 class="text-center title-1" style="text-transform: none;">
				<strong>{{ 'Choose a plan for after your 7- day Free Trial' }}</strong>
			</h1>
			<hr class="center-block small mt-0">
			
			
			
			<div class="row mt-5 mb-md-5 justify-content-center">

						@if ($packages->count() > 0)
						@foreach($packages as $package)
						<?php
						$boxClass = ($package->recommended == 1) ? ' border-color-primary' : '';
						$boxHeaderClass = ($package->recommended == 1) ? ' bg-primary border-color-primary text-white' : '';
						$boxBtnClass = ($package->recommended == 1) ? ' btn-primary' : ' btn-outline-primary';
						?>
						<div class="col-md-4">
							<div class="card mb-4 box-shadow{{ $boxClass }}">
								<div class="card-header text-center{{ $boxHeaderClass }}">
									<h4 class="my-0 fw-normal pb-0 h4">{{ $package->short_name }}</h4>
								</div>
								<div class="card-body">
									<h1 class="text-center">
										<span class="fw-bold">
											@if ($package->currency->in_left == 1)
											{!! $package->currency->symbol !!}
											@endif
											{{ \App\Helpers\Number::format($package->price) }}
											@if ($package->currency->in_left == 0)
											{!! $package->currency->symbol !!}
											@endif
										</span>
										<small class="text-muted">/{{ $package->duration }} {{ t('hours') }}</small>
									</h1>
									<ul class="list list-border text-center mt-3 mb-4">
										@if (is_array($package->description_array) and count($package->description_array) >
										0)
										@foreach($package->description_array as $option)
										<li>{!! $option !!}</li>
										@endforeach
										@else
										<li> *** </li>
										@endif
									</ul>
									<?php
									$pricingUrl = '';
									if (\Illuminate\Support\Str::startsWith($addListingUrl, '#')) {
										$pricingUrl = '' . $addListingUrl;
									} else {
										$pricingUrl = $addListingUrl . '?package=' . $package->id;
									}
									?>
									<!-- <a href="{{ $pricingUrl }}" class="btn btn-lg btn-block{{ $boxBtnClass }}" {!! $addListingAttr !!}>
										{{ t('get_started') }}
									</a> -->
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
										<!-- <input type="hidden" value="redirect to plan" name="loginRedirect"> -->

										<button type='submit' onclick = "customSession()"
											class="btn btn-lg btn-block{{ $boxBtnClass }}">{{ t('get_started') }}</button>
									</form>
									<!-- <script>
										function customSession (){
											<?php
												//Session::put('loginRedirectToken', 1);
											?>
										}
									</script> -->

								</div>
							</div>
						</div>
						@endforeach
						@else
						<div class="col-md-6 col-sm-12 text-center">
							<div class="card bg-light">
								<div class="card-body">
									{{ t('no_package_available') }}
								</div>
							</div>
						</div>
						@endif
						</div>
			
		</div>
	</div>
@endsection

@section('after_styles')
@endsection

@section('after_scripts')
@endsection
	