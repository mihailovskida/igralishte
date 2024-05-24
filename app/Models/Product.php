<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'is_active',
        'size_description',
        'maintenance',
        'material',
        'stock',
        'discount_id',
        'brand_id',
        'product_category_id',
        'accessory_id',
    ];

    public function getTagsStringAttribute()
    {
        if (!$this->tags->count()) {
            return  null;
        }

        return $this->tags->implode('name', ', ');
    }


    public function discounted_price()
    {
        if (!$this->discount) {
            return $this->price;
        }
        $discountedPrice = $this->price * (1 - ($this->discount->amount / 100));

        $discountedPrice = round($discountedPrice);

        return $discountedPrice;
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function tags()
    {
        return $this->belongsToMany(ProductTag::class, 'product_product_tags', 'product_id', 'product_tag_id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function discount()
    {
        return $this->hasOne(Discount::class, 'id', 'discount_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'size_products');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_products');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
