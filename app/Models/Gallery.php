<?php

namespace App\Models;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;

    function getModelName()
    {
        return get_class($this);
    }

    function getThumbnails()
    {
        $media =  Media::where('model_id',$this->id)->orderBy('id','desc')->get();

        return $media->map(function ($item) {
            return $item->getThumb();
        });


    }
}
