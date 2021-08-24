<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Address extends Model
{
    protected $table = "address";
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
}
