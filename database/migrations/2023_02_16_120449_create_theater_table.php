<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTheaterTable extends Migration
{
    public function up()
    {
        Schema::create('theater', function (Blueprint $table) {
            $table->string('theater_id', 16)->primary();
            $table->enum('type', ['Silver Class', 'Gold Class', 'Platinum Class']);
            $table->string('name');
            $table->timestamps();
        });

        DB::table('theater')->insert([
            [
                'theater_id' => 'ELO6Z8JOURJ6YSF9',
                'type' => 'Silver Class',
                'name' => 'Axel Theatre',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_id' => 'J0GCNX1L5Q3HJSM5',
                'type' => 'Silver Class',
                'name' => 'Russell Theatre',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_id' => 'UM24YN2KO2HIGDV6',
                'type' => 'Gold Class',
                'name' => 'Cozy Theatre',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_id' => 'XWM0BCLH7K38ISPZ',
                'type' => 'Gold Class',
                'name' => 'Ancestral Theatre',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_id' => 'YNWC8XK5NA0T4O4B',
                'type' => 'Platinum Class',
                'name' => 'Cygnet Theatre',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_id' => 'CT89FRHACZXIXBQB',
                'type' => 'Platinum Class',
                'name' => 'Majestic Theatre',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('theater');
    }
}
