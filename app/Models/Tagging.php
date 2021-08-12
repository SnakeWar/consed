<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagging extends Model
{
    protected $table = "tagging";
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
}
