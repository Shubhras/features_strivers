<aside>

	<!-- /.inner-box  -->
	

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
					<div class="ms-3 lh-1">
						<h5 class="mb-1 ">Coach Dashboard</h5>
					</div>
				</div>
			</div>
			<div class="py-4 p-md-4 ">
				<!-- <span class="heading ">Account</span> -->
				<ul class="list-unstyled mb-4 mt-2">
					<li class="nav-item " id="MyClassified">
					<a {!! ($pagePath=='' ) ? 'class="active"' : '' !!} href="{{ url('account/dashboard') }}">
					{{ t('dashboard') }}&nbsp;

					

				</a>
					</li>
					<li class="nav-item " id="MyClassified">
					<a {!! ($pagePath=='' ) ? 'class="active"' : '' !!} href="{{ url('account') }}">{{ t('Edit_Profile') }}</a>
					</li>
					<li class="nav-item" id="MyClassified">
					<a {!! ($pagePath=='' ) ? 'class="active"' : '' !!} href="{{ url('account/my_striver') }}">{{ ('My Strivers') }}</a>
					</li>
					<li class="nav-item " id="MyClassified">
					<a {!! ($pagePath=='' ) ? 'class="active"' : '' !!} href="{{ url('account/my_courses') }}">Consultation</a>
					</li>
					<li class="nav-item " id="MyClassified">
					<a {!! ($pagePath=='' ) ? 'class="active"' : '' !!} href="{{ url('account/my_payments') }}">{{ ('My payments') }}</a>
					</li>
				   
				</ul>
			   
			</div>
		</div>
	</div>
</nav>



</aside>