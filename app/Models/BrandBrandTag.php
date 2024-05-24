<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandBrandTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'brand_tag_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function brandTag()
    {
        return $this->belongsTo(BrandTag::class);
    }
}
