<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ApplicationRequest extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];
    protected $appends = ['full_name', 'compliance_score'];

    public function buildingType(): BelongsTo
    {
        return $this->belongsTo(BuildingType::class);
    }
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(ApplicationRequestAnswer::class);
    }

    public function getFullNameAttribute()
    {
        return ($this->first_name) . ' ' . ($this->last_name);
    }

    public function getComplianceScoreAttribute()
    {
        $buildingTypeQuestionsScore = BuildingTypeQuestion::where('building_type_id', $this->building_type_id)->with('question')->get()
            ->reduce(function ($totalScore, $buildingTypeQuestion) {
                if ($buildingTypeQuestion->question) {
                    $totalScore += $buildingTypeQuestion->question->score;
                }
                return $totalScore;
            }, 0);
        $answeredScore = $this->answers->sum('score');
        if($buildingTypeQuestionsScore == 0) $buildingTypeQuestionsScore = 1;
        $complianceScore = ($answeredScore / $buildingTypeQuestionsScore) * 100;
        return $complianceScore;
    }
}
