<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionsController extends Controller
{
    public function index()
    {
        $user = Auth::guard('staff')->user();
        $allTransactions = Transactions::with('Schedules')->orderBy('created_at', 'desc')->get();
        $totalRevenue = Transactions::selectRaw('SUM(price + tax) AS total')->first()->total ?? 0;

        return view('staff.transactions.index', compact('user', 'allTransactions', 'totalRevenue'));
    }

    public function update(Transactions $transactions, Request $request)
    {
        $user = Auth::guard('staff')->user();
        if(!$request->ajax()) {
            return abort(403, 'No direct script access allowed!');
        }
        
        return view('staff.transactions.update', compact('user', 'transactions'));
    }

    public function updateProcess(Transactions $transactions, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Waiting for payment,Payment Received,Payment Canceled',
            'printed' => 'required|boolean'
        ]);

        if($validator->fails()) {
            return redirect('/staff/transactions/')->with('alertError', $validator->errors()->first())->withInput();
        }

        $transactions->status = $request->status;
        $transactions->printed = $request->printed;
        $transactions->save();

        return redirect('/staff/transactions/')->with('alertSuccess', 'Transaction updated successfully.');
    }

}