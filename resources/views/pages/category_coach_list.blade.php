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
                        <span class="title-3">{{ t('Browse by') }} <span style="font-weight: bold;">{{ ('Coach Details') }}</span></span>
                        <a href="{{ \App\Helpers\UrlGen::sitemap() }}" class="sell-your-item">
                            {{ t('View more') }} <i class="fas fa-bars"></i>
                        </a>
                    </h2>
                </div>
            </div>

            <div class="col-lg-4 col-md-3 col-sm-4 col-6">

                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="categories_list_by_coach">All Categories </h3>
                    </div>
                </div>
                <div class="row">
                    <ul>
                        @foreach($categories as $key => $cat)
                            <li id="cat_id_<?php echo $cat->id?>" class="col-lg-12 col-md-3 col-sm-4 col-6 cat_show_list">
                                <a href="{{url('/coach_list/'.$cat->id) }}">
                                    <h4>
                                        <?php 
                                        $name = json_decode($cat->name);
                                        $ss = array();
                                        foreach ($name as $key => $sub) {
                                            $ss[$key] = $sub;
                                        }
                                        ?>
                                        &nbsp;<span class="text-color"><b>{{ $ss['en'] }}</b></span>
                                        
                                    </h4>
                                </a>
                                <?php if($request_cat_id == $cat->id){?> 
                                <div>
                                    <ul id="subcategory_data_cat_id_<?php echo $cat->id?>">
                                        <?php 
                                        $sub_categories = DB::table('categories')->select('categories.name','categories.id')->orderBy('categories.name','asc')->where('categories.parent_id',$cat->id)->get();
                                        ?>
                                        @foreach($sub_categories as $key => $sub_cat)
                                            <li class="col-lg-12 col-md-3 col-sm-4 col-6 cat_show_list">
                                                <a href="{{url('/coach_list/'.$sub_cat->id) }}">
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
                                </div>
                                <?php }else {?>
                                    <ul id="subcategory_data_cat_id_<?php echo $cat->id?>" style="display:none;">
                                        <?php 
                                        $sub_categories = DB::table('categories')->select('categories.name','categories.id')->orderBy('categories.name','asc')->where('categories.parent_id',$cat->id)->get();
                                        ?>
                                        @foreach($sub_categories as $key => $sub_cat)
                                            <li class="col-lg-12 col-md-3 col-sm-4 col-6 cat_show_list">
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
                                    <?php }?>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>

            <div class="col-lg-8 col-md-3 col-sm-4 col-6">

                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="categories_list_by_coach">Coach List </h3>
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($user as $coach_list) {
                    ?>
                        <div class="col-sm-4" >
                            <img src="{{ imgUrl($coach_list->photo, '') }}" class="lazyload img-fluid" style="height: 200px;" alt="{{ $coach_list->name }}">
                            <br>
                            <h3><b>{{ $coach_list->name }}</b></h3>
                        </div>

                    <?php  } ?>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    $(document).ready(function(){   
        $(document).on('click', 'li[id]', function (e) {
            var requested_to = $(this).attr('id');
            $("#subcategory_data_"+  requested_to).show();
        });
    });

</script>



