<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'shipping_address',
        'billing_address',
        'phone',
        'total',
        'status', 
    ];


    public function User()
    {
    return $this->belongsTo(User::class);
    }
}
