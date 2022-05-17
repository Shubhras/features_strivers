@extends('layouts.master_new')


<section class="page-banner01" style="background-image: url(../assets/images/home/cta-bg.jpg);">

</section>
@section('content')
<!-- @includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer']) -->
<br>

<br>
<section style="background-color: white;">
	<div class="">
		<div class="container">
			<br>
			<br>

			<div class="row">
				<center>


					<?php if ($top_coach_detail->photo != null) { ?>



						<img class="img-coches-main1" src="{{ url('storage/'.$top_coach_detail->photo) }}" alt="{{ $top_coach_detail->name }}">


					<?php } else { ?>

						<img src="../images/user_default.jpg" alt="Basic" class="img-coches-main1">

					<?php } ?>
					<p class="coach-details-name text-center">{{ $top_coach_detail->name }}</p>
					<br>

					<h4 class=" text-center">
						<?php

						if (!empty($top_coach_detail->slug)) {
							$title = json_decode($top_coach_detail->slug);
							$ss = array();
							foreach ($title as $key => $sub) {
								$ss[$key] = $sub;
							}


						?>
							{{$ss['en']}}

						<?php } ?>
					</h4>
				</center>

				<!-- <h2 class="sec-title-cat">
				<h3 style="font-family: 'Roboto', sans-serif; text-align:center"><b>Coach Detail</b></h3>

				</h2> -->

				<div class="col-md-12 page-content">

					<div class="">
						<p style="font-family: 'Montserrat', sans-serif;font-size: 16px;">{{ $top_coach_detail->coach_summary }}</p>


					</div>
				</div>
			</div>
			<br>
			<br>
			<br>
			<div class="row">


				<div class="col-md-4 ">
					<div class="box" style="height: 450px;">
						<!-- <h3 style="font-family: 'Roboto', sans-serif; font-size: 20px;"><b>Coach Detail</b></h3> -->

						<p style="font-family: 'Montserrat', sans-serif; font-size: 16px;"> Coach Name: {{ $top_coach_detail->name }}</p>

						<?php if ($top_coach_detail->year_of_experience != '') { ?>
							<p style="font-family: 'Montserrat', sans-serif; font-size: 18px;">Year of Experience : {{ $top_coach_detail->year_of_experience }}</p>
						<?php
						} else { ?>
							<p style="font-family: 'Montserrat', sans-serif;font-size: 18px;">Year of Experience : No Experience</p>

						<?php } ?>
						<?php

						if (!empty($top_coach_detail->slug)) {
							$slug = json_decode($top_coach_detail->slug);




							$ss = array();
							foreach ($slug as $key => $sub) {
								$ss[$key] = $sub;
							}
						?>
							<p style="font-family: 'Montserrat', sans-serif; font-size: 18px;">Industry: {{ $ss['en'] }}</p>
						<?php
						} else { ?>

							<p style="font-family: 'Montserrat', sans-serif; font-size: 18px;">Industry: No Industry</p>

						<?php }
						if (!empty($top_coach_detail->sub_cat)) {


							$sub_cat = json_decode($top_coach_detail->sub_cat);
							$aaa = array();
							foreach ($sub_cat as $key => $subc) {
								$aaa[$key] = $subc;
							}
						?>
							<p style="font-family: 'Montserrat', sans-serif; font-size: 18px;">Speciality: {{ $aaa['en'] }}</p>
						<?php
						} else { ?>
							<p style="font-family: 'Montserrat', sans-serif; font-size: 18px;">Speciality: No Speciality</p>
						<?php }
						?>
					</div>

				</div>
				<br>
				<?php
				if ($top_coach_detail->youtube_link) {
					// $video_url= 'https://www.youtube.com/watch?v=bNHE9uFOaK4';
					$video_url = $top_coach_detail->youtube_link;

					// print_r($video_url);die;
					if (parse_url($video_url, PHP_URL_QUERY)) {
						$query_str = parse_url($video_url, PHP_URL_QUERY);
						parse_str($query_str, $query_params);
						$video_links = $query_params['v'];
						$video_link = $video_links;
						// print_r($video_link);die;
				?>
						<div class="col-md-8">
							<iframe width="100%" height="450" src="https://www.youtube.com/embed/{{ $video_link }}?autoplay=1&mute=1&loop=1"></iframe>
						</div>

					<?php
					} elseif (explode("/", $video_url)) {
						$bb = explode("/", $video_url);
						$video_link = $bb[3];

					?>



						<div class="col-md-8">
							<iframe width="100%" height="450" src="https://www.youtube.com/embed/{{ $video_link }}?autoplay=1&mute=1&loop=1"></iframe>
						</div>

					<?php }
				} else {
					?>
					<div class="col-md-8">
						<iframe width="100%" height="450" src="https://www.youtube.com/embed/R5jIoLnL_nE?autoplay=1&mute=1&loop=1"></iframe>
						<!-- <iframe width="100%" height="450" src="{{$top_coach_detail->youtube_link}}?autoplay=1&mute=1&loop=1"></iframe> -->
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
	<!-- <div class="" style="text-align: center;">
		<a href="{{url('/pricing') }}">
			<button type="button" class="btn btn-lg" style="background: #012245; color: #ffffff">Get Started</button>
		</a>
	</div> -->

	</div>

	</div>
	</div>
</section>
<div class="main-section">
	<div class="container" style="margin-top: -141px;">

		<div class="row">

			<h2 class="sec-title packt1" style="font-weight: 700;">
				Choose Consultancy package

			</h2>

			<?php
			foreach ($create_my_course as  $coaches_corsee) {
			?>
				<div class="col-lg-3 col-md-6">
					<div class="feature-course-item-4">
						<div class="fcf-thumb">


							<?php if ($coaches_corsee->image != null) { ?>



								<img src="{{ url('storage/'.$coaches_corsee->image) }}" alt="" style="height: 244px;">


							<?php } else { ?>

								<img src="../images/user_default.jpg" alt="Basic" style="height: 244px;">

							<?php } ?>




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
	</div>
	<br>
	<br>
	<div class="">
		<div class="container">

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

								<?php if ($coaches_corsee->image != null) { ?>



									<img src="{{ url('storage/'.$coaches_corsee->image) }}" alt="" style="height: 244px;">


								<?php } else { ?>

									<img src="../images/user_default.jpg" alt="Basic" style="height: 244px;">

								<?php } ?>


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



										<img src="{{ url('storage/'.$coach_list->photo) }}" alt="Jim Séchen">


									<?php } else { ?>

										<img src="../images/user_default.jpg" alt="Basic" style="height: 244px;">

									<?php } ?>

									

								</div>
								<div class="teacher-meta">
									<p class="top-coaches-name-list coach-cat-name12 ">
										{{ $coach_list->name }}
									</p>
									<?php

									if (!empty($coach_list->slug)) {


										$name = json_decode($coach_list->slug);
										$ss = array();
										foreach ($name as $key => $sub) {
											$ss[$key] = $sub;
										}

									?>

										<p class="text-center">{{$ss['en']}}
										</p>
									<?php  } else {
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




	<style>
		.flex-container {
			display: flex;
			flex-wrap: nowrap;
			background-color: white;
		}

		.flex-container .box {
			background-color: #f1f1f1;
			width: 50%;
			margin: 10px;

			line-height: 20px;
			font-size: 19px;
		}

		.alert {
			display: none;
		}

		.card-header>p {
			max-width: 800px;
			text-align: center;
			margin: auto;
		}

		.mcol-left {
			padding-left: 5px;

		}
	</style>




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
		// when category dropdown changes





		$(document).ready(function() {

			$("form").submit(function(event) {
				var formData = {
					course_name: $("#course_name").val(),
					course_hourse: $("#course_hourse").val(),
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


	@endsection