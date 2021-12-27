@if (isset($cats) && $cats->count() > 0)
	<div class="row row-cols-lg-4 row-cols-md-3 p-2 g-2" id="categoryBadge">
		@foreach ($cats as $iCat)
			<div class="col">
				@if (isset($cat) && !empty($cat) && $iCat->id == $cat->id)
					<span class="fw-bold">{{ $iCat->name }}</span>
				@else
					<a href="{{ \App\Helpers\UrlGen::category($iCat, null, $city ?? null) }}">
						{{ $iCat->name }}
					</a>
				@endif
			</div>
		@endforeach
	</div>
@endif