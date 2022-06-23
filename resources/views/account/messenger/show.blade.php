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
<style>
    .goog-te-gadget .goog-te-combo {
    margin: 4px 0;
    /* background: beige; */
    background: black;
    color:white;
}
</style>

<section class="page-banner01">
</section>
@extends('layouts.master_new')

@section('content')
	@includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'])

    <?php if($user->user_type_id == 2){  
        
        
        ?>

    <div class="main-container">
        <div class="container">
            <div class="row">
        
            <?php $photo_url1 =ltrim($user->photo_url, 'http://127.0.0.1:8000'); ?>
            <div class="col-md-12 user-profile-img-data default-inner-box">
					
					<img id="userImg" class="user-profile-images1" src="{{url($photo_url1) }}" alt="user" width="50px;" height="50px;" border-radius=" 50%"> &nbsp; 
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
							   <img src="{{url('/assets/images/chat_call.png')}}" alt="">
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
			<!-- </div> -->

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
                        
                        @if (isset($errors) && $errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ t('Close') }}"></button>
                                <ul class="list list-check">
                                    @foreach($errors->all() as $error)
                                        <li class="mb-0">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
    
                        <div id="successMsg" class="alert alert-success hide" role="alert"></div>
                        <div id="errorMsg" class="alert alert-danger hide" role="alert"></div>
                        
                        <div class="inbox-wrapper">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="user-bar-top">
                                        <div class="user-top">
                                            <p>
                                                <!-- <a href="{{ url('account/messages') }}"> -->
                                                <a href="{{ url('account/chat') }}">
                                                    <i class="fas fa-inbox"></i>
                                                </a>&nbsp;
                                                @if (auth()->id() != $thread->creator()->id)
                                                    <a href="#user">
                                                        @if (isUserOnline($thread->creator()))
                                                            <i class="fa fa-circle color-success"></i>&nbsp;
                                                        @endif
                                                        <strong>
                                                            <a href="{{ \App\Helpers\UrlGen::user($thread->creator()) }}">
                                                                {{ $thread->creator()->name }}
                                                            </a>
                                                        </strong>
                                                    </a>
                                                @endif
                                                <strong>{{ t('Contact request about') }}</strong> <a href="{{ \App\Helpers\UrlGen::post($thread->post) }}">{{ $thread->post->title }}</a>
                                            </p>
                                        </div>
    
                                        <div class="message-tool-bar-right float-end call-xhr-action">
                                            <div class="btn-group btn-group-sm">
                                                @if ($thread->isImportant())
                                                    <a href="{{ url('account/messages/' . $thread->id . '/actions?type=markAsNotImportant') }}"
                                                       class="btn btn-secondary markAsNotImportant"
                                                       data-bs-toggle="tooltip"
                                                       data-bs-placement="top"
                                                       title="{{ t('Mark as not important') }}"
                                                    >
                                                        <i class="fas fa-star"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ url('account/messages/' . $thread->id . '/actions?type=markAsImportant') }}"
                                                       class="btn btn-secondary markAsImportant"
                                                       data-bs-toggle="tooltip"
                                                       data-bs-placement="top"
                                                       title="{{ t('Mark as important') }}"
                                                    >
                                                        <i class="far fa-star"></i>
                                                    </a>
                                                @endif
                                                <a href="{{ url('account/messages/' . $thread->id . '/delete') }}"
                                                   class="btn btn-secondary"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   title="{{ t('Delete') }}"
                                                >
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                @if ($thread->isUnread())
                                                    <a href="{{ url('account/messages/' . $thread->id . '/actions?type=markAsRead') }}"
                                                       class="btn btn-secondary markAsRead"
                                                       data-bs-toggle="tooltip"
                                                       data-bs-placement="top"
                                                       title="{{ t('Mark as read') }}"
                                                    >
                                                        <i class="fas fa-envelope"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ url('account/messages/' . $thread->id . '/actions?type=markAsUnread') }}"
                                                       class="btn btn-secondary markAsRead"
                                                       data-bs-toggle="tooltip"
                                                       data-bs-placement="top"
                                                       title="{{ t('Mark as unread') }}"
                                                    >
                                                        <i class="fas fa-envelope-open"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="border-0 bg-secondary">
                            
                            <div class="row">
                                @include('account.messenger.partials.sidebar')
                                
                                <div class="col-md-9 col-lg-10 chat-row">
                                    <div class="message-chat p-2 rounded">
                                        <div id="messageChatHistory" class="message-chat-history">
                                            <div id="linksMessages" class="text-center">
                                                {!! $linksRender !!}
                                            </div>
                                            
                                            @include('account.messenger.messages.messages')
                                            
                                        </div>

                                        <div class="type-message">
                                            <div class="type-form">
                                                <?php $updateUrl = url('account/messages/' . $thread->id); ?>
                                                <form id="chatForm" role="form" method="POST" action="{{ $updateUrl }}" enctype="multipart/form-data">
                                                    {!! csrf_field() !!}
                                                    <input name="_method" type="hidden" value="PUT">
                                                    <textarea id="body"
                                                          name="body"
                                                          maxlength="500"
                                                          rows="3"
                                                          class="input-write form-control"
                                                          placeholder="{{ t('Type a message') }}"
                                                          style="{{ (config('lang.direction')=='rtl') ? 'padding-left' : 'padding-right' }}: 75px;"
                                                    ></textarea>
                                                    <div class="button-wrap">
                                                        <input id="addFile" name="filename" type="file">
                                                        <button id="sendChat" class="btn btn-primary" type="submit">
                                                            <i class="fas fa-paper-plane" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
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
    <?php }else{?>

        <div class="main-container">
        <div class="container">
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
                        
                        @if (isset($errors) && $errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ t('Close') }}"></button>
                                <ul class="list list-check">
                                    @foreach($errors->all() as $error)
                                        <li class="mb-0">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
    
                        <div id="successMsg" class="alert alert-success hide" role="alert"></div>
                        <div id="errorMsg" class="alert alert-danger hide" role="alert"></div>
                        
                        <div class="inbox-wrapper">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="user-bar-top">
                                        <div class="user-top">
                                            <p>
                                                <!-- <a href="{{ url('account/messages') }}"> -->
                                                <a href="{{ url('account/chat') }}">
                                                    <i class="fas fa-inbox"></i>
                                                </a>&nbsp;
                                                @if (auth()->id() != $thread->creator()->id)
                                                    <a href="#user">
                                                        @if (isUserOnline($thread->creator()))
                                                            <i class="fa fa-circle color-success"></i>&nbsp;
                                                        @endif
                                                        <strong>
                                                            <a href="{{ \App\Helpers\UrlGen::user($thread->creator()) }}">
                                                                {{ $thread->creator()->name }}
                                                            </a>
                                                        </strong>
                                                    </a>
                                                @endif
                                                <strong>{{ t('Contact request about') }}</strong> <a href="{{ \App\Helpers\UrlGen::post($thread->post) }}">{{ $thread->post->title }}</a>
                                            </p>
                                        </div>
    
                                        <div class="message-tool-bar-right float-end call-xhr-action">
                                            <div class="btn-group btn-group-sm">
                                                @if ($thread->isImportant())
                                                    <a href="{{ url('account/messages/' . $thread->id . '/actions?type=markAsNotImportant') }}"
                                                       class="btn btn-secondary markAsNotImportant"
                                                       data-bs-toggle="tooltip"
                                                       data-bs-placement="top"
                                                       title="{{ t('Mark as not important') }}"
                                                    >
                                                        <i class="fas fa-star"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ url('account/messages/' . $thread->id . '/actions?type=markAsImportant') }}"
                                                       class="btn btn-secondary markAsImportant"
                                                       data-bs-toggle="tooltip"
                                                       data-bs-placement="top"
                                                       title="{{ t('Mark as important') }}"
                                                    >
                                                        <i class="far fa-star"></i>
                                                    </a>
                                                @endif
                                                <a href="{{ url('account/messages/' . $thread->id . '/delete') }}"
                                                   class="btn btn-secondary"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   title="{{ t('Delete') }}"
                                                >
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                @if ($thread->isUnread())
                                                    <a href="{{ url('account/messages/' . $thread->id . '/actions?type=markAsRead') }}"
                                                       class="btn btn-secondary markAsRead"
                                                       data-bs-toggle="tooltip"
                                                       data-bs-placement="top"
                                                       title="{{ t('Mark as read') }}"
                                                    >
                                                        <i class="fas fa-envelope"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ url('account/messages/' . $thread->id . '/actions?type=markAsUnread') }}"
                                                       class="btn btn-secondary markAsRead"
                                                       data-bs-toggle="tooltip"
                                                       data-bs-placement="top"
                                                       title="{{ t('Mark as unread') }}"
                                                    >
                                                        <i class="fas fa-envelope-open"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="border-0 bg-secondary">
                            
                            <div class="row">
                                @include('account.messenger.partials.sidebar')
                                
                                <div class="col-md-9 col-lg-10 chat-row">
                                    <div class="message-chat p-2 rounded">
                                        <div id="messageChatHistory" class="message-chat-history">
                                            <div id="linksMessages" class="text-center">
                                                {!! $linksRender !!}
                                            </div>
                                            
                                            @include('account.messenger.messages.messages')
                                            
                                        </div>

                                        <div class="type-message">
                                            <div class="type-form">
                                                <?php $updateUrl = url('account/messages/' . $thread->id); ?>
                                                <form id="chatForm" role="form" method="POST" action="{{ $updateUrl }}" enctype="multipart/form-data">
                                                    {!! csrf_field() !!}
                                                    <input name="_method" type="hidden" value="PUT">
                                                    <textarea id="body"
                                                          name="body"
                                                          maxlength="500"
                                                          rows="3"
                                                          class="input-write form-control"
                                                          placeholder="{{ t('Type a message') }}"
                                                          style="{{ (config('lang.direction')=='rtl') ? 'padding-left' : 'padding-right' }}: 75px;"
                                                    ></textarea>
                                                    <div class="button-wrap">
                                                        <input id="addFile" name="filename" type="file">
                                                        <button id="sendChat" class="btn btn-primary" type="submit">
                                                            <i class="fas fa-paper-plane" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
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

        <?php }?>
    <!-- /.main-container -->

    @includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.footer1', 'layouts.inc.footer1'])
