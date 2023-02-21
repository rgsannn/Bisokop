<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountUserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transactions = Transactions::where('user_id', $user->user_id)->orderBy('created_at', 'desc')
            ->with('schedules')->get();
        return view('user.account.index')->with(compact('user', 'transactions'));
    }

    public function setting()
    {
        $user = Auth::user();
        return view('user.account.setting')->with(compact('user'));
    }

    public function settingProcess(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password_account' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/account/setting')
                ->with('alertError', $validator->errors()->first())
                ->withInput();
        }

        $password = $request->password ?? '';
        $confirm_password = $request->confirm_password ?? '';
        $is_password_match = !empty($password) && $password == $confirm_password;
        $is_password_correct = Hash::check($request->password_account, $user->password);

        if (!$is_password_correct) {
            return redirect('account/setting')
                ->with('alertError', 'Your account password is wrong.');
        } elseif (!$is_password_match) {
            return redirect('account/setting')
                ->with('alertError', 'Password with incorrect password confirmation.');
        }

        $user->name = $request->name;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect('account/setting')->with('alertSuccess', 'Changes saved successfully!');
    }

}
