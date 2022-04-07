@extends('layouts.master_new')
@section('content')

    
    <section class="page-banner01" style="background-image: url(../assets/images/home/cta-bg.jpg);">
       
    </section>
    <!-- Banner End -->

    <!-- Course Section Start -->
    <section class="contact-section">
        <div class="container">
            @if (isset($errors) && $errors->any())
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ t('Close') }}"></button>
                    <ul class="list list-check">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            @if (session()->has('flash_notification'))
            <div class="col-12">
                @include('flash::message')
            </div>
            @endif
            <div class="col-md-8 d-flex justify-content-center">
                <div class="contact-form dform">
                    <center>
                        <h4>Login</h4>
                    </center>
                    <?php $mtAuth = !socialLoginIsEnabled() ? ' mt-2' : ' mt-1'; ?>
                    <form id="loginForm" role="form" method="POST" action="{{ url()->current() }}" class="row">
                        {!! csrf_field() !!}
                        <div class="col-md-12">
                            <?php
                            $loginValue = (session()->has('login')) ? session('login') : old('login');
                            $loginField = getLoginField($loginValue);
                            if ($loginField == 'phone') {
                                $loginValue = phoneFormat($loginValue, old('country', config('country.code')));
                            }
                            ?>
                            {{-- login --}}
                            <?php $loginError = (isset($errors) && $errors->has('login')) ? ' is-invalid' : ''; ?>
                            <label for="login" class="col-form-label">{{ t('login') . ' (' . getLoginLabel() . ')' }}:</label>
                            <div class="input-group">

                                <input id="login" name="login" type="text" placeholder="{{ getLoginLabel() }}" class="form-control{{ $loginError }}" value="{{ $loginValue }}">
                            </div>
                        </div>
                        {{-- password --}}
                        <div class="col-md-12">

                            <?php $passwordError = (isset($errors) && $errors->has('password')) ? ' is-invalid' : ''; ?>
                            <label for="password" class="col-form-label">{{ t('password') }}:</label>
                            <div class="input-group show-pwd-group">

                                <input id="password" name="password" type="password" class="form-control{{ $passwordError }}" placeholder="{{ t('password') }}" autocomplete="off">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- <label class="checkbox float-start mt-2 mb-2">
                                <label for="vehicle1">
                                    <input type="checkbox" value="1" name="remember" id="remember">
                                    Remember me</label>

                            </label> -->
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="check">
                                <label><a href="{{ url('password/reset') }}">Forgot Password</a><a href="{{ \App\Helpers\UrlGen::register() }}">/Sign Up </a>

                                </label>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="col-md-6 text-right">
                            <a class="b-btn bisylms-btn" type="reset" href="">Cancel</a>
                        </div>
                        <div class="col-md-6 text-left">
                            <button id="loginBtn" class="b-btn bisylms-btn"> {{ t('log_in') }} </button>
                        </div>
                        <!-- <div class="col-sm-12">
                            <center><button class="loginBtn loginBtn--google btn-primary1">
                                    Login with Google
                                </button> </center>
                        </div>
                        <br>
                        <br>
                        <div class="col-sm-12">
                            <center><button class="loginBtn loginBtn--facebook btn-primary1">
                                    Login with Facebook
                                </button>
                            </center>
                        </div> -->
                        <!-- <center>
                            <div class="col-md-12>
                        <div class="col-md-3">
                            <input type="submit" name="submit" value="Send Message">
                        </div> -->
                    </form>
                </div>
            </div>
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/uuid/8.3.2/uuid.min.js" integrity="sha512-UNM1njAgOFUa74Z0bADwAq8gbTcqZC8Ej4xPSzpnh0l6KMevwvkBvbldF9uR++qKeJ+MOZHRjV1HZjoRvjDfNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/validator/13.6.0/validator.min.js" integrity="sha512-xYHcfaQeUiKHs9YsHqjpyLaHnh+q7y8kYuOGdh5FkJeK7Z+dZct7Yoa7h+PtsrKRh03t8eJZuSeCN7b0dkrFwA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
  
  <script src="js/config.js"></script>

  <script src="js/auth.js"></script>

  <script src="js/firebase.js"></script>

  <script src="js/util.js"></script>
  <script src="js/login.js"></script>
  

    </section>

    @includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.footer1', 'layouts.inc.footer1'])
    <script>
        $(document).ready(function() {
            $("#loginBtn").click(function() {
                $("#loginForm").submit();
                return false;
            });
        });
    </script>
    <!-- Course Section End -->

    <!-- Footer Section Start -->

    <!-- Footer Section End -->

    <!-- Back To Top -->

    
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


    <script type="text/javascript" src="https://unpkg.com/@cometchat-pro/chat@2.0.12/CometChat.js"></script>

    <script>
        const APP_ID = '201695e40a40d1cb';
        // const REST_API_KEY = 'f222190fc6464bc85ac5ccd03ebcee9f2977d654';
        const AUTH_KEY = '1f5c5fdd84024fdd7ee42c4cfd2e369bddc2f09f';
    </script>
 @endsection