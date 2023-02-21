<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        if(Auth::check()) {
            return redirect('/account');
        }

        return view('user.auth.login');
    }

    public function loginProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if($validator->fails()) {
            return redirect('/auth/login')->with('alertError', $validator->errors()->first())
                ->withInput();
        }

        $user = User::where('email', $request->email)->first();
        if(is_null($user)) {
            return redirect('auth/login')->with('alertError', 'Email not registered.');
        } else if(!Hash::check($request->password, $user->password)) {
            return redirect('auth/login')->with('alertError', 'The password you entered is incorrect.');
        }

        Auth::login($user);
        return redirect('/')->with('alertSuccess', 'Login successful, welcome back ' . $user->name . '!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('alertSuccess', 'Logout successful!');
    }

    public function register()
    {
        if(Auth::check()) {
            return redirect('/account');
        }

        return view('user.auth.register');
    }

    public function registerProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return redirect('/auth/register')->with('alertError', $validator->errors()->first())->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('auth/login')->with('alertSuccess', 'Register successfully.');
    }

    public function forgotPassword()
    {
        $user = Auth::user();
        return view('user.auth.forgot-password')->with(compact('user'));
    }

    public function forgotPasswordProcess(Request $request)
    {
        $forgot_status = session('forgot_status');
        switch ($forgot_status) {
            case 0:
                $user = User::where('email', $request->email)->first();
                if (is_null($user)) {
                    return redirect('auth/forgot-password')->with('alertError', 'Email not registered.');
                }

                $otp = random_int(100000, 999999);
                $message = "<p>You have just sent a forgot password request, here is the otp code to change your password: <b>{$otp}</b></p>";

                Mail::send([], [], function($mail) use($user, $message) {
                    $mail->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'))
                        ->to($user->email)
                        ->subject('OTP Code Forgot Password')
                        ->setBody($message, 'text/html');
                });

                session()->put('forgot_status', 1);
                session()->put('forgot_email', $user->email);
                session()->put('forgot_otp', $otp);
                return redirect('auth/forgot-password')->with('alertSuccess', 'The OTP code has been sent to your email.');
            case 1:
                $otp = implode('', $request->otp);
                if ($otp != session('forgot_otp')) {
                    return redirect('auth/forgot-password')->with('alertError', 'The OTP code you entered is incorrect.');
                }

                session()->put('forgot_status', 2);
                return redirect('auth/forgot-password')->with('alertSuccess', 'The OTP code is correct, please create your new password.');
            case 2:
                $validator = Validator::make($request->all(), [
                    'password' => 'required|min:5',
                    'confirm_password' => 'required|same:password'
                ]);
                if ($validator->fails()) {
                    return redirect('/auth/forgot-password')->with('alertError', $validator->errors()->first())
                        ->withInput();
                }

                $user = User::where('email', session('forgot_email'))->first();
                $user->password = Hash::make($request->password);
                $user->save();

                session()->forget('forgot_status');
                session()->forget('forgot_email');
                session()->forget('forgot_otp');
                if(Auth::check()) {
                    return redirect('account')->with('alertSuccess', 'The new password was successfully saved.');
                }
                return redirect('auth/login')->with('alertSuccess', 'The new password was successfully saved.');
        }
    }

    public function resendOtp()
    {
        if(empty(session('forgot_status'))) {
            return redirect('auth/forgot-password')->with('alertError', 'The otp code has not been requested.');
        }

        $otp = random_int(100000, 999999);
        $message = "<p>You have just sent a forgot password request, here is the otp code to change your password: <b>{$otp}</b></p>";

        Mail::send([], [], function($mail) use($message) {
            $mail->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'))
                ->to(session('forgot_email'))
                ->subject('OTP Code Forgot Password')
                ->setBody($message, 'text/html');
        });

        session()->put('forgot_otp', $otp);
        return redirect('auth/forgot-password')->with('alertSuccess', 'New OTP code has been sent to your email.');
    }

    public function staffLogin()
    {
        if( Auth::guard('staff')->check() ) {
            return redirect('/staff');
        }

        return view('staff.login');
    }

    public function staffLoginProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()) {
            return redirect('/staff/auth/login')->with('alertError', $validator->errors()->first())
                ->withInput();
        }

        $staff = Staff::where('email', $request->email)->first();
        if(is_null($staff) || !Hash::check($request->password, $staff->password)) {
            return redirect('/staff/auth/login')->with('alertError', 'Incorrect email or password.');
        }

        Auth::guard('staff')->login($staff);
        return redirect('/staff')->with('alertSuccess', 'Login successful, welcome back ' . $staff->name . '!');
    }

    public function staffLogout()
    {
        Auth::guard('staff')->logout();
        return redirect('/staff/auth/login')->with('alertSuccess', 'Logout successful.');
    }
}