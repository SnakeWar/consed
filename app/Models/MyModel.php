<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyModel extends Model {
    function canDelete() {
        // should be implemented by child
        return true;
    }
}