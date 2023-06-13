<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class QuitAttempt extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'start_date',
        'end_date',
    ];


    public function reasons(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Reason::class);
    }

    public function SmokingData(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(SmokingData::class);
    }

    public function getFormattedStartDateAttribute(): string
    {
        return Carbon::parse($this->start_date)->format('d-m-Y');
    }

    public function getFormattedEndDateAttribute(): string
    {
        return Carbon::parse($this->end_date)->format('d-m-Y');
    }



}
