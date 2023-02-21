<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountStaffController extends Controller
{
    public function settings()
    {
        $user = Auth::guard('staff')->user();
        return view('staff.settings')->with(compact('user'));
    }

    public function settingProcess(Request $request)
    {
        $user = Auth::guard('staff')->user();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password_account' => 'required',
        ]);
        if($validator->fails()) {
            return redirect('/staff/settings')->with('alertError', $validator->errors()->first())
                ->withInput();
        }

        if(!empty($request->password) && empty($request->confirm_password)) {
            return redirect('staff/settings')->with('alertError', 'The confirm password field is required.');
        } else if(!empty($request->password) && $request->password != $request->confirm_password) {
            return redirect('staff/settings')->with('alertError', 'Password with incorrect password confirmation.');
        } else if(!Hash::check($request->password_account, $user->password)) {
            return redirect('staff/settings')->with('alertError', 'Your account password is wrong.');
        }

        $user->name = $request->name;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('staff/settings')->with('alertSuccess', 'Changes saved successfully!');
    }
}
