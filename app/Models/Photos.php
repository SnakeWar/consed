<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photos extends Model
{
    use SoftDeletes;
    protected $table = "wp_postmeta";
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
}
