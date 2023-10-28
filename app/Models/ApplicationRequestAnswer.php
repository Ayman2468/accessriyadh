<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationRequestAnswer extends Model
{
    use HasFactory;

    protected $guarded = [];

//    protected $casts = ['answer'=>'array'];
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
