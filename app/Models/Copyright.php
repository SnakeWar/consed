<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Copyright extends Model
{
    protected $table = "copyright";
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
}
