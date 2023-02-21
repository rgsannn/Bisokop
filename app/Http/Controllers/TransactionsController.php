<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

        if($request->status == 'Payment Received' && $transactions->status !== 'Payment Received') {
            $email = $transactions->users->email;
            $url = url('ticket-detail/'.$transactions->transaction_id);
            $message = "<p>Hi {$transactions->users->name}, Thank you for order ticket in Bisokop, here your ticket detail url <a href='{$url}'>{$url}</a></p>";
            Mail::send([], [], function($mail) use($email, $message) {
                $mail->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'))
                    ->to($email)
                    ->subject('Bisokop Ticket Detail')
                    ->setBody($message, 'text/html');
            });
        }

        return redirect('/staff/transactions/')->with('alertSuccess', 'Transaction updated successfully.');
    }

}