<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Membership;
use App\Models\Topic;
use App\Models\Quiz;
use App\Models\Message;

class Group extends Model
{
    protected $primaryKey = 'group_id';
    protected $fillable = ['name', 'created_by'];

    public function creator() { return $this->belongsTo(User::class, 'created_by'); }
    public function memberships() { return $this->hasMany(Membership::class, 'group_id'); }
    public function members()
    {
        return $this->belongsToMany(User::class, 'memberships', 'group_id', 'user_id')
            ->withPivot(['status', 'warnings_count', 'last_active_at', 'agreed_rules', 'blacklist_until', 'joined_at']);
    }
    public function topics() { return $this->hasMany(Topic::class, 'group_id'); }
    public function quizzes() { return $this->hasMany(Quiz::class, 'group_id'); }
    public function messages() { return $this->hasMany(Message::class, 'group_id'); }
}