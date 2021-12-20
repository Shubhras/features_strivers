<?php
if (!isset($cacheExpiration)) {
    $cacheExpiration = (int)config('settings.optimization.cache_expiration');
}
?>
@if (isset($posts) && $posts->count() > 0)
	<?php
	if (!isset($cats)) {
		$cats = collect([]);
	}

	foreach($posts as $key => $post):
		// Main Picture
		if ($post->pictures->count() > 0) {
			$postImg = $post->pictures->get(0)->filename;
		} else {
			$postImg = config('larapen.core.picture.default');
		}
	?>
	<div class="item-list">
		@if ($post->featured == 1)
			@if (isset($post->latestPayment, $post->latestPayment->package) && !empty($post->latestPayment->package))
				@if ($post->latestPayment->package->ribbon != '')
					<div class="cornerRibbons {{ $post->latestPayment->package->ribbon }}">
						<a href="#"> {{ $post->latestPayment->package->short_name }}</a>
					</div>
				@endif
			@endif
		@endif
		
		<div class="row">
			<div class="col-sm-2 col-12 no-padding photobox">
				<div class="add-image">
					<span class="photo-count">
						<i class="fa fa-camera"></i> {{ $post->pictures->take($picturesLimit)->count() }}
					</span>
					<a href="{{ \App\Helpers\UrlGen::post($post) }}">
						{!! imgTag($postImg, 'medium', ['class' => 'lazyload thumbnail no-margin', 'alt' => $post->title]) !!}
					</a>
				</div>
			</div>
	
			<div class="col-sm-7 col-12 add-desc-box">
				<div class="items-details">
					<h5 class="add-title">
						<a href="{{ \App\Helpers\UrlGen::post($post) }}">{{ \Illuminate\Support\Str::limit($post->title, 70) }} </a>
					</h5>
					
					<span class="info-row">
						@if (config('settings.single.show_post_types'))
							@if (isset($post->postType) && !empty($post->postType))
								<span class="add-type business-posts"
									  data-bs-toggle="tooltip"
									  data-bs-placement="bottom"
									  title="{{ $post->postType->name }}"
								>
									{{ strtoupper(mb_substr($post->postType->name, 0, 1)) }}
								</span>&nbsp;
							@endif
						@endif
						@if (!config('settings.listing.hide_dates'))
							<span class="date"{!! (config('lang.direction')=='rtl') ? ' dir="rtl"' : '' !!}>
								<i class="far fa-clock"></i> {!! $post->created_at_formatted !!}
							</span>
						@endif
						<span class="category"{!! (config('lang.direction')=='rtl') ? ' dir="rtl"' : '' !!}>
							<i class="fas fa-folder"></i>&nbsp;
							@if (isset($post->category->parent) && !empty($post->category->parent))
								<a href="{!! \App\Helpers\UrlGen::category($post->category->parent, null, $city ?? null) !!}" class="info-link">
									{{ $post->category->parent->name }}
								</a>&nbsp;&raquo;&nbsp;
							@endif
							<a href="{!! \App\Helpers\UrlGen::category($post->category, null, $city ?? null) !!}" class="info-link">
								{{ $post->category->name }}
							</a>
						</span>
						<span class="item-location"{!! (config('lang.direction')=='rtl') ? ' dir="rtl"' : '' !!}>
							<i class="fas fa-map-marker-alt"></i>&nbsp;
							<a href="{!! \App\Helpers\UrlGen::city($post->city, null, $cat ?? null) !!}" class="info-link">
								{{ $post->city->name }}
							</a> {{ (isset($post->distance)) ? '- ' . round($post->distance, 2) . getDistanceUnit() : '' }}
						</span>
					</span>
					
					@if (config('plugins.reviews.installed'))
						@if (view()->exists('reviews::ratings-list'))
							@include('reviews::ratings-list')
						@endif
					@endif
				</div>
			</div>
			
			<div class="col-sm-3 col-12 text-end price-box" style="white-space: nowrap;">
				<h2 class="item-price">
					@if (isset($post->category->type))
						@if (!in_array($post->category->type, ['not-salable']))
							@if (is_numeric($post->price) && $post->price > 0)
								{!! \App\Helpers\Number::money($post->price) !!}
							@elseif(is_numeric($post->price) && $post->price == 0)
								{!! t('free_as_price') !!}
							@else
								{!! t('Contact us') !!}
							@endif
						@endif
					@else
						{!! t('Contact us') !!}
					@endif
				</h2>
				@if (isset($post->latestPayment, $post->latestPayment->package) && !empty($post->latestPayment->package))
					@if ($post->latestPayment->package->has_badge == 1)
						<a class="btn btn-danger btn-sm make-favorite">
							<i class="fa fa-certificate"></i> <span>{{ $post->latestPayment->package->short_name }}</span>
						</a>&nbsp;
					@endif
				@endif
				@if (isset($post->savedByLoggedUser) && $post->savedByLoggedUser->count() > 0)
					<a class="btn btn-success btn-sm make-favorite" id="{{ $post->id }}">
						<i class="fa fa-heart"></i> <span>{{ t('Saved') }}</span>
					</a>
				@else
					<a class="btn btn-default btn-sm make-favorite" id="{{ $post->id }}">
						<i class="fa fa-heart"></i> <span>{{ t('Save') }}</span>
					</a>
				@endif
			</div>
		</div>
	</div>
	<?php endforeach; ?>
@else
	<div class="p-4" style="width: 100%;">
		{{ t('no_result_refine_your_search') }}
	</div>
@endif

@section('after_scripts')
	@parent
	<script>
		{{-- Favorites Translation --}}
		var lang = {
			labelSavePostSave: "{!! t('Save ad') !!}",
			labelSavePostRemove: "{!! t('Remove favorite') !!}",
			loginToSavePost: "{!! t('Please log in to save the Ads') !!}",
			loginToSaveSearch: "{!! t('Please log in to save your search') !!}",
			confirmationSavePost: "{!! t('Post saved in favorites successfully') !!}",
			confirmationRemoveSavePost: "{!! t('Post deleted from favorites successfully') !!}",
			confirmationSaveSearch: "{!! t('Search saved successfully') !!}",
			confirmationRemoveSaveSearch: "{!! t('Search deleted successfully') !!}"
		};
	</script>
@endsection
