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
@extends('layouts.master_new')

@section('search')
@parent
@endsection


<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" rel="stylesheet">


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
<br>
<?php
$hideOnMobile = '';
if (isset($categoriesOptions, $categoriesOptions['hide_on_mobile']) and $categoriesOptions['hide_on_mobile'] == '1') {
    $hideOnMobile = ' hidden-sm';
}
?>
@includeFirst([config('larapen.core.customizedViewPath') . 'home.inc.spacer', 'home.inc.spacer'], ['hideOnMobile' => $hideOnMobile])
<div class="container{{ $hideOnMobile }}">
    <div class="col-xl-12 content-box layout-section coach_details">
        <div class="row row-featured row-featured-category">
            <div class="col-xl-12 box-title no-border">
                <div class="inner">
                    <h2>
                        <span class="title-3">{{ t('Browse by') }} <span style="font-weight: bold;">{{ ('Coache Details') }}</span></span>
                        <a href="{{ \App\Helpers\UrlGen::sitemap() }}" class="sell-your-item">
                            {{ t('View more') }} <i class="fas fa-bars"></i>
                        </a>
                    </h2>
                </div>
            </div>

            <div class="col-lg-6 col-md-3 col-sm-4 col-6">

                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="categories_list_by_coach">All Categories </h3>
                    </div>
                </div>
                <div class="row">




                    @foreach($categories as $key => $cat)
                    <div class="col-lg-12 col-md-3 col-sm-4 col-6 cat_show_list">
                        <a href="{{ \App\Helpers\UrlGen::category($cat) }}">

                            <h4>
                                <!-- {{ $cat->name }}
                                @if (config('settings.listing.count_categories_posts'))
                                &nbsp;({{ $countPostsByCat->get($cat->id)->total ?? 0 }})
                                @endif -->

                                <?php
                                $slug = json_decode($cat->name);
                                $ss = array();
                                foreach ($slug as $key => $sub) {
                                    $ss[$key] = $sub;
                                }
                                print_r($ss['en']);
                                ?>
                            </h4>
                        </a>
                        <!-- @foreach($sub_categories as $sub_cat)
                        <div class="col-lg-12 col-md-3 col-sm-4 col-6 cat_show_list">
                        <a href="{{ \App\Helpers\UrlGen::category($sub_cat) }}">

                            <h4>
                                {{ $sub_cat->slug }}
                                @if (config('settings.listing.count_categories_posts'))
                                &nbsp;({{ $countPostsByCat->get($sub_cat->id)->total ?? 0 }})
                                @endif
                            </h4>
                        </a>
                        </div>

                        @endforeach -->
                    </div>
                    @endforeach
                </div>

            </div>

            <div class="col-lg-6 col-md-3 col-sm-4 col-6">

                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="categories_list_by_coach">Coach Details </h3>
                    </div>
                </div>

                <img src="{{ imgUrl($user->photo, '') }}" class="lazyload img-fluid images_height" alt="{{ $user->name }}">

                <div class="row coach_detail_name">

                    <div class="col-sm-12" style="text-align: center;">
                        <b>{{ $user->name }}</b>

                    </div>
                    <?php if (!empty($user->slug)) { ?>
                        <div class="col-sm-12" style="font-size: 20px;">
                            <b>Total of experience {{ $user->year_of_experience }} years</b>
                        </div>
                    <?php } ?>
                </div>

                <br>
                <?php if (!empty($user->slug)) { ?>
                    <div class="row">
                        <div class="col-sm-1">

                        </div>
                        <div class="col-sm-11" style="font-size: 20px; color:white;">
                            <b>Industries: -
                                <?php
                                $slug = json_decode($user->slug);
                                $ss = array();
                                foreach ($slug as $key => $sub) {
                                    $ss[$key] = $sub;
                                }
                                print_r($ss['en']);
                                ?>
                                <!-- {{ $user->slug }}  -->
                                connection
                            </b>
                        </div>
                    </div>
                <?php } ?>


                <div class="row">
                    <div class="col-sm-1">

                    </div>
                    <div class="col-sm-11" style="font-size: 20px; color:white;">
                        <b>Specility :- </b>



                    </div>

                </div>


            <?php 

            if($login_id != ""){

            ?>
                <div class="row">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-danger launch sign_up_button_size" data-toggle="modal" id="myBtn" >Subscription</button>
                    </div>
                    <div class="col-sm-4">
                    </div>
                    
                </div>


    <div class="modal" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog card">
        <div class="modal-content">
            <div class="modal-body ">
            <!-- <div class="container py-5"> -->
    <!-- For demo purpose -->
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto text-center">
            <h3 class="display-6">Striver Payments</h3>
        </div>
    </div> <!-- End -->

    <div class="row">
        <!-- <div class="col-lg-6 mx-auto"> -->
            <div class="card">
                <div class="card-header">
                    <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                        <!-- Credit card form tabs -->
                        <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                            <li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link active " onclick="toggleVisibility('credit-card');"> <i class="fas fa-credit-card mr-2"></i> Credit Card </a> </li>
                            <li class="nav-item"> <a data-toggle="pill" href="#paypal" class="nav-link " onclick="toggleVisibility('paypal');"> <i class="fab fa-paypal mr-2"></i> Paypal </a> </li>
                            <li class="nav-item"> <a data-toggle="pill" href="#net-banking" class="nav-link " onclick="toggleVisibility('net-banking');"> <i class="fas fa-mobile-alt mr-2"></i> Net Banking </a> </li>
                        </ul>
                    </div> <!-- End -->
                    <!-- Credit card form content -->
                    <div class="tab-content">
                        <!-- credit card info-->
                        <div id="credit-card" class="tab-pane fade show active pt-3">
                            <form role="form" method="post" action="{{ url('/account/payment_subscription_planss') }}" id="payment_id">

                            {!! csrf_field() !!}
                            <!-- onsubmit="event.preventDefault()"   -->
                            <input type="hidden" value="{{ $user->id }}" name="user_id" id="user_id">
                            <input type="hidden" value="{{$login_id }}" name="student_id" id="student_id">
                            <input type="hidden" value="{{$login_id }}" name="course_id" id="course_id">
                            <input type="hidden" value="2" name="subscription_id" id="subscription_id">
                            <input type="hidden" value="500" name="net_payment" id="net_payment">
                            <input type="hidden" value="9000" name="fee_deducte" id="fee_deducte">


                            

                                <div class="form-group"> <label for="username">
                                        <h6>Card Owner</h6>
                                    </label> <input type="text" name="username" placeholder="Card Owner Name" required class="form-control "> </div>
                                <div class="form-group"> <label for="cardNumber">
                                        <h6>Card number</h6>
                                    </label>
                                    <div class="input-group"> <input type="text" name="cardNumber" placeholder="Valid card number" class="form-control " required>
                                        <div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group"> <label><span class="hidden-xs">
                                                    <h6>Expiration Date</h6>
                                                </span></label>
                                            <div class="input-group"> <input type="number" placeholder="MM" name="" class="form-control" required> <input type="number" placeholder="YY" name="" class="form-control" required> </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                            </label> <input type="text" required class="form-control"> </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                     <button type="submit" class="subscribe btn btn-primary btn-block shadow-sm"> Confirm Payment </button>

                                     <button type="button" class="btn btn-close close" data-dismiss="modal" aria-label="Close" style="background-color: #0d6efd;"><span aria-hidden="true" ></span></button>
                            </form>
                        </div>
                    </div> <!-- End -->
                    <!-- Paypal info -->
                    <div id="paypal" class="tab-pane fade show pt-3">
                        <h6 class="pb-2">Select your paypal account type</h6>
                        <div class="form-group "> <label class="radio-inline"> <input type="radio" name="optradio" checked> Domestic </label> <label class="radio-inline"> <input type="radio" name="optradio" class="ml-5">International </label></div>
                        <p> <button type="button" class="btn btn-primary "><i class="fab fa-paypal mr-2"></i> Log into my Paypal</button> </p>
                        <p class="text-muted"> Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order. </p>
                    </div> <!-- End -->
                    <!-- bank transfer info -->
                    <div id="net-banking" class="tab-pane fade show pt-3">
                        <div class="form-group "> <label for="Select Your Bank">
                                <h6>Select your Bank</h6>
                            </label> <select class="form-control" id="ccmonth">
                                <option value="" selected disabled>--Please select your Bank--</option>
                                <option>Bank 1</option>
                                <option>Bank 2</option>
                                <option>Bank 3</option>
                                <option>Bank 4</option>
                                <option>Bank 5</option>
                                <option>Bank 6</option>
                                <option>Bank 7</option>
                                <option>Bank 8</option>
                                <option>Bank 9</option>
                                <option>Bank 10</option>
                            </select> </div>
                        <div class="form-group">
                            <p> <button type="button" class="btn btn-primary "><i class="fas fa-mobile-alt mr-2"></i> Proceed Payment</button> </p>
                        </div>
                        <p class="text-muted">Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order. </p>
                    </div> <!-- End -->
                    <!-- End -->
                </div>
            <!-- </div> -->
        <!-- </div> -->
    </div>
            </div>
        </div>
    </div>
</div>
    </div>
            <?php } else{ ?>

                <div class="row">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-4">
                        <a href="{{ \App\Helpers\UrlGen::register() }}" class="nav-link"><button class="btn btn-danger sign_up_button_size">SIGN UP</button></a>
                    </div>
                    <div class="col-sm-4">
                    </div>
                </div>
            <?php }?>

                <?php if (!empty($user->price)) { ?>
                    <div class="row">
                        
                        <div class="col-sm-12 subscription_plan_coach">

                            <p>Starting at {{ $user->currency_code }} {{ $user->price }} hours
                                <?php

                                $subcription_plan = json_decode($user->subscription_name);
                                $ss = array();

                                foreach ($subcription_plan as $key => $sub) {
                                    $ss[$key] = $sub;
                                }
                                print_r($ss['en']);
                                ?>
                                (billed annually) </p>
                        </div> 
                    </div>
                <?php } ?>
                <br>
            </div>
            <br>

        </div>
        

        <!-- <div class="row coach_class_schedule">
                <div class="col-sm-12">
                        <h2 style="text-align: center; font-weight:800;">Coach Schedule</h2>
                </div>
                <div class="row">
                    <div class="col-sm-6 f-coach">
                                <h3>Class Info</h3>
                                <ul class="f-coach" style="float: left;">
                                    <li><i class="fas fa-star"></i>Class one</li>
                                    <li><i class="fas fa-star"></i>Class Two</li>
                                    <li><i class="fas fa-star"></i>Class Three</li>
                                    <li><i class="fas fa-star"></i>Class Four</li>
                                    <li><i class="fas fa-star"></i>Class Five</li>
                                    <li><i class="fas fa-star"></i>Class   Six</li>
                                    <li><i class="fas fa-star"></i>Class Seven</li>
                                    <li><i class="fas fa-star"></i>Class Eight</li>
                                    <li><i class="fas fa-star"></i>Class Nine</li>
                                    <li><i class="fas fa-star"></i>Class Ten</li>
                                </ul>
                    </div>

                    <div class="col-sm-6 f-coach">
                               <h3> Video Section </h3>
                    </div>
                </div>
        </div> -->
    </div>
