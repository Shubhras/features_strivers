<aside>
	<div class="inner-box">
		<div class="user-panel-sidebar user_sidebar_coach_strivre">


			<div class="collapse-box">
				<a {!! ($pagePath=='' ) ? 'class="active"' : '' !!} href="{{ url('account/dashboard') }}">
					<h5 class="collapse-title no-border">
						<i class="fas fa-th-list"></i> {{ t('dashboard') }}&nbsp;

					</h5>

				</a>
			</div>


			<div class="collapse-box" id="MyClassified">
				<a {!! ($pagePath=='' ) ? 'class="active"' : '' !!} href="{{ url('account/my_striver') }}">
					<h5 class="collapse-title no-border">
						<!-- <i class="fas fa-user-edit"></i> -->
						{{ ('My Strivers') }}&nbsp;

					</h5>
				</a>
			</div>

			<div class="collapse-box" id="MyClassified">
				<a {!! ($pagePath=='' ) ? 'class="active"' : '' !!} href="{{ url('account/my_courses') }}">
					<h5 class="collapse-title no-border">
						<!-- <i class="fas fa-user-edit"></i> -->
						{{ t('my_courses') }}&nbsp;

					</h5>
				</a>
			</div>

			<div class="collapse-box" id="">
				<a {!! ($pagePath=='' ) ? 'class="active"' : '' !!} href="{{ url('account/my_payments') }}">
					<h5 class="collapse-title no-border">
						<!-- <i class="fas fa-user-edit"></i> -->
						{{ ('My payments') }}&nbsp;

					</h5>
				</a>
			</div>

			

			<div class="collapse-box" id="MyClassified">
				<a {!! ($pagePath=='' ) ? 'class="active"' : '' !!} href="{{ url('account') }}">
					<h5 class="collapse-title no-border">
						<!-- <i class="fas fa-user-edit"></i> -->
						{{ t('Edit_Profile') }}&nbsp;

					</h5>
				</a>
			</div>

		</div>
	</div>
	<!-- /.inner-box  -->
</aside>