<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductProductTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_tag_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productTag()
    {
        return $this->belongsTo(ProductTag::class);
    }
}
