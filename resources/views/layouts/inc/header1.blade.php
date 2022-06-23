<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

<!-- Start Include All CSS -->
<link rel="stylesheet" href="../assets/css/master.css">

<link rel="stylesheet" href="../assets/css/bootstrap.css" />
<link rel="stylesheet" href="../assets/css/font-awesome.min.css" />
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


<?php

// Search parameters
$queryString = (request()->getQueryString() ? ('?' . request()->getQueryString()) : '');

// Check if the Multi-Countries selection is enabled
$multiCountriesIsEnabled = false;
$multiCountriesLabel = '';
if (config('settings.geo_location.country_flag_activation')) {
    if (!empty(config('country.code'))) {
        if (isset($countries) && $countries->count() > 1) {
            $multiCountriesIsEnabled = true;
            $multiCountriesLabel = 'title="' . t('Select a Country') . '"';
        }
    }
}

$logoLabel = '';
if (isset($multiCountriesIsEnabled) && $multiCountriesIsEnabled) {
    $logoLabel = config('settings.app.name') . ((!empty(config('country.name'))) ? ' ' . config('country.name') : '');
}
?><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<?php
$index_and_footer_logo = DB::table('logo_header_and_footer_and_images_change')->select('logo_header_and_footer_and_images_change.*')->first();

?>


