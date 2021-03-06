<script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
<!-- <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script> -->


@extends('layouts.master_new')

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css" />

<section class="page-banner01">
</section>

@section('content')
@includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'])
<?php
                        $index_and_footer_logo = DB::table('logo_header_and_footer_and_images_change')->select('logo_header_and_footer_and_images_change.*')->first();

                        ?>

<?php if ($user->user_type_id == 2) {

?>

	<section style="background-color: white;">
		<div class="main-container">
			<div class="container">

				<?php $photo_url1 = ltrim($user->photo_url, 'http://127.0.0.1:8000'); ?>



				<h2>

					<h2 class="sec-title">My Consultation</h2>
				</h2>


				<div class="row" style="padding: 6px; margin-left: -4px;">


					<div class="col-md-12 user-profile-img-data default-inner-box">

						<!-- <img id="userImg" class="user-profile-images" src="{{ $user->photo_url }}" alt="user" width="50px;" height="50px;" border-radius=" 50%"> &nbsp; -->
						<?php if (!empty($user->photo)) {
						?>

							<img id="userImg" class="user-profile-images1" src="{{ url('storage/'.$user->photo) }}" alt="user" width="50px;" height="50px;" border-radius=" 50%"> &nbsp;
						<?php } else { ?>

							<img id="userImg" class="user-profile-images1" src="/images/user.jpg" alt="user" width="50px;" height="50px;" border-radius=" 50%"> &nbsp;

						<?php } ?>
						<span style="font-size: 24px; font-weight: 700; color: #2c234d;"> <b> {{ $user->name }} </b> </span>
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

					<div class="col-md-3 page-sidebar ptop">

						@includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar_coach', 'account.inc.sidebar_coach'])
					</div>
					<div class="col-md-9 page-content ptop">


						@include('flash::message')



						<!-- <div class="inner-box default-inner-box"> -->

						<div class="row">

							<div class="inner-box">

								<h2 class="title-2"> {{ ('Credit by him') }}

									<?php $activeAccount =  auth()->user()->active;

									if ($activeAccount == 1) {
									?>

										<button id="myBtn" class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#myModal">+ Create Consultation</button>

									<?php } else {
									?>
										<button  class="btn btn-primary" style="float: right;"  onclick="myFunction()">+ Create Consultation</button>


									<?php } ?>
								</h2>


								<nav>
									{{ (isset($posts)) ? $posts->links() : '' }}
								</nav>



								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
									<div class="modal-dialog" role="document">

										<form name="details" class="" role="form" method="POST" action="{{ url('/account/create_course') }}" id="create_course_id" enctype="multipart/form-data">
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
															<input type="date" class="consultation-modal-text" id="dated" name="dated" placeholder="d/m/yy">
														</div>



													</div>

													<div class="row">


														<div class="col-md-6">
															<label for="recipient-name" class="control-label create-consultation-modal"> Total Consultation Fee ($) :</label>
															<input type="text" class="consultation-modal-text" id="total_consultation_fee" name="total_consultation_fee" placeholder="Total Consultation Fee">
														</div>
														<div class="col-md-6">

															<label for="add-image" class="control-label create-consultation-modal">Credit Required:</label>

															<input type="text" class="consultation-modal-text" id="creadit_required" name="creadit_required" placeholder="Credit Required">
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

																		placeholder: 'Note  - Please work out a plan for this consultation and add detailed description of consultation package.?? e.g.  Session 1 @ 1 hour (discovery)?? Session 2 @ 1 hour (education review) Session 3 @ 1 hour (planning steps for success).... and so on??'


																	})
																	.then(description => {
																		console.log(description);
																	})
																	.catch(error => {
																		console.error(error);
																	});
															</script>



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

								<!-- pending account  -->

								<script>
									function myFunction() {
										
										alert("Your account is pending for admin approval. Once approved, it will be visible to website visitors.");
									}
								</script>


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
										<img src="{{ url('storage/'.$coaches_corsee->image) }}" alt="" class="image-height" style="height: 244px; weight: 244px;">
										<!-- <a class="enroll" href="{{url('../get_coach_course/'.$coaches_corsee->id)}}" onclick="customSession()">View Package</a> -->
									</div>

									<div class="fci-details">
										<a href="{{url('../get_coach_course/'.$coaches_corsee->id)}}" class="c-cate sort_name">
											<i class="fas fa-tags"></i>
											{{$coaches_corsee->course_name}}</a>
										<h4><a href="{{url('../get_coach_course/'.$coaches_corsee->id)}}">Using Creative Problem Solving</a></h4>
										<div class="author">
											<img src="{{ url('storage/'.$coaches_corsee->photo) }}" alt="">
											<a href="{{url('../get_coach_course/'.$coaches_corsee->id)}}">{{$coaches_corsee->name}}</a>
										</div>
										<div class="price-rate">
											<div class="course-price"><a>
													{{$coaches_corsee->total_consultation_fee}} $ Credit
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





			</div>
	</section>


	<div class="main-section">
		<div class="container">

			<h2 class="sec-title" style="font-weight: 700;">
				Suggested {{$index_and_footer_logo->change_strivre_name}}

			</h2>

			<div class="row">
				<?php foreach ($suggested_striver as $coach_list) { ?>
					<div class="col-lg-3 col-md-6">
						<div class="teacher-item">
							<div class="teacher-thumb coach-img-wrapper">


								<?php if ($coach_list->photo != null) { ?>
									<img src="{{ url('storage/'.$coach_list->photo) }}" alt="Jim S??chen">

								<?php } else { ?>

									<img src="../images/user_default.jpg" alt="Basic">

								<?php } ?>


							</div>
							<div class="teacher-meta">
								<p class="top-coaches-name-list coach-cat-name12 ">
									{{ $coach_list->name }}
								</p>
								<!-- <p class="lh">Stylist &amp; Author
								</p> -->

								<?php

								$conditions = $coach_list->category;
								$x = explode(",", $conditions);
								$catss =  json_encode($x);
								$catUser = json_decode($catss);


								if (!empty($catUser)) {
									foreach ($catUser as $val) {
										$q1 = DB::table('categories')->select('categories.name as categories_slug')->where('categories.id', $val)->first();




										$name = json_decode($q1->categories_slug);
										$ss = array();
										foreach ($name as $key => $sub) {
											$ss[$key] = $sub;
										}


								?>

										<p class="text-center">{{$ss['en']}}
										</p>
									<?php
									}
								} else {
									?>
									<p class=" text-center">Others
									</p>
								<?php } ?>

							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>


<?php } else { ?>

	<br>
	<section style="background-color: white;">
		<div class="main-container">
			<div class="container">

				<?php $photo_url1 = ltrim($user->photo_url, 'http://127.0.0.1:8000'); ?>


				<h2>

					<h2 class="sec-title">My Consultation</h2>
				</h2>

				<div class="row" style="padding: 6px; margin-left: -4px;">

					<div class="col-sm-12 form-group">
						@if(Session::has('messagess'))
						<p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('messagess') }}</p>
						@endif
						<!-- @if(Session::has('loginerror'))
                  <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('loginerror') }} <a href="{{url('/pricing') }}" style="color: red;"><b> Click the Subscriptions</b></a></p>
                  @endif -->
					</div>
					<div class="col-md-12 user-profile-img-data default-inner-box">

						<!-- <img id="userImg" class="user-profile-images1" src="{{ url($photo_url1) }}" alt="user" width="50px;" height="50px;" border-radius=" 50%"> &nbsp; -->
						<?php if (!empty($user->photo)) {
						?>

							<img id="userImg" class="user-profile-images1" src="{{ url('storage/'.$user->photo) }}" alt="user" width="50px;" height="50px;" border-radius=" 50%"> &nbsp;
						<?php } else { ?>

							<img id="userImg" class="user-profile-images1" src="/images/user.jpg" alt="user" width="50px;" height="50px;" border-radius=" 50%"> &nbsp;

						<?php } ?>
						<span style="font-size: 24px; font-weight: 700; color: #2c234d;"> <b> {{ $user->name }} </b> </span>


						<div class="row">

							<div class="col-md-12 col-sm-8 col-12">
								<span>


									<div class="header-data text-center-xs">

										<div class="hdata">
											<a href="{{ url('account/chat') }}">
												<div class="mcol-left1">
													<!-- <i class="fas fa-comments ln-shadow"></i> -->
													<img src="../assets/images/chat_call.png" alt="">
												</div>
												<div class="mcol-right1">
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

					<div class="col-md-3 page-sidebar ptop">

						@includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar', 'account.inc.sidebar'])
					</div>
					<div class="col-md-9 page-content ptop">


						<div class="inner-box default-inner-box">
							<h2 class="title-2"> {{ ('My Consultation') }}</h2>


							<div class="row">
								<?php
								foreach ($enroll_coach_coarse as  $coaches_corsee) {
								?>
									<div class="col-lg-4 col-md-6">
										<div class="feature-course-item-4">
											<div class="fcf-thumb">
												<img src="{{ url('storage/'.$coaches_corsee->image) }}" alt="" style="height: 244px;">
												<a class="enroll" href="{{url('../get_coach_course/'.$coaches_corsee->id)}}">View Package</a>
											</div>
											<div class="fci-details">
												<a href="{{url('../get_coach_course/'.$coaches_corsee->id)}}" class="c-cate sort_name"><i class="fas fa-tags"></i>{{$coaches_corsee->course_name}}</a>
												<h4><a href="{{url('../get_coach_course/'.$coaches_corsee->id)}}">Using Creative Problem Solving</a></h4>
												<div class="author">
													<img src="{{ url('storage/'.$coaches_corsee->photo) }}" alt="">
													<a href="{{url('../get_coach_course/'.$coaches_corsee->id)}}">{{$coaches_corsee->name}}</a>
												</div>


												<div class="price-rate">
													<div class="course-price">

														@if($coaches_corsee->total_consultation_fee != null)

														<a>
															{{$coaches_corsee->creadit_required}}$ Credits
														</a>
														@else
														0 $ Credits
														@endif
													</div>

												</div>



											</div>
										</div>

									</div>
								<?php } ?>

							</div>
						</div>
						<br>



						<!--/.row-->
					</div>
	</section>

	<div class="main-section">
		<div class="container">






			<div class="row">

				<h2 class="sec-title" style="font-weight: 700;">
					Pending Consultation

				</h2>

				<?php
				foreach ($enroll_coach_coarse_pending as  $coaches_corsee) {
				?>
					<div class="col-lg-3 col-md-6">
						<div class="feature-course-item-4">
							<div class="fcf-thumb">
								<img src="{{ url('storage/'.$coaches_corsee->image) }}" alt="" style="height: 244px;">
								<a class="enroll" href="{{url('../get_coach_course/'.$coaches_corsee->id)}}" onclick="customSession()">View Package</a>
							</div>
							<div class="fci-details">
								<a href="{{url('../get_coach_course/'.$coaches_corsee->id)}}" class="c-cate sort_name"><i class="fas fa-tags"></i>{{$coaches_corsee->course_name}}</a>
								<h4><a href="{{url('../get_coach_course/'.$coaches_corsee->id)}}">Using Creative Problem Solving</a></h4>
								<div class="author">
									<img src="{{ url('storage/'.$coaches_corsee->photo) }}" alt="">
									<a href="{{url('../get_coach_course/'.$coaches_corsee->id)}}">{{$coaches_corsee->name}}</a>
								</div>


								<div class="price-rate">
									<div class="course-price">

										@if($coaches_corsee->total_consultation_fee != null)

										<a>
											<!-- {{$coaches_corsee->total_consultation_fee}}$ Credits -->

											{{$coaches_corsee->creadit_required}}$ Credits
										</a>
										@else
										0 $ Credits
										@endif
									</div>

								</div>



							</div>
						</div>

					</div>
				<?php } ?>
			</div>
			<br>



			<div class="row">

				<h2 class="sec-title" style="font-weight: 700;">
					Suggested Consultation

				</h2>

				<?php
				foreach ($coach_striver as  $coaches_corsee) {
				?>
					<div class="col-lg-3 col-md-6">
						<div class="feature-course-item-4">
							<div class="fcf-thumb">
								<img src="{{ url('storage/'.$coaches_corsee->image) }}" alt="" style="height: 244px;">
								<a class="enroll" href="{{url('../get_coach_course/'.$coaches_corsee->id)}}" onclick="customSession()">View Package</a>
							</div>
							<div class="fci-details">
								<a href="{{url('../get_coach_course/'.$coaches_corsee->id)}}" class="c-cate sort_name"><i class="fas fa-tags"></i>{{$coaches_corsee->course_name}}</a>
								<h4><a href="{{url('../get_coach_course/'.$coaches_corsee->id)}}">Using Creative Problem Solving</a></h4>
								<div class="author">
									<img src="{{ url('storage/'.$coaches_corsee->photo) }}" alt="">
									<a href="{{url('../get_coach_course/'.$coaches_corsee->id)}}">{{$coaches_corsee->name}}</a>
								</div>


								<div class="price-rate">
									<div class="course-price">

										@if($coaches_corsee->total_consultation_fee != null)

										<a>
											<!-- {{$coaches_corsee->total_consultation_fee}}$ Credits -->

											{{$coaches_corsee->creadit_required}}$ Credits
										</a>
										@else
										0 $ Credits
										@endif
									</div>

								</div>



							</div>
						</div>

					</div>
				<?php } ?>
			</div>
			<br>

			<div class="row">

				<h2 class="sec-title" style="font-weight: 700;">
					Suggested Coaches

				</h2>
				<?php foreach ($suggested_coaches as $coach_list) { ?>
					<div class="col-lg-3 col-md-6">

						<a href="{{url('/top_coach_detail/'.$coach_list->id) }}">
							<div class="teacher-item">
								<div class="teacher-thumb coach-img-wrapper">


									<?php if ($coach_list->photo != null) { ?>
										<img src="{{ url('storage/'.$coach_list->photo) }}" alt="Jim S??chen">

									<?php } else { ?>

										<img src="../images/user_default.jpg" alt="Basic">

									<?php } ?>


								</div>
								<div class="teacher-meta">
									<p class="top-coaches-name-list coach-cat-name12 ">
										{{ $coach_list->name }}
									</p>




									<?php

									$conditions = $coach_list->category;
									$x = explode(",", $conditions);
									$catss =  json_encode($x);
									$catUser = json_decode($catss);



									if (!empty($catUser)) {
										foreach ($catUser as $val) {
											$q1 = DB::table('categories')->select('categories.name as categories_slug')->where('categories.id', $val)->first();




											$name = json_decode($q1->categories_slug);
											$ss = array();
											foreach ($name as $key => $sub) {
												$ss[$key] = $sub;
											}


									?>

											<p class="text-center">{{$ss['en']}}
											</p>
										<?php
										}
									} else {
										?>
										<p class=" text-center">Others
										</p>
									<?php } ?>
								</div>
							</div>
						</a>
					</div>
				<?php } ?>
			</div>



		</div>
	</div>

