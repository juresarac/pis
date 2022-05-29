<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'level',
        'type',
        'min_members',
        'max_members',
        'type_of_course',
        'start_of_the_course',
        'end_of_the_course',
        'course_content',
        'img',
        'language_id',
    ];

    public function lessons ()
    {
        return $this->hasMany(Lesson::class);
    }

    public function user_course ()
    {
        return $this->belongsToMany(Course::class, 'user_course')->withPivot('active', 'user_id');
     
    }


    public function user_courses ()
    {
        return $this->belongsToMany(UserCourse::class, 'user_course', 'course_id', 'user_id');

    }

    public function ratings ()
    {
        return $this->hasMany(Rating::class);
    }

    public function users ()
    {
        return $this->hasMany(User::class);
    }

    
}
