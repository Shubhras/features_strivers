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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
                                        $sub_categories = Illuminate\Support\Facades\DB::table('categories')->select('categories.name','categories.id')->orderBy('categories.name','asc')->where('categories.parent_id',$cat->id)->get();
                                        ?>
                                        @foreach($sub_categories as $key => $sub_cat)
                                            <?php if($request_cat_id == $sub_cat->id){?>
                                                <li id="sub_id_<?= $sub_cat->id?>" value="<?= $sub_cat->id?>" class="col-lg-12 col-md-3 col-sm-4 col-6 cat_show_list" style="color:red;">
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
                                                </li>
                                            <?php }else{?>
                                                <li id="sub_id_<?= $sub_cat->id?>" value="<?= $sub_cat->id?>" class="col-lg-12 col-md-3 col-sm-4 col-6 cat_show_list">
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
                                                </li>
                                            <?php } ?>    
                                        @endforeach
                                    </ul>
                                </div>
                                
                                <?php }else {?>
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
                                <?php }?>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>

            <div class="col-lg-8 col-md-3 col-sm-4 col-6" >
                <div class="row" >
                    <div class="col-sm-12">
                        <h3 class="categories_list_by_coach">Coach List </h3>
                    </div>
                </div>
                <?php if(isset($user[0])){ ?>
                    <div class="row" id="coach_list_cat">
                        <?php foreach ($user as $coach_list) {?>
                          
                            <div class="col-sm-4" data-toggle="modal" data-target="#myModal_{{$coach_list->id }}">
                              <a href="#" id="{{$coach_list->id }}">
                                <img src="{{ imgUrl($coach_list->photo, '') }}" class="lazyload img-fluid" style="height: 200px;" alt="{{ $coach_list->name }}">
                                <br>
                                <?php
                                    $name = json_decode($coach_list->slug);
                                    //$sub_cat_id =($sub_cat->id);
                                    $ss = array();
                                    foreach ($name as $key => $sub) {
                                        $ss[$key] = $sub;
                                    }
                                ?>
                                <div>
                                    <h4><b>{{ $coach_list->name }}</b></h4>
                                    <p><b>{{ $ss['en'] }}</b></p>
                                    <?php if($coach_list->year_of_experience!=''){?> 
                                        <p><b>{{ $coach_list->year_of_experience }} years Experience</b></p>
                                        <?php 
                                    }
                                    else{?>
                                        <p><b>No Experience</b></p>  
                                    <?php }?>
                                </div>
                                    </a>
                            </div> 
                            <div class="modal" id="myModal_{{$coach_list->id }}">
                            <div class="modal-dialog">
                            <div class="modal-content" style="margin-top: 172px;">
                            
                                <!-- Modal Header -->
                                <div class="modal-header" id="{{$coach_list->id }}" >
                                </div>
                                
                                <!-- Modal body -->
                                <div class="modal-body">
                                <img src="{{ imgUrl($coach_list->photo, '') }}" class="lazyload img-fluid" style="height: 100px;padding-left: 237px;">
                                
                                    <h4><b><center>{{ $coach_list->name }}</center></b></h4>
                                    <p><b><center>{{ $ss['en'] }}</center></b></p>
                                    <?php if($coach_list->year_of_experience!=''){?> 
                                        <p><b><center>{{ $coach_list->year_of_experience }} years Experience</center></b></p>
                                        <?php 
                                    }
                                    else{?>
                                        <p><b><center>No Experience</center></b></p>  
                                    <?php }?>
                                
                                
                                </div>
                                
                                <!-- Modal footer -->
                                <div class="modal-footer" style="justify-content:center!important">
                                <a href="{{url('/coachall_detail/'.$coach_list->id) }}">
                                
                                <button type="button" class="btn btn-default btn-lg" >Know More</button></a>
                                <a href="{{url('/subscription') }}">
                                <button type="button" class="btn btn-default btn-lg">Get Started</button></a>
                                </div>
                                
                            </div>
                            </div>
                             </div>

                        <?php }?> 
                    </div>
                    
                <?php }
                else{ ?>
                    <div class="row" id="coach_list_cat">
                        <h3 class="coaches-data">Coaches is not available</h3>
                    </div>
                <?php } ?>
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

            <?php
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
<br>
<div class="container{{ $hideOnMobile }}">
    <div class="col-xl-12 content-box layout-section">
    <div class="row row-featured row-featured-category">
			   <h1 class="text-center title-1"><strong style="float: left;">FAQ</strong></h1>
                        <!-- <hr class="center-block small mt-0" style="background-color:white ;"> -->
                                        
					<div class="col-md-12 page-content">
						<div class="inner-box relative">
							<div class="row">
								<div class="col-sm-12 page-content">
										<h3 class="text-center">Frequently Asked Questions</h3>
									<div class="text-content text-start from-wysiwyg">
										<p><b>How do I place an ad?</b></p><p>It's very easy to place an ad: click on the button "Post free Ads" above right.</p><p><b>What does it cost to advertise?</b></p><p>The publication is 100% free throughout the website.</p><p><b>If I post an ad, will I also get more spam e-mails?</b></p><p>Absolutely not because your email address is not visible on the website.</p><p><b>How long will my ad remain on the website?</b></p><p>In general, an ad is automatically deactivated from the website after 3 months. You will receive an email a week before D-Day and another on the day of deactivation. You have the ability to put them online in the following month by logging into your account on the site. After this delay, your ad will be automatically removed permanently from the website.</p><p><b>I sold my item. How do I delete my ad?</b></p><p>Once your product is sold or leased, log in to your account to remove your ad.</p>
								    </div>
							    </div>
						    </div>
					    </div>
			        </div>				
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

<script>
    $(document).ready(function(){
        
        $(document).on('click', 'li[id]', function (e) {

            var categoryID = $(this).val();
            
            if (categoryID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('coach_list_sub') }}/" + categoryID,
                    success: function(res) {
                        if (res) {

                            $('#coach_list_cat').html(res);

                        } else {

                            $('#coach_list_cat').html('<h3 class= "coaches-data">Coaches is not available</h3>' );

                        }
                    }
                });
            } 
        });
        
    });
</script>



