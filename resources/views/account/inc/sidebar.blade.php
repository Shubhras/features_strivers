<aside>
	<div class="inner-box">
		<div class="user-panel-sidebar">

			<div class="collapse-box">
				<h5 class="collapse-title no-border">
					{{ t('My Account') }}&nbsp;
					<a href="#MyClassified" data-bs-toggle="collapse" class="float-end"><i class="fa fa-angle-down"></i></a>
				</h5>
				<div class="panel-collapse collapse show" id="MyClassified">
					<ul class="acc-list">
						<li>
							<a {!! ($pagePath=='') ? 'class="active"' : '' !!} href="{{ url('account') }}">
								<i class="fas fa-user-edit"></i> {{ t('Personal Home') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
			<!-- /.collapse-box  -->

			<div class="collapse-box">
				<h5 class="collapse-title">
					{{ t('my_ads') }}
					<a href="#MyAds" data-bs-toggle="collapse" class="float-end"><i class="fa fa-angle-down"></i></a>
				</h5>
				<div class="panel-collapse collapse show" id="MyAds">
					<ul class="acc-list">
						<li>
							<a{!! ($pagePath=='my-posts') ? ' class="active"' : '' !!} href="{{ url('account/my-posts') }}">
							<i class="fas fa-th-list"></i> {{ t('my_ads') }}&nbsp;
							<span class="badge badge-pill">
								{{ isset($countMyPosts) ? \App\Helpers\Number::short($countMyPosts) : 0 }}
							</span>
							</a>
						</li>
						<li>
							<a{!! ($pagePath=='favourite') ? ' class="active"' : '' !!} href="{{ url('account/favourite') }}">
							<i class="fas fa-heart"></i> {{ t('favourite_ads') }}&nbsp;
							<span class="badge badge-pill">
								{{ isset($countFavouritePosts) ? \App\Helpers\Number::short($countFavouritePosts) : 0 }}
							</span>
							</a>
						</li>
						<li>
							<a{!! ($pagePath=='saved-search') ? ' class="active"' : '' !!} href="{{ url('account/saved-search') }}">
							<i class="fas fa-bookmark"></i> {{ t('Saved searches') }}&nbsp;
							<span class="badge badge-pill">
								{{ isset($countSavedSearch) ? \App\Helpers\Number::short($countSavedSearch) : 0 }}
							</span>
							</a>
						</li>
						<li>
							<a{!! ($pagePath=='pending-approval') ? ' class="active"' : '' !!} href="{{ url('account/pending-approval') }}">
							<i class="fas fa-hourglass-half"></i> {{ t('pending_approval') }}&nbsp;
							<span class="badge badge-pill">
								{{ isset($countPendingPosts) ? \App\Helpers\Number::short($countPendingPosts) : 0 }}
							</span>
							</a>
						</li>
						<li>
							<a{!! ($pagePath=='archived') ? ' class="active"' : '' !!} href="{{ url('account/archived') }}">
							<i class="fas fa-calendar-times"></i> {{ t('archived_ads') }}&nbsp;
							<span class="badge badge-pill">
								{{ isset($countArchivedPosts) ? \App\Helpers\Number::short($countArchivedPosts) : 0 }}
							</span>
							</a>
						</li>
						<li>
							<a {!! ($pagePath=='messenger') ? 'class="active" ' : '' !!}href="{{ url('account/messages') }}">
							<i class="far fa-envelope"></i> {{ t('messenger') }}&nbsp;
							<span class="badge badge-pill count-threads-with-new-messages hide">0</span>
							</a>
						</li>
						<li>
							<a{!! ($pagePath=='transactions') ? ' class="active"' : '' !!} href="{{ url('account/transactions') }}">
							<i class="fas fa-coins"></i> {{ t('Transactions') }}&nbsp;
							<span class="badge badge-pill">
								{{ isset($countTransactions) ? \App\Helpers\Number::short($countTransactions) : 0 }}
							</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<!-- /.collapse-box  -->

			<div class="collapse-box">
				<h5 class="collapse-title">
					{{ t('Terminate Account') }}&nbsp;
					<a href="#TerminateAccount" data-bs-toggle="collapse" class="float-end"><i class="fa fa-angle-down"></i></a>
				</h5>
				<div class="panel-collapse collapse show" id="TerminateAccount">
					<ul class="acc-list">
						<li>
							<a {!! ($pagePath=='close') ? 'class="active"' : '' !!} href="{{ url('account/close') }}">
								<i class="fas fa-times-circle"></i> {{ t('Close account') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
			<!-- /.collapse-box  -->

		</div>
	</div>
	<!-- /.inner-box  -->
</aside>