<?php
// Search parameters
$queryString = (request()->getQueryString() ? ('?' . request()->getQueryString()) : '');

// Check if the Multi-Countries selection is enabled
$multiCountriesIsEnabled = false;
$multiCountriesLabel = '';

// Logo Label
$logoLabel = '';
if (request()->segment(1) != 'countries') {
	if (isset($multiCountriesIsEnabled) && $multiCountriesIsEnabled) {
		$logoLabel = config('settings.app.name') . ((!empty(config('country.name'))) ? ' ' . config('country.name') : '');
	}
}
?>
<div class="header">
	<nav class="navbar fixed-top navbar-site navbar-light bg-light navbar-expand-md" role="navigation">
        <div class="container">
			
			<div class="navbar-identity p-sm-0">
				{{-- Logo --}}
				<a href="{{ url('/') }}" class="navbar-brand logo logo-title">
					<img src="{{ imgUrl(config('settings.app.logo', config('larapen.core.logo')), 'logo') }}" class="main-logo" />
				</a>
				{{-- Toggle Nav (Mobile) --}}
				<button class="navbar-toggler -toggler float-end"
						type="button"
						data-bs-toggle="collapse"
						data-bs-target="#navbarsDefault"
						aria-controls="navbarsDefault"
						aria-expanded="false"
						aria-label="Toggle navigation"
				>
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30" focusable="false">
						<title>{{ t('Menu') }}</title>
						<path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"></path>
					</svg>
				</button>
				{{-- Country Flag (Mobile) --}}
				@if (request()->segment(1) != 'countries')
					@if (isset($multiCountriesIsEnabled) && $multiCountriesIsEnabled)
						@if (!empty(config('country.icode')))
							@if (file_exists(public_path() . '/images/flags/24/' . config('country.icode') . '.png'))
								<button class="flag-menu country-flag d-block d-md-none btn btn-secondary hidden float-end" href="#selectCountry" data-bs-toggle="modal">
									<img src="{{ url('images/flags/24/'.config('country.icode').'.png') . getPictureVersion() }}"
										 alt="{{ config('country.name') }}"
										 style="float: left;"
									>
									<span class="caret hidden-xs"></span>
								</button>
							@endif
						@endif
					@endif
				@endif
            </div>
			
			<div class="navbar-collapse collapse" id="navbarsDefault">
				<ul class="nav navbar-nav me-md-auto navbar-left">
					{{-- Country Flag --}}
					@if (request()->segment(1) != 'countries')
						@if (config('settings.geo_location.country_flag_activation'))
							@if (!empty(config('country.icode')))
								@if (file_exists(public_path() . '/images/flags/32/' . config('country.icode') . '.png'))
									<li class="flag-menu country-flag hidden-xs nav-item"
										data-bs-toggle="tooltip"
										data-bs-placement="{{ (config('lang.direction') == 'rtl') ? 'bottom' : 'right' }}"
									>
										@if (isset($multiCountriesIsEnabled) && $multiCountriesIsEnabled)
											<a class="nav-link p-0" data-bs-toggle="modal" data-bs-target="#selectCountry">
												<img class="flag-icon"
													 src="{{ url('images/flags/32/' . config('country.icode') . '.png') . getPictureVersion() }}"
													 alt="{{ config('country.name') }}"
												>
												<span class="caret d-block float-end mt-3 mx-1 hidden-sm"></span>
											</a>
										@else
											<a class="p-0" style="cursor: default;">
												<img class="flag-icon"
													 src="{{ url('images/flags/32/' . config('country.icode') . '.png') . getPictureVersion() }}"
													 alt="{{ config('country.name') }}"
												>
											</a>
										@endif
									</li>
								@endif
							@endif
						@endif
					@endif
				</ul>
				
				<ul class="nav navbar-nav ms-auto navbar-right">
                    @if (!auth()->check())
                        <li class="nav-item">
							<a href="{{ \App\Helpers\UrlGen::login() }}" class="nav-link">
								<i class="fas fa-user"></i> {{ t('log_in') }}
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{ \App\Helpers\UrlGen::login() }}" class="nav-link">
								<i class="fas fa-user-plus"></i> {{ t('register') }}
							</a>
						</li>
                    @else
                        <li class="nav-item">
							@if (app('impersonate')->isImpersonating())
								<a href="{{ route('impersonate.leave') }}" class="nav-link">
									<i class="fas fa-sign-out-alt hidden-sm"></i> {{ t('Leave') }}
								</a>
							@else
								<a href="{{ \App\Helpers\UrlGen::logout() }}" class="nav-link">
									<i class="glyphicon glyphicon-off"></i> {{ t('log_out') }}
								</a>
							@endif
						</li>
						<li class="nav-item dropdown no-arrow">
							<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
								<i class="far fa-user-circle hidden-sm"></i>
                                <span>{{ auth()->user()->name }}</span>
								<i class="fas fa-chevron-down"></i>
                            </a>
							<ul id="userMenuDropdown" class="dropdown-menu user-menu dropdown-menu-right shadow-sm">
                                <li class="dropdown-item active">
                                    <a href="{{ url('account') }}">
                                        <i class="fas fa-user-edit"></i> {{ t('Personal Home') }}
                                    </a>
                                </li>
                                <li class="dropdown-item">
									<a href="{{ url('account/my-posts') }}">
										<i class="fas fa-th-list"></i> {{ t('my_ads') }}
									</a>
								</li>
                                <li class="dropdown-item">
									<a href="{{ url('account/favourite') }}">
										<i class="fas fa-heart"></i> {{ t('favourite_ads') }}
									</a>
								</li>
                                <li class="dropdown-item">
									<a href="{{ url('account/saved-search') }}">
										<i class="fas fa-bookmark"></i> {{ t('Saved searches') }}
									</a>
								</li>
                                <li class="dropdown-item">
									<a href="{{ url('account/pending-approval') }}">
										<i class="fas fa-hourglass-half"></i> {{ t('pending_approval') }}
									</a>
								</li>
                                <li class="dropdown-item">
									<a href="{{ url('account/archived') }}">
										<i class="fas fa-calendar-times"></i> {{ t('archived_ads') }}
									</a>
								</li>
                                <li class="dropdown-item">
									<a href="{{ url('account/messages') }}">
										<i class="far fa-envelope"></i> {{ t('messenger') }}
									</a>
								</li>
                                <li class="dropdown-item">
									<a href="{{ url('account/transactions') }}">
										<i class="fas fa-coins"></i> {{ t('Transactions') }}
									</a>
								</li>
                            </ul>
                        </li>
                    @endif
					
					<li class="nav-item postadd">
						@if (!auth()->check())
							@if (config('settings.single.guests_can_post_ads') != '1')
								<a class="btn btn-block btn-border btn-post btn-add-listing" href="#quickLogin" data-bs-toggle="modal">
									<i class="fa fa-plus-circle"></i> {{ t('Add Listing') }}
								</a>
							@else
								<a class="btn btn-block btn-border btn-post btn-add-listing" href="{{ \App\Helpers\UrlGen::addPost(true) }}">
									<i class="fa fa-plus-circle"></i> {{ t('Add Listing') }}
								</a>
							@endif
						@else
							<a class="btn btn-block btn-border btn-post btn-add-listing" href="{{ \App\Helpers\UrlGen::addPost(true) }}">
								<i class="fa fa-plus-circle"></i> {{ t('Add Listing') }}
							</a>
						@endif
					</li>
					
                    @if (!empty(config('lang.abbr')))
                        @if (is_array(getSupportedLanguages()) && count(getSupportedLanguages()) > 1)
							{{-- Language Selector --}}
							<li class="dropdown lang-menu nav-item">
								<button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" id="langDropdown">
									<span class="lang-title">{{ strtoupper(config('app.locale')) }}</span>
                                </button>
								<ul id="langDropdownItems" class="dropdown-menu dropdown-menu-right user-menu shadow-sm" role="menu" aria-labelledby="langDropdown">
                                    @foreach(getSupportedLanguages() as $langCode => $lang)
										@continue(strtolower($langCode) == strtolower(config('app.locale')))
										<li class="dropdown-item">
											<a href="{{ url('lang/' . $langCode) }}" tabindex="-1" rel="alternate" hreflang="{{ $langCode }}">
												<span class="lang-name">{{{ $lang['native'] }}}</span>
											</a>
										</li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>