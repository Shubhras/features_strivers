
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Start Include All CSS -->
    <link rel="stylesheet" href="assets/css/master.css">

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

// Logo Label
$logoLabel = '';
if (isset($multiCountriesIsEnabled) && $multiCountriesIsEnabled) {
	$logoLabel = config('settings.app.name') . ((!empty(config('country.name'))) ? ' ' . config('country.name') : '');
}
?><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



<div class="header-01 sticky">

<div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <!-- logo Start-->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="../assets/images/logo.png" alt="">
                            <img class="sticky-logo" src="../assets/images/logo4.png" alt="">
                        </a>


    <!-- <nav class="navbar navbar-expand-lg" role="navigation"> -->
        <div class="container-fluid">

        <!-- <div class="navbar-identity p-sm-0 header-logo12">
                {{-- Logo --}}
                <a href="{{ url('/') }}" class="navbar-brand logo logo-title">
                   
                         <img class="sticky-logo" src="../assets/images/logo4.png" alt="">
                         <img src="../assets/images/logo.png" alt="" >
                </a>

                
               
            </div> -->


            @if (!auth()->check())

            <div class="collapse navbar-collapse" id="navbarsDefault" style="margin-right: -103px;">

                                
                <ul class="navbar-nav ">
                   

                    <li class="nav-item">
                        @if (config('settings.security.login_open_in_modal'))
                        <a href="{{ url('/') }}" class="nav-link">
                            <!-- <i class="fas fa-home"></i> -->
                         {{ t('home') }}</a>
                        @else
                        <a href="{{ url('/') }}" class="nav-link">
                            <!-- <i class="fas fa-home"></i> -->
                         {{ t('home') }}</a>
                        @endif
                    </li>

                    

                    <li class="nav-item">
                      
                        <a href="{{ url('/coach_list_category_all') }}" class="nav-link">
                            <!-- <i class="fas fa-address-card"></i> -->
                            {{ t('categories') }}</a>
                       
                    </li>


                    

                    <li class="nav-item">
                        @if (config('settings.security.login_open_in_modal'))
                        <a href="{{ url(\App\Helpers\UrlGen::aboutUs()) }}" class="nav-link">
                            <!-- <i class="fas fa-address-card"></i> -->
                            {{ t('about_us') }}</a>
                        @else
                        <a href="{{ url(\App\Helpers\UrlGen::aboutUs()) }}" class="nav-link">
                            <!-- <i class="fas fa-address-card"></i> -->
                            {{ t('about_us') }}</a>
                        @endif
                    </li>

                    <li class="nav-item">
                        @if (config('settings.security.login_open_in_modal'))
                        <a href="{{ url(\App\Helpers\UrlGen::pricing()) }}" class="nav-link">
                            <!-- <i class="fas fa-tags"></i> -->
                            {{ t('pricing_label') }}</a>
                        @else
                        <a href="{{ url(\App\Helpers\UrlGen::pricing()) }}" class="nav-link">
                            <!-- <i class="fas fa-tags"></i> -->
                            {{ ('pricing_label') }}</a>
                        @endif
                    </li>

                    <li class="nav-item">
                        @if (config('settings.security.login_open_in_modal'))
                        <a href="{{ \App\Helpers\UrlGen::contact() }}" class="nav-link">
                            <!-- <i class="fas fa-info"></i> -->
                            {{ t('Contact') }}</a>
                        @else
                        <a href="{{ \App\Helpers\UrlGen::contact() }}" class="nav-link">
                            <!-- <i class="fas fa-info"></i> -->
                            {{ t('Contact') }}</a>
                        @endif
                    </li>


                    <!-- <li class="nav-item">
                        @if (config('settings.security.login_open_in_modal'))
                        <a href="#quickLogin" class="join-btn01 " data-bs-toggle="modal">
                            
                            {{ t('log_in') }}</a>
                        @else
                        <a href="{{ \App\Helpers\UrlGen::login() }}" class="join-btn01 ">
                           
                            {{ t('log_in') }}</a>
                        @endif
                    </li>
                    <li class="nav-item hidden-sm">
                        <a href="{{ \App\Helpers\UrlGen::register() }}" class="join-btn01">
                            
                                {{ t('register') }}</a>
                    </li> -->

                    
                   
                   
                </ul>

                
                        <a href="#quickLogin" class="join-btn01 " data-bs-toggle="modal">
                            {{ t('log_in') }}</a>
                   
                        <a href="{{ \App\Helpers\UrlGen::register() }}" class="join-btn01">
                                {{ t('register') }}</a>
                
                    
            </div>

            
            @else
                    
            <div class="collapse navbar-collapse" id="navbarsDefault" style="margin-right: -193px;">

                                
                <ul class="navbar-nav ">

                    <li class="nav-item">
                        @if (config('settings.security.login_open_in_modal'))
                        <a href="{{ url('/') }}" class="nav-link">
                            <!-- <i class="fas fa-home"></i>  -->
                            {{ t('home') }}</a>
                        @else
                        <a href="{{ url('/') }}" class="nav-link">
                            <!-- <i class="fas fa-home"></i>  -->
                            {{ t('home') }}</a>
                        @endif
                    </li>

                    <li class="nav-item">
                      
                        <a href="{{ url('/coach_list_category_all') }}" class="nav-link">
                            <!-- <i class="fas fa-address-card"></i> -->
                            {{ t('categories') }}</a>
                       
                    </li>


                    <li class="nav-item">
                        @if (config('settings.security.login_open_in_modal'))
                        <a href="{{ url(\App\Helpers\UrlGen::aboutUs()) }}" class="nav-link">
                            <!-- <i class="fas fa-address-card"></i> -->
                            {{ t('about_us') }}</a>
                        @else
                        <a href="{{ url(\App\Helpers\UrlGen::aboutUs()) }}" class="nav-link">
                            <!-- <i class="fas fa-address-card"></i> -->
                            {{ t('about_us') }}</a>
                        @endif
                    </li>

                    <li class="nav-item">
                        @if (config('settings.security.login_open_in_modal'))
                        <a href="{{ url(\App\Helpers\UrlGen::pricing()) }}" class="nav-link">
                            <!-- <i class="fas fa-tags"></i> -->
                            {{ t('pricing_label') }}</a>
                        @else
                        <a href="{{ url(\App\Helpers\UrlGen::pricing()) }}" class="nav-link">
                            <!-- <i class="fas fa-tags"></i> -->
                            {{ ('pricing_label') }}</a>
                        @endif
                    </li>

                    <li class="nav-item">
                        @if (config('settings.security.login_open_in_modal'))
                        <a href="{{ \App\Helpers\UrlGen::contact() }}" class="nav-link">
                            <!-- <i class="fas fa-info"></i> -->
                            {{ t('Contact') }}</a>
                        @else
                        <a href="{{ \App\Helpers\UrlGen::contact() }}" class="nav-link">
                            <!-- <i class="fas fa-info"></i> -->
                            {{ t('Contact') }}</a>
                        @endif
                    </li>


                    
                    <li class="nav-item hidden-sm">
                        @if (app('impersonate')->isImpersonating())
                        <a href="{{ route('impersonate.leave') }}" class="nav-link">
                            <!-- <i class="fas fa-sign-out-alt hidden-sm"></i>  -->
                            {{ t('Leave') }}
                        </a>
                        @else
                        <a href="{{ \App\Helpers\UrlGen::logout() }}" class="nav-link">
                            <!-- <i class="fas fa-sign-out-alt hidden-sm"></i>  -->
                            {{ t('log_out') }}
                        </a>
                        @endif
                    </li>
                    <li class="nav-item dropdown no-arrow">
                        <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                            <!-- <i class="fas fa-user-circle hidden-sm"></i> -->
                            <span>{{ auth()->user()->name }}</span>
                            <span
                                class="badge badge-pill badge-important count-threads-with-new-messages hidden-sm">0</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <ul id="userMenuDropdown" class="dropdown-menu user-menu dropdown-menu-right shadow-sm sidebar-menu-ul side-menu-dropdown">
                            <li class="dropdown-item active dropdown-menu-sidebar">
                                <a href="{{ url('account') }}" class="dropdown-menu-sidebar-a side-menu-li-user">
                                    <i class="fas fa-user-edit"></i> {{ t('Personal Home') }}
                                </a>
                            </li>
                            <li class="dropdown-item dropdown-menu-sidebar"><a href="{{ url('account/dashboard') }}" class="dropdown-menu-sidebar-a side-menu-li-user"><i
                                        class="fas fa-th-list"></i> {{ t('dashboard') }} </a></li>
                            <li class="dropdown-item dropdown-menu-sidebar"><a href="{{ url('account/favourite') }}" class="dropdown-menu-sidebar-a side-menu-li-user"><i
                                        class="fas fa-heart"></i> {{ t('favourite_ads') }} </a></li>
                            <li class="dropdown-item dropdown-menu-sidebar"><a href="{{ url('account/saved-search') }}" class="dropdown-menu-sidebar-a side-menu-li-user"><i
                                        class="fas fa-bookmark"></i> {{ t('Saved searches') }} </a></li>
                            <li class="dropdown-item dropdown-menu-sidebar"><a href="{{ url('account/my_courses') }}" class="dropdown-menu-sidebar-a side-menu-li-user"><i
                                        class="fas fa-hourglass-half"></i> {{ ('Consultation') }} </a></li>
                            <li class="dropdown-item dropdown-menu-sidebar"><a href="{{ url('account/archived') }}" class="dropdown-menu-sidebar-a side-menu-li-user"><i
                                        class="fas fa-calendar-times"></i> {{ t('archived_ads') }}</a></li>
                            <li class="dropdown-item dropdown-menu-sidebar">
                                <a href="{{ url('account/chat') }}" class="dropdown-menu-sidebar-a side-menu-li-user">
                                    <i class="far fa-envelope"></i> {{ ('Chat') }}
                                    <span
                                        class="badge badge-pill badge-important count-threads-with-new-messages">0</span>
                                </a>
                            </li>
                            <li class="dropdown-item dropdown-menu-sidebar"><a href="{{ url('account/transactions') }}" class="dropdown-menu-sidebar-a side-menu-li-user"><i
                                        class="fas fa-coins"></i> {{ t('Transactions') }}</a></li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item dropdown-menu-sidebar">
                                @if (app('impersonate')->isImpersonating())
                                <a href="{{ route('impersonate.leave') }}" class="dropdown-menu-sidebar-a"><i class="fas fa-sign-out-alt"></i>
                                    {{ t('Leave') }}</a>
                                @else
                                <a href="{{ \App\Helpers\UrlGen::logout() }}"><i class="fas fa-sign-out-alt"></i>
                                    {{ t('log_out') }}</a>
                                @endif
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
            @endif

        </div>
        </div>
    </nav>

    </div>
</div>
</div>
</div>

    <div class="modal fade" id="catModal" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">What topics do you find interesting?</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" >
                    
                    <div class = "category_container">
                        <?php 

                            $categories = DB::table('categories')->select('categories.name','categories.id')->where('categories.parent_id' ,null)->orderBy('categories.name','asc')->get();
                            //print_r();die;
                            foreach($categories as $value){
                            $name = json_decode($value->name);
                            $ss = array();
                                foreach ($name as $key => $sub) {
                                    $ss[$key] = $sub;
                                }
                            //print_r($ss['en']);

                        ?>
                        <div class = "category_data"><a href="{{url('/coach_list/'.$value->id) }}"> {{$ss['en']}}</a></div>

                        <?php }?>
                        <button id="sbmturintrst" class="" data-dismiss="modal">Submit Your Interest</button>
                            </div>
                </div>

                <!-- Modal footer -->
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div> -->

            </div>
        </div>
    </div>

    



