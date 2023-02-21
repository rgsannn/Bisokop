<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transactions extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $primaryKey = 'transaction_id';
    protected $guarded = ['transaction_id'];
    public $timestamps = false;
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->transaction_id = strtoupper(Str::random(16));
            $model->booking_id = strtoupper(Str::random(16));
            $model->printed = 0;
            $model->confirmation_transfer = 0;
            $model->created_at = now();
            $model->updated_at = now();
        });
    }

    public function schedules()
    {
        return $this->hasOne(Schedules::class, 'schedule_id', 'schedule_id');
    }

    public function users()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }

    public function dateFormat()
    {
        $time = strtotime($this->created_at);
        return date('d', $time) . ' ' . date('F', $time) . ' ' . date('Y', $time) . ', ' . date('H:i', $time);
    }

    public function dateScheduleFormat()
    {
        return $this->schedules->date.', '.$this->time;
    }

    public function dateExpiredFormat()
    {
        $time = strtotime('+10 minutes', strtotime($this->created_at));
        return date('d', $time) . ' ' . date('M', $time) . ' ' . date('D', $time) . ', ' . date('H:i', $time);
    }

    public function statusClass()
    {
        return strtr($this->status, [
            'Waiting for payment' => 'warning',
            'Payment Received' => 'success',
            'Payment Canceled' => 'danger',
        ]);
    }

    public function ticketUsed()
    {
        return strtr($this->used, [
            1 => 'Ticket Used',
            0 => 'Ticket Not Used',
        ]);
    }

    public function urlDetailTransactions()
    {
        return strtr($this->status, [
            'Waiting for payment' => url('confirm-payment/' . $this->transaction_id),
            'Payment Received' => url('ticket-detail/' . $this->transaction_id),
            'Payment Canceled' => url('confirm-payment/' . $this->transaction_id),
        ]);
    }

    public function paymentMethod()
    {
        return $this->hasOne(PaymentMethod::class, 'payment_id', 'payment_id');
    }

    public function selectedSeat($scheduleId, $timeSelected)
    {
        $transaction = Transactions::join('schedules', 'transactions.schedule_id', '=', 'schedules.schedule_id')
            ->where('transactions.schedule_id', $scheduleId)
            ->where('transactions.time', $timeSelected)
            ->first();

        $selectedSeat = [
            'Economy' => [
                'count' => 0,
                'price' => 0,
            ], 
            'Executive' => [
                'count' => 0,
                'price' => 0,
            ], 
            'Sweetbox' => [
                'count' => 0,
                'price' => 0
            ]
        ];

        foreach(json_decode($transaction->seats) as $seats) {
            $seat = substr($seats, 0, 1);
            $theaterSeats = TheaterSeat::where('theater_id', $transaction->theater_id)
                ->where('row', 'like', '%' . $seat . '%')
                ->get();

            foreach($theaterSeats as $tSeat) {
                $selectedSeat[ $tSeat->type ]['count']++;
                $selectedSeat[ $tSeat->type ]['price'] += $tSeat->price;
            }
        }

        return $selectedSeat;
    }

    public function seatNumbers()
    {
        return implode(", ", json_decode($this->seats, true));
    }
}
