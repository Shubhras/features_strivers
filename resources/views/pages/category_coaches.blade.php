
@extends('layouts.master')
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Strivre</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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


    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />


    <link rel="stylesheet" href="../assets/css/master.css">

    <!-- End Include All CSS -->

    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="../assets/images/favicon.png">
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
        </div>
    </div> -->

    
    <!-- Preloader Icon -->

    <!-- Header Start -->
   
    <!-- Header End -->

    <!-- Hero Banner Start -->
    <section class="page-banner" style="background-image: url(../assets/images/home/cta-bg.jpg);">
        <!-- shape -->
       
        <div class="container">
            <div class="row height d-flex justify-content-center align-items-center">
                <div class="col-md-8">

                    <div class="input-group">
                        <div class="form-outline search-box-fix1">
                          <input type="search" id="form1" class="form-control search-box-for-main search-box-font" placeholder=" Search for Coach, Industry, Location and more..."/>
                          
                        </div>
                        <button type="button" class="btn btn-primary btn_class_coaches search-box-font">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                      <!-- <a href="#" class="bisylms-btn btn_class_coaches">Get Started?</a> -->
                    <!-- <div class="search"> <i class="fa fa-search"></i> <input type="text" class="form-control" placeholder="Search for Coach, Industry, Location and more..."> <button class="btn btn-primary">Get Started</button> </div> -->
                </div>
            </div>
        </div>

        <!-- shape -->

       
    </section>
    <!-- Banner End -->

    <div class="elementor-widget-container">
        <div class="main-section">
            <div class="container">
                <h2>
                    <h2 class="sec-title">
                        Project Management

                    </h2>
                </h2>
                <div class="row">
                    <div class="col-lg-3 col-sm-4">

                        <ul style="list-style: none;">

                        @foreach($categories as $key => $cat)

                            <li class="subject-title-name" id="cat_id_<?php echo $cat->id?>">

                            <a href="{{url('/coach_list_category_all/'.$cat->id) }}">
                                   
                                        <?php 
                                        $name = json_decode($cat->name);
                                        $ss = array();
                                        foreach ($name as $key => $sub) {
                                            $ss[$key] = $sub;
                                        }
                                        ?>
                                        <!-- &nbsp;<span class="text-color"><b>{{ $ss['en'] }}</b></span> -->
                                        
                                   
                                </a>
                                {{ $ss['en'] }}

                                <?php 
                                
                                // if($request_cat_id == $cat->id){
                                    ?>
                                    
                                    <!-- <div>
                                        <ul id="subcategory_data_cat_id_<?php echo $cat->id?>">
                                            <?php 
                                            $sub_categories = Illuminate\Support\Facades\DB::table('categories')->select('categories.name','categories.id')->orderBy('categories.name','asc')->where('categories.parent_id',$cat->id)->get();
                                            ?>
                                            @foreach($sub_categories as $key => $sub_cat)
                                                <?php //if($request_cat_id == $sub_cat->id){?>
                                                    <li id="sub_id_<?= $sub_cat->id?>" value="<?= $sub_cat->id?>" class="col-lg-12 col-md-3 col-sm-4 col-6 cat_show_list" style="color:red;">
                                                        <h4>
                                                            <?php
    
                                                            // $name = json_decode($sub_cat->name);
                                                            // $sub_cat_id =($sub_cat->id);
                                                            // $ss = array();
                                                            // foreach ($name as $key => $sub) {
                                                            //     $ss[$key] = $sub;
                                                            // }
                                                            ?>&nbsp;
                                                            <span class="text-color">{{ $ss['en'] }}</span>
                                                            
                                                        </h4>
                                                    </li>
                                                <?php //}else{?>
                                                    <li id="sub_id_<?= $sub_cat->id?>" value="<?= $sub_cat->id?>" class="col-lg-12 col-md-3 col-sm-4 col-6 cat_show_list">
                                                        <h4>
                                                            <?php
    
                                                            // $name = json_decode($sub_cat->name);
                                                            // $sub_cat_id =($sub_cat->id);
                                                            // $ss = array();
                                                            // foreach ($name as $key => $sub) {
                                                            //     $ss[$key] = $sub;
                                                            // }
                                                            ?>&nbsp;
                                                            <span class="text-color">{{ $ss['en'] }}</span>
                                                            
                                                        </h4>
                                                    </li>
                                                <?php //} ?>    
                                            @endforeach
                                        </ul>
                                    </div> -->
                                    
                                    <?php // }else {?>
                                        <ul id="subcategory_data_cat_id_<?php echo $cat->id?>" style="display:none;">
                                            <?php 
                                            $sub_categories = Illuminate\Support\Facades\DB::table('categories')->select('categories.name','categories.id')->orderBy('categories.name','asc')->where('categories.parent_id',$cat->id)->get();
                                            ?>
                                            @foreach($sub_categories as $key => $sub_cat)
                                                <li id="sub_id_<?= $sub_cat->id?>" value="<?= $sub_cat->id?>" class="col-lg-12 col-md-3 col-sm-4 col-6 cat_show_list">
                                                    <a href="{{url('/coach_list/'.$cat->id) }}">
                                                        <h4>
                                                            <?php
    
                                                            $name = json_decode($sub_cat->name);
                                                            $sub_cat_id =($sub_cat->id);
                                                            $ss = array();
                                                            foreach ($name as $key => $sub) {
                                                                $ss[$key] = $sub;
                                                            }
                                                            ?>&nbsp;
                                                            <span class="text-color">{{ $ss['en'] }}</span>
                                                        </h4>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    <?php //}?>
                                </li>

                           

                            @endforeach
                        </ul>

                    </div>

                    <div class="col-lg-9    ">

                        <div class="row">


                        <?php foreach ($my_coaches as $coach_list) { ?>


                            <div class="col-lg-3 col-md-6">
                                <div class="teacher-item">
                                    <div class="teacher-thumb coach-img-wrapper">

                                    <img src="{{ imgUrl($coach_list->photo, '') }}" class="lazyload img-fluid" alt="{{ $coach_list->name }}">

                                        <!-- <img src="assets/images/home/f2.jpg" alt="Dianne Ameter"> -->
                                        <div class="teacher-social">
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-facebook-f"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-twitter"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-pinterest-p"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-vimeo-v"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="teacher-meta">

                                        <!-- Large modal -->
                                        <a type="button" href="#" data-toggle="modal" data-target=".bd-example-modal-lg">
                                            <!-- <h5>Dianne Ameter</h5> -->
                                            <h5>
                                            {{ $coach_list->name }}
                                            </h5>
                                        </a>

                                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content p-5">
                                                    <img class="img-coches-main" width="15%" src="assets/images/home/teacher3.jpg" alt="">

                                                    <h3 class=" text-center mt-5">Jimmy Chin</h3>
                                                    <h4 class=" text-center">

                                                        Teaches Adventure Photography

                                                    </h4>

                                                    <p class=" text-center">
                                                        National Geographic photographer teaches his techniques for planning, capturing, and editing breathtaking photos.



                                                    </p>

                                                    <h5 class="coches-description text-center mt-5">Jimmy Chin has built his career taking photos at the top of the world, earning him the cover of National Geographic and multiple awards. Now he’s taking you on location to teach you techniques for capturing
                                                        breathtaking shots. In his photography class, learn different creative approaches for commercial shoots, editorial spreads, and passion projects. Gather the gear—and the perspective—to bring your
                                                        photography to new heights.</h5>
                                                    <div class="row center-button-modal">

                                                        <div class="col-lg-2">
                                                            <a href="coach-details.html" class="bisylms-btn">Know more</a>


                                                        </div>
                                                        <div class="col-lg-2">
                                                            <a href="strivre-sign-up.html" class="bisylms-btn">Get Started</a>


                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                        <p>Illustrator
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <?php } ?>
                            <!-- <div class="col-lg-3 col-md-6">
                                <div class="teacher-item">
                                    <div class="teacher-thumb coach-img-wrapper">
                                        <img src="assets/images/home/f1.jpg">
                                        <div class="teacher-social">
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-facebook-f"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-twitter"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-pinterest-p"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-vimeo-v"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="teacher-meta">
                                        <h5>
                                            Hugh Saturation
                                        </h5>
                                        <p>Photographer
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="teacher-item">
                                    <div class="teacher-thumb coach-img-wrapper">
                                        <img src="assets/images/home/f3.jpg" alt="Dianne Ameter">
                                        <div class="teacher-social">
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-facebook-f"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-twitter"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-pinterest-p"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-vimeo-v"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="teacher-meta">
                                        <h5>
                                            Dianne Ameter
                                        </h5>
                                        <p>Illustrator
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="teacher-item">
                                    <div class="teacher-thumb coach-img-wrapper">
                                        <img src="assets/images/home/f1.jpg" alt="Hugh Saturation">
                                        <div class="teacher-social">
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-facebook-f"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-twitter"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-pinterest-p"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-vimeo-v"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="teacher-meta">
                                        <h5>
                                            Hugh Saturation
                                        </h5>
                                        <p>Photographer
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="teacher-item">
                                    <div class="teacher-thumb coach-img-wrapper">
                                        <img src="assets/images/home/f2.jpg" alt="Jim Séchen">
                                        <div class="teacher-social">
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-facebook-f"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-twitter"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-pinterest-p"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-vimeo-v"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="teacher-meta">
                                        <h5>
                                            Jim Séchen
                                        </h5>
                                        <p>Stylist &amp; Author
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="teacher-item">
                                    <div class="teacher-thumb coach-img-wrapper">
                                        <img src="assets/images/home/f1.jpg" alt="Eric Widget">
                                        <div class="teacher-social">
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-facebook-f"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-twitter"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-pinterest-p"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-vimeo-v"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="teacher-meta">
                                        <h5>
                                            Eric Widget
                                        </h5>
                                        <p>Designer
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="teacher-item">
                                    <div class="teacher-thumb coach-img-wrapper">
                                        <img src="assets/images/home/f2.jpg" alt="Jim Séchen">
                                        <div class="teacher-social">
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-facebook-f"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-twitter"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-pinterest-p"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-vimeo-v"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="teacher-meta">
                                        <h5>
                                            Jim Séchen
                                        </h5>
                                        <p>Stylist &amp; Author
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="teacher-item">
                                    <div class="teacher-thumb coach-img-wrapper">
                                        <img src="assets/images/home/f3.jpg" alt="Eric Widget">
                                        <div class="teacher-social">
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-facebook-f"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-twitter"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-pinterest-p"></i>
                                            </a>
                                            <a href="#">
                                                <i aria-hidden="true" class="fab fa-vimeo-v"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="teacher-meta">
                                        <h5>
                                            Eric Widget
                                        </h5>
                                        <p>Designer
                                        </p>
                                    </div>
                                </div>
                            </div> -->

                        </div>


                    </div>


                </div>
            </div>
            <center>
                <a class="bisylms-btn" href="#">Explore Top Course </a>
            </center>
        </div>
        
    
    </div>




    <div class="main-section mt-120">
        <div class="container">

            <h2 class="sec-title">
                Suggested Coaches

            </h2>

            <div class="row">


            <?php foreach ($suggested_coaches as $coach_list) { ?>

                <div class="col-lg-3 col-md-6">
                    <div class="teacher-item">
                        <div class="teacher-thumb coach-img-wrapper">

                            <!-- <img src="assets/images/home/f1.jpg" alt="Jim Séchen"> -->

                            <img src="{{ imgUrl($coach_list->photo, '') }}" alt="Jim Séchen">

                            <div class="teacher-social">
                                <a href="#">
                                    <i aria-hidden="true" class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#">
                                    <i aria-hidden="true" class="fab fa-twitter"></i>
                                </a>
                                <a href="#">
                                    <i aria-hidden="true" class="fab fa-pinterest-p"></i>
                                </a>
                                <a href="#">
                                    <i aria-hidden="true" class="fab fa-vimeo-v"></i>
                                </a>
                            </div>
                        </div>
                        <div class="teacher-meta">
                            <h5 style="font-weight: 700;">
                            {{ $coach_list->name }}
                            </h5>
                            <p>Stylist &amp; Author
                            </p>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
            </div>
        </div>
    </div>






    <br><br>


    <br><br>


    <br><br>

    <br><br>

    <br><br>

    




    <!-- Footer Section Start -->
    
    <!-- Footer Section End -->



    @includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.footer', 'layouts.inc.footer'])

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