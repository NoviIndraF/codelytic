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

    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function materi(){
        return $this->hasMany(Chapter::class);
    }
}
