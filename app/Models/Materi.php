<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $with = ['room'];

    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function chapter(){
        return $this->hasMany(Chapter::class);
    }
}
