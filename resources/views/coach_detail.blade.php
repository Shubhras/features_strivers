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





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css" />

<section class="page-banner01" style="background-image: url(../assets/images/home/cta-bg.jpg);">

</section>
@extends('layouts.master_new')
@section('content')
@includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'])


<section style="background-color: white;">
	<div class="main-container">
		<div class="container">

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




@includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.footer1', 'layouts.inc.footer1'])
<!-- /.main-container -->

<a href="#" id="back-to-top">
        <i class="fal fa-angle-double-up"></i>
    </a>
    <!-- Back To Top -->

    <!-- Start Include All JS -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.appear.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/slick.js"></script>
    <script src="../assets/js/jquery.nice-select.min.js"></script>
    <script src="../assets/js/swiper-bundle.min.js"></script>
    <script src="../assets/js/TweenMax.min.js"></script>
    <script src="../assets/js/lightcase.js"></script>
    <script src="../assets/js/jquery.plugin.min.js"></script>
    <script src="../assets/js/jquery.countdown.min.js"></script>
    <script src="../assets/js/jquery.easing.1.3.js"></script>
    <script src="../assets/js/jquery.shuffle.min.js"></script>

    <script src="../assets/js/theme.js"></script>

@endsection

@section('after_styles')
<link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet">
@if (config('lang.direction') == 'rtl')
<link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet">
@endif
<style>
	.krajee-default.file-preview-frame:hover:not(.file-preview-error) {
		box-shadow: 0 0 5px 0 #666666;
	}

	.file-loading:before {
		content: " {{ t('Loading') }}...";
	}
</style>
<style>
	/* Avatar Upload */
	.photo-field {
		display: inline-block;
		vertical-align: middle;
	}

	.photo-field .krajee-default.file-preview-frame,
	.photo-field .krajee-default.file-preview-frame:hover {
		margin: 0;
		padding: 0;
		border: none;
		box-shadow: none;
		text-align: center;
	}

	.photo-field .file-input {
		display: table-cell;
		width: 150px;
	}

	.photo-field .krajee-default.file-preview-frame .kv-file-content {
		width: 150px;
		height: 160px;
	}

	.kv-reqd {
		color: red;
		font-family: monospace;
		font-weight: normal;
	}

	.file-preview {
		padding: 2px;
	}

	.file-drop-zone {
		margin: 2px;
		min-height: 100px;
	}

	.file-drop-zone .file-preview-thumbnails {
		cursor: pointer;
	}

	.krajee-default.file-preview-frame .file-thumbnail-footer {
		height: 30px;
	}

	/* Allow clickable uploaded photos (Not possible) */
	.file-drop-zone {
		padding: 20px;
	}

	.file-drop-zone .kv-file-content {
		padding: 0
	}
</style>


@endsection

@section('after_scripts')
<script src="{{ url('../assets/plugins/bootstrap-fileinput/js/plugins/sortable.min.js') }}" type="text/javascript"></script>
<script src="{{ url('../assets/plugins/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
<script src="{{ url('../assets/plugins/bootstrap-fileinput/themes/fas/theme.js') }}" type="text/javascript"></script>
<script src="{{ url('js/fileinput/locales/' . config('app.locale') . '.js') }}" type="text/javascript"></script>




<script>
	$('#exampleModal').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var recipient = button.data('whatever') // Extract info from data-* attributes
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this)
		modal.find('.modal-title').text('New message to ' + recipient)
		modal.find('.modal-body input').val(recipient)
	})
</script>

<script>
	// Get the modal
	var modal = document.getElementById("myModal");

	// Get the button that opens the modal
	var btn = document.getElementById("myBtn");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks the button, open the modal 
	btn.onclick = function() {
		modal.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
		modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
</script>


<script>
	// when category dropdown changes





	$(document).ready(function() {

		$("form").submit(function(event) {
			var formData = {
				course_name: $("#course_name").val(),
				course_hourse: $("#course_hourse").val(),
				description: $("#description").val(),
				starting_time: $("#starting_time").val(),
				dated: $("#dated").val(),
			};

			$.ajax({
				type: "POST",
				url: "{{ url('account/create_course') }}",
				data: formData,
				dataType: "json",
				encode: true,
			}).success(function(data) {
				document.getElementsByClassName("close")[0].click = true;
				document.getElementById("myModal").style.display = "none";
				location.reload(); // console.log("hello welcome to digiprima technology");
			});

			event.preventDefault();
		});
	});
</script>

<style>
.teacher-meta {
    position: relative;
    padding: 25px 15px 0;
}


.teacher-meta h5 {
    font-size: 16px;
    line-height: 24px;
    color: #2c234d;
    margin: 0 0 7px;
    font-weight: 700!important;
    
}


</style>


@endsection



   
