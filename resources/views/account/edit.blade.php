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
       
    </section>
    <!-- Banner End -->

    <!-- Course Section Start -->
    <section class="coursepage-section-2">
   
    <div class="container">
    <?php if($user->user_type_id == 2){

?>

            <h2>
           
                <h2 class="sec-title">Edit Profile
                </h2>
				
            </h2>
			<div class="row">
				<div class="col-lg-3">
					

				@includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar_coach', 'account.inc.sidebar_coach'])
			</div>
	

			<div class="col-lg-9 ">
				

                    <div class="card rounded-3 ">
					

				
					
					
                        <div>
							
                        
                          <center> 
						  <form name="details"
											  class="form-horizontal"
											  role="form"
											  method="POST"
											  action="{{ url('account') }}"
											  enctype="multipart/form-data"
											 
										> 
							   <div class="col-12 col-md-12 p-4">
                                <div class="editdp">
								
					<div class="inner-box default-inner-box">

                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-12">
                            <h3 class="no-padding text-center-480 useradmin">
                                <!-- <a href=""> -->
                                <!-- <img id="userImg" class="userImg" src="{{ $user->photo_url }}" alt="user">&nbsp; -->
                                <!-- {{ $user->name }} -->
                                <!-- </a> -->
                                <b> Coach Dashboard </b>
                            </h3>
                        </div>
                        <div class="col-md-9 col-sm-8 col-12">
                            <div class="header-data text-center-xs">
                                {{-- Threads Stats --}}
                                <div class="hdata">
                                    <div class="mcol-left">
                                        <i class="fas fa-phone-alt ln-shadow"></i>
                                    </div>
                                    <div class="mcol-right">
                                        {{-- Number of messages --}}
                                        <p>
                                            <a href="{{ url('account/messages') }}">
                                                {{ isset($countThreads) ? \App\Helpers\Number::short($countThreads) : 0 }}
                                                <!-- <em>{{ trans_choice('global.count_mails', getPlural($countThreads), [], config('app.locale')) }}</em> -->
                                                <em>{{ trans_choice('Call', getPlural($countThreads), [], config('app.locale')) }}</em>
                                            </a>
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                {{-- Traffic Stats --}}
                                <div class="hdata">
                                    <div class="mcol-left">
                                        <i class="fas fa-comments ln-shadow"></i>
                                    </div>
                                    <div class="mcol-right">
                                        {{-- Number of visitors --}}
                                        <p>
                                            <a href="{{ url('account/chat') }}">
                                                <?php $totalPostsVisits = (isset($countPostsVisits) and $countPostsVisits->total_visits) ? $countPostsVisits->total_visits : 0 ?>
                                                {{ \App\Helpers\Number::short($totalPostsVisits) }}
                                                <!-- <em>{{ trans_choice('global.count_visits', getPlural($totalPostsVisits), [], config('app.locale')) }}</em> -->
                                                <em>{{ trans_choice('Chat', getPlural($totalPostsVisits), [], config('app.locale')) }}</em>
                                            </a>
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                               

                                {{-- Favorites Stats --}}
                                <div class="hdata">
                                    <div class="mcol-left">
                                        <i class="fas fa-bell ln-shadow"></i>
                                    </div>
                                    <div class="mcol-right">
                                        {{-- Number of favorites --}}
                                        <p>
                                            <a href="{{ url('account/favourite') }}">
                                                {{ \App\Helpers\Number::short($countFavoritePosts) }}
                                                <em>{{ trans_choice('Notification', getPlural($countFavoritePosts), [], config('app.locale')) }} </em>
                                            </a>
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
								<img src="{{ $user->photo }}" class="main-profile-img" />
                                    <!-- <i class="fa fa-edit"></i> -->
                                  </div>
                            </div></center>
							
                            <div class="row p-4">
							
										{!! csrf_field() !!}
											<input name="_method" type="hidden" value="PUT">
											<input name="panel" type="hidden" value="user">
                                    <div class="mb-3 col-12 col-md-6">
									<?php $nameError = (isset($errors) && $errors->has('name')) ? ' is-invalid' : ''; ?>
                                        <label class="form-label" for="fname">Display Name<span
                                                class="text-danger">*</span></label>
												<input name="name" type="text" class="form-control{{ $nameError }}" placeholder="Display Name" value="{{ old('name', $user->name) }}">
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
									{{-- username --}}
											<?php $usernameError = (isset($errors) && $errors->has('username')) ? ' is-invalid' : ''; ?>
                                        <label class="form-label" for="lname">Full Name<span
                                                class="text-danger">*</span></label>
												<input id="username"
															   name="username"
															   type="text"
															   class="form-control{{$usernameError}}"
															   placeholder="Full Name"
															   value="{{ old('username', $user->username) }}"
														>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
											
									{{-- email --}}
											<?php $emailError = (isset($errors) && $errors->has('email')) ? ' is-invalid' : ''; ?>
                                        <label class="form-label" for="email">Email<span
                                                class="text-danger">*</span></label>
												@if (!isEnabledField('phone'))
														<!-- <sup>*</sup> -->
													@endif
													<input id="email"
															   name="email"
															   type="email"
															   class="form-control{{ $emailError }}"
															   placeholder="{{ t('email') }}"
															   value="{{ old('email', $user->email) }}"
														>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="email">DOB<span
                                                class="text-danger">*</span></label>
                                                <input type="text"  placeholder="YYYY-MM-DD" pattern="(?:19|20)(?:(?:[13579][26]|[02468][048])-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))|(?:[0-9]{2}-(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:29|30))|(?:(?:0[13578]|1[02])-31)))" class="form-control{{$usernameError}} "  name="eventDate" id="" value="{{ old('date_of_birth', $user->date_of_birth) }}">
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label">Country</label><br>
										<?php $countryCodeError = (isset($errors) and $errors->has('country_code')) ? ' is-invalid' : ''; ?>
                                        <select name="country_code" id="countryCode" class="form-control large-data-selecter{{ $countryCodeError }}">
														<option value="0" {{ (!old('country_code') or old('country_code')==0) ? 'selected="selected"' : '' }}>
															{{ t('select_a_country') }}
														</option>
														@foreach ($countries as $item)
															<option value="{{ $item->get('code') }}" {{ (old('country_code', $user->country_code)==$item->get('code')) ? 'selected="selected"' : '' }}>
																{{ $item->get('name') }}
															</option>
														@endforeach
													</select>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="phone">Phone Number</label>
										<?php $phoneError = (isset($errors) && $errors->has('phone')) ? ' is-invalid' : ''; ?>
										@if (!isEnabledField('email'))
														<!-- <sup>*</sup> -->
													@endif
													<input id="phone" name="phone" type="text" class="form-control{{ $phoneError }}"
															   placeholder="{{ (!isEnabledField('email')) ? t('Mobile Phone Number') : t('phone_number') }}"
															   value="{{ phoneFormat(old('phone', $user->phone), old('country_code', $user->country_code)) }}">
														
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label">Select categories</label><br>
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
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label">Select sub categories</label><br>
                                        <select name="sub_category" id="sub_category" class="form-control large-data-selecter{{ $countryCodeError }}">
													</select>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                    <?php $genderIdError = (isset($errors) && $errors->has('gender_id')) ? ' is-invalid' : ''; ?>
                                        <label class="form-label">Gender</label><br>
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
                                <div class="mb-3 col-12 col-md-12">
								{{-- coach summary --}}
											<?php $coach_summaryError = (isset($errors) && $errors->has('coach_summary')) ? ' is-invalid' : ''; ?>
                                    <label class="form-label" for="phone">Coach Summary
                                    </label>
                                    <textarea name="coach_summary" class="form-control{{ $coach_summaryError }} new-form-control" placeholder="Coach Summary" rows="5">{{ old('coach_summary', $user->coach_summary) }}</textarea>
                                </div>
                                </div>
                                
                                <center>
                                    <div class="col-12">
									<button type="submit" class="btn btn-primary">{{ t('Update') }}</button>
                                    </div>
                                    </center>
                                   
                                    <div class="col-12 col-md-12">
                                        <h4 class="mb-3 mt-3">Bank account Details

                                </h4>
                                    </div>
                                    <div class="mcol-right">
                                        {{-- Number of visitors --}}
                                        <p>
                                            <a href="{{ url('account/chat') }}">
                                                <?php $totalPostsVisits = (isset($countPostsVisits) and $countPostsVisits->total_visits) ? $countPostsVisits->total_visits : 0 ?>
                                                {{ \App\Helpers\Number::short($totalPostsVisits) }}
                                                <!-- <em>{{ trans_choice('global.count_visits', getPlural($totalPostsVisits), [], config('app.locale')) }}</em> -->
                                                <em>{{ trans_choice('Chat', getPlural($totalPostsVisits), [], config('app.locale')) }}</em>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-12 col-md-6">
                                        <input type="int" id="Account" class="form-control" placeholder="Account Number" value="{{ old('Bank_Account', $user->Bank_Account) }}">
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                       
                                        <input type="varchar" id="code" class="form-control" placeholder="Ifsc Code" value="{{ old('Bank_IFSC', $user->Bank_IFSC ) }}">
                                    </div>
                                </div>
                                    <center>
                                        <div class="col-12 ubtn">
                                            <button class="btn btn-primary" type="submit">
                                                Update Bank Details
                                             </button>
                                        </div>
                                    </center>
                                    
                            
								</div>
					
                        </div>
                    </div>
					</form>
							

            </div>
        </div>
        <?php } else {?>
            <div class="container">
            <h2>
           
                <h2 class="sec-title">Edit Profile
                </h2>
				
            </h2>
			<div class="row">
				<div class="col-lg-3">
					

				@includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar', 'account.inc.sidebar'])
        
			</div>
	

			<div class="col-lg-9 ">
				

                    <div class="card rounded-3 ">
					

				
					
					
                        <div>
							
                        
                          <center> 
						  <form name="details"
											  class="form-horizontal"
											  role="form"
											  method="POST"
											  action="{{ url('account') }}"
											  enctype="multipart/form-data"
											 
										> 
							   <div class="col-12 col-md-12 p-4">
                                <div class="editdp">
								
								<?php
								$photoPanelClass = '';
								$photoPanelClass = request()->filled('panel')
									? (request()->get('panel') == 'photo' ? 'show' : $photoPanelClass)
									: ((old('panel')=='' || old('panel') =='photo') ? 'show' : $photoPanelClass);
								?>
								<img src="{{ $user->photo }}" class="main-profile-img" />
                                    <!-- <i class="fa fa-edit"></i> -->
                                  </div>
                            </div></center>
							
                            <div class="row p-4">
							
										{!! csrf_field() !!}
											<input name="_method" type="hidden" value="PUT">
											<input name="panel" type="hidden" value="user">
                                    <div class="mb-3 col-12 col-md-6">
									<?php $nameError = (isset($errors) && $errors->has('name')) ? ' is-invalid' : ''; ?>
                                        <label class="form-label" for="fname">Display Name<span
                                                class="text-danger">*</span></label>
												<input name="name" type="text" class="form-control{{ $nameError }}" placeholder="Display Name" value="{{ old('name', $user->name) }}">
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
									{{-- username --}}
											<?php $usernameError = (isset($errors) && $errors->has('username')) ? ' is-invalid' : ''; ?>
                                        <label class="form-label" for="lname">Full Name<span
                                                class="text-danger">*</span></label>
												<input id="username"
															   name="username"
															   type="text"
															   class="form-control{{$usernameError}}"
															   placeholder="Full Name"
															   value="{{ old('username', $user->username) }}"
														>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
											
									{{-- email --}}
											<?php $emailError = (isset($errors) && $errors->has('email')) ? ' is-invalid' : ''; ?>
                                        <label class="form-label" for="email">Email<span
                                                class="text-danger">*</span></label>
												@if (!isEnabledField('phone'))
														<!-- <sup>*</sup> -->
													@endif
													<input id="email"
															   name="email"
															   type="email"
															   class="form-control{{ $emailError }}"
															   placeholder="{{ t('email') }}"
															   value="{{ old('email', $user->email) }}"
														>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="email">DOB<span
                                                class="text-danger">*</span></label>
                                                <input type="text"  placeholder="YYYY-MM-DD" pattern="(?:19|20)(?:(?:[13579][26]|[02468][048])-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))|(?:[0-9]{2}-(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:29|30))|(?:(?:0[13578]|1[02])-31)))" class="form-control{{$usernameError}} "  name="eventDate" id="" value="{{ old('date_of_birth', $user->date_of_birth) }}">
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label">Country</label><br>
										<?php $countryCodeError = (isset($errors) and $errors->has('country_code')) ? ' is-invalid' : ''; ?>
                                        <select name="country_code" id="countryCode" class="form-control large-data-selecter{{ $countryCodeError }}">
														<option value="0" {{ (!old('country_code') or old('country_code')==0) ? 'selected="selected"' : '' }}>
															{{ t('select_a_country') }}
														</option>
														@foreach ($countries as $item)
															<option value="{{ $item->get('code') }}" {{ (old('country_code', $user->country_code)==$item->get('code')) ? 'selected="selected"' : '' }}>
																{{ $item->get('name') }}
															</option>
														@endforeach
													</select>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label" for="phone">Phone Number</label>
										<?php $phoneError = (isset($errors) && $errors->has('phone')) ? ' is-invalid' : ''; ?>
										@if (!isEnabledField('email'))
														<!-- <sup>*</sup> -->
													@endif
													<input id="phone" name="phone" type="text" class="form-control{{ $phoneError }}"
															   placeholder="{{ (!isEnabledField('email')) ? t('Mobile Phone Number') : t('phone_number') }}"
															   value="{{ phoneFormat(old('phone', $user->phone), old('country_code', $user->country_code)) }}">
														
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label">Select categories</label><br>
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
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label">Select sub categories</label><br>
                                        <select name="sub_category" id="sub_category" class="form-control large-data-selecter{{ $countryCodeError }}">
													</select>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <?php $genderIdError = (isset($errors) && $errors->has('gender_id')) ? ' is-invalid' : ''; ?>

                                        <label class="form-label">Gender</label><br>
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
                                
                                <center>
                                    <div class="col-12">
									<button type="submit" class="btn btn-primary">{{ t('Update') }}</button>
                                    </div>
                                    </center>
                                   
                                    
                                    <div class="col-12 col-md-12">
                                        <h4 class="mb-3 mt-3">Change Password

                                </h4>
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                    <?php $passwordError = (isset($errors) && $errors->has('password')) ? ' is-invalid' : ''; ?>
                                        <label class="form-label" for="address">New Password
                                        </label>
                                        <input id="password" name="password" type="password" class="form-control{{ $passwordError }}" placeholder="{{ t('password') }}">
                                    </div>
                                    <div class="mb-3 col-12 col-md-12">
                                        <label class="form-label" for="address2">Confirm Password</label>
                                        <?php $passwordError = (isset($errors) && $errors->has('password')) ? ' is-invalid' : ''; ?>
                                        <input id="password_confirmation" name="password_confirmation" type="password"
														   class="form-control{{ $passwordError }}" placeholder="{{ t('Confirm Password') }}">
                                    </div>
                                    <center>
                                    <div class="col-12 ubtn">
                                    <button type="submit" class="btn btn-primary"> Update Password</button>
                                        
                                    </div>
                                </center>
                                    
                            
								</div>
							</div>

						</div>
						<!--/.row-box End-->

					</div>
				</div>

				</div>
					<?php }?>
				

					<script src="https://cdnjs.cloudflare.com/ajax/libs/uuid/8.3.2/uuid.min.js" integrity="sha512-UNM1njAgOFUa74Z0bADwAq8gbTcqZC8Ej4xPSzpnh0l6KMevwvkBvbldF9uR++qKeJ+MOZHRjV1HZjoRvjDfNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/validator/13.6.0/validator.min.js" integrity="sha512-xYHcfaQeUiKHs9YsHqjpyLaHnh+q7y8kYuOGdh5FkJeK7Z+dZct7Yoa7h+PtsrKRh03t8eJZuSeCN7b0dkrFwA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
  
  <!-- <script src="js/config.js"></script>

  <script src="js/auth.js"></script>

  <script src="js/firebase.js"></script>

  <script src="js/util.js"></script>
  <script src="js/login.js"></script> -->


			<!--/.row-->
		</div>
		<!--/.container-->
	</div>
	<!-- /.main-container -->


@section('after_styles')
	<link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet">
	@if (config('lang.direction') == 'rtl')
		<link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet">
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
	<script src="{{ url('assets/plugins/bootstrap-fileinput/js/plugins/sortable.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('assets/plugins/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('assets/plugins/bootstrap-fileinput/themes/fas/theme.js') }}" type="text/javascript"></script>
	<script src="{{ url('js/fileinput/locales/' . config('app.locale') . '.js') }}" type="text/javascript"></script>

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
			initialPreview: [
				@if (isset($user->photo) && !empty($user->photo))
					'{{ imgUrl($user->photo, 'user') }}'
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
		$(document).ready(function(){

			var sub_cat_id = {{ old('sub_category', $user->sub_category) }}
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
     </script>
 @endsection
