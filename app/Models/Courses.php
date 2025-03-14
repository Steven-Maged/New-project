<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $fillable = [
        'courseName',
        'courseDescription',
        'intro_video',
        'user_id',
        'track_id',
        'coursePhoto',
        'Price',
        'bayState',
    ];


    public function contents()
    {
        return $this->hasMany(Contentes::class, 'course_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

