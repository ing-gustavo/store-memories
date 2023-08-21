<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;
    protected $table = "media";
    protected $guarded = [];

    public function getImage()
    {
        return collect(["id" => $this->id , 'image_src' => $this->getThumb()]);
    }

    public function getThumb()
    {
        return Storage::disk($this->disk)->url($this->id.'/preview/'.$this->name);
    }


}
