@extends('layouts.master')

@section('content')
<style>
/* .alert{
    display:none!important;
} */
#wrapper {
    padding-top: 80px !important;
}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<br>
<div class="container">
    
    <div class="row">
        <div class="input-group mb-3 col-md-6 col-xl-6">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Hours</span>
            </div>
            <input type="number" min="1" max="24" class="form-control" placeholder="Select Hours"
                aria-describedby="basic-addon1" id="hours">
        </div>
        <div class="col-xl-6 col-md-6">
            <button class ="btn btn-primary" onclick = calculate();>Calculate Amount</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12" id="totalAmount" style ="display: none">
            <div class="alert alert-success alert-dismissible fade show"  >
                <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button> -->
                The total amount is $<strong id="amount"></strong> .
                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12" id="rangeWarning" style ="display: none">
            <div class="alert alert-success alert-dismissible fade show"  >
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                Hours should not be less than zero or more than 25.
                
            </div>
        </div>
    </div>




</div>
@endsection

<script>
    function calculate(){
        var hrs = document.getElementById("hours").value;

        if(hrs > 0 && hrs < 25){
            totalamount = hrs * 7.50;
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