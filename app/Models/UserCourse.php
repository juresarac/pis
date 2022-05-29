<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    use HasFactory;

    protected $table = 'user_course';

    protected $fillable = [
        'user_id',
        'course_id',
        'address',
        'city',
        'name_card',
        'number_card',
        'exp_month',
        'exp_year',
        'cvv',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function course ()
    {
        return $this->belongsTo(Course::class);
    }


}
