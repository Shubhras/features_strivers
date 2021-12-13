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
	@includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'])
	<div class="main-container">
		<div class="container">
			
		<div class="row ">
            <div class="col-md-3 page-sidebar inner-box default-inner-box coach_profile_img">
                <h3 class="no-padding text-center-480 useradmin">
                    <a href="">
                        <img id="userImg" class="userImg user_profile_img" src="{{ $user->photo_url }}" alt="user">&nbsp;
                        {{ $user->name }}
                    </a>
                </h3>
            </div>

            <div class="col-md-9 page-sidebar">

            </div>
        </div>


				<?php if($user->user_type_id == 2){

				?>
				<div class="row">

<div class="col-md-3 page-sidebar sidebar_coach">
					@includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar_coach', 'account.inc.sidebar_coach'])
				</div>
				<div class="col-md-9 page-content coach_dashboard">

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

                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-12">
                            <h3 class="no-padding text-center-480 useradmin">
                                <!-- <a href=""> -->
                                <!-- <img id="userImg" class="userImg" src="{{ $user->photo_url }}" alt="user">&nbsp; -->
                                <!-- {{ $user->name }} -->
                                <!-- </a> -->
                                <b> My Strivers</b>
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
                                            <a href="{{ url('account/my-posts') }}">
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
							
				<div class="row">
						<?php foreach ($my_striver as $coach_list) { ?>
							<div class="col-sm-4" >
								<img src="{{ imgUrl($coach_list->photo, '') }}" class="lazyload img-fluid" style="height: 320px; width: -webkit-fill-available" alt="{{ $coach_list->name }}">
								<br>
								<?php
										// $name = json_decode($coach_list->slug);
										// $ss = array();
										// foreach ($name as $key => $sub) {
										// $ss[$key] = $sub;
										// }
								?>
								<h4><b>{{ $coach_list->name }}</b></h4>
								
								
							</div>

						<?php } ?>
	 					</div>

						</div>
						<!--/.row-box End-->

					</div>
				</div>
				<!--/.page-content-->
				
				<br>
				<div class="row">
					<h3><b> Suggested Strivers</b></h3>
					<?php foreach ($suggested_striver as $coach_list) { ?>
								<div class="col-sm-3" >
									<img src="{{ imgUrl($coach_list->photo, '') }}" class="lazyload img-fluid" style="height: 320px; width:-webkit-fill-available;" alt="{{ $coach_list->name }}">
									<br>
									<?php
											// $name = json_decode($coach_list->slug);
											// $ss = array();
											// foreach ($name as $key => $sub) {
											// $ss[$key] = $sub;
											// }
									?>
									<h4><b>{{ $coach_list->name }}</b></h4>
									
									
								</div>

							<?php } ?>

					</div>
					</div>
				

				<?php } else {?>

					<div class="row">

				<div class="col-md-3 page-sidebar sidebar_coach">
					@includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar', 'account.inc.sidebar'])
				</div>

					<div class="col-md-9 page-content coach_dashboard">

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
					<div class="row">
                        <div class="col-md-4 col-sm-4 col-12">
                            <h3 class="no-padding text-center-480 useradmin">
                                <!-- <a href=""> -->
                                <!-- <img id="userImg" class="userImg" src="{{ $user->photo_url }}" alt="user">&nbsp; -->
                                <!-- {{ $user->name }} -->
                                <!-- </a> -->
                                <b> My Coaches </b>
                            </h3>
                        </div>
                        <div class="col-md-8 col-sm-8 col-12">
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
                                            <a href="{{ url('account/my-posts') }}">
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
						
						<!--/.row-box End-->
						<div class="row">

							<?php foreach ($my_coaches as $coach_list) { ?>
								<div class="col-sm-4" >
									<img src="{{ imgUrl($coach_list->photo, '') }}" class="lazyload img-fluid" style="height: 320px; width: -webkit-fill-available" alt="{{ $coach_list->name }}">
									<br>
									<?php
											// $name = json_decode($coach_list->slug);
											// $ss = array();
											// foreach ($name as $key => $sub) {
											// $ss[$key] = $sub;
											// }
									?>
									<h4><b>{{ $coach_list->name }}</b></h4>
									
									
								</div>

							<?php } ?>
							</div>

						</div>
					</div>

					</div>

					<br>

					<div class="row">
					<h3><b> Suggested Coaches</b></h3>
					<?php foreach ($suggested_coaches as $coach_list) { ?>
								<div class="col-sm-3" >
									<img src="{{ imgUrl($coach_list->photo, '') }}" class="lazyload img-fluid" style="height: 320px; width:-webkit-fill-available;" alt="{{ $coach_list->name }}">
									<br>
									<?php
											// $name = json_decode($coach_list->slug);
											// $ss = array();
											// foreach ($name as $key => $sub) {
											// $ss[$key] = $sub;
											// }
									?>
									<h4><b>{{ $coach_list->name }}</b></h4>
									
									
								</div>

							<?php } ?>

					</div>


				<?php }?>
				
			<!--/.row-->
		</div>
		<!--/.container-->
	</div>
	<!-- /.main-container -->
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
