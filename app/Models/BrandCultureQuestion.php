<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandCultureQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_culture_category_id',
        'question'
    ];

    public function parent_category()
    {
        return $this->hasMany(BrandCultureCategory::class, 'id', 'brand_culture_category_id');
    }
}