<!-- /.main-container -->

<a href="#" id="back-to-top">
	<i class="fal fa-angle-double-up"></i>
</a>
<!-- Back To Top -->

<!-- Start Include All JS -->
<script src="{{url('/assets/js/jquery.js')}}"></script>
<script src="{{url('/assets/js/bootstrap.min.js')}}"></script>
<script src="{{url('/assets/js/jquery.appear.js')}}"></script>
<script src="{{url('/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{url('/assets/js/slick.js')}}"></script>
<script src="{{url('/assets/js/jquery.nice-select.min.js')}}"></script>
<script src="{{url('/assets/js/swiper-bundle.min.js')}}"></script>
<script src="{{url('/assets/js/TweenMax.min.js')}}"></script>
<script src="{{url('/assets/js/lightcase.js')}}"></script>
<script src="{{url('/assets/js/jquery.plugin.min.js')}}"></script>
<script src="{{url('/assets/js/jquery.countdown.min.js')}}"></script>
<script src="{{url('/assets/js/jquery.easing.1.3.js')}}"></script>
<script src="{{url('/assets/js/jquery.shuffle.min.js')}}"></script>

<script src="{{url('/assets/js/theme.js')}}"></script>

@endsection

@section('after_styles')
    @parent
    <link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet">
    @if (config('lang.direction') == 'rtl')
        <link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet">
    @endif
    <style>
        .file-input {
            display: inline-block;
        }
    </style>
