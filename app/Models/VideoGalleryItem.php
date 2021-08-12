<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoGalleryItem extends Model
{
    protected $table = "video_gallery_item";
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
}
