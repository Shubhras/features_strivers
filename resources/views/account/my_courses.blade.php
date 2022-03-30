<script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
<!-- <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script> -->


@extends('layouts.master_new')

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css" />
<section class="page-banner01" style="background-image: url(../assets/images/home/cta-bg.jpg);">
</section>

@section('content')
@includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'])


<section style="background-color: white;">
	<div class="main-container">
		<div class="container">

			<?php if ($user->user_type_id == 2) {

			?>

				<h2>

					<h2 class="sec-title">My Consultation</h2>
				</h2>


				<div class="row" style="padding: 6px; margin-left: -4px;">


					<div class="col-md-12 user-profile-img-data default-inner-box">

						<img id="userImg" class="user-profile-images" src="{{ $user->photo_url }}" alt="user" width="50px;" height="50px;" border-radius=" 50%"> &nbsp;
						<span style="font-size: 24px; font-weight: 700; color: #2c234d;"> <b> {{ $user->name }} </b> </span>


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
												<div class="mcol-left">
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

					<div class="col-md-3 page-sidebar">

						@includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar_coach', 'account.inc.sidebar_coach'])
					</div>
					<div class="col-md-9 page-content">


						@include('flash::message')



						<!-- <div class="inner-box default-inner-box"> -->

						<div class="row">

							<div class="inner-box">

								<h2 class="title-2"> {{ ('My Consultation') }}

									<button id="myBtn" class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#myModal">+ Create Consultation</button>
								</h2>


								<div class="table-responsive">
									<form name="listForm" method="POST" action="{{ url('account/' . $pagePath . '/delete') }}">
										{!! csrf_field() !!}
										<!-- <div class="table-action">
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

											<table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true">
												<thead>
													<tr>
														<th data-type="numeric" data-sort-initial="true">sn</th>
														<th>{{ ('Course name') }}</th>
														<th data-sort-ignore="true">{{ ('Course Hourse') }}</th>
														<th data-type="numeric">{{ ('Description') }}</th>
														<th data-type="numeric">{{ ('Starting Time') }}</th>

														<th>{{ t('Option') }}</th>
													</tr>
												</thead>
												<tbody>

													<?php
													$i = 0;
													if (isset($coach_course) && $coach_course->count() > 0) :
														foreach ($coach_course as $key => $post) :
															// Fixed 1


															// Get Post's URL

															$i =	$i + 1;

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
																<td style="width:45%" class="price-td">
																	<div>
																		<strong>

																			{{ $post->description }}

																		</strong>
																	</div>
																</td>
																<td style="width:5%" class="price-td">
																	<div>
																		<strong>

																			{{ $post->starting_time }}

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
											</table> -->
									</form>
								</div>

								<nav>
									{{ (isset($posts)) ? $posts->links() : '' }}
								</nav>



								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
									<div class="modal-dialog" role="document">

										<form name="details" class="" role="form" method="POST" action="{{ url('/account/create_course') }}" id="create_course_id">
											<div class="modal-content">
												<div class="modal-header">

													<h4 class="modal-title" id="exampleModalLabel">Create Consultation</h4>
												</div>
												<div class="modal-body">


													<div class="row">
														<div class="col-md-6">
															<label for="recipient-name" class="control-label create-consultation-modal">Consultation Name:</label>

															<input type="text" class="consultation-modal-text" id="course_name" name="course_name">



														</div>

														<div class="col-md-6">

															<label for="recipient-name" class="control-label create-consultation-modal">Consultation Fee Per Hour ($) :</label>

															<input type="number" class="consultation-modal-text" id="consultation_fee_per_hour" name="consultation_fee_per_hour" placeholder="Consultation fee per hour ($) ">


														</div>


													</div>


													<div class="row">

														<div class="col-md-6">

															<label for="recipient-name" class="control-label create-consultation-modal">Consultation Hours:</label>

															<input type="number" class="consultation-modal-text" id="course_hourse" name="course_hourse" placeholder="Enter Hours ">


														</div>


														<div class="col-md-6">
															<label for="recipient-name" class="control-label create-consultation-modal">Consultation Available - Date:</label>
															<input type="date" class="consultation-modal-text" id="dated" name="dated" placeholder="yyyy/mm/dd">
														</div>



													</div>

													<div class="row">


														<div class="col-md-6">
															<label for="recipient-name" class="control-label create-consultation-modal"> Total Consultation Fee ($) :</label>
															<input type="text" class="consultation-modal-text" id="total_consultation_fee" name="total_consultation_fee" placeholder="Total Consultation Fee">
														</div>
														<div class="col-md-6">

															<label for="add-image" class="control-label create-consultation-modal">Creadit Required:</label>

															<input type="text" class="consultation-modal-text" id="creadit_required" name="creadit_required" placeholder="Creadit Required">
														</div>


													</div>


													<div class="row">


														<div class="col-md-12">
															<label for="add-image" class="control-label create-consultation-modal">Featured Image:</label>



															<input type="file" class="consultation-modal-text" id="image" name="image" action="image.*" placeholder="add images">
														</div>


													</div>

													<div class="row">
														<div class="col-md-12">
															<label for="message-text" class="control-label create-consultation-modal">Description:</label>


															<a href="#" style="margin-left: 177px;font-size: 14px;font-weight: 500;">Help</a>

															<!-- <div id="editor" name="description" placeholder="This is some sample consultation content."> -->

															<textarea name="description" id="description" rows="10" cols="80"></textarea>

															<!-- </div> -->
															<script>
																ClassicEditor
																	.create(document.querySelector('#description'), {

																		placeholder: 'Note  - Please work out a plan for this consultation and add detailed description of consultation package.  e.g.  Session 1 @ 1 hour (discovery)  Session 2 @ 1 hour (education review) Session 3 @ 1 hour (planning steps for success).... and so on '
																		

																	})
																	.then(description => {
																		console.log(description);
																	})
																	.catch(error => {
																		console.error(error);
																	});
															</script>
															<!-- <script>
																CKEDITOR.replace('editor');
															</script> -->
														</div>

													</div>

												</div>

												<div class="modal-footer">

													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

													<button type="submit" class="btn btn-primary">Submit</button>

												</div>
										</form>


									</div>
								</div>
							</div>


							<!-- </div> -->


							<!-- <div class="inner-box default-inner-box"> -->


							<div class="row">
								<?php
								foreach ($coach_coarsee as  $coaches_corsee) {
								?>
									<div class="col-lg-4 col-md-6">
										<div class="feature-course-item-4">
											<div class="fcf-thumb">
												<img src="{{ url('storage/'.$coaches_corsee->photo) }}" alt=""class ="image-height" style="height: 244px; weight: 244px;">
												<a class="enroll" href="#">Enroll Now</a>
											</div>

											<div class="fci-details">
												<a href="#" class="c-cate sort_name">
													<i class="fas fa-tags"></i>
													{{$coaches_corsee->course_name}}</a>
												<h4><a href="single-course.html">Using Creative Problem Solving</a></h4>
												<div class="author">
													<img src="{{ url('storage/'.$coaches_corsee->photo) }}" alt="">
													<a href="#">{{$coaches_corsee->name}}</a>
												</div>
												<div class="price-rate">
													<div class="course-price"><a>
															{{$coaches_corsee->total_consultation_fee}} fee
														</a>
													</div>

												</div>
											</div>
										</div>

									</div>
								<?php } ?>
							</div>






							<!-- </div> -->



							<!--/.page-content-->
						</div>

						<br>



					<?php } else { ?>


						<h2>

							<h2 class="sec-title sec-add">All Course</h2>
						</h2>

						<div class="row" style="padding: 6px; margin-left: -4px;">


							<div class="col-md-12 user-profile-img-data default-inner-box">

								<img  id="userImg" class="user-profile-images" src="{{ $user->photo_url }}" alt="user" width="50px;" height="50px;" border-radius=" 50%"> &nbsp;
								<span style="font-size: 24px; font-weight: 700; color: #2c234d;"> <b> {{ $user->name }} </b> </span>


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
														<div class="mcol-left">
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

							<div class="col-md-3 page-sidebar">

								@includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar', 'account.inc.sidebar'])
							</div>
							<div class="col-md-9 page-content">


								<div class="inner-box default-inner-box">


									<div class="row">
										<?php
										foreach ($coach_striver as  $coaches_corsee) {
										?>
											<div class="col-lg-4 col-md-6">
												<div class="feature-course-item-4">
													<div class="fcf-thumb">
														<img src="{{ url('storage/'.$coaches_corsee->image) }}" alt="" style="height: 244px; weight: 244px;">
														<a class="enroll" href="#">Enroll Now</a>
													</div>
													<div class="fci-details">
														<a href="#" class="c-cate"><i class="fas fa-tags"></i>{{$coaches_corsee->course_name}}</a>
														<h4><a href="#">Using Creative Problem Solving</a></h4>
														<div class="author">
															<img src="{{ url('storage/'.$coaches_corsee->photo) }}" alt="">
															<a href="#">{{$coaches_corsee->name}}</a>
														</div>
														<div class="price-rate">
															<div class="course-price"><a>
																	{{$coaches_corsee->course_hourse}} Hours
																</a>
															</div>

														</div>
													</div>
												</div>

											</div>
										<?php } ?>

									</div>
								</div>
								<br>

							<?php } ?>

							<!--/.row-->
							</div>

						</div>