</div>

<br>
<!-- coaches  -->







<div class="container{{ $hideOnMobile }}">
    <div class="col-xl-12 content-box layout-section">
        <div class="row row-featured row-featured-category">
            <div class="col-xl-12 box-title no-border">
                <div class="inner">
                    <h2>
                        <span class="title-3"> <span style="font-weight: bold;">{{ t('related_coaches') }}</span></span>
                        <a href="{{ \App\Helpers\UrlGen::sitemap() }}" class="sell-your-item">
                            {{ t('View more') }} <i class="fas fa-bars"></i>
                        </a>
                    </h2>
                </div>
            </div>

            <?php //print_r($related_coaches);die;
            ?>
            @if (isset($related_coaches) and $related_coaches->count() > 0)


            @foreach($related_coaches as $key => $coachs)

            @if($coachs->id !=$user->id )

            <div class="col-lg-3 col-md-3 col-sm-4 col-6 f-coach">
                <a href="{{url('/coach_details/'.$coachs->id) }}">
                    <img src="{{ imgUrl($coachs->photo, '') }}" class="lazyload img-fluid" alt="{{ $coachs->name }}">

                    <h5 style="margin-top: -76px;font-size: xx-large;color: white; margin-bottom: 47px;">
                        <b>{{ $coachs->name }}</b>

                    </h5>

                </a>

            </div>
            @endif

            @endforeach

            @endif

        </div>
    </div>
