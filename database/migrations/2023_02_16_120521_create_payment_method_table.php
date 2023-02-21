<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreatePaymentMethodTable extends Migration
{
    public function up()
    {
        Schema::create('payment_method', function (Blueprint $table) {
            $table->string('payment_id', 16)->primary();
            $table->string('name');
            $table->string('account_number');
            $table->string('account_name');
            $table->enum('status', ['Active', 'Not Active']);
            $table->string('icon');
            $table->timestamps();
        });

        DB::table('payment_method')->insert([
            [
                'payment_id' => strtoupper(Str::random(16)),
                'name' => 'Bank BCA',
                'account_number' => '7772276187',
                'account_name' => 'Rifqi Galih Nur Ikhsan',
                'status' => 'Active',
                'icon' => 'bca.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'payment_id' => strtoupper(Str::random(16)),
                'name' => 'DANA',
                'account_number' => '081210110328',
                'account_name' => 'Rifqi Galih Nur Ikhsan',
                'status' => 'Active',
                'icon' => 'dana.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'payment_id' => strtoupper(Str::random(16)),
                'name' => 'OVO',
                'account_number' => '081210110328',
                'account_name' => 'Rifqi Galih Nur Ikhsan',
                'status' => 'Active',
                'icon' => 'ovo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'payment_id' => strtoupper(Str::random(16)),
                'name' => 'GOPAY',
                'account_number' => '081210110328',
                'account_name' => 'Rifqi Galih Nur Ikhsan',
                'status' => 'Active',
                'icon' => 'gopay.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'payment_id' => strtoupper(Str::random(16)),
                'name' => 'SHOPEE PAY',
                'account_number' => '081210110328',
                'account_name' => 'Rifqi Galih Nur Ikhsan',
                'status' => 'Active',
                'icon' => 'shopeepay.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('payment_method');
    }
}

