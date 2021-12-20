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
<style>
	.alert {
    display:none;
}
</style>



@section('content')
	
	<div class="">

		<div class="row">
			<div class="col-md-12">
				<h2 class="categories_list_by_coach"  style="text-align:center;">All coaches </h2>
			</div>
		</div>
		<div class="row">
			<ul>
				<?php
				 foreach($user as $cat) { ?>
					<li id="cat_name_<?php echo $cat->name?>" class="col-lg-12 col-md-3 col-sm-4 col-6 cat_show_list">
						
							<h4>
								<?php 
								$name = $cat->name;
								// $idd= $cat->id;

								// print_r($idd);
								$ss = array();
								
							
								// foreach ($name as $key => $sub) {
								// 	$ss[$key] = $sub;
								// }
								?>
								<a href="{{url('/coach_details/'.$cat->id) }}">
								<img src="{{url('/coach_details/'.$cat->id) }}" class="lazyload img-fluid" alt="{{ $cat->name }}">
							
								</a>
							</h4>
							

						
						
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>


@endsection

