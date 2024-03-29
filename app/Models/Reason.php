<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reason extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    const TYPES = [
        'quit',
        'relapse'
    ];

    //attributes
/*    public function getTypeAttribute(): string
    {
        return self::TYPES[$this->type];
    }*/

}
