<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'product_code',
        'product_name',
        'price',
        'product_image',
        'status',
        'stock',
        'description',
    ];

    public function stock(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function purchaseDetail(): HasMany
    {
        return $this->hasMany(PurchaseDetail::class);
    }

    public function sellDetail(): HasMany
    {
        return $this->hasMany(SellDetail::class);
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
