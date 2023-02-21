<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $user = Auth::guard('staff')->user();
        $allPaymentMethod = PaymentMethod::orderBy('name', 'asc')->get();
        return view('staff.payment-method.index', compact('user', 'allPaymentMethod'));
    }

    public function update(PaymentMethod $paymentMethod, Request $request)
    {
        $user = Auth::guard('staff')->user();
        if(!$request->ajax()) {
            return abort(403, 'No direct script access allowed!');
        }
        
        return view('staff.payment-method.update', compact('user', 'paymentMethod'));
    }

    public function delete(PaymentMethod $paymentMethod)
    {
        try {
            Storage::delete('payment/' . $paymentMethod->icon);
            $paymentMethod->delete();
            return redirect('/staff/payment-method/')->with('alertSuccess', 'Payment method deleted successfully.');
        } catch (\Exception $e) {
            return redirect('/staff/payment-method/')->with('alertError', 'Failed to delete payment method: ' . $e->getMessage());
        }
    }

    public function addProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'icon' => 'required|image|max:2048',
            'account_number' => 'required',
            'account_name' => 'required',
        ]);

        if($validator->fails()) {
            return redirect('/staff/payment-method/')->with('alertError', $validator->errors()->first())
                ->withInput();
        }

        $icon = $request->file('icon')->store('payment');

        PaymentMethod::create([
            'name' => $request->name,
            'icon' => str_replace('payment/', '', $icon),
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
        ]);

        return redirect('/staff/payment-method/')->with('alertSuccess', 'New payment method added successfully.');
    }

    public function updateProcess(PaymentMethod $paymentMethod, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'icon' => 'image|max:2048',
            'account_number' => 'required',
            'account_name' => 'required',
            'status' => 'required|in:Active,Not Active',
        ]);

        if($validator->fails()) {
            return redirect('/staff/payment-method/')->with('alertError', $validator->errors()->first())
                ->withInput();
        }

        $paymentMethod->name = $request->name;
        $paymentMethod->account_number = $request->account_number;
        $paymentMethod->account_name = $request->account_name;

        if(!empty($request->hasFile('icon'))) {
            Storage::delete('payment/' . $paymentMethod->icon);

            $path = $request->file('icon')->store('payment');
            $paymentMethod->icon = str_replace('payment/', '', $path);
        }

        $paymentMethod->save();

        return redirect('/staff/payment-method/')->with('alertSuccess', 'Changes saved successfully!');
    }



}