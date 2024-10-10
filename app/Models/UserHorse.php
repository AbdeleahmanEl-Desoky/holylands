<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHorse extends Model
{
    use  HasFactory;

    protected $fillable = [
        'user_id',
        'horse_id',
        'lesson_id',
        'coach_id',
        'status',
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function horse()
    {
        return $this->belongsTo(Horse::class);
    }

    function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }
}
