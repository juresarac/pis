<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question', 'quiz_id',
    ];

    public function answers ()
    {
        return $this->hasMany(Answer::class);
    }

    public function quiz ()
    {
        return $this->belongsTo(Quiz::class);
    }
}
