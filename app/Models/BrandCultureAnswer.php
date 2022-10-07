<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrandCultureAnswer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'brand_culture_question_id',
        'question'
    ];
    public function parent_question()
    {
        return $this->hasOne(BrandCultureQuestion::class, 'id', 'brand_culture_question_id');
    }
}
