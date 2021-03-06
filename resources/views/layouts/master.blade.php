<?php
$plugins = array_keys(config('plugins'));
$publicDisk = Illuminate\Support\Facades\Storage::disk(config('filesystems.default'));
?>
<!DOCTYPE html>
<html>

<head>
	<!-- <meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	@includeFirst([config('larapen.core.customizedViewPath') . 'common.meta-robots', 'common.meta-robots'])
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="apple-mobile-web-app-title" content="{{ config('settings.app.name') }}">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ $publicDisk->url('app/default/ico/apple-touch-icon-144-precomposed.png') . getPictureVersion()
	}}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ $publicDisk->url('app/default/ico/apple-touch-icon-114-precomposed.png') . getPictureVersion() }}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ $publicDisk->url('app/default/ico/apple-touch-icon-72-precomposed.png') . getPictureVersion() }}">
	<link rel="apple-touch-icon-precomposed" href="{{ $publicDisk->url('app/default/ico/apple-touch-icon-57-precomposed.png') . getPictureVersion() }}">
	<link rel="shortcut icon" href="{{ imgUrl(config('settings.app.favicon'), 'favicon') }}"> -->



	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

	<!-- Start Include All CSS -->
	<!-- <link rel="stylesheet" href="../assets/css/bootstrap.css" /> -->
	<!-- <link rel="stylesheet" href="../assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/css/elegant-icons.css" />
    <link rel="stylesheet" href="../assets/css/themify-icons.css" />
    <link rel="stylesheet" href="../assets/css/animate.css" />
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../assets/css/slick.css">
    <link rel="stylesheet" href="../assets/css/nice-select.css">
    <link rel="stylesheet" href="../assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="../assets/css/lightcase.css">
    <link rel="stylesheet" href="../assets/css/preset.css" />
    <link rel="stylesheet" href="../assets/css/theme.css" />
    <link rel="stylesheet" href="../assets/css/responsive.css" />


    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />


    <link rel="stylesheet" href="../assets/css/master.css"> -->



	<title>{!! MetaTag::get('title') !!}</title>
	{!! MetaTag::tag('description') !!}{!! MetaTag::tag('keywords') !!}
	<link rel="canonical" href="{{ request()->fullUrl() }}" />
	{{-- Specify a default target for all hyperlinks and forms on the page --}}
	<base target="_top" />
	@if (isset($post))
	@if (isVerifiedPost($post))
	@if (config('services.facebook.client_id'))
	<meta property="fb:app_id" content="{{ config('services.facebook.client_id') }}" />
	@endif
	{!! $og->renderTags() !!}
	{!! MetaTag::twitterCard() !!}
	@endif
	@else
	@if (config('services.facebook.client_id'))
	<meta property="fb:app_id" content="{{ config('services.facebook.client_id') }}" />
	@endif
	{!! $og->renderTags() !!}
	{!! MetaTag::twitterCard() !!}
	@endif
	@include('feed::links')
	{!! seoSiteVerification() !!}

	@if (file_exists(public_path('manifest.json')))
	<link rel="manifest" href="/manifest.json">
	@endif

	@stack('before_styles_stack')
	@yield('before_styles')

	@if (config('lang.direction') == 'rtl')
	<link href="https://fonts.googleapis.com/css?family=Cairo|Changa" rel="stylesheet">
	<link href="{{ url(mix('css/app.rtl.css')) }}" rel="stylesheet">
	@else
	<link href="{{ url(mix('css/app.css')) }}" rel="stylesheet">
	@endif
	@if (config('plugins.detectadsblocker.installed'))
	<link href="{{ url('../assets/detectadsblocker/css/style.css') . getPictureVersion() }}" rel="stylesheet">
	@endif

	@includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.tools.style', 'layouts.inc.tools.style'])

	<link href="{{ url()->asset('css/custom.css') . getPictureVersion() }}" rel="stylesheet">

	@stack('after_styles_stack')
	@yield('after_styles')

	@if (isset($plugins) and !empty($plugins))
	@foreach($plugins as $plugin)
	@yield($plugin . '_styles')
	@endforeach
	@endif

	@if (config('settings.style.custom_css'))
	{!! printCss(config('settings.style.custom_css')) . "\n" !!}
	@endif

	@if (config('settings.other.js_code'))
	{!! printJs(config('settings.other.js_code')) . "\n" !!}
	@endif

	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->

	<script>
		paceOptions = {
			elements: true
		};
	</script>
	<script src="{{ url()->asset('assets/js/pace.min.js') }}"></script>
	<script src="{{ url()->asset('assets/plugins/modernizr/modernizr-custom.js') }}"></script>

	@yield('captcha_head')
	@section('recaptcha_head')
	@if (
	config('settings.security.captcha') == 'recaptcha'
	&& config('recaptcha.site_key')
	&& config('recaptcha.secret_key')
	)
	<style>
		.is-invalid .g-recaptcha iframe,
		.has-error .g-recaptcha iframe {
			border: 1px solid #f85359;
		}
	</style>
	@if (config('recaptcha.version') == 'v3')
	<script type="text/javascript">
		function myCustomValidation(token) {
			/* read HTTP status */
			/* console.log(token); */

			if ($('#gRecaptchaResponse').length) {
				$('#gRecaptchaResponse').val(token);
			}
		}
	</script>
	{!! recaptchaApiV3JsScriptTag([
	'action' => request()->path(),
	'custom_validation' => 'myCustomValidation'
	]) !!}
	@else
	{!! recaptchaApiJsScriptTag() !!}
	@endif
	@endif
	@show
