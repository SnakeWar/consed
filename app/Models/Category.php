<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends MyModel
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
//    function canDelete(){
//        return $this->segments->count() == 0;
//    }
}
