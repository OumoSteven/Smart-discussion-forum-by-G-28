<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentQuiz extends Model
{
    use HasFactory;

    // REMOVE THIS LINE: protected $connection = 'quiz_db';
    
    protected $fillable = ['user_id', 'quiz_id', 'score', 'total_questions', 'completed_at'];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        // Remove ->on(config('database.default'))
        return $this->belongsTo(User::class, 'user_id');
    }

    public function quiz()
    {
        // Remove ->on('quiz_db')
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}