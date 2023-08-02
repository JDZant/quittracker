<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reward extends Model
{
    use HasFactory;

    protected $guarded = [];

    //relations
    public function quitAttempt(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(quitAttempt::class);
    }
}
