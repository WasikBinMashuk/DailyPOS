<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_name',
        'mobile',
        'address',
        'default',
    ];

    public function stock(): HasMany
    {
        return $this->hasMany(Stock::class);
    }
    public function sell(): HasMany
    {
        return $this->hasMany(Sell::class);
    }
}
