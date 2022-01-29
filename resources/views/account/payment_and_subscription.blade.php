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
                                <b> My Payments</b>


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


							
								
					<div class="container payment_sbuscription_coach">

					

						<div class="row ">
						<?php 
							if ($user_subscriptions1) {
								
								
							}	
						?>
						
						<br>
								
							
						
							<div class="col-md-3">
							<h4> Revenue till date</h4>
							
							</div>

							
							
							<div class="col-md-3">
							
							</div>

							<div class="col-md-3">

							<h4> Total strivers</h4>
							</div>

							<div class="col-md-3">
							<h4>   </h4>
							</div>
							</div>

							<div class="row">

							<div class="col-md-3">
							<h4> Revenue this month</h4>
							</div>
							<div class="col-md-3">
							</div>
							<div class="col-md-3">
							<h4> Available Balance</h4>
							</div>
							<div class="col-md-3">


							</div>

							</div>
							<div class="row">
							<div class="col-md-3">
							<h4> Revenue this Quarter</h4>
							</div>
							<div class="col-md-3">
							</div>
							
							<div class="col-md-6">
								<button class="btn btn-primary get_paid_payment">Get Paid</button>
							</div>
						</div>
							
					</div>
							<br>


			<div class="inner-box default-inner-box">
							
							
				<div class="row">

							
					<div class="inner-box">
						

					<div class="table-responsive">
					<br>
						<form name="listForm" method="POST" action="{{ url('account/' . $pagePath . '/delete') }}">
							{!! csrf_field() !!}
							<div class="table-action">
								<div class="btn-group hidden-sm" role="group">
									<button type="button" class="btn btn-sm btn-secondary">
										<input type="checkbox" id="checkAll" class="from-check-all">
									</button>
									<button type="button" class="btn btn-sm btn-secondary from-check-all">
										{{ t('Select') }}: {{ t('All') }}
									</button>
								</div>
								
								<button type="submit" class="btn btn-sm btn-default delete-action">
									<i class="fa fa-trash"></i> {{ t('Delete') }}
								</button>
								
								<div class="table-search float-end col-sm-7">
									<div class="form-group">
										<div class="row">
											<label class="col-sm-5 control-label text-end">{{ t('search') }} <br>
												<a title="clear filter" class="clear-filter" href="#clear">[{{ t('clear') }}]</a>
											</label>
											<div class="col-sm-7 searchpan">
												<input type="text" class="form-control" id="filter">
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<table id="addManageTable"
								   class="table table-striped table-bordered add-manage-table table demo"
								   data-filter="#filter"
								   data-filter-text-only="true">
								<thead>
								<tr>
									<!-- <th data-type="numeric" data-sort-initial="true">SN</th> -->
									<th data-type="numeric"><b><h3>{{ ('Student') }}</h3></th>
									<th data-type="numeric" data-sort-ignore="true"><b><h3>{{ ('Course') }}</h3></b></th>
									<th data-type="numeric" data-type="numeric"><b><h3>{{ ('Total amount') }}</h3></b></th>
									<th data-type="numeric" data-type="numeric"><b><h3>{{ ('Fee Date') }}</h3></b></th>
									<th data-type="numeric" data-type="numeric"><b><h3>{{ ('Net Payment') }}</h3></b></th>
									<!-- <th><b><h3>{{ t('Option') }}</h3></b></th> -->
								</tr>
								
								</thead>
								<tbody>
								<?php
								$i =0;
								
								if (isset($user_subscription1) && $user_subscription1->count() > 0):
								foreach($user_subscription1 as $key => $post):

										$i=	$i+1;	 
									// print_r($user_subscription1);die;	
								?>
								
								<tr>
									
									
									<td class="price-td" style="width:20%">
										<div>
											<strong>
											{{ $post->username }}
											
												
											</strong>
										</div>
									</td>

									<td  class="price-td" style="width:40%">
										<div>
											<strong>
											{{ $post->name }}
											
												
											</strong>
										</div>
									</td>

									<td  class="price-td" style="width:10%">
										<div>
											<strong>
											
											<?php  

											

							$total_payment = $post->fee_deducte + $post->net_payment;
								?>

											{{$total_provided_hours}}
												
											</strong>
											<!-- <strong>
											
											{{ $post->currency_code }}
												
											</strong> -->
										</div>
									</td>

									


									<td  class="price-td" style="width:10%">
										<div>
											<strong>
											{{$post->created_at}}
											
												
											</strong>
										</div>
									</td>
									

									<td  class="price-td" style="width:10%">
										<div>
											<strong>
											
											
												
											</strong>
										</div>
									</td>


									<td class="price-td" style="width:10%">
										<div>
											<strong>
										
											
												
											</strong>
										</div>
									</td>
									
									<!-- <td style="width:10%" class="action-td">
										<div>
											@if (in_array($pagePath, ['my-posts', 'pending-approval']) and $post->user_id==$user->id and $post->archived==0)
												<p>
													<a class="btn btn-primary btn-sm" href="{{ \App\Helpers\UrlGen::editPost($post) }}">
														<i class="fa fa-edit"></i> {{ t('Edit') }}
													</a>
												</p>
											@endif
											@if (in_array($pagePath, ['my-posts']) and isVerifiedPost($post) and $post->archived==0)
												<p>
													<a class="btn btn-warning btn-sm confirm-action" href="{{ url('account/'.$pagePath.'/'.$post->id.'/offline') }}">
														<i class="fas fa-eye-slash"></i> {{ t('Offline') }}
													</a>
												</p>
											@endif
											@if (in_array($pagePath, ['archived']) and $post->user_id==$user->id and $post->archived==1)
												<p>
													<a class="btn btn-info btn-sm confirm-action" href="{{ url('account/'.$pagePath.'/'.$post->id.'/repost') }}">
														<i class="fa fa-recycle"></i> {{ t('Repost') }}
													</a>
												</p>
											@endif
											<p>
												<a class="btn btn-danger btn-sm delete-action" href="{{ url('account/'.$pagePath.'/'.$post->id.'/delete') }}">
													<i class="fa fa-trash"></i> {{ t('Delete') }}
												</a>
											</p>
										</div>
									</td> -->
								</tr>
								<?php endforeach; ?>
								
								<?php endif; ?>

								</tbody>
							</table>
						</form>
					</div>
					</div>
					<nav>
						{{ (isset($posts)) ? $posts->links() : '' }}
					</nav>

				</div>

				</div>
					
					</div>
						<!--/.row-box End-->

			</div>
				
				<!--/.page-content-->
				
				<br>
				<div class="row">
					<h3><b> Suggested Strivers</b></h3>
					<?php foreach ($suggested_striver as $coach_list) { ?>
								<div class="col-sm-3" >
									<img src="{{ imgUrl($coach_list->photo, '') }}" class="lazyload img-fluid" style="height: 320px; width:-webkit-fill-available;" alt="{{ $coach_list->name }}">
									<br>
									
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
                                <b> My Subscriptions </b>
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

					<div class="">
						
						<!--/.row-box End-->
						<div class="row">

							<h2 style="text-align:center;"><b>
                            My Subscriptions				</b></h2>
							
							<div class="states">

							<?php
							if($user_subscription){
								?>

							<h2> Total hours : {{$user_subscription->total_provided_hours}} Hours.</h2>
							<h2> Consumed Hours  : {{$user_subscription->consumed_hours}} Hours.</h2>
							<h2> Remaining Hours  : {{$user_subscription->remaining_hours}} Hours.</h2>

								
						<?php //}
							
						?>
						</div>
						</div>
						<br>
								<?php
								if(empty($user_subscription->remaining_hours))
								{
								?>
								<div class="col-md-12" style="text-align: center;">
								<a href="{{ url('subscription') }}" >
																			
									<button   style="font-size: 20px; ">Renew Subscriptions</button>
									</a>
								</div>
								<?php } ?>

						<?php
							}
							else{
								?>

							<div class="col-md-12" style="text-align: center;">
							<h2>Please Get Subscription First!</h2>
							</div>
							<div class="col-md-12" style="text-align: center;">
						<a href="{{ url('subscription') }}" >
																	
							<button   style="font-size: 20px; ">Get Subscriptions</button>
							</a>
						</div>

							<?php }
							?>
						</div>
						
						<br>
						
						
					

					<br>

					
						
						<!--/.row-box End-->
						
							<h2 style="text-align:center;"><b>
                            old  Subscriptions				</b></h2>
							<?php
							
							// 	}
							
								// ?>
							<div class="states">

							<?php
							if($user_subscriptions1){
								?>

							

								
						<?php 
							foreach ($user_subscriptions1 as $key => $value) {
								$name = json_decode($value->name);
											$ss = array();
											foreach ($name as $key => $sub) {
											$ss[$key] = $sub;
											}
							
						?>
						
						<br>
								<?php
								if(empty($user_subscriptions1->remaining_hours))
								{
								?>
								<div class="col-md-12" >
								<h2> Old plan :{{$ss['en']}}</h2>
								<h2> Old plan Hours :{{$value->total_provided_hours}} Hours.</h2>
								</div>
								<?php } ?>
							
						<?php
							}
							
							}	?>
							<br>						
							</div>
							</div>
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
		.states h2{
			margin-top: 50px;
			padding-left: 35px;
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
