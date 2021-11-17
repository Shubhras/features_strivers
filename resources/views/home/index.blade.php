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

@section('search')
@parent
@endsection

@section('content')
<div class="main-container" id="homepage">

	@if (session()->has('flash_notification'))
	@includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'])
	<?php $paddingTopExists = true; ?>
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				@include('flash::message')
			</div>
		</div>
	</div>
	@endif

	<!-- @if (isset($sections) and $sections->count() > 0)
			@foreach($sections as $section)
				@if (view()->exists($section->view))
					@includeFirst([config('larapen.core.customizedViewPath') . $section->view, $section->view], ['firstSection' => $loop->first])
				@endif
			@endforeach
		@endif -->




	<!-- search section  -->


	<?php
	// Init.
	$sForm = [
		'enableFormAreaCustomization' => '0',
		'hideTitles'                  => '0',
		'title'                       => t('homepage_title_text'),
		'subTitle'                    => t('simple_fast_and_efficient'),
		'bigTitleColor'               => '', // 'color: #FFF;',
		'subTitleColor'               => '', // 'color: #FFF;',
		'backgroundColor'             => '', // 'background-color: #444;',
		'backgroundImage'             => '', // null,
		'height'                      => '', // '450px',
		'parallax'                    => '0',
		'hideForm'                    => '0',
		'formBorderColor'             => '', // 'background-color: #333;',
		'formBorderSize'              => '', // '5px',
		'formBtnBackgroundColor'      => '', // 'background-color: #4682B4; border-color: #4682B4;',
		'formBtnTextColor'            => '', // 'color: #FFF;',
	];

	// Get Search Form Options
	if (isset($searchFormOptions)) {
		if (isset($searchFormOptions['enable_form_area_customization']) && !empty($searchFormOptions['enable_form_area_customization'])) {
			$sForm['enableFormAreaCustomization'] = $searchFormOptions['enable_form_area_customization'];
		}
		if (isset($searchFormOptions['hide_titles']) && !empty($searchFormOptions['hide_titles'])) {
			$sForm['hideTitles'] = $searchFormOptions['hide_titles'];
		}
		if (isset($searchFormOptions['title_' . config('app.locale')]) && !empty($searchFormOptions['title_' . config('app.locale')])) {
			$sForm['title'] = $searchFormOptions['title_' . config('app.locale')];
			$sForm['title'] = replaceGlobalPatterns($sForm['title']);
		}
		if (isset($searchFormOptions['sub_title_' . config('app.locale')]) && !empty($searchFormOptions['sub_title_' . config('app.locale')])) {
			$sForm['subTitle'] = $searchFormOptions['sub_title_' . config('app.locale')];
			$sForm['subTitle'] = replaceGlobalPatterns($sForm['subTitle']);
		}
		if (isset($searchFormOptions['parallax']) && !empty($searchFormOptions['parallax'])) {
			$sForm['parallax'] = $searchFormOptions['parallax'];
		}
		if (isset($searchFormOptions['hide_form']) && !empty($searchFormOptions['hide_form'])) {
			$sForm['hideForm'] = $searchFormOptions['hide_form'];
		}
	}

	// Country Map status (shown/hidden)
	$showMap = false;
	if (file_exists(config('larapen.core.maps.path') . config('country.icode') . '.svg')) {
		if (isset($citiesOptions) && isset($citiesOptions['show_map']) && $citiesOptions['show_map'] == '1') {
			$showMap = true;
		}
	}
	$hideOnMobile = '';
	if (isset($searchFormOptions, $searchFormOptions['hide_on_mobile']) && $searchFormOptions['hide_on_mobile'] == '1') {
		$hideOnMobile = ' hidden-sm';
	}
	?>
	@if (isset($sForm['enableFormAreaCustomization']) && $sForm['enableFormAreaCustomization'] == '1')

	@if (isset($firstSection) && !$firstSection)
	<div class="p-0 mt-lg-4 mt-md-3 mt-3"></div>
	@endif

	<?php $parallax = (isset($sForm['parallax']) && $sForm['parallax'] == '1') ? ' parallax' : ''; ?>
	<div class="horsepower-bg intro{{ $hideOnMobile }}{{ $parallax }}">
		<div class="container text-center">

			@if ($sForm['hideTitles'] != '1')
			<h1 class="intro-title animated fadeInDown">
				{{ $sForm['title'] }}
			</h1>
			<p class="sub animateme fittext3 animated fadeIn">
				{!! $sForm['subTitle'] !!}
			</p>
			@endif

			@if ($sForm['hideForm'] != '1')
			<form id="search" name="search" action="{{ \App\Helpers\UrlGen::search() }}" method="GET">
				<div class="row search-row animated fadeInUp">

					<div class="col-md-5 col-sm-12 search-col relative mb-1 mb-xxl-0 mb-xl-0 mb-lg-0 mb-md-0">
						<div class="search-col-inner">
							<i class="fas fa-angle-double-right icon-append"></i>
							<div class="search-col-input">
								<input class="form-control has-icon" name="q" placeholder="{{ t('what') }}" type="text" value="">
							</div>
						</div>
					</div>

					<input type="hidden" id="lSearch" name="l" value="">

					<div class="col-md-5 col-sm-12 search-col relative locationicon mb-1 mb-xxl-0 mb-xl-0 mb-lg-0 mb-md-0">
						<div class="search-col-inner">
							<i class="fas fa-map-marker-alt icon-append"></i>
							<div class="search-col-input">
								@if ($showMap)
								<input class="form-control locinput input-rel searchtag-input has-icon" id="locSearch" name="location" placeholder="{{ t('where') }}" type="text" value="" data-bs-placement="top" data-bs-toggle="tooltipHover" title="{{ t('Enter a city name OR a state name with the prefix', ['prefix' => t('area')]) . t('State Name') }}">
								@else
								<input class="form-control locinput input-rel searchtag-input has-icon" id="locSearch" name="location" placeholder="{{ t('where') }}" type="text" value="">
								@endif
							</div>
						</div>
					</div>

					<div class="col-md-2 col-sm-12 search-col">
						<div class="search-btn-border bg-primary">
							<button class="btn btn-primary btn-search btn-block btn-gradient">
								<i class="fas fa-search"></i><strong>{{ t('find') }}</strong>
							</button>
						</div>
					</div>

				</div>
			</form>
			@endif

		</div>
	</div>

	@else

	@includeFirst([config('larapen.core.customizedViewPath') . 'home.inc.spacer', 'home.inc.spacer'])
	<div class="horsepower-bg horsepower-bgintro only-search-bar{{ $hideOnMobile }}">
		<div class="container text-center">

			@if ($sForm['hideForm'] != '1')
			<form id="search" name="search" action="{{ \App\Helpers\UrlGen::search() }}" method="GET">
				<div class="row search-row animated fadeInUp">

					<div class="col-md-5 col-sm-12 search-col relative mb-1 mb-xxl-0 mb-xl-0 mb-lg-0 mb-md-0">
						<div class="search-col-inner">
							<i class="fas fa-angle-double-right icon-append"></i>
							<div class="search-col-input">
								<input class="form-control has-icon" name="q" placeholder="{{ t('what') }}" type="text" value="">
							</div>
						</div>
					</div>

					<input type="hidden" id="lSearch" name="l" value="">

					<div class="col-md-5 col-sm-12 search-col relative locationicon mb-1 mb-xxl-0 mb-xl-0 mb-lg-0 mb-md-0">
						<div class="search-col-inner">
							<i class="fas fa-map-marker-alt icon-append"></i>
							<div class="search-col-input">
								@if ($showMap)
								<input class="form-control locinput input-rel searchtag-input has-icon" id="locSearch" name="location" placeholder="{{ t('where') }}" type="text" value="" data-bs-placement="top" data-bs-toggle="tooltipHover" title="{{ t('Enter a city name OR a state name with the prefix', ['prefix' => t('area')]) . t('State Name') }}">
								@else
								<input class="form-control locinput input-rel searchtag-input has-icon" id="locSearch" name="location" placeholder="{{ t('where') }}" type="text" value="">
								@endif
							</div>
						</div>
					</div>

					<div class="col-md-2 col-sm-12 search-col">
						<div class="search-btn-border bg-primary">
							<button class="btn btn-primary btn-search btn-block btn-gradient">
								<i class="fas fa-search"></i><strong>{{ t('find') }}</strong>
							</button>
						</div>
					</div>

				</div>
			</form>
			@endif

		</div>
	</div>



	@endif



	<!-- coaches  -->



	<?php
	$hideOnMobile = '';
	if (isset($categoriesOptions, $categoriesOptions['hide_on_mobile']) and $categoriesOptions['hide_on_mobile'] == '1') {
		$hideOnMobile = ' hidden-sm';
	}
	?>
	@if (isset($categoriesOptions) and isset($categoriesOptions['type_of_display']))
	@includeFirst([config('larapen.core.customizedViewPath') . 'home.inc.spacer', 'home.inc.spacer'], ['hideOnMobile' => $hideOnMobile])
	<div class="container{{ $hideOnMobile }}">
		<div class="col-xl-12 content-box layout-section">
			<div class="row row-featured row-featured-category">
				<div class="col-xl-12 box-title no-border">
					<div class="inner">
						<h2>
							<span class="title-3">{{ t('Browse by') }} <span style="font-weight: bold;">{{ ('Coaches') }}</span></span>
							<a href="{{ \App\Helpers\UrlGen::sitemap() }}" class="sell-your-item">
								{{ t('View more') }} <i class="fas fa-bars"></i>
							</a>
						</h2>
					</div>
				</div>

				@if (isset($categories) and $categories->count() > 0)


				@foreach($user as $key => $coach)

				<div class="col-lg-3 col-md-3 col-sm-4 col-6 f-coach">
					<a href="{{url('/coach_details/'.$coach->id) }}">
						<img src="{{ imgUrl($coach->photo, '') }}" class="lazyload img-fluid" alt="{{ $coach->name }}">

						<h5 style="margin-top: -76px;font-size: xx-large;color: white; margin-bottom: 47px;">
							<b>{{ $coach->name }}</b>

						</h5>

					</a>

				</div>

				@endforeach

				@endif

			</div>
		</div>
	</div>
	@endif

	@section('before_scripts')
	@parent
	@if (isset($categoriesOptions) and isset($categoriesOptions['max_sub_cats']) and $categoriesOptions['max_sub_cats'] >= 0)
	<!-- <script>
			var maxSubCats = {{ (int)$categoriesOptions['max_sub_cats'] }};
		</script> -->
	@endif
	@endsection


	<!-- pricing section  -->


	<?php
	$addListingUrl = (isset($addListingUrl)) ? $addListingUrl : \App\Helpers\UrlGen::addPost();
	$addListingAttr = '';
	if (!auth()->check()) {
		if (config('settings.single.guests_can_post_ads') != '1') {
			$addListingUrl = '#quickLogin';
			$addListingAttr = ' data-bs-toggle="modal"';
		}
	}
	?>
	@if (isset($categoriesOptions) and isset($categoriesOptions['type_of_display']))
	@includeFirst([config('larapen.core.customizedViewPath') . 'home.inc.spacer', 'home.inc.spacer'], ['hideOnMobile' => $hideOnMobile])
	<div class="container{{ $hideOnMobile }}">
		<div class="col-xl-12 content-box layout-section">
			<div class="row row-featured row-featured-category">
				<div class="col-xl-12 box-title no-border">
					<div class="inner">
						<h2>
							<span class="title-3">{{ t('Browse by') }} <span style="font-weight: bold;">{{ ('Subscription_plans_Coach_wise') }}</span></span>
							<a href="{{ \App\Helpers\UrlGen::sitemap() }}" class="sell-your-item">
								{{ t('View more') }} <i class="fas fa-bars"></i>
							</a>
						</h2>
					</div>
				</div>

				<div class="row mt-5 mb-md-5 justify-content-center">

					@if ($packages->count() > 0)
					@foreach($packages as $package)
					<?php
					$boxClass = ($package->recommended == 1) ? ' border-color-primary' : '';
					$boxHeaderClass = ($package->recommended == 1) ? ' bg-primary border-color-primary text-white' : '';
					$boxBtnClass = ($package->recommended == 1) ? ' btn-primary' : ' btn-outline-primary';
					?>
					<div class="col-md-4">
						<div class="card mb-4 box-shadow{{ $boxClass }}">
							<div class="card-header text-center{{ $boxHeaderClass }}">
								<h4 class="my-0 fw-normal pb-0 h4">{{ $package->short_name }}</h4>
							</div>
							<div class="card-body">
								<h1 class="text-center">
									<span class="fw-bold">
										@if ($package->currency->in_left == 1)
										{!! $package->currency->symbol !!}
										@endif
										{{ \App\Helpers\Number::format($package->price) }}
										@if ($package->currency->in_left == 0)
										{!! $package->currency->symbol !!}
										@endif
									</span>
									<small class="text-muted">/ {{ t('hours') }}</small>
								</h1>
								<ul class="list list-border text-center mt-3 mb-4">
									@if (is_array($package->description_array) and count($package->description_array) > 0)
									@foreach($package->description_array as $option)
									<li>{!! $option !!}</li>
									@endforeach
									@else
									<li> *** </li>
									@endif
								</ul>
								<?php
								$pricingUrl = '';
								if (\Illuminate\Support\Str::startsWith($addListingUrl, '#')) {
									$pricingUrl = '' . $addListingUrl;
								} else {
									$pricingUrl = $addListingUrl . '?package=' . $package->id;
								}
								?>
								<a href="{{ $pricingUrl }}" class="btn btn-lg btn-block{{ $boxBtnClass }}" {!! $addListingAttr !!}>
									{{ t('get_started') }}
								</a>
							</div>
						</div>
					</div>
					@endforeach
					@else
					<div class="col-md-6 col-sm-12 text-center">
						<div class="card bg-light">
							<div class="card-body">
								{{ t('no_package_available') }}
							</div>
						</div>
					</div>
					@endif
				</div>

			</div>
		</div>
	</div>
	@endif

	@section('before_scripts')
	@parent
	@if (isset($categoriesOptions) and isset($categoriesOptions['max_sub_cats']) and $categoriesOptions['max_sub_cats'] >= 0)
	<!-- <script>
			var maxSubCats = {{ (int)$categoriesOptions['max_sub_cats'] }};
		</script> -->
	@endif
	@endsection



	<!-- category  -->


	<?php
	$hideOnMobile = '';
	if (isset($categoriesOptions, $categoriesOptions['hide_on_mobile']) and $categoriesOptions['hide_on_mobile'] == '1') {
		$hideOnMobile = ' hidden-sm';
	}
	?>
	@if (isset($categoriesOptions) and isset($categoriesOptions['type_of_display']))
	@includeFirst([config('larapen.core.customizedViewPath') . 'home.inc.spacer', 'home.inc.spacer'], ['hideOnMobile' => $hideOnMobile])
	<div class="container{{ $hideOnMobile }}">
		<div class="col-xl-12 content-box layout-section">
			<div class="row row-featured row-featured-category">
				<div class="col-xl-12 box-title no-border">
					<div class="inner">
						<h2>
							<span class="title-3">{{ t('Browse by') }} <span style="font-weight: bold;">{{ t('category') }}</span></span>
							<a href="{{ url('category_list') }}" class="sell-your-item">
								{{ t('View more') }} <i class="fas fa-bars"></i>
							</a>
						</h2>
					</div>
				</div>

				@if ($categoriesOptions['type_of_display'] == 'c_picture_icon')

				@if (isset($categories) and $categories->count() > 0)
				@foreach($categories as $key => $cat)
				<div class="col-lg-2 col-md-3 col-sm-4 col-6 f-category">
					<a href="{{ \App\Helpers\UrlGen::category($cat) }}">
						<img src="{{ imgUrl($cat->picture, 'cat') }}" class="lazyload img-fluid" alt="{{ $cat->name }}">
						<h6>
							{{ $cat->name }}
							@if (config('settings.listing.count_categories_posts'))
							&nbsp;({{ $countPostsByCat->get($cat->id)->total ?? 0 }})
							@endif
						</h6>
					</a>
				</div>
				@endforeach
				@endif

				@elseif (in_array($categoriesOptions['type_of_display'], ['cc_normal_list', 'cc_normal_list_s']))

				<div style="clear: both;"></div>
				<?php $styled = ($categoriesOptions['type_of_display'] == 'cc_normal_list_s') ? ' styled' : ''; ?>

				@if (isset($categories) and $categories->count() > 0)
				<div class="col-xl-12">
					<div class="list-categories-children{{ $styled }}">
						<div class="row">
							@foreach ($categories as $key => $cols)
							<div class="col-md-4 col-sm-4 {{ (count($categories) == $key+1) ? 'last-column' : '' }}">
								@foreach ($cols as $iCat)

								<?php
								$randomId = '-' . substr(uniqid(rand(), true), 5, 5);
								?>

								<div class="cat-list">
									<h3 class="cat-title rounded">
										@if (isset($categoriesOptions['show_icon']) and $categoriesOptions['show_icon'] == 1)
										<i class="{{ $iCat->icon_class ?? 'icon-ok' }}"></i>&nbsp;
										@endif
										<a href="{{ \App\Helpers\UrlGen::category($iCat) }}">
											{{ $iCat->name }}
											@if (config('settings.listing.count_categories_posts'))
											&nbsp;({{ $countPostsByCat->get($iCat->id)->total ?? 0 }})
											@endif
										</a>
										<span class="btn-cat-collapsed collapsed" data-bs-toggle="collapse" data-bs-target=".cat-id-{{ $iCat->id . $randomId }}" aria-expanded="false">
											<span class="icon-down-open-big"></span>
										</span>
									</h3>
									<ul class="cat-collapse collapse show cat-id-{{ $iCat->id . $randomId }} long-list-home">
										@if (isset($subCategories) and $subCategories->has($iCat->id))
										@foreach ($subCategories->get($iCat->id) as $iSubCat)
										<li>
											<a href="{{ \App\Helpers\UrlGen::category($iSubCat) }}">
												{{ $iSubCat->name }}
											</a>
											@if (config('settings.listing.count_categories_posts'))
											&nbsp;({{ $countPostsByCat->get($iSubCat->id)->total ?? 0 }})
											@endif
										</li>
										@endforeach
										@endif
									</ul>
								</div>
								@endforeach
							</div>
							@endforeach
						</div>
					</div>
					<div style="clear: both;"></div>
				</div>
				@endif

				@else

				<?php
				$listTab = [
					'c_circle_list' => 'list-circle',
					'c_check_list'  => 'list-check',
					'c_border_list' => 'list-border',
				];
				$catListClass = (isset($listTab[$categoriesOptions['type_of_display']])) ? 'list ' . $listTab[$categoriesOptions['type_of_display']] : 'list';
				?>
				@if (isset($categories) and $categories->count() > 0)
				<div class="col-xl-12">
					<div class="list-categories">
						<div class="row">
							@foreach ($categories as $key => $items)
							<ul class="cat-list {{ $catListClass }} col-md-4 {{ (count($categories) == $key+1) ? 'cat-list-border' : '' }}">
								@foreach ($items as $k => $cat)
								<li>
									@if (isset($categoriesOptions['show_icon']) and $categoriesOptions['show_icon'] == 1)
									<i class="{{ $cat->icon_class ?? 'icon-ok' }}"></i>&nbsp;
									@endif
									<a href="{{ \App\Helpers\UrlGen::category($cat) }}">
										{{ $cat->name }}
									</a>
									@if (config('settings.listing.count_categories_posts'))
									&nbsp;({{ $countPostsByCat->get($cat->id)->total ?? 0 }})
									@endif
								</li>
								@endforeach
							</ul>
							@endforeach
						</div>
					</div>
				</div>
				@endif

				@endif

			</div>
		</div>
	</div>
	@endif

	@section('before_scripts')
	@parent
	@if (isset($categoriesOptions) and isset($categoriesOptions['max_sub_cats']) and $categoriesOptions['max_sub_cats'] >= 0)
	<!-- <script>
			var maxSubCats = {{ (int)$categoriesOptions['max_sub_cats'] }};
		</script> -->
	@endif
	@endsection



	<!-- letest post  -->
	<?php
	$widgetType = 'normal';
	if (
		isset($widgetLatestPosts, $widgetLatestPosts->options)
		&& array_key_exists('items_in_carousel', $widgetLatestPosts->options)
		&& $widgetLatestPosts->options['items_in_carousel'] == '1'
	) {
		$widgetType = 'carousel';
	}
	?>


	<!-- @includeFirst([
		config('larapen.core.customizedViewPath') . 'search.inc.posts.widget.' . $widgetType,
		'search.inc.posts.widget.' . $widgetType
	],
	['widget' => ($widgetLatestPosts ?? null)]
) -->





	<!-- our reviews section  -->


	<?php
	$hideOnMobile = '';
	if (isset($categoriesOptions, $categoriesOptions['hide_on_mobile']) and $categoriesOptions['hide_on_mobile'] == '1') {
		$hideOnMobile = ' hidden-sm';
	}
	?>
	@if (isset($categoriesOptions) and isset($categoriesOptions['type_of_display']))
	@includeFirst([config('larapen.core.customizedViewPath') . 'home.inc.spacer', 'home.inc.spacer'], ['hideOnMobile' => $hideOnMobile])
	<div class="container{{ $hideOnMobile }}">
		<div class="col-xl-12 content-box layout-section">
			<div class="row row-featured row-featured-category">
				<div class="col-xl-12 box-title no-border">
					<div class="inner">
						<h2>
							<span class="title-3"> <span style="font-weight: bold;">{{ t('our_reviews') }}</span></span>
							<a href="{{ \App\Helpers\UrlGen::sitemap() }}" class="sell-your-item">
								{{ t('View more') }} <i class="fas fa-bars"></i>
							</a>
						</h2>
					</div>
				</div>

				@if (isset($our_reviews) and $our_reviews->count() > 0)


				@foreach($our_reviews as $key => $coach)

				<div class="col-lg-4 col-md-3 col-sm-4 col-6 f-coach">
					<a href="{{url('/coach_details/'.$coach->id) }}">
						<img src="{{ imgUrl($coach->photo, '') }}" class="lazyload img-fluid" alt="{{ $coach->name }}">

						<h5 style="margin-top: -76px;font-size: xx-large;color: white; margin-bottom: 47px;">
							<b>{{ $coach->name }}</b>

						</h5>

					</a>

				</div>

				@endforeach
				@endif
			</div>

		</div>
	</div>

	@endif



	@if (isset($categoriesOptions) and isset($categoriesOptions['type_of_display']))
	@includeFirst([config('larapen.core.customizedViewPath') . 'home.inc.spacer', 'home.inc.spacer'], ['hideOnMobile' => $hideOnMobile])
	<div class="container{{ $hideOnMobile }}">
		<div class="col-xl-12 content-box layout-section">
			<div class="row row-featured row-featured-category">
				<!-- <div class="col-xl-12 box-title no-border">

				</div> -->
				<div class="col-lg-6 col-md-6 col-sm-6 col-6 ">

					<img src="{{ imgUrl($our_review_coaches->photo, '') }}" class="" alt="{{ $our_review_coaches->name }}">
					<!-- {{$our_review_coaches->name;}} -->
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-6 f-coach">
					<h2 style="color:black; font-weight:800;">Join Our Largest Coaching Community</h2>
					<p style="font-size: medium; text-align:justify; padding: inherit;">We will differentiate ourselves by talking about tangible life skills. Coaches will be
						carefully selected and qualified on the basis of altruism, life experience, multi-
						cultural cross border exposure and significant exposure to the corporate world.
						They will work in tight partnership with the strivers offering them ideas, critical
						feedback, developmental areas, camaraderie, guidance on careers / industries as
						well as introductions to jobs / business / recruiters / stakeholders.</p>

					<button class="btn btn-primary">Get Started</button>	
				</div>

			</div>

		</div>
	</div>

	@endif

</div>
@endsection



@section('after_scripts')
<script>
	@if(config('settings.optimization.lazy_loading_activation') == 1)
	$(document).ready(function() {
		$('#postsList').each(function() {
			var $masonry = $(this);
			/*
			var update = function () {
				$.fn.matchHeight._update();
			};
			$('.item-list', $masonry).matchHeight();
			this.addEventListener('load', update, true);
			*/
		});
	});
	@endif
</script>
@endsection