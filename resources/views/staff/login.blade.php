<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
	<meta name="author" content="RGSann - https://im-rgsan.com">
	<title>{{ env('APP_NAME') }}</title>
	<link rel="shortcut icon" href="{{ url('assets/logo-bisokop.png') }}" type="image/x-icon">
	
    <link rel="shortcut icon"
		href="https://pixinvent.com/demo/vuexy-html-bootstrap-staff-template/app-assets/images/ico/favicon.ico"
		type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('assets/staff/vendors/css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('assets/staff/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/staff/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/staff/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/staff/css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/staff/css/themes/dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/staff/css/themes/bordered-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/staff/css/themes/semi-dark-layout.min.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('assets/staff/css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/staff/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/staff/css/pages/authentication.css') }}">
    <!-- END: Page CSS-->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('assets/staff/css/style.css') }}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <div class="auth-wrapper auth-basic px-2">
                    <div class="auth-inner my-2">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="brand-logo">
                                    <h2 class="brand-text text-primary ms-1">BISOKOP</h2>
                                </div>
                                <form class="auth-login-form mt-2" method="POST" action="{{ url('staff/auth/staffLoginProcess') }}">
                                    @csrf

                                    <div class="mb-1">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" tabindex="1" autofocus />
                                    </div>

                                    <div class="mb-1">
                                        <label class="form-label">Password</label>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input type="password" class="form-control form-control-merge" name="password" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100" tabindex="3">Sign in</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- BEGIN: Vendor JS-->
    <script src="{{ url('assets/staff/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ url('assets/staff/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ url('assets/staff/js/core/app-menu.min.js') }}"></script>
    <script src="{{ url('assets/staff/js/core/app.min.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ url('assets/staff/js/scripts/pages/auth-login.js') }}"></script>
    <!-- END: Page JS-->

    @if(session('alertSuccess'))
        <script>Swal.fire('Success!', `{{ session('alertSuccess') }}`, 'success');</script>
    
    @elseif(session('alertError'))
        <script>Swal.fire('Error', `{{ session('alertError') }}`, 'error');</script>
    @endif

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
</html>