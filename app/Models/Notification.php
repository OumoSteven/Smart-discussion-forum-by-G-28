<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $primaryKey = 'notification_id';
    public $timestamps = false;
    protected $fillable = ['user_id', 'type', 'payload', 'read_at'];
    protected $casts = ['payload' => 'array', 'read_at' => 'datetime', 'created_at' => 'datetime'];

    public function user() { return $this->belongsTo(User::class, 'user_id'); }
}