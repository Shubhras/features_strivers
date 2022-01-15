@extends('layouts.master')
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Strivre</title>
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
</head>

<body>

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
    </div>
    <!-- Preloader Icon -->

    <!-- Header Start -->
   
    <!-- Header End -->

    <!-- Banner Start -->
    <section class="page-banner01" style="background-image: url(assets/images/home/cta-bg.jpg);">
       
    </section>
    <!-- Banner End -->

    <!-- Course Section Start -->
    <section class="coursepage-section-2">
        <div class="container">
           <center>
                
                    <div class=" col-sm-10  join">
                        <div class="row">
                <div class=" col-sm-6 ">
                    <div class="ab-thumb">
                        <img src="assets/images/edu_1.png" alt="">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="ab-content">
                        <h3>Join us as Coach or Strivre</h3>
                        <a class="bisylms-btn mbtn col-sm-6" onclick="openCity('coaches')" href="{{url('/coach') }}">Coach Sign up</a><br>
                       
						
                            <br>
                            <a  class="bisylms-btn mbtn col-sm-6" onclick="openCity('Strivers')" href="{{url('/Strivers') }}">Strivre Sign up</a >
                                
                                   
                            
                            
                         
                                    </div>
                                    </div>
                                   
                                </div>


                           
                    </div>
                    </center>
                    </div>
                    </div>
                   



                    <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD&disable-funding=card&intent=authorize"></script>

                    <script>
                        // Render the PayPal button into #paypal-button-container
                        paypal.Buttons({
                
                            style: {
                                layout: 'vertical',
                                color:  'gold',
                                shape:  'pill',
                                label:  'pay',
                            }
                
                        }).render('#paypal-button-container');
                    </script>
            
        
    </section>
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

</body>

</html>