</section>

<div class="main-section">
	<div class="container">

		<h2 class="sec-title" style="font-weight: 700;">
			Suggested Coaches

		</h2>

		<div class="row">
			<?php foreach ($suggested_coaches as $coach_list) { ?>
				<div class="col-lg-3 col-md-6">
					<div class="teacher-item">
						<div class="teacher-thumb coach-img-wrapper">
							<img src="{{ url('storage/'.$coach_list->photo) }}" alt="Jim Séchen">
							<div class="teacher-social">
								<a href="#">
									<i aria-hidden="true" class="fab fa-facebook-f"></i>
								</a>
								<a href="#">
									<i aria-hidden="true" class="fab fa-twitter"></i>
								</a>
								<a href="#">
									<i aria-hidden="true" class="fab fa-pinterest-p"></i>
								</a>
								<a href="#">
									<i aria-hidden="true" class="fab fa-vimeo-v"></i>
								</a>
							</div>
						</div>
						<div class="teacher-meta">
							<h5 style="font-weight: 700;">
								{{ $coach_list->name }}
							</h5>
							<p>Stylist &amp; Author
							</p>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>



</div>
<!--/.container-->
</div>

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




<script>
	$('#exampleModal').on('show.bs.modal', function(event) {
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
   $('#course_hourse').keyup(function(){
       var consultation_fee_per_hour;
       var course_hourse;
       consultation_fee_per_hour = parseFloat($('#consultation_fee_per_hour').val());
       course_hourse = parseFloat($('#course_hourse').val());
       var total_consultation_fee = consultation_fee_per_hour * course_hourse;
	   var creadit_required = total_consultation_fee / 5; 
       $('#total_consultation_fee').val(total_consultation_fee.toFixed(2));
	   $('#creadit_required').val(creadit_required.toFixed(2));
   });
</script>

<script>
   $('#consultation_fee_per_hour').keyup(function(){
       var consultation_fee_per_hour;
       var course_hourse;
       consultation_fee_per_hour = parseFloat($('#consultation_fee_per_hour').val());
       course_hourse = parseFloat($('#course_hourse').val());
       var total_consultation_fee = consultation_fee_per_hour * course_hourse;
       var creadit_required = total_consultation_fee / 5; 
       $('#total_consultation_fee').val(total_consultation_fee.toFixed(2));
	   $('#creadit_required').val(creadit_required.toFixed(2));
   });
</script>



<script>
	// when category dropdown changes





	$(document).ready(function() {

		$("form").submit(function(event) {
			var formData = {
				course_name: $("#course_name").val(),
				consultation_fee_per_hour: $("#consultation_fee_per_hour").val(),
				course_hourse: $("#course_hourse").val(),
				total_consultation_fee: $("#total_consultation_fee").val(),
				creadit_required: $("#creadit_required").val(),
				image: $("#image").val(),
				description: $("#description").val(),
				starting_time: $("#starting_time").val(),
				dated: $("#dated").val(),
			};

			$.ajax({
				type: "POST",
				url: "{{ url('account/create_course') }}",
				data: formData,
				dataType: "json",
				encode: true,
			}).success(function(data) {
				document.getElementsByClassName("close")[0].click = true;
				document.getElementById("myModal").style.display = "none";
				location.reload(); // console.log("hello welcome to digiprima technology");
			});

			event.preventDefault();
		});
	});
</script>

<style>
	.teacher-meta {
		position: relative;
		padding: 25px 15px 0;
	}


	.teacher-meta h5 {
		font-size: 16px;
		line-height: 24px;
		color: #2c234d;
		margin: 0 0 7px;
		font-weight: 700 !important;

	}



</style>


<style>
    /* .sort_name {
        display: inline-block;
        width: 120px;
        white-space: nowrap;
        overflow: hidden !important;
        text-overflow: ellipsis;
        font-weight: 500;
    } */


    @media only screen and (max-width: 1440px) {
        .sort_name {
            display: inline-block;
            width: 237px;
            white-space: nowrap;
            overflow: hidden !important;
            text-overflow: ellipsis;
            font-weight: 500;
        }
    }

	@media only screen and (min-width: 1441px) and (max-width: 2560px) {
        .sort_name {
            display: inline-block;
            width: 400px;
            white-space: nowrap;
            overflow: hidden !important;
            text-overflow: ellipsis;
            font-weight: 500;
        }
    }


	/* @media only screen and (min-width: 320px) and (max-width: 425px) {
        .sort_name {
            display: inline-block;
            width: 400px;
            white-space: nowrap;
            overflow: hidden !important;
            text-overflow: ellipsis;
            font-weight: 500;
        }
    }

	@media only screen and (min-width: 1025px) and (max-width: 1440px) {
        .sort_name {
            display: inline-block;
            width: 237px;
            white-space: nowrap;
            overflow: hidden !important;
            text-overflow: ellipsis;
            font-weight: 500;
        }
    } */




    @media only screen and (max-width: 1024px) {
        .sort_name {
            display: inline-block;
            width: 191px;
            white-space: nowrap;
            overflow: hidden !important;
            text-overflow: ellipsis;
            font-weight: 500;
        }
    }
</style>






@endsection