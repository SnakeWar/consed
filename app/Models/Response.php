<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Response extends Model
{
    use SoftDeletes;
    //protected $table = 'response';
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function comments()
    {
        return $this->belongsTo(Comment::class);
    }
}
