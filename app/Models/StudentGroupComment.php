<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGroupComment extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function student_group()
    {
        return $this->belongsTo(StudentGroup::class);
    }
    
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
