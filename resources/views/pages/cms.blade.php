<style>
	.alert {
		display: none;
	}
</style>

<link rel="icon" type="image/png" href="../assets/images/favicon.png">
<!-- Favicon Icon -->
@extends('layouts.master_new')
@section('content')


<section class="page-banner01">
</section>
<section class="blog-section64">
	<br><br><br><br>

	<div class="container">
		<div class="section-content">
			<div class="row">

				

				@if (empty($page->picture))

		
				<h1 class="text-center title-1" style="color: {!! $page->name_color !!};"><strong>{{ $page->name }}</strong></h1>
				<hr class="center-block small mt-0" style="background-color: {!! $page->name_color !!};">
				@else
				<h1 class="text-center title-1" style="color: {!! $page->name_color !!};"><strong>{{ $page->name }}</strong></h1>
				<hr class="center-block small mt-0" style="background-color: {!! $page->name_color !!};">

				

				@endif
				<div class="col-md-12 page-content">
					<div class="inner-box relative">
						<div class="row">

							<div class="col-sm-12 page-content">
								@if (empty($page->picture))
								<h3 class="text-center" style="color: {!! $page->title_color !!};">{{ $page->title }}</h3>

								<div class="text-content text-start from-wysiwyg">
								{!! $page->content !!}
								</div>
								@else

								<h3 class="text-center" style="color: {!! $page->title_color !!};">{{ $page->title }}</h3>
								<div class="text-content text-start from-wysiwyg">
									<div class="row">

									
									<div class="col-md-6">
									{!! $page->content !!}
									</div>

									<div class="col-md-6">
									<img src="{{ url('storage/'.$page->picture) }}" class="lazyload img-fluid images_height" alt="{{ $page->name }}">
									</div>

									</div>
								</div>
								@endif
							</div>
						</div>
					</div>
				</div>

			</div>

			<!-- @includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.social.horizontal', 'layouts.inc.social.horizontal']) -->

		</div>
	</div>
</section>






<br>


@includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.footer1', 'layouts.inc.footer1'])

<a href="#" id="back-to-top">
	<i class="fal fa-angle-double-up"></i>
</a>
<!-- Back To Top -->

<!-- Start Include All JS -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.appear.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/slick.js"></script>
<script src="assets/js/jquery.nice-select.min.js"></script>
<script src="assets/js/swiper-bundle.min.js"></script>
<script src="assets/js/TweenMax.min.js"></script>
<script src="assets/js/lightcase.js"></script>
<script src="assets/js/jquery.plugin.min.js"></script>
<script src="assets/js/jquery.countdown.min.js"></script>
<script src="assets/js/jquery.easing.1.3.js"></script>
<script src="assets/js/jquery.shuffle.min.js"></script>

<script src="assets/js/theme.js"></script>
<!-- End Include All JS -->
<style>
	.h22 {
		color: white !important;
		text-align: center;
		font-size: 25px;
		/* padding: -32px!important; */
	}
</style>

<style>
	.fa,
	.fab,
	.fad,
	.fal,
	.far,
	.fas {
		-moz-osx-font-smoothing: grayscale;
		-webkit-font-smoothing: antialiased;
		display: inline-block;
		font-style: normal;
		font-variant: normal;
		text-rendering: auto;
		line-height: 3;
	}

	.fab {
		font-family: "Font Awesome 5 Brands";
	}

	.fab,
	.far {
		font-weight: 400;
	}
</style>
@endsection

@section('after_styles')

@if (config('lang.direction') == 'rtl')
<!-- <link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet"> -->
@endif



@endsection

@section('after_scripts')