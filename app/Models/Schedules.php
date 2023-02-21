<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Schedules extends Model
{
    use HasFactory;

    protected $table = 'schedules';
    protected $primaryKey = 'schedule_id';
    protected $guarded = ['schedule_id'];
    public $timestamps = false;
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->schedule_id = strtoupper(Str::random(16));
            $model->created_at = now();
            $model->updated_at = now();
        });
    }

    public function theater()
    {
        return $this->hasOne(Theater::class, 'theater_id', 'theater_id');
    }
    
    public function film()
    {
        return $this->hasOne(Film::class, 'film_id', 'film_id');
    }

    public function dateFormat()
    {
        return date('d M Y', strtotime($this->date));
    }

}
