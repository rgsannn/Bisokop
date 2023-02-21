<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Film extends Model
{
    use HasFactory;

    protected $table = 'films';
    protected $primaryKey = 'film_id';
    protected $guarded = ['film_id'];
    public $timestamps = false;
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->film_id = strtoupper(Str::random(16));
            $model->created_at = now();
            $model->updated_at = now();
        });
    }

    public function durationFormat()
    {
        $jam = intval($this->duration / 60);
        return $jam . ' Hours ' . ($this->duration % 60) . ' Minute';
    }
}
