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
			<!-- <h2 class="sec-title"style="text-align: center;">
            Coach Detail    
            </h2> -->
			<center>
			<img src="http://127.0.0.1:8000/storage/avatars/in/4/610aae80089859af5a1a8d5c7422d37f.jpg" class="img-coches-main1" alt="Jim Séchen"></center>
            <p  class="coach-details-name text-center">Jim Séchen</p>
            <h4 class=" text-center">
             Teaches Adventure Photography
             </h4>
                                
				<!-- <h2 class="sec-title-cat">
				<h3 style="font-family: 'Roboto', sans-serif; text-align:center"><b>Coach Detail</b></h3>

				</h2> -->

				<div class="col-md-12 page-content">

					<div class="">
						<p style="font-family: 'Montserrat', sans-serif;font-size: 16px;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus magnam eligendi corporis cumque maiores in esse neque optio, iusto consectetur? Fugit libero laborum odit quis vitae, inventore debitis dolor commodi voluptatum accusantium ducimus doloribus error facilis magni aspernatur! Enim quibusdam aliquid inventore dicta! A debitis iusto similique dolorum voluptas, incidunt velit ipsum, unde vitae molestiae laboriosam illo maiores blanditiis aliquam consectetur ratione magnam reprehenderit obcaecati tempora fuga sunt accusantium?</p>
						<p style="font-family: 'Montserrat', sans-serif; font-size: 16px;"> Dolorum quae, qui atque dolorem nemo voluptates minus explicabo hic sint laudantium, voluptate, quidem velit dolores. Totam itaque culpa quasi, hic voluptas doloribus assumenda harum. Vel corporis magnam blanditiis impedit molestiae?</p>

					</div>
				</div>
			</div>
			<br>
<br>
<br>
			<div class="row">


				<div class="col-md-4 box">
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
				<br>
				<div class="col-md-8">
					<iframe width="100%" height="450" src="https://www.youtube.com/embed/xJ3vatsNQDU?autoplay=1&mute=1&loop=1"></iframe>
				</div>
			</div>
		</div>
	</div>
	<br>
	<br>
	<br>
	<div class="" style="text-align: center;">
		<a href="{{url('/pricing') }}">
			<button type="button" class="btn btn-lg" style="background: #012245; color: #ffffff">Get Started</button>
		</a>
	</div>
<br>

<br>
	</div>

	</div>
	</div>
</section>

<br>



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