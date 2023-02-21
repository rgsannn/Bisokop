<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $table = 'films';
    protected $primaryKey = 'film_id';
    protected $guarded = ['film_id'];
    public $timestamps = false;
    public $incrementing = false;

    public function durationFormat()
    {
        $jam = intval($this->duration / 60);
        return $jam . ' Hours ' . ($this->duration % 60) . ' Minute';
    }
}
