@include('staff._partials.header')

<div class="row justify-content-center">
    <div class="col-lg-5 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Settings</h4>
            </div>

            <form action="{{ url('staff/settings/process') }}" method="post">
                @csrf

                <div class="card-body">
                    <div class="mb-1">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" readonly />
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" />
                    </div>
                    <div class="alert alert-primary" role="alert">
                        <div class="alert-body">
                            Enter it below if you want to change the password!
                        </div>
                    </div>
                    <div class="mb-1">
                        <label class="form-label">New Password</label>
                        <div class="input-group form-password-toggle">
                            <input type="password" name="password" class="form-control" placeholder="Enter if you want to change the password!" id="basic-default-password" value="{{ old('password') }}" />
                            <span class="input-group-text cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Re-type New Password</label>
                        <div class="input-group form-password-toggle">
                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirmation new password" id="basic-default-password" value="{{ old('confirm_password') }}" />
                            <span class="input-group-text cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-0">
                        <label class="form-label">Password Confirmation</label>
                        <div class="input-group form-password-toggle">
                            <input type="password" name="password_account" class="form-control" placeholder="Your Password" id="basic-default-password" value="{{ old('password_account') }}" />
                            <span class="input-group-text cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></span>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-end">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('staff._partials.footer')