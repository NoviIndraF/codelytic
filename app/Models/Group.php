<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Group extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [
        'id'
    ];

    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }


    public function student_group()
    {
        return $this->hasMany(StudentGroup::class);
    }

    public function student_group_comment()
    {
        return $this->hasMany(StudentGroupComment::class);
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
