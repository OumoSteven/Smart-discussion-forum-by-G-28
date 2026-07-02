<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $primaryKey = 'post_id';
    public $timestamps = false;
    protected $fillable = ['topic_id', 'author_id', 'parent_post_id', 'body', 'is_question', 'is_answer', 'relevance_score'];
    protected $casts = ['is_question' => 'boolean', 'is_answer' => 'boolean', 'created_at' => 'datetime'];

    public function topic() { return $this->belongsTo(Topic::class, 'topic_id'); }
    public function author() { return $this->belongsTo(User::class, 'author_id'); }
    public function parent() { return $this->belongsTo(Post::class, 'parent_post_id'); }
    public function replies() { return $this->hasMany(Post::class, 'parent_post_id'); }
}