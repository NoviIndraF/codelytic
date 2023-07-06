<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Room extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [
        'id'
    ];
    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function discussion()
    {
        return $this->hasMany(Discussion::class);
    }

    public function materi()
    {
        return $this->hasMany(Materi::class);
    }

    public function quiz()
    {
        return $this->hasMany(Quiz::class);
    }

    public function student_discussion_group()
    {
        return $this->hasMany(StudentDiscussionGroup::class);
    }

    public function student_room()
    {
        return $this->hasMany(StudentRoom::class);
    }

    public function student_task()
    {
        return $this->hasMany(StudentTask::class);
    }

    public function task()
    {
        return $this->hasMany(Task::class);
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
