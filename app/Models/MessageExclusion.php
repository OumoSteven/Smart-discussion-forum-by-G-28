<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageExclusion extends Model
{
    protected $primaryKey = 'exclusion_id';
    public $timestamps = false;
    protected $fillable = ['message_id', 'excluded_user_id'];

    public function message() { return $this->belongsTo(Message::class, 'message_id'); }
    public function excludedUser() { return $this->belongsTo(User::class, 'excluded_user_id'); }
}