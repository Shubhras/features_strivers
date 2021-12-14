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

@section('content')
	@if (!(isset($paddingTopExists) and $paddingTopExists))
		<div class="p-0 mt-lg-4 mt-md-3 mt-3"></div>
	@endif
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
	<div class="main-container">
		<div class="container">

		<div class="row">

		<div class="w3-bar w3-black nav-tabs" id="myDIV" style="border-bottom:none;">
          <button class="w3-bar-item w3-button btn1 Strivers btn btn-primary" onclick="openCity('Strivers')">Strivers</button>
          <button class="w3-bar-item w3-button Coaches btn1  btn btn-danger" onclick="openCity('Coaches')">Coaches</button>
         
        </div>
		

		</div>
		
		<br>
		<div class="col-12" id="Coaches-Strivers-error" style ="display: none">
		<div class="alert alert-danger alert-dismissible fade show"  >
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
						Please Select <strong> Striver </strong> or <strong> Coach </strong>first.
						</div>
		</div>

		<div id="Strivers" class="w3-container city" >
			<div class="row">
			

			
				@if (isset($errors) && $errors->any())
				
					<div class="col-12">
						
						<div class="alert alert-danger alert-dismissible fade show">
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
				
				@if (session()->has('flash_notification'))
					<div class="col-12">
						@include('flash::message')
					</div>
				@endif
				
				<div class="col-md-8 page-content">
					<div class="inner-box">
						<h2 class="title-2">
							<strong><i class="fas fa-user-plus"></i> {{ t('create_your_account_it_is_stiver') }}</strong>
						</h2>
						
						@includeFirst([config('larapen.core.customizedViewPath') . 'auth.login.inc.social', 'auth.login.inc.social'])
						<?php $mtAuth = !socialLoginIsEnabled() ? ' mt-5' : ' mt-4'; ?>
						
						<div class="row{{ $mtAuth }}">
							<div class="col-xl-12">
								<form id="signupForm" class="form-horizontal" method="POST" action="{{ url()->current() }}">
									{!! csrf_field() !!}
									<fieldset>

										{{-- name --}}
										<?php $nameError = (isset($errors) and $errors->has('name')) ? ' is-invalid' : ''; ?>
										<div class="row mb-3 required">
											<label class="col-md-4 col-form-label">{{ t('Name') }} <sup>*</sup></label>
											<div class="col-md-6">
												<input name="name" placeholder="{{ t('Name') }}" class="form-control input-md{{ $nameError }}" type="text" value="{{ old('name') }}">


												<input name="user_type_id" class="form-control input-md{{ $nameError }}" type="hidden" id="user_type_striver" value="3">
											</div>
										</div>

										{{-- country_code --}}
										@if (empty(config('country.code')))
											<?php $countryCodeError = (isset($errors) and $errors->has('country_code')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-4 col-form-label{{ $countryCodeError }}" for="country_code">{{ t('your_country') }} <sup>*</sup></label>
												<div class="col-md-6">
													<select id="countryCode" name="country_code" class="form-control large-data-selecter{{ $countryCodeError }}">
														<option value="0" {{ (!old('country_code') or old('country_code')==0) ? 'selected="selected"' : '' }}>{{ t('Select') }}</option>
														@foreach ($countries as $code => $item)
															<option value="{{ $code }}" {{ (old('country_code', (!empty(config('ipCountry.code'))) ? config('ipCountry.code') : 0)==$code) ? 'selected="selected"' : '' }}>
																{{ $item->get('name') }}
															</option>
														@endforeach
													</select>
												</div>
											</div>
										@else
											<input id="countryCode" name="country_code" type="hidden" value="{{ config('country.code') }}">
										@endif

										@if (isEnabledField('phone'))
											{{-- phone --}}
											<?php $phoneError = (isset($errors) and $errors->has('phone')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-4 col-form-label">{{ t('phone') }}
													@if (!isEnabledField('email'))
														<sup>*</sup>
													@endif
												</label>
												<div class="col-md-6">
													<div class="input-group">
														<span id="phoneCountry" class="input-group-text">{!! getPhoneIcon(old('country', config('country.code'))) !!}</span>
														<input name="phone"
															   placeholder="{{ (!isEnabledField('email')) ? t('Mobile Phone Number') : t('phone_number') }}"
															   class="form-control input-md{{ $phoneError }}"
															   type="text"
															   value="{{ phoneFormat(old('phone'), old('country', config('country.code'))) }}"
														>
														<span class="input-group-text" data-bs-placement="top"
															  data-bs-toggle="tooltip"
															  title="{{ t('Hide the phone number on the ads') }}"
														>
																<input name="phone_hidden" id="phoneHidden" type="checkbox"
																	   value="1" {{ (old('phone_hidden')=='1') ? 'checked="checked"' : '' }}>&nbsp;<small>{{ t('Hide') }}</small>
															</span>
													</div>
												</div>
											</div>
										@endif
									
										@if (isEnabledField('email'))
											{{-- email --}}
											<?php $emailError = (isset($errors) and $errors->has('email')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-4 col-form-label" for="email">{{ t('email') }}
													@if (!isEnabledField('phone'))
														<sup>*</sup>
													@endif
												</label>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-text"><i class="fas fa-envelope"></i></span>
														<input id="email"
															   name="email"
															   type="email"
															   class="form-control{{ $emailError }}"
															   placeholder="{{ t('email') }}"
															   value="{{ old('email') }}"
														>
													</div>
												</div>
											</div>
										@endif
										
										@if (isEnabledField('username'))
											{{-- username --}}
											<?php $usernameError = (isset($errors) and $errors->has('username')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-4 col-form-label" for="email">{{ t('Username') }}</label>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-text"><i class="fas fa-user"></i></span>
														<input id="username"
															   name="username"
															   type="text"
															   class="form-control{{ $usernameError }}"
															   placeholder="{{ t('Username') }}"
															   value="{{ old('username') }}"
														>
													</div>
												</div>
											</div>
										@endif
										
										{{-- password --}}
										<?php $passwordError = (isset($errors) and $errors->has('password')) ? ' is-invalid' : ''; ?>
										<div class="row mb-3 required">
											<label class="col-md-4 col-form-label" for="password">{{ t('password') }} <sup>*</sup></label>
											<div class="col-md-6">
												<div class="input-group show-pwd-group mb-2">
													<input id="password" name="password" type="password" class="form-control{{ $passwordError }}" placeholder="{{ t('password') }}" autocomplete="off">
													<span class="icon-append show-pwd">
														<button type="button" class="eyeOfPwd">
															<i class="far fa-eye-slash"></i>
														</button>
													</span>
												</div>
												<input id="password_confirmation" name="password_confirmation" type="password" class="form-control{{ $passwordError }}"
													   placeholder="{{ t('Password Confirmation') }}" autocomplete="off">
												<div class="form-text text-muted">
													{{ t('at_least_num_characters', ['num' => config('larapen.core.passwordLength.min', 6)]) }}
												</div>
											</div>
										</div>
										
										@include('layouts.inc.tools.captcha', ['colLeft' => 'col-md-4', 'colRight' => 'col-md-6'])
										
										{{-- accept_terms --}}
										<?php $acceptTermsError = (isset($errors) and $errors->has('accept_terms')) ? ' is-invalid' : ''; ?>
										<div class="row mb-1 required">
											<label class="col-md-4 col-form-label"></label>
											<div class="col-md-6">
												<div class="form-check">
													<input name="accept_terms" id="acceptTerms"
														   class="form-check-input{{ $acceptTermsError }}"
														   value="1"
														   type="checkbox" {{ (old('accept_terms')=='1') ? 'checked="checked"' : '' }}
													>
													
													<label class="form-check-label" for="acceptTerms" style="font-weight: normal;">
														{!! t('accept_terms_label', ['attributes' => getUrlPageByType('terms')]) !!}
													</label>
												</div>
												<div style="clear:both"></div>
											</div>
										</div>
										
										{{-- accept_marketing_offers --}}
										<?php $acceptMarketingOffersError = (isset($errors) and $errors->has('accept_marketing_offers')) ? ' is-invalid' : ''; ?>
										<div class="row mb-3 required">
											<label class="col-md-4 col-form-label"></label>
											<div class="col-md-6">
												<div class="form-check">
													<input name="accept_marketing_offers" id="acceptMarketingOffers"
														   class="form-check-input{{ $acceptMarketingOffersError }}"
														   value="1"
														   type="checkbox" {{ (old('accept_marketing_offers')=='1') ? 'checked="checked"' : '' }}
													>
													
													<label class="form-check-label" for="acceptMarketingOffers" style="font-weight: normal;">
														{!! t('accept_marketing_offers_label') !!}
													</label>
												</div>
												<div style="clear:both"></div>
											</div>
										</div>

										{{-- Button  --}}
										<div class="row">
											<label class="col-md-4 col-form-label"></label>
											<div class="col-md-6">
												<button id="signupBtn" class="btn btn-success btn-lg"> {{ t('register') }} </button>
											</div>
										</div>

										<div class="mb-4"></div>

									</fieldset>
								</form>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4 reg-sidebar">
					<div class="reg-sidebar-inner text-center">
						<div class="promo-text-box">
							<i class="far fa-image fa-4x icon-color-1"></i>
							<h3><strong>{{ t('post_a_classified_ad') }}</strong></h3>
							<p>
								{{ t('do_you_have_something_text', ['appName' => config('app.name')]) }}
							</p>
						</div>
						<div class="promo-text-box">
							<i class="fas fa-pen-square fa-4x icon-color-2"></i>
							<h3><strong>{{ t('create_and_manage_items') }}</strong></h3>
							<p>{{ t('become_a_best_seller_or_buyer_text') }}</p>
						</div>
						<div class="promo-text-box"><i class="fas fa-heart fa-4x icon-color-3"></i>
							<h3><strong>{{ t('create_your_favorite_ads_list') }}</strong></h3>
							<p>{{ t('create_your_favorite_ads_list_text') }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>





		<div id="Coaches" class="w3-container city" style="display:none;">
			<div class="row">
				

			
				@if (isset($errors) && $errors->any())
					<div class="col-12">
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
				
				@if (session()->has('flash_notification'))
					<div class="col-12">
						@include('flash::message')
					</div>
				@endif
				
				<div class="col-md-8 page-content">
					<div class="inner-box">
						<h2 class="title-2">
							<strong><i class="fas fa-user-plus"></i> {{ t('create_your_account_it_is_coach') }}</strong>
						</h2>
						
						@includeFirst([config('larapen.core.customizedViewPath') . 'auth.login.inc.social', 'auth.login.inc.social'])
						<?php $mtAuth = !socialLoginIsEnabled() ? ' mt-5' : ' mt-4'; ?>
						
						<div class="row{{ $mtAuth }}">
							<div class="col-xl-12">
								<form id="signupForm" class="form-horizontal" method="POST" action="{{ url()->current() }}">
									{!! csrf_field() !!}
									<fieldset>

										{{-- name --}}
										<?php $nameError = (isset($errors) and $errors->has('name')) ? ' is-invalid' : ''; ?>
										<div class="row mb-3 required">
											<label class="col-md-4 col-form-label">{{ t('Name') }} <sup>*</sup></label>
											<div class="col-md-6">
											
												<input name="name" placeholder="{{ t('Name') }}" class="form-control input-md{{ $nameError }}" type="text" value="{{ old('name') }}">

												<input name="user_type_id" placeholder="{{ t('Name') }}" class="form-control input-md{{ $nameError }}" type="hidden" id="user_type_coach" value="2">
											</div>
										</div>

										{{-- country_code --}}
										@if (empty(config('country.code')))
											<?php $countryCodeError = (isset($errors) and $errors->has('country_code')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-4 col-form-label{{ $countryCodeError }}" for="country_code">{{ t('your_country') }} <sup>*</sup></label>
												<div class="col-md-6">
													<select id="countryCode" name="country_code" class="form-control large-data-selecter{{ $countryCodeError }}">
														<option value="0" {{ (!old('country_code') or old('country_code')==0) ? 'selected="selected"' : '' }}>{{ t('Select') }}</option>
														@foreach ($countries as $code => $item)
															<option value="{{ $code }}" {{ (old('country_code', (!empty(config('ipCountry.code'))) ? config('ipCountry.code') : 0)==$code) ? 'selected="selected"' : '' }}>
																{{ $item->get('name') }}
															</option>
														@endforeach
													</select>
												</div>
											</div>
										@else
											<input id="countryCode" name="country_code" type="hidden" value="{{ config('country.code') }}">
										@endif

										@if (isEnabledField('phone'))
											{{-- phone --}}
											<?php $phoneError = (isset($errors) and $errors->has('phone')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-4 col-form-label">{{ t('phone') }}
													@if (!isEnabledField('email'))
														<sup>*</sup>
													@endif
												</label>
												<div class="col-md-6">
													<div class="input-group">
														<span id="phoneCountry" class="input-group-text">{!! getPhoneIcon(old('country', config('country.code'))) !!}</span>
														<input name="phone"
															   placeholder="{{ (!isEnabledField('email')) ? t('Mobile Phone Number') : t('phone_number') }}"
															   class="form-control input-md{{ $phoneError }}"
															   type="text"
															   value="{{ phoneFormat(old('phone'), old('country', config('country.code'))) }}"
														>
														<span class="input-group-text" data-bs-placement="top"
															  data-bs-toggle="tooltip"
															  title="{{ t('Hide the phone number on the ads') }}"
														>
																<input name="phone_hidden" id="phoneHidden" type="checkbox"
																	   value="1" {{ (old('phone_hidden')=='1') ? 'checked="checked"' : '' }}>&nbsp;<small>{{ t('Hide') }}</small>
															</span>
													</div>
												</div>
											</div>
										@endif
									
										@if (isEnabledField('email'))
											{{-- email --}}
											<?php $emailError = (isset($errors) and $errors->has('email')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-4 col-form-label" for="email">{{ t('email') }}
													@if (!isEnabledField('phone'))
														<sup>*</sup>
													@endif
												</label>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-text"><i class="fas fa-envelope"></i></span>
														<input id="email"
															   name="email"
															   type="email"
															   class="form-control{{ $emailError }}"
															   placeholder="{{ t('email') }}"
															   value="{{ old('email') }}"
														>
													</div>
												</div>
											</div>
										@endif
										
										@if (isEnabledField('username'))
											{{-- username --}}
											<?php $usernameError = (isset($errors) and $errors->has('username')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-4 col-form-label" for="email">{{ t('Username') }}</label>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-text"><i class="fas fa-user"></i></span>
														<input id="username"
															   name="username"
															   type="text"
															   class="form-control{{ $usernameError }}"
															   placeholder="{{ t('Username') }}"
															   value="{{ old('username') }}"
														>
													</div>
												</div>
											</div>
										@endif
										
										{{-- password --}}
										<?php $passwordError = (isset($errors) and $errors->has('password')) ? ' is-invalid' : ''; ?>
										<div class="row mb-3 required">
											<label class="col-md-4 col-form-label" for="password">{{ t('password') }} <sup>*</sup></label>
											<div class="col-md-6">
												<div class="input-group show-pwd-group mb-2">
													<input id="password" name="password" type="password" class="form-control{{ $passwordError }}" placeholder="{{ t('password') }}" autocomplete="off">
													<span class="icon-append show-pwd">
														<button type="button" class="eyeOfPwd">
															<i class="far fa-eye-slash"></i>
														</button>
													</span>
												</div>
												<input id="password_confirmation" name="password_confirmation" type="password" class="form-control{{ $passwordError }}"
													   placeholder="{{ t('Password Confirmation') }}" autocomplete="off">
												<div class="form-text text-muted">
													{{ t('at_least_num_characters', ['num' => config('larapen.core.passwordLength.min', 6)]) }}
												</div>
											</div>
										</div>
										
										@include('layouts.inc.tools.captcha', ['colLeft' => 'col-md-4', 'colRight' => 'col-md-6'])
										
										{{-- accept_terms --}}
										<?php $acceptTermsError = (isset($errors) and $errors->has('accept_terms')) ? ' is-invalid' : ''; ?>
										<div class="row mb-1 required">
											<label class="col-md-4 col-form-label"></label>
											<div class="col-md-6">
												<div class="form-check">
													<input name="accept_terms" id="acceptTerms"
														   class="form-check-input{{ $acceptTermsError }}"
														   value="1"
														   type="checkbox" {{ (old('accept_terms')=='1') ? 'checked="checked"' : '' }}
													>
													
													<label class="form-check-label" for="acceptTerms" style="font-weight: normal;">
														{!! t('accept_terms_label', ['attributes' => getUrlPageByType('terms')]) !!}
													</label>
												</div>
												<div style="clear:both"></div>
											</div>
										</div>
										
										{{-- accept_marketing_offers --}}
										<?php $acceptMarketingOffersError = (isset($errors) and $errors->has('accept_marketing_offers')) ? ' is-invalid' : ''; ?>
										<div class="row mb-3 required">
											<label class="col-md-4 col-form-label"></label>
											<div class="col-md-6">
												<div class="form-check">
													<input name="accept_marketing_offers" id="acceptMarketingOffers"
														   class="form-check-input{{ $acceptMarketingOffersError }}"
														   value="1"
														   type="checkbox" {{ (old('accept_marketing_offers')=='1') ? 'checked="checked"' : '' }}
													>
													
													<label class="form-check-label" for="acceptMarketingOffers" style="font-weight: normal;">
														{!! t('accept_marketing_offers_label') !!}
													</label>
												</div>
												<div style="clear:both"></div>
											</div>
										</div>

										{{-- Button  --}}
										<div class="row">
											<label class="col-md-4 col-form-label"></label>
											<div class="col-md-6">
												<button id="signupBtn" class="btn btn-success btn-lg"> {{ t('register') }} </button>
											</div>
										</div>

										<div class="mb-4"></div>

									</fieldset>
								</form>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4 reg-sidebar">
					<div class="reg-sidebar-inner text-center">
						<div class="promo-text-box">
							<i class="far fa-image fa-4x icon-color-1"></i>
							<h3><strong>{{ t('post_a_classified_ad') }}</strong></h3>
							<p>
								{{ t('do_you_have_something_text', ['appName' => config('app.name')]) }}
							</p>
						</div>
						<div class="promo-text-box">
							<i class="fas fa-pen-square fa-4x icon-color-2"></i>
							<h3><strong>{{ t('create_and_manage_items') }}</strong></h3>
							<p>{{ t('become_a_best_seller_or_buyer_text') }}</p>
						</div>
						<div class="promo-text-box"><i class="fas fa-heart fa-4x icon-color-3"></i>
							<h3><strong>{{ t('create_your_favorite_ads_list') }}</strong></h3>
							<p>{{ t('create_your_favorite_ads_list_text') }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br>
	</div>
@endsection

@section('after_scripts')
	<script>
		$(document).ready(function () {
			/* Submit Form */
			document.getElementById("user_type_coach").value = 0;
			document.getElementById("user_type_striver").value = 0;
			
		});
	</script>
	

<script>
	var flag = false;
	console.log(flag);
  function openCity(cityName) {
	//   console.log(cityName,	'lovekush');
	if(cityName == 'Strivers'){
		document.getElementById("user_type_striver").value = 3;
		document.getElementById('Coaches-Strivers-error').style.display = "none ";
		// console.log(cityName);
		// $('#signupForm').attr( 'flag','true');
		// var flag1 = $('#signupForm').attr('flag');
		// console.log(flag1);
		// alert(flag);
		flag = true;
		console.log(flag);

	}
	if(cityName == 'Coaches'){
		document.getElementById("user_type_coach").value = 2;
		document.getElementById('Coaches-Strivers-error').style.display = "none ";
		// console.log(cityName);
		// $('#signupForm').attr( 'flag','true');
		// var flag1 = $('#signupForm').attr('flag');
		// console.log(flag1);
		flag = true;
		console.log(flag);

	}
    sessionStorage.setItem('tabName',cityName);
  var i = 0;
  var x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none"; 

  }
//   var defaultCountryCode = 'individual';
//   switch (cityName) {
//     case 'Coaches':
//       defaultCountryCode = 'garage';
//       break;
    
//     case 'Strivers':
//       defaultCountryCode = 'individual';
//     break;
//     default:
//       defaultCountryCode = 'individual';
//     break;
//   }
  document.getElementById(cityName).style.display = "block"; 
//   changeCountryCode(defaultCountryCode);
}

var header = document.getElementById("myDIV");
var btns = header.getElementsByClassName("btn1");
for (var j = 0; j < btns.length; j++) {
  btns[j].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  if (current.length > 1) { 
    current[1].className = current[1].className.replace("active", "");
  }
  this.className += " active";
  });
}


</script>
<script>
		$(document).ready(function () {
			/* Submit Form */
			
			$("#signupBtn").click(function () {
				// alert ('Please select Coach or Striver');
			
				if(flag == false){
					// alert('hello');
					document.getElementById('Coaches-Strivers-error').style.display = "block ";
					return false;
				}
				
				else	{
					// console.log('hello there');
					// alert("hello");	
				$("#signupForm").submit();
				return true;
				}
			});
			


		});
	</script>
@endsection