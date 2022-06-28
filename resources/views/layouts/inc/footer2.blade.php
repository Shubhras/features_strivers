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


<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />


<link rel="stylesheet" href="../assets/css/master.css">


<!-- <footer class="footer-1 pd-top-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-3">
                    <aside class="widget">
                        <div class="about-widget">
                            <a href="index.html"><img src="assets/images/logo.png" alt=""></a>
                            <p>
                                Lost the plot Richard you mug cup of tea knackered boot bender.
                            </p>
                            <div class="ab-social">
                                <a class="fac" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="twi" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="you" href="#"><i class="fab fa-youtube"></i></a>
                                <a class="lin" href="#"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div>
                    </aside>
                </div>
                <div class="col-lg-3 col-md-3">
                    <aside class="widget">
                        <h3 class="widget-title">Explore</h3>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Success Story</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Resource Center</a></li>
                            <li><a href="#">Courses</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </aside>
                </div>
                <div class="col-lg-3 col-md-3">
                    <aside class="widget">
                        <h3 class="widget-title">Catecories</h3>
                        <ul>
                            <li><a href="#">All Courses</a></li>
                            <li><a href="#">Storytelling & Voice Over</a></li>
                            <li><a href="#">Digital Marketing</a></li>
                            <li><a href="#">Design & Branding</a></li>
                            <li><a href="#">Nanodegree Plus</a></li>
                            <li><a href="#">Veterans</a></li>
                        </ul>
                    </aside>
                </div>
                <div class="col-lg-2 col-md-3">
                    <aside class="widget">
                        <h3 class="widget-title">Support</h3>
                        <ul>
                            <li><a href="#">Help Center</a></li>
                            <li><a href="#">System Requirements</a></li>
                            <li><a href="#">Register Activation Key</a></li>
                            <li><a href="#">Site Feedback</a></li>
                            <li><a href="#">Documentation</a></li>
                            <li><a href="#">Forums</a></li>
                        </ul>
                    </aside>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="copyright">
                        <p>© 2021 Copyright all Right Reserved Design by <a href="#">Strivre</a></p>
                    </div>
                </div>
            </div>
           
        </div>
</footer> -->

<section style="background: #f7f6fa;">
<footer class="footer-1">
    <div class="container">
        <!-- <div class="row">
                <div class="col-md-12">
                    <div class="cta-wrapper">
                        <img src="../assets/images/home/2.png" alt="">
                        <h3>You can be your own Guiding star with our help!</h3>
                        <a href="join-us.html" class="bisylms-btn">Get Started Now</a>
                    </div>
                </div>
            </div> -->
            <?php 
$index_and_footer_logo = DB::table('logo_header_and_footer_and_images_change')->select('logo_header_and_footer_and_images_change.*')->first();

