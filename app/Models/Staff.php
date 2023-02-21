<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Staff extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'staff_id';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->staff_id = strtoupper(Str::random(16));
        });
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getAuthIdentifierName()
    {
        return 'staff_id';
    }

    public function getAuthIdentifier()
    {
        return $this->staff_id;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function isAdmin()
    {
        return $this->role === 'Admin';
    }

    public function isCashier()
    {
        return $this->role === 'Cashier';
    }
}
