<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGroup extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function student_group_comment()
    {
        return $this->hasMany(StudentGroupComment::class);
    }
    
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
