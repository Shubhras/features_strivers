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

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

<!-- Start Include All CSS -->
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

@extends('layouts.master_new')



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css" />

<!-- <section class="page-banner01" style="background-image: url(../assets/images/home/cta-bg.jpg);">

</section> -->
<section class="page-banner01">

</section>
<?php
$index_and_footer_logo = DB::table('logo_header_and_footer_and_images_change')->select('logo_header_and_footer_and_images_change.*')->first();

?>
@section('content')
@includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'])


<section style="background-color: white;">
    <div class="main-container">
        <div class="container">

            <?php $photo_url1 = ltrim($user->photo_url, 'http://127.0.0.1:8000'); ?>
            <?php if ($user->user_type_id == 2) {

            ?>
                <h2>

                    <h2 class="sec-title">My Payment</h2>
                </h2>



                <div class="row" style="padding: 6px; margin-left: -4px;">


                    <div class="col-md-12 user-profile-img-data default-inner-box">

                        <!-- <img id="userImg" class="user-profile-images1" src="{{ url($photo_url1) }}" alt="user" width="50px;"
                        height="50px;" border-radius=" 50%"> &nbsp; -->
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
                        @includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar_coach',
                        'account.inc.sidebar_coach'])
                    </div>
                    <div class="col-md-9 page-content ptop">




                        <div class="mb-5">

                            <!-- <div class="row coaches_payment_data">
                            <div class="col-lg-4 card bg-success text-white card-body till_date_striver">
                                <span class="span_text_show">Revenue Till date </span>
                                <span>05-01-2021</span>

                            </div>

                            &nbsp; &nbsp;

                            <div class="col-lg-4 card bg-primary text-white card-body till_date_striver">
                                <span class="span_text_show">Revenue this month</span>
                                <span>05-02-2021</span>

                            </div>
                            &nbsp; &nbsp;

                            <div class="col-lg-4 card bg-info text-white card-body till_date_striver">
                                <span class="span_text_show">Revenue this Quarter</span>
                                <span>05-01-2021</span>

                            </div>
                        </div> -->


                            <div class="row  coaches_payment_data">
                                <div class="col-lg-4 card bg-danger text-white card-body till_date_striver">
                                    <span class="span_text_show">Total {{$index_and_footer_logo->change_strivre_name}}</span>
                                    <span>{{$totalStrivrePayment}}</span>


                                </div>
                                &nbsp; &nbsp;

                                <div class="col-lg-4 card bg-dark text-white card-body till_date_striver">
                                    <!-- <span class="span_text_show">Available Balance</span> -->
                                    <span class="span_text_show">Total Balance</span>

                                    <?php
                                    $total_balance = [];
                                    foreach ($strivrePayment as $totalBalance) {

                                        $total_balance[$totalBalance->coach_payment] =  $totalBalance->coach_payment;
                                    }

                                    $totalvalus = array_sum($total_balance);
                                    // $totalvalus = implode('',$total_balance);

                                    // print_r($totalvalus);die;

                                    ?>
                                    <span>{{$totalvalus}}</span>
                                </div>

                                &nbsp; &nbsp;
                                <!-- <a href="#" class="get-payments-btn card text-white card-body till_date_striver"> -->
                                <form action="{{url('/account/get-coach-payment-request')}}" method="post" class="get-payments-btn card text-white card-body till_date_striver">
                                    <div class="coaches_get_payment">
                                        <input type="hidden" name="total_payment" id="total_payment" style="float: left; font-size: 14px; width:80px; border:none;" value="">

                                        <input type="text" name="total_payment_select" id="total_payment_select" style="float: left; font-size: 14px; width:80px; border:none;" value="">

                                        <input type="hidden" name="commission" id="commission" style="float: left; font-size: 14px; width:80px; border:none;" value="">


                                        <input type="hidden" name="select_payment_id" id="select_payment_id" style="float: left; font-size: 14px; width:80px; border:none;" value="">


                                        <!-- <span id="total_payment_select" value=""></span> -->
                                        <button type="submit" style="background: #012245; color:#ffffff; border:none;     display: flow-root;">Get Paid</button>

                                    </div>
                                </form>
                                <!-- </a> -->


                            </div>

                        </div>

                        <div>

                        </div>

                        <?php
                        $requested_balance = [];
                        foreach ($strivrePaymentCount as $totalBalance) {

                            $requested_balance[$totalBalance->coach_payment] =  $totalBalance->coach_payment;
                        }

                        $requestedtotalvalus = array_sum($requested_balance);
                        // $totalvalus = implode('',$total_balance);

                        // print_r($totalvalus);die;

                        ?>

                        <?php
                        $available_balance = [];
                        foreach ($strivrePaymentAvailable as $totalBalance) {

                            $available_balance[$totalBalance->coach_payment] =  $totalBalance->coach_payment;
                        }

                        $availabletotalvalus = array_sum($available_balance);
                        // $totalvalus = implode('',$total_balance);

                        // print_r($totalvalus);die;

                        ?>



                        <b><span>Requested Balance: {{$requestedtotalvalus}}</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span>Available Balance: {{$availabletotalvalus}}</span> </b>

                        <!-- <div class="inner-box default-inner-box"> -->


                        <div class="row">


                            <div class="table-responsive">
                                <br>
                                <form name="listForm" method="POST" action="{{ url('account/' . $pagePath . '/delete') }}">
                                    {!! csrf_field() !!}
                                    <!-- <div class="table-action"> -->
                                    <!-- <div class="btn-group hidden-sm" role="group">
												 <button type="button" class="btn btn-sm btn-secondary">
													<input type="checkbox" id="checkAll" class="from-check-all">
												</button>
												<button type="button" class="btn btn-sm btn-secondary from-check-all">
													{{ t('Select') }}: {{ t('All') }}
												</button> -->
                                    <!-- </div>  -->

                                    <!-- <button type="submit" class="btn btn-sm btn-default delete-action">
												<i class="fa fa-trash"></i> {{ t('Delete') }}
											</button> -->

                                    <!-- <div class="table-search float-end col-sm-7">
												<div class="form-group">
													<div class="row">
														<label class="col-sm-5 control-label text-end">{{ t('search') }} <br>
															<a title="clear filter" class="clear-filter" href="#clear">[{{ t('clear') }}]</a>
														</label>
														<div class="col-sm-7 searchpan">
															<input type="text" class="form-control" id="filter">
														</div>
													</div>
												</div>
											</div> -->
                                    <!-- </div> -->

                                    <table id="addManageTable" class="result-table" data-filter="#filter" data-filter-text-only="true">
                                        <thead>
                                            <tr>
                                                <th class="course">Student</th>
                                                <th class="date">Course</th>
                                                <th class="grade">Total Amount</th>
                                                <th class="progres"> Fee deducted </th>
                                                <th class="progres">Net payment </th>
                                                <th class="progres">Commission % </th>
                                                <th class="progres">Date </th>
                                                <th class="progres">Action</th>



                                            </tr>

                                        </thead>


                                        <tbody>
                                            <?php foreach ($strivrePayment as $key => $strivrePaymentDetail) {

                                                // print_r($strivrePaymentDetail);die;


                                            ?>
                                                <tr>
                                                    <td class="course">
                                                        <a href="#">{{$strivrePaymentDetail->strivre_name}}</a>
                                                    </td>
                                                    <td class="date">{{$strivrePaymentDetail->course_name}}</td>
                                                    <td class="grade">{{$strivrePaymentDetail->total_payment}}</td>
                                                    <td class="progres">{{$strivrePaymentDetail->commission}}</td>
                                                    <td class="grade">{{$strivrePaymentDetail->coach_payment}}</td>
                                                    <td class="grade">{{$strivrePaymentDetail->commission_percent}}&nbsp;%</td>
                                                    <td class="progres">{{$strivrePaymentDetail->payment_date}}</td>

                                                    <?php if ($strivrePaymentDetail->payment_status != null) { ?>
                                                        <td class="grade"><input type="checkbox" name="payment_status" checked disabled></td>

                                                    <?php } else { ?>
                                                        <td class="grade"><input type="checkbox" name="payment_status_id" id="payment_status_id_{{$strivrePaymentDetail->enroll_id}}" onclick="javascript: SelectallColorsForStyle(this, value);" value="{{$strivrePaymentDetail->enroll_id}}"></td>


                                                    <?php } ?>

                                                </tr>

                                            <?php } ?>

                                            <!-- <div id="tablespace"></div> -->

                                            <!-- <tr>
                                            <td class="course">
                                                <a href="#">LMS Interactive Content</a>
                                            </td>
                                            <td class="date">24/03/2020</td>
                                            <td class="grade">40%</td>
                                            <td class="progres">0% In Progress</td>
                                            <td class="grade">400</td>
                                            <td class="grade">600</td>



                                        </tr>
                                        <tr>
                                            <td class="course">
                                                <a href="#">From Zero to Hero with Nodejs</a>
                                            </td>
                                            <td class="date">14/04/2019</td>
                                            <td class="grade">70%</td>
                                            <td class="progres">0% In Progress</td>
                                            <td class="grade">400</td>
                                            <td class="grade">600</td>


                                        </tr>
                                        <tr>
                                            <td class="course">
                                                <a href="#">Helping to change the world</a>
                                            </td>
                                            <td class="date">04/07/2018</td>
                                            <td class="grade">50%</td>
                                            <td class="progres">0% In Progress</td>
                                            <td class="grade">400</td>
                                            <td class="grade">600</td>


                                        </tr> -->

                                        </tbody>


                                        <tbody>
                                            <?php
                                            $i = 0;

                                            if (isset($user_subscription1) && $user_subscription1->count() > 0) :
                                                foreach ($user_subscription1 as $key => $post) :

                                                    $i =    $i + 1; ?>

                                                    <tr>


                                                        <td class="price-td" style="width:20%">
                                                            <div>
                                                                <strong>
                                                                    {{ $post->username }}


                                                                </strong>
                                                            </div>
                                                        </td>

                                                        <td class="price-td" style="width:40%">
                                                            <div>
                                                                <strong>
                                                                    {{ $post->name }}


                                                                </strong>
                                                            </div>
                                                        </td>

                                                        <td class="price-td" style="width:10%">
                                                            <div>
                                                                <strong>

                                                                    <?php



                                                                    $total_payment = $post->fee_deducte + $post->net_payment;
                                                                    print_r($total_payment);
                                                                    die;
                                                                    ?>

                                                                    {{$total_provided_hours}}

                                                                </strong>

                                                            </div>
                                                        </td>

                                                        <td class="price-td" style="width:10%">
                                                            <div>
                                                                <strong>
                                                                    {{$post->created_at}}


                                                                </strong>
                                                            </div>
                                                        </td>


                                                        <td class="price-td" style="width:10%">
                                                            <div>
                                                                <strong>



                                                                </strong>
                                                            </div>
                                                        </td>


                                                        <td class="price-td" style="width:10%">
                                                            <div>
                                                                <strong>



                                                                </strong>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                <?php endforeach; ?>

                                            <?php endif; ?>

                                        </tbody>
                                    </table>

                                </form>
                            </div>
                        </div>
                        <nav>
                            {{ (isset($posts)) ? $posts->links() : '' }}
                        </nav>



                        <center><span data-href=" {{url('account/tasks')}}" id="export" class="btn btn-success btn-sm" onclick="exportTasks(event.target);">Export</span>

                        <span data-href=" {{url('account/tasks_pdf')}}" id="export" class="btn btn-success btn-sm" onclick="exportTasks(event.target);">Export PDF</span>
                        
                        <button type="button" class="btn btn-primary btn-sm" id="btnMultiple" style="font-size: 9px;">Add Price</button></center>

                    </div>
                    <script>
                        function exportTasks(_this) {
                            let _url = $(_this).data('href');
                            window.location.href = _url;
                        }
                    </script>
                </div>
                <!--/.row-box End-->

        </div>
        <br>



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
                                    <img src="{{ url('storage/'.$coach_list->photo) }}" alt="Jim S??chen">

                                </div>
                                <div class="teacher-meta">
                                    <h5>
                                        {{ $coach_list->name }}
                                    </h5>
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

    </div>





    <!--/.page-content-->



    </div>


