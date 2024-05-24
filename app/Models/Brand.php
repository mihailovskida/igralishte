<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    public function getTagsStringAttribute()
    {
        if (!$this->tags->count()) {
            return  null;
        }

        return $this->tags->implode('name', ', ');
    }

    public function categories()
    {
        return $this->belongsToMany(BrandCategory::class, 'brand_brand_categories', 'brand_id', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(BrandTag::class, 'brand_brand_tags');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
