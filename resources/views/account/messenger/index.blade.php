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
<!-- <section class="page-banner01" style="background-image: url(../assets/images/home/cta-bg.jpg);">
       
 </section> -->
 
 <section class="page-banner01">
       
 </section>
 @extends('layouts.master_new')
@section('content')
	@includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'])


    <?php if($user->user_type_id == 2){  
        
        
        ?>

    <div class="main-container">
        <div class="container">
        <?php $photo_url1 =ltrim($user->photo_url, 'http://127.0.0.1:8000'); ?>

        <div class="row" style="padding: 6px; margin-left: -4px;">
				
				<div class="col-md-12 user-profile-img-data default-inner-box">
					
					<img id="userImg" class="user-profile-images1" src="{{ url($photo_url1) }}" alt="user" width="50px;" height="50px;" border-radius=" 50%"> &nbsp; 
					<span style="font-size: 24px; font-weight: 700; color: #2c234d;">   <b>  {{ $user->name }}</b> </span>
					
					<div class="containersss">
						<div id="inviteCode" class="invite-page" class="col-md-4">
						<!-- Copy Subscription Link:  -->
						<input id="link" value="https://ycsdigitalstage.co.uk/pricing" readonly style="color:blue; border:none;"> 
							<div id="copy" class="col-md-1">
							<i class="fa fa-duotone fa-copy copy-icon-click-data" aria-hidden="true" data-copytarget="#link"><span class="click-to-copy-text"><a href="#"> Click to Copy</a></span></i>
							</div>
						</div>
						</div>

                    <div class="row">
               
			   <div class="col-md-12 col-sm-8 col-12">
			   <span>

			   
				   <div class="header-data text-center-xs">
					   

                   <!-- <div class="hdata">
										<div class="mcol-left">
											<i class="fas fa-envelope ln-shadow"></i></div>
										<div class="mcol-right">
											{{-- Number of messages --}}
											<p>
												<a href="{{ url('account/messages') }}">
													{{ isset($countThreads) ? \App\Helpers\Number::short($countThreads) : 0 }}
													<em>{{ trans_choice('global.count_mails', getPlural($countThreads), [], config('app.locale')) }}</em>
												</a>
											</p>
										</div>
										<div class="clearfix"></div>
									</div> -->


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
                
                <div class="col-md-3 page-sidebar">
                    @includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar_coach', 'account.inc.sidebar_coach'])
                </div>
                <!--/.page-sidebar-->
                
                <div class="col-md-9 page-content">
                    <div class="inner-box">
                        <h2 class="title-2">
                            <i class="fas fa-envelope"></i> {{ t('inbox') }}
                        </h2>
                        
                        @if (session()->has('flash_notification'))
                            <div class="row">
                                <div class="col-xl-12">
                                    @include('flash::message')
                                </div>
                            </div>
                        @endif
                        
                        <div id="successMsg" class="alert alert-success hide" role="alert"></div>
                        <div id="errorMsg" class="alert alert-danger hide" role="alert"></div>
                        
                        <div class="inbox-wrapper">
                            <div class="row">
                                <div class="col-md-3 col-lg-2">
                                    <div class="btn-group hidden-sm"></div>
                                </div>
                                
                                <div class="col-md-9 col-lg-10">
                                    
                                    <div class="btn-group mobile-only-inline">
                                        <a href="#" class="btn btn-primary text-uppercase">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    </div>
                                    <div class="btn-group hidden-sm">
                                        <button type="button" class="btn btn-secondary">
                                            <div class="form-check p-0 m-0">
                                                <input type="checkbox" id="form-check-all">
                                            </div>
                                        </button>
                                        
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                            <span class="dropdown-menu-sort-selected">{{ t('action') }}</span>
                                        </button>
    
                                        {!! csrf_field() !!}
                                        <ul id="groupedAction" class="dropdown-menu dropdown-menu-sort" role="menu">
                                            <li class="dropdown-item">
                                                <a href="{{ url('account/messages/actions?type=markAsRead') }}">
                                                    {{  t('Mark as read') }}
                                                </a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="{{ url('account/messages/actions?type=markAsUnread') }}">
                                                    {{ t('Mark as unread') }}
                                                </a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="{{ url('account/messages/actions?type=markAsImportant') }}">
                                                    {{ t('Mark as important') }}
                                                </a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="{{ url('account/messages/actions?type=markAsNotImportant') }}">
                                                    {{ t('Mark as not important') }}
                                                </a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="{{ url('account/messages/delete') }}">
                                                    {{ t('Delete') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <button type="button" id="btnRefresh" class="btn btn-secondary hidden-sm" data-bs-toggle="tooltip" title="{{ t('refresh') }}">
                                        <span class="fas fa-sync-alt"></span>
                                    </button>
                                    
                                    <div class="btn-group hidden-sm">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                            {{ t('more') }}
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li class="dropdown-item">
                                                <a class="markAllAsRead">{{ t('Mark all as read') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <div class="message-tool-bar-right float-end" id="linksThreads">
                                        
                                        @include('account.messenger.threads.links')
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="border-0 bg-secondary">
                            
                            <div class="row">
                                @include('account.messenger.partials.sidebar')
                                
                                <div class="col-md-9 col-lg-10">
                                    <div class="message-list">
                                        <div id="listThreads">
                                            
                                            @include('account.messenger.threads.threads')
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/. inbox-wrapper-->
                    </div>
                </div>
                <!--/.page-content-->
            </div>
            <!--/.row-->
        </div>
        <!--/.container-->
    </div>

    <?php }else{ ?>

        <div class="main-container">
        <div class="container">
        <?php $photo_url1 =ltrim($user->photo_url, 'http://127.0.0.1:8000'); ?>

        <div class="row" style="padding: 6px; margin-left: -4px;">
				
				<div class="col-md-12 user-profile-img-data default-inner-box">
					
					<img id="userImg" class="user-profile-images1" src="{{ url($photo_url1) }}" alt="user" width="50px;" height="50px;" border-radius=" 50%"> &nbsp; 
					<span style="font-size: 24px; font-weight: 700; color: #2c234d;">   <b>  {{ $user->name }}</b> </span>
					


                    <div class="row">
               
			   <div class="col-md-12 col-sm-8 col-12">
			   <span>

			   
				   <div class="header-data text-center-xs">
					   

                   <!-- <div class="hdata">
										<div class="mcol-left">
											<i class="fas fa-envelope ln-shadow"></i></div>
										<div class="mcol-right">
											{{-- Number of messages --}}
											<p>
												<a href="{{ url('account/messages') }}">
													{{ isset($countThreads) ? \App\Helpers\Number::short($countThreads) : 0 }}
													<em>{{ trans_choice('global.count_mails', getPlural($countThreads), [], config('app.locale')) }}</em>
												</a>
											</p>
										</div>
										<div class="clearfix"></div>
									</div> -->


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
                
                <div class="col-md-3 page-sidebar">
                    @includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar', 'account.inc.sidebar'])
                </div>
                <!--/.page-sidebar-->
                
                <div class="col-md-9 page-content">
                    <div class="inner-box">
                        <h2 class="title-2">
                            <i class="fas fa-envelope"></i> {{ t('inbox') }}
                        </h2>
                        
                        @if (session()->has('flash_notification'))
                            <div class="row">
                                <div class="col-xl-12">
                                    @include('flash::message')
                                </div>
                            </div>
                        @endif
                        
                        <div id="successMsg" class="alert alert-success hide" role="alert"></div>
                        <div id="errorMsg" class="alert alert-danger hide" role="alert"></div>
                        
                        <div class="inbox-wrapper">
                            <div class="row">
                                <div class="col-md-3 col-lg-2">
                                    <div class="btn-group hidden-sm"></div>
                                </div>
                                
                                <div class="col-md-9 col-lg-10">
                                    
                                    <div class="btn-group mobile-only-inline">
                                        <a href="#" class="btn btn-primary text-uppercase">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    </div>
                                    <div class="btn-group hidden-sm">
                                        <button type="button" class="btn btn-secondary">
                                            <div class="form-check p-0 m-0">
                                                <input type="checkbox" id="form-check-all">
                                            </div>
                                        </button>
                                        
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                            <span class="dropdown-menu-sort-selected">{{ t('action') }}</span>
                                        </button>
    
                                        {!! csrf_field() !!}
                                        <ul id="groupedAction" class="dropdown-menu dropdown-menu-sort" role="menu">
                                            <li class="dropdown-item">
                                                <a href="{{ url('account/messages/actions?type=markAsRead') }}">
                                                    {{  t('Mark as read') }}
                                                </a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="{{ url('account/messages/actions?type=markAsUnread') }}">
                                                    {{ t('Mark as unread') }}
                                                </a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="{{ url('account/messages/actions?type=markAsImportant') }}">
                                                    {{ t('Mark as important') }}
                                                </a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="{{ url('account/messages/actions?type=markAsNotImportant') }}">
                                                    {{ t('Mark as not important') }}
                                                </a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="{{ url('account/messages/delete') }}">
                                                    {{ t('Delete') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <button type="button" id="btnRefresh" class="btn btn-secondary hidden-sm" data-bs-toggle="tooltip" title="{{ t('refresh') }}">
                                        <span class="fas fa-sync-alt"></span>
                                    </button>
                                    
                                    <div class="btn-group hidden-sm">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                            {{ t('more') }}
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li class="dropdown-item">
                                                <a class="markAllAsRead">{{ t('Mark all as read') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <div class="message-tool-bar-right float-end" id="linksThreads">
                                        
                                        @include('account.messenger.threads.links')
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="border-0 bg-secondary">
                            
                            <div class="row">
                                @include('account.messenger.partials.sidebar')
                                
                                <div class="col-md-9 col-lg-10">
                                    <div class="message-list">
                                        <div id="listThreads">
                                            
                                            @include('account.messenger.threads.threads')
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/. inbox-wrapper-->
                    </div>
                </div>
                <!--/.page-content-->
            </div>
            <!--/.row-->
        </div>
        <!--/.container-->
    </div>
      <?php  }?>
    <!-- /.main-container -->

    @includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.footer1', 'layouts.inc.footer1'])
<!-- /.main-container -->

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
<script src="{{ url('../assets/plugins/bootstrap-fileinput/js/plugins/sortable.min.js') }}" type="text/javascript"></script>
<script src="{{ url('../assets/plugins/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
<script src="{{ url('../assets/plugins/bootstrap-fileinput/themes/fas/theme.js') }}" type="text/javascript"></script>
<script src="{{ url('js/fileinput/locales/' . config('app.locale') . '.js') }}" type="text/javascript"></script>


@endsection

@section('after_styles')
    <style>
        {{-- Center image related to the parent element --}}
        .loading-img {
            position: absolute;
            width: 32px;
            height: 32px;
            left: 50%;
            top: 50%;
            margin-left: -16px;
            margin-right: -16px;
            z-index: 100000;
        }
    </style>
@endsection

@section('after_scripts')
	<script>
        var loadingImage = '{{ url('images/loading.gif') }}';
        var loadingErrorMessage = '{{ t('Threads could not be loaded') }}';
        var confirmMessage = '{{ t('confirm_this_action') }}';
        var actionText = '{{ t('action') }}';
        var actionErrorMessage = '{{ t('This action could not be done') }}';
        var title = {
            'seen': '{{ t('Mark as read') }}',
            'notSeen': '{{ t('Mark as unread') }}',
            'important': '{{ t('Mark as important') }}',
            'notImportant': '{{ t('Mark as not important') }}',
        };
	</script>
    <script src="{{ url('assets/js/app/messenger.js') }}" type="text/javascript"></script>
@endsection