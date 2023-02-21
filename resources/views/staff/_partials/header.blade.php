<!DOCTYPE html>
<html class="loading" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
	<meta name="description" content="...">
	<meta name="keywords" content="...">
	<meta name="author" content="...">

	<title>Bisokop Admin</title>
	<link rel="shortcut icon" href="{{ url('assets/logo-bisokop.png') }}" type="image/x-icon">

	<link rel="apple-touch-icon" href="{{ url('assets/staff') }}/images/ico/apple-icon-120.html">
	<link rel="shortcut icon"
		href="https://pixinvent.com/demo/vuexy-html-bootstrap-staff-template/app-assets/images/ico/favicon.ico"
		type="image/x-icon">
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600">

	<!-- BEGIN: Vendor CSS-->
	<link rel="stylesheet" type="text/css" href="{{ url('assets/staff') }}/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/staff') }}/vendors/css/charts/apexcharts.css">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/staff') }}/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/staff') }}/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/staff') }}/vendors/css/extensions/swiper.min.css">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/staff') }}/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/staff') }}/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/staff') }}/vendors/css/pickers/flatpickr/flatpickr.min.css">
	<!-- END: Vendor CSS-->

	<!-- BEGIN: Theme CSS-->
	<link rel="stylesheet" type="text/css" href="{{ url('assets/staff') }}/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/staff') }}/css/bootstrap-extended.min.css">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/staff') }}/css/colors.min.css">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/staff') }}/css/components.min.css">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/staff') }}/css/themes/dark-layout.min.css">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/staff') }}/css/themes/semi-dark-layout.min.css">
	<!-- END: Theme CSS-->

	<!-- BEGIN: Page CSS-->
	<link rel="stylesheet" type="text/css" href="{{ url('assets/staff') }}/css/core/menu/menu-types/vertical-menu.min.css">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/staff') }}/css/plugins/extensions/ext-component-swiper.min.css">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/staff') }}/css/plugins/extensions/ext-component-sweet-alerts.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/staff') }}/css/plugins/charts/chart-apex.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/staff') }}/css/plugins/forms/pickers/form-flat-pickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/staff') }}/css/plugins/forms/pickers/form-pickadate.min.css">
	<!-- END: Page CSS-->

	<!-- BEGIN: Custom CSS-->
	<link rel="stylesheet" type="text/css" href="{{ url('assets/staff') }}/css/style.css">
	<!-- END: Custom CSS-->
</head>

<body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click"
	data-menu="vertical-menu-modern" data-col="content-right-sidebar">

	<!-- BEGIN: Header-->
	<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
		<div class="navbar-container d-flex content">
			<div class="bookmark-wrapper d-flex align-items-center">
				<ul class="nav navbar-nav d-xl-none">
					<li class="nav-item">
						<a class="nav-link menu-toggle" href="#">
							<i class="ficon" data-feather="menu"></i>
						</a>
					</li>
				</ul>
			</div>
			<ul class="nav navbar-nav align-items-center ms-auto">
				<li class="nav-item dropdown dropdown-user">
					<a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#"
						data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<div class="user-nav d-sm-flex d-none">
							<span class="user-name fw-bolder">{{ $user->name }}</span>
							<span class="user-status">Admin</span>
						</div>
						<span class="avatar">
							<img class="round" src="{{ url('assets/staff') }}/images/portrait/small/avatar-s-11.jpg" alt="avatar"
								height="40" width="40">
						</span>
					</a>
					<div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
						<a class="dropdown-item" href="{{ url('staff/settings') }}">
							<i class="me-50" data-feather="settings"></i> Settings
						</a>
						<a class="dropdown-item" href="{{ url('staff/auth/logout') }}">
							<i class="me-50" data-feather="power"></i> Logout
						</a>
					</div>
				</li>
			</ul>
		</div>
	</nav>
	<!-- END: Header-->

    @include('staff._partials.sidebar')

    <!-- BEGIN: Content-->
	<div class="app-content content">
		<div class="content-overlay"></div>
		<div class="header-navbar-shadow"></div>
		<div class="content-wrapper">
			<div class="content-header row"></div>