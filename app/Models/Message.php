<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $primaryKey = 'message_id';
    public $timestamps = false;
    protected $fillable = ['group_id', 'sender_id', 'body', 'sync_status'];
    protected $casts = ['created_at' => 'datetime'];

    public function group() { return $this->belongsTo(Group::class, 'group_id'); }
    public function sender() { return $this->belongsTo(User::class, 'sender_id'); }
    public function exclusions() { return $this->hasMany(MessageExclusion::class, 'message_id'); }
}