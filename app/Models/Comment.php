<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