</head>



<body class="{{ config('app.skin') }}">


	<!-- Preloader Icon -->
	<!-- <div class="preloader">
        <div class="loaderInner">
            <div id="top" class="mask">
                <div class="plane"></div>
            </div>
            <div id="middle" class="mask">
                <div class="plane"></div>
            </div>
            <div id="bottom" class="mask">
                <div class="plane"></div>
            </div>
            <p>LOADING...</p>
        </div>
    </div> -->











	<div id="wrapper">


		@section('header')
		@includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.header1', 'layouts.inc.header1'])
		@show

		@section('search')
		@show

		@section('wizard')
		@show

		<!-- @if (isset($siteCountryInfo))
		<div class="p-0 mt-lg-4 mt-md-3 mt-3"></div>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="alert alert-warning alert-dismissible mb-3">
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ t('Close') }}"></button>
						{!! $siteCountryInfo !!}
					</div>
				</div>
			</div>
		</div>
	@endif -->

		@yield('content')

		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


		<section class="cookie-bar">
			<div class="cookie-notice container">
				<p class="cookie-para">We use cookies to enhance your user experience. By continuing using our site, you agree to our use of cookies.</p>
				<a href="javascript:;" class="cookie-btn">
                            Accept all cookies
                        </a>
				<a href="/cookies-policy/" class="cookie-btn secondary">Read More</a>

			</div>
		</section>

		<style>
			.cookie-bar {
				position: fixed;
				bottom: 0px;
				padding: 10px 15px;
				width: 100%;
				display: none;
				z-index: 15;
				background-color: black;
				font-family: "Poppins", sans-serif;
			}

			.cookie-para {
				color: white;
				font-size: 12px;
				font-weight: normal;
				display: inline-block;
				padding-bottom: 5px;
			}

			.cookie-space {
				padding-bottom: 45px;
			}

			.cookie-btn {
				font-size: 14px;
				color: #ffffff;
				background: red;
				padding: 2px 15px;
				border-radius: 4px;
				display: inline-block;
				margin-left: 1%;
			}

			.cookie-btn.secondary {
				color: #ffffff;
				background: #3575ff;
			}

			@media (max-width: 767px) {
				.cookie-bar {
					padding: 10px 15px 40px 15px;
				}
			}
		</style>
		<script>
			$(document).ready(function(){
     if(readCookie("cookie_accepted") == "1"){
        $(".cookie-bar").hide();
    }
    else{
        $(".cookie-bar").show();
            $('body').addClass('cookie-space');
            $('.cookie-btn').click(function(){
                $('body').removeClass('cookie-space');
            $('.cookie-bar').fadeOut();
            createCookie("cookie_accepted", 1, 365);
        });     
    } 
    });



 function getParameterByName(name, url) {
        if (!url) {
            url = window.location.href;
        }
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

    function createCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + value + expires + "; path=/";
    }

    function readCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    function eraseCookie(name) {
        createCookie(name, "", -1);
    }

    $(document).ready(function() {
        var advMedium = getParameterByName('advm');
        if (advMedium != null) {
            $('input[name=advm]').val(advMedium);
            createCookie('advm', advMedium, 1);
        } else {
            advMedium = readCookie('advm');
            $('input[name=advm]').val(advMedium);
        }
        var nodeCount = document.getElementsByName('ft').length;
        for (count = 0; count < nodeCount; count++) {
            document.getElementsByName('ft')[count].value = window.location.href;
        }
    });
		</script>

		@section('info')
		@show



	</div>

	@section('modal_location')
	@show
	@section('modal_abuse')
	@show
	@section('modal_message')
	@show

	@includeWhen(!auth()->check(), 'auth.login.inc.modal')
	@includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.modal.change-country', 'layouts.inc.modal.change-country'])
	@includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.modal.error', 'layouts.inc.modal.error'])
	@include('cookieConsent::index')

	@if (config('plugins.detectadsblocker.installed'))
	@if (view()->exists('detectadsblocker::modal'))
	@include('detectadsblocker::modal')
	@endif
	@endif



	@stack('before_scripts_stack')
	@yield('before_scripts')

	<script src="{{ url(mix('js/app.js')) }}"></script>
	@if (config('settings.optimization.lazy_loading_activation') == 1)
	<script src="{{ url()->asset('assets/plugins/lazysizes/lazysizes.min.js') }}" async=""></script>
	@endif
	@if (file_exists(public_path() . '/assets/plugins/select2/js/i18n/'.config('app.locale').'.js'))
	<script src="{{ url()->asset('assets/plugins/select2/js/i18n/'.config('app.locale').'.js') }}"></script>
	@endif
	@if (config('plugins.detectadsblocker.installed'))
	<script src="{{ url('assets/detectadsblocker/js/script.js') . getPictureVersion() }}"></script>
	@endif


	@stack('after_scripts_stack')
	@yield('after_scripts')
	@yield('captcha_footer')

	@if (isset($plugins) && !empty($plugins))
	@foreach($plugins as $plugin)
	@yield($plugin . '_scripts')
	@endforeach
	@endif

	@if (config('settings.footer.tracking_code'))
	{!! printJs(config('settings.footer.tracking_code')) . "\n" !!}
	@endif









</body>

</html>