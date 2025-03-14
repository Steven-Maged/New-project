<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contentes extends Model
{
    /** @use HasFactory<\Database\Factories\ContentFactory> */
    use HasFactory;
    protected $fillable=['title','url','description','course_id'];
}
