<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Theater extends Model
{
    use HasFactory;

    protected $table = 'theater';
    protected $primaryKey = 'theater_id';
    protected $guarded = ['theater_id'];
    public $timestamps = false;
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->theater_id = strtoupper(Str::random(16));
            $model->created_at = now();
            $model->updated_at = now();
        });
    }

    public function theaterSeat()
    {
        return $this->hasMany(TheaterSeat::class, 'theater_id');
    }

    public function seatOfType($type)
    {
        return $this->theaterSeat()->where('type', ucfirst($type))->first();
    }

}
