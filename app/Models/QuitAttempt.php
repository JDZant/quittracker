<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class QuitAttempt extends Model
{
    use HasFactory, SoftDeletes;

    /*
     * Attributes
     * */

    protected $fillable = [
        'start_date',
        'end_date',
        'user_id'
    ];

    /*
     * Relations
     * */
    public function reasons(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Reason::class);
    }

    public function smokingData(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(SmokingData::class);
    }

    public function rewards(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Reward::class);
    }

    /*
     *
     * */
    public function getFormattedStartDateAttribute(): string
    {
        return Carbon::parse($this->start_date)->format('d-m-Y');
    }

    public function getFormattedEndDateAttribute(): ?string
    {
        return $this->end_date ? Carbon::parse($this->end_date)->format('d-m-Y') : null;
    }

    public function getCurrentQuitAttemptAttribute(){
        return QuitAttempt::whereNull('end_date')->first();
    }




}
