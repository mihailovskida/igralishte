<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function getTagsStringAttribute()
    {
        if (!$this->tags->count()) {
            return  null;
        }

        return $this->tags->implode('name', ', ');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_tags');
    }
}
