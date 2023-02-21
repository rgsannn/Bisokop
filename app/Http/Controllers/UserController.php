<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Schedules;
use App\Models\Transactions;
use App\Models\TheaterSeat;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $allFilm = Film::where('status', 'publish')->orderBy('title', 'asc')->get();
        $user = Auth::user();
        return view('user.index')->with(compact('allFilm', 'user'));
    }

    public function detailFilm(Film $film, $date = '')
    {
        $filmId = $film->film_id;

        $timeToday = !empty($date) ? date('Y-m-d', strtotime($date)) : date('Y-m-d');

        $silverClass = $this->getClassDetails('Silver Class', $timeToday, $filmId);
        $goldClass = $this->getClassDetails('Gold Class', $timeToday, $filmId);
        $platinumClass = $this->getClassDetails('Platinum Class', $timeToday, $filmId);
        
        $user = Auth::user();
        
        return view('user.film', compact('user', 'film', 'date', 'silverClass', 'goldClass', 'platinumClass'));
    }

    protected function getClassDetails($classType, $date, $filmId)
    {
        $schedules = Schedules::join('theater', 'theater.theater_id', 'schedules.theater_id')
            ->where('type', $classType)
            ->where('date', $date)
            ->where('film_id', $filmId)
            ->first();

        if (!$schedules) {
            return null;
        }

        $priceLowest = TheaterSeat::where('theater_id', $schedules->theater_id)
            ->orderBy('price', 'asc')
            ->value('price') ?? 0;

        $priceHighest = TheaterSeat::where('theater_id', $schedules->theater_id)
            ->orderBy('price', 'desc')
            ->value('price') ?? 0;

        return (object) [
            'schedules' => $schedules,
            'priceLowest' => $priceLowest,
            'priceHighest' => $priceHighest,
        ];
    }

    public function listSeat(Film $film, Schedules $schedules, $time)
    {
        if (!Auth::check()) {
            return redirect('auth/login')->with('alertError', 'Please login first, before ordering tickets.');
        }

        $timeSchedules = strtotime($schedules->date);
        $diffToday = date_diff(date_create(date('Y-m-d')), date_create($schedules->date))->format('%R%a');
        $schedules->time_selected = base64_decode($time);

        if ($diffToday == 0) {
            $txtSchedules = 'TODAY, ';
        } else if ($diffToday == 1) {
            $txtSchedules = 'TOMORROW, ';
        } else {
            $txtSchedules = '';
        }
        $txtSchedules .= date('d', $timeSchedules) . ' ' . strtoupper(date('M', $timeSchedules)) . ', ' . $schedules->time_selected;

        $allRow = TheaterSeat::where('theater_id', $schedules->theater_id)
            ->whereIn('type', ['Economy', 'Executive', 'Sweetbox'])
            ->orderBy('id', 'DESC')
            ->get();

        $schedulesLain = Schedules::where('theater_id', $schedules->theater_id)
            ->where('date', $schedules->date)
            ->get();

        $bookedSeats = Transactions::where('schedule_id', $schedules->schedule_id)
            ->where('transactions.time', $schedules->time_selected)
            ->whereIn('transactions.status', ['Waiting for payment','Payment Received'])
            ->get();

        $arrSeats = [];
        foreach ($bookedSeats as $seat) $arrSeats[] = json_decode($seat->seats, true);
        
        $bookedSeats = [];
        if(is_array($arrSeats)) $bookedSeats = array_merge(...$arrSeats);

        $user = Auth::user();
        return view('user.seat')->with(compact('user', 'film', 'schedules', 'txtSchedules', 'allRow', 'schedulesLain', 'bookedSeats'));
    }


    public function confirmFilm(Film $film, Schedules $schedules, $time, Request $request)
    {
        if(!Auth::check()) {
            return redirect('auth/login')->with('alertError', 'Please login first, before ordering tickets.');
        }

        $schedules->time_selected = base64_decode($time);
        
        if(!is_array($request->seat)) {
            return redirect("film/{$film->film_id}/seat/{$schedules->schedule_id}/{$time}")->with('alertError', 'Please select the seats.');
        }

        $timeSchedules = strtotime($schedules->date);
        $diffToday = date_diff(date_create(date('Y-m-d')), date_create($schedules->date))->format('%R%a');

        if ($diffToday == 0) {
            $txtSchedules = 'TODAY, ';
        } else if ($diffToday == 1) {
            $txtSchedules = 'TOMORROW, ';
        } else {
            $txtSchedules = '';
        }
        $txtSchedules .= date('d', $timeSchedules) . ' ' . strtoupper(date('M', $timeSchedules)) . ', ' . $schedules->time_selected;

        $selectedSeat = ['Economy' => 0, 'Executive' => 0, 'Sweetbox' => 0];
        foreach($request->seat as $row => $seat) {
            $dataRow = TheaterSeat::find($row);
            $selectedSeat[ $dataRow->type ] += count($seat);
        }

        $paymentList = PaymentMethod::where('status', 'Active')->orderBy('name', 'asc')->get();
        $economyPrice = TheaterSeat::where('theater_id', $schedules->theater_id)->where('type', 'Economy')->first()->price ?? 0;
        $executivePrice = TheaterSeat::where('theater_id', $schedules->theater_id)->where('type', 'Executive')->first()->price ?? 0;
        $sweetboxPrice = TheaterSeat::where('theater_id', $schedules->theater_id)->where('type', 'Sweetbox')->first()->price ?? 0;

        $user = Auth::user();
        $seats = $request->seat;
        return view('user.confirm')->with(compact('user', 'film', 'schedules', 'txtSchedules', 'paymentList', 'selectedSeat', 'economyPrice', 'executivePrice', 'sweetboxPrice', 'seats'));
    }

    public function prosesFilm(Film $film, Schedules $schedules, $time, Request $request)
    {
        if(!Auth::check()) {
            return redirect('auth/login')->with('alertError', 'Please login first, before ordering tickets.');
        }

        $schedules->time_selected = base64_decode($time);
        
        if(is_null($request->payment)) {
            return redirect("film/{$film->film_id}/seat/{$schedules->schedule_id}/{$time}")->with('alertError', 'Please select payment method.');
        }

        $user = Auth::user();
        
        $transactions = Transactions::create([
            'user_id' => $user->user_id,
            'schedule_id' => $schedules->schedule_id,
            'payment_id' => $request->payment,
            'seats' => $request->arrSeats,
            'time' => $schedules->time_selected,
            'price' => $request->total_price,
            'tax' => $request->tax,
            'status' => 'Waiting for payment',
        ]);

        return redirect('confirm-payment/' . $transactions->transaction_id)->with('alertSuccess', 'Your order has been successfully made, please confirm your payment as soon as possible.');
    }

    public function confirmPayment(Transactions $transactions)
    {
        if(!Auth::check()) {
            return redirect('auth/login')->with('alertError', 'Please login first, before ordering tickets.');
        } else if($transactions->status == 'Payment Received') {
            return redirect('ticket-detail/' . $transactions->transaction_id);
        }

        $user = Auth::user();
        $selectedSeat = $transactions->selectedSeat($transactions->schedule_id, $transactions->time);

        return view('user.confirm-payment')->with(compact('user', 'transactions', 'selectedSeat'));
    }

    public function prosesConfirmPayment(Transactions $transactions)
    {
        $transactions->confirmation_transfer = 1;
        $transactions->save();

        return redirect('confirm-payment/' . $transactions->transaction_id)->with('alertSuccess', 'if you have made a payment please wait a few minutes, we will send a notification to the email if the payment has been received.');
    }

    public function ticketDetail(Transactions $transactions)
    {
        if(!Auth::check()) {
            return redirect('auth/login')->with('alertError', 'Please login first, before ordering tickets.');
        } else if($transactions->status == 'Waiting for payment') {
            return redirect('confirm-payment/' . $transactions->transaction_id)->with('alertError', 'Please complete the payment first.');
        } else if($transactions->status == 'Payment Canceled') {
            return redirect('account/')->with('alertError', 'This ticket order has been cancelled.');
        }
        
        $user = Auth::user();
        $selectedSeat = $transactions->selectedSeat($transactions->schedule_id, $transactions->time);
        return view('user.ticket-detail')->with(compact('user', 'transactions', 'selectedSeat'));
    }
}
