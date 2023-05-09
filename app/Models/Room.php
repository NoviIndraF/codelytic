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

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function materi(){
        return $this->hasMany(Materi::class);
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
