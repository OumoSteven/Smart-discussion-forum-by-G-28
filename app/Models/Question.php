<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    // REMOVE THIS LINE: protected $connection = 'quiz_db';
    
    protected $fillable = [
        'quiz_id', 
        'question_text', 
        'option_a', 
        'option_b', 
        'option_c', 
        'option_d', 
        'correct_option'
    ];

    public function quiz()
    {
        // Remove ->on('quiz_db')
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}