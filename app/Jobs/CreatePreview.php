<?php

namespace App\Jobs;


use App\Models\Media;
use App\Models\Gallery;
use Illuminate\Bus\Queueable;
use Intervention\Image\Facades\Image;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreatePreview implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    
    public function __construct(Media $media)
    {
        $this->uploaded_file = $uploaded_file;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $media = Media::create([
            'name'      =>  $this->uploaded_file->hashName(),
            'file_name' =>  $this->uploaded_file->getClientOriginalName(),
            'mime_type' =>  $this->uploaded_file->getClientMimeType(),
            'extension' =>  $this->uploaded_file->extension(),
            'size'      =>  $this->uploaded_file->getSize(),
            'disk'      =>  'temporal'
        ]);

        dd($media);

        /*$image = Image::make($this->image_file);

        // Les informations de l'image
    	dd("Taille : ".$image->width()." x ".$image->height()." px - Mime : ".$image->mime()." - Size : ".$image->filesize());


        dd($this->image);*/
    }
}