<?php } else { ?>

    <h2>

        <h2 class="sec-title">My Subscriptions</h2>
    </h2>



    <div class="row" style="padding: 6px; margin-left: -4px;">


        <div class="col-md-12 user-profile-img-data default-inner-box">

            <!-- <img id="userImg" class="user-profile-images1" src="{{ url($photo_url1) }}" alt="user" width="50px;"
                height="50px;" border-radius=" 50%"> &nbsp; -->
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


            <div class="inner-box default-inner-box edit-file-chat box ">

                <!--/.row-box End-->



                <div class="row">



                    <?php
                    if ($package_name_strivre) {

                    ?>
                        <div style="margin-left: 125px; margin-top: 41px;">
                            <?php

                            //  $names = json_decode($packagename);

                            $sub_name = array();

                            $sub_namess = [];
                            // foreach ($package_name_strivre as $key => $sub) {


                            $names = json_decode($package_name_strivre->name);

                            $ss = array();
                            foreach ($names as $key => $en) {

                                $ss[$key] = $en;
                            }


                            $sub_name['en'] = $ss;


                            // $name = ($user_subscription->total_provided_hours-$user_subscription->remaining_hours);
                            // print_r($ss);die;
                            // print_r($sub_name);die;
                            $sub_namess = $ss['en'];
                            // print_r($sub_namess);die;
                            ?>
                            <?php // } 
                            ?>
                            <span class="subscription-nanme-by-user boxfont "> {{$sub_namess }}</span>




                        </div>
                </div>

                <div class="row" style="margin-top: -27px;    margin-left: 25px;">
                    <div class="line_bottom">
                        <p> Subscription: </p>
                        <p> Total hours: <span class="boxfont">{{$totalpoints}} Credits</span></p>
                        <p> Consumed Hours: <span class="boxfont">{{$consumed_hours}} Credits</span></p>
                        <p> Remaining Hours: <span class="boxfont">{{$remaining_hours}} Credits</span></p>



                    </div>
                </div>
                <br>
                <?php
                        if (empty($remaining_hours)) {
                ?>
                    <div class="col-md-12" style="text-align: center;">
                        <a class="bisylms-btn-pink" href="{{ url('subscription') }}">

                            Renew Subscriptions
                        </a>
                    </div>


                <?php } ?>
                <div class="col-md-12" style="text-align: left;">
                    <a class="bisylms-btn-pink" href="{{ url('pricing') }}">
                        Buy Credits
                    </a>

                </div>
            <?php } else { ?>


                <div class="col-md-12" style="text-align: center;">
                    <h2 style="color: #ffffff;">Please Get Subscription First!</h2>
                </div>
                <div class="col-md-12" style="text-align: center;">
                    <a class="bisylms-btn-pink" href="{{ url('pricing') }}">

                        Get Subscriptions

                    </a>

                </div>


            <?php }
            ?>


            <br>


            <!-- <h2 style="text-align:center;"><b>
					old Subscriptions </b></h2> -->
            <?php

                // 	}

                // 
            ?>

            </div>
            <div class="states">

                <?php
                if ($user_subscriptions1) {
                ?>




                    <?php
                    foreach ($user_subscriptions1 as $key => $value) {
                        $name = json_decode($value->name);
                        $ss = array();
                        foreach ($name as $key => $sub) {
                            $ss[$key] = $sub;
                        }

                    ?>

                        <br>
                        <?php
                        if (empty($user_subscriptions1->remaining_hours)) {
                        ?>
                            <div class="col-md-12">
                                <!-- <h2> Old plan :{{$ss['en']}}</h2>
								<h2> Old plan Hours :{{$value->net_payment}} Hours.</h2> -->
                            </div>
                        <?php } ?>

                <?php
                    }
                }    ?>
                <br>
            </div>


            <div class="row">


                <div class="table-responsive">
                    <br>
                    <form name="listForm" method="POST" action="{{ url('account/' . $pagePath . '/delete') }}">
                        {!! csrf_field() !!}
                        <!-- <div class="table-action"> -->
                        <!-- <div class="btn-group hidden-sm" role="group">
                     <button type="button" class="btn btn-sm btn-secondary">
                        <input type="checkbox" id="checkAll" class="from-check-all">
                    </button>
                    <button type="button" class="btn btn-sm btn-secondary from-check-all">
                        {{ t('Select') }}: {{ t('All') }}
                    </button> -->
                        <!-- </div>  -->

                        <!-- <button type="submit" class="btn btn-sm btn-default delete-action">
                    <i class="fa fa-trash"></i> {{ t('Delete') }}
                </button> -->

                        <!-- <div class="table-search float-end col-sm-7">
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-5 control-label text-end">{{ t('search') }} <br>
                                <a title="clear filter" class="clear-filter" href="#clear">[{{ t('clear') }}]</a>
                            </label>
                            <div class="col-sm-7 searchpan">
                                <input type="text" class="form-control" id="filter">
                            </div>
                        </div>
                    </div>
                </div> -->
                        <!-- </div> -->

                        <table id="addManageTable" class="result-table" data-filter="#filter" data-filter-text-only="true">
                            <thead>
                                <tr>
                                    <th class="course">Coach</th>
                                    <th class="date">Course</th>
                                    <th class="grade">Total Amount</th>
                                    <th class="progres">Date </th>
                                    <!-- <th class="progres"> Fee deducted </th>
                                    <th class="progres">Net payment </th> -->
                                    <!-- <th class="progres">Action</th> -->



                                </tr>

                            </thead>


                            <tbody>
                                <?php foreach ($strivrePaymentDetail as $key => $strivrePaymentDetail) {

                                    // print_r($strivrePaymentDetail);die;


                                ?>
                                    <tr>
                                        <td class="course">
                                            <a href="#">{{$strivrePaymentDetail->strivre_name}}</a>
                                        </td>
                                        <td class="date">{{$strivrePaymentDetail->course_name}}</td>
                                        <td class="grade">{{$strivrePaymentDetail->creadit_required}}</td>
                                        <td class="progres">{{$strivrePaymentDetail->dated}}</td>
                                        <!-- <td class="grade">{{$strivrePaymentDetail->creadit_required}}</td>
                                        <td class="grade">{{$strivrePaymentDetail->creadit_required}}</td> -->

                                        

                                    </tr>

                                <?php } ?>



                            </tbody>


                            <tbody>
                                <?php
                                $i = 0;

                                if (isset($user_subscription1) && $user_subscription1->count() > 0) :
                                    foreach ($user_subscription1 as $key => $post) :

                                        $i =    $i + 1; ?>

                                        <tr>


                                            <td class="price-td" style="width:20%">
                                                <div>
                                                    <strong>
                                                        {{ $post->username }}


                                                    </strong>
                                                </div>
                                            </td>

                                            <td class="price-td" style="width:40%">
                                                <div>
                                                    <strong>
                                                        {{ $post->name }}


                                                    </strong>
                                                </div>
                                            </td>

                                            <td class="price-td" style="width:10%">
                                                <div>
                                                    <strong>

                                                        <?php



                                                        $total_payment = $post->fee_deducte + $post->net_payment;
                                                        print_r($total_payment);
                                                        die;
                                                        ?>

                                                        {{$total_provided_hours}}

                                                    </strong>

                                                </div>
                                            </td>

                                            <td class="price-td" style="width:10%">
                                                <div>
                                                    <strong>
                                                        {{$post->created_at}}


                                                    </strong>
                                                </div>
                                            </td>


                                            <td class="price-td" style="width:10%">
                                                <div>
                                                    <strong>



                                                    </strong>
                                                </div>
                                            </td>


                                            <td class="price-td" style="width:10%">
                                                <div>
                                                    <strong>



                                                    </strong>
                                                </div>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>

                                <?php endif; ?>

                            </tbody>
                        </table>

                    </form>
                </div>

               
            </div>

            <nav>
                            {{ (isset($posts)) ? $posts->links() : '' }}
                        </nav>



                        <center><span data-href=" {{url('account/tasks_strivre')}}" id="export" class="btn btn-success btn-sm" onclick="exportTasks(event.target);">Export CSV</span>
                       
                        <span data-href=" {{url('account/tasks_strivre_pdf')}}" id="export" class="btn btn-success btn-sm" onclick="exportTasks(event.target);">Export PDF</span>
                    </center>

                    </div>
                    <script>
                        function exportTasks(_this) {
                            let _url = $(_this).data('href');
                            window.location.href = _url;
                        }
                    </script>
          
        </div>
        
    </div>
    <?php



                // $curl = curl_init();

                // curl_setopt_array($curl, array(
                // 	CURLOPT_URL => 'https://metrics-us.cometchat.io/v1/calls/sessions/v1.us.2040141e5d5dcef3.group_1647672948681/participants?beginningTimestamp=1647673278116&endingTimestamp=1647675469379',
                // 	CURLOPT_RETURNTRANSFER => true,
                // 	CURLOPT_ENCODING => '',
                // 	CURLOPT_MAXREDIRS => 10,
                // 	CURLOPT_TIMEOUT => 0,
                // 	CURLOPT_FOLLOWLOCATION => true,
                // 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                // 	CURLOPT_CUSTOMREQUEST => 'GET',
                // 	CURLOPT_HTTPHEADER => array(
                // 	  'appId: 2040141e5d5dcef3',
                // 	  'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGltZ210LmNvbWV0Y2hhdC5pb1wvYXBwc1wvMjA0MDE0MWU1ZDVkY2VmMyIsImlhdCI6MTY0NzY3OTEzOSwic3ViIjoiMjA0MDE0MWU1ZDVkY2VmMyIsIm5iZiI6MTY0NzY3NTUzOSwiZXhwIjoxNjUwMjcxMTM5LCJkYXRhIjp7ImFwcElkIjoiMjA0MDE0MWU1ZDVkY2VmMyIsInJlZ2lvbiI6InVzIn19.D90PKiDUNY2pZswn2UB-c5ZX7aGwvghvz-ftajIG4es',
                // 	  'uid: strivre82789'
                // 	),
                //   ));

                //   $response = curl_exec($curl);

                //   curl_close($curl);
                // //   echo $response;
                //   	$responsess= json_decode($response);
                // 	  $data = array();
                // 	  $data1 = array();
                // 	  $data2 = array();
                //   foreach($responsess as $key =>$uidkey){

                // 	//   $data[$uidkey->uid] =$uidkey;


                // 	  foreach($uidkey as $key =>$value){

                // 		$data[$value->uid] =$value->uid;
                // 		$data1[$value->uid] =$value->video_minutes;
                // 		$data2[$value->uid] =$value->audio_minutes;


                // 	}



                //   }

                //   print_r($user->username);

                //   print_r($data);

                //   print_r($data1);
                //   print_r($data2);



                // echo date('m/d/Y H:i:s', 1647496224);

    ?>

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
                    Suggested Coaches

                </h2>





                <?php foreach ($suggested_coaches as $coach_list) { ?>
                    <div class="col-lg-3 col-md-6">

                        <a href="{{url('/top_coach_detail/'.$coach_list->id) }}">
                            <div class="teacher-item">
                                <div class="teacher-thumb coach-img-wrapper">
                                    <img src="{{ url('storage/'.$coach_list->photo) }}" alt="Jim S??chen">

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
<!--/.row-->
</div>
<!--/.container-->
</div>
<br>


<script>
    $(document).ready(function() {
        $('#btnMultiple').click(function() {
            var payment_status_id = [];
            $("input:checkbox[name='payment_status_id']:checked").each(function() {
                payment_status_id.push($(this).val());
            });
            // alert("The best strivre are: " + payment_status_id.join(", "));




            $.ajax({
                type: "POST",
                dataType: 'Json',
                url: "{{ url('account/get_payment_coach_request') }}",
                data: {
                    'id': payment_status_id
                },

                success: function(Response) {


                    if (Response) {

                        console.log('payment status', Response.coach_payment)

                        // $("#sub_category34").empty();
                        // alert(Response.coach_payment);
                        $("#total_payment").val(Response.total_payment);
                        $("#total_payment_select").val(Response.coach_payment_request);
                        $("#commission").val(Response.commission);

                        $("#select_payment_id").val(payment_status_id);


                    }
                }

            });
        });
    });
</script>


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

    .states h2 {
        margin-top: 50px;
        padding-left: 35px;
    }
</style>
@endsection

@section('after_scripts')
<script src="{{ url('assets/plugins/bootstrap-fileinput/js/plugins/sortable.min.js') }}" type="text/javascript">
</script>
<script src="{{ url('assets/plugins/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/plugins/bootstrap-fileinput/themes/fas/theme.js') }}" type="text/javascript"></script>
<script src="{{ url('js/fileinput/locales/' . config('app.locale') . '.js') }}" type="text/javascript"></script>



<script>
    function handleClick(cb) {
        display("Clicked, new value = " + cb.checked);
    }
</script>
@endsection