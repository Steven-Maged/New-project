<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traks extends Model
{
    /** @use HasFactory<\Database\Factories\TrakFactory> */
    use HasFactory;
    protected $fillable=['trackName','trackPhoto','trackDescription','trackCategory'];
    public function courses()
{
    return $this->hasMany(Courses::class, 'track_id');
}

}

