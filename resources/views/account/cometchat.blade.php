


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
@extends('layouts.master_new')

<section class="page-banner01" style="background-image: url(../assets/images/home/cta-bg.jpg);">
       
</section>

@section('content')
@includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'])

<?php if($user->user_type_id == 2){ ?>

<div class="main-container">
    <div class="container">


    <!-- <div class="row ">
            <div class="col-md-3 page-sidebar">
			  <div class="inner-box default-inner-box">
                <h3 class="no-padding text-center-480 useradmin">
                    <a href="">
                        <img id="userImg" class="userImg user_profile_img" src="{{ $user->photo_url }}" alt="user"> &nbsp; 
                        {{ $user->name }}
                    </a>
                </h3>
			  </div>
            </div>

            <div class="col-md-9 page-content ">


					<div class="inner-box default-inner-box edit-file-chat">
					<div class="row">
                        <div class="col-md-4 col-sm-4 col-12">
                            <h3 class="no-padding text-center-480 useradmin">
                               
                                <b> Coach Connect to Strivre </b>
                            </h3>
                        </div>
                        <div class="col-md-8 col-sm-8 col-12">
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
	</div> -->


    <h2>

		<h2 class="sec-title">Coach Connect to Strivre</h2>
	</h2>



	<div class="row" style="padding: 6px; margin-left: -4px;">
			
			
        <div class="col-md-12 user-profile-img-data default-inner-box">

                <!-- <img id="userImg" class="user-profile-images" src="{{ $user->photo_url }}" alt="user" width="50px;" height="50px;" border-radius=" 50%"> &nbsp;  -->

                <?php if(!empty($user->photo)){
					?>
					
					<img id="userImg" class="user-profile-images1" src="{{ url('storage/'.$user->photo) }}" alt="user" width="50px;" height="50px;" border-radius=" 50%"> &nbsp; 
					<?php }else{ ?>

						<img id="userImg" class="user-profile-images1" src="/images/user.jpg" alt="user" width="50px;" height="50px;" border-radius=" 50%"> &nbsp; 

						<?php }?>
                <span style="font-size: 24px; font-weight: 700; color: #2c234d;">   <b> {{ $user->name }}  </b> </span>
            
                <div class="row">
               
			   <div class="col-md-12 col-sm-8 col-12">
			   <span>

			   
				   <div class="header-data text-center-xs">
					   
					   <div class="hdata">
					   <a href="{{ url('account/chat') }}">
						   <div class="mcol-left">
							   <!-- <i class="fas fa-comments ln-shadow"></i> -->
							   <img src="../assets/images/chat_call.png" alt="">
						   </div>
						   <div class="mcol-right">
							   {{-- Number of visitors --}}
							   <p>
								   
									  
									   <em>Call / Message</em>
								  
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

            @if (session()->has('flash_notification'))
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-12">
                        @include('flash::message')
                    </div>
                </div>
            </div>
            @endif

            <div class="col-md-3 page-sidebar">
                @includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar_coach', 'account.inc.sidebar_coach'])
            </div>
            <!--/.page-sidebar-->

            <div class="col-md-9">
   

    <div class="row">

                <div class="inner-box default-inner-box">

                    <div id="cometchat" style="position: sticky;"></div>
                    <script>



                            // let newUser: User = User(uid: "user1", name: "Kevin") // Replace with your uid and the name for the user to be created.
                            // let authKey = "AUTH_KEY" // Replace with your Auth Key.
                            // CometChat.createUser(user: newUser, apiKey: authKey, onSuccess: {
                            //     (User) in
                            //     print("User created successfully. \(User.stringValue())")
                            // }) {
                            //     (error) in
                            //     print("The error is \(String(describing: error?.description))")
                            // }
                        


                        valueArray = <?php echo json_encode($auth_user_name->username); ?>;
                        
                        window.addEventListener('DOMContentLoaded', (event) => {
                            CometChatWidget.init({
                                "appID": "2092607fb09acc5d",
                                "appRegion": "us",
                                "authKey": "5de6e5cebecc59e0a723c4e125ecd585a0a0cb84"
                            }).then(response => {
                                console.log("Initialization completed successfully");
                                //You can now call login function.
                                CometChatWidget.login({
                                    "uid": valueArray
                                }).then(response => {
                                    CometChatWidget.launch({
                                        "widgetID": "286764bf-4a55-46f7-aa54-2a4c86ab1fde",
                                        "target": "#cometchat",
                                        "roundedCorners": "true",
                                        "height": "600px",
                                        "width": "800px",
                                        "defaultID": valueArray, //default UID (user) or GUID (group) to show,
                                        "defaultType": 'user' //user or group
                                    });
                                }, error => {
                                    console.log("User login failed with error:", error);
                                    //Check the reason for error and take appropriate action.
                                });
                            }, error => {
                                console.log("Initialization failed with error:", error);
                                //Check the reason for error and take appropriate action.
                            });
                        });
                    </script>
                </div>
                </div>

            </div>
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
@endsection

@section('after_styles')
<style>
    .action-td p {
        margin-bottom: 5px;
    }
</style>
@endsection

@section('after_scripts')
<script defer src="https://widget-js.cometchat.io/v3/cometchatwidget.js"></script>

<script src="{{ url('assets/js/footable.js?v=2-0-1') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/footable.filter.js?v=2-0-1') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $('#addManageTable').footable().bind('footable_filtering', function(e) {
            var selected = $('.filter-status').find(':selected').text();
            if (selected && selected.length > 0) {
                e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
                e.clear = !e.filter;
            }
        });

        $('.clear-filter').click(function(e) {
            e.preventDefault();
            $('.filter-status').val('');
            $('table.demo').trigger('footable_clear_filter');
        });

        $('.from-check-all').click(function() {
            checkAll(this);
        });

        $('a.delete-action, button.delete-action, a.confirm-action').click(function(e) {
            e.preventDefault(); /* prevents the submit or reload */
            var confirmation = confirm("{{ t('confirm_this_action') }}");

            if (confirmation) {
                if ($(this).is('a')) {
                    var url = $(this).attr('href');
                    if (url !== 'undefined') {
                        redirect(url);
                    }
                } else {
                    $('form[name=listForm]').submit();
                }
            }

            return false;
        });
    });
