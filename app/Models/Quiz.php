<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'time_limit', 'user_id'];

    // Get the creator of the quiz
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Get all questions for this quiz
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}