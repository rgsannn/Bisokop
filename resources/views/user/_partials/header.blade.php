@php $routeName = request()->route()->getName(); @endphp
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ env('APP_NAME') }}</title>
	<link rel="shortcut icon" href="{{ url('assets/logo-bisokop.png') }}" type="image/x-icon">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ asset('user/vendor/owlcarousel/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('user/vendor/owlcarousel/owl.theme.default.min.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
	<link rel="stylesheet" href="{{ asset('user/css/style.css?v=' . time()) }}">
</head>

<body>

	<div class="main-wrapper">
		<div class="loader-container">
			<div class="loader">
				<span class="loader-done"></span>
				<span class="circle c1"></span>
				<span class="circle c2"></span>
				<span class="circle c3"></span>
			</div>
		</div>

		@if ($routeName !== 'users listSeat' && $routeName !== 'users confirmFilm')
			<nav class="bg-white d-flex justify-content-between align-items-center p-3">
				<a href="{{ url('') }}" class="mx-2 nav-title text-uppercase">
					{{ env('APP_NAME') }}
				</a>

				<ul class="navbar-nav ms-auto">
					@if(Auth::check())
						<li class="nav-item">
							<a class="nav-link" href="{{ url('') }}">HOME</a>
						</li>

						<li class="nav-item dropdown dropdown-user">
							<a class="profile nav-link dropdown-toggle dropdown-user-link show" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								<ion-icon name="person-circle-outline"></ion-icon>
							</a>
							<div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user" data-bs-popper="none">
								<small class="dropdown-item">Hi, {{ $user->name }}</small>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{ url('account/') }}">Transactions</a>
								<a class="dropdown-item" href="{{ url('account/setting') }}">Settings</a>
								<a class="dropdown-item" href="javascript:logout();">Logout</a>
							</div>
						</li>
						
					@else
						<li class="nav-item">
							<a class="nav-link" href="{{ url('auth/login') }}">LOGIN</a>
						</li>
					@endif
				</ul>

				@if (isset($_SESSION['pegawai']) && $routeName != 'User')
					<a href="#" onclick="logout()" class="profile text-dark">
						<ion-icon name="person-circle-outline"></ion-icon>
						<div>
							<header>
								<?= $DataPegawai['nama'] ?>
							</header>
							<footer>
								<?= $DataPegawai['level'] ?>
							</footer>
						</div>
					</a>
				@endif
			</nav>
		@endif