<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $fillable = [
        'user_id',
        'order_id',
        'customer_id',
        'sale_date',
        'payment_status',
        'payment_method',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
