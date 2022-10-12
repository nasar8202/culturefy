<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BrandCultureCategory extends Model
{
    use SoftDeletes;
    use HasFactory;

    // public function setCategoryNameAttribute($value)
    // {
    //     $this->attributes['category_name'] = strtolower($value);
    // }

    // public function getCategoryNameAttribute($value)
    // {
    //     return strtoupper($value);
    // }

    public function sub_category()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function parent_category()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}
