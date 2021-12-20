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

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
					
					<div class="inner-box default-inner-box">

                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-12">
                            <h3 class="no-padding text-center-480 useradmin">
                                <!-- <a href=""> -->
                                <!-- <img id="userImg" class="userImg" src="{{ $user->photo_url }}" alt="user">&nbsp; -->
                                <!-- {{ $user->name }} -->
                                <!-- </a> -->
                                <b> My Courses</b>
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
						
				<div class="inner-box">
						
						<h2 class="title-2"> {{ ('My Courses') }} 

						<button id="myBtn" class="btn btn-primary" style="float: right;">+ Create Course</button></h2>
					
					
					<div class="table-responsive">
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
								   data-filter-text-only="true"
							>
								<thead>
								<tr>
									<th data-type="numeric" data-sort-initial="true">sn</th>
									<th>{{ ('Course name') }}</th>
									<th data-sort-ignore="true">{{ ('Course Hourse') }}</th>
									<th data-type="numeric">{{ ('Description') }}</th>
									<th>{{ t('Option') }}</th>
								</tr>
								</thead>
								<tbody>

								<?php
								$i =0;
								if (isset($coach_course) && $coach_course->count() > 0):
								foreach($coach_course as $key => $post):
									// Fixed 1
									

									// Get Post's URL

								$i=	$i+1;
									
								?>
								<tr>
									
									<td style="width:5%" class="items-details-td">
										<div>
											
											<p>
												<strong>
													{{$i}}
												</strong>
												
											</p>
											<p>
												
											</p>
										</div>
									</td>
									<td style="width:30%" class="price-td">
										<div>
											<strong>
											&nbsp;{{ $post->course_name }}
											
												
											</strong>
										</div>
									</td>


									<td style="width:5%" class="price-td">
										<div>
											<strong>
											{{ $post->course_hourse }}
											
												
											</strong>
										</div>
									</td>
									<td style="width:50%" class="price-td">
										<div>
											<strong>
											
											{{ $post->description }}
												
											</strong>
										</div>
									</td>
									
									<td style="width:10%" class="action-td">
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
									</td>
								</tr>
								<?php endforeach; ?>
								<?php endif; ?>
								</tbody>
							</table>
						</form>
					</div>
						
					<nav>
						{{ (isset($posts)) ? $posts->links() : '' }}
					</nav>

				</div>
							
									<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
									<div class="modal-dialog" role="document">

									<form name="details" class="" role="form" method="POST" action="{{ url('/account/create_course') }}" id="create_course_id"> 
										<div class="modal-content">
										<div class="modal-header">
											
											<h4 class="modal-title" id="exampleModalLabel">Create Course</h4> 
										</div>
										<div class="modal-body">
										
											
											<div class="form-group">
												<label for="recipient-name" class="control-label">Course Name</label>
												<input type="text" class="form-control" id="course_name" name="course_name">
											</div>
											<div class="form-group">
												<label for="recipient-name" class="control-label">Course Hours:</label>
												<input type="text" class="form-control" id="course_hourse" name="course_hourse">
											</div>

											<div class="form-group">
												<label for="message-text" class="control-label">Description:</label>
												<textarea class="form-control" id="description" name="description" rows="4"></textarea>
											</div>
											
										</div>
										<div class="modal-footer">

											<button type="button" class="btn btn-close close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true" style="float: right;">Close</span></button>

											<button type="submit" class="btn btn-primary">Submit</button>

										</div>
										</form>
										</div>
									</div>
									</div>



							<!-- </div> -->

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
					
					<div class="inner-box default-inner-box">
					<div class="row">
                        <div class="col-md-4 col-sm-4 col-12">
                            <h3 class="no-padding text-center-480 useradmin">
                                <!-- <a href=""> -->
                                <!-- <img id="userImg" class="userImg" src="{{ $user->photo_url }}" alt="user">&nbsp; -->
                                <!-- {{ $user->name }} -->
                                <!-- </a> -->
                                <b> My Courses </b>
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

						<div class="inner-box">
						
						<h2 class="title-2"> {{ ('My Courses') }} 

						<!-- <button id="myBtn" class="btn btn-primary" style="float: right;">+ Create Course</button></h2> -->
					
					
					<div class="table-responsive">
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
								   data-filter-text-only="true"
							>
								<thead>
								<tr>
									<th data-type="numeric" data-sort-initial="true">sn</th>
									<th>{{ ('Course name') }}</th>
									<th data-sort-ignore="true">{{ ('Course Hourse') }}</th>
									<th data-type="numeric">{{ ('Description') }}</th>
									<th>{{ t('Option') }}</th>
								</tr>
								</thead>
								<tbody>

								<?php
								$i =0;
								if (isset($coach_course) && $coach_course->count() > 0):
								foreach($coach_course as $key => $post):
									// Fixed 1
									

									// Get Post's URL

								$i=	$i+1;
									
								?>
								<tr>
									
									<td style="width:5%" class="items-details-td">
										<div>
											
											<p>
												<strong>
													{{$i}}
												</strong>
												
											</p>
											<p>
												
											</p>
										</div>
									</td>
									<td style="width:30%" class="price-td">
										<div>
											<strong>
											&nbsp;{{ $post->course_name }}
											
												
											</strong>
										</div>
									</td>


									<td style="width:5%" class="price-td">
										<div>
											<strong>
											{{ $post->course_hourse }}
											
												
											</strong>
										</div>
									</td>
									<td style="width:50%" class="price-td">
										<div>
											<strong>
											
											{{ $post->description }}
												
											</strong>
										</div>
									</td>
									
									<td style="width:10%" class="action-td">
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
									</td>
								</tr>
								<?php endforeach; ?>
								<?php endif; ?>
								</tbody>
							</table>
						</form>
					</div>
						
					<nav>
						{{ (isset($posts)) ? $posts->links() : '' }}
					</nav>

				</div>
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

$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})
</script>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>


<script>
	     // when category dropdown changes
		

	


				$(document).ready(function () {
					
			$("form").submit(function (event) {
				var formData = {
					course_name: $("#course_name").val(),
					course_hourse: $("#course_hourse").val(),
					description: $("#description").val(),
				};

				$.ajax({
				type: "POST",
				url: "{{ url('account/create_course') }}",
				data: formData,
				dataType: "json",
				encode: true,
				}).done(function (data) {
				console.log(data);
				});

				event.preventDefault();
			});
			});

     </script>
@endsection
