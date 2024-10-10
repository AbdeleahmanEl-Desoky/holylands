<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryUser extends Model
{

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
       'admin_id',
       'student_id',
       'add',

    ];

    function user()
    {
        return $this->belongsTo(User::class,'admin_id');
    }

}
