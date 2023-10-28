<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class BuildingType extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['image_url'];

    public function questions(): HasMany
    {
        return $this->hasMany(BuildingTypeQuestion::class)->orderBy('order');
    }
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image) return url($this->image);
        return $this->image;
    }
}
