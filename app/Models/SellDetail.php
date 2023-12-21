<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SellDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'sell_id',
        'product_id',
        'quantity',
        'price',
        'total_price',
    ];

    public function sell(): BelongsTo
    {
        return $this->belongsTo(Sell::class);
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
