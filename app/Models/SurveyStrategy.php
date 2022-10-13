<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SurveyStrategy extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'survey_data'
    ];
    public function setSurveyDataAttribute($value)
    {
        $this->attributes['survey_data'] = json_encode($value);
    }

    public function getSurveyDataAttribute($value)
    {
        return $this->attributes['survey_data'] = json_decode($value);
    }

}
