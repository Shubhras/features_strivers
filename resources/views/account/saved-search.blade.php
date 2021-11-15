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

@section('content')
	@includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'])
	<div class="main-container">
		<div class="container">
			<div class="row">

				@if (session()->has('flash_notification'))
					<div class="col-xl-12">
						<div class="row">
							<div class="col-xl-12">
								@include('flash::message')
							</div>
						</div>
					</div>
				@endif

				<div class="col-md-3 page-sidebar">
					@includeFirst([config('larapen.core.customizedViewPath') . 'account.inc.sidebar', 'account.inc.sidebar'])
				</div>
				<!--/.page-sidebar-->

				<div class="col-md-9 page-content">
					<div class="inner-box">
						<h2 class="title-2"><i class="fas fa-bookmark"></i> {{ t('Saved searches') }} </h2>
						<div class="row">
							
							@if (!isset($savedSearch) || $savedSearch->getCollection()->count() <= 0)
								<div class="col-md-12">
									<div class="text-center mb30">
										{{ t('You have no saved search') }}
									</div>
								</div>
							@else
								<div class="col-md-4">
									<ul class="list-group list-group-unstyle">
										@foreach ($savedSearch->items() as $search)
											<li class="list-group-item {{ (request()->get('q')==$search->keyword) ? 'active' : '' }}">
												<a href="{{ url('account/saved-search/?'.$search->query.'&pag='.request()->get('pag')) }}" class="">
													<span> {{ \Illuminate\Support\Str::limit(strtoupper($search->keyword), 20) }} </span>
													<span class="badge badge-pill bg-warning" id="{{ $search->id }}">{{ $search->count }}+</span>
												</a>
												<span class="delete-search-result">
													<a href="{{ url('account/saved-search/'.$search->id.'/delete') }}">&times;</a>
												</span>
											</li>
										@endforeach
									</ul>
									<div class="pagination-bar text-center">
										{{ (isset($savedSearch)) ? $savedSearch->links() : '' }}
									</div>
								</div>
								
								<div class="col-md-8">
									<div class="posts-wrapper category-list">
										@if (isset($posts) and $posts->total() > 0)
											@foreach($posts->items() as $key => $post)
												@continue(empty($post->city))
												<?php
												// Main Picture
												if ($post->pictures->count() > 0) {
													$postImg = imgUrl($post->pictures->get(0)->filename, 'medium');
												} else {
													$postImg = imgUrl(config('larapen.core.picture.default'), 'medium');
												}
												?>
												<div class="item-list">
													<div class="row">
														<div class="col-md-2 no-padding photobox">
															<div class="add-image">
																<span class="photo-count">
																	<i class="fa fa-camera"></i> {{ $post->pictures->take($picturesLimit)->count() }}
																</span>
																<a href="{{ \App\Helpers\UrlGen::post($post) }}">
																	<img class="img-thumbnail no-margin" src="{{ $postImg }}" alt="img">
																</a>
															</div>
														</div>
														
														<div class="col-md-8 add-desc-box">
															<div class="items-details">
																<h5 class="add-title">
																	<a href="{{ \App\Helpers\UrlGen::post($post) }}">{{ $post->title }}</a>
																</h5>
																
																<span class="info-row">
																	@if (isset($post->postType) and !empty($post->postType))
																		<span class="add-type business-posts"
																			  data-bs-toggle="tooltip"
																			  data-bs-placement="right"
																			  title="{{ $post->postType->name }}"
																		>
																			{{ strtoupper(mb_substr($post->postType->name, 0, 1)) }}
																		</span>
																	@endif
																		<span class="date">
																			<i class="far fa-clock"></i> {!! $post->created_at_formatted !!}
																		</span>
																		@if (!empty($post->category))
																		@if ($cats->has($post->category->parent_id))
																			&nbsp<span class="category">
																				<i class="fas fa-folder"></i>
																				{{ $cats->get($post->category->parent_id)->name }}
																			</span>
																		@else
																			@if (empty($post->category->parent_id))
																				&nbsp;<span class="category">
																					<i class="fas fa-folder"></i> {{ $post->category->name }}
																				</span>
																			@endif
																		@endif
																	@endif
																	@if (!empty($post->city))
																		&nbsp;<span class="item-location">
																			<i class="fas fa-map-marker-alt"></i> {{ $post->city->name }}
																		</span>
																	@endif
																</span>
															</div>
														</div>
														
														<div class="col-md-2 text-end text-center-xs price-box">
															<h4 class="item-price">
																@if (is_numeric($post->price) && $post->price > 0)
																	{!! \App\Helpers\Number::money($post->price) !!}
																@elseif (is_numeric($post->price) && $post->price == 0)
																	{!! t('free_as_price') !!}
																@else
																	{!! \App\Helpers\Number::money(' --') !!}
																@endif
															</h4>
														</div>
													</div>
												</div>
											@endforeach
										@else
											<div class="text-center mt10 mb30">
												{{ t('Please select a saved search to show the result') }}
											</div>
										@endif
									</div>
									
									<div style="clear:both;"></div>
									
									<nav class="pagination-bar mb-4" aria-label="">
										<?php
										if (isset($posts)) {
											echo $posts->appends(collect(request()->query())->map(function($item) {
												return is_null($item) ? '' : $item;
											})->toArray())->links();
										}
										?>
									</nav>
								</div>
							@endif
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('after_scripts')
	{{-- include footable   --}}
	<script src="{{ url('assets/js/footable.js?v=2-0-1') }}" type="text/javascript"></script>
	<script src="{{ url('assets/js/footable.filter.js?v=2-0-1') }}" type="text/javascript"></script>
	<script type="text/javascript">
        $(function () {
			$('#addManageTable').footable().bind('footable_filtering', function (e) {
				var selected = $('.filter-status').find(':selected').text();
				if (selected && selected.length > 0) {
					e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
					e.clear = !e.filter;
				}
			});

			$('.clear-filter').click(function (e) {
				e.preventDefault();
				$('.filter-status').val('');
				$('table.demo').trigger('footable_clear_filter');
			});

		});
	</script>
	{{-- include custom script for ads table [select all checkbox]  --}}
	<script>
		function checkAll(bx) {
			var chkinput = document.getElementsByTagName('input');
			for (var i = 0; i < chkinput.length; i++) {
				if (chkinput[i].type == 'checkbox') {
					chkinput[i].checked = bx.checked;
				}
			}
		}
	</script>
@endsection
