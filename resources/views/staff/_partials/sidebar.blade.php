@php $routeName = request()->route()->getName(); @endphp

	<!-- BEGIN: Main Menu-->
	<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
		<div class="navbar-header">
			<ul class="nav navbar-nav flex-row">
				<li class="nav-item me-auto">
					<a class="navbar-brand" href="{{ url('staff/') }}">
						<span class="brand-logo">
							<h2 class="brand-text text-uppercase px-0" style="font-size: 1.3rem;">Bisokop Admin</h2>
					</a>
				</li>
				<li class="nav-item nav-toggle">
					<a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
						<i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
						<i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc"
							data-ticon="disc"></i>
					</a>
				</li>
			</ul>
		</div>
		<div class="shadow-bottom"></div>
		<div class="main-menu-content">
			<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
				<li class="nav-item {{ $routeName == 'staff dashboard' ? 'active' : '' }}">
					<a class="d-flex align-items-center" href="{{ url('staff/') }}">
						<i data-feather="home"></i>
						<span class="menu-title text-truncate" data-i18n="Home Page">Home Page</span>
					</a>
				</li>
				@if($user->role === 'Admin')
				<li class="nav-item {{ $routeName == 'staff data' ? 'active' : '' }}">
					<a class="d-flex align-items-center" href="{{ url('staff/staff-data') }}">
						<i data-feather="user-check"></i>
						<span class="menu-title text-truncate" data-i18n="Staff">Staff</span>
					</a>
				</li>
				<li class="nav-item {{ $routeName == 'users staff' ? 'active' : '' }}">
					<a class="d-flex align-items-center" href="{{ url('staff/users') }}">
						<i data-feather="users"></i>
						<span class="menu-title text-truncate" data-i18n="Users">Users</span>
					</a>
				</li>
				<li class="navigation-header"></li>
				<li class="nav-item {{ $routeName == 'film staff' ? 'active' : '' }}">
					<a class="d-flex align-items-center" href="{{ url('staff/films') }}">
						<i data-feather="film"></i>
						<span class="menu-title text-truncate" data-i18n="Film">Film</span>
					</a>
				</li>
				<li class="nav-item {{ $routeName == 'theater staff' ? 'active' : '' }}">
					<a class="d-flex align-items-center" href="{{ url('staff/theater') }}">
						<i data-feather="calendar"></i>
						<span class="menu-title text-truncate" data-i18n="theater">Theater</span>
					</a>
				</li>
				<li class="nav-item {{ $routeName == 'schedule staff' ? 'active' : '' }}">
					<a class="d-flex align-items-center" href="{{ url('staff/schedule') }}">
						<i data-feather="calendar"></i>
						<span class="menu-title text-truncate" data-i18n="Ticket Schedules">Ticket Schedules</span>
					</a>
				</li>
				<li class="navigation-header"></li>
				@endif
				<li class="nav-item {{ $routeName == 'transactions staff' ? 'active' : '' }}">
					<a class="d-flex align-items-center" href="{{ url('staff/transactions') }}">
						<i data-feather="file-text"></i>
						<span class="menu-title text-truncate" data-i18n="Transactions">Transactions</span>
					</a>
				</li>
				<li class="nav-item {{ $routeName == 'payment-method staff' ? 'active' : '' }}">
					<a class="d-flex align-items-center" href="{{ url('staff/payment-method/') }}">
						<i data-feather="credit-card"></i>
						<span class="menu-title text-truncate" data-i18n="Payment Method">Payment Method</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<!-- END: Main Menu-->