<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'brand_brand_tags');
    }
}
