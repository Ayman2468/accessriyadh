<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BuildingTypeQuestion extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['phase_name'];

    public function buildingType()
    {
        return $this->belongsTo(BuildingType::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function getPhaseNameAttribute()
    {
        return ['المرحلة 1', 'المرحلة 2', 'المرحلة 3', 'المرحلة 4', 'المرحلة 5', 'المرحلة 6','المرحلة 7'][$this->phase_id];
    }
}
