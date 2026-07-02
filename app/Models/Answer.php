<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $primaryKey = 'answer_id';
    public $timestamps = false;
    protected $fillable = ['attempt_id', 'question_id', 'selected', 'is_correct'];
    protected $casts = ['is_correct' => 'boolean'];

    public function attempt() { return $this->belongsTo(QuizAttempt::class, 'attempt_id'); }
    public function question() { return $this->belongsTo(Question::class, 'question_id'); }
}