<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Answer;

class Question extends Model
{
    protected $primaryKey = 'question_id';
    public $timestamps = false;
    protected $fillable = ['quiz_id', 'text', 'options', 'correct_option', 'marks'];
    protected $casts = ['options' => 'array'];

    public function quiz() { return $this->belongsTo(Quiz::class, 'quiz_id'); }
    public function answers() { return $this->hasMany(Answer::class, 'question_id'); }
}