</div>

<style>
    .modal-body {
    background-color: #fff;
    border-color: #fff
}

.rounded {
    border-radius: 1rem
}

.nav-pills .nav-link {
    color: #555
}

.nav-pills .nav-link.active {
    color: white
}

input[type="radio"] {
    margin-right: 5px
}

.bold {
    font-weight: bold
}
</style>
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


$(function() {
$('[data-toggle="tooltip"]').tooltip()
})
</script>

<script>
    var divs = ["credit-card", "paypal", "net-banking"];
var visibleDivId = null;
function toggleVisibility(divId) {
  if(visibleDivId === divId) {
    //visibleDivId = null;
  } else {
    visibleDivId = divId;
  }
  hideNonVisibleDivs();
}
function hideNonVisibleDivs() {
  var i, divId, div;
  for(i = 0; i < divs.length; i++) {
    divId = divs[i];
    div = document.getElementById(divId);
    if(visibleDivId === divId) {
      div.style.display = "block";
    } else {
      div.style.display = "none";
    }
  }
}
</script>

<script>
	     // when category dropdown changes
		
				$(document).ready(function () {
					
			$("form").submit(function (event) {
				var formData = {
					user_id: $("#user_id").val(),
					student_id: $("#student_id").val(),
                    subscription_id: $("#subscription_id").val(),
					course_id: $("#course_id").val(),
                    net_payment: $("#net_payment").val(),
                    fee_deducte: $("#fee_deducte").val(),
                   
				};
            console.log(formData);
				$.ajax({
				type: "POST",
				url: "{{ url('account/payment_subscription_planss') }}",
				data: formData,
				dataType: "json",
				encode: true,
				}).done(function (data) {
				console.log(data);
				});

				event.preventDefault();
			});
			});

     </script>