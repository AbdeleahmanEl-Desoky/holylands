<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLesson extends Model
{
    use  HasFactory;

    protected $fillable = [
        'lesson_id',
        'level_id',
        'user_id',
        'coach_id',
        'number_hours',
        'time_end',
        'status',
        'horse_id',
        'end'
    ];

    function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    function level()
    {
        return $this->belongsTo(Level::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function horse()
    {
        return $this->belongsTo(Horse::class);
    }

    function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

}
