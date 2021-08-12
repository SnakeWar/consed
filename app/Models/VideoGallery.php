<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class VideoGallery extends Model
{
    protected $table = "video_gallery";
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function setTitleAttribute($value)
    {
        $slug = Str::slug($value);
        $matchs = $this->uniqueSlug($slug);
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = $matchs ? $slug . '-' . $matchs : $slug;
    }
    public function uniqueSlug($slug)
    {
        $matchs = $this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->count();
        return $matchs;
    }
    public function photo()
    {
        return $this->belongsTo(GalleryImage::class, 'cover_id');
    }
    public function videos()
    {
        return $this->hasMany(VideoGalleryItem::class, 'gallery_id');
    }
    
}
