<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name',
        'order',
    ];

    function users()
    {
        return $this->hasMany(User::class);
    }
    function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}