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

@section('search')
@parent
@endsection

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



                <div class="row">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-4">
                        <a href="{{ \App\Helpers\UrlGen::register() }}" class="nav-link"><button class="btn btn-danger sign_up_button_size">SIGN UP</button></a>
                    </div>
                    <div class="col-sm-4">
                    </div>
                </div>
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

        <div class="row">
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
        </div>
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