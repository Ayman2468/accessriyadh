<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['answer', 'answers_array', 'answers_key_value', 'answers_key_value2', 'application_answer', 'name', 'description', 'locale'];
    protected $casts = ['answers' => 'array'];

    public function BuildingTypeQuestion()
    {
        return $this->hasMany(BuildingTypeQuestion::class, 'question_id');
    }

    public function getAnswersArrayAttribute()
    {
        $result = [];
        if(gettype($this->answers) != 'array'){
            $this->answers = json_decode($this->answers);
        }
        foreach (($this->answers) ?? [] as $key => $item) {
            array_push($result, ['en' => $item['en'] ?? '', 'ar' => $item['ar'] ?? '', 'score' => $item['score'] ?? '', 'image' => file_exists(isset($item['image']) ? $item['image'] : 'none') ? url($item['image']) : null]);
        }
        return $result;
    }

    public function getAnswersKeyValueAttribute()
    {
        $result = [];
        foreach (($this->answers) ?? [] as $key => $item) {
            array_push($result, ['en' => $item['en'] ?? '', 'ar' => $item['ar'] ?? '', 'score' => $item['score'] ?? '', 'image' => file_exists(isset($item['image']) ? $item['image'] : 'none') ? url($item['image']) : null]);
        }
        return $result;
    }

    public function getAnswersKeyValue2Attribute()
    {
        $result = [];
        foreach (($this->answers) ?? [] as $key => $item) {

            array_push($result, ['en' => $item['en'] ?? '', 'ar' => $item['ar'] ?? '', 'score' => $item['score'] ?? '', 'image' => file_exists(isset($item['image']) ? $item['image'] : 'none') ? url($item['image']) : null]);


        }
        return $result;
    }

    public function getNameAttribute()
    {
        return $this['question_name_' . (app()->getLocale())];
    }

    public function getDescriptionAttribute()
    {
        return $this['description_' . (app()->getLocale())];
    }

    public function getLocaleAttribute()
    {
        return app()->getLocale();
    }

    public function getAnswerAttribute()
    {
        return '';
    }

    public function getApplicationAnswerAttribute()
    {
        if (request()->filled('request_id')) {
            return ApplicationRequestAnswer::where('application_request_id', request()->request_id)
                ->where('question_id', $this->question_id)->first();
        }
        return null;
    }
}
