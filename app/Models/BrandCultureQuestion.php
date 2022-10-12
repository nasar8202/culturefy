<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrandCultureQuestion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'brand_culture_category_id',
        'question'
    ];

    // public function parent_category()
    // {
    //     return $this->hasOne(BrandCultureCategory::class, 'id', 'brand_culture_category_id');
    // }
    public function sub_category()
    {
        return $this->belongsTo(BrandCultureCategory::class, 'brand_culture_category_id', 'id');
    }
    public function category()
    {
        return $this->hasOne(BrandCultureCategory::class, 'id', 'brand_culture_category_id');
    }
    public function parent_category()
    {
        return $this->hasMany(self::class, 'id', 'parent_id');
    }
    
    // public function parent()
    // {
    //     return $this->belongsTo(BrandCultureCategory::class, 'parent_id');
    // }
    // public function sub()
    // {
    //     return $this->hasOne(BrandCultureCategory::class, 'parent_id');
    // }
}
