<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->string('transaction_id', 16)->primary();
            $table->string('booking_id', 16);
            $table->string('user_id', 16);
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->string('schedule_id', 16);
            $table->foreign('schedule_id')->references('schedule_id')->on('schedules');
            $table->string('payment_id', 16);
            $table->foreign('payment_id')->references('payment_id')->on('payment_method');
            $table->longText('seats');
            $table->string('time', 10);
            $table->integer('price');
            $table->integer('tax');
            $table->enum('status', ['Waiting for payment', 'Payment Received', 'Payment Canceled']);
            $table->integer('printed');
            $table->integer('confirmation_transfer');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}

