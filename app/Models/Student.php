<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Student as Authenticatable;

class Student extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function student_discussion_group()
    {
        return $this->hasMany(StudentDiscussionGroup::class);
    }
    public function student_group_comment()
    {
        return $this->hasMany(StudentGroupComment::class);
    }

    public function student_quiz()
    {
        return $this->hasMany(StudentQuiz::class);
    }

    public function student_room()
    {
        return $this->hasMany(StudentRoom::class);
    }

    public function student_task()
    {
        return $this->hasMany(StudentTask::class);
    }
    
}