</script>
{{-- include custom script for ads table [select all checkbox]  --}}
<script>
    function checkAll(bx) {
        if (bx.type !== 'checkbox') {
            bx = document.getElementById('checkAll');
            bx.checked = !bx.checked;
        }

        var chkinput = document.getElementsByTagName('input');
        for (var i = 0; i < chkinput.length; i++) {
            if (chkinput[i].type == 'checkbox') {
                chkinput[i].checked = bx.checked;
            }
        }
    }
</script>

<?php }else {?>


<div class="main-container">
    <div class="container">

    <!-- <div class="row ">
            <div class="col-md-3 page-sidebar">
			  <div class="inner-box default-inner-box">
                <h3 class="no-padding text-center-480 useradmin">
                    <a href="">
                        <img id="userImg" class="userImg user_profile_img" src="{{ $user->photo_url }}" alt="user"> &nbsp; 
                        {{ $user->name }}
                    </a>
                </h3>
			  </div>
            </div>

            <div class="col-md-9 page-content ">


					<div class="inner-box default-inner-box edit-file-chat">
					<div class="row">
                        <div class="col-md-4 col-sm-4 col-12">
                            <h3 class="no-padding text-center-480 useradmin">
                               
                                <b> Strivre connect to Coaches </b>
                            </h3>
                        </div>
                        <div class="col-md-8 col-sm-8 col-12">
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
	</div> -->


    <h2>

<h2 class="sec-title">Coach Connect to Strivres</h2>
</h2>



<div class="row" style="padding: 6px; margin-left: -4px;">
    
    
<div class="col-md-12 user-profile-img-data default-inner-box">

        <!-- <img id="userImg" class="user-profile-images" src="{{ $user->photo_url }}" alt="user" width="50px;" height="50px;" border-radius=" 50%"> &nbsp;  -->

        <?php if(!empty($user->photo)){
					?>
					
					<img id="userImg" class="user-profile-images1" src="{{ url('storage/'.$user->photo) }}" alt="user" width="50px;" height="50px;" border-radius=" 50%"> &nbsp; 
					<?php }else{ ?>

						<img id="userImg" class="user-profile-images1" src="/images/user.jpg" alt="user" width="50px;" height="50px;" border-radius=" 50%"> &nbsp; 

						<?php }?>
        <span style="font-size: 24px; font-weight: 700; color: #2c234d;">   <b> {{ $user->name }}  </b> </span>
    

        <div class="row">
               
			   <div class="col-md-12 col-sm-8 col-12">
			   <span>

			   
				   <div class="header-data text-center-xs">
					   
					   <div class="hdata">
					   <a href="{{ url('account/chat') }}">
						   <div class="mcol-left">
							   <!-- <i class="fas fa-comments ln-shadow"></i> -->
							   <img src="../assets/images/chat_call.png" alt="">
						   </div>
						   <div class="mcol-right">
							   {{-- Number of visitors --}}
							   <p>
								   
									  
									   <em>Call / Message</em>
								  
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

            @if (session()->has('flash_notification'))
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-12">
                        @include('flash::message')
                    </div>
                </div>
            </div>
            @endif

            <div class="col-md-3 page-sidebar">
                @includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar', 'account.inc.sidebar'])
            </div>
            <!--/.page-sidebar-->

            <div class="col-md-9 page-content">

            <div class="row">


                <div class="inner-box default-inner-box">

                    <div id="cometchat" style="position: sticky;"></div>
                    <script>
                        valueArray = <?php echo json_encode($auth_user_name->username); ?>;
                        
                        window.addEventListener('DOMContentLoaded', (event) => {
                            CometChatWidget.init({
                                "appID": "2092607fb09acc5d",
                                "appRegion": "us",
                                "authKey": "5de6e5cebecc59e0a723c4e125ecd585a0a0cb84"
                            }).then(response => {
                                console.log("Initialization completed successfully");
                                //You can now call login function.
                                CometChatWidget.login({
                                    "uid": valueArray
                                }).then(response => {
                                    CometChatWidget.launch({
                                        "widgetID": "286764bf-4a55-46f7-aa54-2a4c86ab1fde",
                                        "target": "#cometchat",
                                        "roundedCorners": "true",
                                        "height": "600px",
                                        "width": "800px",
                                        "defaultID": valueArray, //default UID (user) or GUID (group) to show,
                                        "defaultType": 'user' //user or group
                                    });
                                }, error => {
                                    console.log("User login failed with error:", error);
                                    //Check the reason for error and take appropriate action.
                                });
                            }, error => {
                                console.log("Initialization failed with error:", error);
                                //Check the reason for error and take appropriate action.
                            });
                        });
                    </script>
                </div>
                </div>

            </div>
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

    
@endsection

@section('after_styles')
<style>
    .action-td p {
        margin-bottom: 5px;
    }
</style>
@endsection

@section('after_scripts')
<script defer src="https://widget-js.cometchat.io/v3/cometchatwidget.js"></script>

<script src="{{ url('assets/js/footable.js?v=2-0-1') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/footable.filter.js?v=2-0-1') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $('#addManageTable').footable().bind('footable_filtering', function(e) {
            var selected = $('.filter-status').find(':selected').text();
            if (selected && selected.length > 0) {
                e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
                e.clear = !e.filter;
            }
        });

        $('.clear-filter').click(function(e) {
            e.preventDefault();
            $('.filter-status').val('');
            $('table.demo').trigger('footable_clear_filter');
        });

        $('.from-check-all').click(function() {
            checkAll(this);
        });

        $('a.delete-action, button.delete-action, a.confirm-action').click(function(e) {
            e.preventDefault(); /* prevents the submit or reload */
            var confirmation = confirm("{{ t('confirm_this_action') }}");

            if (confirmation) {
                if ($(this).is('a')) {
                    var url = $(this).attr('href');
                    if (url !== 'undefined') {
                        redirect(url);
                    }
                } else {
                    $('form[name=listForm]').submit();
                }
            }

            return false;
        });
    });
</script>
{{-- include custom script for ads table [select all checkbox]  --}}
<script>
    function checkAll(bx) {
        if (bx.type !== 'checkbox') {
            bx = document.getElementById('checkAll');
            bx.checked = !bx.checked;
        }

        var chkinput = document.getElementsByTagName('input');
        for (var i = 0; i < chkinput.length; i++) {
            if (chkinput[i].type == 'checkbox') {
                chkinput[i].checked = bx.checked;
            }
        }
    }
</script>

<?php }?>

@endsection



