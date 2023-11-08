<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = [
        'category_name',
    ];

    public function subCategories():HasMany
    {
        return $this->hasMany(SubCategory::class);
    }

    public function products():HasMany
    {
        return $this->hasMany(Product::class,'category_id');
    }

}