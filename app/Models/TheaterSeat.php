<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheaterSeat extends Model
{
    use HasFactory;

    protected $table = 'theater_seat';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;
}
