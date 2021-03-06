<?php //include_once("/layouts/master.php"); ?>
<title>Payment </title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<style type="text/css">
.panel-title {
    display: inline;
    font-weight: bold;
}

.display-table {
    display: table;
}

.display-tr {
    display: table-row;
}

.display-td {
    display: table-cell;
    vertical-align: middle;
    width: 61%;
}

.hide {
    display: none;
}
</style>



<div class="container ">

    <div class="row justify-content-center">
        <h1>Stripe Payment Page </h1>
    </div>
    <br>

    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table">
                    <div class="row display-tr">
                        <h3 class="panel-title display-td">Payment Details</h3>
                        <div class="display-td">
                            <!-- <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png"> -->
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <!-- @if (Session::has('success')) -->
                    <!-- <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div> -->
                    <!-- <script>
                        // const myTimeout = setTimeout(goToHomePage, 3000);
                        // // console.log('hello timeout');
                        // function goToHomePage() {
                        //     document.location.href = "/";
                        // }

                        function back() {
                            window.history.forward();
                        }
                        // Force Client to forward to last (current) Page.
                        setTimeout("back()", 0);

                        window.onunload = function() {
                            null
                        };
                        </script> -->
                    <!-- @endif -->

                    <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation"
                        data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                        @csrf
                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-12 col-xl-12 form-group required'>
                                <label class='control-label'>Name on Card</label> <input class='form-control' size='4'
                                    type='text' name="cardHoldername">
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-12 col-xl-12 form-group  required'>
                                <label class='control-label'>Card Number</label> <input autocomplete='off'
                                    class='form-control card-number' size='20' type='text' name="cardNumber">
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label> <input autocomplete='off'
                                    class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'
                                    name="cvcNumber">
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2' type='text'
                                    name="expiryMonth">
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> <input
                                    class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'
                                    name="expiryyear">
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-md-12 error form-group hide'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="price" value={{$price}} id="price">
                        <input type="hidden" name="subscriptionPlan" value={{$subscriptionPlan}} id="subscriptionPlan">
                        <input type="hidden" name="totalHours" value={{$totalHours}} id="totalHours">
                        <input type="hidden" name="email" value="{{$userEmail}}">
                        <?php if(!empty($courseId)){ ?>
                        <input type="hidden" name="courseId" value={{$courseId}} id="courseId">
                            <?php }?>
                            
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-xl-12r">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Pay
                                    Now
                                    ${{$price}}</button>
                            </div>
                        </div>



                    </form>

                    <div class="row">
                        
                            <div class="col-xs-12 col-md-12 col-xl-12r">
                            <a href="pricing">
                                <button class="btn btn-danger btn-lg btn-block" type="submit">Back To Subscriptions</button>
                                </a>
                            </div>
                           
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
// $(document).ready(function() {
//     document.getElementById('price').value=0; 
// });
$(function() {
    // $('#price').val("");
    var $form = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
                'input[type=text]', 'input[type=file]',
                'textarea'
            ].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;
        $errorMessage.addClass('hide');
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault();
            }
        });
        if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
        }
    });

    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
});

// function resetPrice(){
//     document.getElementById('price').value=0; 
// }
</script>
<!-- <script>
fetch('/create-subscription', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify({
    priceId: priceId,
    customerId: customerId,
  }),
})


</script> -->