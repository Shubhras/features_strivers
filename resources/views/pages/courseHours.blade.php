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

@section('content')
<style>
/* .alert{
    display:none!important;
} */
#amountcalculate{
    min-height : 550px;
}
#wrapper {
    padding-top: 80px !important;
}

.col-xl-6,
.col-md-6 {
    width: 50%;
}

label.subscriptiontype1 {
    text-align: left;
    margin: 7px;
    font-size: 17px;
}

.subscriptiontype {
    background-color: #f6f6f6;
    margin-bottom: 15px;
    border-radius: 5px;
    width: 49%;
    margin-left: 10px;

}
.form-row {
    margin-bottom: 15px;
}

.card{
    border:none;
}
.btn-primary:disabled{
    background-color : #EBEBE4;
    color : #000 !important;
    border-color : #EBEBE4;
}
</style>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
<br>
<div class="container" id ="amountcalculate">

    <?php  
        // $price = $price->price;
        $subscriptionType = json_decode($price->name);
        $price = $price->price;
        // print_r($subscriptionType);die;
        // print_r($userData) ;
        // die;
        // $subscriptionType->en
    ?>
    <div class="row">
        <!-- <div class="col-12"> -->
        <div class="col-md-6 col-lg-6 subscriptiontype">
            <label for="" class="subscriptiontype1">Your Subscription plan is {{$subscriptionType->en}}.</label>
        </div>
        <div class="input-group mb-3 col-md-6 col-xl-6">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Hours</span>
            </div>
            <input type="number" min="1" max="99" class="form-control" placeholder="Select Hours"
                aria-describedby="basic-addon1" id="hours">
        </div>
        <!-- </div>   -->
        <div class="col-6">
            <button class="btn btn-primary btn-lg btn-block" onclick=calculate();>Calculate Amount</button>
        </div>
        <div class="col-6">
            <button type="button" id="payModalClose" class="btn btn-primary btn-lg btn-block" data-toggle="modal"
                data-target="#payModal" onclick = getAmount() disabled>Continue To Pay</button>
        </div>
    </div>
    <br>
    <div class="modal" id="payModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Payment Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <!-- <div class="container"> -->

                    <!-- <h1>Laravel 5 - Stripe Payment Gateway Integration Example <br /> ItSolutionStuff.com</h1> -->

                    <!-- <div class="row"> -->
                        <div class="col-md-12 ">
                            <!-- <div class="panel panel-default credit-card-box"> -->
                                <!-- <div class="panel-heading display-table">
                                    <div class="row display-tr"> -->
                                        <!-- <h3 class="panel-title display-td">Payment Details</h3> -->
                                        <!-- <div class="display-td"> -->
                                            <!-- <img class="img-responsive pull-right"
                                                src="http://i76.imgup.net/accepted_c22e0.png"> -->
                                        <!-- </div> -->
                                    <!-- </div>
                                </div> -->
                                <div class="panel-body">

                                    @if (Session::has('success'))
                                    <div class="alert alert-success text-center">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                        <p>{{ Session::get('success') }}</p>
                                    </div>
                                    @endif

                                    <form role="form" action="{{ route('stripe.post') }}" method="post"
                                        class="require-validation" data-cc-on-file="false"
                                        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                                        @csrf

                                        <div class='form-row '>
                                            <div class='col-xs-12 form-group required'>
                                                <label class='control-label'>Name on Card</label> <input
                                                    class='form-control' size='4' type='text'>
                                            </div>
                                        </div>

                                        <div class='form-row '>
                                            <div class='col-xs-12 form-group card required'>
                                                <label class='control-label'>Card Number</label> <input
                                                    autocomplete='off' class='form-control card-number' size='20'
                                                    type='text'>
                                            </div>
                                        </div>

                                        <div class='form-row row'>
                                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                <label class='control-label'>CVC</label> <input autocomplete='off'
                                                    class='form-control card-cvc' placeholder='ex. 311' size='4'
                                                    type='text'>
                                            </div>
                                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                <label class='control-label'>Expiration Month</label> <input
                                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                                    type='text'>
                                            </div>
                                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                <label class='control-label'>Expiration Year</label> <input
                                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                                    type='text'>
                                            </div>
                                        </div>

                                        <div class='form-row row'>
                                            <div class='col-md-12 error form-group hide'>
                                                <div class='alert-danger alert'>Please correct the errors and try
                                                    again.</div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12">
                                                <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now
                                                $<span id= "payAmount"></span>.</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            <!-- </div> -->
                        </div>
                    <!-- </div> -->

                <!-- </div> -->

                <!-- Modal footer -->
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div> -->

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12" id="totalAmount" style="display: none">
            <div class="alert alert-success alert-dismissible fade show">
                <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button> -->
                The total amount is $<strong id="amount"></strong> .

            </div>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-12" id="rangeWarning" style="display: none">
            <div class="alert alert-warning alert-dismissible fade show">
                <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button> -->
                Hours should not be less than 00 or more than 99.

            </div>
        </div>
    </div><br>
    <!-- <div class="row">
        <div class="col-12" id="calculateAmountWarning" style="display: none">        
            <div class="alert alert-warning alert-dismissible fade show"> -->
                <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button> -->
                <!-- Please Calculate Amount First!</strong> .

            </div>
        </div> -->
    <!-- </div> -->
    <br>





</div>
@endsection

@section('after_scripts')

<script>
var totalamount =0;
function calculate() {
    var hrs = document.getElementById("hours").value;
    var price = <?php echo $price; ?>;
    

    if (hrs > 0 && hrs < 100) {
        totalamount = hrs * price;
        console.log(totalamount);
        document.getElementById('amount').innerHTML = totalamount;
        document.getElementById('rangeWarning').style.display = "none ";
        document.getElementById('totalAmount').style.display = "block ";
        document.getElementById("payModalClose").disabled = false;

    } else {
        document.getElementById('totalAmount').style.display = "none ";
        document.getElementById('rangeWarning').style.display = "block ";
    }

}

function getAmount(){
    if(totalamount == 0){
        document.getElementById('calculateAmountWarning').style.display = "block";
        // alert ('please calculate amount first');
    }
    else{
        
        document.getElementById('payAmount').innerHTML = totalamount;
        console.log(totalamount);
    }
}
</script>

@endsection