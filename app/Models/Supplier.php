<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_name',
        'email',
        'mobile',
        'address',
    ];

    public function purchase(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }
}
