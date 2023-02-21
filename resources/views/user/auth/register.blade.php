@include('user._partials.header')

<div class="content-box">
    <div class="content-page mx-0 px-0">
        <div class="content p-4">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-md-6 col-lg-5 col-xl-4">
                    <div class="card">
                        <div class="card-header text-center">
                            <span class="text-title">Create an account</span>
                        </div>
                        
                        <div class="card-body">
                            <form method="POST" id="formLogin" action="{{ url('auth/register/registerProcess') }}">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Your Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="password" class="form-control form-control-merge" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" value="{{ old('password') }}"/>
                                        <span class="input-group-text cursor-pointer"><ion-icon name="eye-outline"></ion-icon></span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Re-type Password</label>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="password" class="form-control form-control-merge" name="confirm_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" value="{{ old('confirm_password') }}"/>
                                        <span class="input-group-text cursor-pointer"><ion-icon name="eye-outline"></ion-icon></span>
                                    </div>
                                </div>
                                
                                <div class="d-grid gap-2 mb-3">
                                    <button type="submit" class="btn btn-primary">REGISTER</button>
                                </div>
                                <p class="mb-0">Have already an account? <a href="{{ url('auth/login') }}" class="text-primary">Login here</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

		@include('user._partials.footer')
	</div>
</div>

@if (session('redirect'))
    <script>Swal.fire("Autentikasi Dibutuhkan, Silahkan Login.", "", "info")</script>
@endif
@include('user._partials.js')