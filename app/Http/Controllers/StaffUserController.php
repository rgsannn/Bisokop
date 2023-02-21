<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffUserController extends Controller
{
    public function index()
    {
        $user = Auth::guard('staff')->user();
        $allUsers = User::orderBy('name', 'asc')->get();
        return view('staff.users')->with(compact('user', 'allUsers'));
    }

    public function updateProcess(User $users, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required',
        ]);
        if($validator->fails()) {
            return redirect('/staff/users')->with('alertError', $validator->errors()->first())
                ->withInput();

        } else if(!empty($request->password) && strlen($request->password) < 5) {
            return redirect('/staff/users')->with('alertError', 'Users password minimum 5 characters');
        }

        $users->email = $request->email;
        if(!empty($request->password)) $users->password = Hash::make($request->password);
        $users->name = $request->name;

        $users->save();
        return redirect('/staff/users')->with('alertSuccess', 'Changes saved successfully!');
    }

    public function deleteProcess(User $users)
    {
        $users->delete();
        return redirect('/staff/users')->with('alertSuccess', 'Users account deleted successfully!');
    }
}
