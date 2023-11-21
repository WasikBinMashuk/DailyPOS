<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'date',
        'status',
        'payment_method',
        'subtotal',
    ];

    public function purchaseDetail(): HasMany
    {
        return $this->hasMany(PurchaseDetail::class);
    }
}
