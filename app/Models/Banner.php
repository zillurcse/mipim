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
        $GLOBALS['urls'] = [];
        $this->getMedia('gallery')->each(function ($item){
            $GLOBALS['urls'] [] = [
                'file_name' => $item->uuid,
                'upload_time' => Carbon::parse($item->updated_at)->format('Y m d H:i A'),
                'image' => $item->getUrl(),
                'url' => $item->getUrl()
            ];
        });
        return $GLOBALS['urls'];
    }


    protected $appends = ['images'];
    protected $hidden = ['media'];
    protected $guarded = [];


}
