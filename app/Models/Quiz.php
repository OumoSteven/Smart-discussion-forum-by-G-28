<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\QuizAttempt;

class Quiz extends Model
{
    protected $primaryKey = 'quiz_id';
    protected $fillable = ['group_id', 'lecturer_id', 'title', 'start_at', 'duration_minutes', 'target_category', 'status'];
    protected $casts = ['start_at' => 'datetime'];

    public function group() { return $this->belongsTo(Group::class, 'group_id'); }
    public function lecturer() { return $this->belongsTo(User::class, 'lecturer_id'); }
    public function questions() { return $this->hasMany(Question::class, 'quiz_id'); }
    public function attempts() { return $this->hasMany(QuizAttempt::class, 'quiz_id'); }
}