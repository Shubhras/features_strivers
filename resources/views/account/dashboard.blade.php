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


<title>Jquery Fullcalandar Integration with PHP and Mysql</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script>
   
  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: 'load.php',
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay)
    {
     var title = prompt("Enter Event Title");
     if(title)
     {
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      $.ajax({
       url:"insert.php",
       type:"POST",
       data:{title:title, start:start, end:end},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Added Successfully");
       }
      })
     }
    },
    editable:true,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Update');
      }
     })
    },

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Updated");
      }
     });
    },

    eventClick:function(event)
    {
     if(confirm("Are you sure you want to remove it?"))
     {
      var id = event.id;
      $.ajax({
       url:"delete.php",
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Event Removed");
       }
      })
     }
    },

   });
  });
   
  </script>

@section('content')
	@includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'])
	<div class="main-container">
		<div class="container">
			<div class="row">
				<div class="col-md-3 page-sidebar">
					@includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar', 'account.inc.sidebar'])
				</div>


				<?php if($user->user_type_id == 2){

				?>

				<div class="col-md-9 page-content">

					@include('flash::message')

					@if (isset($errors) && $errors->any())
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ t('Close') }}"></button>
							<h5><strong>{{ t('oops_an_error_has_occurred') }}</strong></h5>
							<ul class="list list-check">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					
					<div id="avatarUploadError" class="center-block" style="width:100%; display:none"></div>
					<div id="avatarUploadSuccess" class="alert alert-success fade show" style="display:none;"></div>
					
					<div class="inner-box default-inner-box">
						<div class="row">
							<div class="col-md-5 col-sm-4 col-12">
								<h3 class="no-padding text-center-480 useradmin">
									<a href="">
										<img id="userImg" class="userImg" src="{{ $user->photo_url }}" alt="user">&nbsp;
										{{ $user->name }}
									</a>
								</h3>
							</div>
							<div class="col-md-7 col-sm-8 col-12">
								<div class="header-data text-center-xs">
									{{-- Threads Stats --}}
									<div class="hdata">
										<div class="mcol-left">
											<i class="fas fa-envelope ln-shadow"></i></div>
										<div class="mcol-right">
											{{-- Number of messages --}}
											<p>
												<a href="{{ url('account/messages') }}">
													{{ isset($countThreads) ? \App\Helpers\Number::short($countThreads) : 0 }}
													<em>{{ trans_choice('global.count_mails', getPlural($countThreads), [], config('app.locale')) }}</em>
												</a>
											</p>
										</div>
										<div class="clearfix"></div>
									</div>
									
									{{-- Traffic Stats --}}
									<div class="hdata">
										<div class="mcol-left">
											<i class="fa fa-eye ln-shadow"></i>
										</div>
										<div class="mcol-right">
											{{-- Number of visitors --}}
											<p>
												<a href="{{ url('account/my-posts') }}">
													<?php $totalPostsVisits = (isset($countPostsVisits) and $countPostsVisits->total_visits) ? $countPostsVisits->total_visits : 0 ?>
													{{ \App\Helpers\Number::short($totalPostsVisits) }}
													<em>{{ trans_choice('global.count_visits', getPlural($totalPostsVisits), [], config('app.locale')) }}</em>
												</a>
											</p>
										</div>
										<div class="clearfix"></div>
									</div>

									{{-- Ads Stats --}}
									<div class="hdata">
										<div class="mcol-left">
											<i class="fas fa-bullhorn ln-shadow"></i>
										</div>
										<div class="mcol-right">
											{{-- Number of ads --}}
											<p>
												<a href="{{ url('account/my-posts') }}">
													{{ \App\Helpers\Number::short($countPosts) }}
													<em>{{ trans_choice('global.count_posts', getPlural($countPosts), [], config('app.locale')) }}</em>
												</a>
											</p>
										</div>
										<div class="clearfix"></div>
									</div>

									{{-- Favorites Stats --}}
									<div class="hdata">
										<div class="mcol-left">
											<i class="fa fa-user ln-shadow"></i>
										</div>
										<div class="mcol-right">
											{{-- Number of favorites --}}
											<p>
												<a href="{{ url('account/favourite') }}">
													{{ \App\Helpers\Number::short($countFavoritePosts) }}
													<em>{{ trans_choice('global.count_favorites', getPlural($countFavoritePosts), [], config('app.locale')) }} </em>
												</a>
											</p>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
					</div>

					
				</div>
				<!--/.page-content-->

				<?php } else {?>
					<div class="col-md-9 page-content">

					@include('flash::message')

					@if (isset($errors) && $errors->any())
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ t('Close') }}"></button>
							<h5><strong>{{ t('oops_an_error_has_occurred') }}</strong></h5>
							<ul class="list list-check">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					
					<div id="avatarUploadError" class="center-block" style="width:100%; display:none"></div>
					<div id="avatarUploadSuccess" class="alert alert-success fade show" style="display:none;"></div>
					
					<div class="inner-box default-inner-box">
						<div class="row">
							<div class="col-md-5 col-sm-4 col-12">
								<h3 class="no-padding text-center-480 useradmin">
									<a href="">
										<img id="userImg" class="userImg" src="{{ $user->photo_url }}" alt="user">&nbsp;
										{{ $user->name }}
									</a>
								</h3>
							</div>
							<div class="col-md-7 col-sm-8 col-12">
								<div class="header-data text-center-xs">
									{{-- Threads Stats --}}
									<div class="hdata">
										<div class="mcol-left">
											<i class="fas fa-envelope ln-shadow"></i></div>
										<div class="mcol-right">
											{{-- Number of messages --}}
											<p>
												<a href="{{ url('account/messages') }}">
													{{ isset($countThreads) ? \App\Helpers\Number::short($countThreads) : 0 }}
													<em>{{ trans_choice('global.count_mails', getPlural($countThreads), [], config('app.locale')) }}</em>
												</a>
											</p>
										</div>
										<div class="clearfix"></div>
									</div>
									
									{{-- Traffic Stats --}}
									<div class="hdata">
										<div class="mcol-left">
											<i class="fa fa-eye ln-shadow"></i>
										</div>
										<div class="mcol-right">
											{{-- Number of visitors --}}
											<p>
												<a href="{{ url('account/my-posts') }}">
													<?php $totalPostsVisits = (isset($countPostsVisits) and $countPostsVisits->total_visits) ? $countPostsVisits->total_visits : 0 ?>
													{{ \App\Helpers\Number::short($totalPostsVisits) }}
													<em>{{ trans_choice('global.count_visits', getPlural($totalPostsVisits), [], config('app.locale')) }}</em>
												</a>
											</p>
										</div>
										<div class="clearfix"></div>
									</div>

									{{-- Ads Stats --}}
									<div class="hdata">
										<div class="mcol-left">
											<i class="fas fa-bullhorn ln-shadow"></i>
										</div>
										<div class="mcol-right">
											{{-- Number of ads --}}
											<p>
												<a href="{{ url('account/my-posts') }}">
													{{ \App\Helpers\Number::short($countPosts) }}
													<em>{{ trans_choice('global.count_posts', getPlural($countPosts), [], config('app.locale')) }}</em>
												</a>
											</p>
										</div>
										<div class="clearfix"></div>
									</div>

									{{-- Favorites Stats --}}
									<div class="hdata">
										<div class="mcol-left">
											<i class="fa fa-user ln-shadow"></i>
										</div>
										<div class="mcol-right">
											{{-- Number of favorites --}}
											<p>
												<a href="{{ url('account/favourite') }}">
													{{ \App\Helpers\Number::short($countFavoritePosts) }}
													<em>{{ trans_choice('global.count_favorites', getPlural($countFavoritePosts), [], config('app.locale')) }} </em>
												</a>
											</p>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- <div id='calendar1'></div> -->

					

        <!-- <div class="container mt-5" style="max-width: 700px">
        <h2 class="h2 text-center mb-5 border-bottom pb-3">Laravel FullCalender CRUD Events Example</h2>
        <div id='full_calendar_events'></div>


    </div> -->
    <div id="calendar"></div>
    <?php }?>



    <div id="calendar"></div>

				</div>
			<!--/.row-->
		</div>

        <div id="calendar"></div>
		<!--/.container-->
	</div>
	<!-- /.main-container -->
@endsection

@section('after_styles')

	@if (config('lang.direction') == 'rtl')
		<!-- <link href="{{ url('assets/plugins/bootstrap-fileinput/css/fileinput-rtl.min.css') }}" rel="stylesheet"> -->
	@endif
	
    <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script>
<script src="http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery-ui.custom.min.js"></script>
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script>


<script>
    $('#calendar').fullCalendar({
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek'
    },
    defaultDate: '2018-11-16',
    navLinks: true,
    eventLimit: true,
    events: [{
            title: 'Front-End Conference',
            start: '2018-11-16',
            end: '2018-11-18'
        },
        {
            title: 'Hair stylist with Mike',
            start: '2018-11-20',
            allDay: true
        },
        {
            title: 'Car mechanic',
            start: '2018-11-14T09:00:00',
            end: '2018-11-14T11:00:00'
        },
        {
            title: 'Dinner with Mike',
            start: '2018-11-21T19:00:00',
            end: '2018-11-21T22:00:00'
        },
        {
            title: 'Chillout',
            start: '2018-11-15',
            allDay: true
        },
        {
            title: 'Vacation',
            start: '2018-11-23',
            end: '2018-11-29'
        },
    ]
});

</script>

@endsection

@section('after_scripts')
	
@endsection

