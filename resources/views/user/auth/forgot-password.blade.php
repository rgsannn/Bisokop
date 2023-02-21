@include('user._partials.header')

<div class="content-box">
    <div class="content-page mx-0 px-0">
        <div class="content p-4">
            @if(empty(session('forgot_status')))
                <div class="row justify-content-center">
                    <div class="col-sm-10 col-md-6 col-lg-5 col-xl-4">
                        <div class="card">
                            <div class="card-header text-center">
                                <span class="text-title">Forgot password</span>
                            </div>
                            <div class="card-body">
                                <p>Enter your email and we'll send you instructions to reset your password</p>
                                <form method="POST" action="{{ url('auth/forgot-password/forgotPasswordProcess') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                    <div class="d-grid gap-2 mb-4">
                                        <button type="submit" class="btn btn-primary">SEND OTP</button>
                                    </div>

                                    <p class="text-center mb-0">
                                        <a href="{{ url('auth/login') }}" class="text-primary align-items-center d-flex justify-content-center gap-1"><ion-icon name="chevron-back-outline"></ion-icon> Back to login</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @elseif(session('forgot_status') == 1)
                <div class="row justify-content-center mt-3">
                    <div class="col-sm-10 col-md-6 col-lg-5 col-xl-4">
                        <div class="card">
                            <div class="card-header text-center">
                                <span class="text-title">Two Step Verification</span>
                            </div>
                            <div class="card-body">
                                <p>We sent a verification code to your email. Enter the code from the email in the field below.</p>
                                <form method="POST" action="{{ url('auth/forgot-password/forgotPasswordProcess') }}">
                                    @csrf
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Type your 6 digit security code</label>
                                        <div class="auth-input-wrapper d-flex align-items-center justify-content-between">
                                            <input type="text" class="form-control auth-input text-center numeral-mask mx-25" name="otp[]" maxlength="1" autofocus="">

                                            <input type="text" class="form-control auth-input text-center numeral-mask mx-25" name="otp[]" maxlength="1">

                                            <input type="text" class="form-control auth-input text-center numeral-mask mx-25" name="otp[]" maxlength="1">

                                            <input type="text" class="form-control auth-input text-center numeral-mask mx-25" name="otp[]" maxlength="1">

                                            <input type="text" class="form-control auth-input text-center numeral-mask mx-25" name="otp[]" maxlength="1">

                                            <input type="text" class="form-control auth-input text-center numeral-mask mx-25" name="otp[]" maxlength="1">
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2 mb-4">
                                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                                    </div>

                                    <p class="text-center mb-0">Didn’t get the code? <a href="{{ url('auth/forgot-password/resendOTP') }}" class="text-primary">Resend</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @elseif(session('forgot_status') == 2)
                <div class="row justify-content-center mt-3">
                    <div class="col-sm-10 col-md-6 col-lg-5 col-xl-4">
                        <div class="card">
                            <div class="card-header text-center">
                                <span class="text-title">Reset your password</span>
                            </div>
                            <div class="card-body">
                                <p>Your new password must be different from previously used passwords</p>
                                <form method="POST" action="{{ url('auth/forgot-password/forgotPasswordProcess') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input type="password" class="form-control form-control-merge" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                            <span class="input-group-text cursor-pointer"><ion-icon name="eye-outline"></ion-icon></span>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Re-type Password</label>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input type="password" class="form-control form-control-merge" name="confirm_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                            <span class="input-group-text cursor-pointer"><ion-icon name="eye-outline"></ion-icon></span>
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2 mb-4">
                                        <button type="submit" class="btn btn-primary">SET NEW PASSWORD</button>
                                    </div>
                                    <p class="text-center mb-0">
                                        <a href="{{ url('auth/login') }}" class="text-primary align-items-center d-flex justify-content-center gap-1"><ion-icon name="chevron-back-outline"></ion-icon> Back to login</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
		@include('user._partials.footer')
	</div>
</div>

@if (session('redirect'))
    <script>Swal.fire("Autentikasi Dibutuhkan, Silahkan Login.", "", "info")</script>
@endif
@include('user._partials.js')