<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Topic extends Model
{
    protected $primaryKey = 'topic_id';
    public $timestamps = false;
    protected $fillable = ['group_id', 'created_by', 'title', 'category', 'ml_label', 'is_resolved'];
    protected $casts = ['is_resolved' => 'boolean', 'created_at' => 'datetime'];

    public function group() { return $this->belongsTo(Group::class, 'group_id'); }
    public function author() { return $this->belongsTo(User::class, 'created_by'); }
    public function posts() { return $this->hasMany(Post::class, 'topic_id'); }
}