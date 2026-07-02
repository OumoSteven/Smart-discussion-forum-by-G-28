<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $primaryKey = 'membership_id';
    protected $fillable = ['user_id', 'group_id', 'status', 'warnings_count', 'last_active_at', 'agreed_rules', 'blacklist_until', 'joined_at'];
    protected $casts = ['agreed_rules' => 'boolean', 'last_active_at' => 'datetime', 'blacklist_until' => 'datetime', 'joined_at' => 'datetime'];

    public function user() { return $this->belongsTo(User::class, 'user_id'); }
    public function group() { return $this->belongsTo(Group::class, 'group_id'); }
}