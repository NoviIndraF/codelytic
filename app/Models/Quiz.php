<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Quiz extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [
        'id'
    ];

    protected $with = ['room'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function question()
    {
        return $this->hasMany(Question::class);
    }

    public function student_quiz()
    {
        return $this->hasMany(StudentQuiz::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}