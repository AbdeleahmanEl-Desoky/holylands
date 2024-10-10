<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['is_booking'];
    protected $fillable = [
        'name',
        'description',
        'image',
        'date',
        'level_id',
        'coach_id',
        'number_hours',
        'number_students',
        'status',
        'repetition',
        'repetition_number',
        'location',
        'time',
    ];

    function level()
    {
        return $this->belongsTo(Level::class);
    }

    function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    function users()
    {
        return $this->hasMany(UserLesson::class);
    }

    public function user_horses()
    {
        return $this->hasMany(UserHorse::class);
    }

    function getIsBookingAttribute()
    {

        if (auth('sanctum')->check() and auth()->user()->hasRole('Student')) {
            $user = UserLesson::where(['lesson_id' => $this->id, 'user_id' => auth('sanctum')->id()])->first();
            if ($user) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    public function getImageAttribute($value)
    {
        if ($value) {
            return url('storage/' . $value);
        }else {
            return url('dashboard/images/photo.png');
        }
    }
}
