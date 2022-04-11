<style>
		.fix-header {
    background: #012245;
    left: 0;
    position: fixed;
    right: 0;
    top: -1px;
    width: 100%;
    z-index: 999;
    transition: all 0.1s ease-out;
    box-shadow: 0px 6px 10px 0px rgb(11 2 55 / 6%);
}
	</style>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css" />

<section class="page-banner01" style="background-image: url(../assets/images/home/cta-bg.jpg);">
       
 </section>

@extends('layouts.master_new')
@section('content')
	@includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'])

	
<section style="background-color: white;">
	 <div class="main-container" >
		<div class="container">

		<?php $photo_url1 =ltrim($user->photo_url, 'http://127.0.0.1:8000'); ?>


			<?php if($user->user_type_id == 2){ ?>


				<h2>

<h2 class="sec-title">My Profile</h2>
</h2>

			<div class="row" style="padding: 6px; margin-left: -4px;">
			
			
				<div class="col-md-12 user-profile-img-data default-inner-box">

					<img id="userImg" class="user-profile-images1" src="{{ url($photo_url1) }}" alt="user" width="50px;" height="50px;" border-radius=" 50%"> &nbsp; 
					<span style="font-size: 24px; font-weight: 700; color: #2c234d;">   <b>  {{ $user->name }}</b> </span>
				

				<div class="row">
				   
					<div class="col-md-12 col-sm-8 col-12">
					<span>

					
						<div class="header-data text-center-xs">
							{{-- Threads Stats --}}
							<div class="hdata">
							<a href="{{ url('account/messages') }}">

								<div class="mcol-left">
									<i class="fas fa-phone-alt ln-shadow"></i>
								</div>
								<div class="mcol-right">
									{{-- Number of messages --}}
									<p>
										
											{{ isset($countThreads) ? \App\Helpers\Number::short($countThreads) : 0 }}
										   
											<em>{{ trans_choice('Call', getPlural($countThreads), [], config('app.locale')) }}</em>
									   
									</p>
								</div>
								</a>
								<div class="clearfix"></div>
							</div>

							{{-- Traffic Stats --}}
							<div class="hdata">
							<a href="{{ url('account/chat') }}">
								<div class="mcol-left">
									<i class="fas fa-comments ln-shadow"></i>
								</div>
								<div class="mcol-right">
									{{-- Number of visitors --}}
									<p>
										
											<?php $totalPostsVisits = (isset($countPostsVisits) and $countPostsVisits->total_visits) ? $countPostsVisits->total_visits : 0 ?>
											{{ \App\Helpers\Number::short($totalPostsVisits) }}
								
											<em>{{ trans_choice('Chat', getPlural($totalPostsVisits), [], config('app.locale')) }}</em>
									   
									</p>
								</div>

								</a>
								<div class="clearfix"></div>
							</div>

						   

							{{-- Favorites Stats --}}
							<div class="hdata" style="width: 151px!important;margin-left: -38px;">
							<a href="{{ url('account/favourite') }}">
								<div class="mcol-left" >
									<i class="fas fa-bell ln-shadow" style="margin-left: 29px"></i>
								</div>
								<div class="mcol-right">
									{{-- Number of favorites --}}
									<p>
										
											{{ \App\Helpers\Number::short($countFavoritePosts) }}
											<em>{{ trans_choice('Notification', getPlural($countFavoritePosts), [], config('app.locale')) }} </em>
									   
									</p>
								</div>
								</a>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				
			    </div>

		      </div>
        </div>



<div class="row">

         <div class="col-md-3 page-sidebar ptop">

		 
					@includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar_coach', 'account.inc.sidebar_coach'])
		
		 </div>

		 <div class="col-md-9 page-content ptop">

					@include('flash::message')

					@if (isset($errors) && $errors->any())
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ t('Close') }}"></button>
							<h5><strong>{{ t('oops_an_error_has_occurred') }}</strong></h5>
							<ul class="list list-check">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					
					<div id="avatarUploadError" class="center-block" style="width:100%; display:none"></div>
					<div id="avatarUploadSuccess" class="alert alert-success fade show" style="display:none;"></div>
					
					

					<div class="inner-box default-inner-box">
						<div class="welcome-msg">
							<h3 class="page-sub-header2 clearfix no-padding">{{ t('Hello') }} {{ $user->name }} ! </h3>
							<span class="page-sub-header-sub small">
                                {{ t('You last logged in at') }}: {{ \App\Helpers\Date::format($user->last_login_at, 'datetime') }}
                            </span>
						</div>
						
					    <div id="accordion" class="panel-group">
							{{-- PHOTO --}}
							<div class="card card-default">
								<div class="card-header">
									<h4 class="card-title">
										<a href="#photoPanel" data-bs-toggle="collapse" data-parent="#accordion">{{ t('Photo or User') }}</a>
									</h4>
								</div>
								<?php
								$photoPanelClass = '';
								$photoPanelClass = request()->filled('panel')
									? (request()->get('panel') == 'photo' ? 'show' : $photoPanelClass)
									: ((old('panel')=='' || old('panel') =='photo') ? 'show' : $photoPanelClass);
								?>
								<div class="panel-collapse collapse {{ $photoPanelClass }}" id="photoPanel">
									<div class="card-body">
										<form name="details" class="form-horizontal" role="form" method="POST" action="{{ url('account/' . $user->id . '/photo') }}">
											<div class="row">
												<div class="col-xl-12 text-center">
													
													<?php $photoError = (isset($errors) and $errors->has('photo')) ? ' is-invalid' : ''; ?>
													<div class="photo-field">
														<div class="file-loading">
															<input id="photoField" name="photo" type="file" class="file {{ $photoError }}">
														</div>
													</div>
												
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							
							{{-- USER --}}
							<div class="card card-default">
								<div class="card-header">
									<h4 class="card-title">
										<a href="#userPanel" aria-expanded="true" data-bs-toggle="collapse" data-parent="#accordion">{{ t('Account Details') }}</a>
									</h4>
								</div>
								<?php
								$userPanelClass = '';
								$userPanelClass = request()->filled('panel')
									? (request()->get('panel') == 'user' ? 'show' : $userPanelClass)
									: ((old('panel')=='' || old('panel')=='user') ? 'show' : $userPanelClass);
								?>
								<div class="panel-collapse collapse {{ $userPanelClass }}" id="userPanel">
									<div class="card-body">
										<form name="details"
											  class="form-horizontal"
											  role="form"
											  method="POST"
											  action="{{ url('account') }}"
											  enctype="multipart/form-data"
										>
											{!! csrf_field() !!}
											<input name="_method" type="hidden" value="PUT">
											<input name="panel" type="hidden" value="user">
								
											{{-- name --}}
											<?php $nameError = (isset($errors) && $errors->has('name')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-12">{{ ('Display Name') }} <sup>*</sup></label>
												<div class="col-md-12">
													<input name="name" type="text" class="form-control{{ $nameError }}" placeholder="Display Name" value="{{ old('name', $user->name) }}">
												</div>
											</div>
											
											{{-- username --}}
											<?php $usernameError = (isset($errors) && $errors->has('username')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-12" for="username">{{ ('Full Name') }} <sup>*</sup></label>
												<div class="col-md-12">
													<div class="input-group">
														<span class="input-group-text"><i class="fas fa-user"></i></span>
														<input id="username"
															   name="username"
															   type="text"
															   class="form-control{{$usernameError}}"
															   placeholder="Full Name"
															   value="{{ old('username', $user->username) }}"
														>
													</div>
												</div>
											</div>
												
											{{-- email --}}
											<?php $emailError = (isset($errors) && $errors->has('email')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-12">{{ t('email') }} <sup>*</sup>
													@if (!isEnabledField('phone'))
														<!-- <sup>*</sup> -->
													@endif
												</label>
												<div class="col-md-12">
													<div class="input-group">
														<span class="input-group-text"><i class="fas fa-envelope"></i></span>
														<input id="email"
															   name="email"
															   type="email"
															   class="form-control{{ $emailError }}"
															   placeholder="{{ t('email') }}"
															   value="{{ old('email', $user->email) }}"
														>
													</div>
												</div>
											</div>
                                                
                                                      {{-- country_code --}}

										     <?php $countryCodeError = (isset($errors) and $errors->has('country_code')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-12{{ $countryCodeError }}" for="country_code">
													{{ ('Country') }} <sup>*</sup>
												</label>
												<div class="col-md-12">
													<select name="country_code" id="countryCode" class="form-control large-data-selecter{{ $countryCodeError }}" onchange="this.form.submit()">
														<!-- <option value="0" {{ (!old('country_code') or old('country_code')==0) ? 'selected="selected"' : '' }}>
															{{ t('select_a_country') }}
														</option>
														@foreach ($countries as $item)
															<option value="{{ $item->get('code') }}" {{ (old('country_code', $user->country_code)==$item->get('code')) ? 'selected="selected"' : '' }}>
																{{ $item->get('name') }}
															</option>
														@endforeach -->


														<?php 
												
												// print_r($all_countries);die;
											foreach($all_countries as $top_coach_detail){

											
												$slug = json_decode($top_coach_detail->name);




													$ss = array();
													foreach ($slug as $key => $sub) {
														$ss[$key] = $sub;
													}
													// print_r($top_coach_detail);
												?>
												

													<option value="{{ $top_coach_detail->code }}" {{ (old('country_code', $user->country_code)==$top_coach_detail->code) ? 'selected="selected"' : '' }}>
													{{ $ss['en'] }}
															</option>
												<?php  } ?>
													</select>
												</div>
											</div>

											

											<?php $locationError = (isset($errors) and $errors->has('location')) ? ' is-invalid' : ''; ?>

											<div class="row mb-3 required">

											<label class="col-md-12">
													{{ t('location') }} <sup>*</sup>
												</label>


<!-- <script type="text/javascript">
    $(function () {
        $("#countryCode").change(function () {
            var selectedText = $(this).find("option:selected").text();
            var selectedValue = $(this).val();
            alert(" Value: " + selectedValue);
			$("#locationcode").text(selectedValue);
			
        });
    });
</script> -->


													

												<div class="col-md-12">
												<input type="hidden" id="locationcode" value="">
													<select name="location" id="location" class="form-control large-data-selecter">
														

													<?php
													foreach ($cities_data as $key =>$value) {

														if(isset($_GET["country_code"])){
															$country=$_GET["country_code"];
															
														}

													
													if($user->country_code== $value->country_code){
													// print_r($value->id);die;
													?>
														<option id="location" value="{{ $value->id }}" {{(old('location', $user->location) == $value->id) ? 'selected="selected"' : '' }}>
															{{  $value->name }}
														</option>	
													<?php
													}
												} ?>
														
													</select>
												</div>
											</div>
                                            			
												
											{{-- phone --}}
											<?php $phoneError = (isset($errors) && $errors->has('phone')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label for="phone" class="col-md-12">{{ ('Phone Number') }} <sup>*</sup>
													@if (!isEnabledField('email'))
														<!-- <sup>*</sup> -->
													@endif
												</label>
												<div class="col-md-12">
													<div class="input-group">
														<span id="phoneCountry" class="input-group-text">{!! getPhoneIcon(old('country_code', $user->country_code)) !!}</span>
														<input id="phone" name="phone" type="text" class="form-control{{ $phoneError }}"
															   placeholder="{{ (!isEnabledField('email')) ? t('Mobile Phone Number') : t('phone_number') }}"
															   value="{{ phoneFormat(old('phone', $user->phone), old('country_code', $user->country_code)) }}">
														<span class="input-group-text">
															<input name="phone_hidden" id="phoneHidden" type="checkbox"
																   value="1" {{ (old('phone_hidden', $user->phone_hidden)=='1') ? 'checked="checked"' : '' }}>&nbsp;
															<small>{{ t('Hide') }}</small>
														</span>
													</div>
												</div>
											</div>

											{{-- experience and location --}}
											<?php $experienceError = (isset($errors) && $errors->has('year_of_experience')) ? ' is-invalid' : ''; ?>
											


											<div class="row mb-3 required">
												<label class="col-md-12" for="email">{{ t('year_of_experience') }} <sup>*</sup>
											     </label>
												
												<div class="col-md-12">
													<div class="input-group">
														<span class="input-group-text"><i class="fas fa-experience"></i></span>
														<input id="year_of_experience"
															   name="year_of_experience"
															   type="text"
															   class="form-control{{ $experienceError }}"
															   placeholder="{{ t('year_of_experience') }}"
															   value="{{ old('year_of_experience', $user->year_of_experience) }}"
														>
													</div>
												</div>
											</div>
											<?php //$locationError = (isset($errors) and $errors->has('location')) ? ' is-invalid' : ''; ?>

											<!-- <div class="row mb-3 required">

											<label class="col-md-12" for="country_code">
													{{ t('location') }} <sup>*</sup>
												</label>

												<div class="col-md-12">
													<select name="location" id="location"  class="form-control large-data-selecter">
														<option value="0" {{ (!old('location') or old('location')==0) ? 'selected="selected"' : '' }}>
															{{ t('select_your_location') }}
														</option> -->

														<!-- <option value="0" {{ (!old('location') or old('location')> 0) ? 'selected="selected"' : '' }}>
															{{$user->location }}
														</option> -->
														
														
														<!-- @foreach ($all_citiesssss as $item)

														@if($item->country_code == $user->country_code)
															<option value="{{ $item->id }}" {{ (old('location', $user->location)==$item->id) ? 'selected="selected"' : '' }}>
																{{ $item->name }}
															</option>

															

															@endif
														@endforeach
													</select>
												</div>
											</div> -->

											


											{{-- Youtube link--}}
											
											<div class="row mb-3 required">
												<label class="col-md-12" for="link">{{ ('youtube link') }} <sup>*</sup>
											     </label>
												<div class="col-md-12">
													<div class="input-group">
														<span class="input-group-text"></span>
														<input id="youtube_link"
															   name="youtube_link"
															   type="URL"
															   class="form-control"
															   placeholder="link"
															   value="{{ old('youtube_link', $user->youtube_link) }}"
															   
															   
														>
													</div>
												</div>
											</div>
											{{--industry/area of expertise and subcategories --}}
											<?php $countryCodeError = (isset($errors) and $errors->has('category')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-6{{ $countryCodeError }}" for="category">
													{{ ('Industry/Area of expertise') }} <sup>*</sup>
												</label>
												<label class="col-md-6">
													{{ ('Subcategories') }} <sup>*</sup>
												</label>
												<div class="col-md-6">
													<select name="category" id="category" class="form-control large-data-selecter{{ $countryCodeError }}">
														<option value="0" {{ (!old('category') or old('category')==0) ? 'selected="selected"' : '' }}>
															{{ t('select_a_category') }}
														</option>
														@foreach ($categories as $item)
															<option value="{{ $item->id }}" {{ (old('category', $user->category)==$item->id) ? 'selected="selected"' : '' }}>
																{{ $item->slug }}
															</option>
														@endforeach
													</select>
												</div>
												<div class="col-md-6">
													<select name="sub_category" id="sub_category" class="form-control large-data-selecter{{ $countryCodeError }}">
														<?php
														foreach ($categoriess as $value) {
															// print_r($value);die;
														
														?>
													<option value="{{ $value->id }}" {{ (old('category', $user->sub_category)==$value->id) ? 'selected="selected"' : '' }}>{{$value->slug}}
																
															</option>
													<?php } ?>
												</select>
												</div>
											</div>

											{{-- gender_id --}}

											<?php $genderIdError = (isset($errors) && $errors->has('gender_id')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-12">{{ t('gender') }}</label>
												<div class="col-md-12">
													@if ($genders->count() > 0)
                                                        			@foreach ($genders as $gender)
															<div class="form-check form-check-inline pt-2">
																<input name="gender_id"
																	   id="gender_id-{{ $gender->id }}"
																	   value="{{ $gender->id }}"
																	   class="form-check-input{{ $genderIdError }}"
																	   type="radio" {{ (old('gender_id', $user->gender_id)==$gender->id) ? 'checked="checked"' : '' }}
																>
																<label class="form-check-label" for="gender_id-{{ $gender->id }}">
																	{{ $gender->name }}
																</label>
															</div>
                                                        			@endforeach
													@endif
												</div>
											</div>

											{{-- coach summary --}}
											<?php $coach_summaryError = (isset($errors) && $errors->has('coach_summary')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-12">{{ ('Coach Summary') }} <sup>*</sup></label>
												<div class="col-md-12">
													<textarea name="coach_summary" class="form-control{{ $coach_summaryError }} new-form-control" placeholder="Coach Summary" rows="5">{{ old('coach_summary', $user->coach_summary) }}</textarea>
												</div>
											</div>

											<div class="row mb-3">
												<div class="col-md-12"></div>
											</div>
											
											{{-- button --}}
											<div class="row">
												<div class=" col-md-9">
													<button type="submit" class="btn btn-primary">{{ t('Update') }}</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>


							
							{{-- SETTINGS --}}
							<div class="card card-default">
								<div class="card-header">
									<h4 class="card-title"><a href="#settingsPanel" data-bs-toggle="collapse" data-parent="#accordion">{{ t('Settings') }}</a></h4>
								</div>
								<?php
								$settingsPanelClass = '';
								$settingsPanelClass = request()->filled('panel')
									? (request()->get('panel') == 'settings' ? 'show' : $settingsPanelClass)
									: ((old('panel')=='settings') ? 'show' : $settingsPanelClass);
								?>
								<div class="panel-collapse collapse {{ $settingsPanelClass }}" id="settingsPanel">
									<div class="card-body">
										<form name="settings"
											  class="form-horizontal"
											  role="form"
											  method="POST"
											  action="{{ url('account/settings') }}"
											  enctype="multipart/form-data"
										>
											{!! csrf_field() !!}
											<input name="_method" type="hidden" value="PUT">
											<input name="panel" type="hidden" value="settings">
											
											<input name="gender_id" type="hidden" value="{{ $user->gender_id }}">
											<input name="name" type="hidden" value="{{ $user->name }}">
											<input name="phone" type="hidden" value="{{ $user->phone }}">
											<input name="email" type="hidden" value="{{ $user->email }}">
										
											@if (config('settings.single.activation_facebook_comments') && config('services.facebook.client_id'))
												{{-- disable_comments --}}
												<div class="row mb-3">
													<label class="col-md-12"></label>
													<div class="col-md-12">
														<div class="form-check pt-2">
															<input id="disable_comments"
																   name="disable_comments"
																   class="form-check-input"
																   value="1"
																   type="checkbox" {{ ($user->disable_comments==1) ? 'checked' : '' }}
															>
															<label class="form-check-label" for="disable_comments" style="font-weight: normal;">
																{{ t('Disable comments on my ads') }}
															</label>
														</div>
													</div>
												</div>
											@endif
											
											{{-- password --}}
											<?php $passwordError = (isset($errors) && $errors->has('password')) ? ' is-invalid' : ''; ?>
											<div class="row mb-2">
												<label class="col-md-12">{{ t('New Password') }}</label>
												<div class="col-md-12">
													<input id="password" name="password" type="password" class="form-control{{ $passwordError }}" placeholder="{{ t('password') }}">
												</div>
											</div>
											
											{{-- password_confirmation --}}
											<?php $passwordError = (isset($errors) && $errors->has('password')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3">
												<label class="col-md-12">{{ t('Confirm Password') }}</label>
												<div class="col-md-12">
													<input id="password_confirmation" name="password_confirmation" type="password"
														   class="form-control{{ $passwordError }}" placeholder="{{ t('Confirm Password') }}">
												</div>
											</div>
											
											<!-- @if ($user->accept_terms != 1)
												{{-- accept_terms --}}
												<?php $acceptTermsError = (isset($errors) && $errors->has('accept_terms')) ? ' is-invalid' : ''; ?>
												<div class="row mb-1 required">
													<label class="col-md-3"></label>
													<div class="col-md-12">
														<div class="form-check">
															<input name="accept_terms" id="acceptTerms"
																   class="form-check-input{{ $acceptTermsError }}"
																   value="1"
																   type="checkbox" {{ (old('accept_terms', $user->accept_terms)=='1') ? 'checked="checked"' : '' }}
															>
															
															<label class="form-check-label" for="acceptTerms" style="font-weight: normal;">
																{!! t('accept_terms_label', ['attributes' => getUrlPageByType('terms')]) !!}
															</label>
														</div>
														<div style="clear:both"></div>
													</div>
												</div>
												
												<input type="hidden" name="user_accept_terms" value="{{ (int)$user->accept_terms }}">
											@endif -->
											
											<!-- {{-- accept_marketing_offers --}}
											<?php $acceptMarketingOffersError = (isset($errors) && $errors->has('accept_marketing_offers')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-12"></label>
												<div class="col-md-12">
													<div class="form-check">
														<input name="accept_marketing_offers" id="acceptMarketingOffers"
															   class="form-check-input{{ $acceptMarketingOffersError }}"
															   value="1"
															   type="checkbox" {{ (old('accept_marketing_offers', $user->accept_marketing_offers)=='1') ? 'checked="checked"' : '' }}
														>
														
														<label class="form-check-label" for="acceptMarketingOffers" style="font-weight: normal;">
															{!! t('accept_marketing_offers_label') !!}
														</label>
													</div>
													<div style="clear:both"></div>
												</div>
											</div>
											
											{{-- time_zone --}}
											<?php $timeZoneError = (isset($errors) && $errors->has('time_zone')) ? ' is-invalid' : ''; ?> -->
											<!-- <div class="row mb-4 required">
												<label class="col-md-12 {{ $timeZoneError }}" for="time_zone">
													{{ t('preferred_time_zone_label') }}
												</label>
												<div class="col-md-12">
													<select name="time_zone" class="form-control large-data-selecter{{ $timeZoneError }}">
														<option value="" {{ (empty(old('time_zone'))) ? 'selected="selected"' : '' }}>
															{{ t('select_a_time_zone') }}
														</option>
														<?php $tz = !empty($user->time_zone) ? $user->time_zone : ''; ?>
														@foreach (\App\Helpers\Date::getTimeZones() as $key => $item)
															<option value="{{ $key }}" {{ (old('time_zone', $tz)==$key) ? 'selected="selected"' : '' }}>
																{{ $item }}
															</option>
														@endforeach
													</select>
													<div class="form-text text-muted">
														@if (auth()->user()->can(\App\Models\Permission::getStaffPermissions()))
														{!! t('admin_preferred_time_zone_info', [
																'frontTz' => config('country.time_zone'),
																'country' => config('country.name'),
																'adminTz' => config('app.timezone'),
															]) !!}
														@else
															{!! t('preferred_time_zone_info', [
																'frontTz' => config('country.time_zone'),
																'country' => config('country.name'),
															]) !!}
														@endif
													</div>
												</div>
											</div> -->
											
											{{-- button --}}
											<div class="row">
												<div class=" col-md-12">
													<button type="submit" class="btn btn-primary">{{ t('Update') }}</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>

						</div>
						<!--/.row-box End-->

					</div>
				</div>
				<!--/.page-content-->
			</div>

		</div>
				<?php } else {?>


					<h2>

<h2 class="sec-title">My Profile</h2>
</h2>

			<div class="row" style="padding: 6px; margin-left: -4px;">
			
				<!-- <div class="col-md-3 user-profile-img-data default-inner-box" style="max-width: 266px;"> -->
			
                        <!-- <img id="userImg" class="user-profile-images" src="{{ $user->photo_url }}" alt="user" width="50px;" height="50px;" border-radius=" 50%"> &nbsp;  -->
                        <!-- <span style="font-size: 24px; font-weight: 700; color: #2c234d;"> {{ $user->name }} </span> -->
                
            <!-- </div> -->

		<div class="col-md-12 user-profile-img-data default-inner-box">

		<img id="userImg" class="user-profile-images1" src="{{ url($photo_url1) }}" alt="user" width="50px;" height="50px;" border-radius=" 50%"> &nbsp; 
                        <span style="font-size: 24px; font-weight: 700; color: #2c234d;">   <b> {{ $user->name }}</b> </span>
						<!-- <b> Striver Update Profile </b></span> -->

					<div class="row">
                       
                        <div class="col-md-12 col-sm-8 col-12">
						<span>

						
                            <div class="header-data text-center-xs">
                                {{-- Threads Stats --}}
                                <div class="hdata">
                                <a href="{{ url('account/messages') }}">

                                    <div class="mcol-left">
                                        <i class="fas fa-phone-alt ln-shadow"></i>
                                    </div>
                                    <div class="mcol-right">
                                        {{-- Number of messages --}}
                                        <p>
                                            
                                                {{ isset($countThreads) ? \App\Helpers\Number::short($countThreads) : 0 }}
                                               
                                                <em>{{ trans_choice('Call', getPlural($countThreads), [], config('app.locale')) }}</em>
                                           
                                        </p>
                                    </div>
                                    </a>
                                    <div class="clearfix"></div>
                                </div>

                                {{-- Traffic Stats --}}
                                <div class="hdata">
                                <a href="{{ url('account/chat') }}">
                                    <div class="mcol-left">
                                        <i class="fas fa-comments ln-shadow"></i>
                                    </div>
                                    <div class="mcol-right">
                                        {{-- Number of visitors --}}
                                        <p>
                                            
                                                <?php $totalPostsVisits = (isset($countPostsVisits) and $countPostsVisits->total_visits) ? $countPostsVisits->total_visits : 0 ?>
                                                {{ \App\Helpers\Number::short($totalPostsVisits) }}
                                    
                                                <em>{{ trans_choice('Chat', getPlural($totalPostsVisits), [], config('app.locale')) }}</em>
                                           
                                        </p>
                                    </div>

                                    </a>
                                    <div class="clearfix"></div>
                                </div>

                               

                                {{-- Favorites Stats --}}
                                <div class="hdata" style="width: 151px!important;margin-left: -38px;">
                                <a href="{{ url('account/favourite') }}">
                                    <div class="mcol-left" >
                                        <i class="fas fa-bell ln-shadow" style="margin-left: 29px"></i>
                                    </div>
                                    <div class="mcol-right">
                                        {{-- Number of favorites --}}
                                        <p>
                                            
                                                {{ \App\Helpers\Number::short($countFavoritePosts) }}
                                                <em>{{ trans_choice('Notification', getPlural($countFavoritePosts), [], config('app.locale')) }} </em>
                                           
                                        </p>
                                    </div>
                                    </a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    
				</div>

			</div>
	</div>
	
	


				<div class="row">

				<div class="col-md-3 page-sidebar ptop">
				
					@includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar', 'account.inc.sidebar'])
				</div>
				

					<div class="col-md-9 page-content ptop">

					@include('flash::message')

					@if (isset($errors) && $errors->any())
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ t('Close') }}"></button>
							<h5><strong>{{ t('oops_an_error_has_occurred') }}</strong></h5>
							<ul class="list list-check">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					
					<div id="avatarUploadError" class="center-block" style="width:100%; display:none"></div>
					<div id="avatarUploadSuccess" class="alert alert-success fade show" style="display:none;"></div>
					
					

					<div class="inner-box default-inner-box">
						<div class="welcome-msg">
							<h3 class="page-sub-header2 clearfix no-padding">{{ t('Hello') }} {{ $user->name }} ! </h3>
							<span class="page-sub-header-sub small">
                                {{ t('You last logged in at') }}: {{ \App\Helpers\Date::format($user->last_login_at, 'datetime') }}
                            </span>
						</div>
						
						<div id="accordion" class="panel-group">
							{{-- PHOTO --}}
							<div class="card card-default">
								<div class="card-header">
									<h4 class="card-title">
										<a href="#photoPanel" data-bs-toggle="collapse" data-parent="#accordion">{{ t('Photo or User') }}</a>
									</h4>
								</div>
								<?php
								$photoPanelClass = '';
								$photoPanelClass = request()->filled('panel')
									? (request()->get('panel') == 'photo' ? 'show' : $photoPanelClass)
									: ((old('panel')=='' || old('panel') =='photo') ? 'show' : $photoPanelClass);
								?>
								<div class="panel-collapse collapse {{ $photoPanelClass }}" id="photoPanel">
									<div class="card-body">
										<form name="details" class="form-horizontal" role="form" method="POST" action="{{ url('account/' . $user->id . '/photo') }}">
											<div class="row">
												<div class="col-xl-12 text-center">
													
													<?php $photoError = (isset($errors) and $errors->has('photo')) ? ' is-invalid' : ''; ?>
													<div class="photo-field">
														<div class="file-loading">
															<input id="photoField" name="photo" type="file" class="file {{ $photoError }}">
														</div>
													</div>
												
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							
							{{-- USER --}}
							<div class="card card-default">
								<div class="card-header">
									<h4 class="card-title">
										<a href="#userPanel" aria-expanded="true" data-bs-toggle="collapse" data-parent="#accordion">{{ t('Account Details') }}</a>
									</h4>
								</div>
								<?php
								$userPanelClass = '';
								$userPanelClass = request()->filled('panel')
									? (request()->get('panel') == 'user' ? 'show' : $userPanelClass)
									: ((old('panel')=='' || old('panel')=='user') ? 'show' : $userPanelClass);
								?>
								<div class="panel-collapse collapse {{ $userPanelClass }}" id="userPanel">
									<div class="card-body">
										<form name="details"
											  class="form-horizontal"
											  role="form"
											  method="POST"
											  action="{{ url('account') }}"
											  enctype="multipart/form-data"
										>
											{!! csrf_field() !!}
											<input name="_method" type="hidden" value="PUT">
											<input name="panel" type="hidden" value="user">

											{{-- gender_id --}}
											<?php $genderIdError = (isset($errors) && $errors->has('gender_id')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-3">{{ t('gender') }}</label>
												<div class="col-md-12">
													@if ($genders->count() > 0)
                                                        @foreach ($genders as $gender)
															<div class="form-check form-check-inline pt-2">
																<input name="gender_id"
																	   id="gender_id-{{ $gender->id }}"
																	   value="{{ $gender->id }}"
																	   class="form-check-input{{ $genderIdError }}"
																	   type="radio" {{ (old('gender_id', $user->gender_id)==$gender->id) ? 'checked="checked"' : '' }}
																>
																<label class="form-check-label" for="gender_id-{{ $gender->id }}">
																	{{ $gender->name }}
																</label>
															</div>
                                                        @endforeach
													@endif
												</div>
											</div>
												
											{{-- name --}}
											<?php $nameError = (isset($errors) && $errors->has('name')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-12">{{ t('Name') }} <sup>*</sup></label>
												<div class="col-md-12">
													<input name="name" type="text" class="form-control{{ $nameError }}" placeholder="" value="{{ old('name', $user->name) }}">
												</div>
											</div>
											
											{{-- username --}}
											<?php $usernameError = (isset($errors) && $errors->has('username')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-12" for="email">{{ t('Username') }}</label>
												<div class="col-md-12">
													<div class="input-group">
														<span class="input-group-text"><i class="fas fa-user"></i></span>
														<input id="username"
															   name="username"
															   type="text"
															   class="form-control{{ $usernameError }}"
															   placeholder="{{ t('Username') }}"
															   value="{{ old('username', $user->username) }}"
														>
													</div>
												</div>
											</div>
												
											{{-- email --}}
											<?php $emailError = (isset($errors) && $errors->has('email')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-12">{{ t('email') }}
													@if (!isEnabledField('phone'))
														<sup>*</sup>
													@endif
												</label>
												<div class="col-md-12">
													<div class="input-group">
														<span class="input-group-text"><i class="fas fa-envelope"></i></span>
														<input id="email"
															   name="email"
															   type="email"
															   class="form-control{{ $emailError }}"
															   placeholder="{{ t('email') }}"
															   value="{{ old('email', $user->email) }}"
														>
													</div>
												</div>
											</div>
                                                
                                            {{-- country_code --}}
                                            
                                            <?php $countryCodeError = (isset($errors) and $errors->has('country_code')) ? ' is-invalid' : ''; ?>
											<div class="form-group row required">
												<label class="col-md-12{{ $countryCodeError }}" for="country_code">
                                            		{{ t('your_country') }} <sup>*</sup>
                                            	</label>
												<div class="col-md-12">
													<select name="country_code" class="form-control large-data-selecter{{ $countryCodeError }}">
													<?php 
												
												// print_r($all_countries);die;
											foreach($all_countries as $top_coach_detail){

											
												$slug = json_decode($top_coach_detail->name);




													$ss = array();
													foreach ($slug as $key => $sub) {
														$ss[$key] = $sub;
													}
													// print_r($top_coach_detail);
												?>
												

													<option value="{{ $top_coach_detail->code }}" {{ (old('country_code', $user->country_code)==$top_coach_detail->code) ? 'selected="selected"' : '' }}>
													{{ $ss['en'] }}
															</option>
												<?php  } ?>
														
													</select>
												</div>
											</div>
                                            
                                            <!-- <input name="country_code" type="hidden" value="{{ $user->country_code }}"> -->
												
											{{-- phone --}}
											<?php $phoneError = (isset($errors) && $errors->has('phone')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label for="phone" class="col-md-12">{{ t('phone') }}
													@if (!isEnabledField('email'))
														<sup>*</sup>
													@endif
												</label>
												<div class="col-md-12">
													<div class="input-group">
														<span id="phoneCountry" class="input-group-text">{!! getPhoneIcon(old('country_code', $user->country_code)) !!}</span>
														<input id="phone" name="phone" type="text" class="form-control{{ $phoneError }}"
															   placeholder="{{ (!isEnabledField('email')) ? t('Mobile Phone Number') : t('phone_number') }}"
															   value="{{ phoneFormat(old('phone', $user->phone), old('country_code', $user->country_code)) }}">
														<span class="input-group-text">
															<input name="phone_hidden" id="phoneHidden" type="checkbox"
																   value="1" {{ (old('phone_hidden', $user->phone_hidden)=='1') ? 'checked="checked"' : '' }}>&nbsp;
															<small>{{ t('Hide') }}</small>
														</span>
													</div>
												</div>
											</div>

											<div class="row mb-3">
												<div class="col-md-12"></div>
											</div>
											
											{{-- button --}}
											<div class="row">
												<div class="ocol-md-12">
													<button type="submit" class="btn btn-primary">{{ t('Update') }}</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							
							<!-- {{-- Payment details --}}
							<div class="card card-default">
								<div class="card-header">
									<h4 class="card-title"><a href="#Bank_account_Details_panel" data-bs-toggle="collapse" data-parent="#accordion">{{ t('Payment Details') }}</a></h4>
								</div>
								<?php
								$settingsPanelClass = '';
								$settingsPanelClass = request()->filled('panel')
									? (request()->get('panel') == 'settings' ? 'show' : $settingsPanelClass)
									: ((old('panel')=='settings') ? 'show' : $settingsPanelClass);
								?>
								<div class="panel-collapse collapse {{ $settingsPanelClass }}" id="Bank_account_Details_panel">
									<div class="card-body">
										<form name="settings"
											  class="form-horizontal"
											  role="form"
											  method="POST"
											  action="{{ url('account/settings') }}"
											  enctype="multipart/form-data"
										>
											{!! csrf_field() !!}
											<input name="_method" type="hidden" value="PUT">
											<input name="panel" type="hidden" value="settings">
											
											<input name="gender_id" type="hidden" value="{{ $user->gender_id }}">
											<input name="name" type="hidden" value="{{ $user->name }}">
											<input name="phone" type="hidden" value="{{ $user->phone }}">
											<input name="email" type="hidden" value="{{ $user->email }}">
										
											@if (config('settings.single.activation_facebook_comments') && config('services.facebook.client_id'))
												{{-- disable_comments --}}
												<div class="row mb-3">
													<label class="col-md-12"></label>
													<div class="col-md-12">
														<div class="form-check pt-2">
															<input id="disable_comments"
																   name="disable_comments"
																   class="form-check-input"
																   value="1"
																   type="checkbox" {{ ($user->disable_comments==1) ? 'checked' : '' }}
															>
															<label class="form-check-label" for="disable_comments" style="font-weight: normal;">
																{{ t('Disable comments on my ads') }}
															</label>
														</div>
													</div>
												</div>
											@endif
											
											{{-- transaction_id --}}
											<?php $passwordError = (isset($errors) && $errors->has('password')) ? ' is-invalid' : ''; ?>
											<div class="row mb-2">
												<label class="col-md-12">{{ t('transaction_id') }}</label>
												<div class="col-md-12">
													<input id="transaction_id" name="transaction_id" type="text" class="form-control{{ $passwordError }}" placeholder="{{ t('transaction_id') }}">
												</div>
											</div>
											
											{{-- amount --}}
											<?php $passwordError = (isset($errors) && $errors->has('password')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3">
												<label class="col-md-12">{{ t('amount') }}</label>
												<div class="col-md-12">
													<input id="amount" name="amount" type="text"
														   class="form-control{{ $passwordError }}" placeholder="{{ t('amount') }}">
												</div>
											</div>
											
											@if ($user->accept_terms != 1)
												{{-- accept_terms --}}
												<?php $acceptTermsError = (isset($errors) && $errors->has('accept_terms')) ? ' is-invalid' : ''; ?>
												<div class="row mb-1 required">
													<label class="col-md-12"></label>
													<div class="col-md-12">
														<div class="form-check">
															<input name="accept_terms" id="acceptTerms"
																   class="form-check-input{{ $acceptTermsError }}"
																   value="1"
																   type="checkbox" {{ (old('accept_terms', $user->accept_terms)=='1') ? 'checked="checked"' : '' }}
															>
															
															<label class="form-check-label" for="acceptTerms" style="font-weight: normal;">
																{!! t('accept_terms_label', ['attributes' => getUrlPageByType('terms')]) !!}
															</label>
														</div>
														<div style="clear:both"></div>
													</div>
												</div>
												
												<input type="hidden" name="user_accept_terms" value="{{ (int)$user->accept_terms }}">
											@endif
											
									

											{{-- username --}}
											<?php $usernameError = (isset($errors) && $errors->has('username')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-12" for="email">{{ t('Username') }}</label>
												<div class="col-md-12">
													<div class="input-group">
														<span class="input-group-text"><i class="fas fa-user"></i></span>
														<input id="username"
															   name="username"
															   type="text"
															   class="form-control{{ $usernameError }}"
															   placeholder="{{ t('Username') }}"
															   value="{{ old('username', $user->username) }}"
														>
													</div>
												</div>
											</div>

											{{-- payment_status --}}
											<?php $usernameError = (isset($errors) && $errors->has('username')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-12" for="email">{{ t('payment_status') }}</label>
												<div class="col-md-12">
													<div class="input-group">
														<span class="input-group-text"><i class="fas fa-money-check"></i></span>
														<input id="active"
															   name="active"
															   type="text"
															   class="form-control{{ $usernameError }}"
															   placeholder="{{ t('payment_status') }}"
															   value="{{ old('username', $user->username) }}"
														>
													</div>
												</div>
											</div>
											
											{{-- button --}}
											<div class="row">
												<div class="col-md-12">
													<button type="submit" class="btn btn-primary">{{ t('Update') }}</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>


							{{-- Subscription plans Coach wise --}}
							<div class="card card-default">
								<div class="card-header">
									<h4 class="card-title"><a href="#Subscription_plans_Coach_wise" data-bs-toggle="collapse" data-parent="#accordion">{{ t('Subscription_plans_Coach_wise') }}</a></h4>
								</div>
								<?php
								$settingsPanelClass = '';
								$settingsPanelClass = request()->filled('panel')
									? (request()->get('panel') == 'settings' ? 'show' : $settingsPanelClass)
									: ((old('panel')=='settings') ? 'show' : $settingsPanelClass);
								?>
								<div class="panel-collapse collapse {{ $settingsPanelClass }}" id="Subscription_plans_Coach_wise">
									<div class="card-body">
										<form name="settings"
											  class="form-horizontal"
											  role="form"
											  method="POST"
											  action="{{ url('account/settings') }}"
											  enctype="multipart/form-data"
										>
											{!! csrf_field() !!}
											<input name="_method" type="hidden" value="PUT">
											<input name="panel" type="hidden" value="settings">
											
											<input name="gender_id" type="hidden" value="{{ $user->gender_id }}">
											<input name="name" type="hidden" value="{{ $user->name }}">
											<input name="phone" type="hidden" value="{{ $user->phone }}">
											<input name="email" type="hidden" value="{{ $user->email }}">
										
											@if (config('settings.single.activation_facebook_comments') && config('services.facebook.client_id'))
												{{-- disable_comments --}}
												<div class="row mb-3">
													<label class="col-md-12"></label>
													<div class="col-md-12">
														<div class="form-check pt-2">
															<input id="disable_comments"
																   name="disable_comments"
																   class="form-check-input"
																   value="1"
																   type="checkbox" {{ ($user->disable_comments==1) ? 'checked' : '' }}
															>
															<label class="form-check-label" for="disable_comments" style="font-weight: normal;">
																{{ t('Disable comments on my ads') }}
															</label>
														</div>
													</div>
												</div>
											@endif
											
											{{-- subscription_palne --}}
										


											<div class="form-group row required">
												<label class="col-md-12{{ $countryCodeError }}" for="country_code">
                                            		{{ t('subscription_palne') }} <sup>*</sup>
                                            	</label>
												<div class="col-md-12">
													<select name="name" class="form-control large-data-selecter{{ $countryCodeError }}">
														<option value="0" {{ (!old('name') or old('name')==0) ? 'selected="selected"' : '' }}>
															{{ t('subscription_palne') }}
														</option>
														<?php 
														foreach ($subscription_plan as $item){ ?>
															<option value="{{ $item->get('id') }}">
																{{ $item->name}}
															</option>
														<?php }?>
													</select>
												</div>
											</div>
											
											{{-- subscription_Price --}}
											


											<div class="form-group row required">
												<label class="col-md-12{{ $countryCodeError }}" for="country_code">
                                            		{{ t('subscription_Price') }} <sup>*</sup>
                                            	</label>
												<div class="col-md-12">
													<select name="price" class="form-control large-data-selecter{{ $countryCodeError }}">
														<option value="0" {{ (!old('price') or old('price')==0) ? 'selected="selected"' : '' }}>
															{{ t('subscription_Price') }}
														</option>
														<?php 
														foreach ($subscription_plan as $item){ ?>
															<option value="{{ $item->get('id') }}">
																{{ $item->price}}
															</option>
														<?php }?>
													</select>
												</div>
											</div>



											@if ($user->accept_terms != 1)
												{{-- accept_terms --}}
												<?php $acceptTermsError = (isset($errors) && $errors->has('accept_terms')) ? ' is-invalid' : ''; ?>
												<div class="row mb-1 required">
													<label class="col-md-12"></label>
													<div class="col-md-12">
														<div class="form-check">
															<input name="accept_terms" id="acceptTerms"
																   class="form-check-input{{ $acceptTermsError }}"
																   value="1"
																   type="checkbox" {{ (old('accept_terms', $user->accept_terms)=='1') ? 'checked="checked"' : '' }}
															>
															
															<label class="form-check-label" for="acceptTerms" style="font-weight: normal;">
																{!! t('accept_terms_label', ['attributes' => getUrlPageByType('terms')]) !!}
															</label>
														</div>
														<div style="clear:both"></div>
													</div>
												</div>
												
												<input type="hidden" name="user_accept_terms" value="{{ (int)$user->accept_terms }}">
											@endif
											
									

											{{-- username --}}
											<?php $usernameError = (isset($errors) && $errors->has('username')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3 required">
												<label class="col-md-12" for="email">{{ t('Username') }}</label>
												<div class="col-md-12">
													<div class="input-group">
														<span class="input-group-text"><i class="fas fa-user"></i></span>
														<input id="username"
															   name="username"
															   type="text"
															   class="form-control{{ $usernameError }}"
															   placeholder="{{ t('Username') }}"
															   value="{{ old('username', $user->username) }}">
													</div>
												</div>
											</div>
											
											{{-- button --}}
											<div class="row">
												<div class="col-md-12">
													<button type="submit" class="btn btn-primary">{{ t('Update') }}</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div> -->

						

							{{-- SETTINGS --}}
							<div class="card card-default">
								<div class="card-header">
									<h4 class="card-title"><a href="#settingsPanel" data-bs-toggle="collapse" data-parent="#accordion">{{ t('Settings') }}</a></h4>
								</div>
								<?php
								$settingsPanelClass = '';
								$settingsPanelClass = request()->filled('panel')
									? (request()->get('panel') == 'settings' ? 'show' : $settingsPanelClass)
									: ((old('panel')=='settings') ? 'show' : $settingsPanelClass);
								?>
								<div class="panel-collapse collapse {{ $settingsPanelClass }}" id="settingsPanel">
									<div class="card-body">
										<form name="settings"
											  class="form-horizontal"
											  role="form"
											  method="POST"
											  action="{{ url('account/settings') }}"
											  enctype="multipart/form-data"
										>
											{!! csrf_field() !!}
											<input name="_method" type="hidden" value="PUT">
											<input name="panel" type="hidden" value="settings">
											
											<input name="gender_id" type="hidden" value="{{ $user->gender_id }}">
											<input name="name" type="hidden" value="{{ $user->name }}">
											<input name="phone" type="hidden" value="{{ $user->phone }}">
											<input name="email" type="hidden" value="{{ $user->email }}">
										
											@if (config('settings.single.activation_facebook_comments') && config('services.facebook.client_id'))
												{{-- disable_comments --}}
												<div class="row mb-3">
													<label class="col-md-12"></label>
													<div class="col-md-12">
														<div class="form-check pt-2">
															<input id="disable_comments"
																   name="disable_comments"
																   class="form-check-input"
																   value="1"
																   type="checkbox" {{ ($user->disable_comments==1) ? 'checked' : '' }}
															>
															<label class="form-check-label" for="disable_comments" style="font-weight: normal;">
																{{ t('Disable comments on my ads') }}
															</label>
														</div>
													</div>
												</div>
											@endif
											
											{{-- password --}}
											<?php $passwordError = (isset($errors) && $errors->has('password')) ? ' is-invalid' : ''; ?>
											<div class="row mb-2">
												<label class="col-md-12">{{ t('New Password') }}</label>
												<div class="col-md-12">
													<input id="password" name="password" type="password" class="form-control{{ $passwordError }}" placeholder="{{ t('password') }}">
												</div>
											</div>
											
											{{-- password_confirmation --}}
											<?php $passwordError = (isset($errors) && $errors->has('password')) ? ' is-invalid' : ''; ?>
											<div class="row mb-3">
												<label class="col-md-12">{{ t('Confirm Password') }}</label>
												<div class="col-md-12">
													<input id="password_confirmation" name="password_confirmation" type="password"
														   class="form-control{{ $passwordError }}" placeholder="{{ t('Confirm Password') }}">
												</div>
											</div>
											
											@if ($user->accept_terms != 1)
												{{-- accept_terms --}}
												<?php $acceptTermsError = (isset($errors) && $errors->has('accept_terms')) ? ' is-invalid' : ''; ?>
												<div class="row mb-1 required">
													<label class="col-md-12"></label>
													<div class="col-md-12">
														<div class="form-check">
															<input name="accept_terms" id="acceptTerms"
																   class="form-check-input{{ $acceptTermsError }}"
																   value="1"
																   type="checkbox" {{ (old('accept_terms', $user->accept_terms)=='1') ? 'checked="checked"' : '' }}
															>
															
															<label class="form-check-label" for="acceptTerms" style="font-weight: normal;">
																{!! t('accept_terms_label', ['attributes' => getUrlPageByType('terms')]) !!}
															</label>
														</div>
														<div style="clear:both"></div>
													</div>
												</div>
												
												<input type="hidden" name="user_accept_terms" value="{{ (int)$user->accept_terms }}">
											@endif
											
											{{-- accept_marketing_offers --}}
											<?php $acceptMarketingOffersError = (isset($errors) && $errors->has('accept_marketing_offers')) ? ' is-invalid' : ''; ?>
											<!-- <div class="row mb-3 required">
												<label class="col-md-12"></label>
												<div class="col-md-12">
													<div class="form-check">
														<input name="accept_marketing_offers" id="acceptMarketingOffers"
															   class="form-check-input{{ $acceptMarketingOffersError }}"
															   value="1"
															   type="checkbox" {{ (old('accept_marketing_offers', $user->accept_marketing_offers)=='1') ? 'checked="checked"' : '' }}
														>
														
														<label class="form-check-label" for="acceptMarketingOffers" style="font-weight: normal;">
															{!! t('accept_marketing_offers_label') !!}
														</label>
													</div>
													<div style="clear:both"></div>
												</div>
											</div> -->
											
											{{-- time_zone --}}
											<?php $timeZoneError = (isset($errors) && $errors->has('time_zone')) ? ' is-invalid' : ''; ?>
											<!-- <div class="row mb-4 required">
												<label class="col-md-12 {{ $timeZoneError }}" for="time_zone">
													{{ t('preferred_time_zone_label') }}
												</label>
												<div class="col-md-12">
													<select name="time_zone" class="form-control large-data-selecter{{ $timeZoneError }}">
														<option value="" {{ (empty(old('time_zone'))) ? 'selected="selected"' : '' }}>
															{{ t('select_a_time_zone') }}
														</option>
														<?php $tz = !empty($user->time_zone) ? $user->time_zone : ''; ?>
														@foreach (\App\Helpers\Date::getTimeZones() as $key => $item)
															<option value="{{ $key }}" {{ (old('time_zone', $tz)==$key) ? 'selected="selected"' : '' }}>
																{{ $item }}
															</option>
														@endforeach
													</select>
													<div class="form-text text-muted">
														@if (auth()->user()->can(\App\Models\Permission::getStaffPermissions()))
														{!! t('admin_preferred_time_zone_info', [
																'frontTz' => config('country.time_zone'),
																'country' => config('country.name'),
																'adminTz' => config('app.timezone'),
															]) !!}
														@else
															{!! t('preferred_time_zone_info', [
																'frontTz' => config('country.time_zone'),
																'country' => config('country.name'),
															]) !!}
														@endif
													</div>
												</div>
											</div> -->
											
											{{-- button --}}
											<div class="row">
												<div class="col-md-12">
													<button type="submit" class="btn btn-primary">{{ t('Update') }}</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>

						</div>
						<!--/.row-box End-->

					</div>
				</div>

				</div>
					<?php }?>
				
			<!--/.row-->
		</div>
	
		<!--/.container-->
	</div>

	</section>

	@includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.footer1', 'layouts.inc.footer1'])


	<!-- /.main-container -->



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


	@endsection

@section('after_styles')
	<link href="{{ url('../assets/plugins/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet">
	@if (config('lang.direction') == 'rtl')
		<link href="{{ url('../assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet">
	@endif
	<style>
		.krajee-default.file-preview-frame:hover:not(.file-preview-error) {
			box-shadow: 0 0 5px 0 #666666;
		}
		.file-loading:before {
			content: " {{ t('Loading') }}...";
		}
	</style>
	<style>
		/* Avatar Upload */
		.photo-field {
			display: inline-block;
			vertical-align: middle;
		}
		.photo-field .krajee-default.file-preview-frame,
		.photo-field .krajee-default.file-preview-frame:hover {
			margin: 0;
			padding: 0;
			border: none;
			box-shadow: none;
			text-align: center;
		}
		.photo-field .file-input {
			display: table-cell;
			width: 150px;
		}
		.photo-field .krajee-default.file-preview-frame .kv-file-content {
			width: 150px;
			height: 160px;
		}
		.kv-reqd {
			color: red;
			font-family: monospace;
			font-weight: normal;
		}
		
		.file-preview {
			padding: 2px;
		}
		.file-drop-zone {
			margin: 2px;
			min-height: 100px;
		}
		.file-drop-zone .file-preview-thumbnails {
			cursor: pointer;
		}
		
		.krajee-default.file-preview-frame .file-thumbnail-footer {
			height: 30px;
		}
		
		/* Allow clickable uploaded photos (Not possible) */
		.file-drop-zone {
			padding: 20px;
		}
		.file-drop-zone .kv-file-content {
			padding: 0
		}
	</style>
@endsection

@section('after_scripts')
	<script src="{{ url('../assets/plugins/bootstrap-fileinput/js/plugins/sortable.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('../assets/plugins/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('../assets/plugins/bootstrap-fileinput/themes/fas/theme.js') }}" type="text/javascript"></script>
	<script src="{{ url('../js/fileinput/locales/' . config('app.locale') . '.js') }}" type="text/javascript"></script>

	<script>
		var uploadExtraData = {
			_token:'{{ csrf_token() }}',
			_method:'PUT',
			name:'{{ $user->name }}',
			phone:'{{ $user->phone }}',
			email:'{{ $user->email }}'
		};
		var initialPreviewConfigExtra = uploadExtraData;
		initialPreviewConfigExtra.remove_photo = 1;
		
		var photoInfo = '<h6 class="text-muted pb-0">{{ t('Click to select') }}</h6>';
		var footerPreview = '<div class="file-thumbnail-footer pt-2">\n' +
			'    {actions}\n' +
			'</div>';
		
		$('#photoField').fileinput(
		{
			theme: 'fas',
			language: '{{ config('app.locale') }}',
			@if (config('lang.direction') == 'rtl')
				rtl: true,
			@endif
			overwriteInitial: true,
			showCaption: false,
			showPreview: true,
			allowedFileExtensions: {!! getUploadFileTypes('image', true) !!},
			uploadUrl: '{{ url('account/photo') }}',
			uploadExtraData: uploadExtraData,
			uploadAsync: false,
			showBrowse: false,
			showCancel: true,
			showUpload: false,
			showRemove: false,
			minFileSize: {{ (int)config('settings.upload.min_image_size', 0) }}, {{-- in KB --}}
			maxFileSize: {{ (int)config('settings.upload.max_image_size', 1000) }}, {{-- in KB --}}
			browseOnZoneClick: true,
			minFileCount: 0,
			
			maxFileCount: 1,
			validateInitialCount: true,
			uploadClass: 'btn btn-primary',
			defaultPreviewContent: '<img src="{{ url('images/user.jpg') }}" alt="{{ t('Your Photo or Avatar') }}">' + photoInfo,
			/* Retrieve current images */
			/* Setup initial preview with data keys */

			
			// [FreeType Support] => 1
			// [FreeType Linkage] => with freetype
			// [T1Lib Support] => 
			// [GIF Read Support] => 1
			// [GIF Create Support] => 1
			// [JPEG Support] => 1        
			// [PNG Support] => 1
			// [WBMP Support] => 1
			// [XPM Support] => 
			// [XBM Support] => 1
			
			


			initialPreview: [
				@if (isset($user->photo) && !empty($user->photo))
					"{{ url('storage/'.$user->photo) }}"
				@endif
			],
			initialPreviewAsData: true,
			initialPreviewFileType: 'image',
			/* Initial preview configuration */
			initialPreviewConfig: [
				{
					<?php
						// Get the file size
						try {
							$fileSize = (isset($disk) && $disk->exists($user->photo)) ? (int)$disk->size($user->photo) : 0;
						} catch (\Throwable $e) {
							$fileSize = 0;
						}
					?>
					@if (isset($user->photo) && !empty($user->photo))
						caption: '{{ basename($user->photo) }}',
						size: {{ $fileSize }},
						url: '{{ url('account/photo/delete') }}',
						key: {{ (int)$user->id }},
						extra: initialPreviewConfigExtra
					@endif
				}
			],
			
			showClose: false,
			fileActionSettings: {
				showDrag: false, /* Show/hide move (rearrange) icon */
				removeIcon: '<i class="far fa-trash-alt"></i>',
				removeClass: 'btn btn-sm btn-danger',
				removeTitle: '{{ t('Remove file') }}'
			},
			
			elErrorContainer: '#avatarUploadError',
			msgErrorClass: 'alert alert-block alert-danger',
			
			layoutTemplates: {main2: '{preview} {remove} {browse}', footer: footerPreview}
		});
		
		/* Auto-upload added file */
		$('#photoField').on('filebatchselected', function(event, data, id, index) {
			$(this).fileinput('upload');
		});
		
		/* Show upload status message */
		$('#photoField').on('filebatchpreupload', function(event, data, id, index) {
			$('#avatarUploadSuccess').html('<ul></ul>').hide();
		});
		
		/* Show success upload message */
		$('#photoField').on('filebatchuploadsuccess', function(event, data, previewId, index) {
			/* Show uploads success messages */
			var out = '';
			$.each(data.files, function(key, file) {
				if (typeof file !== 'undefined') {
					var fname = file.name;
					out = out + {!! t('Uploaded file X successfully') !!};
				}
			});
			$('#avatarUploadSuccess ul').append(out);
			$('#avatarUploadSuccess').fadeIn('slow');
			
			$('#userImg').attr({'src':$('.photo-field .kv-file-content .file-preview-image').attr('src')});
		});
		
		/* Delete picture */
		$('#photoField').on('filepredelete', function(jqXHR) {
			var abort = true;
			if (confirm("{{ t('Are you sure you want to delete this picture') }}")) {
				abort = false;
			}
			return abort;
		});
		
		$('#photoField').on('filedeleted', function() {
			$('#userImg').attr({'src':'{!! url('images/user.jpg') !!}'});
			
			var out = "{{ t('Your photo or avatar has been deleted') }}";
			$('#avatarUploadSuccess').html('<ul><li></li></ul>').hide();
			$('#avatarUploadSuccess ul li').append(out);
			$('#avatarUploadSuccess').fadeIn('slow');
		});
          
	</script>

	<script>
	     // when category dropdown changes
		
			function getsubcategory(id){
			var sub_cat_id = {{ old('sub_category', $user->category) }}
			$('#category').change(function() {
				var categoryID = $('#category').val();
				if (categoryID) {
					$.ajax({
						type: "GET",
						url: "{{ url('account/getSubcategories') }}?id=" + categoryID,

						success: function(res) {

							if (res) {

								$("#sub_category").empty();
								$("#sub_category").append('<option value=0>Select a subcategory</option>');
								$.each(res, function(key, value) {
									$("#sub_category").append('<option value="' + key + '" '+((key == (sub_cat_id)) ? "selected" : "")+' >' + value +
									'</option>');

								});

							} else {

								$("#sub_category").empty();
							}
							
						}
					});
				} else {
					$("#sub_category").empty();
				}
			});
			var categoryID = $('#category').val();	
			if (categoryID) {
				
				$.ajax({
					
					type: "GET",
					url: "{{ url('account/getSubcategories') }}?id=" + categoryID,

					success: function(res) {

						if (res) {
							
							$("#sub_category").empty();
							$("#sub_category").append('<option value=0>Select a subcategory</option>');
							$.each(res, function(key, value) {
								$("#sub_category").append('<option value="' + key + '" '+((key == (sub_cat_id)) ? "selected" : "")+' >' + value.id +
								'</option>');

							});

						} else {

							$("#sub_category").empty();
						}
						
					}
				});
			} else {
				$("#sub_category").empty();
			}
		});
     </script>


<script>
    function getLocation(id)
    {
		
		var ids = $('#id').val();
		// alert(id);
		// console.log(url);
        $.ajax({
			type: 'get',
            dataType: 'Json',
			url: "{{ url('account/allcities') }}?id=" + id,
			data: {'id': id},
			
            // dataType: 'json',
            success: function(Response) {
				

				if (Response) {
							
							// $("#location").empty();
							// $("#location").append('<option value=0>Select a subcategory</option>');
							
							$.each(Response, function(key, value) {
								
								$.each(value, function(keys, cityvalue) {
									// delete object["en"];
									// myObject = JSON.parse(cityvalue.name);
									// delete(cityvalue.en)+cityvalue.name,
									// myObject = JSON.stringify(cityvalue.name);
									
									$("#location").append('<option value="' + cityvalue.id + '" '+((keys == (cityvalue.id)) ? "selected" : "")+' >' +  cityvalue.name +
								'</option>');

								
								
								});

							});

						} else {

							$("#location").empty();
						}

            }
			
            // error: function(res){
            //     $('#message').text('Error!');
            //     $('.dvLoading').hide();
            // }
        });
    }
</script>
@endsection
