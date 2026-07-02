<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'status'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function memberships() { return $this->hasMany(Membership::class, 'user_id'); }
    public function groups() { return $this->belongsToMany(Group::class, 'memberships', 'user_id', 'group_id'); }
    public function groupsCreated() { return $this->hasMany(Group::class, 'created_by'); }
    public function topics() { return $this->hasMany(Topic::class, 'created_by'); }
    public function posts() { return $this->hasMany(Post::class, 'author_id'); }
    public function quizzesCreated() { return $this->hasMany(Quiz::class, 'lecturer_id'); }
    public function quizAttempts() { return $this->hasMany(QuizAttempt::class, 'user_id'); }
    public function participationMarks() { return $this->hasMany(ParticipationMark::class, 'user_id'); }
    public function messagesSent() { return $this->hasMany(Message::class, 'sender_id'); }
    public function notifications() { return $this->hasMany(Notification::class, 'user_id'); }

    public function isAdmin(): bool { return $this->role === 'admin'; }
    public function isLecturer(): bool { return $this->role === 'lecturer'; }
    public function isMember(): bool { return $this->role === 'member'; }
}
