<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    // REMOVE THIS LINE: protected $connection = 'quiz_db';
    
    protected $fillable = ['title', 'description', 'time_limit', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function studentQuizzes()
    {
        return $this->hasMany(StudentQuiz::class);
    }
}