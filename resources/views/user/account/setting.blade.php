@include('user._partials.header')

<div class="content-box">
    <div class="content-page mx-0 px-0">
        <div class="content p-4">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-md-6 col-lg-5 col-xl-4">
                    <div class="card">
                        <div class="card-header text-center">
                            <span class="text-title">Setting your account</span>
                        </div>
                        <div class="card-body">
                            <form method="POST" autocomplete="off" action="{{ url('account/setting/process') }}">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" autocomplete="false">
                                </div>

                                <div class="alert alert-primary" role="alert">Enter it below if you want to change the password!</div>
                                <div class="mb-3">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="password" class="form-control form-control-merge" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <span class="input-group-text cursor-pointer"><ion-icon name="eye-outline"></ion-icon></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Re-type New Password</label>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="password" class="form-control form-control-merge" name="confirm_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <span class="input-group-text cursor-pointer"><ion-icon name="eye-outline"></ion-icon></span>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="form-label d-flex justify-content-between">
                                        Password Confirmation
                                        <a href="{{ url('auth/forgot-password') }}" class="text-primary fw-light">Forgot password?</a>
                                    </label>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="password" class="form-control form-control-merge" name="password_account" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <span class="input-group-text cursor-pointer"><ion-icon name="eye-outline"></ion-icon></span>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

		@include('user._partials.footer')
	</div>
</div>

@include('user._partials.js')