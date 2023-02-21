<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateStaffTable extends Migration
{
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->string('staff_id', 16)->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['Admin', 'Cashier']);
            $table->timestamps();
        });

        DB::table('staff')->insert([
            [
                'staff_id' => strtoupper(Str::random(16)),
                'name' => 'Bisokop Admin',
                'email' => 'admin@bisokop.im-rgsan.com',
                'password' => bcrypt('admin123'),
                'role' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'staff_id' => strtoupper(Str::random(16)),
                'name' => 'Bisokop Cashier',
                'email' => 'cashier@bisokop.im-rgsan.com',
                'password' => bcrypt('cashier123'),
                'role' => 'Cashier',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('staff');
    }
}

