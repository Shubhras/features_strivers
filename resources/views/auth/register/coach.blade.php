  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">

    <!-- Start Include All CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/elegant-icons.css" />
    <link rel="stylesheet" href="assets/css/themify-icons.css" />
    <link rel="stylesheet" href="assets/css/animate.css" />
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/lightcase.css">
    <link rel="stylesheet" href="assets/css/preset.css" />
    <link rel="stylesheet" href="assets/css/theme.css" />
    <link rel="stylesheet" href="assets/css/responsive.css" />
    <!-- End Include All CSS -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <!-- Favicon Icon -->
    @extends('layouts.master_new')
	
    @section('content')

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
        </div> -->
    <!-- </div> -->
    <!-- Preloader Icon -->

    <!-- Header Start -->

    <!-- Header End -->

    <!-- Banner Start -->
    <section class="page-banner01" style="background-image: url(assets/images/home/cta-bg.jpg);">
        <!-- <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="banner-title">Edit Profile</h2>
                    <div class="bread-crumbs">
                        <a href="index.html">Home</a> <span></span> Edit Profile
                    </div>
                </div>
            </div>
        </div> -->
    </section>
    <!-- Banner End -->

    <!-- Course Section Start -->
    <section class="contact-section ">

        <div class="col-md-8 d-flex justify-content-center">
            @if (isset($errors) && $errors->any())
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            @endif
            <div class="contact-form dform" id="Coaches">
                <center>
                    <h4>Sign Up As Coach</h4>
                </center><br>
                <form role="form" method="POST" action="{{ url('/strivers_signup') }}" class="row">
                    <div class="col-md-12">

                        


                        <?php $nameError = (isset($errors) and $errors->has('name')) ? ' is-invalid' : ''; ?>
                        <label class="form-label" for="Name ">Name
                        </label>
                        <input name="name" class="form-control input-md{{ $nameError }}" type="text" placeholder="First Name" value="{{ old('name') }}">
                        <input name="user_type_id" class="form-control input-md{{ $nameError }}" type="hidden" id="user_type_coach" value="2">
                    </div>
                    @if (isEnabledField('email'))
                    <div class="col-md-6">
                        <?php $emailError = (isset($errors) and $errors->has('email')) ? ' is-invalid' : ''; ?>
                        <label class="form-label" for="email">Email
                        </label>
                        <input id="email" name="email" type="email" class="form-control{{ $emailError }}" placeholder="{{ t('email') }}" value="{{ old('email') }}">
                    </div>
                    @endif
                    @if (isEnabledField('phone'))
                    <div class="col-md-6">
                        <?php $phoneError = (isset($errors) and $errors->has('phone')) ? ' is-invalid' : ''; ?>
                        <label class="form-label" for="phone">Phone Numbers
                        </label>
                        <input name="phone" placeholder="{{ (!isEnabledField('email')) ? t('Mobile Phone Number') : t('phone_number') }}" class="form-control input-md{{ $phoneError }}" type="text" value="{{ phoneFormat(old('phone'), old('country', config('country.code'))) }}">
                    </div>
                    @endif
                    <div class="col-md-12">
                        <?php $passwordError = (isset($errors) and $errors->has('password')) ? ' is-invalid' : ''; ?>
                        <label class="form-label" for="address">Password
                        </label>
                        <input id="password" name="password" type="password" class="form-control{{ $passwordError }}" placeholder="{{ t('password') }}" autocomplete="off">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="password">Password Confrmation
                        </label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control{{ $passwordError }}" placeholder="{{ t('Password Confirmation') }}" autocomplete="off">

                        <input type="hidden" name="accept_terms" value="1">
                    </div>
                    <div class="col-sm-12">
                        <center><a class="b-btn bisylms-btn col-sm-12" href="payment-detail.html">Please Enter Your Card Details</a><br>
                        </center>
                    </div>
                    <div class="col-md-12">
                        <center><button class="btn01  btn-primary1" type="submit" id="signupBtn">
                                Register </button></center>
                    </div>
                    <br>
                    <br>
                    <div class="col-sm-12">
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
                    </div>
                    <!-- <center>
                            <div class="col-md-12>
                        <div class="col-md-3">
                            <input type="submit" name="submit" value="Send Message">
                        </div> -->
                </form>
            </div>
        </div>

        </div>




    </section>
    <!-- Course Section End -->

    <!-- Footer Section Start -->

    <!-- Footer Section End -->

    <!-- Back To Top -->
    

    <script>
        const chatService = (function() {

            var username = "raj123";
            return {
                createUserOnCometChat: function(username) {
                    let url = `https://api-us.cometchat.io/v3.0/users`;
                    let data = {
                        uid: username,
                        name: `${username} sample`,
                        avatar: "https://data-us.cometchat.io/assets/images/avatars/captainamerica.png",
                    };

                    fetch(url, {
                            method: "POST",
                            headers: new Headers({
                                appid: APP_ID,
                                apikey: REST_API_KEY,
                                "Content-Type": "application/json",
                            }),
                            body: JSON.stringify(data),
                        })
                        .then((response) => response.json())
                        .then((result) => {
                            this.addUserToAGroup(result.data.uid);
                            console.log(result, "User created");
                        })
                        .catch((error) => console.log(error));
                }
            }
        });
    </script>

@includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.footer1', 'layouts.inc.footer1'])

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
<!-- End Include All JS -->

@endsection

@section('after_styles')

@if (config('lang.direction') == 'rtl')
<!-- <link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet"> -->
@endif



@endsection

@section('after_scripts')
@endsection

@section('after_styles')

@if (config('lang.direction') == 'rtl')
<!-- <link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet"> -->
@endif



@endsection

@section('after_scripts')