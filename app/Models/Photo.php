<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $with = ['media'];

    public function media()
    {
        return $this->hasMany(Media::class,'model_id');
    }
}
