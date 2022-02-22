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
        </div>
    </div> -->
    <!-- Preloader Icon -->

    <!-- Header Start -->
   
    <!-- Header End -->

    <!-- Banner Start -->
    <section class="page-banner01" style="background-image: url(assets/images/home/cta-bg.jpg);">
        <!-- <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="banner-title">My Strivre</h2>
                    
                </div>
            </div>
        </div> -->
    </section>
    <!-- Banner End -->

    <!-- Course Section Start -->
<section class="coursepage-section-2">
	<?php if($user->user_type_id == 2){

		?>
	<div class="container">
		
            <h2>
           
            <h2 class="sec-title">My Strivre</h2>
        </h2>
            <div class="row">
               
                <div class="col-lg-3">

                    <nav class="navbar navbar-expand-md navbar-light  dashboard-nav mb-3 mb-lg-0 ">
                        <a class="d-xl-none d-lg-none d-md-none text-inherit  font-weight-bold" href="#">Menu</a>
                        <button class="navbar-toggler d-md-none icon-shape icon-sm rounded bg-primary text-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="fas fa-bars"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <div class="navbar-nav flex-column w-100 ">
                                <div class="border-bottom py-4 p-md-4 d-flex justify-content-between text-reset">
                                    <div class="d-flex align-items-center">
                                        <img src="../assets/images/avatar-1.png" alt="" class="rounded-circle avatar-lg">
                                       
                                    </div>
                                </div>
								@includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar_coach', 'account.inc.sidebar_coach'])
                            </div>
                        </div>
                    </nav>


                </div>


                <div class="col-lg-9 ">
                    <div class="row">

                       
                        <div class="col-lg-4 col-md-6">
                            <div class="teacher-item">
                                <div class="teacher-thumb">
									<?php foreach ($my_striver as $coach_list) { ?>
									
                                    <div class="madels">
									<img src="{{ imgUrl($coach_list->photo, '') }}" class="lazyload img-fluid"  alt="{{ $coach_list->name }}">
                                    </div>
                                    <div class="mcol-right">
                                        {{-- Number of visitors --}}
                                        <p>
                                            <a href="{{ url('account/chat') }}">
                                                <?php $totalPostsVisits = (isset($countPostsVisits) and $countPostsVisits->total_visits) ? $countPostsVisits->total_visits : 0 ?>
                                                {{ \App\Helpers\Number::short($totalPostsVisits) }}
                                                <!-- <em>{{ trans_choice('global.count_visits', getPlural($totalPostsVisits), [], config('app.locale')) }}</em> -->
                                                <em>{{ trans_choice('Chat', getPlural($totalPostsVisits), [], config('app.locale')) }}</em>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <div class="teacher-meta">
                                    <h5>
									{{ $coach_list->name }}
                                    </h5>
									<?php } ?>
                                </div>
								
                            </div>
                        </div>
                     
                    
                        
                      
                       
                       
                      
                        
                    </div>
                </div>

            </div>
        </div>
	</div>
		<?php } else { ?>

			
        <div class="container">
            
           
            <h2 class="sec-title">My Coaches</h2>
        
            <div class="row">
               
                <div class="col-lg-3">

                    <nav class="navbar navbar-expand-md navbar-light  dashboard-nav mb-3 mb-lg-0 ">
                        <a class="d-xl-none d-lg-none d-md-none text-inherit  font-weight-bold" href="#">Menu</a>
                        <button class="navbar-toggler d-md-none icon-shape icon-sm rounded bg-primary text-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="fas fa-bars"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <div class="navbar-nav flex-column w-100 ">
                                <div class="border-bottom py-4 p-md-4 d-flex justify-content-between text-reset">
                                    <div class="d-flex align-items-center">
                                        <img src="../assets/images/avatar-1.png" alt="" class="rounded-circle avatar-lg">
                                        
                                    </div>
									
                                </div>
								@includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar', 'account.inc.sidebar'])
                            </div>
                        </div>
                    </nav>


                </div>


                <div class="col-lg-9 ">
                    <div class="row">

                                {{-- Traffic Stats --}}
                                <div class="hdata">
                                    <div class="mcol-left">
                                        <i class="fas fa-comments ln-shadow"></i>
                                    </div>
                                    <div class="mcol-right">
                                        {{-- Number of visitors --}}
                                        <p>
                                            <a href="{{ url('account/chat') }}">
                                                <?php $totalPostsVisits = (isset($countPostsVisits) and $countPostsVisits->total_visits) ? $countPostsVisits->total_visits : 0 ?>
                                                {{ \App\Helpers\Number::short($totalPostsVisits) }}
                                                <!-- <em>{{ trans_choice('global.count_visits', getPlural($totalPostsVisits), [], config('app.locale')) }}</em> -->
                                                <em>{{ trans_choice('Chat', getPlural($totalPostsVisits), [], config('app.locale')) }}</em>
                                            </a>
                                        </p>
                                    </div>
                                </div>
							
                                <div class="teacher-meta">
                                    <h5>
									{{ $coach_list->name }}
                                    </h5>
                                   
                                </div>
								<?php } ?>
                            </div>
                        </div>
                     
                      
                      
                       
                      
                       
                    </div>
                </div>
            </div>

        </div>
    <div class="main-section">
        <div class="container">

            <h2 class="sec-title">
                Suggested Coaches

            </h2>

            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="teacher-item">
					<?php foreach ($suggested_coaches as $coach_list) { ?>
                        <div class="teacher-thumb">
						<img src="{{ imgUrl($coach_list->photo, '') }}" class="lazyload img-fluid"  alt="{{ $coach_list->name }}">
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
							{{ $coach_list->name }}
                            </h5>
                           
                        </div>
						<?php } ?>
                    </div>
                </div>
             
              
               
            </div>
        </div>
     </div>
      
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

    <script>
		var uploadExtraData = {
			_token:'{{ csrf_token() }}',
			_method:'PUT',
			name:'{{ $user->name }}',
			phone:'{{ $user->phone }}',
			email:'{{ $user->email }}'
		};
		var initialPreviewConfigExtra = uploadExtraData;
		initialPreviewConfigExtra.remove_photo = 1;
		
		var photoInfo = '<h6 class="text-muted pb-0">{{ t('Click to select') }}</h6>';
		var footerPreview = '<div class="file-thumbnail-footer pt-2">\n' +
			'    {actions}\n' +
			'</div>';
		
		$('#photoField').fileinput(
		{
			theme: 'fas',
			language: '{{ config('app.locale') }}',
			@if (config('lang.direction') == 'rtl')
				rtl: true,
			@endif
			overwriteInitial: true,
			showCaption: false,
			showPreview: true,
			allowedFileExtensions: {!! getUploadFileTypes('image', true) !!},
			uploadUrl: '{{ url('account/photo') }}',
			uploadExtraData: uploadExtraData,
			uploadAsync: false,
			showBrowse: false,
			showCancel: true,
			showUpload: false,
			showRemove: false,
			minFileSize: {{ (int)config('settings.upload.min_image_size', 0) }}, {{-- in KB --}}
			maxFileSize: {{ (int)config('settings.upload.max_image_size', 1000) }}, {{-- in KB --}}
			browseOnZoneClick: true,
			minFileCount: 0,
			maxFileCount: 1,
			validateInitialCount: true,
			uploadClass: 'btn btn-primary',
			defaultPreviewContent: '<img src="{{ url('images/user.jpg') }}" alt="{{ t('Your Photo or Avatar') }}">' + photoInfo,
			/* Retrieve current images */
			/* Setup initial preview with data keys */
			initialPreview: [
				@if (isset($user->photo) && !empty($user->photo))
					'{{ imgUrl($user->photo, 'user') }}'
				@endif
			],
			initialPreviewAsData: true,
			initialPreviewFileType: 'image',
			/* Initial preview configuration */
			initialPreviewConfig: [
				{
					<?php
						// Get the file size
						try {
							$fileSize = (isset($disk) && $disk->exists($user->photo)) ? (int)$disk->size($user->photo) : 0;
						} catch (\Throwable $e) {
							$fileSize = 0;
						}
					?>
					@if (isset($user->photo) && !empty($user->photo))
						caption: '{{ basename($user->photo) }}',
						size: {{ $fileSize }},
						url: '{{ url('account/photo/delete') }}',
						key: {{ (int)$user->id }},
						extra: initialPreviewConfigExtra
					@endif
				}
			],
			
			showClose: false,
			fileActionSettings: {
				showDrag: false, /* Show/hide move (rearrange) icon */
				removeIcon: '<i class="far fa-trash-alt"></i>',
				removeClass: 'btn btn-sm btn-danger',
				removeTitle: '{{ t('Remove file') }}'
			},
			
			elErrorContainer: '#avatarUploadError',
			msgErrorClass: 'alert alert-block alert-danger',
			
			layoutTemplates: {main2: '{preview} {remove} {browse}', footer: footerPreview}
		});
		
		/* Auto-upload added file */
		$('#photoField').on('filebatchselected', function(event, data, id, index) {
			$(this).fileinput('upload');
		});
		
		/* Show upload status message */
		$('#photoField').on('filebatchpreupload', function(event, data, id, index) {
			$('#avatarUploadSuccess').html('<ul></ul>').hide();
		});
		
		/* Show success upload message */
		$('#photoField').on('filebatchuploadsuccess', function(event, data, previewId, index) {
			/* Show uploads success messages */
			var out = '';
			$.each(data.files, function(key, file) {
				if (typeof file !== 'undefined') {
					var fname = file.name;
					out = out + {!! t('Uploaded file X successfully') !!};
				}
			});
			$('#avatarUploadSuccess ul').append(out);
			$('#avatarUploadSuccess').fadeIn('slow');
			
			$('#userImg').attr({'src':$('.photo-field .kv-file-content .file-preview-image').attr('src')});
		});
		
		/* Delete picture */
		$('#photoField').on('filepredelete', function(jqXHR) {
			var abort = true;
			if (confirm("{{ t('Are you sure you want to delete this picture') }}")) {
				abort = false;
			}
			return abort;
		});
		
		$('#photoField').on('filedeleted', function() {
			$('#userImg').attr({'src':'{!! url('images/user.jpg') !!}'});
			
			var out = "{{ t('Your photo or avatar has been deleted') }}";
			$('#avatarUploadSuccess').html('<ul><li></li></ul>').hide();
			$('#avatarUploadSuccess ul li').append(out);
			$('#avatarUploadSuccess').fadeIn('slow');
		});
          
	</script>

	<script>
	     // when category dropdown changes
		$(document).ready(function(){

			var sub_cat_id = {{ old('sub_category', $user->sub_category) }}
			$('#category').change(function() {
				var categoryID = $('#category').val();
				if (categoryID) {
					$.ajax({
						type: "GET",
						url: "{{ url('account/getSubcategories') }}?id=" + categoryID,

						success: function(res) {

							if (res) {

								$("#sub_category").empty();
								$("#sub_category").append('<option value=0>Select a subcategory</option>');
								$.each(res, function(key, value) {
									$("#sub_category").append('<option value="' + key + '" '+((key == (sub_cat_id)) ? "selected" : "")+' >' + value +
									'</option>');

								});

							} else {

								$("#sub_category").empty();
							}
							
						}
					});
				} else {
					$("#sub_category").empty();
				}
			});
			var categoryID = $('#category').val();	
			if (categoryID) {
				
				$.ajax({
					
					type: "GET",
					url: "{{ url('account/getSubcategories') }}?id=" + categoryID,

					success: function(res) {

						if (res) {
							
							$("#sub_category").empty();
							$("#sub_category").append('<option value=0>Select a subcategory</option>');
							$.each(res, function(key, value) {
								$("#sub_category").append('<option value="' + key + '" '+((key == (sub_cat_id)) ? "selected" : "")+' >' + value +
								'</option>');

							});

						} else {

							$("#sub_category").empty();
						}
						
					}
				});
			} else {
				$("#sub_category").empty();
			}
		});
     </script>




	