?>
        <div class="row footer-row-fix">
            <div class="col-lg-4 col-md-375">
                <aside class="widget">
                    <div class="about-widget">
                        <!-- <a href="#"><img src="../assets/images/logo.png" alt=""></a> -->
                        <a href="#"> <img src="{{ url('storage/'.$index_and_footer_logo->picture) }}" alt=""></a>
                        <p>
                            Lost the plot Richard you mug cup of tea knackered boot bender.
                        </p>
                        <div class="ab-social">
                                <a class="fac" href="https://web.facebook.com/Strivre-103594345623153/"><i class="fab fa-facebook-f" style="line-height: 3;"></i></a>
                                <a class="you" href="https://www.instagram.com/strivre_coach/"><i class="fab fa-instagram" style="line-height: 3;"></i></a>
                                <!-- <a class="you" href="#"><i class="fab fa-pinterest-p" style="line-height: 3;"></i></a> -->
                                <a class="lin" href="https://www.linkedin.com/company/strivrecoach/"><i class="fab fa-linkedin-in" style="line-height: 3;"></i></a>
                            </div>
                    </div>
                </aside>
            </div>
            <div class="col-lg-3 col-md-375">
                <!-- <aside class="widget">
                    <h3 class="widget-title">Explore</h3>
                    <ul>
                        <li><a href="{{ url(\App\Helpers\UrlGen::aboutUs()) }}">About Us</a></li>
                        <li><a href="#">Success Story</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Resource Center</a></li>
                        <li><a href="#">Courses</a></li>
                        <li><a href="{{ \App\Helpers\UrlGen::contact() }}">Contact Us</a></li>
                    </ul>
                </aside> -->
                <aside class="widget">
                    <h3 class="widget-title">Explore</h3>
                    <ul>
                        <li><a href="{{ url(\App\Helpers\UrlGen::aboutUs()) }}">About Us</a></li>
                        <?php $id = '0';?>
                         <li><a href="{{ url('coach_list_category_all/'.$id) }}">Categories</a></li>
                        <!-- <li><a href="#">Success Story</a></li> -->
                        <!-- <li><a href="#">Careers</a></li> -->
                        <li><a href="{{url('pricing')}}">Pricing</a></li>
                        <li><a href="{{url('contact')}}">Contact us</a> </li>

                        <li><a href="{{url('all_article')}}">Article</a></li>

                        <li><a href="{{url('page/faq')}}">FAQ</a></li>
                        <!-- <li><a href="{{ \App\Helpers\UrlGen::contact() }}">Contact Us</a></li> -->
                    </ul>
                </aside>
            </div>
            <div class="col-lg-3 col-md-375">
                <aside class="widget">
                    <h3 class="widget-title">Categories</h3>

                    <ul>
                    <?php $id = '0';?>
                    <li><a href="{{ url('coach_list_category_all/'.$id) }}">All Categories</a></li>

                        <?php
                        $data['categories_list_coach'] = DB::table('users')->select('categories.slug', 'categories.id', 'categories.name', 'users.category', 'categories.picture', 'categories.icon_class')->join('categories', 'categories.id', '=', 'users.category')->orderBy('categories.slug', 'asc')->where('categories.parent_id', null)->where('users.user_type_id', 2)->get();



                        $unique = array();
                        $uniques = array();
                        $keyss = array();

                        foreach ($data['categories_list_coach'] as $value) {
                            // print_r($value);die;
                            $unique[$value->category] = $value;
                            $uniques['key'] = $value->category;
                        }

                        $data['uniqueCat'] = array_values($unique);

                        $data['categories_list_coach1'] = array_slice($data['uniqueCat'], 0, 6);


                        // print_r($data['categories_list_coach1']);die;

                        ?>


                        <?php

                        foreach ($data['categories_list_coach1'] as $key => $value) {

                            // print_r($value);die;
                        ?>
                            <!-- <div class="latest-course1 ppt"> -->


                                <?php

                                $name = json_decode($value->name);
                                $ss = array();
                                foreach ($name as $key => $sub) {
                                    $ss[$key] = $sub;
                                }

                                ?>
                                <li>
                                    <a href="{{url('/coach_list_category_all/'.$value->id) }}" id="sub_id_<?= $value->id ?>" value="<?= $value->id ?>">
                                        {{$ss['en']}}
                                    </a>
                                </li>



                            <!-- </div> -->
                        <?php } ?>
                        <!-- <li><a href="#">All Courses</a></li>
                        <li><a href="#">Storytelling & Voice Over</a></li>
                        <li><a href="#">Digital Marketing</a></li>
                        <li><a href="#">Design & Branding</a></li>
                        <li><a href="#">Nanodegree Plus</a></li>
                        <li><a href="#">Veterans</a></li> -->
                    </ul>
                    <!-- <ul>
                        <li><a href="#">All Courses</a></li>
                        <li><a href="#">Storytelling & Voice Over</a></li>
                        <li><a href="#">Digital Marketing</a></li>
                        <li><a href="#">Design & Branding</a></li>
                        <li><a href="#">Nanodegree Plus</a></li>
                        <li><a href="#">Veterans</a></li>
                    </ul> -->
                </aside>
            </div>
            <div class="col-lg-2 col-md-375">
                <aside class="widget">
                    <h3 class="widget-title">Support</h3>
                    <ul>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">System Requirements</a></li>
                        <li><a href="#">Register Activation Key</a></li>
                        <li><a href="#">Site Feedback</a></li>
                        <li><a href="#">Documentation</a></li>
                        <li><a href="#">Forums</a></li>
                    </ul>
                </aside>
            </div>
        </div>
        <!-- Copyrigh -->
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="copyright">
                    <p>© 2021 Copyright all Right Reserved </p>
                </div>
            </div>
        </div>
        <!-- Copyrigh -->
    </div>
</footer>
</section>
<a href="#" id="back-to-top">
    <i class="fal fa-angle-double-up scroll-top-footer"></i>
</a>
<!-- Back To Top -->

<!-- Start Include All JS -->
<style>
    .fa,
    .fab,
    .fad,
    .fal,
    .far,
    .fas {
        -moz-osx-font-smoothing: grayscale;
        -webkit-font-smoothing: antialiased;
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        /* line-height: 3; */
    }

    .fab {
        font-family: "Font Awesome 5 Brands";
    }

    .fab,
    .far {
        font-weight: 400;
    }
</style>

<style>
    .scroll-top-footer {
        line-height: 2 !important;
    }
</style>