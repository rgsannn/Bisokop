<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transactions;

class setStatusExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:expired';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set transaction status to expired if payment not completed within 10 minutes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $transactions = Transactions::where('status', 'Waiting for payment')->get();

        foreach($transactions as $transaction) {
            if(time() > strtotime('+10 minutes', strtotime($transaction->created_at))) {
                $transaction->status = 'Payment Canceled';
                $transaction->save();
            }
        }
    }
}
