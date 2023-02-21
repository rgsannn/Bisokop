<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Film;
use App\Models\Schedules;
use App\Models\PaymentMethod;
use App\Models\Theater;
use App\Models\Transactions;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{

    public function index()
    {
        $user = Auth::guard('staff')->user();
        
        if ($user->role == 'Admin') {
            $totalUsers = User::count();
            $totalFilm = Film::count();
            $totalTheather = Theater::count();
            $totalSchedules = Schedules::count();
            $totalRevenue = Transactions::selectRaw('SUM(price + tax) AS total')->first()->total ?? 0;
            $totalPayment = PaymentMethod::count();
        } elseif ($user->role == 'Cashier') {
            $totalRevenue = Transactions::selectRaw('SUM(price + tax) AS total')->first()->total ?? 0;
            $totalPayment = PaymentMethod::count();
        }

        $chartTransactions = [ 
            'waiting' => array_fill(0, date('t'), 0), 
            'success' => array_fill(0, date('t'), 0), 
            'cancelled' => array_fill(0, date('t'), 0) 
        ];
        foreach(range(1, date('t')) as $day) {
            foreach(['waiting', 'success', 'cancelled'] as $status) {
                $statusDb = strtr($status, ['waiting' => 'Waiting for payment', 'success' => 'Payment Received', 'cancelled' => 'Payment Canceled']);
                $total = Transactions::selectRaw('SUM(price + tax) AS total')
                    ->whereDay('created_at', $day)
                    ->where('status', $statusDb)
                    ->first()->total ?? 0;

                $chartTransactions[$status][$day-1] += $total;
            }
        }

        $chartSeats = [ 
            'Economy' => array_fill(0, date('t'), 0), 
            'Executive' => array_fill(0, date('t'), 0), 
            'Sweetbox' => array_fill(0, date('t'), 0) 
        ];
        foreach(range(1, date('t')) as $day) {
            $transactions = Transactions::whereDay('created_at', $day)->get();
            foreach($transactions as $transaction) {
                if(!is_null($transaction->schedule_id)) {
                    $selectedSeat = $transaction->selectedSeat($transaction->schedule_id, $transaction->time);
                    foreach(['Economy', 'Executive', 'Sweetbox'] as $class) {
                        $chartSeats[$class][$day-1] += $selectedSeat[$class]['count'];
                    }
                }
            }
        }

        if ($user->role == 'Admin') {
            return view('staff.index')->with(compact('user', 'totalUsers', 'totalFilm', 'totalTheather', 'totalSchedules', 'totalRevenue', 'totalPayment', 'chartTransactions', 'chartSeats'));
        }
        return view('staff.index')->with(compact('user', 'totalRevenue', 'totalPayment', 'chartTransactions', 'chartSeats'));
    }
}
