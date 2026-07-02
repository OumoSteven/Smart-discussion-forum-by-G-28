<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Answer;

class QuizAttempt extends Model
{
    protected $primaryKey = 'attempt_id';
    public $timestamps = false;
    protected $fillable = ['quiz_id', 'user_id', 'started_at', 'submitted_at', 'score', 'status'];
    protected $casts = ['started_at' => 'datetime', 'submitted_at' => 'datetime'];

    public function quiz() { return $this->belongsTo(Quiz::class, 'quiz_id'); }
    public function user() { return $this->belongsTo(User::class, 'user_id'); }
    public function answers() { return $this->hasMany(Answer::class, 'attempt_id'); }
}