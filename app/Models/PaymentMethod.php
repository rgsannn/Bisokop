<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'payment_method';
    protected $primaryKey = 'payment_id';
    protected $guarded = ['payment_id'];
    public $timestamps = false;
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->payment_id = strtoupper(Str::random(16));
            $model->status = 'Active';
            $model->created_at = now();
            $model->updated_at = now();
        });
    }
}
