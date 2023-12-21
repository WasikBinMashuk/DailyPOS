<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sell extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'branch_id',
        'subtotal',
    ];

    public function sellDetail(): HasMany
    {
        return $this->hasMany(SellDetail::class);
    }
    public function sellPayment()
    {
        return $this->hasOne(SellPayment::class);
    }
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
