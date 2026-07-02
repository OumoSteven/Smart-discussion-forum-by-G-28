<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable('name', 'email', 'password', 'role')]
#[Hidden('password', 'remember_token')]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Add this
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    // ============================================
    // ROLE HELPER METHODS
    // ============================================
    
    /**
     * Check if user is a lecturer
     */
    public function isLecturer(): bool
    {
        return $this->role === 'lecturer';
    }

    /**
     * Check if user is an admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is a student
     * (includes users with 'student' or 'user' role)
     */
    public function isStudent(): bool
    {
        return $this->role === 'student' || $this->role === 'user';
    }

    /**
     * Check if user can manage quizzes (lecturer or admin)
     */
    public function canManageQuizzes(): bool
    {
        return in_array($this->role, ['lecturer', 'admin']);
    }

    // ============================================
    // RELATIONSHIPS
    // ============================================
    
    /**
     * Get quizzes created by this user
     */
    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'user_id');
    }

    /**
     * Get quiz attempts by this user
     */
    public function studentQuizzes()
    {
        return $this->hasMany(StudentQuiz::class, 'user_id');
    }
}