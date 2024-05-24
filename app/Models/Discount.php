<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'amount',
        'is_active',
        'discount_category_id'
    ];

    public function category()
    {
        return $this->belongsTo(DiscountCategory::class, 'discount_category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
