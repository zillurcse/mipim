<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    public function getPdfUrlAttribute()
    {
        $GLOBALS['urls'] = [];
        $this->getMedia('gallery')->each(function ($item) {
            $GLOBALS['urls'][] = [
                'file_name' => $item->uuid,
                'upload_time' => Carbon::parse($item->updated_at)->format('Y m d H:i A'),
                'image' => $item->getUrl(),
                'url' => $item->getUrl()
            ];
        });
        return $GLOBALS['urls'];


        $pdfMedia = $this->getFirstMedia('pdfs');
        return $pdfMedia ? $pdfMedia->getUrl() : null;
    }



    protected $appends = ['pdf_url'];

    protected $fillable = ['title', 'link', 'type'];
}