<?php } ?>





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
	// Get the modal
	var modal = document.getElementById("myModalPending");

	// Get the button that opens the modal
	var btn = document.getElementById("myBtnPending");

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
	$('#course_hourse').keyup(function() {
		var consultation_fee_per_hour;
		var course_hourse;
		consultation_fee_per_hour = parseFloat($('#consultation_fee_per_hour').val());
		course_hourse = parseFloat($('#course_hourse').val());
		var total_consultation_fee = consultation_fee_per_hour * course_hourse;
		var creadit_required = total_consultation_fee / 5;
		$('#total_consultation_fee').val(total_consultation_fee.toFixed(0));
		$('#creadit_required').val(creadit_required.toFixed());
	});
</script>

<script>
	$('#consultation_fee_per_hour').keyup(function() {
		var consultation_fee_per_hour;
		var course_hourse;
		consultation_fee_per_hour = parseFloat($('#consultation_fee_per_hour').val());
		course_hourse = parseFloat($('#course_hourse').val());
		var total_consultation_fee = consultation_fee_per_hour * course_hourse;
		var creadit_required = total_consultation_fee / 5;
		$('#total_consultation_fee').val(total_consultation_fee.toFixed(0));
		$('#creadit_required').val(creadit_required.toFixed(0));
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


	/* @media only screen and (max-width: 1440px) {
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
    } */





	/* 
    @media only screen and (max-width: 1024px) {
        .sort_name {
            display: inline-block;
            width: 191px;
            white-space: nowrap;
            overflow: hidden !important;
            text-overflow: ellipsis;
            font-weight: 500;
        }
    } */
</style>






@endsection