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
#wrapper {
    padding-top: 80px !important;
}
.col-xl-6, .col-md-6 {
    width : 50% ;
}
label.subscriptiontype {
    text-align: left;
    margin: 7px;
    font-size: 17px;
}
.raj{
    background-color: #f6f6f6;
    margin-bottom: 15px;
    border-radius: 5px;
    width: 49%;
    margin-left: 10px;
}
</style>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
<br>
<div class="container">

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
        <div class="col-md-6 col-lg-6 raj">
            <label for="" class="subscriptiontype">Your Subscription Type is {{$subscriptionType->en}}</label>
        </div>
        <div class="input-group mb-3 col-md-6 col-xl-6">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Hours</span>
            </div>
            <input type="number" min="1" max="99" class="form-control" placeholder="Select Hours"
                aria-describedby="basic-addon1" id="hours">
        </div>
        <!-- </div>   -->
        <div class="col-12">
            <button class ="btn btn-primary btn-lg btn-block" onclick = calculate();>Calculate Amount</button>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-12" id="totalAmount" style ="display: none">
            <div class="alert alert-success alert-dismissible fade show"  >
                <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button> -->
                The total amount is $<strong id="amount"></strong> .
                
            </div>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-12" id="rangeWarning" style ="display: none">
            <div class="alert alert-success alert-dismissible fade show"  >
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                Hours should not be less than 00 or more than 99.
                
            </div>
        </div>
    </div><br>
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn btn-primary btn-lg btn-block">Continue To Pay</button>
        </div>
    </div>
    <br>
    




</div>
@endsection

@section('after_scripts')

<script>
    function calculate(){
        var hrs = document.getElementById("hours").value;
        var price = <?php echo $price; ?>

        if( hrs > 0 && hrs < 100){
            totalamount = hrs * price;
            console.log(totalamount);
            document.getElementById('amount').innerHTML = totalamount;
            document.getElementById('rangeWarning').style.display = "none ";
            document.getElementById('totalAmount').style.display = "block ";
            
        }
        else{
            document.getElementById('totalAmount').style.display = "none ";
            document.getElementById('rangeWarning').style.display = "block ";
        }

    }
</script>

@endsection