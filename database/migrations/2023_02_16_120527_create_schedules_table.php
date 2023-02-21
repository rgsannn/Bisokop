<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->string('schedule_id', 16)->primary();
            $table->string('theater_id', 16);
            $table->foreign('theater_id')->references('theater_id')->on('theater')->onDelete('cascade');
            $table->string('film_id', 16);
            $table->foreign('film_id')->references('film_id')->on('films')->onDelete('cascade');
            $table->date('date');
            $table->longText('time');
            $table->timestamps();
        });

        // Generate schedules
        $films = ['3W4Z3SG9B9HILP7A', '9WSRL5ED4K5L6YEW', 'P9QRJL5ISEO6OT9O', 'S9B11Q0WH971ZOJQ'];
        $theaters = ['CT89FRHACZXIXBQB', 'ELO6Z8JOURJ6YSF9', 'UM24YN2KO2HIGDV6'];

        $now = now();
        $daysAhead = 7;

        foreach ($films as $film) {
            foreach ($theaters as $theater) {
                for ($i = 0; $i < $daysAhead; $i++) {
                    $times = strtotime('+' . $i . ' days'); 
                    $date = date('Y-m-d', $times);
                    $scheduleId = strtoupper(Str::random(16));

                    $insertTime = json_encode([
                        '08:00',
                        '09:30',
                        '11:00',
                        '12:30',
                        '14:00',
                        '15:30',
                        '17:00',
                        '18:30',
                        '20:00',
                        '21:30'
                    ]);
                    DB::table('schedules')->insert([
                        'schedule_id' => $scheduleId,
                        'film_id' => $film,
                        'theater_id' => $theater,
                        'date' => $date,
                        'time' => $insertTime,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        }
    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}