<header class="header-016 sticky">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg nav-menu-fix2387">
                    <!-- logo Start-->
                    <!-- <a class="navbar-brand" href="{{'/'}}">
                        <img src="../assets/images/logo.png" alt="">
                        <img class="sticky-logo" src="../assets/images/logo4.png" alt="">
                    </a> -->
                    <a class="navbar-brand" href="{{'/'}}">
                        <img src="{{ url('storage/'.$index_and_footer_logo->index_header_logo_1) }}" alt="">
                        <img class="sticky-logo" src="{{ url('storage/'.$index_and_footer_logo->index_header_logo_2) }}" alt="">
                    </a>

                    <!-- logo End-->

                    <!-- Moblie Btn Start -->
                    <button class="navbar-toggler" type="button">
                        <i class="fal fa-bars"></i>
                    </button>
                    <!-- Moblie Btn End -->

                    <!-- Nav Menu Start -->
                    <!-- <div class="collapse navbar-collapse" id="mobile"> -->

                    <div class="collapse navbar-collapse mobile-menu-fix32">
                        <ul class="navbar-nav ">
                            <li class="menu-item-has-children side-menu-content768">


                                <a href="{{('/')}}">Home</a>

                            </li>
                            <?php $id = '0'; ?>
                            <li class="menu-item-has-children side-menu-content768">
                                <a href="{{ url('coach_list_category_all/'.$id) }}">Categories</a>

                            </li>
                            <li class="menu-item-has-children side-menu-content768">
                                <a href="{{url('aboutUs')}}">About Us</a>

                            </li>
                            <li class="menu-item-has-children side-menu-content768">
                                <a href="{{url('pricing')}}">Pricing</a>

                            </li>

                            <li class="menu-item-has-children side-menu-content768">
                                <a href="{{url('contact')}}">Contact</a>
                            </li>



                            @if (auth()->check())

                           
                            

                            <li class="nav-item dropdown no-arrow side-menu-content768">

                                @if (config('settings.security.login_open_in_modal'))
                                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                                    <!-- <i class="fas fa-user-circle hidden-sm"></i> -->
                                    <span>{{ auth()->user()->name }}</span>
                                    <?php
                        $user =auth()->user()->id;
                      $message=  DB::table('threads_participants')->select('threads_participants.*')->where('threads_participants.user_id',$user)->where('threads_participants.last_read',null)->get();

                     $total_unread_message =  count($message);
                    //  print($total_unread_message);die;
                        ?>
                                    <span class="badge badge-pill badge-important count-threads-with-new-messages hidden-sm">{{$total_unread_message}}</span>
								<!-- <i class="fas fa-chevron-down"></i> -->
                                    <i class="fas fa-chevron-down"></i>
                                    
                                </a>
                                @else


                                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                                    <!-- <i class="fas fa-user-circle hidden-sm"></i> -->
                                    <span>{{ auth()->user()->name }}</span>

                                    <i class="fas fa-chevron-down"></i>
                                </a>
                                
                                @endif

                                <ul id="userMenuDropdown" class="dropdown-menu user-menu dropdown-menu-right shadow-sm sidebar-menu-ul side-menu-dropdown navbar-expand-lg1">
                                    <li class="dropdown-item active dropdown-menu-sidebar list-side-menu876">
                                        <a href="{{ url('account') }}" class="dropdown-menu-sidebar-a side-menu-li-user">
                                            <i class="fas fa-user-edit"></i> {{ t('Personal Home') }}
                                        </a>
                                    </li>
                                    <li class="dropdown-item dropdown-menu-sidebar list-side-menu876"><a href="{{ url('account/dashboard') }}" class="dropdown-menu-sidebar-a side-menu-li-user"><i class="fas fa-th-list"></i> {{ t('dashboard') }} </a></li>

                                    <li class="dropdown-item dropdown-menu-sidebar list-side-menu876"><a href="{{ url('account/my_courses') }}" class="dropdown-menu-sidebar-a side-menu-li-user"><i class="fas fa-hourglass-half"></i> {{ ('Consultation') }} </a></li>

                                    <li class="dropdown-item dropdown-menu-sidebar list-side-menu876">
                                        <a href="{{ url('account/chat') }}" class="dropdown-menu-sidebar-a side-menu-li-user">
                                            <!-- <i class="far fa-envelope"></i> {{ ('Chat') }} -->
                                            <i class="far fa-envelope"></i> {{('Call / Message')}}

                                            <!-- <img src="../assets/images/chat_call.png" alt="">{{('Call / Message')}} -->

                                            <!-- <span class="badge badge-pill badge-important count-threads-with-new-messages">0</span> -->
                                        </a>
                                    </li>
                                    <!-- <li class="dropdown-item dropdown-menu-sidebar"><a href="{{ url('account/transactions') }}" class="dropdown-menu-sidebar-a side-menu-li-user"><i
                    class="fas fa-coins"></i> {{ t('Transactions') }}</a></li> -->
                                    <!-- <li class="dropdown-divider"></li> -->
                                    <li class="dropdown-item dropdown-menu-sidebar list-side-menu876" style="color: black;">
                                        @if (app('impersonate')->isImpersonating())
                                        <a href="{{ route('impersonate.leave') }}" class="dropdown-menu-sidebar-a"><i class="fas fa-sign-out-alt"></i>
                                            {{ t('Leave') }}</a>
                                        @else
                                        <a href="{{ \App\Helpers\UrlGen::logout() }}" style="color: black;"><i class="fas fa-sign-out-alt dropdown-menu-sidebar-a"></i>
                                            {{ t('log_out') }}</a>
                                        @endif
                                    </li>
                                </ul>
                            </li>
                            @endif

                            <li class="nav-item dropdown no-arrow side-menu-content768" style="width: 123px;">
                            <div id="google_translate_element" style="margin-top: 30px;"></div>

                            <script type="text/javascript">
                                // function googleTranslateElementInit() {
                                //     new google.translate.TranslateElement({
                                //         pageLanguage: 'en'
                                //     }, 'google_translate_element');
                                // }
                                function googleTranslateElementInit() {
                                        new google.translate.TranslateElement({
                                            includedLanguages: 'en,es,fr,pt,hi,ja,it',
                                            layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
                                        }, 'google_translate_element');
                                    }
                            </script>

                            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                        </li>
                        </ul>
                       
                        @if (!auth()->check())

                        <a href="{{url('login')}}" class="join-btn01">
                            Login</a>


                        <a href="{{ \App\Helpers\UrlGen::register() }}" class="join-btn01">
                            Sign Up</a>
                        @endif



                    </div>


                </nav>

            </div>
        </div>
    </div>
    <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/62a9a4db7b967b117994a485/1g5janvaq';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</header>
