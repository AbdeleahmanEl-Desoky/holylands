<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'type',
        'user_id',
        'coach_id',
        'lesson_id',
    ];


    function user()
    {
        return $this->belongsTo(User::class);
    }

    function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }



}
