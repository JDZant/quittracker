<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotificationSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'email_notifications',
        'frequency',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
