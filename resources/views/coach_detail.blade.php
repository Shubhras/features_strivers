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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css" />
<section class="page-banner01" style="background-image: url(../assets/images/home/cta-bg.jpg);">
       
    </section>
@section('content')

<div class="main-container">
                        
<div class= "container">

    <div class="col-md-9 col-12">
        <br>
    
    </div>
    <br>
    <div class="col-md-9 page-content">
                    <?php
                    
                    foreach($user as $cat) {
                        
                        
                        ?>
                
						<div class="inner-box default-inner-box" style="width: 100%;">
							<h3 class=""><center> {{ $cat->name }} </center></h3>
                            <h3 class=""><center> Teacher </center></h3>

							
						</div>
                        <br>
						<div class="panel-group"> 
							
							<div class="card card-default">
								<div class="card-header">
								<p style="font-family: Times New Roman;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus magnam eligendi corporis cumque maiores in esse neque optio, iusto consectetur? Fugit libero laborum odit quis vitae, inventore debitis dolor commodi voluptatum accusantium ducimus doloribus error facilis magni aspernatur! Enim quibusdam aliquid inventore dicta! A debitis iusto similique dolorum voluptas, incidunt velit ipsum, unde vitae molestiae laboriosam illo maiores blanditiis aliquam consectetur ratione magnam reprehenderit obcaecati tempora fuga sunt accusantium?</p><p> Dolorum quae, qui atque dolorem nemo voluptates minus explicabo hic sint laudantium, voluptate, quidem velit dolores. Totam itaque culpa quasi, hic voluptas doloribus assumenda harum. Vel corporis magnam blanditiis impedit molestiae?</p>
                            </div>
                            <div class="flex-container">
                                    <div class="box">
                                    <h2><b><center>Coach Detail</center></b></h2>
                                
                                <h4><b> Name => {{ $cat->name }}</b></h4>
                                
                                    <?php if($cat->year_of_experience!=''){?> 
                                        <p><b>{{ $cat->year_of_experience }}            years Experience</b></p>
                                        <?php 
                                    }
                                    else{?>
                                        <p><b>No Experience</b></p>  
                                        
                                    <?php }?>
                                    <?php  

                                    
                                    $slug = json_decode($cat->slug);
                                $ss = array();
                                foreach ($slug as $key => $sub) {
                                    $ss[$key] = $sub;
                                }
                                // print_r($ss['en']);


                                $sub_cat = json_decode($cat->sub_cat);
                                $aaa = array();
                                foreach ($sub_cat as $key => $subc) {
                                    $aaa[$key] = $subc;
                                }

                                    ?>
                                    <p><b>industry=>  {{ $ss['en'] }}</b></p>
                                    <p><b>speciality=>  {{ $aaa['en'] }}</b></p>
                                </div >
                                <br>
                                <div class ="box">
                                <iframe width="500" height="345" src="https://www.youtube.com/embed/xJ3vatsNQDU?autoplay=1&mute=1&loop=1"></iframe>
                                    </div>
                                </div>
                            </div>	
								
									
                                <?php } ?>
                    </div>       
            </div>
            <br>
            <div class="" style="text-align: center;">
            <a href="{{url('/pricing') }}">
            <button type="button" class="btn btn-success btn-lg" >Get Started</button>
            </a>
            </div>
            		        
    </div>                            
							
</div>
@includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.footer1', 'layouts.inc.footer1'])

@endsection()

<style>
    .flex-container {
  display: flex;
  flex-wrap: nowrap;
  background-color: white;
}

.flex-container .box {
  background-color: #f1f1f1;
  width: 50%;
  margin: 10px;
  
  line-height: 20px;
  font-size: 19px;
}
.alert {
    display:none;
}

.card-header > p {
    max-width: 800px;
    text-align: center;
    margin: auto;
}
.mcol-left{
    padding-left: 5px;

}

    </style>