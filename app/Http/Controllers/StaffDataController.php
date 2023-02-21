<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffDataController extends Controller
{
    public function index()
    {
        $user = Auth::guard('staff')->user();
        $allStaff = Staff::orderBy('name', 'asc')->get();
        return view('staff.staff-data')->with(compact('user', 'allStaff'));
    }

    public function addProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:staff,email',
            'name' => 'required',
            'role' => 'required|in:Admin,Cashier',
            'password' => 'required|min:5',
        ]);

        if ($validator->fails()) {
            return redirect('/staff/staff-data')
                ->with('alertError', $validator->errors()->first())
                ->withInput();
        }

        Staff::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'role' => $request->role,
        ]);

        return redirect('/staff/staff-data')
            ->with('alertSuccess', 'New staff added successfully.');
    }


    public function updateProcess(Staff $staff, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required|in:Admin,Cashier',
            'password' => 'nullable|min:5',
        ]);

        if ($validator->fails()) {
            return redirect('/staff/staff-data')->withInput()->withErrors($validator);
        }

        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->role = $request->role;

        if ($request->filled('password')) {
            $staff->password = Hash::make($request->password);
        }

        $staff->save();

        return redirect('/staff/staff-data')->with('alertSuccess', 'Changes saved successfully!');
    }

    public function deleteProcess(Staff $staff)
    {
        $staff->delete();
        return redirect('/staff/staff-data')->with('alertSuccess', 'Staff account deleted successfully!');
    }
}
