<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'address',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getFullNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
