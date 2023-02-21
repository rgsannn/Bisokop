<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTheaterSeatTable extends Migration
{
    public function up()
    {
        Schema::create('theater_seat', function (Blueprint $table) {
            $table->id();
            $table->string('theater_id', 16);
            $table->foreign('theater_id')->references('theater_id')->on('theater')->onDelete('cascade');
            $table->longText('row');
            $table->integer('price');
            $table->enum('type', ['Sweetbox', 'Economy', 'Executive']);
            $table->timestamps();
        });

        DB::table('theater_seat')->insert([
            [
                'theater_id' => 'ELO6Z8JOURJ6YSF9',
                'row' => '["A"]',
                'price' => '35000',
                'type' => 'Sweetbox',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_id' => 'ELO6Z8JOURJ6YSF9',
                'row' => '["B","C","D","E","F","G","H"]',
                'price' => '30000',
                'type' => 'Executive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_id' => 'ELO6Z8JOURJ6YSF9',
                'row' => '["I","J"]',
                'price' => '25000',
                'type' => 'Economy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            [
                'theater_id' => 'J0GCNX1L5Q3HJSM5',
                'row' => '["A"]',
                'price' => '35000',
                'type' => 'Sweetbox',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_id' => 'J0GCNX1L5Q3HJSM5',
                'row' => '["B","C","D","E","F","G","H"]',
                'price' => '30000',
                'type' => 'Executive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_id' => 'J0GCNX1L5Q3HJSM5',
                'row' => '["I","J"]',
                'price' => '25000',
                'type' => 'Economy',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'theater_id' => 'UM24YN2KO2HIGDV6',
                'row' => '["A"]',
                'price' => '40000',
                'type' => 'Sweetbox',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_id' => 'UM24YN2KO2HIGDV6',
                'row' => '["B","C","D","E","F","G","H"]',
                'price' => '35000',
                'type' => 'Executive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_id' => 'UM24YN2KO2HIGDV6',
                'row' => '["I","J"]',
                'price' => '30000',
                'type' => 'Economy',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'theater_id' => 'XWM0BCLH7K38ISPZ',
                'row' => '["A"]',
                'price' => '40000',
                'type' => 'Sweetbox',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_id' => 'XWM0BCLH7K38ISPZ',
                'row' => '["B","C","D","E","F","G","H"]',
                'price' => '35000',
                'type' => 'Executive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_id' => 'XWM0BCLH7K38ISPZ',
                'row' => '["I","J"]',
                'price' => '30000',
                'type' => 'Economy',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'theater_id' => 'YNWC8XK5NA0T4O4B',
                'row' => '["A"]',
                'price' => '45000',
                'type' => 'Sweetbox',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_id' => 'YNWC8XK5NA0T4O4B',
                'row' => '["B","C","D","E","F","G","H"]',
                'price' => '40000',
                'type' => 'Executive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_id' => 'YNWC8XK5NA0T4O4B',
                'row' => '["I","J"]',
                'price' => '30000',
                'type' => 'Economy',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'theater_id' => 'CT89FRHACZXIXBQB',
                'row' => '["A"]',
                'price' => '45000',
                'type' => 'Sweetbox',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_id' => 'CT89FRHACZXIXBQB',
                'row' => '["B","C","D","E","F","G","H"]',
                'price' => '40000',
                'type' => 'Executive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_id' => 'CT89FRHACZXIXBQB',
                'row' => '["I","J"]',
                'price' => '30000',
                'type' => 'Economy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('theater_seat');
    }
}
