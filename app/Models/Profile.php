<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'image',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
