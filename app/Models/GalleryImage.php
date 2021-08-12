<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $table = "gallery_image";
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
}
