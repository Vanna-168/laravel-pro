<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    protected $table = 'invoices';

    protected $fillable = [
        'user_id',
        'sale_id',
        'order_id',
        'invoice_number',
        'invoice_date',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
