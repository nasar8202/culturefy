<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandCultureAnswer extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_culture_question_id',
        'question'
    ];
    public function parent_question()
    {
        return $this->hasOne(BrandCultureQuestion::class, 'id', 'brand_culture_question_id');
    }
}
