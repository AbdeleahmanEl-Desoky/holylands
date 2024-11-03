<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryLesson extends Model
{

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
       'student_id',
       'coach_id',
       'lesson_id',

    ];

    function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
    function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }


}
