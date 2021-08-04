<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\User;

class Post extends Model
{
    use SoftDeletes;
    protected $table = "posts";
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
// Criar Slug
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
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function photos()
    {
        return $this->hasMany(Photos::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