@endsection

@section('after_scripts')
    @parent

    <script>
        var loadingImage = '{{ url('images/loading.gif') }}';
        var loadingErrorMessage = '{{ t('Threads could not be loaded') }}';
        var confirmMessage = '{{ t('confirm_this_action') }}';
        var actionErrorMessage = '{{ t('This action could not be done') }}';
        var title = {
            'seen': '{{ t('Mark as read') }}',
            'notSeen': '{{ t('Mark as unread') }}',
            'important': '{{ t('Mark as important') }}',
            'notImportant': '{{ t('Mark as not important') }}',
        };
    </script>
    <script src="{{ url('../assets/js/app/messenger.js') }}" type="text/javascript"></script>
    <script src="{{ url('../assets/js/app/messenger-chat.js') }}" type="text/javascript"></script>
    
    <script src="{{ url('../assets/plugins/bootstrap-fileinput/js/plugins/sortable.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('../assets/plugins/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('../assets/plugins/bootstrap-fileinput/themes/fas/theme.js') }}" type="text/javascript"></script>
    <script src="{{ url('../js/fileinput/locales/' . config('app.locale') . '.js') }}" type="text/javascript"></script>
    
    <script>
        /* Initialize with defaults (filename) */
        $('#addFile').fileinput(
        {
            theme: 'fas',
            language: '{{ config('app.locale') }}',
            @if (config('lang.direction') == 'rtl')
                rtl: true,
            @endif
            allowedFileExtensions: {!! getUploadFileTypes('file', true) !!},
            maxFileSize: {{ (int)config('settings.upload.max_file_size', 1000) }},
            browseClass: 'btn btn-primary',
            browseIcon: '<i class="fas fa-paperclip" aria-hidden="true"></i>',
            layoutTemplates: {
                main1: '{browse}',
                main2: '{browse}',
                btnBrowse: '<div tabindex="500" class="{css}"{status}>{icon}</div>',
            }
        });
    </script>
@endsection