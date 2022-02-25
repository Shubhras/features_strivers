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

@extends('layouts.master')



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css" />

<section class="page-banner01" style="background-image: url(../assets/images/home/cta-bg.jpg);">

</section>

@section('content')
@includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'])


<section style="background-color: white;">
	<div class="main-container">
		<div class="container">







			<?php if ($user->user_type_id == 2) {

			?>
				<h2>

					<h2 class="sec-title">My Payment</h2>
				</h2>


				<div class="row ">
					<div class="col-md-3 page-sidebar">
						<div class="inner-box default-inner-box">
							<h3 class="no-padding text-center-480 useradmin">
								<a href="">
									<img id="userImg" class="userImg user_profile_img" src="{{ $user->photo_url }}" alt="user"> &nbsp;
									{{ $user->name }}
								</a>
							</h3>
						</div>
					</div>

					<div class="col-md-9 page-content ">


						<div class="inner-box default-inner-box edit-file-chat">
							<div class="row">
								<div class="col-md-4 col-sm-4 col-12">
									<h3 class="no-padding text-center-480 useradmin">

										<b> My Payment </b>
									</h3>
								</div>
								<div class="col-md-8 col-sm-8 col-12">
									<div class="header-data text-center-xs">
										{{-- Threads Stats --}}
										<div class="hdata">
											<div class="mcol-left">
												<i class="fas fa-phone-alt ln-shadow"></i>
											</div>
											<div class="mcol-right">
												{{-- Number of messages --}}
												<p>
													<a href="{{ url('account/messages') }}">
														{{ isset($countThreads) ? \App\Helpers\Number::short($countThreads) : 0 }}

														<em>{{ trans_choice('Call', getPlural($countThreads), [], config('app.locale')) }}</em>
													</a>
												</p>
											</div>
											<div class="clearfix"></div>
										</div>

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

														<em>{{ trans_choice('Chat', getPlural($totalPostsVisits), [], config('app.locale')) }}</em>
													</a>
												</p>
											</div>
											<div class="clearfix"></div>
										</div>



										{{-- Favorites Stats --}}
										<div class="hdata">
											<div class="mcol-left">
												<i class="fas fa-bell ln-shadow"></i>
											</div>
											<div class="mcol-right">
												{{-- Number of favorites --}}
												<p>
													<a href="{{ url('account/favourite') }}">
														{{ \App\Helpers\Number::short($countFavoritePosts) }}
														<em>{{ trans_choice('Notification', getPlural($countFavoritePosts), [], config('app.locale')) }} </em>
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
				</div>



				<div class="row">

					<div class="col-md-3 page-sidebar">
						@includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar_coach', 'account.inc.sidebar_coach'])
					</div>
					<div class="col-md-9 page-content">




						<div class="mb-5">

							<div class="row coaches_payment_data">
								<div class="col-lg-4 card bg-success text-white card-body till_date_striver">
									<span class="span_text_show">Revenue Till date </span>
									<span>05-01-2021</span>

								</div>

								&nbsp; &nbsp;

								<div class="col-lg-4 card bg-primary text-white card-body till_date_striver">
									<span class="span_text_show">Revenue this month</span>
									<span>05-02-2021</span>

								</div>
								&nbsp; &nbsp;

								<div class="col-lg-4 card bg-info text-white card-body till_date_striver">
									<span class="span_text_show">Revenue this Quarter</span>
									<span>05-01-2021</span>

								</div>
							</div>


							<div class="row  coaches_payment_data">
								<div class="col-lg-4 card bg-danger text-white card-body till_date_striver">
									<span class="span_text_show">Total Strivers</span>
									<span>12</span>


								</div>
								&nbsp; &nbsp;

								<div class="col-lg-4 card bg-dark text-white card-body till_date_striver">
									<span class="span_text_show">Available Balance</span>
									<span>125</span>

								</div>
								&nbsp; &nbsp;
								<a href="#" class="get-payments-btn card text-white card-body till_date_striver">
									<div class="coaches_get_payment">
										<span>Get Paid</span>

									</div>
								</a>


							</div>

						</div>

						<div>

						</div>



						<div class="inner-box default-inner-box">


							<div class="row">





								<div class="table-responsive">
									<br>
									<form name="listForm" method="POST" action="{{ url('account/' . $pagePath . '/delete') }}">
										{!! csrf_field() !!}
										<div class="table-action">
											<div class="btn-group hidden-sm" role="group">
												<button type="button" class="btn btn-sm btn-secondary">
													<input type="checkbox" id="checkAll" class="from-check-all">
												</button>
												<button type="button" class="btn btn-sm btn-secondary from-check-all">
													{{ t('Select') }}: {{ t('All') }}
												</button>
											</div>

											<button type="submit" class="btn btn-sm btn-default delete-action">
												<i class="fa fa-trash"></i> {{ t('Delete') }}
											</button>

											<div class="table-search float-end col-sm-7">
												<div class="form-group">
													<div class="row">
														<label class="col-sm-5 control-label text-end">{{ t('search') }} <br>
															<a title="clear filter" class="clear-filter" href="#clear">[{{ t('clear') }}]</a>
														</label>
														<div class="col-sm-7 searchpan">
															<input type="text" class="form-control" id="filter">
														</div>
													</div>
												</div>
											</div>
										</div>

										<table id="addManageTable" class="result-table" data-filter="#filter" data-filter-text-only="true">
											<thead>
												<tr>
													<th class="course">Student</th>
													<th class="date">Course</th>
													<th class="grade">Total Amount</th>
													<th class="progres">Date </th>
													<th class="progres"> Fee deducted </th>
													<th class="progres">Net payment </th>



												</tr>

											</thead>


											<tbody>
												<tr>
													<td class="course">
														<a href="#">Getting Started with LESS</a>
													</td>
													<td class="date">24/03/2020</td>
													<td class="grade">50%</td>
													<td class="progres">0% In Progress</td>
													<td class="grade">400</td>
													<td class="grade">600</td>


												</tr>
												<tr>
													<td class="course">
														<a href="#">LMS Interactive Content</a>
													</td>
													<td class="date">24/03/2020</td>
													<td class="grade">40%</td>
													<td class="progres">0% In Progress</td>
													<td class="grade">400</td>
													<td class="grade">600</td>



												</tr>
												<tr>
													<td class="course">
														<a href="#">From Zero to Hero with Nodejs</a>
													</td>
													<td class="date">14/04/2019</td>
													<td class="grade">70%</td>
													<td class="progres">0% In Progress</td>
													<td class="grade">400</td>
													<td class="grade">600</td>


												</tr>
												<tr>
													<td class="course">
														<a href="#">Helping to change the world</a>
													</td>
													<td class="date">04/07/2018</td>
													<td class="grade">50%</td>
													<td class="progres">0% In Progress</td>
													<td class="grade">400</td>
													<td class="grade">600</td>


												</tr>

											</tbody>


											<tbody>
												<?php
												$i = 0;

												if (isset($user_subscription1) && $user_subscription1->count() > 0) :
													foreach ($user_subscription1 as $key => $post) :

														$i =	$i + 1; ?>

														<tr>


															<td class="price-td" style="width:20%">
																<div>
																	<strong>
																		{{ $post->username }}


																	</strong>
																</div>
															</td>

															<td class="price-td" style="width:40%">
																<div>
																	<strong>
																		{{ $post->name }}


																	</strong>
																</div>
															</td>

															<td class="price-td" style="width:10%">
																<div>
																	<strong>

																		<?php



																		$total_payment = $post->fee_deducte + $post->net_payment;
																		?>

																		{{$total_provided_hours}}

																	</strong>

																</div>
															</td>

															<td class="price-td" style="width:10%">
																<div>
																	<strong>
																		{{$post->created_at}}


																	</strong>
																</div>
															</td>


															<td class="price-td" style="width:10%">
																<div>
																	<strong>



																	</strong>
																</div>
															</td>


															<td class="price-td" style="width:10%">
																<div>
																	<strong>



																	</strong>
																</div>
															</td>

														</tr>
													<?php endforeach; ?>

												<?php endif; ?>

											</tbody>
										</table>


										<!-- <div class="tab-pane show in" id="finished" role="tabpanel">
												<table class="result-table">
													<thead>
														<tr>
															<th class="course">Course</th>
															<th class="date">Date</th>
															<th class="grade">Passing Grade</th>
															<th class="progres">Progress</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td class="course">
																<a href="#">Getting Started with LESS</a>
															</td>
															<td class="date">24/03/2020</td>
															<td class="grade">50%</td>
															<td class="progres">0% In Progress</td>
														</tr>
														<tr>
															<td class="course">
																<a href="#">LMS Interactive Content</a>
															</td>
															<td class="date">24/03/2020</td>
															<td class="grade">40%</td>
															<td class="progres">0% In Progress</td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="tab-pane show in" id="passed" role="tabpanel">
												<table class="result-table">
													<thead>
														<tr>
															<th class="course">Course</th>
															<th class="date">Date</th>
															<th class="grade">Passing Grade</th>
															<th class="progres">Progress</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td class="course">
																<a href="#">From Zero to Hero with Nodejs</a>
															</td>
															<td class="date">14/04/2019</td>
															<td class="grade">70%</td>
															<td class="progres">0% In Progress</td>
														</tr>
														<tr>
															<td class="course">
																<a href="#">Helping to change the world</a>
															</td>
															<td class="date">04/07/2018</td>
															<td class="grade">50%</td>
															<td class="progres">0% In Progress</td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="tab-pane show in" id="failed" role="tabpanel">
												<table class="result-table">
													<thead>
														<tr>
															<th class="course">Course</th>
															<th class="date">Date</th>
															<th class="grade">Passing Grade</th>
															<th class="progres">Progress</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td class="course">
																<a href="#">Getting Started with LESS</a>
															</td>
															<td class="date">24/03/2020</td>
															<td class="grade">50%</td>
															<td class="progres">0% In Progress</td>
														</tr>
														<tr>
															<td class="course">
																<a href="#">LMS Interactive Content</a>
															</td>
															<td class="date">24/03/2020</td>
															<td class="grade">40%</td>
															<td class="progres">0% In Progress</td>
														</tr>
													</tbody>
												</table>
											</div> -->

									</form>
								</div>
							</div>
							<nav>
								{{ (isset($posts)) ? $posts->links() : '' }}
							</nav>



						</div>

					</div>
					<!--/.row-box End-->

				</div>
				<br>



				<div class="main-section">
					<div class="container">

						<h2 class="sec-title" style="font-weight: 700;">
							Suggested Strivre

						</h2>

						<div class="row">
							<?php foreach ($suggested_striver as $coach_list) { ?>
								<div class="col-lg-3 col-md-6">
									<div class="teacher-item">
										<div class="teacher-thumb coach-img-wrapper">
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
											<h5>
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

		</div>





		<!--/.page-content-->



	</div>


<?php } else { ?>




	<h2>

		<h2 class="sec-title">My Subscriptions</h2>
	</h2>


	<div class="row ">
		<div class="col-md-3 page-sidebar">
			<div class="inner-box default-inner-box">
				<h3 class="no-padding text-center-480 useradmin">
					<a href="">
						<img id="userImg" class="userImg user_profile_img" src="{{ $user->photo_url }}" alt="user"> &nbsp;
						{{ $user->name }}
					</a>
				</h3>
			</div>
		</div>

		<div class="col-md-9 page-content ">


			<div class="inner-box default-inner-box edit-file-chat">
				<div class="row">
					<div class="col-md-4 col-sm-4 col-12">
						<h3 class="no-padding text-center-480 useradmin">

							<b> My Subscriptions </b>
						</h3>
					</div>
					<div class="col-md-8 col-sm-8 col-12">
						<div class="header-data text-center-xs">
							{{-- Threads Stats --}}
							<div class="hdata">
								<div class="mcol-left">
									<i class="fas fa-phone-alt ln-shadow"></i>
								</div>
								<div class="mcol-right">
									{{-- Number of messages --}}
									<p>
										<a href="{{ url('account/messages') }}">
											{{ isset($countThreads) ? \App\Helpers\Number::short($countThreads) : 0 }}

											<em>{{ trans_choice('Call', getPlural($countThreads), [], config('app.locale')) }}</em>
										</a>
									</p>
								</div>
								<div class="clearfix"></div>
							</div>

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

											<em>{{ trans_choice('Chat', getPlural($totalPostsVisits), [], config('app.locale')) }}</em>
										</a>
									</p>
								</div>
								<div class="clearfix"></div>
							</div>



							{{-- Favorites Stats --}}
							<div class="hdata">
								<div class="mcol-left">
									<i class="fas fa-bell ln-shadow"></i>
								</div>
								<div class="mcol-right">
									{{-- Number of favorites --}}
									<p>
										<a href="{{ url('account/favourite') }}">
											{{ \App\Helpers\Number::short($countFavoritePosts) }}
											<em>{{ trans_choice('Notification', getPlural($countFavoritePosts), [], config('app.locale')) }} </em>
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
	</div>




	<div class="row">

		<div class="col-md-3 page-sidebar">
			@includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar', 'account.inc.sidebar'])
		</div>

		<div class="col-md-9 page-content">


			<div class="inner-box default-inner-box edit-file-chat">

				<!--/.row-box End-->
				<div class="row">



					<div class="states">

						<?php
						if ($user_subscription) {


							$name = json_decode($user_subscription->name);
							$ss = array();
							foreach ($name as $key => $sub) {
								$ss[$key] = $sub;
							}


						?>



							<h5> Current Subscription: <span style="color: red;">{{$ss['en']}}</span></h5>
							<h5> Total hours : <span style="color: red;">{{$user_subscription->total_provided_hours}} Hours.</span></h5>
							<h5> Consumed Hours : <span style="color: red;">{{$user_subscription->consumed_hours}} Hours.</span></h5>
							<h5> Remaining Hours : <span style="color: red;">{{$user_subscription->remaining_hours}} Hours.</span></h5>


							<?php //}

							?>
					</div>
				</div>
				<br>
				<?php
							if (empty($user_subscription->remaining_hours)) {
				?>
					<div class="col-md-12" style="text-align: center;">
						<a href="{{ url('subscription') }}">

							<button style="font-size: 20px; ">Renew Subscriptions</button>
						</a>
					</div>


				<?php } ?>
				<div class="col-md-12" style="text-align: center;">
					<a href="{{ url('pricing') }}">

						<button style="font-size: 20px; ">Get Subscriptions</button>
					</a>

				</div>
			<?php } else { ?>

				<div class="col-md-12" style="text-align: center;">
					<h2>Please Get Subscription First!</h2>
				</div>
				<div class="col-md-12" style="text-align: center;">
					<a href="{{ url('pricing') }}">

						<button style="font-size: 20px; ">Get Subscriptions</button>
					</a>

				</div>

			<?php }
			?>


			<br>


			<h2 style="text-align:center;"><b>
					old Subscriptions </b></h2>
			<?php

				// 	}

				// 
			?>

			</div>
			<div class="states">

				<?php
				if ($user_subscriptions1) {
				?>




					<?php
					foreach ($user_subscriptions1 as $key => $value) {
						$name = json_decode($value->name);
						$ss = array();
						foreach ($name as $key => $sub) {
							$ss[$key] = $sub;
						}

					?>

						<br>
						<?php
						if (empty($user_subscriptions1->remaining_hours)) {
						?>
							<div class="col-md-12">
								<h2> Old plan :{{$ss['en']}}</h2>
								<h2> Old plan Hours :{{$value->total_provided_hours}} Hours.</h2>
							</div>
						<?php } ?>

				<?php
					}
				}	?>
				<br>
			</div>
		</div>
	</div>

	<div class="main-section">
					<div class="container">

						<h2 class="sec-title" style="font-weight: 700;">
							Suggested Coaches

						</h2>

						<div class="row">
							<?php foreach ($suggested_coaches as $coach_list) { ?>
								<div class="col-lg-3 col-md-6">
									<div class="teacher-item">
										<div class="teacher-thumb coach-img-wrapper">
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
											<h5>
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

<?php } ?>

</div>
<!--/.row-->
</div>
<!--/.container-->
</div>
<br>

@includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.footer1', 'layouts.inc.footer1'])
<!-- /.main-container -->
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

	.states h2 {
		margin-top: 50px;
		padding-left: 35px;
	}
</style>
@endsection

@section('after_scripts')
<script src="{{ url('assets/plugins/bootstrap-fileinput/js/plugins/sortable.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/plugins/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/plugins/bootstrap-fileinput/themes/fas/theme.js') }}" type="text/javascript"></script>
<script src="{{ url('js/fileinput/locales/' . config('app.locale') . '.js') }}" type="text/javascript"></script>



<script>
	// when category dropdown changes
	$(document).ready(function() {

		var sub_cat_id = {
			{
				old('sub_category', $user - > sub_category)
			}
		}
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
								$("#sub_category").append('<option value="' + key + '" ' + ((key == (sub_cat_id)) ? "selected" : "") + ' >' + value +
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
							$("#sub_category").append('<option value="' + key + '" ' + ((key == (sub_cat_id)) ? "selected" : "") + ' >' + value +
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
@endsection