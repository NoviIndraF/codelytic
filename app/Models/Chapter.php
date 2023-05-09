<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $with = ['materi'];

    public function materi(){
        return $this->belongsTo(Materi::class);
    }

}
