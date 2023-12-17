<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'sell_id',
        'payment_method',
        'due',
        'paid',
        'subtotal',
    ];
}
