<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Banner extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;


    public function getImagesAttribute()
    {
        $media = $this->getMedia('gallery');
        return $media ? $media->first()?->getUrl() : '';
    }


    protected $appends = ['images'];
    protected $hidden = ['media'];
    protected $guarded = [];


}
